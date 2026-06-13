@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-semibold">Daftar Transaksi</h4>
                <small class="text-muted">Kelola seluruh transaksi keuangan</small>
            </div>

            <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                + Tambah Transaksi
            </a>
        </div>

        {{-- Card --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3">Tanggal</th>
                                <th>COA</th>
                                <th>Deskripsi</th>
                                <th class="text-end">Debit</th>
                                <th class="text-end">Credit</th>
                                <th>User</th>
                                <th class="text-center" style="width:140px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td class="fw-medium">
                                        {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary-subtle text-dark px-3 py-2 rounded-pill">
                                            {{ $trx->chartOfAccount->name ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="text-muted">
                                        {{ $trx->description ?? '-' }}
                                    </td>

                                    <td class="text-end text-success fw-semibold">
                                        Rp {{ number_format($trx->debit, 2) }}
                                    </td>

                                    <td class="text-end text-danger fw-semibold">
                                        Rp {{ number_format($trx->credit, 2) }}
                                    </td>

                                    <td>
                                        <span class="text-dark fw-medium">
                                            {{ $trx->user->name ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">

                                            <a href="{{ route('admin.transactions.show', $trx->id) }}"
                                                class="btn btn-sm btn-outline-info rounded-pill px-3">
                                                View
                                            </a>

                                            <a href="{{ route('admin.transactions.edit', $trx->id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                Edit
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div>
                                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                            Tidak ada data transaksi
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3 d-flex justify-content-end">
            {{ $transactions->links() }}
        </div>

    </div>
@endsection
