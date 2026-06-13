@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>
                <h3 class="fw-bold mb-1">Tambah Category</h3>
                <p class="text-muted mb-0">Buat kategori baru untuk sistem</p>
            </div>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-light border btn-sm px-4 shadow-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>

        </div>

        {{-- CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-body p-4">

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Ada kesalahan pada input
                        <button class="btn-close" data-bs-dismiss="alert"></button>

                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form action="{{ route('admin.categories.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Category</label>

                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-tag"></i>
                            </span>

                            <input type="text" name="name" class="form-control"
                                placeholder="Contoh: Food, Salary, Transport" value="{{ old('name') }}">
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex gap-2 mt-4">

                        <button type="submit" class="btn btn-primary px-4 shadow-sm rounded-3">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('admin.categories.index') }}"
                            class="btn btn-light border px-4 shadow-sm rounded-3">
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
