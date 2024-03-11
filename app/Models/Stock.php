<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function product_detail(){

        return $this->belongsTo(Product::class, 'product_id', 'id');

    }

    public function color(){

        return $this->belongsTo(Color::class, 'product_id', 'id');

    }

    public function size(){

        return $this->belongsTo(Size::class, 'product_id', 'id');

    }

}
