@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark tracking-tight">Daftar Produk</h2>
            <p class="text-secondary mb-0">Kelola inventaris dan katalog produk toko Anda dalam satu panel</p>
        </div>
        <a href="{{ route('produk.create') }}" class="btn btn-dark btn-lg-custom shadow-sm px-4 rounded-3 d-inline-flex align-items-center justify-content-center gap-2">
            <i class="fas fa-plus fs-6"></i>
            <span class="fw-semibold">Tambah Produk</span>
        </a>
    </div>

    <!-- Alert Flash Message -->
    @if (session('success'))
        <div class="alert alert-custom alert-success-slate fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-check-circle fs-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close btn-close-white-custom" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-custom alert-danger-slate fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-exclamation-triangle fs-5"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close btn-close-white-custom" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Card Ringkasan Singkat (Stat Cards) -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-slate-card">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="icon-shape bg-secondary bg-opacity-10 text-secondary rounded-3 p-3">
                        <i class="fas fa-boxes fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-uppercase text-secondary fs-7 fw-bold">Total Produk</div>
                        <div class="fs-4 fw-bold text-dark">{{ $products->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Pembungkus Utama -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">

            <!-- Filter & Pencarian -->
            <form action="{{ route('produk.index') }}" method="GET" class="row g-2 mb-4">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="input-group search-input-group">
                        <span class="input-group-text bg-slate border-end-0 text-secondary ps-3">
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control bg-slate border-start-0 ps-2 py-2"
                            placeholder="Cari produk berdasarkan nama..."
                        >
                        <button class="btn btn-secondary px-4 fw-medium" type="submit">
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabel Data Produk -->
            <div class="table-responsive">
                <table class="table table-hover align-middle custom-slate-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" width="5%">#</th>
                            <th scope="col" width="10%">Foto</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col" width="14%">Harga Beli</th>
                            <th scope="col" width="14%">Harga Jual</th>
                            <th scope="col" class="text-center" width="10%">Stok</th>
                            <th scope="col" width="15%">Dibuat Oleh</th>
                            <th scope="col" class="text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <!-- Nomor -->
                            <td class="text-center fw-semibold text-muted fs-7">
                                {{ $products->firstItem() + $loop->index }}
                            </td>

                            <!-- Foto Produk -->
                            <td>
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                         alt="{{ $product->nama }}"
                                         class="rounded-3 shadow-2sm object-fit-cover border border-secondary-subtle"
                                         width="54" 
                                         height="54">
                                @else
                                    <div class="bg-slate rounded-3 border border-secondary-subtle d-flex align-items-center justify-content-center text-secondary" style="width: 54px; height: 54px;">
                                        <i class="fas fa-image fa-lg opacity-50"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Nama Produk -->
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $product->nama }}</div>
                            </td>

                            <!-- Harga Beli -->
                            <td class="text-secondary fw-medium">
                                Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                            </td>

                            <!-- Harga Jual -->
                            <td class="fw-bold text-dark">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </td>

                            <!-- Stok -->
                            <td class="text-center">
                                @if($product->stok > 10)
                                    <span class="badge badge-slate bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-2 fw-semibold">
                                        {{ $product->stok }}
                                    </span>
                                @elseif($product->stok > 0)
                                    <span class="badge badge-slate bg-warning-subtle text-dark border border-warning-subtle rounded-pill px-3 py-2 fw-semibold">
                                        {{ $product->stok }}
                                    </span>
                                @else
                                    <span class="badge badge-slate bg-dark text-white rounded-pill px-3 py-2 fw-semibold">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <!-- User Pembuat -->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px;">
                                        <i class="fas fa-user fs-7"></i>
                                    </div>
                                    <span class="small text-secondary fw-medium">
                                        {{ $product->user->name ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Aksi (Detail, Edit, Hapus dengan teks) -->
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <!-- Detail -->
                                    <a href="{{ route('produk.show', $product->id) }}" 
                                       class="btn btn-action-slate btn-sm rounded-2 d-inline-flex align-items-center gap-1"
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('produk.edit', $product->id) }}" 
                                       class="btn btn-action-slate btn-sm rounded-2 d-inline-flex align-items-center gap-1"
                                       title="Edit">
                                        <i class="fas fa-pen"></i>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-action-slate-danger btn-sm rounded-2 d-inline-flex align-items-center gap-1" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                                title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4">
                                    <div class="icon-shape bg-slate rounded-circle p-4 d-inline-block mb-3 text-secondary">
                                        <i class="fas fa-box-open fa-3x"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">Tidak Ada Data Produk</h5>
                                    <p class="text-secondary small mb-0">Belum ada produk yang ditambahkan atau hasil pencarian tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-3">
                <div class="small text-secondary fw-medium">
                    Menampilkan <span class="text-dark fw-bold">{{ $products->firstItem() ?? 0 }}</span> - <span class="text-dark fw-bold">{{ $products->lastItem() ?? 0 }}</span> dari <span class="text-dark fw-bold">{{ $products->total() }}</span> produk
                </div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Global & Typography */
    .fs-7 { font-size: 0.8rem; }
    .tracking-tight { letter-spacing: -0.025em; }
    .object-fit-cover { object-fit: cover; }

    /* Custom Palette Warna Abu-abu (Slate / Charcoal) */
    .bg-slate { background-color: #f1f3f5 !important; }
    .bg-slate-card { background-color: #f8f9fa; border: 1px solid #e9ecef; }
    
    /* Input Search Custom */
    .search-input-group .form-control {
        border-color: #dee2e6;
    }
    .search-input-group .form-control:focus {
        background-color: #ffffff;
        box-shadow: none;
        border-color: #6c757d;
    }

    /* Styling Tabel */
    .custom-slate-table thead th {
        background-color: #343a40 !important;
        color: #f8f9fa !important;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.85rem 1rem;
        border: none;
    }
    .custom-slate-table tbody td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #e9ecef;
    }
    .custom-slate-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Custom Tombol Aksi */
    .btn-action-slate {
        background-color: #e9ecef;
        color: #495057;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-action-slate:hover {
        background-color: #343a40;
        color: #ffffff;
    }

    .btn-action-slate-danger {
        background-color: #f8d7da;
        color: #842029;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-action-slate-danger:hover {
        background-color: #dc3545;
        color: #ffffff;
    }

    /* Custom Button Utama */
    .btn-dark-custom {
        background-color: #212529;
        color: #ffffff;
        border: none;
    }
    .btn-dark-custom:hover {
        background-color: #343a40;
        color: #ffffff;
    }

    /* Custom Alerts */
    .alert-success-slate {
        background-color: #343a40;
        color: #f8f9fa;
    }
    .alert-danger-slate {
        background-color: #212529;
        color: #f8d7da;
    }
    .btn-close-white-custom {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Shadow & Radius Soft */
    .shadow-2sm {
        box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    }
</style>

@endsection
