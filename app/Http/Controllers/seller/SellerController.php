<?php

namespace App\Http\Controllers\seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function invoice(){
        $e_id=auth()->user()->id;
        $token = DB::table('invoices')->max('token');
        $token++;
        return view('seller.bill.invoice')->with('newToken',$token);
    }

    public function getCost(Request $request){
        
        if($request->ajax())
        {
            $query = $request->get('query');
            $users = DB::table('item_list')->where('item_code', $query)->first();
            echo json_encode($users);
        }
        
    }

    public function submitBill(Request $request){

        $user=DB::table('employees')->where('log_id',auth()->user()->id)->first();
        //dd($user);
        for ($i=0; $i < count($request->cost); $i++) { 
            DB::table('invoices')->insert([
                    //col=======value
                    'cus_name' => $request->username,
                    'cus_contact' => $request->contact,
                    'token' => $request->token,
                    'ticket' => $request->ticket,
                    'food_code' => $request->code[$i],
                    'food_name' => $request->f_name[$i],
                    'food_cost' => $request->cost[$i],
                    'out_id' => $user->out_id,
                    'e_username' => auth()->user()->username
                    
                ]);
        }
        //dd($request->cost[0]);
    }


    public function items(){
        $users = DB::table('item_list')->where('approval', '1')->get();
        return view('seller.items.item')-> with('info', $users);;
    }

    public function Osatus(){
        $users = DB::table('invoices')->where('status', '0')->get();
        return view('seller.ingredient.crud')-> with('info', $users);
    }
    public function served($id){
        
        DB::table('invoices')
        ->where('id', $id)
        ->update([
            'status' => '1',
            ]);
            return redirect()->route('Ostatus');
    }

    public function goodsEntry(){
        
        //return view('seller.inventory.insert-rawGoods')-> with('lastBal', $Bal); //{{$lastBal}}
        return view('seller.inventory.insert-rawGoods');
    }

    public function goodsBal(Request $request){
        if($request->ajax())
        {
            $prod_name = $request->get('p_name');
            $prod_type = $request->get('p_type');
            $Balid = DB::table('inventory__raw__materials')->where( 'product_name',$prod_name)->Where('product_type', $prod_type)->max('id');
            $Bal = DB::table('inventory__raw__materials')->where('id',$Balid)->value('balance');
            echo json_encode($Bal);
        
        }
    }

    public function submitRawGoods(Request $request){
        //dd($request->all());
        $getUser=auth()->user()->id;
        $outlet = Employee::where('log_id', $getUser)->first()->out_id;
        //dd($user);
        for ($i=0; $i < count($request->bal); $i++) { 
            DB::table('inventory__raw__materials')->insert([
                    //col=======value
                    'product_name' => $request->prod_name[$i],
                    'product_type' => $request->prod_type[$i],
                    'date' => $request->date[$i],
                    'opening' => $request->opening[$i],
                    'receive' => $request->rec[$i],
                    'total' => $request->total[$i],
                    'exp' => $request->exp[$i],
                    'balance' => $request->bal[$i],
                    'out_id' => $outlet
                    
                ]);
        }
        dd($request->bal[0]);
    }

    public function packedFood(){
        
        //return view('seller.inventory.insert-rawGoods')-> with('lastBal', $Bal); //{{$lastBal}}
        return view('seller.inventory.packed_item');
    }

    public function packedFoodInsert(Request $request){
        
        $getUser=auth()->user()->id;
        $outlet = Employee::where('log_id', $getUser)->first()->out_id;
        //dd($user);
        for ($i=0; $i < count($request->exp_date); $i++) { 
            DB::table('packed__ingredients')->insert([
                    //col=======value
                    'prod_name' => $request->prod_name[$i],
                    'prod_type' => $request->prod_type[$i],
                    'cost' => $request->cost[$i],
                    'buy_date' => $request->buy_date[$i],
                    'exp_date' => $request->exp_date[$i],
                    'out_id' => $outlet
                    
                ]);
        }
        return view('seller.inventory.view-inventory');
    }

    public function viewInventory(){
        $getUser=auth()->user()->id;
        $outlet = Employee::where('log_id', $getUser)->first()->out_id;
        $userss = DB::table('inventory__raw__materials')->where('out_id', $outlet)->get();
        $users = DB::table('packed__ingredients')->where('out_id', $outlet)->get();
        return view('seller.inventory.view-inventory')-> with('info', $users)-> with('data', $userss);
        //return redirect()->route('inventory');
    }

    
}
