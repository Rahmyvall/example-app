@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @php
    $grandJan = $reports->sum('amount_2022_01');
    $grandFeb = $reports->sum('amount_2022_02');
    $grandMar = $reports->sum('amount_2022_03');

    $grandTotal = $grandJan + $grandFeb + $grandMar;
    @endphp

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-0">
                Financial Profit / Loss
            </h4>
            <small class="text-muted">
                Manage Monthly Financial Report
            </small>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('admin.financial-summary.export.pdf') }}" class="btn btn-danger">

                <i class="bx bxs-file-pdf"></i>
                PDF

            </a>

            <a href="{{ route('admin.financial-summary.export.excel') }}" class="btn btn-success">

                <i class="bx bx-spreadsheet"></i>
                Excel

            </a>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">

                <i class="bx bx-plus"></i>
                Add Data

            </button>

        </div>

    </div>

    {{-- ALERT --}}
    @if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

    @endif

    {{-- SUMMARY CARD --}}
    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        January
                    </small>

                    <h5 class="fw-bold">
                        Rp {{ number_format($grandJan) }}
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        February
                    </small>

                    <h5 class="fw-bold">
                        Rp {{ number_format($grandFeb) }}
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        March
                    </small>

                    <h5 class="fw-bold">
                        Rp {{ number_format($grandMar) }}
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm bg-primary text-white">

                <div class="card-body">

                    <small>
                        Grand Total
                    </small>

                    <h5 class="fw-bold">
                        Rp {{ number_format($grandTotal) }}
                    </h5>

                </div>

            </div>

        </div>

    </div>

    {{-- CHART --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white">

            <strong>
                Monthly Overview
            </strong>

        </div>

        <div class="card-body">
            <div style="height:200px;">
                <canvas id="financialChart"></canvas>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <strong>
                Financial Data
            </strong>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Category</th>
                        <th class="text-end">January</th>
                        <th class="text-end">February</th>
                        <th class="text-end">March</th>
                        <th class="text-end">Total</th>
                        <th width="150">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($reports as $item)

                    @php

                    $total =
                    $item->amount_2022_01 +
                    $item->amount_2022_02 +
                    $item->amount_2022_03;

                    @endphp

                    <tr>

                        <td>
                            {{ $item->category }}
                        </td>

                        <td class="text-end">
                            Rp {{ number_format($item->amount_2022_01) }}
                        </td>

                        <td class="text-end">
                            Rp {{ number_format($item->amount_2022_02) }}
                        </td>

                        <td class="text-end">
                            Rp {{ number_format($item->amount_2022_03) }}
                        </td>

                        <td class="text-end fw-bold text-primary">
                            Rp {{ number_format($total) }}
                        </td>

                        <td>

                            <div class="d-flex gap-1">

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">

                                    <i class="bx bx-edit"></i>

                                </button>

                                <form action="{{ route('admin.financial-summary.destroy',$item->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete data ?')">

                                        <i class="bx bx-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            No Data Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

                <tfoot class="table-secondary">

                    <tr>

                        <th>Total</th>

                        <th class="text-end">
                            Rp {{ number_format($grandJan) }}
                        </th>

                        <th class="text-end">
                            Rp {{ number_format($grandFeb) }}
                        </th>

                        <th class="text-end">
                            Rp {{ number_format($grandMar) }}
                        </th>

                        <th class="text-end text-primary">
                            Rp {{ number_format($grandTotal) }}
                        </th>

                        <th></th>

                    </tr>

                </tfoot>

            </table>

            <div class="mt-3">
                {{ $reports->links() }}
            </div>

        </div>

    </div>

</div>
{{-- TABLE --}}
<div class="card border-0 shadow-sm">
    {{-- EDIT MODAL --}}
    @foreach($reports as $item)
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="{{ route('admin.financial-summary.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="{{ $item->category }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>January</label>
                            <input type="number" name="amount_2022_01" class="form-control"
                                value="{{ $item->amount_2022_01 }}">
                        </div>

                        <div class="mb-3">
                            <label>February</label>
                            <input type="number" name="amount_2022_02" class="form-control"
                                value="{{ $item->amount_2022_02 }}">
                        </div>

                        <div class="mb-3">
                            <label>March</label>
                            <input type="number" name="amount_2022_03" class="form-control"
                                value="{{ $item->amount_2022_03 }}">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
    @endforeach
</div>

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('admin.financial-summary.store') }}" method="POST">

                @csrf

                <div class="modal-header">

                    <h5>Add Data</h5>

                    <button class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Category</label>

                        <input type="text" name="category" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label>January</label>

                        <input type="number" name="amount_2022_01" class="form-control" value="0">

                    </div>

                    <div class="mb-3">

                        <label>February</label>

                        <input type="number" name="amount_2022_02" class="form-control" value="0">

                    </div>

                    <div class="mb-3">

                        <label>March</label>

                        <input type="number" name="amount_2022_03" class="form-control" value="0">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Close

                    </button>

                    <button class="btn btn-primary">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const ctx = document.getElementById('financialChart');

    if (!ctx) {
        console.error('Canvas financialChart tidak ditemukan');
        return;
    }

    const jan = @json($grandJan);
    const feb = @json($grandFeb);
    const mar = @json($grandMar);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'January',
                'February',
                'March'
            ],
            datasets: [{
                label: 'Financial Summary',
                data: [
                    jan,
                    feb,
                    mar
                ],
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#ffc107'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true
                }
            },

            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });

});
</script>
@endsection
