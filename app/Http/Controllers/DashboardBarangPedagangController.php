<?php

namespace App\Http\Controllers;

use App\Models\BarangPedagang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Barang;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Termwind\Components\Dd;

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
            'image' => 'required|image|file|max:2024',
            'is_musim' => 'required',
        ]);

        $slug = $request->slug;

        if ($request->file('image')) {
            $title = $validateData['slug'] . '.' . $validateData['image']->getClientOriginalExtension();
            $validateData['image']->move(public_path('img/catalog-images'), $title);
            $validateData['image'] = $title;
        }

        $validateData['id_user'] = auth()->user()->id;

        BarangPedagang::create($validateData);

        $dbBarangPedagang = new BarangPedagang;
        $barangPedagang = $dbBarangPedagang->where('slug', $slug)->first();

        $id = $barangPedagang->id;

        $dbImage = new Image;
        $image = $dbImage->insert(
            array('image1' => $title, 'id_barang_pedagang' => $id)
        );
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
        $dbImage = new Image;
        $images = $dbImage->where('id_barang_pedagang', $catalog->id)->first();
        return view('dashboard/catalogs/show', [
            'catalog' => $catalog,
            'images' => $images,
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
        $dbImage = new Image;
        $images = $dbImage->where('id_barang_pedagang', $catalog->id)->get();

        return view('dashboard/catalogs/edit', [
            'catalog' => $catalog,
            'categories' => Kategori::all(),
            'units' => Satuan::all(),
            'suppliers' => Barang::all(),
            'images' => $images,
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


        $validateData['id_user'] = auth()->user()->id;

        BarangPedagang::where('id', $catalog->id)
            ->update($validateData);

        return redirect('/dashboard/catalogs')->with('success', 'Katalog telah diperbarui');
    }

    public function gambar($id)
    {
        return view('dashboard/catalogs/gambar', [
            'images' => Image::where('id_barang_pedagang', $id)->get(),
        ]);
    }

    public function editGambar(Request $request)
    {
        $rules = [
            'image1' => 'image|file|max:2024',
            'image2' => 'image|file|max:2024',
            'image3' => 'image|file|max:2024',
        ];

        $validateData = $request->validate($rules);

        $dbImage = new Image;
        $dbBarangPedagang = new BarangPedagang;

        $oldImage = $dbImage->where('id', $request->id)->get();
        $oldImage1 = $oldImage[0]->image1;
        $oldImage2 = $oldImage[0]->image2;
        $oldImage3 = $oldImage[0]->image3;

        $barangPedagang = $dbBarangPedagang->where('id', $oldImage[0]->id_barang_pedagang)->get();

        // Gambar 1
        if ($request->file('image1') !== null) {
            $title1 = $request->image1->getClientOriginalName();

            $pathImage = public_path('img/catalog-images/') . $oldImage1;

            if (file_exists($pathImage)) {
                @unlink($pathImage);
            }

            $validateData['image1']->move(public_path('img/catalog-images'), $title1);
            $validateData['image1'] = $title1;

            $dbImage->where('id', $request->id)
                ->update(array('image1' => $title1));
        }

        // Gambar 2
        if ($request->file('image2') !== null) {
            $title2 = $request->image2->getClientOriginalName();

            $pathImage = public_path('img/catalog-images/') . $oldImage2;

            if (file_exists($pathImage)) {
                @unlink($pathImage);
            }

            $validateData['image2']->move(public_path('img/catalog-images'), $title2);
            $validateData['image2'] = $title2;

            $dbImage->where('id', $request->id)
                ->update(array('image2' => $title2));
        }

        // Gambar 3
        if ($request->file('image3') !== null) {
            $title3 = $request->image3->getClientOriginalName();

            $pathImage = public_path('img/catalog-images/') . $oldImage3;

            if (file_exists($pathImage)) {
                @unlink($pathImage);
            }

            $validateData['image3']->move(public_path('img/catalog-images'), $title3);
            $validateData['image3'] = $title3;

            $dbImage->where('id', $request->id)
                ->update(array('image3' => $title3));
        }

        return redirect('/dashboard/catalogs/' . $barangPedagang[0]->slug . '/edit')->with('success', 'Gambar telah diperbarui');
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
