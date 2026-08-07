@extends('layouts.app')

@section('title', 'Halaman Penjualan')

@section('content')
<div class="container py-4">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h3 class="fw-bold text-dark mb-1">Halaman Penjualan</h3>
            <p class="text-secondary small mb-0">Kelola riwayat transaksi penjualan dan status pembayaran</p>
        </div>
        <a href="{{ route('penjualan.create') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Transaksi
        </a>
    </div>

    {{-- Alert untuk Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-secondary alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert untuk Pesan Error --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter & Search Card --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-body-tertiary">
        <div class="card-body p-3">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-secondary-subtle bg-white"
                        placeholder="Cari transaksi penjualan..."
                    >
                    <button class="btn btn-secondary px-4" type="submit">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Sales Table Card --}}
    <div class="card border shadow-sm rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-secondary text-center">#</th>
                        <th class="text-secondary">Tanggal Transaksi</th>
                        <th class="text-secondary">Kasir</th>
                        <th class="text-secondary">Total Pembayaran</th>
                        <th class="text-secondary">Metode</th>
                        <th width="12%" class="text-secondary text-center">Status</th>
                        <th width="18%" class="text-secondary text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td class="text-secondary text-center fw-medium">
                                {{ $sales->firstItem() + $loop->index }}
                            </td>
                            <td class="text-secondary small">
                                {{ $sale->created_at ? $sale->created_at->format('d-m-Y H:i:s') : '-' }}
                            </td>
                            <td class="fw-medium text-dark">{{ $sale->user->name ?? '-' }}</td>
                            <td class="fw-medium text-dark">
                                Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-secondary small">{{ $sale->metode_pembayaran ?? '-' }}</td>
                            <td class="text-center">
                                @if(($sale->status ?? '') == 'COMPLETED')
                                    <span class="badge bg-secondary text-white px-3 py-2">
                                        COMPLETED
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2">
                                        {{ $sale->status ?? 'PENDING' }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-sm btn-outline-secondary">
                                        Detail
                                    </a>

                                    @can('update', $sale)
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-sm btn-outline-secondary">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-secondary"
                                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted text-center py-4">
                                Data penjualan tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sales->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $sales->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
