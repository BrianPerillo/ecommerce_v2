<?php

namespace App\Http\Controllers;

use App\Events\OrderComplete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Pusher\PushNotifications\PushNotifications;
use Pusher\Pusher;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\VAPID;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_Product;
use App\Services\CarritoService;
use App\Services\MercadoPagoService;


class CartController extends Controller
{

    public function __construct(
        private MercadoPagoService $mercadoPagoServices,
        private CarritoService $carritoService
    ) {}
    
    public function index(User $user){
        
        // Esta manera quedó descartada porque no podía usar el paginate por eso los trigo abajo con la típica consulta de eloquent. 
        // $cart = $user->cart;
        // $cart_products = $cart[0]->products;

        $cart = Cart::where('user_id', "=", "$user->id")->get()->first();
        $cart_id = $cart->id;

        $cart_products = Cart_Product::where('cart_id', "$cart_id")->paginate(8);
    
        //dd(response()->json($products = $cart_products[0]->product_detail->images[0]));

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

            $this->carritoService->agregarProductoCarrito($request, $cart, $product);

            return Redirect::back();
           
    }
    
    public function processPayment(){

        // Enviar evento de pedido completado
        event(new OrderComplete('Nuevo Pedido'));

        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = env('SERVER_KEY');
    
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => 'title_test',
                "body" => 'body_test',  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response

        $order = $this->carritoService->createOrder();

        $preferencia = $this->mercadoPagoServices->createPreference($order->id);
        $preferencia_url = $preferencia->init_point;

        $user = auth()->user();

        return view('user.cart', $user)->with(compact('preferencia_url'));

    }

}
