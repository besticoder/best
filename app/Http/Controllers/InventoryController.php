<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Requests;

use Auth;
use Hash;
use Validator;
use App\User;
use App\Inventory;
use File;

class InventoryController extends HomeController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
        $this->inventory = new Inventory;
    }

    public function inventory()
    {
        return view('theme.inventory.inventory');
    }

    public function get_inventory(Request $request)
    {
        $user = Auth::user();
        
        $json_data = $this->inventory->getData($request);
        echo json_encode($json_data);
    }

    public function add_inventory(Request $request)
    {
        $input = array_except($request->all(),array('_token','pro_img'));

        $validator = Validator::make($request->all(), [
            'pro_img' => 'required|mimes:jpeg,png,jpg',
            'pro_name' => 'required',
            'pro_price' => 'required',
            'pro_stok' => 'required',
            'pro_item' => 'required',
        ]);

        if($request->hasFile('pro_img')){
            $imageName = time().'.'.$request->file('pro_img')->getClientOriginalExtension();
            $request->file('pro_img')->move(public_path('/upload/product/'),$imageName);
            $input['pro_img']  = $imageName;
        }
        else
        {
            echo json_encode(false);
        }

        $this->inventory->AddData($input);
        echo json_encode(true);
    }

    public function show_inventory(Request $request)
    {
        $car = Inventory::where('id',$request->id)->count();
        if($car == 0)
        {
            echo json_encode(false);
        }
        $car = $this->inventory->findData($request->id);
        echo json_encode($car);
    }

    public function update_inventory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pro_img' => 'required|mimes:jpeg,png,jpg',
            'pro_name' => 'required',
            'pro_price' => 'required',
            'pro_stok' => 'required',
            'pro_item' => 'required',
        ]);

        $car = Inventory::where('id',$request->id)->first();
        if(empty($car))
        {
            echo json_encode(false);
        }

        $input = array_except($request->all(),array('_token','id','pro_img'));
        if($request->hasFile('pro_img')){
            if($car->pro_img != '')
            {
                $path = '/upload/product/'.$car->pro_img;
                if(File::exists(public_path($path))){
                    File::delete(public_path($path));
                }
            }

            $imageName = time().'.'.$request->file('pro_img')->getClientOriginalExtension();
            $request->file('pro_img')->move(public_path('/upload/product/'),$imageName);
            $input['pro_img']  = $imageName;
        }

        $this->inventory->updateData($request->id, $input);
        echo json_encode(true);
    }

    public function delete_inventory(Request $request)
    {
        $Inventory = Inventory::where('id',$request->id)->first();
        if(empty($Inventory))
        {
            echo json_encode(false);
        }

        if($Inventory->pro_img != '')
        {
            $path = '/upload/product/'.$Inventory->pro_img;
            if(File::exists(public_path($path))){
                File::delete(public_path($path));
            }
        }

        $this->inventory->deleteData($request->id);
        echo json_encode(true);
    }

}