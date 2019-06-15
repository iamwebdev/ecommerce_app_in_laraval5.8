<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getAllProductList()
    {
    	return Product::all();
    }

    public function getProductById($productId)
    {
    	return Product::where('id', $productId)->first();
    }
}
