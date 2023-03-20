<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminPassswordController extends Controller
{
    public function authenticate(User $user)
    {
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        User::where('id', $user->id)
            ->update(array('password' => $user->password));

        return redirect('/dashboard/users')->with('success', 'Berhasil reset kata sandi');
    }
}
