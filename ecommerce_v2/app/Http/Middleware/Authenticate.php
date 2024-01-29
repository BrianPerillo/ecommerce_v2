<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    
    protected function redirectTo($request)
    {   
        //Guardo url previa en session para poder recuperarla en el archivo "RedirectIfAuthenticated.php" que es el que redirige al usuario logueado donde 
        //le indiquemos, entonces ahí recupero la url guardada en sesión y lo redirijo a la misma página en la que estaba.
        $previous_url = URL::previous();
        $request->session()->put('previous_url', "$previous_url");

        if (! $request->expectsJson()) {
            
            return route('login');
        }

        
    }
}
