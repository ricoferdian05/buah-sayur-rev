<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index()
    {
        return view('home/signup/index', [
            'title' => 'Signup',
            "profiles" => Profil::all()
        ]);
    }

    public function authenticate(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'telp' => 'required|max:255',
            'alamat' => 'required|max:255',
            'is_active' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);

        return redirect('/home/login')->with('success', 'Berhasil melakukan registrasi, silakan login!');
    }
}
