@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Tambah Transaksi</h4>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.transactions.store') }}" method="POST" id="transactionForm">
                @csrf

                <div class="row g-3">

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label for="date" class="form-label">
                            Tanggal <span class="text-danger">*</span>
                        </label>

                        <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}"
                            class="form-control @error('date') is-invalid @enderror" required>

                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- COA --}}
                    <div class="col-md-6">
                        <label for="coa_id" class="form-label">
                            Chart Of Account <span class="text-danger">*</span>
                        </label>

                        <select name="coa_id" id="coa_id" class="form-select @error('coa_id') is-invalid @enderror"
                            required>

                            <option value="">-- Pilih COA --</option>

                            @foreach($coas as $coa)
                            <option value="{{ $coa->id }}" {{ old('coa_id') == $coa->id ? 'selected' : '' }}>
                                {{ $coa->account_code ?? $coa->code ?? '' }}
                                - {{ $coa->name }}
                            </option>
                            @endforeach

                        </select>

                        @error('coa_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label for="description" class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Debit --}}
                    <div class="col-md-6">
                        <label for="debit" class="form-label">
                            Debit
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            <input type="number" name="debit" id="debit"
                                class="form-control @error('debit') is-invalid @enderror" value="{{ old('debit', 0) }}"
                                min="0" step="0.01">
                        </div>

                        @error('debit')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Credit --}}
                    <div class="col-md-6">
                        <label for="credit" class="form-label">
                            Credit
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            <input type="number" name="credit" id="credit"
                                class="form-control @error('credit') is-invalid @enderror"
                                value="{{ old('credit', 0) }}" min="0" step="0.01">
                        </div>

                        @error('credit')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>

                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const debitInput = document.getElementById('debit');
    const creditInput = document.getElementById('credit');

    const debitHidden = document.getElementById('debit_hidden');
    const creditHidden = document.getElementById('credit_hidden');

    const form = document.getElementById('transactionForm');

    function cleanNumber(value) {
        return value.replace(/\D/g, '');
    }

    function formatRupiah(value) {
        if (!value) return '';
        return new Intl.NumberFormat('id-ID').format(value);
    }

    function updateDebit() {
        let value = cleanNumber(debitInput.value);

        debitInput.value = formatRupiah(value);
        debitHidden.value = value || 0;

        if (value > 0) {
            creditInput.value = '';
            creditHidden.value = 0;
        }
    }

    function updateCredit() {
        let value = cleanNumber(creditInput.value);

        creditInput.value = formatRupiah(value);
        creditHidden.value = value || 0;

        if (value > 0) {
            debitInput.value = '';
            debitHidden.value = 0;
        }
    }

    debitInput.addEventListener('input', updateDebit);
    creditInput.addEventListener('input', updateCredit);

    form.addEventListener('submit', function() {
        debitHidden.value =
            cleanNumber(debitInput.value) || 0;

        creditHidden.value =
            cleanNumber(creditInput.value) || 0;
    });

    if (debitHidden.value > 0) {
        debitInput.value =
            formatRupiah(debitHidden.value);
    }

    if (creditHidden.value > 0) {
        creditInput.value =
            formatRupiah(creditHidden.value);
    }

});
</script>
@endpush