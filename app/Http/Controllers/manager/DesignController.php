<?php
namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InventoryType;
use App\Inventory;
use App\Design;
use DB;
use Illuminate\Support\Facades\Auth;


class DesignController extends Controller
{
    public function index()
    {
        $count = Design::count();
        $counter;
        if($count <= 0){
            $counter = 1;
        }
        else{
           $id =  Design::latest()->first();
           $counter = $id->id + 1;
        }
        return view('manager.outlet.design')->with('title',"Outlet Design")->with("counter",$counter);
    }

    public function insert(Request $request){
        $this->validate($request,[
            'seats' => 'required|numeric',
        ]);

        $split = explode("-", $request->name);
        $tbl_name = array_shift($split);
        $tbl_no  = implode("-", $split);
        //return $tbl_name;        
        Design::create([
            'table_id'=> $tbl_no,
            'seats'=> $request->seats,
        ]);
        return redirect()->route('designOutlet')->with('message',"Table Created!!");
    }

    public function booking()
    {
        $tables = Design::all()->where('status', 0);
        return view('manager.booking.index')->with('title',"Seat Booking")->with("tables",$tables);
    }

    public function insert_booking(Request $request){
        return $request;
    }
}
