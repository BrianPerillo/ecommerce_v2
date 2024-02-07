<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Products;

class Order extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function products(){

        return $this->hasMany(Order_Products::class);

    }

}
