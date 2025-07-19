<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
      public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
       if (Auth::attempt($request->only('email', 'password'))) {
    return redirect()->intended('/');
}


        return back()->withErrors(['Invalid credentials']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
