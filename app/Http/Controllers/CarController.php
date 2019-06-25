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
use App\Car;
use File;

class CarController extends HomeController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
        $this->car = new Car;
    }

    public function cars()
    {
        return view('theme.car.index');
    }

    public function getCars(Request $request)
    {
        $user = Auth::user();
        
        $json_data = $this->car->getData($request);
        echo json_encode($json_data);
    }

    public function addCars(Request $request)
    {
        $input = array_except($request->all(),array('_token','car_img'));

        $validator = Validator::make($request->all(), [
            'car_img' => 'required|mimes:jpeg,png,jpg',
            'car_type' => 'required',
            'car_name' => 'required',
            'car_model_no' => 'required',
            'car_color' => 'required',
            'car_company' => 'required',
        ]);

        if($request->hasFile('car_img')){
            $imageName = time().'.'.$request->file('car_img')->getClientOriginalExtension();
            $request->file('car_img')->move(public_path('/upload/car/'),$imageName);
            $input['car_img']  = $imageName;
        }
        else
        {
            echo json_encode(false);
        }

        $this->car->AddData($input);
        echo json_encode(true);
    }

    public function showCars(Request $request)
    {
        $car = Car::where('id',$request->id)->count();
        if($car == 0)
        {
            echo json_encode(false);
        }
        $car = $this->car->findData($request->id);
        echo json_encode($car);
    }

    public function updateCar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_img' => 'required|mimes:jpeg,png,jpg',
            'car_type' => 'required',
            'car_name' => 'required',
            'car_model_no' => 'required',
            'car_color' => 'required',
            'car_company' => 'required',
        ]);

        $car = Car::where('id',$request->id)->first();
        if(empty($car))
        {
            echo json_encode(false);
        }

        $input = array_except($request->all(),array('_token','id','car_img'));
        if($request->hasFile('car_img')){
            if($car->car_img != '')
            {
                $path = '/upload/car/'.$car->car_img;
                if(File::exists(public_path($path))){
                    File::delete(public_path($path));
                }
            }

            $imageName = time().'.'.$request->file('car_img')->getClientOriginalExtension();
            $request->file('car_img')->move(public_path('/upload/car/'),$imageName);
            $input['car_img']  = $imageName;
        }

        $this->car->updateData($request->id, $input);
        echo json_encode(true);
    }

    public function deleteCars(Request $request)
    {
        $car = Car::where('id',$request->id)->count();
        if($car == 0)
        {
            echo json_encode(false);
        }
        $this->car->deleteData($request->id);
        echo json_encode(true);
    }

}