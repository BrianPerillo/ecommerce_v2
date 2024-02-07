<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{

    protected $model = Subcategory::class;

    public function definition()
    {
        return [];
    }


    public function remera()
    {

        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement(['Sin manga', 'Manga larga', 'Manga corta'])
            ];
        });

    }

    
    public function campera()
    {
        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement(['Buzo Canguro', 'Buzo Clásico'])
            ];
        });
    }

    public function zapatilla()
    {

        return $this->state(function (array $attributes){
            return [
                'name' => $this->faker->unique()->randomElement(['Zapatilla Runnig', 'Zapatilla Sport'])
            ];
        });
    } 
};
