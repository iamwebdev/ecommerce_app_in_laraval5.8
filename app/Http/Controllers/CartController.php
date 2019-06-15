<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;

class CartController extends Controller
{
    public function getProducts()
    {
    	$objProduct = new Product;
    	$products = $objProduct->getAllProductList();
    	return view('product-listing',compact('products'));
    }

    public function showCart()
    {
        $cartItems = Session::get('cart-items');    
        return view('cart',compact('cartItems'));
    }

    public function setCartItems($productId, $quantity)
    {
        $objProduct = new Product;
        $product = $objProduct->getProductById($productId);
        $cartItems = Session::get('cart-items')?Session::get('cart-items'):array();
        $cartItems[$product->id] = array(
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'total_price' => $product->price*$quantity,
            'qty' => $quantity
        );   
        Session::put('cart-items', $cartItems);
        Session::save(); 
        return $cartItems;
    }

    public function addToCart($productId)
    { 
        $this->setCartItems($productId, 1);
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $cartItems = $this->setCartItems($request->itemId, $request->qty);
        return response()->json($cartItems);
    }

    public function removeCartItem($cartItemId)
    {
        $cartItems = Session::get('cart-items');      
        unset($cartItems[$cartItemId]);   
        Session::put('cart-items', $cartItems);
        Session::save();    
        return redirect()->back();
    }
    
}
