<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart_Product;

class Cart extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);

    }

    //Traigo los registro que haya en cart_products (los productos del carrito)
    public function products(){

        return $this->hasMany(Cart_Product::class);

    }



}
