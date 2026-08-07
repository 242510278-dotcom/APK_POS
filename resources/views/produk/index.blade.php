@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container py-4">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h3 class="fw-bold text-dark mb-1">Halaman Produk</h3>
            <p class="text-secondary small mb-0">Kelola inventaris, harga, dan stok barang</p>
        </div>
        @can('create', App\Models\Produk::class)
            <a href="{{ route('produk.create') }}" class="btn btn-secondary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        @endcan
    </div>

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="alert alert-secondary alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter & Search Card --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-body-tertiary">
        <div class="card-body p-3">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-secondary-subtle bg-white"
                        placeholder="Cari nama produk..."
                    >
                    <button class="btn btn-secondary px-4" type="submit">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Product Table Card --}}
    <div class="card border shadow-sm rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-secondary text-center">#</th>
                        <th width="10%" class="text-secondary text-center">Foto</th>
                        <th class="text-secondary">Nama Produk</th>
                        <th class="text-secondary">Ditambahkan Oleh</th>
                        <th class="text-secondary">Harga Beli</th>
                        <th class="text-secondary">Harga Jual</th>
                        <th width="10%" class="text-secondary text-center">Stok</th>
                        <th width="15%" class="text-secondary text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-secondary text-center fw-medium">
                                {{ $products->firstItem() + $loop->index }}
                            </td>
                            <td class="text-center">
                                @if($product->foto)
                                    <img src="{{ asset('storage/' . $product->foto) }}"
                                         alt="{{ $product->nama }}"
                                         width="50"
                                         height="50"
                                         class="rounded object-fit-cover border border-secondary-subtle">
                                @else
                                    <div class="bg-secondary-subtle text-secondary rounded d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 0.7rem;">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="fw-medium text-dark">{{ $product->nama }}</td>
                            <td class="text-secondary small">{{ $product->user->name ?? '-' }}</td>
                            <td class="text-secondary">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                            <td class="fw-medium text-dark">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2">
                                    {{ $product->stok }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-outline-secondary">
                                            Edit
                                        </a>
                                    @endcan
                                    
                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-secondary" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center py-4">
                                Data produk tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
