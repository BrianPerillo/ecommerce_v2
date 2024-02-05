<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TokenController extends Controller
{

    public function store_token(Request $request){ 
 
        $user = User::where('id', Auth::user()->id)->first();
        $user->device_token = $request->token;
        $user->save();
 
        return response()->json(['Token successfully stored.']);

    }


}
