<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminSatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/units/index', [
            'units' => Satuan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/units/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_satuan' => 'required|max:255',
            'slug' => 'required|unique:satuan'
        ]);

        Satuan::create($validateData);

        return redirect('/dashboard/units')->with('success', 'Satuan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $unit)
    {
        return view('dashboard/units/edit', [
            'unit' => $unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $unit)
    {
        $rules = [
            'nama_satuan' => 'required|max:255'
        ];

        if ($request->slug != $unit->slug) {
            $rules['slug'] = 'required|unique:satuan';
        }

        $validateData = $request->validate($rules);

        satuan::where('id', $unit->id)
            ->update($validateData);

        return redirect('/dashboard/units')->with('success', 'Satuan telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $unit)
    {
        Satuan::destroy($unit->id);
        return redirect('/dashboard/units')->with('success', 'Satuan telah dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Satuan::class, 'slug', $request->nama_satuan);
        return response()->json(['slug' => $slug]);
    }
}
