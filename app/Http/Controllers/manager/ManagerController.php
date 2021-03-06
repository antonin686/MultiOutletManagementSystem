<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use App\Invoice;
use App\Attendance;
use App\Design;
use App\Inventory;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
Use Carbon\Carbon;

class ManagerController extends Controller
{
    public function home()
    {
        $atten =  Attendance::whereDate('created_at', Carbon::today())->count();
        //$atten = count($attend);
        //dd($attend);
        $table =  Design::all()->where('status', 1)->count();
        $table1 =  Design::all()->where('status', 0)->count();
        $pro =  Inventory::count();
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();
        
        $data = DB::table('employees')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('employees.id','employees.emp_name','employees.contact','employees.salary')
                 ->where('employees.log_id', '!=', $id)
                 ->where('employees.out_id', '=', $outlet[0]->id)
                 ->count();

        return view('manager.home')->with("title","Manager Dashboard")->with('atten', $atten)->with('table', $table)->with('table1', $table1)->with('pro', $pro)->with('data', $data);
    }

    public function manager_profile(){
        $id = Auth::user()->id;
        $data = DB::table('employees')
                 ->join('logins', 'employees.log_id', '=', 'logins.id')
                 ->join('roles', 'logins.role', '=', 'roles.id')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('logins.username','logins.password', 'roles.role_name as role','employees.emp_name as mname', 'employees.contact', 'employees.salary', 'employees.img','outlets.out_name as out')
                 ->where('employees.log_id', '=', $id)
                 ->get();
        //return $data;
        return view('manager.manager_profile')->with('data',$data)->with("title","Profile");
    }

    public function edit_profile(){
        $id = Auth::user()->id;
        $data = DB::table('employees')
                 ->join('logins', 'employees.log_id', '=', 'logins.id')
                 ->join('roles', 'logins.role', '=', 'roles.id')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('logins.username','logins.password', 'roles.role_name as role','employees.emp_name as mname', 'employees.contact', 'employees.salary', 'employees.img','outlets.out_name as out')
                 ->where('employees.log_id', '=', $id)
                 ->get();
        
        return view('manager.edit_profile')->with('data', $data)->with("title","Edit Profile");
    }

