<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // Tambahkan parameter prompt=select_account agar Google selalu menampilkan pilihan akun
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(uniqid()), // password random
                'email_verified_at' => now(), // selalu update jadi verified
            ]
        );

        Auth::login($user, true);

        return redirect('/'); // redirect ke halaman utama/dashboard
    }
}
