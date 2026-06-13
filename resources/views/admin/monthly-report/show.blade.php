@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if (!$report)
            <div class="alert alert-danger">
                Data laporan tidak ditemukan.
            </div>
        @else
            @php
                $monthName = DateTime::createFromFormat('!m', $report->month)?->format('F') ?? '-';
                $income = $report->total_income ?? 0;
                $expense = $report->total_expense ?? 0;
                $profit = $report->profit ?? $income - $expense;
            @endphp

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-0">📊 Detail Laporan Bulanan</h4>
                    <small class="text-muted">
                        {{ $monthName }} {{ $report->year }}
                    </small>
                </div>

                <a href="{{ route('admin.monthly-report.index') }}" class="btn btn-outline-secondary btn-sm">
                    ← Kembali
                </a>
            </div>

            {{-- SUMMARY CARDS --}}
            <div class="row g-3 mb-4">

                {{-- INCOME --}}
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <small class="text-muted">Total Income</small>
                            <h4 class="text-success mb-0">
                                Rp {{ number_format($income, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>

                {{-- EXPENSE --}}
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <small class="text-muted">Total Expense</small>
                            <h4 class="text-danger mb-0">
                                Rp {{ number_format($expense, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>

                {{-- PROFIT --}}
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <small class="text-muted">Profit</small>
                            <h4 class="{{ $profit >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                                Rp {{ number_format($profit, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

            {{-- STATUS ALERT --}}
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body text-center">

                    <h5 class="mb-2">Ringkasan Performa</h5>

                    @if ($profit >= 0)
                        <div class="alert alert-success mb-0">
                            🎉 Bulan ini <strong>untung</strong> sebesar
                            <strong>Rp {{ number_format($profit, 0, ',', '.') }}</strong>
                        </div>
                    @else
                        <div class="alert alert-danger mb-0">
                            ⚠️ Bulan ini <strong>rugi</strong> sebesar
                            <strong>Rp {{ number_format(abs($profit), 0, ',', '.') }}</strong>
                        </div>
                    @endif

                </div>
            </div>

            {{-- DETAIL INFO --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <strong>Detail Informasi</strong>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Bulan</strong></td>
                                    <td>{{ $monthName }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Tahun</strong></td>
                                    <td>{{ $report->year }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Dibuat</strong></td>
                                    <td>{{ optional($report->created_at)->format('d M Y H:i') ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Update</strong></td>
                                    <td>{{ optional($report->updated_at)->format('d M Y H:i') ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6>Perhitungan</h6>
                                <hr>

                                <p class="mb-1">Income - Expense = Profit</p>

                                <p class="mb-0">
                                    {{ number_format($income, 0, ',', '.') }}
                                    -
                                    {{ number_format($expense, 0, ',', '.') }}
                                    =
                                    <strong>{{ number_format($profit, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
