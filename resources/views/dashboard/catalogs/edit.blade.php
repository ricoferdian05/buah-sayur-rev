@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Edit Katalog</h4>
    </div>   
    
    <div class="col-lg-8">
        <form action="/dashboard/catalogs/{{ $catalog->slug }}" method="POST" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="supplier" class="form-label">Produk dan Harga dari Supplier</label>
                <select class="form-select" name="id_barang">
                    @foreach ($suppliers as $supplier)
                        @if (old('id_barang', $catalog->id_barang) == $supplier->id)
                            <option value="{{ $supplier->id }}" selected>{{ $supplier->nama_barang }}, Rp. <?= number_format($supplier->harga_pasok, 0, ',', '.') ?></option>
                        @else
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_barang }}, Rp. <?= number_format($supplier->harga_pasok, 0, ',', '.') ?></option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
              <label for="nama_barang" class="form-label">Nama Produk</label>
              <input type="text" class="form-control @error('nama_barang') is-invalid  @enderror" id="nama_barang" name="nama_barang" required autofocus value="{{ old('nama_barang', $catalog->nama_barang) }}">
              @error('nama_barang')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="slug" class="form-label">Slug</label> --}}
                <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $catalog->slug) }}">
                @error('slug')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="harga_barang" class="form-label">Harga Jual</label>
                <input type="number" class="form-control @error('harga_barang') is-invalid  @enderror" id="harga_barang" name="harga_barang" required autofocus value="{{ old('harga_barang', $catalog->harga_barang) }}">
                @error('harga_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <select class="form-select" name="id_satuan">
                    @foreach ($units as $unit)
                        @if (old('id_satuan', $catalog->id_satuan) == $unit->id)
                            <option value="{{ $unit->id }}" selected>{{ $unit->nama_satuan }}</option>
                        @else
                            <option value="{{ $unit->id }}">{{ $unit->nama_satuan }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" name="id_kategori">
                    @foreach ($categories as $category)
                        @if (old('id_kategori', $catalog->id_kategori) == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->nama_kategori }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="hidden" name="oldImage" value="{{ $catalog->image }}">
                @if ($catalog->image)
                    <img src="{{ asset('img/catalog-images/' . $catalog->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="desk_barang" class="form-label">Keterangan Produk</label>
                <input id="desk_barang" type="hidden" name="desk_barang" value="{{ old('desk_barang', $catalog->desk_barang) }}">
                <trix-editor input="desk_barang"></trix-editor>
                @error('desk_barang')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Katalog</button>
        </form>
    </div>
    <script>
        const title = document.querySelector('#nama_barang');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/catalogs/checkSlug?nama_barang=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection