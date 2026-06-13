<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromCollection
{
    public function collection()
    {
        return Transaction::with('chartOfAccount')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($trx) {
                return [
                    'Tanggal' => $trx->date,
                    'COA' => $trx->chartOfAccount->name ?? '-',
                    'Deskripsi' => $trx->description,
                    'Debit' => $trx->debit,
                    'Credit' => $trx->credit,
                ];
            });
    }
}