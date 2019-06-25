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
use App\CellPhone;
use File;

class CellPhoneController extends HomeController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
        $this->cell_phone = new CellPhone;
    }

    public function cell_phone ()
    {
        return view('theme.phone.phone');
    }

    public function get_cell_phone(Request $request)
    {
        $user = Auth::user();
        
        $json_data = $this->cell_phone->getData($request);
        echo json_encode($json_data);
    }

    public function add_cell_phone(Request $request)
    {
        $input = array_except($request->all(),array('_token','car_img'));

        $validator = Validator::make($request->all(), [
            'cp_img' => 'required|mimes:jpeg,png,jpg',
            'cp_name' => 'required',
            'cp_color   ' => 'required',
            'cp_price' => 'required',
            'cp_model_no' => 'required',
            'cp_company' => 'required',
        ]);

        if($request->hasFile('cp_img')){
            $imageName = time().'.'.$request->file('cp_img')->getClientOriginalExtension();
            $request->file('cp_img')->move(public_path('/upload/phone/'),$imageName);
            $input['cp_img']  = $imageName;
        }
        else
        {
            echo json_encode(false);
        }

        $this->cell_phone->AddData($input);
        echo json_encode(true);
    }

    public function show_cell_phone(Request $request)
    {
        $car = CellPhone::where('id',$request->id)->count();
        if($car == 0)
        {
            echo json_encode(false);
        }
        $car = $this->cell_phone->findData($request->id);
        echo json_encode($car);
    }

    public function update_cell_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cp_img' => 'required|mimes:jpeg,png,jpg',
            'cp_name' => 'required',
            'cp_color   ' => 'required',
            'cp_price' => 'required',
            'cp_model_no' => 'required',
            'cp_company' => 'required',
        ]);

        $car = CellPhone::where('id',$request->id)->first();
        if(empty($car))
        {
            echo json_encode(false);
        }

        $input = array_except($request->all(),array('_token','id','cp_img'));
        if($request->hasFile('cp_img')){
            if($car->cp_img != '')
            {
                $path = '/upload/phone/'.$car->cp_img;
                if(File::exists(public_path($path))){
                    File::delete(public_path($path));
                }
            }

            $imageName = time().'.'.$request->file('cp_img')->getClientOriginalExtension();
            $request->file('cp_img')->move(public_path('/upload/phone/'),$imageName);
            $input['cp_img']  = $imageName;
        }

        $this->cell_phone->updateData($request->id, $input);
        echo json_encode(true);
    }

    public function delete_cell_phone(Request $request)
    {
        $CellPhone = CellPhone::where('id',$request->id)->first();
        if(empty($CellPhone))
        {
            echo json_encode(false);
        }

        if($CellPhone->cp_img != '')
        {
            $path = '/upload/phone/'.$CellPhone->cp_img;
            if(File::exists(public_path($path))){
                File::delete(public_path($path));
            }
        }
        $this->cell_phone->deleteData($request->id);
        echo json_encode(true);
    }

}