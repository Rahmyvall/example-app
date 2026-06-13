<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyTransactionExport implements FromView
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        $transactions = Transaction::with('chartOfAccount')
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->orderBy('date', 'asc')
            ->get();

        return view('exports.monthly_transactions', [
            'transactions' => $transactions,
            'month' => $this->month,
            'year' => $this->year,
        ]);
    }
}