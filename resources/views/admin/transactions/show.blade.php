@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1 fw-bold">Detail Transaksi</h4>
                <small class="text-muted">Informasi lengkap transaksi keuangan</small>
            </div>

            <div class="d-flex gap-2">

                {{-- PRINT BUTTON --}}
                <button onclick="window.print()" class="btn btn-dark">
                    🖨 Print
                </button>

                <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary">
                    ← Kembali
                </a>

                <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="btn btn-warning">
                    Edit
                </a>

            </div>

        </div>

        {{-- CARD DETAIL --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- KOLOM KIRI --}}
                    <div class="col-md-6">

                        <div class="mb-3">
                            <small class="text-muted">Tanggal</small>
                            <div class="fw-semibold">
                                {{ \Carbon\Carbon::parse($transaction->date)->format('d F Y') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">COA</small>
                            <div class="fw-semibold">
                                {{ $transaction->chartOfAccount->name ?? '-' }}
                            </div>
                            <small class="text-muted">
                                Code: {{ $transaction->chartOfAccount->code ?? '-' }}
                            </small>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Deskripsi</small>
                            <div class="fw-semibold">
                                {{ $transaction->description ?? '-' }}
                            </div>
                        </div>

                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="col-md-6">

                        <div class="card border-0 bg-success bg-opacity-10 mb-3">
                            <div class="card-body">
                                <small class="text-muted">Debit</small>
                                <h4 class="text-success mb-0">
                                    Rp {{ number_format($transaction->debit, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        <div class="card border-0 bg-danger bg-opacity-10 mb-3">
                            <div class="card-body">
                                <small class="text-muted">Credit</small>
                                <h4 class="text-danger mb-0">
                                    Rp {{ number_format($transaction->credit, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Dibuat oleh</small>
                            <div>
                                <span class="badge bg-light text-dark border">
                                    {{ $transaction->user->name ?? '-' }}
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer bg-white d-flex justify-content-between">

                <small class="text-muted">
                    Created at: {{ $transaction->created_at->format('d M Y H:i') }}
                </small>

                <small class="text-muted">
                    Updated at: {{ $transaction->updated_at->format('d M Y H:i') }}
                </small>

            </div>

        </div>

    </div>

    {{-- PRINT STYLE --}}
    {{-- PRINT STYLE ADVANCED --}}
    <style>
        @media print {

            /* Sembunyikan semua UI admin */
            .btn,
            nav,
            footer,
            .card-footer {
                display: none !important;
            }

            body {
                background: white !important;
                font-family: Arial, sans-serif;
            }

            .container-fluid {
                padding: 0 !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            /* HEADER PRINT STYLE */
            .print-header {
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            .print-header h2 {
                margin: 0;
                font-size: 20px;
                font-weight: bold;
            }

            .print-header small {
                font-size: 12px;
            }

            /* DETAIL STYLE */
            .fw-semibold {
                font-weight: bold !important;
            }

            .text-success {
                color: #000 !important;
                font-weight: bold;
            }

            .text-danger {
                color: #000 !important;
                font-weight: bold;
            }

        }
    </style>
@endsection
