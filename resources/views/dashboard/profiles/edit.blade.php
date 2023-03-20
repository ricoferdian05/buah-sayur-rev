@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Edit Profil Website</h4>
    </div>   
    
    <div class="col-lg-8">
        <form action="/dashboard/profiles/{{ $profile->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="mb-3 border p-2">
                <label for="image" class="form-label">Foto Profil</label>
                <input type="hidden" name="oldImage" value="{{ $profile->image }}">
                @if ($profile->image)
                    <img src="{{ asset('img/profile-images/' . $profile->image) }}" class="img-preview img-fluid m-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid m-3 col-sm-5">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="profil" class="form-label">Profil Singkat</label>
                <input id="profil" type="hidden" name="profil" value="{{ old('profil', $profile->profil) }}">
                <trix-editor input="profil"></trix-editor>
                @error('profil')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input id="alamat" type="hidden" name="alamat" value="{{ old('alamat', $profile->alamat) }}">
                <trix-editor input="alamat"></trix-editor>
                @error('alamat')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="telp">Telepon</span>
                <input type="text" class="form-control" name="telp" value="{{ old('telp', $profile->telp) }}">
                @error('telp')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="email"> Email</span>
                <input type="text" class="form-control" name="email" value="{{ old('email', $profile->email) }}">
                @error('email')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="link_facebook"> Facebook</span>
                <input type="text" class="form-control" name="link_facebook" value="{{ old('link_facebook', $profile->link_facebook) }}">
                @error('link_facebook')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="whatsapp"> Whatsapp (Nomor)</span>
                <input type="number" class="form-control" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}">
                @error('whatsapp')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="link_whatsapp"> Whatsapp (Link)</span>
                <input type="text" class="form-control" name="link_whatsapp" value="{{ old('link_whatsapp', $profile->link_whatsapp) }}">
                @error('link_whatsapp')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="link_instagram"> Instagram</span>
                <input type="text" class="form-control" name="link_instagram" value="{{ old('link_instagram', $profile->link_instagram) }}">
                @error('link_instagram')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="link_youtube"> Youtube (Channel)</span>
                <input type="text" class="form-control" name="link_youtube" value="{{ old('link_youtube', $profile->link_youtube) }}">
                @error('link_youtube')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="link_embed"> Youtube (Video)</span>
                <input type="text" class="form-control" name="link_embed" value="{{ old('link_embed', $profile->link_embed) }}">
                @error('link_embed')
                    <small><p class="text-danger">{{ $message }}</p></small>    
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
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
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
@endsection