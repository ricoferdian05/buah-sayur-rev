@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Buat Kategori Baru</h4>
    </div>   
    
    <div class="col-lg-4">
        <form action="/dashboard/categories" method="POST" class="mb-5">
            @csrf
            <div class="mb-3">
              <label for="nama_kategori" class="form-label">Nama Kategori</label>
              <input type="text" class="form-control @error('nama_kategori') is-invalid  @enderror" id="nama_kategori" name="nama_kategori" required autofocus value="{{ old('nama_kategori') }}">
              @error('nama_kategori')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
                @error('slug')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Buat Kategori</button>
        </form>
    </div>
    <script>
        const name = document.querySelector('#nama_kategori');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function(){
            fetch('/dashboard/categories/checkSlug?nama_kategori=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>
@endsection