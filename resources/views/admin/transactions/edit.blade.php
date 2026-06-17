@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Tanggal</label>
                        <input type="date" name="date" value="{{ old('date', $transaction->date) }}"
                            class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>COA</label>
                        <select name="coa_id" class="form-select" required>
                            @foreach($coas as $coa)
                            <option value="{{ $coa->id }}" {{ $transaction->coa_id == $coa->id ? 'selected' : '' }}>
                                {{ $coa->code }} - {{ $coa->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control">{{ $transaction->description }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label>Debit</label>
                        <input type="number" name="debit" value="{{ $transaction->debit }}" class="form-control" min="0"
                            step="0.01">
                    </div>

                    <div class="col-md-6">
                        <label>Credit</label>
                        <input type="number" name="credit" value="{{ $transaction->credit }}" class="form-control"
                            min="0" step="0.01">
                    </div>

                </div>

                <br>

                <button class="btn btn-primary">Update</button>

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

    function validate() {
        const d = parseFloat(debit.value || 0);
        const c = parseFloat(credit.value || 0);

        // hanya validasi ringan (bukan disable)
        if (d < 0) debit.value = 0;
        if (c < 0) credit.value = 0;
    }

    debit.addEventListener('input', validate);
    credit.addEventListener('input', validate);

});
</script>
@endpush