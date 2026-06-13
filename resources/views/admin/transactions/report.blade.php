@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-0">Laporan Transaksi</h4>
                <small class="text-muted">Ringkasan keuangan dan daftar transaksi</small>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex gap-2">

                {{-- PRINT --}}
                <button onclick="window.print()" class="btn btn-dark">
                    🖨 Print
                </button>

            </div>

        </div>

        {{-- SUMMARY CARDS --}}
        <div class="row g-3 mb-4">

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Debit</p>
                            <h4 class="text-success mb-0">
                                {{ number_format($transactions->sum('debit'), 2) }}
                            </h4>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bx bx-down-arrow-alt text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Credit</p>
                            <h4 class="text-danger mb-0">
                                {{ number_format($transactions->sum('credit'), 2) }}
                            </h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bx bx-up-arrow-alt text-danger fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">
                <strong>Detail Transaksi</strong>
            </div>

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
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($transactions as $trx)
                                <tr>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong>{{ $trx->chartOfAccount->name ?? '-' }}</strong>
                                    </td>

                                    <td class="text-muted">
                                        {{ $trx->description ?? '-' }}
                                    </td>

                                    <td class="text-end text-success fw-semibold">
                                        {{ number_format($trx->debit, 2) }}
                                    </td>

                                    <td class="text-end text-danger fw-semibold">
                                        {{ number_format($trx->credit, 2) }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Tidak ada data transaksi
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    {{-- PRINT STYLE --}}
    <style>
        @media print {

            /* sembunyikan UI admin */
            .btn,
            nav,
            footer,
            .card-header {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            table {
                font-size: 12px;
            }

        }
    </style>
@endsection
