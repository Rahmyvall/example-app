@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>
                <h3 class="fw-bold mb-1">Chart of Accounts</h3>
                <p class="text-muted mb-0">Kelola semua akun keuangan dalam sistem</p>
            </div>

            <a href="{{ route('admin.chart-of-accounts.create') }}" class="btn btn-primary btn-sm px-4 shadow-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah COA
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
                                <th class="py-3 text-muted">Code</th>
                                <th class="py-3 text-muted">Name</th>
                                <th class="py-3 text-muted">Category</th>
                                <th class="py-3 text-muted text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($coas as $coa)
                                <tr class="border-bottom">

                                    {{-- NO --}}
                                    <td class="ps-4 text-muted">
                                        {{ $loop->iteration + ($coas->firstItem() - 1) }}
                                    </td>

                                    {{-- CODE --}}
                                    <td>
                                        <span class="badge bg-dark px-3 py-2">
                                            {{ $coa->code }}
                                        </span>
                                    </td>

                                    {{-- NAME --}}
                                    <td class="fw-semibold text-dark">
                                        <i class="bi bi-folder2-open text-primary me-1"></i>
                                        {{ $coa->name }}
                                    </td>

                                    {{-- CATEGORY --}}
                                    <td>
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            <i class="bi bi-tags me-1"></i>
                                            {{ $coa->category->name ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- ACTION --}}
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('admin.chart-of-accounts.show', $coa->id) }}"
                                                class="btn btn-sm btn-light border rounded-circle shadow-sm" title="Detail">
                                                <i class="bi bi-eye text-info"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.chart-of-accounts.edit', $coa->id) }}"
                                                class="btn btn-sm btn-light border rounded-circle shadow-sm" title="Edit">
                                                <i class="bi bi-pencil-square text-warning"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.chart-of-accounts.destroy', $coa->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin ingin menghapus COA ini?')">

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
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Belum ada data Chart of Account
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
            {{ $coas->links() }}
        </div>

    </div>
@endsection
