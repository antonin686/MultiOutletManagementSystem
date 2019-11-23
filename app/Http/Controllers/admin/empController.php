<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use DB;
class empController extends Controller
{

    function __construct()
    {
        $this->middleware('checkIfAdmin');
    }

    function getList()
    {
        print(Employee::all());
    }

    function getProfile()
    {
        $id = auth()->user()->id;
        $data = DB::table('employees')
                 ->join('logins', 'employees.log_id', '=', 'logins.id')
                 ->join('roles', 'logins.role', '=', 'roles.id')
                 ->select('logins.username', 'roles.name','employees.name', 'employees.contact', 'employees.salary', 'employees.img',)
                 ->where('employees.id', '=', $id)
                 ->get();

        return $data;
    }
}
