<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Gender;
use App\Models\Size;

class ProductosController extends Controller
{

    public function home(){ 

        $destacados = Product::offset(32)->limit(3)->get()->all();
        $products = Product::get()->all();

        return view('index')->with(compact('destacados','products'));

    }
    
    public function index(Category $category, Gender $gender){
        //Ya no paso más los roducctos, sino que los consigue el componente de livewire para no tener problema con la paginación
        // // $products = $category->products;
        // $products = Product::where('category_id', '=', "$category->id")->where('gender_id', '=', "$gender->id")->get()->all();


        //Guardo datos para el compoonente:
        $category_id = $category->id;
        $gender_id = $gender->id;
        $name = $category->name;

        //Guardo subcategorias (para los filtros):
        $subcategories = Category::find("$category->id")->subcategories;
      
        //Guardo talles (para los filtros):
        $sizes = Size::get();

        return view('productos.category')->with(compact('name', 'category_id', 'gender_id', 'subcategories', 'sizes'));

    }

    public function show(Category $category, Product $product){

        $product = $product;
        $name = $category->name;

        return view('productos.show')->with(compact('name', 'product'));

    }


}
