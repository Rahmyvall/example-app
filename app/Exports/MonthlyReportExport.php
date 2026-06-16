<?php

namespace App\Exports;

use App\Models\MonthlyReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthlyReportExport implements FromCollection, WithHeadings
{
    protected $report;

    public function __construct(MonthlyReport $report)
    {
        $this->report = $report;
    }

    public function collection()
    {
        return collect([
            [
                'month' => $this->report->month,
                'year' => $this->report->year,
                'total_income' => $this->report->total_income,
                'total_expense' => $this->report->total_expense,
                'profit' => $this->report->profit,
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'Bulan',
            'Tahun',
            'Total Pemasukan',
            'Total Pengeluaran',
            'Laba'
        ];
    }
}
