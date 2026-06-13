@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- HERO DASHBOARD --}}
        <div class="rounded-4 p-5 mb-4 text-white shadow-lg position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #cdcebfbe, #90e077);">

            {{-- decorative --}}
            <div class="position-absolute top-0 end-0 opacity-25">
                <i class="bi bi-journal-text" style="font-size: 150px;"></i>
            </div>

            <div class="position-relative">

                <h2 class="fw-bold mb-2">
                    <i class="bi bi-plus-circle me-2"></i>
                    {{ $title }}
                </h2>

                <p class="mb-0 opacity-75 text-black">
                    Tambahkan akun baru ke Chart of Accounts dengan struktur akuntansi yang rapi dan profesional
                </p>

            </div>

        </div>

        {{-- FORM SECTION --}}
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card border-0 shadow-xl rounded-4">

                    <div class="card-body p-5">

                        {{-- HEADER FORM --}}
                        <div class="mb-4">
                            <h5 class="fw-bold mb-1">
                                <i class="bi bi-pencil-square text-primary me-1"></i>
                                Form Chart of Account
                            </h5>
                            <small class="text-muted">
                                Isi data dengan benar sesuai standar akuntansi perusahaan
                            </small>
                        </div>

                        <form action="{{ route('admin.chart-of-accounts.store') }}" method="POST">
                            @csrf

                            {{-- GRID --}}
                            <div class="row g-4">

                                {{-- CODE --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-upc-scan text-primary me-1"></i>
                                        Account Code
                                    </label>

                                    <input type="text" name="code"
                                        class="form-control form-control-lg rounded-3 shadow-sm @error('code') is-invalid @enderror"
                                        value="{{ old('code', $nextCode) }}" readonly>

                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <small class="text-muted">
                                        * Auto generate code berikutnya
                                    </small>
                                </div>

                                {{-- NAME --}}
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-journal-text text-primary me-1"></i>
                                        Account Name
                                    </label>

                                    <input type="text" name="name"
                                        class="form-control form-control-lg rounded-3 shadow-sm @error('name') is-invalid @enderror"
                                        placeholder="Kas, Bank, Gaji Karyawan, Beban Operasional..."
                                        value="{{ old('name') }}">

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- CATEGORY --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-tags text-primary me-1"></i>
                                        Category Account
                                    </label>

                                    <select name="category_id"
                                        class="form-select form-select-lg rounded-3 shadow-sm @error('category_id') is-invalid @enderror">

                                        <option value="">-- Pilih Category --</option>

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            {{-- DIVIDER --}}
                            <hr class="my-5">

                            {{-- ACTION BUTTON --}}
                            <div class="d-flex justify-content-between align-items-center">

                                <a href="{{ route('admin.chart-of-accounts.index') }}"
                                    class="btn btn-light border px-4 py-2 rounded-3 shadow-sm">

                                    <i class="bi bi-arrow-left me-1"></i>
                                    Kembali

                                </a>

                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm">

                                    <i class="bi bi-check-circle me-1"></i>
                                    Simpan COA

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
