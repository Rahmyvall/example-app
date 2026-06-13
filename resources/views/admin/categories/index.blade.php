@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>
                <h3 class="fw-bold mb-1">Data Category</h3>
                <p class="text-muted mb-0">Kelola semua kategori dalam sistem</p>
            </div>

            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm px-4 shadow-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Category
            </a>

        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-muted">No</th>
                                <th class="py-3 text-muted">Nama Category</th>
                                <th class="py-3 text-muted">Dibuat</th>
                                <th class="text-center pe-4 py-3 text-muted">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($categories as $category)
                                <tr class="border-bottom">

                                    <td class="ps-4 text-muted">
                                        {{ $loop->iteration + ($categories->firstItem() - 1) }}
                                    </td>

                                    <td class="fw-semibold text-dark">
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                                            {{ $category->name }}
                                        </span>
                                    </td>

                                    <td class="text-muted">
                                        {{ $category->created_at->format('d M Y') }}
                                    </td>

                                    {{-- ACTION --}}
                                    <td class="text-center pe-4">

                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-light border rounded-circle shadow-sm" title="Edit">
                                                <i class="bi bi-pencil-square text-warning"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus category ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-sm btn-light border rounded-circle shadow-sm"
                                                    title="Hapus">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @empty

                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Belum ada data category
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-3 d-flex justify-content-end">
            {{ $categories->links() }}
        </div>

    </div>
@endsection
