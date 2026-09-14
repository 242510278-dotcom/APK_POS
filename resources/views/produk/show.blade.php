@extends('layouts.app') {{-- Sesuaikan dengan nama master layout utama aplikasi Anda --}}

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Detail Produk: {{ $produk->nama }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded" alt="{{ $produk->nama }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                            <span>Tidak ada foto</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Produk</th>
                            <td>{{ $produk->nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga Beli</th>
                            <td>Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>
                                @if($produk->stok)
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
