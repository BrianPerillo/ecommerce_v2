<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    
    public function show(){ 

        return view('panel.index');

    }

    
    public function adminLogIn(){ 

        return view('panel.login');

    }

    public function formProducts(){ 

        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();

        return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));

    }

    public function saveProducts(Request $request){ 

        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->photo = 'asdf';
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->gender_id = 1;
        $product->save();

        
        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();

        return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
    }
}
