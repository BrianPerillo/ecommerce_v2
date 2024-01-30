<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Gender;
use Livewire\Component;

class CustomNavigationMenu extends Component
{

    public function render()
    {

        $categories = Category::get();
        $male = Gender::where('name','Hombre')->first();
        $female = Gender::where('name','Mujer')->first();

        return view('livewire.custom-navigation-menu', [
            'categories' => $categories,
            'male' => $male,
            'female' => $female,
        ]);
    }
}
