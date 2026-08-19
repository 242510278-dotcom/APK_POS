<nav class="navbar navbar-expand-lg bg-dark shadow-sm" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">POS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
        </li>     
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>

      <form class="ms-auto" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
      </form>
    </div>
  </div>
</nav>
