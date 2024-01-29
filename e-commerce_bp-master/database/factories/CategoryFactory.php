<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {

        $categories = ['Remeras', 'Zapatillas', 'Camperas', 'Buzos'];

        return [
            'name' => $this->faker->unique()->randomElement($categories)
        ];
    }
}
