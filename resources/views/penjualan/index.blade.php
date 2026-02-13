@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')



@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h1 class="mb-4">Halaman Penjualan</h1>

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">
    Create
</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Search penjualan"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Tanggal Transaksi</th>
            <th>Kasir</th>
            <th>Total Pembayaran</th>
            <th>Metode</th>
            <th>Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sales as $sale)
            <tr>
                <td>{{ $sales->firstItem() + $loop->index }}</td>
                <td>{{ $sale->created_at->format('d-m-Y H:i:s') }}</td>
                <td>{{ $sale->user->name ?? '-' }}</td>
                <td>Rp {{ number_format($sale->total_pembayaran) }}</td>
                <td>{{ $sale->metode_pembayaran }}</td>
                <td>
                    <span class="badge bg-{{ $sale->status == 'COMPLETED' ? 'success' : 'warning' }}">
                        {{ $sale->status }}
                    </span>
                </td>
                <td class="d-flex gap-1">
                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                    @can('view', $sale)
                    ||
                    <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    @can('delete', $sale)
                    ||
                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data ini?')">
                            Hapus
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    Data Tidak Ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $sales->links() }}

@endsection
