<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/home/catalogs">Aneka Buah & Sayur</a>
    <p class="text-light m-2">Selamat datang, {{ auth()->user()->nama }}</p>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        {{-- <form action="/home/logout" method="POST">
          @csrf
          <button type="submit" class="nav-link px-3 bg-dark border-0" onclick="return confirm('Apakah anda yakin akan logout?')"><span data-feather="log-out"></span> Logout</a></button>
        </form>
         --}}
         <a class="nav-link px-3 bg-dark border-0" href="/dashboard/users/{{ auth()->user()->id }}/edit"><span data-feather="user"></span> Profil Saya</a>
      </div>
    </div>
  </header>