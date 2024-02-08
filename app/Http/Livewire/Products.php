<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Products extends Component
{

    
    public $name;
    public $description;
    public $photo;
    public $categoryId;
    public $subcategoryID;
    public $genderId;
    public $sizes;
    public $colors;
    public $price;
    public $stock;
   

    public function render()
    {

            /*$cart_product = new Cart_Product();
    
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
            session()->put('type', "$type");*/

        return view('livewire.products');
    }
}
