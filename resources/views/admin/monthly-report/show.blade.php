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
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>
            <h3 class="mb-1 fw-bold">📊 Monthly Report</h3>
            <div class="text-muted">
                {{ $monthName }} {{ $report->year }}
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="btn-group shadow-sm">

            <a href="{{ route('admin.monthly-report.print', $report->id) }}" target="_blank"
                class="btn btn-outline-dark btn-sm">
                🖨 Print
            </a>

            <a href="{{ route('admin.monthly-report.pdf', $report->id) }}" class="btn btn-danger btn-sm">
                📄 PDF
            </a>

            <a href="{{ route('admin.monthly-report.excel', $report->id) }}" class="btn btn-success btn-sm">
                📊 Excel
            </a>

            <a href="{{ route('admin.monthly-report.index') }}" class="btn btn-outline-secondary btn-sm">
                ← Back
            </a>

        </div>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Income</small>
                    <h4 class="text-success fw-bold mb-0">
                        Rp {{ number_format($income, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Expense</small>
                    <h4 class="text-danger fw-bold mb-0">
                        Rp {{ number_format($expense, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Net Profit</small>
                    <h4 class="fw-bold mb-0 {{ $profit >= 0 ? 'text-success' : 'text-danger' }}">
                        Rp {{ number_format($profit, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

    </div>

    {{-- STATUS --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body text-center">

            <h5 class="fw-semibold mb-3">Performance Summary</h5>

            @if ($profit >= 0)
            <div class="alert alert-success mb-0">
                🎉 This month is
                <strong>PROFIT</strong>:
                Rp {{ number_format($profit, 0, ',', '.') }}
            </div>
            @else
            <div class="alert alert-danger mb-0">
                ⚠️ This month is
                <strong>LOSS</strong>:
                Rp {{ number_format(abs($profit), 0, ',', '.') }}
            </div>
            @endif

        </div>
    </div>

    {{-- DETAIL --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <strong>Report Details</strong>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted">Month</td>
                            <td class="fw-semibold">{{ $monthName }}</td>
                        </tr>

                        <tr>
                            <td class="text-muted">Year</td>
                            <td class="fw-semibold">{{ $report->year }}</td>
                        </tr>

                        <tr>
                            <td class="text-muted">Created</td>
                            <td>{{ optional($report->created_at)->format('d M Y H:i') ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="text-muted">Updated</td>
                            <td>{{ optional($report->updated_at)->format('d M Y H:i') ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h6 class="fw-semibold">Formula</h6>
                        <hr class="my-2">

                        <p class="mb-1 text-muted">Income - Expense = Profit</p>

                        <h5 class="mb-0">
                            {{ number_format($income, 0, ',', '.') }}
                            -
                            {{ number_format($expense, 0, ',', '.') }}
                            =
                            <span class="{{ $profit >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($profit, 0, ',', '.') }}
                            </span>
                        </h5>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @endif

</div>
@endsection
