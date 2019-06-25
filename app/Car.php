<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class Car extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cars';

    protected $guarded = array();

    public function getData($request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'car_img',
            2 =>'car_name',
            3 =>'car_type',
            4=> 'car_model_no',
            5=> 'car_color',
            6=> 'car_company'
        );



        $totalData = static::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalFiltered = $totalData; 

        if(empty($request->input('search.value')))
        {            
            $posts =static::offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        }
        else 
        {
            $search = $request->input('search.value'); 

            $posts = static::where('id','LIKE',"%{$search}%")
                            ->orWhere('car_img', 'LIKE',"%{$search}%")
                            ->orWhere('car_name', 'LIKE',"%{$search}%")
                            ->orWhere('car_type', 'LIKE',"%{$search}%")
                            ->orWhere('car_model_no', 'LIKE',"%{$search}%")
                            ->orWhere('car_color', 'LIKE',"%{$search}%")
                            ->orWhere('car_company', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = static::where('id','LIKE',"%{$search}%")
                            ->orWhere('car_img', 'LIKE',"%{$search}%")
                            ->orWhere('car_name', 'LIKE',"%{$search}%")
                            ->orWhere('car_type', 'LIKE',"%{$search}%")
                            ->orWhere('car_model_no', 'LIKE',"%{$search}%")
                            ->orWhere('car_color', 'LIKE',"%{$search}%")
                            ->orWhere('car_company', 'LIKE',"%{$search}%")
                            ->count();
        }
       

        

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                if($post->car_img == '')
                {
                    $nestedData['car_img'] = '<img src="'.asset('public/theme/img/car.jpg').'" width="50px">';
                }
                else
                {
                    $nestedData['car_img'] = '<img src="'.asset('public/upload/car/').'/'.$post->car_img.'" width="50px">';
                }
                $nestedData['car_name'] = $post->car_name;
                $nestedData['car_type'] = $post->car_type;
                $nestedData['car_model_no'] = $post->car_model_no;
                $nestedData['car_color'] = $post->car_color;
                $nestedData['car_company'] = $post->car_company;

                $button = '<a data-toggle="tab" href="#tab_general_edit" class="btn btn-primary btn-xs editCarBTN" style="float: left;margin-right: 4px;" data-id="'.$post->id.'" data-toggle="tooltip" title="Edit!"><i class="fas fa-edit"></i>';

                $button = $button.'<a href="javascript:void(0);" class="btn btn-danger btn-xs delete_car"  style="float: left;margin-right: 4px;" data-id="'.$post->id.'" data-toggle="tooltip" title="Delete!"><i class="fas fa-trash-alt"></i></a>';

                $nestedData['action'] = $button;
                $data[] = $nestedData;

            }
        }
          
        $data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        return $data;
    }

    public function AddData($input)
    {
        $data=static::create($input);
        return $data->id;
    }

    public function findData($id)
    {
        return static::find($id);
    }

    public function updateData($id, $input)
    {
        return static::where('id', $id)->update($input);
    }

    public function deleteData($id)
    {
        return static::where('id',$id)->delete();
    }
}