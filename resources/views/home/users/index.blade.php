@extends('home/layouts/main')
@section('container')
  <!-- ======= Team Section ======= -->
  <section id="team" class="team">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <img src="/img/fruits.png" style="max-height: 100px;">
        <h2>Toko Buah dan Sayur</h2>
        <img src="/img/vegetable.png" style="max-height: 100px;">
        <h3>Mengenai <span>{{ $users->nama }}</span></h3>
        <p>{!! $users->email !!} ({!! $users->telp !!})</p>
      </div>

      <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">

            @if ($users->image)
              <div class="rounded">
                <img src="{{ asset('img/user-images/' . $users->image) }}" class="img-fluid" alt="">
              </div>
            @else
              <div class="rounded">
                <img src="{{ asset('img/user-images/' . $image) }}" class="img-fluid" alt="">
              </div>
            @endif

          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column" data-aos="fade-up" data-aos-delay="100"> 
            <h3>{{ $users->nama }}</h3>
            <p class="text-justify">
                {!! $users->alamat !!}
            </p>
            <a href="{{ $users->link_toko }}" class="text-decoration-none btn btn-warning mt-1" style="width: 50%;">Kunjungi Marketplace</a>
          </div>
    </div>

    </div>
  </section><!-- End Team Section -->
@endsection