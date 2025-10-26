<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
//        return response()->json($googleUser);
        $user =User::updateOrCreate(
            [
                'google_id' => $googleUser->getId(),
            ],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );
        $this->downloadAndStoreAvatar($user, $googleUser->getAvatar());

        $token = $user->createToken('auth_token')->plainTextToken;

        $urlFrontend = env('FRONTEND_URL', 'http://localhost:9000');
        return redirect("{$urlFrontend}/auth/callback?token={$token}");
    }
    function downloadAndStoreAvatar(User $user, $avatarUrl) {
        $avatarContents = file_get_contents($avatarUrl);
        $avatarName = 'avatars/' . $user->id . '.jpg';
        Storage::disk('public')->put($avatarName, $avatarContents);
        $user->avatar = '/storage/' . $avatarName;
        $user->save();
    }
}
