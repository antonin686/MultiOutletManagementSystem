<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Attendance;
use App\Order;
use App\Outlet;
use App\Booking;
use DB;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function getAttendence(Request $request)
    {       
        if($request->ajax())
        {
            $user = DB::table('employees')
                ->join('logins', 'logins.id', '=', 'employees.log_id')
                ->join('roles', 'roles.id', '=', 'logins.role')
                ->where('logins.role', '<>', 1)
                ->get();

            $attend = Attendance::whereDate('created_at', Carbon::today())->get();
            
            $result = [
                count($user),
                count($attend)
            ];

            return $result;
        }
    }

    public function getRevenue(Request $request)
    {
        if($request->ajax())
        {
            $orders = Order::whereDate('created_at', Carbon::today())->get();

            $revenue = 0;
            if($orders)
            {
                foreach ($orders as $order) {
                    $revenue += $order->total_price;
                }
            }else{
                return 3;
            }
            return $revenue;
        }
    }
    
    public function getOutletCount(Request $request)
    {
        if($request->ajax())
        {
            $outlets = Outlet::all();

            return count($outlets);
        }
    }

    public function getBookingCount(Request $request)
    {
        if($request->ajax())
        {
            $bookings = Booking::whereDate('time', Carbon::today())->get();

            return count($bookings);
        }
    }

    public function getWeeklyTransaction(Request $request)
    {     
        if($request->ajax())
        {
            $result = DB::select("SELECT DATE_FORMAT(created_at, '%a') as day,sum(total_price) as total 
            from orders GROUP BY created_at HAVING created_at BETWEEN CURRENT_DATE() - 7 AND CURRENT_DATE()");
            //dd($result);

            return $result;
        }
    }

    public function getDailyTransaction(Request $request)
    {     
        if($request->ajax())
        {
            $result = DB::select("SELECT created_at, out_id as outlet, SUM(total_price) as total 
            FROM orders GROUP BY out_id,created_at HAVING created_at = CURRENT_DATE()");
            //dd($result);
            return $result;
        }
    }


}