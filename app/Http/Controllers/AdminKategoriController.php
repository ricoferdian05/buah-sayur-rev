<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kategori;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/categories/index', [
            'categories' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/categories/create');
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
            'nama_kategori' => 'required|max:255',
            'slug' => 'required|unique:kategori'
        ]);

        Kategori::create($validateData);

        return redirect('/dashboard/categories')->with('success', 'Kategori baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $category)
    {
        return view('dashboard/categories/edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $category)
    {
        $rules = [
            'nama_kategori' => 'required|max:255'
        ];

        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:kategori';
        }

        $validateData = $request->validate($rules);

        Kategori::where('id', $category->id)
            ->update($validateData);

        return redirect('/dashboard/categories')->with('success', 'Kategori telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $category)
    {
        Kategori::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', 'Kategori telah dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->nama_kategori);
        return response()->json(['slug' => $slug]);
    }
}
