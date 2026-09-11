@extends('layouts.app') {{-- Pastikan 'layouts.app' ini sama dengan yang ada di file index.blade.php atau pos.blade.php Anda --}}

@section('content')
<div class="container mx-auto px-4 py-6" style="padding: 20px;">
    <!-- Tombol Kembali -->
    <div class="mb-4" style="margin-bottom: 20px;">
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary text-blue-500 font-medium">
            ← Kembali ke Daftar Penjualan
        </a>
    </div>

    <!-- Card Utama Detail Transaksi -->
    <div class="card bg-white shadow border p-4" style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <!-- Header Nota -->
        <div class="border-b pb-3 mb-4" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
            <h2 class="text-xl font-bold">Detail Transaksi #{{ $sale->id }}</h2>
            <p class="text-sm text-gray-500">Waktu: {{ $sale->created_at }}</p>
            <p>Status: <strong style="color: green;">{{ $sale->status }}</strong></p>
        </div>

        <!-- Informasi Pembayaran -->
        <div class="mb-4" style="margin-bottom: 20px; background: #f9f9f9; padding: 15px; border-radius: 5px;">
            <p><strong>Metode Pembayaran:</strong> {{ $sale->metode_pembayaran }}</p>
        </div>

        <!-- Tabel Daftar Item -->
        <h3 class="text-lg font-semibold mb-2">Daftar Produk</h3>
        <table class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background: #f5f5f5; text-align: left;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Nama Produk</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Jumlah</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($sale->itemPenjualan ?? []) as $item)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $item->produk->nama ?? 'Produk (ID: '.$item->produk_id.')' }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            {{ $item->kuantitas }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 10px; border: 1px solid #ddd; text-align: center;">Tidak ada item produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Bagian Total Akhir -->
        <div style="text-align: right; margin-top: 25px;">
            <h4>Total Akhir: <span style="color: #2e7d32; font-weight: bold;">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span></h4>
        </div>
    </div>
</div>
@endsection
