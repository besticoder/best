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
	            'car_model_no' => Str::random(10),
	            'car_color' => Str::random(6),
	            'car_company' => Str::random(10),
	            'created_at' => date('Y-m-d h:i:s'),
	            'updated_at' => date('Y-m-d h:i:s'),
	        ]);
    	}

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
