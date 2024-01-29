<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class Cart_Product extends Model
{
    public $table = "cart_product";

    use HasFactory;

    public function cart(){

        return $this->belongsTo(Cart::class);

    }

    public function product_detail(){

        return $this->belongsTo(Product::class, 'product_id', 'id');

    }

    public function color(){

        return $this->belongsTo(Color::class);

    }

    public function size(){

        return $this->belongsTo(Size::class);

    }


    
}
