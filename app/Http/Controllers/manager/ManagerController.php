<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
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
          return redirect('/manager/home');
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
    
}
