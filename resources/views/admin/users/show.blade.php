@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Detail Pengguna</h4>
                <small class="text-muted">Informasi lengkap user sistem</small>
            </div>

            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- MAIN CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            {{-- HEADER PROFILE --}}
            <div class="bg-primary text-white p-4 d-flex align-items-center gap-3">

                {{-- AVATAR --}}
                <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center"
                    style="width:60px; height:60px; font-weight:bold; font-size:20px;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h5 class="mb-0 fw-bold">{{ $user->name }}</h5>
                    <small class="opacity-75">{{ $user->email }}</small>
                </div>

            </div>

            {{-- BODY --}}
            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- ROLE --}}
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Role</small>
                            <div class="mt-1">
                                @if ($user->role === 'admin')
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                                        Admin
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                        User
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Status</small>
                            <div class="mt-1">
                                @if ($user->is_active)
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- CREATED --}}
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Bergabung</small>
                            <div class="fw-semibold mt-1">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $user->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- EMAIL FULL --}}
                    <div class="col-md-12">
                        <div class="p-3 border rounded-3">
                            <small class="text-muted">Email</small>
                            <div class="fw-semibold">
                                <i class="bi bi-envelope me-1"></i>
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
