<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;

class LoginController extends Controller
{
    public function index()
    {
        return view('home/login/index', [
            'title' => 'Login',
            "profiles" => Profil::all()
        ]);
    }

    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;


        if (Auth::attempt(['email' => $email, 'password' => $password, 'is_active' => 1])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/catalogs');
        }
        return back()->with('loginError', 'login failed!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
