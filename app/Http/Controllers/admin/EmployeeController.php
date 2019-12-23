<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\User;
use App\Employee;
use App\Outlet;

class EmployeeController extends Controller
{
    
    public function index()
    {
        return redirect()->route('admin.tables')->with('tab', 'employee');
    }

    public function create()
    {
        $outlets = Outlet::all();
        //dd($outlets[]);
        return view('admin.employee.create')->with('outlets', $outlets);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'username' => 'required|unique:logins',
            'contact' => 'required|numeric|min:11',
            'salary' => 'required|numeric',
            'password' => 'required|min:3',
        ]);

        $file = $request->file('img');
        $name = "";

        if($file)
        {
            $name = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $name);
        }

        $path = "/uploads/".$name;
    
        //dd($path);
        $login = new User();
        $login->username = $request->username;
        $login->password = Hash::make($request->password);
        $login->role = $request->role;
        $login->save();

        $emp = new Employee();
        $emp->emp_name = $request->name;
        $emp->contact = $request->contact;
        $emp->salary = $request->salary;
        $emp->out_id = $request->out_id;
        $emp->log_id = $login->id;
        $emp->img = $file ? $path : "/uploads/person.jpg";
        $emp->save();
        
        $message = "Employee $request->username Has Been Added Successfully!!";
        return redirect()->route('employee.create')->with('message',$message);
    }

    public function show($id)
    {
        $user = DB::table('employees')
            ->join('logins', 'logins.id', '=', 'employees.log_id')
            ->join('roles', 'roles.id', '=', 'logins.role')
            ->where('employees.id', $id)
            ->first();

        return view('admin.employee.show')->with('user', $user);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required|numeric|min:11',
            'salary' => 'required|numeric',
        ]);

        $emp = Employee::find($id);
        $emp->emp_name = $request->name;
        $emp->contact = $request->contact;
        $emp->salary = $request->salary;
        $emp->about = ($request->about == null) ? $emp->about : $request->about;
        $emp->save();

        $message = "Employee Has Been Updated Successfully!!";

        return Redirect()->route('employee.show',['id' => $id])->with('message',$message);
    }

    public function destroy($id)
    {
        $emp = Employee::find($id);
        $login = User::find($emp->log_id);

        $emp->delete();
        $login->delete();

        return redirect()->route('admin.tables');
    }
}