<!-- ======= Top Bar ======= -->
@foreach ($profiles as $profile)
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{ $profile->telp }}</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="{{ $profile->link_whatsapp }}" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
        <a href="{{ $profile->link_facebook }}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="{{ $profile->link_instagram }}" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="{{ $profile->link_youtube }}" target="_blank" class="youtube"><i class="bi bi-youtube"></i></i></a>
      </div>
    </div>
  </section>
@endforeach

<header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><img src="/img/icon.png" alt=""><a href="/"> Buah & Sayur<span>.</span></a></h1>
    {{-- <br>
    <small><i>Integrated Islamic School</i></small> --}}
    
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto {{ Request::is('/*') ? 'active' : '' }}" href="/">Beranda</a></li>
        <li><a class="nav-link scrollto {{ Request::is('home/catalogs*') ? 'active' : '' }}" href="/home/catalogs">Katalog</a></li>
        <li><a class="nav-link scrollto {{ Request::is('home/profiles*') ? 'active' : '' }}" href="/home/profiles">Tentang</a></li>
        <li><a class="nav-link scrollto {{ Request::is('home/contacts*') ? 'active' : '' }}" href="/home/contacts">Kontak</a></li>

        @auth
          <li><a class="nav-link scrollto {{ Request::is('home/login*') ? 'active' : '' }}" href="/home/login">Dashboard {{ auth()->user()->username }}</a></li>
        @else    
          <li><a class="nav-link scrollto {{ Request::is('home/login*') ? 'active' : '' }}" href="/home/login">Login</a></li>
        @endauth
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->