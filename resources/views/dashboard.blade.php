@extends('layouts.app')

@section('title', 'Login')

@section('content')

@include('layouts.navbar')

<div class="container my-4 text-center text-secondary">
    <h1 class="text-dark font-weight-bold mb-4">
        Ringkasan Hari Ini
        <br>
        <small class="text-muted fs-6">
            ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
        </small>
    </h1>

    @can('viewAny', App\Models\User::class)
    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <h2 class="text-secondary border-bottom border-secondary pb-2">Today's Sales</h2>
        </div>
        <div class="col-md-6 mb-3">           
            <div class="card border-secondary shadow-sm">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Total Nilai Penjualan Hari ini
                </div>
                <div class="card-body bg-light text-dark">
                    <h4 class="card-title m-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Jumlah Transaksi Hari ini
                </div>
                <div class="card-body bg-light text-dark">
                    <h4 class="card-title m-0">{{ $ringkasan['total_transaksi'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <h2 class="text-secondary border-bottom border-secondary pb-2">Cash & Payment Status</h2>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Total Pembayaran Tunai
                </div>
                <div class="card-body bg-light text-dark">
                    <h4 class="card-title m-0">Rp {{ number_format($ringkasan['total_cash']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Total Pembayaran Non-Tunai
                </div>
                <div class="card-body bg-light text-dark">
                    <h4 class="card-title m-0">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h4>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <h2 class="text-secondary border-bottom border-secondary pb-2">Critical Inventory Status</h2>
        </div>
        <div class="col-md-6 mb-3">
            <h4 class="text-dark mb-3">Daftar Produk Stok Rendah</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @forelse ($produkStokRendah as $index => $produk)
                            <tr>
                                <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center bg-light">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $produkStokRendah->links() }}
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <h4 class="text-dark mb-3">Produk Habis Stok</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @forelse ($produkStokHabis as $index => $produk)
                            <tr>
                                <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center bg-light">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $produkStokHabis->links() }}
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <h2 class="text-secondary border-bottom border-secondary pb-2">Best Seller Products</h2>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @forelse ($produkTerlaris as $index => $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>{{ $produk->total_terjual }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center bg-light">
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
