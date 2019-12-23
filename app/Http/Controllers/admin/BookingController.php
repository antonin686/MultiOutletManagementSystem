<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Outlet;
use App\Booking;
use DB;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('admin.tables')->with('tab', 'booking');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::all();

        $tables = DB::table('outlets')
        ->join('tables', 'outlets.id', '=', 'tables.out_id')
        ->get();

        return view('admin.booking', compact('outlets', 'tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required',
            'time' => 'required',
            'table' => 'required',
        ]);

        $booking = new Booking();

        $booking->table_id = $request->table;
        $booking->out_id = $request->out_id;
        $booking->booked_for = $request->name;
        $booking->contact = $request->contact;
        $booking->time = $request->time;
        $booking->booked_by = auth()->user()->id;
        $booking->save();
        
        $message = "Booking Has Been added Successfully!!";
        return redirect()->route('booking.create')->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
