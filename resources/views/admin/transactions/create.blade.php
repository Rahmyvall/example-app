@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0">Tambah Transaksi</h4>
                <small class="text-muted">Input data transaksi keuangan</small>
            </div>

            <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary">
                ← Kembali
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form action="{{ route('admin.transactions.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        {{-- TANGGAL --}}
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control form-control-lg" required>
                        </div>

                        {{-- COA --}}
                        <div class="col-md-4">
                            <label class="form-label">COA</label>
                            <select name="coa_id" class="form-select form-select-lg" required>
                                <option value="">-- Pilih COA --</option>
                                @foreach ($coas as $coa)
                                    <option value="{{ $coa->id }}">
                                        {{ $coa->code }} - {{ $coa->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="col-md-4">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control form-control-lg"
                                placeholder="Keterangan transaksi">
                        </div>

                        {{-- DEBIT --}}
                        <div class="col-md-6">
                            <label class="form-label text-success">Debit</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-success text-white">Rp</span>
                                <input type="number" step="0.01" name="debit" class="form-control" value="0">
                            </div>
                        </div>

                        {{-- CREDIT --}}
                        <div class="col-md-6">
                            <label class="form-label text-danger">Credit</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-danger text-white">Rp</span>
                                <input type="number" step="0.01" name="credit" class="form-control" value="0">
                            </div>
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end mt-4 gap-2">

                        <button type="reset" class="btn btn-light">
                            Reset
                        </button>

                        <button class="btn btn-success px-4">
                            💾 Simpan Transaksi
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
