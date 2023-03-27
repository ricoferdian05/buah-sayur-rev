@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Edit Gambar</h4>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/catalogs/editGambar" method="POST" class="mb-5" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $images[0]->id }}">
            {{-- Gambar 1 --}}
            <div class="mb-3">
                <label for="image" class="form-label h5">Gambar Produk 1</label>
                @if ($images[0]->image1 !== null && $images[0]->image1 !== '')
                    <img src="{{ asset('img/catalog-images/' . $images[0]->image1) }}"
                        class="img-preview1 img-fluid mb-3 col-sm-5 d-block">
                @else
                    <div class="alert alert-danger" role="alert">
                        Belum ada gambar!!!
                    </div>
                @endif
                <input class="form-control @error('image1') is-invalid @enderror" type="file" id="image1"
                    name="image1" onchange="previewImage1()" />
                @error('image1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label h5">Gambar Produk 2</label>
                @if ($images[0]->image2 !== null && $images[0]->image2 !== '')
                    <img src="{{ asset('img/catalog-images/' . $images[0]->image2) }}"
                        class="img-preview2 img-fluid mb-3 col-sm-5 d-block">
                @else
                    <div class="alert alert-danger" role="alert">
                        Belum ada gambar!!!
                    </div>
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image2"
                    name="image2" onchange="previewImage2()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label h5">Gambar Produk 3</label>
                @if ($images[0]->image3 !== null && $images[0]->image3 !== '')
                    <img src="{{ asset('img/catalog-images/' . $images[0]->image3) }}"
                        class="img-preview3 img-fluid mb-3 col-sm-5 d-block">
                @else
                    <div class="alert alert-danger" role="alert">
                        Belum ada gambar!!!
                    </div>
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image3"
                    name="image3" onchange="previewImage3()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success" style="width: 100%">Perbarui Gambar</button>
        </form>
    </div>
    <script>
        const title = document.querySelector('#nama_barang');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/catalogs/checkSlug?nama_barang=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage1() {
            const image = document.querySelector('#image1');
            const imgPreview = document.querySelector('.img-preview1');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImage2() {
            const image = document.querySelector('#image2');
            const imgPreview = document.querySelector('.img-preview2');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImage3() {
            const image = document.querySelector('#image3');
            const imgPreview = document.querySelector('.img-preview3');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
