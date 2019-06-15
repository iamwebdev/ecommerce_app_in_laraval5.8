<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array('Nike','New Balance','Converse','Puma','Sparx','Reebok','Adidas','Jordan','Woodland','Timberland');
        for ($i = 0; $i < 10; $i++) {
	     	DB::table('products')->insert([
	            'name' => $products[$i],
	            'image' => '/images/'.$i.'.jpg',
	            'price' => $i+100,
	        ]);
    	}
    }
}
