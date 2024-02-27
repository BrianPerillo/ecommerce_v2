<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PanelController extends Controller
{
    
    public function show(){ 

        return view('panel.index');

    }

    
    public function adminLogIn(){ 

        return view('panel.login');

    }

    public function form(Request $request){ 

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

    public function formEdit(Request $request){ 

        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();
        
        switch ($request->section) {
            case 'products':
                return view('panel.edit_products_features')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
                break;
            case 'categories':
                return view('panel.edit_products_features')->with(compact('categories'));
                break;
            case 'subcategories':
                return view('panel.edit_products_features')->with(compact('subcategories', 'categories'));
                break;
            case 'sizes':
                return view('panel.edit_products_features')->with(compact('sizes'));
                break;  
            case 'colors':
                return view('panel.edit_products_features')->with(compact('colors'));
                break;
            case 'genders':
                return view('panel.edit_products_features')->with(compact('genders'));
                break;                             
            default:
                # code...
            break;
        }

    }

    public function saveProduct(Request $request){ 

        //Validaciones
        


        //Guardamos el producto
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->photo = 'https://www.solodeportes.com.ar/media/catalog/product/cache/3cb7d75bc2a65211451e92c5381048e9/r/e/remera-de-futbol-nike-dri-fit-academy-azul-510020dr1336451-1.jpg';
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->gender_id = $request->genders[0];
        $product->save();

        //Obtenemos todas las combinaciones de colores y talles
        $sizes = $request->input('sizes');
        $colors = $request->input('colors');

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

        /*//Guardo generos
        foreach ($sizes as $size) {
            DB::table('products_sizes')->insert([
                'product_id' => $product->id, 
                'size_id' => $size,
            ]);
        }*/

        //Guardamos Stock 
        $combinaciones = array();
        foreach ($sizes as $valor1) {
          foreach ($colors as $valor2) {
            $combinaciones[] = array($valor1, $valor2);
          }
        }

        foreach ($combinaciones as $combinacion) {
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->size_id = $combinacion[0];
            $stock->color_id = $combinacion[1];
            $stock->stock = $request->stock;
            $stock->save();
         }

        
        //Obtenemos features para enviarle a la vista
        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();


        //Guardar imagen
            if ($request->hasFile('file')) {
    
                $file = $request->file('file');
    
                // Guarda el archivo en carpeta "uploads"
                $path = Storage::putFileAs('public/product_images', $file, $file->getClientOriginalName());
                //$file->move(public_path('uploads/product_images'), $file->getClientOriginalName());
                // Devolucion de respuestas
                return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
                //return response()->json(['message' => 'Imagen cargada con éxito'], 200);
            } else {
                // Si no se encontró un archivo en la solicitud, devuelve un mensaje de error
                return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
                //return response()->json(['message' => 'No se encontró una imagen en la solicitud'], 400);
            }

        //return view('panel.products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes'));
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
            $color->color = $request->hexa;            
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

    public function editFeature(Request $request){ 

        if($request->feature == 'category'){

            $category = Category::where('id', $request->category)->get()->first();
            $category->name = $request->name;
            $category->save();
    
            $categories = Category::get()->all();
    
            return view('panel.edit_products_features')->with(compact('categories'));
        }
        elseif($request->feature == 'subcategory'){
            $subcategory = Subcategory::where('id', $request->subcategory)->get()->first();

            $subcategory->category_id = $request->related_category;
            $subcategory->name = $request->name;
            $subcategory->save();
    
            $subcategories = Subcategory::get()->all();
            $categories = Category::get()->all();

            return view('panel.edit_products_features')->with(compact('subcategories', 'categories'));
        }
        elseif($request->feature == 'size'){
            $size = Size::where('id', $request->size)->get()->first();

            $size->name = $request->name;
            $size->save();
    
            $sizes = Size::get()->all();
            
            return view('panel.edit_products_features')->with(compact('sizes'));
        }
        elseif($request->feature == 'color'){
            $color = Color::where('id', $request->color)->get()->first();

            $color->name = $request->name;
            $color->color = $request->hexa;            
            $color->save();
    
            $colors = Color::get()->all();
            
            return view('panel.edit_products_features')->with(compact('colors'));
        }        
        elseif($request->feature == 'gender'){
            $gender = Gender::where('id', $request->gender)->get()->first();

            $gender->name = $request->name;      
            $gender->save();
    
            $genders = Gender::get()->all();
            
            return view('panel.edit_products_features')->with(compact('genders'));
        }  
    }

}
