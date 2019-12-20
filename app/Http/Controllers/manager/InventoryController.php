<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InventoryType;
use App\Inventory;
use DB;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function product_type(){
        return view('manager.inventory.category')->with('title',"Product Type");
    }

    public function insert_type(Request $request){
        $this->validate($request,[
            'product_type' => 'required',
        ]);

        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        InventoryType::create([
            'type'=>$request->product_type,
            'out_id'=>$outlet[0]->id,
        ]);
        return redirect()->route('ProductTypePage')->with('message',"This New Product Type Has Been Created");
    }

    public function add_product()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        $type =  InventoryType::all()->where('out_id', $outlet[0]->id);

        return view('manager.inventory.inventory')->with('title',"Add Product")->with('type', $type);
    }

    public function insert_product(Request $request)
    {
        $this->validate($request,[
            'item_name' => 'required',
            'item_type' => 'required|not_in:0',
            'code' => 'required|unique:inventories',
            'item_cost' => 'required|numeric',
        ]);
        //return $request;
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        Inventory::create([
            'name'=>$request->item_name,
            'type'=>$request->item_type,
            'code'=>$request->code,
            'cost'=>$request->item_cost,
            'out_id'=>$outlet[0]->id,
        ]);
        return redirect()->route('addProductPage')->with('message',"Item Added!!");
    }

    public function product_list()
    {
        $id = Auth::user()->id;

        $outlet = DB::table('employees')
        ->select('employees.out_id as id')
        ->where('employees.log_id', '=', $id)
        ->get();

        $inventory = Inventory::all()->where('out_id', $outlet[0]->id);

        return view('manager.inventory.list')->with('title',"Product List")->with('inventory', $inventory);
    }

    public function edit_product(Request $request)
    {
       $info = Inventory::all()->where('id', $request->product_id)->first();
       return response()->json($info);
       //return $user;
    }

    public function update_product(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        $product = Inventory::find($request->product_id);
        $product->name = $request->name;
        $product->cost = $request->price;
        $product->save();

        $message = "Product $request->name Has Been Updated!!";
        return redirect()->route('productList')->with('message',$message);

    }

    public function destroy_product($id)
    {
        $data = Inventory::findOrFail($id);
       // print_r($data);
        $data->delete();

    }

}
