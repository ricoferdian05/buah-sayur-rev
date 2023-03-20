@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Edit Katalog</h4>
    </div>   
    
    <div class="col-md-4">
        <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="nama_barang" class="form-label">Nama Produk</label>
              <input type="text" class="form-control @error('nama_barang') is-invalid  @enderror" id="nama_barang" name="nama_barang" required autofocus value="{{ old('nama_barang', $supplier->nama_barang) }}">
              @error('nama_barang')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="slug" class="form-label">Slug</label> --}}
                <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $supplier->slug) }}">
                @error('slug')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="harga_pasok" class="form-label">Harga Supplier</label>
                <input type="number" class="form-control @error('harga_pasok') is-invalid  @enderror" id="harga_pasok" name="harga_pasok" required autofocus value="{{ old('harga_pasok', $supplier->harga_pasok) }}">
                @error('harga_pasok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="persentase" class="form-label">Persentase Harga</label>
                <input type="text" class="form-control @error('persentase') is-invalid  @enderror" id="persentase" name="persentase" required autofocus value="{{ old('persentase', $supplier->persentase) }}">
                @error('persentase')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <select class="form-select" name="id_satuan">
                    @foreach ($units as $unit)
                        @if (old('id_satuan', $supplier->id_satuan) == $unit->id)
                            <option value="{{ $unit->id }}" selected>{{ $unit->nama_satuan }}</option>
                        @else
                            <option value="{{ $unit->id }}">{{ $unit->nama_satuan }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-select" name="id_kategori">
                    @foreach ($categories as $category)
                        @if (old('id_kategori', $supplier->id_kategori) == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->nama_kategori }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Katalog</button>
        </form>
    </div>
    <script>
        const title = document.querySelector('#nama_barang');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/suppliers/checkSlug?nama_barang=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
        
    </script>
@endsection