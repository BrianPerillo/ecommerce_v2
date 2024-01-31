<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\Product;
use Illuminate\Http\Request;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Preference;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    
    public function processPayment(){

        MercadoPagoConfig::setAccessToken(env("MERCADOPAGO_ACCESS_TOKEN"));

        $client = new PreferenceClient();

        //Recupersamos el id del usuario logueado
        $user_id = Auth::id();

        //Recuperamos su carrito para consultar sus productos
        $cart = Cart::where('user_id', "=", "$user_id")->get()->first();

        $cart_products = Cart_Product::where('cart_id', " $cart->id")->get();
   
        
        $products = [];

        foreach($cart_products as $cart){
            $products[] = [
                "id" => "1",
                "title" => $cart->product_detail->name,
                "description" => $cart->product_detail->description,
                "picture_url" => $cart->product_detail->photo,
                "category_id" => $cart->product_detail->category_id,
                "quantity" => $cart->quantity,
                "currency_id" => "ARG",
                "unit_price" => $cart->product_detail->price,
            ];
        }

        $preference = $client->create([
            "external_reference" => "teste",
            "items"=> $products,
            "payment_methods" => [
            "default_payment_method_id" => "master",
            "excluded_payment_types" => array(
              array(
                "id" => "ticket"
              )
            ),
            "installments"  => 12,
            "default_installments" => 1
        ]]);

        dd($preference);
        
    }
}
