<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart_Product;
use App\Services;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoService
{
    public function __construct()
    {
        //Setea Token de Acceso
        MercadoPagoConfig::setAccessToken(env("MERCADOPAGO_ACCESS_TOKEN"));
    }

    public function cretePreference()
    {
        $client = new PreferenceClient();

        //Recupersamos el id del usuario logueado
        $user_id = Auth::id();

        //Recuperamos su carrito para consultar sus productos
        $cart = Cart::where('user_id', "=", "$user_id")->get()->first();

        $cart_products = Cart_Product::where('cart_id', " $cart->id")->get();
        
        //Guardamos los datos necesarios de cada producto del carrito para pasarselos al metodo create de MP para crear la preferencia
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
            "external_reference" => "1", //Es el ID de compra
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

        return $preference;
    }
}