@extends('home/layouts/main')

@section('container') 
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <img src="/img/fruits.png" style="max-height: 100px;">
                <h2>Katalog</h2>
                <img src="/img/vegetable.png" style="max-height: 100px;">
                <h3>Lebih Banyak <span>Katalog</span></h3>
                <p>Katalog Buah-buahan dan Sayuran.</p>
            </div>

            <div class="row">
                <div class="section-title col-lg-12 d-flex justify-content-center">
                  <ul id="portfolio-flters">
                    <li><h2><a href="/home/catalogs">Semua</h2></li>
                    @foreach ($categories as $category)
                        <li><h2><a href="/home/catalogs?kategori={{ $category->slug }}">{{ $category->nama_kategori }}</a></h2></li>
                    @endforeach
                  </ul>
                </div>
              </div>

            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <form action="/home/catalogs">
                        @if (request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
        
                        @if (request('user'))
                            <input type="hidden" name="user" value="{{ request('user') }}">
                        @endif
        
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari katalog.." name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        
            @if ($catalogs->count())
                    <div class="row">
                        @foreach ($catalogs as $catalog)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow p-1 mb-5 bg-white rounded" data-aos="fade-up" data-aos-delay="100">
                                    <div class="position-absolute px-3 py-2 text-white rounded" style="background-color: rgba(255, 165, 0, 0.7)"><a href="/home/catalogs?kategori={{ $catalog->kategori->slug }}" class="text-white text-decoration-none">{{ $catalog->kategori->nama_kategori }}</a></div>
                                    @if ($catalog->image)
                                        <img src="{{ asset('img/catalog-images/' . $catalog->image) }}" class="img-fluid rounded" style="max-width: 100%; max-height: 220px; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('img/catalog-images/' . $image) }}" class="card-img-top rounded" style="max-width: 100%; max-height: 220px; object-fit:cover;">
                                    @endif
                                    <div class="card-body">
                                        @if ($catalog->barang->status_musim == 1)
                                            <h5 style="color: orange" class="card-title">{{ $catalog->nama_barang }} (Sedang Musim)</h5>
                                        @else
                                            <h5 style="color: orange" class="card-title">{{ $catalog->nama_barang }}</h5>
                                        @endif
                                    <p>
                                        <small class="text-muted">
                                           Oleh <a href="/home/catalogs?user={{ $catalog->user->username }}" class="text-decoration-none">{{ $catalog->user->nama }}</a> {{ $catalog->updated_at->diffForHumans() }}
                                        </small>
                                    </p>
                                    @if ($catalog->barang->peminat == 1)
                                        <p class="card-text"> <h4 style="display: inline">Rp. <?= number_format($catalog->harga_barang, 0, ',', '.') ?></h4> /{{ $catalog->satuan->nama_satuan }} <span class="bi bi-hand-thumbs-up-fill                                            "></span>
                                            <br />
                                            <small class="text-muted">Harga {{ $catalog->barang->persentase}}</small>
                                        </p>
                                    @else
                                        <p class="card-text"> <h4 style="display: inline">Rp. <?= number_format($catalog->harga_barang, 0, ',', '.') ?></h4> /{{ $catalog->satuan->nama_satuan }}
                                            <br />
                                            <small class="text-muted">Harga {{ $catalog->barang->persentase}}</small>
                                        </p>
                                    @endif
                                    <a href="/home/catalogs/{{ $catalog->slug }}" class="text-decoration-none btn btn-primary" style="width: 100%;">Selengkapnya</a>
                                    <a href="/home/users/{{ $catalog->id_user }}" class="text-decoration-none btn btn-success mt-1" style="width: 100%;">Informasi Toko</a>
                                    <a href="{{ $catalog->user->link_toko }}" class="text-decoration-none btn btn-warning mt-1" style="width: 100%;">Kunjungi Marketplace</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            @else
                <p class="text-center fs-4">No catalog found.</p>
            @endif
        
            <div class="d-flex justify-content-center">
                {{ $catalogs->links() }}
            </div>
        </div>
    </section>
@endsection