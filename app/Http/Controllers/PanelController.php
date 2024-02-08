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

    public function formProducts(Request $request){ 

        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();
        
        switch ($request->section) {
            case 'products':
                return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
                break;
            case 'categories':
                return view('panel.categories')->with(compact('categories'));
                break;;
                break;
            case 'subcategories':
                return view('panel.products');
                break;
            case 'sizes':
                return view('panel.products');
                break;  
            case 'colors':
                return view('panel.products');
                break;
            case 'genders':
                return view('panel.products');
                break;                             
            default:
                # code...
            break;
        }

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

    public function saveCategory(Request $request){ 

        $category = new Category();
    
        $category->name = $request->name;
        $category->save();

        $categories = Category::get()->all();

        return view('panel.categories')->with(compact('categories'));
    }

}
