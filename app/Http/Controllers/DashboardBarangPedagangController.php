<?php

namespace App\Http\Controllers;

use App\Models\BarangPedagang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardBarangPedagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/catalogs/index', [
            'catalogs_buah' => BarangPedagang::where('id_user', auth()->user()->id)->where('id_kategori', 1)->get(),
            'catalogs_sayur' => BarangPedagang::where('id_user', auth()->user()->id)->where('id_kategori', 2)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/catalogs/create', [
            'categories' => Kategori::all(),
            'units' => Satuan::all(),
            'suppliers' => Barang::all()
        ]);
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
            'nama_barang' => 'required|max:255',
            'slug' => 'required|unique:barang_pedagang',
            'desk_barang' => 'required',
            'harga_barang' => 'required',
            'id_barang' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'image' => 'image|file|max:2024'
        ]);

        if ($request->file('image')) {
            $title = $validateData['nama_barang'] . '.' . $validateData['image']->getClientOriginalExtension();
            $validateData['image']->move(public_path('img/catalog-images'), $title);
            $validateData['image'] = $title;
        }

        $validateData['id_user'] = auth()->user()->id;

        BarangPedagang::create($validateData);

        return redirect('/dashboard/catalogs')->with('success', 'Katalog baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(BarangPedagang $catalog)
    {
        return view('dashboard/catalogs/show', [
            'catalog' => $catalog,
            'image' => 'default.jpg'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangPedagang $catalog)
    {
        return view('dashboard/catalogs/edit', [
            'catalog' => $catalog,
            'categories' => Kategori::all(),
            'units' => Satuan::all(),
            'suppliers' => Barang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangPedagang $catalog)
    {
        $rules = [
            'nama_barang' => 'required|max:255',
            'image' => 'image|file|max:2024',
            'desk_barang' => 'required',
            'harga_barang' => 'required',
            'id_barang' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required'
        ];

        if ($request->slug != $catalog->slug) {
            $rules['slug'] = 'required|unique:barang_pedagang';
        }

        $validateData = $request->validate($rules);

        $currentImage = BarangPedagang::find($catalog->id)->image;
        if ($request->file('image')) {
            if ($request->image != $currentImage) {

                $images = public_path('img/catalog-images/') . $currentImage;

                if (file_exists($images)) {
                    @unlink($images);
                }
                $title = $validateData['nama_barang'] . '.' . $validateData['image']->getClientOriginalExtension();
                $validateData['image']->move(public_path('img/catalog-images'), $title);
                $validateData['image'] = $title;
            }
        }
        $validateData['id_user'] = auth()->user()->id;

        BarangPedagang::where('id', $catalog->id)
            ->update($validateData);

        return redirect('/dashboard/catalogs')->with('success', 'Katalog telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangPedagang $catalog)
    {
        // if ($catalog->image) {
        //     Storage::delete($catalog->image);
        // }
        if (File::exists(public_path('img/catalog-images/' . $catalog->image))) {
            File::delete(public_path('img/catalog-images/' . $catalog->image));
        }
        BarangPedagang::destroy($catalog->id);
        return redirect('/dashboard/catalogs')->with('success', 'Katalog telah dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(BarangPedagang::class, 'slug', $request->nama_barang);
        return response()->json(['slug' => $slug]);
    }
}
