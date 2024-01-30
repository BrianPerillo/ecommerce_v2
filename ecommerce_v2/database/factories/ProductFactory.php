<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [];
    }

    public function remera()
    {

        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement([
                    'Nike Dri-Fit Academy',
                    'Nike Air Max Tee',
                    'Nike Sportswear Club',
                    'Nike Court Dri-Fit',
                    'Nike Air Max Plus Tee',
                    'Adidas Adicolor Classics',
                    'Adidas Originals Trefoil',
                    'Adidas Tiro 21',
                    'Adidas Own The Game',
                    'Puma Classics',
                    'Puma Archive',
                    'Puma RS-X',
            ]),
                'description' => $this->faker->text(),
                'price' => $this->faker->randomFloat(2,10,100),
                'gender_id' => $this->faker->numberBetween(1,2),
                'photo' => $this->faker->unique()->randomElement([
                    'https://www.solodeportes.com.ar/media/catalog/product/cache/3cb7d75bc2a65211451e92c5381048e9/r/e/remera-de-futbol-nike-dri-fit-academy-azul-510020dr1336451-1.jpg',
                    'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nike.com%2Fin%2Ft%2Fsportswear-air-max-t-shirt-GW3cCd&psig=AOvVaw2IDd7H3VGPTGEkK2f4vJ7c&ust=1706733241604000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOjd-Pf6hYQDFQAAAAAdAAAAABAG',
                    'https://nikearprod.vtexassets.com/arquivos/ids/792314-1200-1200?v=638379201328530000&width=1200&height=1200&aspect=true',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw8fa11a84/products/NI_DD8540-482/NI_DD8540-482-1.JPG',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dwea4d9cab/products/NIFD1242-010/NIFD1242-010-1.JPG',
                    'https://woker.vtexassets.com/arquivos/ids/403147-1200-1200?v=638325467356600000&width=1200&height=1200&aspect=true',
                    'https://www.tripstore.com.ar/media/catalog/product/cache/4769e4d9f3516e60f2b4303f8e5014a8/H/2/H25245_0.jpg',
                    'https://www.tradeinn.com/f/13795/137957997/adidas-chaqueta-tiro-21-training.jpg',
                    'https://sporting.vtexassets.com/arquivos/ids/805920-1200-1200?width=1200&height=1200&aspect=true',
                    'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1536,h_1536/global/538069/51/mod01/fnd/ARG/fmt/png',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw581127a2/products/PU678281-43/PU678281-43-1.JPG',
                    'https://megasports.vteximg.com.br/arquivos/ids/221122-1000-1000/65276602001_0.jpg?v=638176019617830000',
                ])
            ];
        });

    }


    public function zapatilla()
    {

        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement([
                    'Nike Dri-Fit Academy',
                    'Nike Air Max Tee',
                    'Nike Sportswear Club',
                    'Nike Court Dri-Fit',
                    'Nike Air Max Plus Tee',
                    'Adidas Adicolor Classics',
                    'Adidas Originals Trefoil',
                    'Adidas Tiro 21',
                    'Adidas Own The Game',
                    'Puma Classics',
                    'Puma Archive',
                    'Puma RS-X',
            ]),
                'description' => $this->faker->text(),
                'price' => $this->faker->randomFloat(2,10,100),
                'gender_id' => $this->faker->numberBetween(1,2),
                'photo' => $this->faker->unique()->randomElement([
                    'https://www.solodeportes.com.ar/media/catalog/product/cache/3cb7d75bc2a65211451e92c5381048e9/r/e/remera-de-futbol-nike-dri-fit-academy-azul-510020dr1336451-1.jpg',
                    'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nike.com%2Fin%2Ft%2Fsportswear-air-max-t-shirt-GW3cCd&psig=AOvVaw2IDd7H3VGPTGEkK2f4vJ7c&ust=1706733241604000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOjd-Pf6hYQDFQAAAAAdAAAAABAG',
                    'https://nikearprod.vtexassets.com/arquivos/ids/792314-1200-1200?v=638379201328530000&width=1200&height=1200&aspect=true',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw8fa11a84/products/NI_DD8540-482/NI_DD8540-482-1.JPG',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dwea4d9cab/products/NIFD1242-010/NIFD1242-010-1.JPG',
                    'https://woker.vtexassets.com/arquivos/ids/403147-1200-1200?v=638325467356600000&width=1200&height=1200&aspect=true',
                    'https://www.tripstore.com.ar/media/catalog/product/cache/4769e4d9f3516e60f2b4303f8e5014a8/H/2/H25245_0.jpg',
                    'https://www.tradeinn.com/f/13795/137957997/adidas-chaqueta-tiro-21-training.jpg',
                    'https://sporting.vtexassets.com/arquivos/ids/805920-1200-1200?width=1200&height=1200&aspect=true',
                    'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1536,h_1536/global/538069/51/mod01/fnd/ARG/fmt/png',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw581127a2/products/PU678281-43/PU678281-43-1.JPG',
                    'https://megasports.vteximg.com.br/arquivos/ids/221122-1000-1000/65276602001_0.jpg?v=638176019617830000',
                ])
            ];
        });

    }    

    public function buzo()
    {

        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement([
                    'Nike Dri-Fit Academy',
                    'Nike Air Max Tee',
                    'Nike Sportswear Club',
                    'Nike Court Dri-Fit',
                    'Nike Air Max Plus Tee',
                    'Adidas Adicolor Classics',
                    'Adidas Originals Trefoil',
                    'Adidas Tiro 21',
                    'Adidas Own The Game',
                    'Puma Classics',
                    'Puma Archive',
                    'Puma RS-X',
            ]),
                'description' => $this->faker->text(),
                'price' => $this->faker->randomFloat(2,10,100),
                'gender_id' => $this->faker->numberBetween(1,2),
                'photo' => $this->faker->unique()->randomElement([
                    'https://www.solodeportes.com.ar/media/catalog/product/cache/3cb7d75bc2a65211451e92c5381048e9/r/e/remera-de-futbol-nike-dri-fit-academy-azul-510020dr1336451-1.jpg',
                    'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nike.com%2Fin%2Ft%2Fsportswear-air-max-t-shirt-GW3cCd&psig=AOvVaw2IDd7H3VGPTGEkK2f4vJ7c&ust=1706733241604000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOjd-Pf6hYQDFQAAAAAdAAAAABAG',
                    'https://nikearprod.vtexassets.com/arquivos/ids/792314-1200-1200?v=638379201328530000&width=1200&height=1200&aspect=true',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw8fa11a84/products/NI_DD8540-482/NI_DD8540-482-1.JPG',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dwea4d9cab/products/NIFD1242-010/NIFD1242-010-1.JPG',
                    'https://woker.vtexassets.com/arquivos/ids/403147-1200-1200?v=638325467356600000&width=1200&height=1200&aspect=true',
                    'https://www.tripstore.com.ar/media/catalog/product/cache/4769e4d9f3516e60f2b4303f8e5014a8/H/2/H25245_0.jpg',
                    'https://www.tradeinn.com/f/13795/137957997/adidas-chaqueta-tiro-21-training.jpg',
                    'https://sporting.vtexassets.com/arquivos/ids/805920-1200-1200?width=1200&height=1200&aspect=true',
                    'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1536,h_1536/global/538069/51/mod01/fnd/ARG/fmt/png',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw581127a2/products/PU678281-43/PU678281-43-1.JPG',
                    'https://megasports.vteximg.com.br/arquivos/ids/221122-1000-1000/65276602001_0.jpg?v=638176019617830000',
                ])
            ];
        });

    }   

    public function pantalon()
    {

        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement([
                    'Nike Dri-Fit Academy',
                    'Nike Air Max Tee',
                    'Nike Sportswear Club',
                    'Nike Court Dri-Fit',
                    'Nike Air Max Plus Tee',
                    'Adidas Adicolor Classics',
                    'Adidas Originals Trefoil',
                    'Adidas Tiro 21',
                    'Adidas Own The Game',
                    'Puma Classics',
                    'Puma Archive',
                    'Puma RS-X',
            ]),
                'description' => $this->faker->text(),
                'price' => $this->faker->randomFloat(2,10,100),
                'gender_id' => $this->faker->numberBetween(1,2),
                'photo' => $this->faker->unique()->randomElement([
                    'https://www.solodeportes.com.ar/media/catalog/product/cache/3cb7d75bc2a65211451e92c5381048e9/r/e/remera-de-futbol-nike-dri-fit-academy-azul-510020dr1336451-1.jpg',
                    'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nike.com%2Fin%2Ft%2Fsportswear-air-max-t-shirt-GW3cCd&psig=AOvVaw2IDd7H3VGPTGEkK2f4vJ7c&ust=1706733241604000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOjd-Pf6hYQDFQAAAAAdAAAAABAG',
                    'https://nikearprod.vtexassets.com/arquivos/ids/792314-1200-1200?v=638379201328530000&width=1200&height=1200&aspect=true',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw8fa11a84/products/NI_DD8540-482/NI_DD8540-482-1.JPG',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dwea4d9cab/products/NIFD1242-010/NIFD1242-010-1.JPG',
                    'https://woker.vtexassets.com/arquivos/ids/403147-1200-1200?v=638325467356600000&width=1200&height=1200&aspect=true',
                    'https://www.tripstore.com.ar/media/catalog/product/cache/4769e4d9f3516e60f2b4303f8e5014a8/H/2/H25245_0.jpg',
                    'https://www.tradeinn.com/f/13795/137957997/adidas-chaqueta-tiro-21-training.jpg',
                    'https://sporting.vtexassets.com/arquivos/ids/805920-1200-1200?width=1200&height=1200&aspect=true',
                    'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1536,h_1536/global/538069/51/mod01/fnd/ARG/fmt/png',
                    'https://www.dexter.com.ar/on/demandware.static/-/Sites-365-dabra-catalog/default/dw581127a2/products/PU678281-43/PU678281-43-1.JPG',
                    'https://megasports.vteximg.com.br/arquivos/ids/221122-1000-1000/65276602001_0.jpg?v=638176019617830000',
                ])
            ];
        });

    }   


}
