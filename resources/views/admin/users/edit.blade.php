@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>
                <h3 class="fw-bold mb-1">Edit Pengguna</h3>
                <p class="text-muted mb-0">Perbarui informasi user sistem</p>
            </div>

            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm rounded-3 px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>

        </div>

        {{-- CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-body p-4">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- SECTION: IDENTITAS --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-person me-1"></i> Informasi Pengguna
                        </h6>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label text-muted">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="form-control shadow-sm rounded-3" placeholder="Masukkan nama">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="form-control shadow-sm rounded-3" placeholder="email@mail.com">
                            </div>

                        </div>
                    </div>

                    {{-- SECTION: AKSES --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-shield-lock me-1"></i> Akses & Role
                        </h6>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label text-muted">Role</label>
                                <select name="role" class="form-select shadow-sm rounded-3">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted">Status Akun</label>
                                <select name="is_active" class="form-select shadow-sm rounded-3">
                                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    {{-- SECTION: PASSWORD --}}
                    <div class="mb-2">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-key me-1"></i> Keamanan
                        </h6>

                        <label class="form-label text-muted">
                            Password Baru <small>(opsional)</small>
                        </label>

                        <input type="password" name="password" class="form-control shadow-sm rounded-3"
                            placeholder="Kosongkan jika tidak diubah">
                    </div>

                    {{-- ACTION BUTTON --}}
                    <div class="mt-4 d-flex justify-content-end gap-2">

                        <a href="{{ route('admin.users.index') }}" class="btn btn-light border rounded-3 px-4">
                            Batal
                        </a>

                        <button class="btn btn-warning shadow-sm rounded-3 px-4">
                            <i class="bi bi-check2-circle me-1"></i> Update Data
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
