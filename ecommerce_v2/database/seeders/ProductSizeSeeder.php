<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = Product::pluck('id')->toArray();
        $sizes = Size::pluck('id')->toArray();

        for ($i = 0; $i < 2; $i++) {
            foreach($products as $product) {
                DB::table('products_sizes')->insert([
                    'product_id' => $product, 
                    'size_id' => $faker->randomElement($sizes),
                ]);
            }
        }

    }
}
