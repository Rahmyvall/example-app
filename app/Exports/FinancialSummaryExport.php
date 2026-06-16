<?php

namespace App\Exports;

use App\Models\FinancialSummary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinancialSummaryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return FinancialSummary::select(
            'category',
            'amount_2022_01',
            'amount_2022_02',
            'amount_2022_03'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Category',
            'January',
            'February',
            'March',
        ];
    }
}
