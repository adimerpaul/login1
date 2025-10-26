<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller {
    public function redirect() {
        return Socialite::driver('google')
            ->scopes(['email','profile'])
            ->stateless()           // ← sin sesión
            ->redirect();
    }
    public function callback() {
        $googleUser = Socialite::driver('google')->stateless()->user();
        return response()->json($googleUser);
    }
}
