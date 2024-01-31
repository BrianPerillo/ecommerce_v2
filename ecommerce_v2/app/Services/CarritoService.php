<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\Order;
use App\Models\Order_Products;
use Illuminate\Support\Facades\Auth;
class CarritoService
{
    public function __construct()
    {}

    public function agregarProductoCarrito($request, $cart, $product){

        $cart_product = new Cart_Product();

        $cart_product->product_id = $product->id;
        $cart_product->cart_id = $cart->id;
        $cart_product->quantity = $request->quantity;
        $cart_product->total_price = $request->quantity*$product->price;
        $cart_product->color_id = $request->color;
        $cart_product->size_id = $request->size;
        $cart_product->save();
        

        $message = "Producto Agregado al carrito!";
        $type = "success";

        session()->forget('message'); 
        session()->forget('type'); 
        session()->put('message', "$message");
        session()->put('type', "$type");
        
    }

    public function createOrder()
    {
        $user_id = Auth::user()->id;
        $user_cart = Cart::where('user_id', $user_id)->first();
        $user_products = Cart_product::where('cart_id', $user_cart->id)->get();

        $order = new Order();
        $order->user_id = $user_id;
        $order->save();

        foreach($user_products as $product){
            $order_product = new Order_Products();
            $order_product->order_id = $order->id;
            $order_product->product_id = $product->product_id;
            $order_product->color_id = $product->color_id;
            $order_product->size_id = $product->size_id;
            $order_product->quantity = $product->quantity;
            $order_product->price = $product->total_price;
            $order_product->save();
        }  
    }
}