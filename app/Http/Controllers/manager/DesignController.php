<?php
namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InventoryType;
use App\Inventory;
use App\Design;
use App\Booking;
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
           $counter = $id->table_id + 1;
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
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required|numeric',
            'number' => 'required|numeric',
            'time' => 'required',
            'table_no' => 'required|not_in:0',
        ]);
        //return $request;
        $id = Auth::user()->id;
        $data = DB::table('employees')
        ->join('outlets', 'employees.out_id', '=', 'outlets.id')
        ->where('employees.log_id', '=', $id)
        ->get();

        $book = Booking:: create([
            'booked_for'=> $request->name,
            'contact'=> $request->contact,
            'cus_amount'=> $request->number,
            'time'=> $request->time,
            'booked_by'=> $data[0]->emp_name,
            'table_id'=> $request->table_no,
            'out_id'=> $data[0]->out_id,
        ]);

        $table = Design::all()->where('table_id', $request->table_no)->first();
        //return $table;
        $table->status = 1;
        $table->save();

        return redirect()->route('booking')->with('message',"Seat Reserved for $request->name");
    }

    public function booked_seats()
    {
        $booking = Booking::all();
        //return $booking;
        return view('manager.booking.reserved_table')->with('title',"Reserved Seats")->with("booking",$booking);
    }

    public function destroy_seat($id)
    {
        $data = Booking::findOrFail($id);
        $table_id = Design::all()->where('table_id', $data->table_id)->first();
        $table_id->status = 0;
        $table_id->save();
        $data->delete();
    }

    public function edit_outlet()
    {
        $design = Design::all();
        return view('manager.outlet.edit_outlet')->with('title',"Edit Outlet")->with("design",$design);
    }

    public function change_outlet(Request $request)
    {
       $info = Design::all()->where('id', $request->seat_id)->first();
       //return $info;
       return response()->json($info);
       //return $user;
    }

    public function update_outlet(Request $request)
    {
        //return $request;
        $this->validate($request,[
            'seats' => 'required|numeric',
        ]);
        $seat = Design::find($request->seat_id);
        //return $seat;
        $seat->seats = $request->seats;
        $seat->save();

        $message = "Seat Number Has Been Updated!!";
        return redirect()->route('editOutlet')->with('message',$message);

    }

    public function destroy_table($id)
    {

        $data = Design::findOrFail($id);
        $data->delete();
    }
}
