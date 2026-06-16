@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-0">Laporan Transaksi</h4>

            <small class="text-muted">
                Periode :
                <strong>
                    {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                    {{ $year }}
                </strong>
            </small>
        </div>

        <button onclick="window.print()"
                class="btn btn-dark btn-sm">
            Print
        </button>

    </div>

    {{-- Summary --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Debit
                    </p>

                    <h4 class="text-success mb-0">
                        Rp {{ number_format($totalDebit ?? 0, 0, ',', '.') }}
                    </h4>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Credit
                    </p>

                    <h4 class="text-danger mb-0">
                        Rp {{ number_format($totalCredit ?? 0, 0, ',', '.') }}
                    </h4>

                </div>
            </div>
        </div>

    </div>

    {{-- Detail --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between">

            <strong>Detail Transaksi</strong>

            <small class="text-muted">
                {{ $transactions->count() }} transaksi
            </small>

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

                        @forelse($transactions as $trx)

                            <tr>

                                <td>
                                    {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                                </td>

                                <td>
                                    {{ $trx->chartOfAccount?->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $trx->description ?: '-' }}
                                </td>

                                <td class="text-end text-success fw-semibold">
                                    @if($trx->debit > 0)
                                        Rp {{ number_format($trx->debit, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-end text-danger fw-semibold">
                                    @if($trx->credit > 0)
                                        Rp {{ number_format($trx->credit, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center py-4 text-muted">
                                    Tidak ada data transaksi pada periode ini.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Ringkasan Bulanan --}}
    @if(isset($monthlySummary) && $monthlySummary->count())

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-white">
            <strong>
                Ringkasan Bulanan Tahun {{ $year }}
            </strong>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-sm mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Bulan</th>
                            <th class="text-end">Total Debit</th>
                            <th class="text-end">Total Credit</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($monthlySummary as $item)

                            <tr>

                                <td>
                                    {{ \Carbon\Carbon::create()->month($item->month)->translatedFormat('F') }}
                                </td>

                                <td class="text-end text-success">
                                    Rp {{ number_format($item->total_debit, 0, ',', '.') }}
                                </td>

                                <td class="text-end text-danger">
                                    Rp {{ number_format($item->total_credit, 0, ',', '.') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @endif

</div>

<style>
@media print {

    .btn,
    nav,
    footer,
    .no-print {
        display: none !important;
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
