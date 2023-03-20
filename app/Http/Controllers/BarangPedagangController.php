<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\BarangPedagang;
use App\Models\Barang;
use App\Models\Profil;
use App\Models\User;
use Carbon\Carbon;

class BarangPedagangController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $title = '';
        if (request('kategori')) {
            $category = Kategori::firstWhere('slug', request('kategori'));
            $title = ' di ' . $category->nama_kategori;
        }

        if (request('user')) {
            $author = User::firstWhere('username', request('user'));
            $title = ' oleh ' . $author->nama;
        }

        return view('home/catalogs/index', [
            "title" => "Katalog" . $title,
            "catalogs" => BarangPedagang::orderByDesc(Barang::select('peminat')->whereColumn('barang.id', 'barang_pedagang.id_barang'))->filter(request(['search', 'kategori', 'user']))->paginate(9)->withQueryString(),
            "categories" => Kategori::all(),
            'image' => 'default.jpg',
            "profiles" => Profil::all()
        ]);
    }

    public function show(BarangPedagang $catalog)
    {
        return view('home/catalogs/show', [
            "title" => "Katalog",
            "catalog" => $catalog,
            'image' => 'default.jpg',
            "profiles" => Profil::all()
        ]);
    }
}
