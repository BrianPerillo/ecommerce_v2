<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;

    public function products(){
        $this->hasMany(Product::class);

    }

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

}
