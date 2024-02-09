<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                return view('panel.products_features')->with(compact('categories'));
                break;
            case 'subcategories':
                return view('panel.products_features')->with(compact('subcategories', 'categories'));
                break;
            case 'sizes':
                return view('panel.products_features')->with(compact('sizes'));
                break;  
            case 'colors':
                return view('panel.products_features')->with(compact('colors'));
                break;
            case 'genders':
                return view('panel.products_features')->with(compact('genders'));
                break;                             
            default:
                # code...
            break;
        }

    }

    public function saveProducts(Request $request){ 

        //Guardamos el producto
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->photo = 'https://www.solodeportes.com.ar/media/catalog/product/cache/3cb7d75bc2a65211451e92c5381048e9/r/e/remera-de-futbol-nike-dri-fit-academy-azul-510020dr1336451-1.jpg';
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->gender_id = $request->gender;
        $product->save();
   
        //Obtenemos todas las combinaciones de colores y talles
        $sizes = $request->sizes;
        $colors = $request->colors;

        //Guardamos combinaciones de producto colors y producto sizes
        foreach ($sizes as $size) {
            DB::table('products_sizes')->insert([
                'product_id' => $product->id, 
                'size_id' => $size,
            ]);
        }

        foreach ($colors as $color) {
            DB::table('colors_products')->insert([
                'product_id' => $product->id, 
                'color_id' => $color,
            ]);
         }

        /*
        $combinaciones = array();
        foreach ($sizes as $valor1) {
          foreach ($colors as $valor2) {
            $combinaciones[] = array($valor1, $valor2);
          }
        }

        foreach ($combinaciones as $combinacion) {
            DB::table('products_sizes')->insert([
                'product_id' => $product->id, 
                'size_id' => $combinacion[0],
            ]);
            DB::table('colors_products')->insert([
                'product_id' => $product->id, 
                'color_id' => $combinacion[1],
            ]);
         }
        */ 
        
        //Obtenemos features para enviarle a la vista
        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();

        return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
    }

    public function saveFeature(Request $request){ 

        if($request->feature == 'category'){
            $category = new Category();
    
            $category->name = $request->name;
            $category->save();
    
            $categories = Category::get()->all();
    
            return view('panel.products_features')->with(compact('categories'));
        }
        elseif($request->feature == 'subcategory'){
            $subcategory = new Subcategory();

            $subcategory->category_id = $request->related_category;
            $subcategory->name = $request->name;
            $subcategory->save();
    
            $subcategories = Subcategory::get()->all();
            $categories = Category::get()->all();

            return view('panel.products_features')->with(compact('subcategories', 'categories'));
        }
        elseif($request->feature == 'size'){
            $size = new Size();

            $size->name = $request->name;
            $size->save();
    
            $sizes = Size::get()->all();
            
            return view('panel.products_features')->with(compact('sizes'));
        }
        elseif($request->feature == 'color'){
            $color = new Color();

            $color->name = $request->name;
            $color->color = $request->color;            
            $color->save();
    
            $colors = Color::get()->all();
            
            return view('panel.products_features')->with(compact('colors'));
        }        
        elseif($request->feature == 'gender'){
            $gender = new Gender();

            $gender->name = $request->name;      
            $gender->save();
    
            $genders = Gender::get()->all();
            
            return view('panel.products_features')->with(compact('genders'));
        }  
    }

}
