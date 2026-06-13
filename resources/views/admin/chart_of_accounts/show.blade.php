@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- HERO HEADER --}}
        <div class="rounded-4 p-5 mb-4 text-white shadow position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #4f46e5, #0d6efd);">

            <div class="position-absolute top-0 end-0 opacity-25">
                <i class="bi bi-journal-text" style="font-size: 150px;"></i>
            </div>

            <div class="position-relative">

                <h2 class="fw-bold mb-2">
                    <i class="bi bi-eye me-2"></i>
                    Detail Chart of Account
                </h2>

                <p class="mb-0 opacity-75">
                    Informasi lengkap dan struktur akun dalam sistem akuntansi
                </p>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- HEADER CARD --}}
                    <div class="card-header bg-white border-0 p-4">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-info-circle text-primary me-1"></i>
                            Informasi COA
                        </h5>
                    </div>

                    <div class="card-body p-5">

                        <div class="row g-4">

                            {{-- CODE --}}
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded-3 border">

                                    <small class="text-muted d-block">Account Code</small>

                                    <span class="badge bg-dark px-3 py-2 fs-6 mt-1">
                                        {{ $coa->code }}
                                    </span>

                                </div>
                            </div>

                            {{-- NAME --}}
                            <div class="col-md-8">
                                <div class="p-3 bg-light rounded-3 border">

                                    <small class="text-muted d-block">Account Name</small>

                                    <h5 class="fw-bold mb-0 text-dark">
                                        {{ $coa->name }}
                                    </h5>

                                </div>
                            </div>

                            {{-- CATEGORY --}}
                            <div class="col-12">
                                <div class="p-3 bg-light rounded-3 border">

                                    <small class="text-muted d-block">Category</small>

                                    <span class="badge bg-info text-dark px-3 py-2 mt-1">
                                        <i class="bi bi-tags me-1"></i>
                                        {{ $coa->category->name ?? '-' }}
                                    </span>

                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- FOOTER ACTION --}}
                    <div class="card-footer bg-white border-0 p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <a href="{{ route('admin.chart-of-accounts.index') }}"
                                class="btn btn-light border px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali

                            </a>

                            <a href="{{ route('admin.chart-of-accounts.edit', $coa->id) }}"
                                class="btn btn-warning px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-pencil-square me-1"></i>
                                Edit COA

                            </a>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
