@extends('layouts.app') {{-- Pastikan nama layout ini sama dengan halaman dashboard Anda --}}

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <!-- Header Toko Sendi matching warna Navbar Hitam -->
                <div class="p-4 text-center text-white" style="background-color: #212529;">
                    <div class="display-6 mb-2"><i class="bi bi-shop"></i></div>
                    <h3 class="fw-bold tracking-wide font-monospace text-uppercase mb-1">toko_sendi</h3>
                    <span class="badge bg-secondary bg-opacity-50 text-uppercase tracking-wider" style="font-size: 0.65rem; letter-spacing: 1.5px;">Golden POS Partner</span>
                </div>

                <!-- Detail Kontak & Alamat Lengkap -->
                <div class="card-body p-4 bg-white">
                    <div class="row g-4">
                        <!-- Alamat Outlet -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100 border border-light-subtle">
                                <label class="fw-bold text-secondary small text-uppercase tracking-wider mb-2 d-block">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Alamat Lengkap
                                </label>
                                <p class="text-dark mb-0 fw-medium lh-base">
                                    Jl. Raya Purbaratu No. 45,<br>
                                    Kec. Purbaratu, Kota Tasikmalaya,<br>
                                    Jawa Barat, Kode Pos 46196
                                </p>
                            </div>
                        </div>

                        <!-- Kontak Toko -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100 border border-light-subtle">
                                <label class="fw-bold text-secondary small text-uppercase tracking-wider mb-2 d-block">
                                    <i class="bi bi-telephone-fill text-primary me-1"></i> Kontak Resmi
                                </label>
                                <div class="text-dark mb-3">
                                    <span class="d-block small text-muted">WhatsApp / Telepon:</span>
                                    <span class="fw-semibold">+62 812-3456-7890</span>
                                </div>

                                <label class="fw-bold text-secondary small text-uppercase tracking-wider mb-2 d-block">
                                    <i class="bi bi-envelope-fill text-warning me-1"></i> Email Toko
                                </label>
                                <div class="text-dark">
                                    <span class="fw-semibold">support@tokosendi.com</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="text-center mt-5 pt-3 border-top">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-dark px-3 rounded-2">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
