@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')
@include('layouts.navbar')

<div class="container py-4">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary-subtle">
        <div>
            <h3 class="fw-bold text-secondary mb-1">Halaman Users</h3>
            <p class="text-muted small mb-0">Kelola data pengguna dan hak akses sistem</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>
    </div>

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="alert alert-secondary border border-secondary-subtle alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <span class="text-dark">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter & Search Card --}}
    <div class="card border-secondary-subtle bg-light shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-secondary-subtle bg-white text-dark"
                        placeholder="Cari berdasarkan nama atau email..."
                    >
                    <button class="btn btn-secondary px-4" type="submit">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Users Table Card --}}
    <div class="card border-secondary-subtle shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="15%" class="text-center">Role</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    @forelse($users as $user)
                        <tr>
                            <td class="text-center fw-medium text-dark">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td class="fw-medium text-dark">{{ $user->name }}</td>
                            <td class="text-dark">{{ $user->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary text-white border border-secondary px-3 py-2">
                                    {{ $user->role->name ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-secondary bg-light text-dark border-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-secondary"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted text-center py-4 bg-light">
                                Data user tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="card-footer bg-light border-top border-secondary-subtle py-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
