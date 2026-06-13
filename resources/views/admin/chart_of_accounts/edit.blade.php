@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- HERO --}}
        <div class="rounded-4 p-5 mb-4 text-white shadow position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #f59e0b, #ef4444);">

            <div class="position-absolute top-0 end-0 opacity-25">
                <i class="bi bi-pencil-square" style="font-size: 140px;"></i>
            </div>

            <div class="position-relative">

                <h2 class="fw-bold mb-2">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Chart of Account
                </h2>

                <p class="mb-0 opacity-75">
                    Perbarui data akun COA
                </p>

            </div>

        </div>

        {{-- FORM --}}
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-5">

                        <form action="{{ route('admin.chart-of-accounts.update', $coa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                {{-- CODE --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Account Code</label>

                                    <input type="text" name="code"
                                        class="form-control form-control-lg rounded-3 @error('code') is-invalid @enderror"
                                        value="{{ old('code', $coa->code) }}">

                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- NAME --}}
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Account Name</label>

                                    <input type="text" name="name"
                                        class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                        value="{{ old('name', $coa->name) }}">

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- CATEGORY --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Category</label>

                                    <select name="category_id"
                                        class="form-select form-select-lg rounded-3 @error('category_id') is-invalid @enderror">

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $coa->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            {{-- ACTION --}}
                            <hr class="my-4">

                            <div class="d-flex justify-content-between">

                                <a href="{{ route('admin.chart-of-accounts.index') }}" class="btn btn-light border px-4">

                                    <i class="bi bi-arrow-left me-1"></i>
                                    Kembali

                                </a>

                                <button class="btn btn-primary px-4">

                                    <i class="bi bi-save me-1"></i>
                                    Update COA

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
