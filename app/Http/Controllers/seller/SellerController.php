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
        return view('seller.bill.invoice');
    }

    public function items(){
        $users = DB::table('item_list')->where('approval', '1')->get();
        return view('seller.items.item')-> with('info', $users);;
    }

    public function Osatus(){
        return view('seller.ingredient.crud');
    }


    
}
