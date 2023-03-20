<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardPasswordController extends Controller
{
    public function index()
    {
        return view('dashboard/passwords/index', [
            'users' => User::where('id', auth()->user()->id)->get()
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi saat ini salah');
        }

        $user->password = Hash::make($request->password);
        User::where('id', $user->id)
            ->update(array('password' => $user->password));

        return back()->with('success', 'Kata sandi telah diperbarui');
    }
}
