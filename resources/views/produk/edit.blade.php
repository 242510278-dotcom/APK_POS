@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<style>
    .form-card {
        background-color: #1e242b;
        border: 1px solid #2d353e;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        padding: 32px;
        max-width: 600px;
        margin: 20px auto;
        color: #e2e8f0;
    }

    .form-header {
        margin-bottom: 24px;
        border-bottom: 1px solid #2d353e;
        padding-bottom: 16px;
    }

    .form-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.5rem;
        color: #f8fafc;
        letter-spacing: -0.5px;
    }

    .form-header p {
        margin: 4px 0 0 0;
        color: #94a3b8;
        font-size: 0.875rem;
    }

    .form-container input, 
    .form-container textarea, 
    .form-container select {
        background-color: #0f172a !important;
        border: 1px solid #334155 !important;
        color: #f8fafc !important;
        border-radius: 8px;
        padding: 10px 14px;
        transition: all 0.2s ease-in-out;
    }

    .form-container input:focus, 
    .form-container textarea:focus, 
    .form-container select:focus {
        border-color: #64748b !important;
        box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.2) !important;
        outline: none;
    }

    .form-container label {
        color: #cbd5e1;
        font-weight: 500;
        font-size: 0.875rem;
        margin-bottom: 6px;
    }
</style>

<div class="form-card">
    <div class="form-header">
        <h4>Edit Produk</h4>
        <p>Perbarui informasi data produk di bawah ini.</p>
    </div>

    <form class="form-container" action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('Produk._form')
    </form>
</div>
@endsection
