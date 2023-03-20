@extends('dashboard/layouts/main')

@section('container')
<div class="container mt-4">
    <div class="row mb-5">
        <div class="col-md-8 shadow p-3 mb-5 bg-white rounded border">
            @if ($catalog->barang->status_musim == 1)
            <h4 style="color: orange">{{ $catalog->nama_barang }} (Sedang Musim)</h4>
            @else
                <h4 style="color: orange">{{ $catalog->nama_barang }}</h4>
            @endif
            <h4 style="display: inline">Rp. <?= number_format($catalog->harga_barang, 0, ',', '.') ?></h4> /{{ $catalog->satuan->nama_satuan }}
            <p>oleh <a href="/home/catalogs?author={{ $catalog->user->username }}" class="text-decoration-none">{{ $catalog->user->nama }}</a> di <a href="/home/catalogs?category={{ $catalog->kategori->slug }}" class="text-decoration-none">{{ $catalog->kategori->nama_kategori }}</a></p>
            @if ($catalog->image)
                <center>
                    <img src="{{ asset('img/catalog-images/' . $catalog->image) }}" alt="{{ $catalog->kategori->nama_kategori }}" class="img-fluid rounded">
                </center>
            @else
                <center>
                    <img src="{{ asset('img/catalog-images/' . $image) }}" class="card-img-top rounded">
                </center>
            @endif
            <article class="my-3">
                {!! $catalog->desk_barang !!}
            </article>
        </div>
    </div>
</div>
@endsection