<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = Product::pluck('id')->toArray();
        $colors = Color::pluck('id')->toArray();

        for ($i = 0; $i < 2; $i++) {
            foreach($products as $product) {
                DB::table('colors_products')->insert([
                    'product_id' => $product, 
                    'color_id' => $faker->randomElement($colors),
                ]);
            }
        }
        /*ColorPr::factory()->count(4)->remera()->create([
            'product_id' => $faker->randomElement($products), 
            'color_id' => $faker->randomElement($colors),
        ]);*/
    }
}
