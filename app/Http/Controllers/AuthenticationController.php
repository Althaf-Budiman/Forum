<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function registerView()
    {
        return view('auth.register');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'profile_photo_path' => 'image|mimes:png,jpg',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Upload Gambar
        if ($request->hasFile('profile_photo_path')) {
            $profile_photo_path = $request->file('profile_photo_path')->store('profile-photos');
        } else {
            $profile_photo_path = 'profile-photos/default-profile-photo.png';
        }

        $user = User::create([
            'profile_photo_path' => $profile_photo_path,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user, true);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'password' => 'Email or your password is wrong.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
