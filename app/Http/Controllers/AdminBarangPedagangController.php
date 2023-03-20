<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangPedagang;
use Illuminate\Support\Facades\File;

class AdminBarangPedagangController extends Controller
{
    public function index()
    {
        return view('dashboard/allcatalogs/index', [
            "allcatalogs_buah" => BarangPedagang::where('id_kategori', 1)->get(),
            "allcatalogs_sayur" => BarangPedagang::where('id_kategori', 2)->get(),
            'image' => 'default.jpg'
        ]);
    }

    public function show(BarangPedagang $catalog)
    {
        return view('dashboard/allcatalogs/show', [
            "allcatalog" => $catalog,
            'image' => 'default.jpg'
        ]);
    }

    public function destroy(BarangPedagang $catalog)
    {
        if (File::exists(public_path('img/catalog-images/' . $catalog->image))) {
            File::delete(public_path('img/catalog-images/' . $catalog->image));
        }
        BarangPedagang::destroy($catalog->id);
        return redirect('/dashboard/allcatalogs')->with('success', 'Katalog telah dihapus');
    }
}
