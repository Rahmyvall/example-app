@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Daftar Transaksi</h4>
            <small class="text-muted">Kelola seluruh transaksi keuangan</small>
        </div>

        <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary rounded-pill px-4">
            + Tambah Transaksi
        </a>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>COA</th>
                            <th>Deskripsi</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $trx)

                        <tr>

                            {{-- DATE --}}
                            <td>
                                {{ $trx->date
                                        ? \Carbon\Carbon::parse($trx->date)->format('d/m/Y')
                                        : '-' }}
                            </td>

                            {{-- COA --}}
                            <td>
                                <span class="fw-semibold">
                                    {{ $trx->chartOfAccount?->name ?? '-' }}
                                </span>
                            </td>

                            {{-- DESCRIPTION --}}
                            <td>
                                {{ $trx->description ?: '-' }}
                            </td>

                            {{-- DEBIT --}}
                            <td class="text-end fw-semibold text-success">
                                {{ !empty($trx->debit) && $trx->debit > 0
                                        ? 'Rp ' . number_format($trx->debit, 0, ',', '.')
                                        : 'Rp 0' }}
                            </td>

                            {{-- CREDIT --}}
                            <td class="text-end fw-semibold text-danger">
                                {{ !empty($trx->credit) && $trx->credit > 0
                                        ? 'Rp ' . number_format($trx->credit, 0, ',', '.')
                                        : 'Rp 0' }}
                            </td>

                            {{-- ACTION --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.transactions.show', $trx->id) }}"
                                        class="btn btn-sm btn-outline-info" title="Detail">

                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.transactions.edit', $trx->id) }}"
                                        class="btn btn-sm btn-outline-warning" title="Edit">

                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.transactions.destroy', $trx->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">

                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>
                            @empty

                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                Tidak ada data transaksi.
                            </td>
                        </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $transactions->links() }}
    </div>

</div>
@endsection