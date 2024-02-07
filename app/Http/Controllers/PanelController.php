<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    
    public function show(){ 

        return view('panel.index');

    }

    
    public function adminLogIn(){ 

        return view('panel.login');

    }

    public function saveproducts(){ 
dd('sdf');
        return view('panel.products');

    }

}
