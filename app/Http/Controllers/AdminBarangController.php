<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Satuan;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/suppliers/index', [
            'suppliers_buah' => Barang::where('id_user', auth()->user()->id)->where('id_kategori', 1)->get(),
            'suppliers_sayur' => Barang::where('id_user', auth()->user()->id)->where('id_kategori', 2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/suppliers/create', [
            'categories' => Kategori::all(),
            'units' => Satuan::all()
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
            'nama_barang' => 'required|max:255|unique:barang',
            'slug' => 'required|unique:barang',
            'harga_pasok' => 'required',
            'persentase' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required'
        ]);

        $validateData['id_user'] = auth()->user()->id;

        Barang::create($validateData);

        return redirect('/dashboard/suppliers')->with('success', 'Katalog baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $supplier)
    {
        return view('dashboard/suppliers/show', [
            'supplier' => $supplier,
            'image' => 'default.jpg'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $supplier)
    {
        return view('dashboard/suppliers/edit', [
            'supplier' => $supplier,
            'categories' => Kategori::all(),
            'units' => Satuan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $supplier)
    {
        if ($request->status_musim != null) {
            $rules['status_musim'] = 'required';
        } else if ($request->peminat != null) {
            $rules['peminat'] = 'required';
        } else {
            $rules = [
                'nama_barang' => 'required|max:255',
                'harga_pasok' => 'required',
                'persentase' => 'required',
                'id_kategori' => 'required',
                'id_satuan' => 'required'

            ];

            if ($request->slug != $supplier->slug) {
                $rules['slug'] = 'required|unique:barang';
            }
        }

        $validateData = $request->validate($rules);
        $validateData['id_user'] = auth()->user()->id;

        Barang::where('id', $supplier->id)
            ->update($validateData);

        return redirect('/dashboard/suppliers')->with('success', 'Katalog telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $supplier)
    {
        Barang::destroy($supplier->id);
        return redirect('/dashboard/suppliers')->with('success', 'Katalog telah dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Barang::class, 'slug', $request->nama_barang);
        return response()->json(['slug' => $slug]);
    }
}
