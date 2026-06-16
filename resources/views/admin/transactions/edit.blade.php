@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit Transaksi</h4>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST"
                id="transactionForm">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Tanggal <span class="text-danger">*</span>
                        </label>

                        <input type="date" name="date"
                            value="{{ old('date', \Carbon\Carbon::parse($transaction->date)->format('Y-m-d')) }}"
                            class="form-control @error('date') is-invalid @enderror" required>

                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- COA --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Chart Of Account <span class="text-danger">*</span>
                        </label>

                        <select name="coa_id" class="form-select @error('coa_id') is-invalid @enderror" required>

                            <option value="">-- Pilih COA --</option>

                            @foreach($coas as $coa)
                            <option value="{{ $coa->id }}"
                                {{ old('coa_id', $transaction->coa_id) == $coa->id ? 'selected' : '' }}>

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
                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $transaction->description) }}</textarea>

                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Debit (Rp)</label>

                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            {{-- INPUT UNTUK USER (DISPLAY) --}}
                            <input type="text" id="debit_display"
                                class="form-control text-end @error('debit') is-invalid @enderror"
                                value="{{ old('debit', number_format($transaction->debit ?? 0, 0, ',', '.')) }}">

                            {{-- INPUT YANG KIRIM KE DATABASE --}}
                            <input type="hidden" name="debit" id="debit"
                                value="{{ old('debit', $transaction->debit) }}">
                        </div>

                        @error('debit')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Credit --}}
                    <div class="col-md-6">
                        <label class="form-label">Credit (Rp)</label>

                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            {{-- INPUT DISPLAY --}}
                            <input type="text" id="credit_display"
                                class="form-control text-end @error('credit') is-invalid @enderror"
                                value="{{ old('credit', number_format($transaction->credit ?? 0, 0, ',', '.')) }}">

                            {{-- INPUT HIDDEN UNTUK DATABASE --}}
                            <input type="hidden" name="credit" id="credit"
                                value="{{ old('credit', $transaction->credit) }}">
                        </div>

                        @error('credit')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
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

    // INPUT DISPLAY (yang diketik user)
    const debitInput = document.getElementById('debit_display');
    const creditInput = document.getElementById('credit_display');

    // INPUT HIDDEN (yang dikirim ke database)
    const debitHidden = document.getElementById('debit');
    const creditHidden = document.getElementById('credit');

    const form = document.getElementById('transactionForm');

    function cleanNumber(value) {
        return value ? value.replace(/\D/g, '') : '';
    }

    function formatRupiah(value) {
        if (!value || value == 0) return '';
        return new Intl.NumberFormat('id-ID').format(value);
    }

    // INIT VALUE (untuk edit form)
    if (debitHidden.value > 0) {
        debitInput.value = formatRupiah(debitHidden.value);
    }

    if (creditHidden.value > 0) {
        creditInput.value = formatRupiah(creditHidden.value);
    }

    // DEBIT INPUT
    debitInput.addEventListener('input', function() {

        let value = cleanNumber(this.value);

        this.value = formatRupiah(value);
        debitHidden.value = value || 0;

        // auto reset credit
        if (value > 0) {
            creditInput.value = '';
            creditHidden.value = 0;
        }
    });

    // CREDIT INPUT
    creditInput.addEventListener('input', function() {

        let value = cleanNumber(this.value);

        this.value = formatRupiah(value);
        creditHidden.value = value || 0;

        // auto reset debit
        if (value > 0) {
            debitInput.value = '';
            debitHidden.value = 0;
        }
    });

    // sebelum submit pastikan bersih
    form.addEventListener('submit', function() {

        debitHidden.value = cleanNumber(debitInput.value) || 0;
        creditHidden.value = cleanNumber(creditInput.value) || 0;
    });

});
</script>
@endpush