@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-start mb-4 no-print">

        <div>
            <h4 class="fw-bold mb-1">Detail Transaksi</h4>
            <small class="text-muted">Informasi transaksi keuangan</small>
        </div>

        <div class="d-flex gap-2">

            <button onclick="window.print()" class="btn btn-dark">
                🖨 Print
            </button>

            <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary">
                Kembali
            </a>

            <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="btn btn-warning">
                Edit
            </a>

            <form action="{{ route('admin.transactions.destroy', $transaction->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger">
                    Hapus
                </button>
            </form>

        </div>

    </div>

    {{-- PRINT HEADER (hanya muncul saat print) --}}
    <div class="print-header d-none">
        <h2>LAPORAN TRANSAKSI KEUANGAN</h2>
        <small>Dicetak pada {{ now()->format('d M Y H:i') }}</small>
        <hr>
    </div>

    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <small class="text-muted">Tanggal</small>
                        <div class="fw-bold fs-6">
                            {{ \Carbon\Carbon::parse($transaction->date)->translatedFormat('d F Y') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Chart of Account</small>
                        <div class="fw-bold">
                            {{ $transaction->chartOfAccount?->name ?? '-' }}
                        </div>
                        <small class="text-muted">
                            Kode:
                            {{ $transaction->chartOfAccount?->account_code
                                ?? $transaction->chartOfAccount?->code
                                ?? '-' }}
                        </small>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Deskripsi</small>
                        <div class="fw-semibold">
                            {{ $transaction->description ?? '-' }}
                        </div>
                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-md-6">

                    <div class="p-3 rounded bg-success bg-opacity-10 mb-3">
                        <small class="text-muted">Debit</small>
                        <h4 class="text-success mb-0 fw-bold">
                            Rp {{ number_format($transaction->debit, 0, ',', '.') }}
                        </h4>
                    </div>

                    <div class="p-3 rounded bg-danger bg-opacity-10 mb-3">
                        <small class="text-muted">Credit</small>
                        <h4 class="text-danger mb-0 fw-bold">
                            Rp {{ number_format($transaction->credit, 0, ',', '.') }}
                        </h4>
                    </div>

                    <div>
                        <small class="text-muted">Dibuat oleh</small><br>
                        <span class="badge bg-light text-dark border mt-1">
                            {{ $transaction->user?->name ?? '-' }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="card-footer bg-white no-print">

            <div class="row">

                <div class="col-md-6">
                    <small class="text-muted">
                        Created: {{ $transaction->created_at?->format('d M Y H:i') }}
                    </small>
                </div>

                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        Updated: {{ $transaction->updated_at?->format('d M Y H:i') }}
                    </small>
                </div>

            </div>

        </div>

    </div>

</div>

{{-- STYLE PRINT --}}
<style>
@media print {

    body {
        background: #fff !important;
        font-size: 12px;
    }

    .no-print,
    .btn,
    nav,
    footer,
    .card-footer {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }

    .container-fluid {
        padding: 0 !important;
    }

    .print-header {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }

    .print-header h2 {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    .print-header small {
        font-size: 12px;
    }

    .fw-bold,
    .fw-semibold,
    .text-success,
    .text-danger {
        color: #000 !important;
    }
}
</style>

@endsection
