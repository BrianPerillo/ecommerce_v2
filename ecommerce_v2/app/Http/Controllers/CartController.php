<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\Color;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    
    public function index(User $user){
        
        // Esta manera quedó descartada porque no podía usar el paginate por eso los trigo abajo con la típica consulta de eloquent. 
        // $cart = $user->cart;
        // $cart_products = $cart[0]->products;

        $cart = Cart::where('user_id', "=", "$user->id")->get()->first();
        $cart_id = $cart->id;

        $cart_products = Cart_Product::where('cart_id', "$cart_id")->paginate(8);

        return view('user.cart')->with(compact('cart_products'));

    }

    public function delete_cart(Cart_Product $cart_product){

        $cart_product->delete();

        return redirect()->back();

    }

    public function form_edit_cart(Cart_Product $cart_product){

        $edit = true;

        $user = auth()->user();

        $cart = Cart::where('user_id', "=", "$user->id")->get()->first();
        $cart_id = $cart->id;

        $cart_products = Cart_Product::where('cart_id', "$cart_id")->paginate(8);

        //Guardo datos para consultar colores y talles disponibles de ese producto a editar

        $id_product = $cart_product->product_detail->id;
        
        $product = Product::find("$id_product");

        //Guardo colores de ese producto

        $colors =  $product->colors;

        //Guardo talles de ese producto

        $sizes =  $product->sizes;

        //Paso id del cart_product a editar

        $cart_product_id = $cart_product->id;

        return view('user.cart')->with(compact('cart_products', 'edit', 'colors', 'sizes', 'cart_product_id'));

    }

   
    public function edit_cart(Cart_Product $cart_product, Request $request){


        //Recupero el producto del cart_product que se está recibiendo para recalcular el precio (total_price)

        $id_product = $cart_product->product_detail->id;
        
        $product = Product::find("$id_product");

        $product_price = $product->price;

        //Edito el cart product con lo que llega por request y el precio total recalculado

        $cart_product->quantity = $request->quantity;
        $cart_product->color_id = $request->color;
        $cart_product->size_id = $request->size;
        $cart_product->total_price = $product_price*$request->quantity;
        $cart_product->save();

        //Recupero productos del carrito para devolverlo a la vista cart
        $user = auth()->user();

        $cart = Cart::where('user_id', "=", "$user->id")->get()->first();

        $cart_id = $cart->id;
        $cart_products = Cart_Product::where('cart_id', "$cart_id")->paginate(8);


        return redirect()->route('user.cart', "$user->id");

    }


    public function agregar_al_carrito(Product $product, Request $request){
        
        //Pregunto si el usuario NO tiene un carrito y de ser así se lo creo y agrego el producto:
        //IMPORTANTE: ACÁ HABÍA UN IF QUE PREGUNTABA SI YA TENÍA CARRITO ESO AHORA NO ES NECESARIO YA QUE SIEMPRE VA A TENER CARRITO UN USUARIO REGISTRADO,
        //YA QUE SE LE CREA AUTOMÁTICAMENTE AL MOMENTO DE REGISRARSE.

        $request->validate([   

            'quantity' => 'required',
            'color' => 'required',
            'size' => 'required',

        ]);

        //Primero me aseguro que el producto que quiere agregar no exista en el carrito.

            //Recupero el carrito del usuario:
            $cart = auth()->user()->cart[0];

            //Recupero los productos de ese carrito:
            $cart_products = $cart->products;
            
            //Hago un foreach en el que consulto coincidencias
            foreach($cart_products as $cart_product){

                $product_id = $cart_product->product_id;
                $color_id = $cart_product->color_id;
                $size_id = $cart_product->size_id;

                
                //Si el producto que está queriendo agregar ya existe en el carrito (Hay coincidencia):
                if($product_id == $product->id && $color_id == $request->color && $size_id == $request->size){


                    $message = "Este producto ya existe en tu carrito con el mismo talle y color. Podés editar la cantidad desde tu carrito!";
                    $type = "warning";

                    session()->forget('message'); 
                    session()->forget('type'); 

                    session()->put('message', "$message");
                    session()->put('type', "$type");

                    return Redirect::back();

                }

            }


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


                return Redirect::back();
           
    }



}
