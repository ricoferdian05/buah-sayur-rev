@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Profil Saya</h4>
        <form action="/home/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan logout?')"><span data-feather="log-out"></span> Logout</a></button>
        </form>
    </div>   
    
    <div class="col-lg-8">
        <form action="/dashboard/users/{{ $user->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Toko</label>
              <input type="text" class="form-control @error('nama') is-invalid  @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $user->nama) }}">
              @error('nama')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="text" class="form-control @error('email') is-invalid  @enderror" id="email" name="email" required autofocus value="{{ old('email', $user->email) }}" readonly>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid  @enderror" id="username" name="username" required autofocus value="{{ old('username', $user->username) }}" readonly>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control @error('telp') is-invalid  @enderror" id="telp" name="telp" required autofocus value="{{ old('telp', $user->telp) }}">
                @error('telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                {{-- <textarea name="alamat" class="form-control @error('alamat') is-invalid  @enderror"  id="alamat" required autofocus value="{{ old('alamat', $user->alamat) }}"></textarea> --}}
                <input type="text" class="form-control @error('alamat') is-invalid  @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $user->alamat) }}">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="link_toko" class="form-label">Link Toko</label>
                <input type="text" class="form-control @error('link_toko') is-invalid  @enderror" id="link_toko" name="link_toko" required autofocus value="{{ old('link_toko', $user->link_toko) }}">
                @error('link_toko')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Foto Profil</label>
                <input type="hidden" name="oldImage" value="{{ $user->image }}">
                @if ($user->image)
                    <img src="{{ asset('img/user-images/' . $user->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
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
            <button type="submit" class="btn btn-primary">Perbarui Data Profil</button>
        </form>
    </div>
    <script>
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