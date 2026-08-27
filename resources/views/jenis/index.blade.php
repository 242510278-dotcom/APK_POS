@extends('layouts.app')

@section('title', 'Data Jenis')

@section('content')
@include('layouts.navbar')

<style>
    :root {
        --grey-bg: #f3f4f6;
        --grey-card: #ffffff;
        --grey-header: linear-gradient(135deg, #374151 0%, #1f2937 100%);
        --grey-border: #e5e7eb;
        --grey-text-main: #111827;
        --grey-text-muted: #6b7280;
        --grey-badge: #e5e7eb;
        --border-radius-lg: 1rem;
        --border-radius-md: 0.5rem;
    }

    body {
        background-color: var(--grey-bg);
    }

    /* Soft Charcoal Header Banner */
    .hero-header {
        background: var(--grey-header);
        border-radius: var(--border-radius-lg);
        box-shadow: 0 10px 20px -5px rgba(31, 41, 55, 0.2);
    }

    /* Modern Card Container */
    .table-card {
        border: 1px solid var(--grey-border);
        border-radius: var(--border-radius-lg);
        background: var(--grey-card);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Custom Table Styling */
    .custom-table thead th {
        background-color: #f9fafb;
        color: #4b5563;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid var(--grey-border);
        padding: 1rem 1.25rem;
    }

    .custom-table tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--grey-border);
        color: var(--grey-text-main);
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f9fafb;
    }

    /* Badges & Buttons */
    .badge-id {
        background-color: var(--grey-badge);
        color: #374151;
        font-weight: 600;
        padding: 0.35em 0.75em;
        border-radius: var(--border-radius-md);
    }

    .btn-custom-primary {
        background: #f9fafb;
        color: #1f2937;
        font-weight: 600;
        border: 1px solid #d1d5db;
        transition: all 0.25s ease;
    }

    .btn-custom-primary:hover {
        background: #ffffff;
        color: #111827;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-action-edit {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-action-edit:hover {
        background-color: #4b5563;
        color: #ffffff;
        border-color: #4b5563;
        transform: translateY(-1px);
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #dc2626;
        color: #ffffff;
        border-color: #dc2626;
        transform: translateY(-1px);
    }

    /* Empty State Wrapper */
    .empty-state-icon {
        width: 70px;
        height: 70px;
        background-color: #f3f4f6;
        color: #9ca3af;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
    }

    .form-control-grey {
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        color: var(--grey-text-main);
    }

    .form-control-grey:focus {
        background-color: #ffffff;
        border-color: #9ca3af;
        box-shadow: 0 0 0 0.25rem rgba(156, 163, 175, 0.25);
    }
</style>

<div class="container py-4">

    <!-- Header Banner -->
    <div class="hero-header p-4 p-md-5 mb-4 text-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-white">Data Jenis</h2>
            <p class="mb-0 fs-6" style="color: #d1d5db;">Kelola kategori dan klasifikasi data Anda dalam satu tempat.</p>
        </div>

        <a href="{{ route('jenis.create') }}" class="btn btn-custom-primary btn-lg px-4 d-inline-flex align-items-center gap-2 rounded-3">
            <i class="bi bi-plus-circle-fill text-dark"></i>
            <span>Tambah Jenis</span>
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-secondary border-0 fade show shadow-sm rounded-3 mb-4 p-3 text-dark d-flex justify-content-between align-items-center" role="alert" style="background-color: #e5e7eb;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-dark fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table Card Controls -->
    <div class="card table-card overflow-hidden">
        <div class="p-3 p-md-4 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 bg-white">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-tags-fill text-secondary fs-5"></i>
                <h5 class="fw-bold mb-0 text-dark">Daftar Jenis</h5>
            </div>
            
            <!-- Search Bar Area -->
            <div class="col-12 col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text border-end-0 form-control-grey"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control form-control-grey border-start-0" placeholder="Cari data jenis...">
                </div>
            </div>
        </div>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4 text-center" style="width: 8%">No</th>
                        <th scope="col" style="width: 32%">Nama Jenis</th>
                        <th scope="col" style="width: 40%">Keterangan</th>
                        <th scope="col" class="pe-4 text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenis as $item)
                        <tr>
                            <td class="ps-4 text-center">
                                <span class="badge-id fs-7">
                                    {{ method_exists($jenis, 'firstItem') ? $jenis->firstItem() + $loop->index : $loop->iteration }}
                                </span>
                            </td>

                            <td>
                                <span class="fw-semibold text-dark fs-6">{{ $item->nama_jenis }}</span>
                            </td>

                            <td>
                                <span class="text-secondary small">
                                    {{ $item->keterangan ?? '-' }}
                                </span>
                            </td>

                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('jenis.edit', $item->id) }}" 
                                       class="btn btn-action-edit btn-sm px-3 rounded-2 d-inline-flex align-items-center gap-1"
                                       title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('jenis.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-action-delete btn-sm px-3 rounded-2 d-inline-flex align-items-center gap-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')"
                                                title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="py-4">
                                    <div class="empty-state-icon mb-3">
                                        <i class="bi bi-tags fs-2"></i>
                                    </div>
                                    <h5 class="fw-semibold text-dark mb-1">Belum Ada Data</h5>
                                    <p class="text-muted small mb-0">Data jenis yang dimasukkan akan tampil secara otomatis di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        @if(method_exists($jenis, 'hasPages') && $jenis->hasPages())
            <div class="p-3 border-top d-flex justify-content-end bg-light">
                {{ $jenis->links() }}
            </div>
        @endif
    </div>

</div>
@endsection