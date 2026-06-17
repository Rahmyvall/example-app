@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Tanggal</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>COA</label>
                        <select name="coa_id" class="form-select" required>
                            <option value="">-- pilih --</option>
                            @foreach($coas as $coa)
                            <option value="{{ $coa->id }}">{{ $coa->code }} - {{ $coa->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label>Debit</label>
                        <input type="number" name="debit" class="form-control" min="0" step="0.01">
                    </div>

                    <div class="col-md-6">
                        <label>Credit</label>
                        <input type="number" name="credit" class="form-control" min="0" step="0.01">
                    </div>

                </div>

                <br>

                <button class="btn btn-success">Simpan</button>

            </form>

        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const debit = document.getElementById('debit');
    const credit = document.getElementById('credit');

    function updateState() {
        const d = parseFloat(debit.value || 0);
        const c = parseFloat(credit.value || 0);

        if (d > 0) {
            credit.value = '';
            credit.disabled = true;
        } else {
            credit.disabled = false;
        }

        if (c > 0) {
            debit.value = '';
            debit.disabled = true;
        } else {
            debit.disabled = false;
        }
    }

    debit.addEventListener('input', function() {
        if (this.value) credit.value = '';
        updateState();
    });

    credit.addEventListener('input', function() {
        if (this.value) debit.value = '';
        updateState();
    });

    updateState();

});
</script>
@endpush
