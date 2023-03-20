<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/users/index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard/users/show', [
            'user' => $user,
            'image' => 'default.png'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard/users/edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->is_active != null) {
            $rules['is_active'] = 'required';
        } else {
            $rules = [
                'nama' => 'required|max:255',
                'image' => 'image|file|max:1024',
                'alamat' => 'required|max:255',
                'telp' => 'required|max:255',
                'link_toko' => 'required'
            ];
        }
        $validateData = $request->validate($rules);

        $currentImage = User::find($user->id)->image;
        if ($request->file('image')) {
            if ($request->image != $currentImage) {

                $images = public_path('img/user-images/') . $currentImage;

                if (file_exists($images)) {
                    @unlink($images);
                }
                $name = $validateData['nama'] . '.' . $validateData['image']->getClientOriginalExtension();
                $validateData['image']->move(public_path('img/user-images'), $name);
                $validateData['image'] = $name;
            }
        }

        User::where('id', $user->id)
            ->update($validateData);

        return redirect('/dashboard/users')->with('success', 'Data user telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (File::exists(public_path('img/user-images/' . $user->image))) {
            File::delete(public_path('img/user-images/' . $user->image));
        }
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'Data telah dihapus');
    }

    public function authenticate(User $user)
    {
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        User::where('id', $user->id)
            ->update(array('password' => $user->password));

        return redirect('/dashboard/users')->with('success', 'Berhasil reset kata sandi');
    }
}
