<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/profiles/index', [
            'profiles' => Profil::all()
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profil $profile)
    {
        return view('dashboard/profiles/edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profile)
    {
        $rules = [
            'image' => 'image|file|max:1024',
            'profil' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
            'link_whatsapp' => 'required',
            'link_facebook' => 'required',
            'link_instagram' => 'required',
            'link_youtube' => 'required',
            'link_embed' => 'required',
        ];

        $validateData = $request->validate($rules);

        $currentImage = Profil::find($profile->id)->image;
        if ($request->file('image')) {
            if ($request->image != $currentImage) {

                $images = public_path('img/profile-images/') . $currentImage;

                if (file_exists($images)) {
                    @unlink($images);
                }
                $title = "image";
                $validateData['image']->move(public_path('img/profile-images'), $title);
                $validateData['image'] = $title;
            }
        }

        Profil::where('id', $profile->id)
            ->update($validateData);

        return redirect('/dashboard/profiles')->with('success', 'Profil telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profile)
    {
        //
    }
}
