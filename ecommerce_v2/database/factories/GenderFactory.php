<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Gender;

class GenderFactory extends Factory
{
    protected $model = Gender::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Mujer', 'Hombre'])
        ];
    }
}
