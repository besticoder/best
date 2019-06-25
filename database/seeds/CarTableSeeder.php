<?php

use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0; $i < 1000; $i++)
    	{
    		DB::table('cars')->insert([
	            'car_type' => 'Petrol',
                'car_img' => '',
                'car_name' => Str::random(10),
	            'car_model_no' => 'mod_'.$i,
	            'car_color' => Str::random(6),
	            'car_company' => Str::random(10),
	            'created_at' => date('Y-m-d h:i:s'),
	            'updated_at' => date('Y-m-d h:i:s'),
	        ]);
    	}

        for($i=0; $i < 1000; $i++)
        {
            DB::table('cell_phones')->insert([
                'cp_name' => 'Semsang_'.$i,
                'cp_img' => '',
                'cp_color' => Str::random(10),
                'cp_price' => 100+$i,
                'cp_model_no' => 'mod_'.$i,
                'cp_company' => Str::random(10),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        }

        for($i=0; $i < 1000; $i++)
        {
            DB::table('inventory')->insert([
                'pro_name' => 'test_'.$i,
                'pro_img' => '',
                'pro_stok' => 100+$i,
                'pro_price' => 100,
                'pro_item' => 25+$i,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        }

        DB::table('users')->where('email','admin@gmail.com')->delete();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
