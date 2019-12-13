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

    public function edit_profile(){
        $id = Auth::user()->id;
        $data = DB::table('employees')
                 ->join('logins', 'employees.log_id', '=', 'logins.id')
                 ->join('roles', 'logins.role', '=', 'roles.id')
                 ->join('outlets', 'employees.out_id', '=', 'outlets.id')
                 ->select('logins.username','logins.password', 'roles.name as role','employees.name as mname', 'employees.contact', 'employees.salary', 'employees.img','outlets.name as out')
                 ->where('employees.log_id', '=', $id)
                 ->get();
        
        return view('manager.edit_profile')->with('data', $data)->with("title","Edit Profile");
    }

    public function update_profile(Request $request){
        $id = Auth::user()->id;
        $user = Employee::all()->where('log_id',$id)->first();
        $user->name =  $request->get('name');
		$user->contact =  $request->get('contact');
        $user->save();
        return redirect()->route('manager.profile');
    }

    public function settings(){
        return view('manager.settings')->with("title","Settings");

    }

    public function update_password(Request $request){
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $id = Auth::user()->id;
        $password = User::all()->where('id',$id)->first();
        
        if(Hash::check($request['current_password'], $password->password))
        {                           
          $obj_user = User::find($id);
          $obj_user->password = Hash::make($request['password']);;
          $obj_user->save(); 
          return redirect('/manager/home');
        }
        else{
            return redirect()->back()->with([
                'message' => 'Your Current Password Does Not Match !!!',
            ])->withInput();
        }
    }
    
}
