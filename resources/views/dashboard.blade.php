@extends('layouts.app')

@section('title', 'Dashboard - Ringkasan Hari Ini')

@section('content')

@include('layouts.navbar')

<!-- Custom Styling Slate Theme -->
<style>
    body {
        background-color: #f4f6f8;
    }
    .card-slate {
        background: #ffffff;
        border: 1px solid #e3e6f0;
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-slate:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.06) !important;
    }
    .border-accent-dark {
        border-left: 4px solid #212529 !important;
    }
    .border-accent-grey {
        border-left: 4px solid #6c757d !important;
    }
    .header-divider {
        height: 2px;
        background: linear-gradient(90deg, #6c757d 0%, rgba(108,117,125,0.1) 100%);
    }
    .table-custom th {
        background-color: #343a40 !important;
        color: #ffffff;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="container my-5">
    <!-- Header Section -->
    <div class="row mb-5 text-center">
        <div class="col-12">
            <span class="badge bg-secondary text-white px-3 py-2 mb-2 rounded-pill shadow-sm small">
                Overview Panel
            </span>
            <h1 class="fw-bold text-dark display-6 mb-1">
                Ringkasan Hari Ini
            </h1>
            <p class="text-secondary fs-6 mb-0">
                <i class="bi bi-calendar-event me-1"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    <!-- Section: Sales Summary -->
    <div class="mb-5">
        <div class="d-flex align-items-center mb-2">
            <h3 class="h5 fw-bold text-dark mb-0 me-3">Today's Sales</h3>
            <div class="flex-grow-1 header-divider"></div>
        </div>
        
        <div class="row g-4 mt-1">
            <div class="col-md-6"> 
                <div class="card card-slate border-accent-dark shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="text-uppercase text-muted fw-bold small tracking-wide">Total Nilai Penjualan</span>
                        <h2 class="fw-bold text-dark mt-2 mb-0">
                            Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-slate border-accent-grey shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="text-uppercase text-muted fw-bold small tracking-wide">Jumlah Transaksi</span>
                        <h2 class="fw-bold text-dark mt-2 mb-0">
                            {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} <span class="fs-6 text-muted fw-normal">Transaksi</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Payment Status -->
    <div class="mb-5">
        <div class="d-flex align-items-center mb-2">
            <h3 class="h5 fw-bold text-dark mb-0 me-3">Cash & Payment Status</h3>
            <div class="flex-grow-1 header-divider"></div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-md-6">
                <div class="card card-slate border-accent-grey shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-uppercase text-muted fw-bold small tracking-wide">Pembayaran Tunai</span>
                                <h3 class="fw-bold text-dark mt-2 mb-0">
                                    Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                                </h3>
                            </div>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Tunai</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-slate border-accent-dark shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-uppercase text-muted fw-bold small tracking-wide">Pembayaran Non-Tunai</span>
                                <h3 class="fw-bold text-dark mt-2 mb-0">
                                    Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                                </h3>
                            </div>
                            <span class="badge bg-dark text-white px-3 py-2 rounded-pill">Non-Tunai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <!-- Section: Critical Inventory -->
    <div class="mb-5">
        <div class="d-flex align-items-center mb-2">
            <h3 class="h5 fw-bold text-dark mb-0 me-3">Critical Inventory Status</h3>
            <div class="flex-grow-1 header-divider"></div>
        </div>

        <div class="row g-4 mt-1">
            <!-- Table Stok Rendah -->
            <div class="col-lg-6">
                <div class="card card-slate shadow-sm overflow-hidden h-100">
                    <div class="card-header bg-secondary text-white py-3 px-4 d-flex align-items-center justify-content-between border-0">
                        <span class="fw-bold fs-6">Daftar Produk Stok Rendah</span>
                        <span class="badge bg-warning text-dark rounded-pill">Warning</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-custom">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col" class="text-end pe-4">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-end pe-4">
                                            <span class="badge bg-warning text-dark px-2 py-1">{{ $produk->stok }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted small">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($produkStokRendah->hasPages())
                    <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                        {{ $produkStokRendah->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Table Stok Habis -->
            <div class="col-lg-6">
                <div class="card card-slate shadow-sm overflow-hidden h-100">
                    <div class="card-header bg-dark text-white py-3 px-4 d-flex align-items-center justify-content-between border-0">
                        <span class="fw-bold fs-6">Produk Habis Stok</span>
                        <span class="badge bg-danger rounded-pill">Out of Stock</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-custom">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col" class="text-end pe-4">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-end pe-4">
                                            <span class="badge bg-danger text-white px-2 py-1">{{ $produk->stok }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted small">
                                            Tidak ada produk yang habis.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($produkStokHabis->hasPages())
                    <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                        {{ $produkStokHabis->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Best Seller Products -->
    <div class="mb-4">
        <div class="d-flex align-items-center mb-2">
            <h3 class="h5 fw-bold text-dark mb-0 me-3">Best Seller Products</h3>
            <div class="flex-grow-1 header-divider"></div>
        </div>

        <div class="card card-slate shadow-sm overflow-hidden mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 table-custom">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">Nama Produk</th>
                            <th scope="col" class="py-3">Sisa Stok</th>
                            <th scope="col" class="text-end pe-4 py-3">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $index => $produk)
                            <tr>
                                <td class="ps-4 fw-bold text-dark py-3">
                                    <span class="text-secondary me-2">#{{ $index + 1 }}</span> {{ $produk->nama }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">{{ $produk->stok }}</span>
                                </td>
                                <td class="text-end pe-4 font-monospace fw-bold text-dark">
                                    {{ number_format($produk->total_terjual, 0, ',', '.') }} pcs
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted small">
                                    Belum ada data penjualan produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection