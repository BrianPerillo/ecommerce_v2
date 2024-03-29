<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Subcategory;
use App\Models\User;
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

    //Formularios para crear registros
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

    //Formularios para editar registros
    public function formEdit(Request $request){ 

        $products = Product::with('images')->get()->all();
        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();

        switch ($request->section) {
            case 'products':
                return view('panel.edit_products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes', 'products'));
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

    public function formDelete(Request $request){ 

        $products = Product::with('images')->get()->all();
        $categories = Category::get()->all();
        $subcategories = Subcategory::get()->all();
        $genders = Gender::get()->all();
        $colors = Color::get()->all();
        $sizes = Size::get()->all();

        switch ($request->section) {
            case 'products':
                return view('panel.delete_products')->with(compact('categories', 'subcategories', 'genders', 'colors', 'sizes', 'products'));
                break;
            case 'categories':
                return view('panel.delete_products_features')->with(compact('categories'));
                break;
            case 'subcategories':
                return view('panel.delete_products_features')->with(compact('subcategories', 'categories'));
                break;
            case 'sizes':
                return view('panel.delete_products_features')->with(compact('sizes'));
                break;  
            case 'colors':
                return view('panel.delete_products_features')->with(compact('colors'));
                break;
            case 'genders':
                return view('panel.delete_products_features')->with(compact('genders'));
                break;                             
            default:
                # code...
            break;
        }

    }

    
    //Esta función devuelve los datos del producto a editar
    public function findProduct(Request $request){
    
        $product_data = Product::with('sizes','colors','category','subcategory', 'images')->where('id', $request->product)->first();

        return response()->json($product_data);

    }

    public function saveProduct(Request $request){ 

        //Validaciones
        
        // Imagen
        $this->validate($request, [
            'file' => 'required|image|max:3072',
        ]);


        //Guardamos el producto
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
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
                
                $image = new Image();
                $image->product_id = $product->id;
                $image->image_name = $file->getClientOriginalName();
                $image->save();

                //$file->move(public_path('uploads/product_images'), $file->getClientOriginalName());
                //return response()->json(['message' => 'Imagen cargada con éxito'], 200);
            } else {
                // Si no se encontró un archivo en la solicitud, devuelve un mensaje de errorW
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


    public function editProduct(Request $request){

        //return response()->json($request);

        //Validaciones
        // Imagen
        /*$this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);*/

        //return response()->json($request);
        //Se recupera el producto y se actualizan datos
        $product = Product::where('id', $request->product)->get()->first();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->gender_id = $request->genders[0];
        $product->save();
        
        //Obtenemos todas las combinaciones de colores y talles
        $sizes = $request->input('sizes');
        $colors = $request->input('colors');

        //Consulta las combinaciones de colores para sobreescribirlas
        //$tallesProducto = DB::table('products_sizes')->where('product_id', $request->product)->get();

        //Elimina las combinaciones de talles y colores preexistentes para que se eliminen las necesarias en tablas products_sizes & colors_products
        DB::table('products_sizes')->where('product_id', $request->product)->delete();
        DB::table('colors_products')->where('product_id', $request->product)->delete();

        //Guardado de combinaciones de producto colors y producto sizes
        foreach ($sizes as $size) {
            DB::table('products_sizes')->insert([
                'product_id' => $request->product, 
                'size_id' => $size,
            ]);
        }

        foreach ($colors as $color) {
            DB::table('colors_products')->insert([
                'product_id' => $request->product, 
                'color_id' => $color,
            ]);
        }
       
        //Eliminación en la tabla Stock de combinaciones de talles y colores que esten en la tabla stocks pero no vengan en la request.
        Stock::where('product_id', $request->product)
            ->whereNotIn('size_id', $sizes) //whereNotIn trae los talles que no estén en $sizes, variable que contiene los sizes de la request
            ->delete(); //Elimina los sizes que no vinieron en la request pero estaban en la base.

        Stock::where('product_id', $request->product)
            ->whereNotIn('color_id', $colors)
            ->delete();

        // Obtener los talles y colores existentes en la tabla Stock
        $existingSizes = Stock::where('product_id', $request->product)->pluck('size_id')->all();
        $existingColors = Stock::where('product_id', $request->product)->pluck('color_id')->all();
       
        foreach ($sizes as $size) { 
            foreach ($colors as $color) {
                // Verificar si la combinación de color y talla ya existe en la base de datos
                $existingStock = Stock::where('product_id', $request->product)
                    ->where('size_id', $size)
                    ->where('color_id', $color)
                    ->first();
        
                // Si no existe, crear una nueva combinación
                if (!$existingStock) {
                    $stock = new Stock();
                    $stock->product_id = $request->product;
                    $stock->size_id = $size;
                    $stock->color_id = $color;
                    $stock->stock = 10; //Se crea por defecto con Stock 10, luego se puede editar desde el apartado de Stock
                    $stock->save();

                    // Actualizar los arrays de talles y colores existentes
                    if (!in_array($size, $existingSizes)) {
                        $existingSizes[] = $size;
                    }
                    if (!in_array($color, $existingColors)) {
                        $existingColors[] = $color;
                    }
                }
            }
        }    



       /*//Guardo generos
       foreach ($sizes as $size) {
           DB::table('products_sizes')->insert([
               'product_id' => $product->id, 
               'size_id' => $size,
           ]);
       }*/
       
        //Eliminar imagen si se envió el array delete_imagenes
        $images = Image::where('product_id', $request->product)->pluck('image_name')->all();

        if (isset($request->all()['delete_images'])) {
           
            //Recorrido por el array delete_images para eliminar las imagenes
            foreach ($request->delete_images as $image_name) {
                //Antes de eliminar se chequea que exista una imagen con el nombre dado en la base, ya que podría llegar a ocurrir que no exista el nombre.
                if(in_array($image_name, $images)){
                    //Si existe se elimina
                    Image::where('image_name', $image_name)->delete();
                }else{
                return response()->json("No existe la imagen con nombre" . $image_name);}
            }
        }

        //Guardar imagenes nuevas
        //No es necesario iterar nada ya que si se quiere enviar más de una imagen dropzone realiza envios por separa por c/imagen si son dos hace 2 envios.
        if ($request->hasFile('file')) {
    
            $file = $request->file('file');

            // Guarda el archivo en carpeta "uploads"
            $path = Storage::putFileAs('public/product_images', $file, $file->getClientOriginalName());
            
            $image = new Image();
            $image->product_id = $product->id;
            $image->image_name = $file->getClientOriginalName();
            $image->save();

            //$file->move(public_path('uploads/product_images'), $file->getClientOriginalName());
            //return response()->json(['message' => 'Imagen cargada con éxito'], 200);
        } else {

        }

        return response()->json($request);

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

    public function deleteProduct(Request $request){

        //$product = Product::find($request->product);

        //return response()->json($product);

        Product::find($request->product)->delete();

        return redirect()->back();

    }

    public function deleteFeature(Request $request){

        if($request->feature == 'category'){
            $category = Category::where('id', $request->category)->delete();
    
            return redirect()->back();
        }
        elseif($request->feature == 'subcategory'){
           
            $subcategory = Subcategory::where('id', $request->subcategory)->delete();

            return redirect()->back();
        }
        elseif($request->feature == 'size'){

            //ConfirmDelete permite saber si el usuario confirma el delte pese a las advertencias (el message en session flash)
            if(isset($request->confirmDelete) && $request->confirmDelete){
                $size = Size::where('id', $request->size)->delete();
            }

            //Consuta si existen productos disponibles solamente en el talle que se quiere eliminar
            $products = Product::with('sizes')
            ->whereHas('sizes', function ($query) use ($request) {
                $query->where('size_id', $request->size);
            })
            ->whereDoesntHave('sizes', function ($query) use ($request) {
                $query->where('size_id', '!=', $request->size);
            })
            ->get()->all();

            //Si no hay productos que estén disponibles solamente en el talle a eliminar:
            if(empty($products)){
                $size = Size::where('id', $request->size)->delete();
            }
            else{//Si los hay, se advierte al usuario
                $request->session()->flash('sizeToDelete', $request->size);
                $request->session()->flash('message', 'Hay productos que solo se encuentran disponibles en el talle que deseas eliminar.');
                $request->session()->flash('products', $products);
                return redirect()->back();
            }

            return redirect()->back();
        }
        elseif($request->feature == 'color'){
      
            //ConfirmDelete permite saber si el usuario confirma el delte pese a las advertencias (message en session flash)
            if(isset($request->confirmDelete) && $request->confirmDelete){
                $size = Color::where('id', $request->color)->delete();
            }

            //Consuta si existen productos disponibles solamente en el color que se quiere eliminar
            $products = Product::with('colors')
            ->whereHas('colors', function ($query) use ($request) {
                $query->where('color_id', $request->color);
            })
            ->whereDoesntHave('colors', function ($query) use ($request) {
                $query->where('color_id', '!=', $request->color);
            })
            ->get()->all();

            //Si no hay productos que estén disponibles solamente en el talle a eliminar:
            if(empty($products)){
                $color = Color::where('id', $request->color)->delete();
            }
            else{//Si los hay, se advierte al usuario
                $request->session()->flash('colorToDelete', $request->color);
                $request->session()->flash('message', 'Hay productos que solo se encuentran disponibles en el color que deseas eliminar.');
                $request->session()->flash('products', $products);
                return redirect()->back();
            }

            return redirect()->back();
        }        
        elseif($request->feature == 'gender'){
            $gender = Gender::where('id', $request->gender)->get()->first();

            $gender->name = $request->name;      
            $gender->save();
    
            $genders = Gender::get()->all();
            
            return view('panel.edit_products_features')->with(compact('genders'));
        }        

    }

    public function dataAnalisis(Request $request){

        //Por ahora en lugar de mostrar ventas se muestran ordenes.
        $orders = Order::with('products.product_detail.category', 'products.product_detail.subcategory', 'products.product_detail', 'products.color', 'products.size')->get()->all();
        //dd(response()->json($orders));

        //Guardo los productos que se encuentran en ordenes
        $products = [];

        foreach($orders as $order){
            foreach($order['products'] as $product){
                $products[] = [
                    'name' => $product->product_detail['name'],
                    'order_id' => $order['id']
                ];
            }
        }

        //$ordersPorProducto = Order::with('products.product_detail')->get()->all();
     
        $stocks = Stock::with('product_detail', 'product_detail.category', 'product_detail.subcategory', 'color', 'size')->get()->all();

        $users = User::get()->all();

        return view('panel.data_analisis')->with(compact('orders', 'stocks', 'users', 'products'));

    }



}
