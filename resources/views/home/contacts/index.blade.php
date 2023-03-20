@extends('home/layouts/main')
@section('container')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <img src="/img/fruits.png" style="max-height: 100px;">
            <h2>Kontak</h2>
            <img src="/img/vegetable.png" style="max-height: 100px;">
            <h3>Segera <span>Hubungi Kami</span></h3>
            <p>Hubungi kami untuk informasi lebih lanjut mengenai buah dan sayur.</p>
          </div>
          
          @foreach ($profiles as $profile)
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-3 col-md-6">
                <div class="info-box mb-4 h-100 rounded p-2 pt-5">
                    <i class="bx bx-map"></i>
                    <h3>Alamat</h3>
                    <p>{!! $profile->alamat !!}</p>
                </div>
                </div>
    
                <div class="col-lg-3 col-md-6">
                <div class="info-box  mb-4 h-100 rounded p-2 pt-5">
                    <i class="bx bx-envelope"></i>
                    <h3>Email</h3>
                    <p>{{ $profile->email }}</p>
                </div>
                </div>
    
                <div class="col-lg-3 col-md-6">
                <div class="info-box  mb-4 h-100 rounded p-2 pt-5">
                    <i class="bx bx-phone-call"></i>
                    <h3>Telepon</h3>
                    <p>{{ $profile->telp }}</p>
                </div>
                </div>

                <div class="col-lg-3 col-md-6">
                  <div class="info-box  mb-4 h-100 rounded p-2 pt-5">
                      <i class="bx bx-chat"></i>
                      <h3>Whatsapp</h3>
                      <p>{{ $profile->whatsapp }}</p>
                </div>
                </div>
          @endforeach
  
          </div>
  
          <div class="row mt-4" data-aos="fade-up" data-aos-delay="100">
  
            <div class="col-lg-12">
              <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d126732.84658161068!2d107.6537619779541!3d-6.961878826745619!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x437398556f9fa03!2sTelkom%20University!5e0!3m2!1sen!2sid!4v1662215456185!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
            </div>

          </div>
  
        </div>
      </section><!-- End Contact Section -->
@endsection