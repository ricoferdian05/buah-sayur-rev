<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\BarangPedagang;
use App\Models\Barang;
use App\Models\MusimBarang;
use App\Models\Profil;
use App\Models\User;
use App\Models\Image;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;

class BarangPedagangController extends Controller
{
    public function index()
    {
        if (request('kategori') == "musim") {
            $catalogs = BarangPedagang::orderByDesc(Barang::select('peminat')->whereColumn('barang.id', 'barang_pedagang.id_barang'))
                ->where('is_musim', 1)
                ->paginate(9)
                ->withQueryString();
        } else {
            $catalogs = BarangPedagang::orderByDesc(Barang::select('peminat')->whereColumn('barang.id', 'barang_pedagang.id_barang'))
                ->filter(request(['search', 'kategori', 'user']))
                ->paginate(9)
                ->withQueryString();
        }

        $this->cekMusim();

        Carbon::setLocale('id');
        $title = '';
        if (request('kategori')) {
            if (request('kategori') == 'musim') {
                $category = 'musim';
                $title = ' di Sedang Musim';
            } else {
                $category = Kategori::firstWhere('slug', request('kategori'));
                $title = ' di ' . $category->nama_kategori;
            }
        }

        if (request('user')) {
            $author = User::firstWhere('username', request('user'));
            $title = ' oleh ' . $author->nama;
        }

        return view('home/catalogs/index', [
            "title" => "Katalog" . $title,
            "catalogs" => $catalogs,
            "categories" => Kategori::all(),
            'imageDefault' => 'default.jpg',
            'images' => Image::all(),
            "profiles" => Profil::all()
        ]);
    }

    public function show(BarangPedagang $catalog)
    {
        $dbImage = new Image;
        $images = $dbImage->where('id_barang_pedagang', $catalog->id)->first();

        return view('home/catalogs/show', [
            "title" => "Katalog",
            "catalog" => $catalog,
            'imageDefault' => 'default.jpg',
            'images' => $images,
            "profiles" => Profil::all()
        ]);
    }

    public function cekMusim()
    {
        define('MONTH', date('F'));
        $dbBarang = new Barang;
        $barang = Barang::all();

        $musimBarang = new MusimBarang;
        $musim = $musimBarang->getMusim();

        $dbBarangPedagang = new BarangPedagang;
        $barangPedagang = BarangPedagang::all();

        foreach ($barang as $b) {
            foreach ($musim as $m) {
                if ((str_contains(strtolower($b->nama_barang), strtolower($m->nama_barang))) &&
                    ($m->bulan == MONTH)
                ) {
                    $dbBarang->where('id', $b->id)
                        ->update(array('status_musim' => 1));
                    break;
                } else {
                    $dbBarang->where('id', $b->id)
                        ->update(array('status_musim' => 0));
                }
            }
        }

        foreach ($barangPedagang as $b) {
            foreach ($musim as $m) {
                if ((str_contains(strtolower($b->nama_barang), strtolower($m->nama_barang))) &&
                    ($m->bulan == MONTH)
                ) {
                    $dbBarangPedagang->where('id', $b->id)
                        ->update(array('is_musim' => 1));
                    break;
                } else {
                    $dbBarangPedagang->where('id', $b->id)
                        ->update(array('is_musim' => 0));
                }
            }
        }
    }
}
