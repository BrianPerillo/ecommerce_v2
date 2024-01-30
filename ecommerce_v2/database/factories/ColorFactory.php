<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;


class ColorFactory extends Factory
{

    protected $model = Color::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Azul', 'Negro', 'Rojo','Blanco','Amarillo', 'Verde']),
            'color' => $this->faker->unique()->randomElement(['#000000', '#00008B', '#FF0000','#FFFAF0','#FFD700', '#008000']),
        ];
    }
}
