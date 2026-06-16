@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold">📊 Laporan Bulanan</h4>
            <small class="text-muted">Manajemen Profit & Loss Report</small>
        </div>
    </div>

    {{-- GENERATE CARD --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">

            <div class="mb-3">
                <h5 class="fw-semibold mb-1">Generate Monthly Report</h5>
                <small class="text-muted">Pilih bulan dan tahun untuk membuat laporan</small>
            </div>

            <form action="{{ route('admin.monthly-report.store') }}" method="POST" class="row g-3 align-items-end">
                @csrf

                <!-- Month -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Bulan</label>
                    <select name="month" class="form-select shadow-sm" required>
                        <option disabled selected>-- Pilih Bulan --</option>
                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">
                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                            @endfor
                    </select>
                </div>

                <!-- Year -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun</label>
                    <input type="number" name="year" class="form-control shadow-sm" value="{{ date('Y') }}" min="2000"
                        max="{{ date('Y') + 1 }}" required>
                </div>

                <!-- Button -->
                <div class="col-md-4">
                    <button type="submit"
                        class="btn btn-primary w-100 py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <span>🔄</span>
                        <span>Generate Report</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
    {{-- TABLE CARD --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <strong>Daftar Laporan</strong>
            <span class="text-muted small">
                Total: {{ $reports->count() ?? 0 }}
            </span>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Periode</th>
                            <th>Income</th>
                            <th>Expense</th>
                            <th>Profit</th>
                            <th>Status</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($reports as $report)
                        @php
                        $monthName = DateTime::createFromFormat('!m', $report->month)->format('F');
                        @endphp

                        <tr>

                            {{-- PERIODE --}}
                            <td>
                                <div class="fw-bold">
                                    {{ $monthName }} {{ $report->year }}
                                </div>
                            </td>

                            {{-- INCOME --}}
                            <td class="text-success fw-bold">
                                Rp {{ number_format($report->total_income, 0, ',', '.') }}
                            </td>

                            {{-- EXPENSE --}}
                            <td class="text-danger fw-bold">
                                Rp {{ number_format($report->total_expense, 0, ',', '.') }}
                            </td>

                            {{-- PROFIT --}}
                            <td class="fw-bold {{ $report->profit >= 0 ? 'text-success' : 'text-danger' }}">
                                Rp {{ number_format($report->profit, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if ($report->profit >= 0)
                                <span class="badge bg-success">Profit</span>
                                @else
                                <span class="badge bg-danger">Loss</span>
                                @endif
                            </td>

                            {{-- ACTION --}}
                            <td class="d-flex gap-1">

                                <a href="{{ route('admin.monthly-report.show', $report->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    👁
                                </a>

                                <form action="{{ route('admin.monthly-report.destroy', $report->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus report ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        🗑
                                    </button>
                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                📭 Belum ada laporan bulan ini
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="card-footer bg-white border-0">
            {{ $reports->links() }}
        </div>

    </div>

</div>
@endsection
