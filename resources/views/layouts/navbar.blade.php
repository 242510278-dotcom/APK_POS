<nav class="navbar navbar-expand-lg border-bottom shadow-sm py-2.5" style="background-color: #1a1d20; border-color: #2b3035 !important;">
  <div class="container-fluid px-4">
    <!-- Logo & Brand -->
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('dashboard') }}">
      <div class="text-white d-flex align-items-center justify-content-center rounded-3 me-2.5 shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #495057 0%, #343a40 100%); border: 1px solid #6c757d;">
        <i class="bi bi-shop fs-5 text-light"></i>
      </div>
      <div class="d-flex flex-column lh-1">
        <span class="fs-5 tracking-wide text-white font-monospace">sendi</span>
        <span class="fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1.5px; color: #adb5bd;">Golden POS</span>
      </div>
    </a>

    <!-- Toggler untuk Mobile -->
    <button class="navbar-toggler border-0 p-2 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #2b3035;">
      <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
    </button>

    <!-- Menu Navbar -->
    <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
        
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center transition-all {{ Request::is('dashboard') ? 'bg-secondary bg-opacity-25 text-white fw-semibold border border-secondary border-opacity-50' : 'text-secondary' }}" 
             style="{{ Request::is('dashboard') ? '' : 'color: #adb5bd !important;' }}"
             href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2 me-2 fs-6"></i> Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center transition-all {{ Request::is('admin/users*') || Request::is('users*') ? 'bg-secondary bg-opacity-25 text-white fw-semibold border border-secondary border-opacity-50' : '' }}" 
             style="{{ Request::is('admin/users*') || Request::is('users*') ? '' : 'color: #adb5bd !important;' }}"
             href="{{ route('admin.users') }}">
            <i class="bi bi-people me-2 fs-6"></i> Users
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center transition-all {{ Request::is('admin/jenis*') || Request::is('jenis*') ? 'bg-secondary bg-opacity-25 text-white fw-semibold border border-secondary border-opacity-50' : '' }}"
             style="{{ Request::is('admin/jenis*') || Request::is('jenis*') ? '' : 'color: #adb5bd !important;' }}"
             href="{{ route('jenis.index') }}">
            <i class="bi bi-tags me-2 fs-6"></i> Jenis
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center transition-all {{ Request::is('produk*') ? 'bg-secondary bg-opacity-25 text-white fw-semibold border border-secondary border-opacity-50' : '' }}" 
             style="{{ Request::is('produk*') ? '' : 'color: #adb5bd !important;' }}"
             href="{{ route('produk.index') }}">
            <i class="bi bi-box-seam me-2 fs-6"></i> Produk
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center transition-all {{ Request::is('penjualan*') ? 'bg-secondary bg-opacity-25 text-white fw-semibold border border-secondary border-opacity-50' : '' }}" 
             style="{{ Request::is('penjualan*') ? '' : 'color: #adb5bd !important;' }}"
             href="{{ route('penjualan.index') }}">
            <i class="bi bi-cart-check me-2 fs-6"></i> Penjualan
          </a>
        </li>

      </ul>

      <!-- Tombol Logout -->
      <div class="d-flex align-items-center pt-3 pt-lg-0 border-top border-secondary border-opacity-25 border-lg-0">
        <form class="w-100" action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-custom-logout w-100 px-4 py-2 rounded-3 d-flex align-items-center justify-content-center fw-medium" style="background-color: #2b3035; color: #e9ecef; border: 1px solid #495057;">
            <i class="bi bi-box-arrow-right me-2 text-danger"></i> Keluar
          </button>
        </form>
      </div>

    </div>
  </div>
</nav>