<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Products extends Model
{
    public $table = "order_products";

    use HasFactory;

    public function order(){

        return $this->belongsTo(Order::class);

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
