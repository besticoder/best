<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class CellPhone extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cell_phones';

    protected $guarded = array();

    public function getData($request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'cp_img',
            2 =>'cp_name',
            3 =>'cp_color',
            4=> 'cp_price',
            5=> 'cp_model_no',
            6=> 'cp_company'
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
                            ->orWhere('cp_img', 'LIKE',"%{$search}%")
                            ->orWhere('cp_name', 'LIKE',"%{$search}%")
                            ->orWhere('cp_color', 'LIKE',"%{$search}%")
                            ->orWhere('cp_price', 'LIKE',"%{$search}%")
                            ->orWhere('cp_model_no', 'LIKE',"%{$search}%")
                            ->orWhere('cp_company', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = static::where('id','LIKE',"%{$search}%")
                            ->orWhere('cp_img', 'LIKE',"%{$search}%")
                            ->orWhere('cp_name', 'LIKE',"%{$search}%")
                            ->orWhere('cp_color', 'LIKE',"%{$search}%")
                            ->orWhere('cp_price', 'LIKE',"%{$search}%")
                            ->orWhere('cp_model_no', 'LIKE',"%{$search}%")
                            ->orWhere('cp_company', 'LIKE',"%{$search}%")
                            ->count();
        }
       

        

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                if($post->cp_img == '')
                {
                    $nestedData['cp_img'] = '<img src="'.asset('public/theme/img/phone.jpg').'" width="50px">';
                }
                else
                {
                    $nestedData['cp_img'] = '<img src="'.asset('public/upload/phone/').'/'.$post->cp_img.'" width="50px">';
                }
                $nestedData['cp_name'] = $post->cp_name;
                $nestedData['cp_color'] = $post->cp_color;
                $nestedData['cp_price'] = $post->cp_price;
                $nestedData['cp_model_no'] = $post->cp_model_no;
                $nestedData['cp_company'] = $post->cp_company;

                $button = '<a data-toggle="tab" href="#tab_general_edit" class="btn btn-primary btn-xs editPhoneBTN" style="float: left;margin-right: 4px;" data-id="'.$post->id.'" data-toggle="tooltip" title="Edit!"><i class="fas fa-edit"></i>';

                $button = $button.'<a href="javascript:void(0);" class="btn btn-danger btn-xs delete_phone"  style="float: left;margin-right: 4px;" data-id="'.$post->id.'" data-toggle="tooltip" title="Delete!"><i class="fas fa-trash-alt"></i></a>';

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