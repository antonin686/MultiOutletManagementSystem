<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Outlet;
use App\Employee;
use App\OutletTable;
use App\Table;

class OutletController extends Controller
{
   
    public function index()
    {
        return redirect()->route('admin.tables')->with('tab', 'outlet');
    }

    public function create()
    {
        return view('admin.outlet.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required',
            'city' => 'required',
            'table' => 'required|numeric',
        ]);

        $outlet = new Outlet();

        $outlet->out_name = $request->name;
        $outlet->location = $request->location;
        $outlet->city = $request->city;
        $outlet->save();

        for ($i=0; $i < $request->table; $i++) { 
            $table = new Table();
            $tab = $i+ 1;
            $table->table_name = "t{$outlet->id}0{$tab}";
            $table->out_id = $outlet->id;
            $table->save();
        }

        $message = "Outlet $request->name Has Been Added Successfully!!";
        return redirect()->route('outlet.create')->with('message',$message);
    }

    public function show($id)
    {
        $outlet = Outlet::find($id);

        //$emps = Employee::where('out_id', $id)->get();
        
        $emps = DB::table('employees')
            ->select('employees.id', 'employees.emp_name', 'employees.salary', 'employees.contact', 'employees.out_id', 'logins.username', 'logins.role', 'roles.role_name')
            ->join('logins', 'logins.id', '=', 'employees.log_id')
            ->join('roles', 'roles.id', '=', 'logins.role')
            ->where('employees.out_id', $id)
            ->get();
        //dd($emps);
        return view('admin.outlet.show', compact('outlet', 'emps'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required',
            'city' => 'required',
        ]);


        $outlet = Outlet::find($id);

        $outlet->out_name = $request->name;
        $outlet->location = $request->location;
        $outlet->city = $request->city;
        $outlet->save();
        
        $message = "Outlet $request->name Has Been Updated Successfully!!";
        return Redirect()->route('outlet.show',['id' => $id])->with('message',$message);
    }

    public function destroy($id)
    {
        $outlet = Outlet::find($id);
        $outlet->delete();

        return redirect()->route('admin.tables')->with('tab', 'outlet');
    }
}
