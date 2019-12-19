<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Outlet;
use App\User;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function table()
    {
        $employees = DB::table('employees')
            ->join('logins', 'logins.id', '=', 'employees.log_id')
            ->join('roles', 'roles.id', '=', 'logins.role')
            ->where('logins.role', '<>', 1)
            ->get();

        $outlets = Outlet::all();

        $tables = (object) [
            'emps' => $employees,
            'outlets' => $outlets,
        ];

        return view('admin.tables')->with('tables', $tables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = auth()->user()->id;
        $user = DB::table('employees')
            ->join('logins', 'logins.id', '=', 'employees.log_id')
            ->join('roles', 'roles.id', '=', 'logins.role')
            ->where('logins.id', $id)
            ->first();

        return view('admin.profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Employee::where('log_id', auth()->user()->id)->first();

        //dd($user);
        $user->emp_name = $request->name;
        $user->contact = $request->contact;
        $user->about = ($request->about == null) ? $user->about : $request->about;
        $user->save();

        return redirect()->route('admin.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
