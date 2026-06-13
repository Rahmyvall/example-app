@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $title }}</h3>
                <small class="text-muted">Dashboard overview</small>
            </div>
        </div>

        <!-- KPI CARDS -->
        <div class="row g-4 mb-4">

            @php
                $cards = [
                    [
                        'title' => 'Total Chart of Accounts',
                        'value' => $totalCoa,
                        'icon' => 'bi-journal-text',
                        'color' => 'primary',
                        'progress' => 100,
                        'note' => 'All accounts in system',
                    ],

                    [
                        'title' => 'Assets Accounts',
                        'value' => $totalAssets,
                        'icon' => 'bi-building',
                        'color' => 'primary',
                        'progress' => $totalCoa > 0 ? round(($totalAssets / $totalCoa) * 100, 1) : 0,
                        'note' => 'Based on COA category: Assets',
                    ],

                    [
                        'title' => 'Expenses Accounts',
                        'value' => $totalExpenses,
                        'icon' => 'bi-wallet2',
                        'color' => 'warning',
                        'progress' => $totalCoa > 0 ? round(($totalExpenses / $totalCoa) * 100, 1) : 0,
                        'note' => 'Based on COA category: Expenses',
                    ],

                    [
                        'title' => 'Total Categories',
                        'value' => $totalCategories,
                        'icon' => 'bi-folder',
                        'color' => 'info',
                        'progress' => 100,
                        'note' => 'All categories in system',
                    ],
                ];
            @endphp


            @foreach ($cards as $card)
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100 kpi-card position-relative overflow-hidden">

                        <!-- glow background effect -->
                        <div class="position-absolute top-0 end-0 opacity-10">
                            <i class="bi {{ $card['icon'] }}" style="font-size: 90px;"></i>
                        </div>

                        <div class="card-body position-relative">

                            <!-- HEADER -->
                            <div class="d-flex justify-content-between align-items-start mb-3">

                                <div>
                                    <small class="text-muted text-uppercase fw-semibold" style="letter-spacing: .5px;">
                                        {{ $card['title'] }}
                                    </small>

                                    <h2 class="fw-bold mb-0 mt-1">
                                        {{ $card['value'] }}
                                    </h2>
                                </div>

                                <!-- ICON BADGE -->
                                <div class="rounded-circle bg-{{ $card['color'] }} bg-opacity-10 p-2">
                                    <i class="bi {{ $card['icon'] }} text-{{ $card['color'] }} fs-5"></i>
                                </div>

                            </div>

                            <!-- PROGRESS -->
                            <div class="progress mb-2" style="height: 6px; border-radius: 10px;">
                                <div class="progress-bar bg-{{ $card['color'] }}" role="progressbar"
                                    style="width: {{ $card['progress'] }}%">
                                </div>
                            </div>

                            <!-- NOTE -->
                            <small class="text-muted">
                                {{ $card['note'] }}
                            </small>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>
        <!-- MAIN SECTION -->
        <div class="row g-4 align-items-stretch">

            <!-- REVENUE CHART -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-semibold mb-0">Total Revenue</h5>
                    </div>

                    <div class="card-body">

                        <div id="revenue-chart" style="height: 280px;"></div>

                        <div class="row text-center mt-4">
                            <div class="col-6">
                                <h4 class="fw-bold mb-1">
                                    Rp {{ number_format($monthlyReports->sum('total_income'), 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">Total Revenue</small>
                            </div>

                            <div class="col-6">
                                <h4 class="fw-bold mb-1">
                                    {{ $monthlyReports->count() }}
                                </h4>
                                <small class="text-muted">Total Months</small>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- TOP USERS -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 d-flex flex-column">

                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-1">Top Users</h5>
                        <small class="text-muted">User terbaru dalam sistem</small>
                    </div>

                    <div class="card-body p-0 flex-grow-1">
                        <div class="table-responsive" style="max-height: 420px; overflow:auto;">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="bg-light sticky-top">
                                    <tr>
                                        <th class="ps-4">User</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="pe-4">Join</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                        style="width:38px;height:38px;font-weight:600;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>

                                                    <div>
                                                        <div class="fw-semibold">{{ $user->name }}</div>
                                                        <small class="text-muted">{{ $user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($user->role === 'admin')
                                                    <span
                                                        class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                                        Admin
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                                                        User
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($user->is_active)
                                                    <span
                                                        class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                                        Nonaktif
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="pe-4 text-muted">
                                                {{ $user->created_at->format('d M Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
