<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\Product;
use App\Services\MercadoPagoService;
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

    public function __construct(
        private MercadoPagoService $mercadoPagoServices
    ) {}
    
    public function processPayment(){


        $this->mercadoPagoServices->cretePreference();
        
        
    }
}
