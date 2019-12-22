<?php

namespace App\Http\Controllers\admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Outlet;
use App\User;
use App\Booking;
use App\InventoryType;
use DB;
use Session;
use Auth;
use Hash;
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
            ->select('employees.id', 'employees.emp_name', 'employees.salary', 'employees.contact', 'employees.out_id', 'logins.username', 'logins.role', 'roles.role_name')
            ->join('logins', 'logins.id', '=', 'employees.log_id')
            ->join('roles', 'roles.id', '=', 'logins.role')
            ->where('logins.role', '<>', 1)
            ->get();

        $outlets = Outlet::all();

        $bookings = DB::table('bookings')
            ->select('bookings.id', 'bookings.booked_for', 'bookings.booked_by', 'bookings.contact', 'bookings.time', 'tables.table_name', 'bookings.out_id')
            ->join('outlets', 'outlets.id', '=', 'bookings.out_id')
            ->join('tables', 'tables.id', '=', 'bookings.table_id')
            ->get();

        $orders = DB::table('orders')
            ->select('orders.id', 'orders.out_id', 'item_list.item_name', 'orders.quantity', 'orders.total_price')
            ->join('item_list', 'item_list.id', '=', 'orders.item_id')
            ->get();

        $invens = DB::table('inventories')
            ->select('inventories.id', 'inventories.inv_name', 'inventories.inv_type','inventories.quantity', 'inventories.cost', 'inventories.out_id', 'inventories.created_at', 'inventory_types.type_name')
            ->join('inventory_types', 'inventory_types.id', '=', 'inventories.inv_type')
            ->get();

        $inven_types = InventoryType::all();
        //$inventory
        //dd($invens);

        $tables = (object) [
            'emps' => $employees,
            'outlets' => $outlets,
            'orders' => $orders,
            'invs' => $invens,
            'inv_types' => $inven_types,
            'bookings' => $bookings,
            'tab' => Session::has('tab') ? Session::get('tab') : 'employee',
        ];

        return view('admin.tables')->with('tables', $tables);
    }

    public function booking()
    {
        
    }

    public function attendence()
    {
        $attends = DB::select("SELECT e.id, e.emp_name, e.out_id, 
		CASE WHEN a.id IS NOT NULL THEN 'Present' 
		ELSE 'Absent' 
		END as status
		FROM employees e
        LEFT JOIN attendances a on e.id=a.u_id AND a.created_at = CURDATE()");
        
        $outlets = Outlet::all();

        $tables = (object) [
            'attends' => $attends,
            'outlets' => $outlets,
        ];

        return view('admin.attendence')->with('tables', $tables);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

    
    public function edit($id)
    {
        //
    }

    public function password()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        if(Hash::check($request->old, auth()->user()->password))
        {
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($request->new);
            $user->save();      
        }

        return redirect()->route('admin.profile');
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
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required|numeric|min:11', 
        ]);

        $user = Employee::where('log_id', auth()->user()->id)->first();

        $user->emp_name = $request->name;
        $user->contact = $request->contact;
        $user->about = ($request->about == null) ? $user->about : $request->about;
        $user->save();

        $message = "Profile Has Been Successfully Updated!!";
        return redirect()->route('admin.profile')->with('message',$message);
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

    public function logout()
    {
        return redirect('login')->with(Auth::logout());
    }
}