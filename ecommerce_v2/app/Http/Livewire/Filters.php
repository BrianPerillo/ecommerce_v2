<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use Livewire\WithPagination;

class Filters extends Component
{

    public $name;
    public $subcategories;
    public $sizes;
    public $categoryId;
    public $genderId;
    public $subcategorySelected;
    public $sizeSelected;
   

    use WithPagination;


    public function render()
    {
        
        $categoryId = $this->categoryId;
        $genderId = $this->genderId;

        // $products = $category->products;
        $subcategorySelected = $this->subcategorySelected;
        $sizeSelected = $this->sizeSelected;

        if(strlen($this->subcategorySelected)>0 && strlen($this->sizeSelected)==0){
            return view('livewire.filters', [
                'products' => Product::where('category_id', '=', "$categoryId")->where('gender_id', '=', "$genderId")->where('subcategory_id', '=', "$subcategorySelected")->paginate(9),
            ]);
        }
        if(strlen($this->sizeSelected)>0 && strlen($this->subcategorySelected)>0){
            return view('livewire.filters', [
                'products' => Product::join('products_sizes', 'products_sizes.product_id', '=', 'products.id')->where('products_sizes.size_id', '=', "$sizeSelected")->where('category_id', '=', "$categoryId")->where('subcategory_id', '=', "$subcategorySelected")->where('gender_id', '=', "$genderId")->select('products.*', 'products_sizes.product_id')->paginate(9),
            ]);    
        }
        if(strlen($this->sizeSelected)>0 && strlen($this->subcategorySelected)==0){
            return view('livewire.filters', [
                'products' => Product::join('products_sizes', 'products_sizes.product_id', '=', 'products.id')->where('products_sizes.size_id', '=', "$sizeSelected")->where('category_id', '=', "$categoryId")->where('gender_id', '=', "$genderId")->select('products.*', 'products_sizes.product_id')->paginate(9),
            ]);    
        }
        else{
            return view('livewire.filters', [
                'products' => Product::where('category_id', '=', "$categoryId")->where('gender_id', '=', "$genderId")->paginate(9),
            ]);
        }



    }

    public function filterSubcategory($id) {

        if($this->subcategorySelected!=$id){
            
            $this->subcategorySelected = $id;

        }

        else if($this->subcategorySelected==$id){
            
            $this->subcategorySelected = '';

        }
        

    }

    public function filterSize($id) {
 
        if($this->sizeSelected!=$id){
            
            $this->sizeSelected = $id;

        }

        else if($this->sizeSelected==$id){
            
            $this->sizeSelected = '';

        }
        
    }

}