    public function update_profile(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required|numeric|min:11',
        ]);
        $id = Auth::user()->id;
        $user = Employee::all()->where('log_id',$id)->first();
        $user->emp_name =  $request->get('name');
		$user->contact =  $request->get('contact');
        $user->save();
        return redirect()->route('manager.profile');
    }

    public function settings(){
        return view('manager.settings')->with("title","Settings");

    }

    public function update_password(Request $request){
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $id = Auth::user()->id;
        $password = User::all()->where('id',$id)->first();

        if(Hash::check($request['current_password'], $password->password))
        {                           
          $obj_user = User::find($id);
          $obj_user->password = Hash::make($request['password']);;
          $obj_user->save(); 
          return redirect()->route('managerProfile.settings')->with('success','Password Updated!!');
        }
        else{
            return redirect()->back()->with([
                'message' => 'Your Current Password Does Not Match !!!',
            ])->withInput();
        }
    }

    public function addEmployeePage()
    {
        return view('manager.add_employee')->with("title","Add Employee");
    }

    public function addEmployee(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required|unique:logins',
            'contact' => 'required|numeric|min:11',
            'salary' => 'required|numeric',
            'password' => 'required|min:4',
            'file' => 'required'
        ]);

        $user = User::create([
            
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 3,
        ]);

        $file = $request->file('file');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move('images',$filename);
        
        $id = Auth::user()->id;
        $data = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        Employee::create([
            'emp_name' => $request->name,
            'contact' => $request->contact,
            'salary' => $request->salary,
            'out_id' => $data[0]->id,
            'img' => 'images/'.$filename,
            'log_id' => $user->id,
        ]);

        $message = "Employee $request->name Has Been Created Successfully!!";
        return redirect()->route('addEmployeePage')->with('message',$message);
    }

    public function employee_list()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();
        
        $data = DB::table('employees')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('employees.id','employees.emp_name','employees.contact','employees.salary')
                 ->where('employees.log_id', '!=', $id)
                 ->where('employees.out_id', '=', $outlet[0]->id)
                 ->get();

        //return $data;
        return view('manager.employee_list')->with("title","Employee List")->with("data",$data);
    }
    
    public function edit_employee(Request $request)
    {
       $info = Employee::all()->where('id', $request->employee_id)->first();
       //return $info;
       return response()->json($info);
       //return $user;
    }

    public function update_employee(Request $request)
    {
        //return $request;
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required|numeric|min:11',
            'salary' => 'required|numeric',
        ]);
        $user = Employee::find($request->employee_id);
        $user->emp_name = $request->name;
        $user->contact = $request->contact;
        $user->salary = $request->salary;
        $user->save();

        $message = "Employee $request->name Has Been Updated!!";
        return redirect()->route('employeeList')->with('message',$message);

    }

    public function employee_info(Request $request)
    {
        $info = DB::table('employees')
        ->join('logins', 'employees.log_id', '=', 'logins.id')
        ->select('employees.emp_name','employees.contact','employees.salary','employees.img','employees.created_at','logins.username')
        ->where('employees.id', '=', $request->employee_id)
        ->get();

       // return $info;
        return response()->json($info);
    }

    public function destroy_employee($id)
    {
        $data = Employee::findOrFail($id);
       // print_r($data);
        $log_id = User::all()->where('id', $data->log_id)->first();
        $log_id->delete();
        $data->delete();
    }

    public function outlet_info(){
        $id = Auth::user()->id;
        $data = DB::table('employees')
        ->join('outlets', 'employees.out_id', '=', 'outlets.id')
        ->where('employees.log_id', '=', $id)
        ->get();
        //return $data;
        return view('manager.outlet.info')->with("title","Outlet Information")->with("data",$data);
    }

    public function pending_orders()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        $data = Invoice::all()->where('status', 0)->where('out_id', $outlet[0]->id);
        return view('manager.orders.pending')->with("title","Pending Orders")->with("data",$data);
    }

    public function destroy_pending($id)
    {
        $data = Invoice::findOrFail($id);
       // print_r($data);
        $data->delete();
    }

    public function completed_orders()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        $data = Invoice::all()->where('status', 1)->where('out_id', $outlet[0]->id);
        return view('manager.orders.completed')->with("title","Completed Orders")->with("data",$data);
    }

    public function attendance()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();
        
        $data = DB::table('employees')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('employees.id','employees.emp_name','employees.contact','employees.salary')
                 ->where('employees.log_id', '!=', $id)
                 ->where('employees.out_id', '=', $outlet[0]->id)
                 ->get();

        //return $data;
        return view('manager.attendance.take_attendance')->with("title","Take Attendance")->with("data",$data);
    }
    
    public function insert_attendance(Request $request)
    {
        $this->validate($request,[
            'checkbox' => 'required_without_all',
        ]);
        
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        $ids = $request->input('checkbox');
        foreach($ids as $id){
         //var_dump($service);
         $user = Employee::all()->where('id', $id)->first();
         //var_dump($user);
        Attendance::create([
            'emp_name'=> $user->emp_name,
            'contact'=> $user->contact,
            'out_id'=>$outlet[0]->id,
        ]);
        }
        return redirect()->route('attendance')->with('message',"Attendance Taken Successfully!!");
    }

    public function view_attendance()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();
        
        $data = DB::table('employees')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('employees.id','employees.emp_name','employees.contact','employees.salary')
                 ->where('employees.log_id', '!=', $id)
                 ->where('employees.out_id', '=', $outlet[0]->id)
                 ->get();

        return view('manager.attendance.view_attendance')->with("title","View Attendance")->with("data",$data)->with("info","");
    }

    public function load_attendance(Request $request)
    {
        $this->validate($request,[
            'emp_name' => 'required|not_in:0',
        ]);
       //return $request;
       $id = Auth::user()->id;

       $outlet = DB::table('employees')
       ->select('employees.out_id as id')
       ->where('employees.log_id', '=', $id)
       ->get();
       
       $data = DB::table('employees')
                ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                ->select('employees.id','employees.emp_name','employees.contact','employees.salary')
                ->where('employees.log_id', '!=', $id)
                ->where('employees.out_id', '=', $outlet[0]->id)
                ->get();

       $info = Attendance::all()->where('emp_name',$request->emp_name);

       return view('manager.attendance.view_attendance')->with("title","View Attendance")->with("data",$data)->with("info",$info);
    }
}
