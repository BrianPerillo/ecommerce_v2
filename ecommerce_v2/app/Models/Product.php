<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Subcategory;
use App\Models\Cart_Product;

class Product extends Model
{
    use HasFactory;

    public function colors(){
        return $this->belongsToMany(Color::class, 'colors_products');
    }

    public function sizes(){
        return $this->belongsToMany(Size::class, 'products_sizes');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function carts_products(){

        return $this->hasMany(Cart_Product::class);

    }



}
