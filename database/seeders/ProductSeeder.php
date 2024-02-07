<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('name', '=', 'Remeras')->first();
        $subcategories = Subcategory::where('category_id', $category->id)->get();

        $category_id = $category->id;

        Product::factory()->count(4)->remera()->create([
            'category_id' => $category_id, 
            'subcategory_id' => $subcategories->random()->id,
            'gender_id' => 1
        ]);
        Product::factory()->count(4)->remera()->create([
            'category_id' => $category_id, 
            'subcategory_id' => $subcategories->random()->id,
            'gender_id' => 1
        ]);
        Product::factory()->count(4)->remera()->create([
            'category_id' => $category_id, 
            'subcategory_id' => $subcategories->random()->id,
            'gender_id' => 2
        ]);
    }
}
