<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Dashboard</span>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/catalogs*') ? 'active' : '' }}" href="/dashboard/catalogs">
            <span data-feather="file-text"></span>
            Katalog Saya
          </a>
        </li>
      </ul>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/passwords*') ? 'active' : '' }}" href="/dashboard/passwords">
            <span data-feather="lock"></span>
            Ganti Kata Sandi
          </a>
        </li>
      </ul>

      @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
          <span>Administrator</span>
        </h6>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/suppliers*') ? 'active' : '' }}" href="/dashboard/suppliers">
              <span data-feather="book-open"></span>
              Katalog Supplier
            </a>
          </li>
        </ul> 

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
              <span data-feather="shopping-bag"></span>
              Data Toko
            </a>
          </li>
        </ul> 

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
              <span data-feather="grid"></span>
              Kategori Produk
            </a>
          </li>
        </ul>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/units*') ? 'active' : '' }}" href="/dashboard/units">
              <span data-feather="database"></span>
              Satuan Produk
            </a>
          </li>
        </ul>
        
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/profiles*') ? 'active' : '' }}" href="/dashboard/profiles">
              <span data-feather="briefcase"></span>
              Profil Website
            </a>
          </li>
        </ul>  

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/allcatalogs*') ? 'active' : '' }}" href="/dashboard/allcatalogs">
              <span data-feather="book"></span>
              Semua Katalog
            </a>
          </li>
        </ul>

      @endcan

    </div>
  </nav>