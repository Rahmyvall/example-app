@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- =========================
             HEADER
        ========================= -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Financial Summary</h4>
                <small class="text-muted">Manage your monthly financial data</small>
            </div>

            <button class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal"
                data-bs-target="#createModal">
                <i class="bx bx-plus"></i>
                Add Data
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success py-2">
                {{ session('success') }}
            </div>
        @endif

        <!-- =========================
             CHART (BALANCED SIZE)
        ========================= -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-muted">Monthly Overview</h6>
                </div>

                <div style="height: 200px;">
                    <canvas id="financialChart"></canvas>
                </div>

            </div>
        </div>

        <!-- =========================
             TABLE
        ========================= -->
        <div class="card border-0 shadow-sm">
            <div class="card-body table-responsive">

                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Category</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reports as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->category }}</td>

                                <td>Rp {{ number_format($item->amount_2022_01) }}</td>
                                <td>Rp {{ number_format($item->amount_2022_02) }}</td>
                                <td>Rp {{ number_format($item->amount_2022_03) }}</td>

                                <td class="d-flex gap-1">

                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        <i class="bx bx-edit"></i>
                                    </button>

                                    <form action="{{ route('admin.financial-summary.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this data?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            <!-- =========================
                                 EDIT MODAL
                            ========================= -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">

                                        <form action="{{ route('admin.financial-summary.update', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title text-dark">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body p-4">

                                                <label class="small text-muted">Category</label>
                                                <input type="text" name="category" class="form-control mb-3"
                                                    value="{{ $item->category }}">

                                                <div class="row g-2">

                                                    <div class="col-6">
                                                        <label class="small text-muted">Jan</label>
                                                        <input type="number" name="amount_2022_01" class="form-control"
                                                            value="{{ $item->amount_2022_01 }}">
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="small text-muted">Feb</label>
                                                        <input type="number" name="amount_2022_02" class="form-control"
                                                            value="{{ $item->amount_2022_02 }}">
                                                    </div>

                                                    <div class="col-12 mt-2">
                                                        <label class="small text-muted">Mar</label>
                                                        <input type="number" name="amount_2022_03" class="form-control"
                                                            value="{{ $item->amount_2022_03 }}">
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button class="btn btn-warning px-4">
                                                    Update
                                                </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $reports->links() }}
                </div>

            </div>
        </div>

    </div>

    <!-- =========================
         CREATE MODAL (PRO UI)
    ========================= -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <form action="{{ route('admin.financial-summary.store') }}" method="POST">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Data</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">

                        <label class="small text-muted">Category</label>
                        <input type="text" name="category" class="form-control mb-3" placeholder="e.g Revenue / Expense">

                        <div class="row g-2">

                            <div class="col-6">
                                <label class="small text-muted">Jan</label>
                                <input type="number" name="amount_2022_01" class="form-control">
                            </div>

                            <div class="col-6">
                                <label class="small text-muted">Feb</label>
                                <input type="number" name="amount_2022_02" class="form-control">
                            </div>

                            <div class="col-12 mt-2">
                                <label class="small text-muted">Mar</label>
                                <input type="number" name="amount_2022_03" class="form-control">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button class="btn btn-primary px-4">
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- =========================
         CHART JS (STABLE SIZE)
    ========================= -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const jan = @json($reports->sum('amount_2022_01'));
        const feb = @json($reports->sum('amount_2022_02'));
        const mar = @json($reports->sum('amount_2022_03'));

        new Chart(document.getElementById('financialChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar'],
                datasets: [{
                    data: [jan, feb, mar],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
