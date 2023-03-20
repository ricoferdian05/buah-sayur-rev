@extends('home/layouts/main')
@section('container')

<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <img src="/img/fruits.png" style="max-height: 100px;">
        <h2>Profil</h2>
        <img src="/img/vegetable.png" style="max-height: 100px;">
        <h3>Mengenai <span>Buah dan Sayur</span></h3>
        <p>Berbagai Katalog Buah dan Sayur.</p>
      </div>

      <div class="row">
          @foreach ($profiles as $profile)
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">

              @if ($profile->image)
                <div class="rounded shadow mb-3 bg-white rounded">
                  <img src="{{ asset('img/profile-images/' . $profile->image) }}" class="img-fluid" alt="">
                </div>
              @else
                <div class="rounded shadow mb-3 bg-white rounded">
                  <img src="{{ asset('img/profile-images/' . $image) }}" class="img-fluid" alt="">
                </div>
              @endif

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column" data-aos="fade-up" data-aos-delay="100"> 
              <h3>Buah dan Sayur</h3>
              <p class="text-justify">
                {!! $profile->profil !!}
              </p>
            </div>
          @endforeach
      </div>

    </div>
  </section><!-- End About Section -->
@endsection