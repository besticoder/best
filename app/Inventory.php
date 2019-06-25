<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class Inventory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory';

    protected $guarded = array();

    public function getData($request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'pro_img',
            2 =>'pro_name',
            3 =>'pro_price',
            4=> 'pro_stok',
            5=> 'pro_item',
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
                            ->orWhere('pro_img', 'LIKE',"%{$search}%")
                            ->orWhere('pro_name', 'LIKE',"%{$search}%")
                            ->orWhere('pro_price', 'LIKE',"%{$search}%")
                            ->orWhere('pro_stok', 'LIKE',"%{$search}%")
                            ->orWhere('pro_item', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = static::where('id','LIKE',"%{$search}%")
                            ->orWhere('pro_img', 'LIKE',"%{$search}%")
                            ->orWhere('pro_name', 'LIKE',"%{$search}%")
                            ->orWhere('pro_price', 'LIKE',"%{$search}%")
                            ->orWhere('pro_stok', 'LIKE',"%{$search}%")
                            ->orWhere('pro_item', 'LIKE',"%{$search}%")
                            ->count();
        }
       

        

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {

                $nestedData['id'] = $post->id;
                if($post->pro_img == '')
                {
                    $nestedData['pro_img'] = '<img src="'.asset('theme/img/inventory.jpeg').'" width="50px">';
                }
                else
                {
                    $nestedData['pro_img'] = '<img src="'.asset('upload/product/').'/'.$post->pro_img.'" width="50px">';
                }
                $nestedData['pro_name'] = $post->pro_name;
                $nestedData['pro_price'] = $post->pro_price;
                $nestedData['pro_stok'] = $post->pro_stok;
                $nestedData['pro_item'] = $post->pro_item;

                $button = '<a data-toggle="tab" href="#tab_general_edit" class="btn btn-primary btn-xs editInvBTN" style="float: left;margin-right: 4px;" data-id="'.$post->id.'" data-toggle="tooltip" title="Edit!"><i class="fas fa-edit"></i>';

                $button = $button.'<a href="javascript:void(0);" class="btn btn-danger btn-xs delete_inv"  style="float: left;margin-right: 4px;" data-id="'.$post->id.'" data-toggle="tooltip" title="Delete!"><i class="fas fa-trash-alt"></i></a>';

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