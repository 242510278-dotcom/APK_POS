@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-secondary bg-opacity-10">
    <div class="card shadow-lg border-0 bg-dark text-light" style="width: 100%; max-width: 400px; border-radius: 12px;">
        <div class="card-header bg-secondary bg-opacity-25 text-center border-bottom border-secondary py-3">
            <h4 class="mb-0 fw-bold text-white">Login POS</h4>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="mb-3 text-start">
                    <label class="form-label text-secondary fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control bg-dark text-light border-secondary" placeholder="nama@email.com">
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label text-secondary fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control bg-dark text-light border-secondary" placeholder="••••••••">
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary fw-bold text-uppercase py-2">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
