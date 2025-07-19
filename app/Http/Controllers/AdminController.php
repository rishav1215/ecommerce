<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // dummy auth
        if ($request->email === 'admin@example.com' && $request->password === 'admin') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }
}
