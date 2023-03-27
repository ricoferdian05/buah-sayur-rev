@extends('home/layouts/main')

@section('container')
    <main id="main" data-aos="fade-up">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/home/catalogs">Katalog</a></li>
                        <li>Rincian Katalog</li>
                    </ol>
                </div>

            </div>
        </section><!-- Breadcrumbs Section -->

        <div class="container mt-3">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 shadow p-3 mb-5 bg-white rounded border">
                    @if ($catalog->barang->is_musim == 1)
                        <h4 style="color: orange">{{ $catalog->nama_barang }} (Sedang Musim)</h4>
                    @else
                        <h4 style="color: orange">{{ $catalog->nama_barang }}</h4>
                    @endif
                    <h4 style="display: inline">Rp. <?= number_format($catalog->harga_barang, 0, ',', '.') ?></h4>
                    /{{ $catalog->satuan->nama_satuan }}
                    <p>oleh <a href="/home/catalogs?author={{ $catalog->user->username }}"
                            class="text-decoration-none">{{ $catalog->user->nama }}</a> di <a
                            href="/home/catalogs?category={{ $catalog->kategori->slug }}"
                            class="text-decoration-none">{{ $catalog->kategori->nama_kategori }}</a></p>

                    <div class="row ms-2 me-2">
                        {{-- Gambar 1 --}}
                        @if ($images->image1 !== null && $images->image1 !== '')
                            <div class="col text-center shadow-sm">
                                <img src="{{ asset('img/catalog-images/' . $images->image1) }}"
                                    class="img-fluid mb-3 col-sm-5">
                            </div>
                        @endif
                        {{-- Gambar 2 --}}
                        @if ($images->image2 !== null && $images->image2 !== '')
                            <div class="col text-center shadow-sm">
                                <img src="{{ asset('img/catalog-images/' . $images->image2) }}"
                                    class="img-fluid mb-3 col-sm-5">
                            </div>
                        @endif
                        {{-- Gambar 3 --}}
                        @if ($images->image3 !== null && $images->image3 !== '')
                            <div class="col text-center shadow-sm">
                                <img src="{{ asset('img/catalog-images/' . $images->image3) }}"
                                    class="img-fluid mb-3 col-sm-5">
                            </div>
                        @endif
                    </div>
                    <article class="my-3">
                        {!! $catalog->desk_barang !!}
                    </article>
                </div>
            </div>
        </div>
    </main>
@endsection
