<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('name', '=', 'Remeras')->first();
        $category_id = $category->id;

        Subcategory::factory()->count(3)->remera()->create(['category_id' => $category_id]);


        $category = Category::where('name', '=', 'Buzos')->first();
        $category_id = $category->id;

        Subcategory::factory()->count(2)->campera()->create(['category_id' => $category_id]);

        $category = Category::where('name', '=', 'Zapatillas')->first();
        $category_id = $category->id;

        Subcategory::factory()->count(2)->zapatilla()->create(['category_id' => $category_id]);
    }
}


