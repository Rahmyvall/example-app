<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction;

class MonthlyReport extends Model
{
    use HasFactory;

    protected $table = 'monthly_reports';

    protected $fillable = [
        'month',
        'year',
        'title',
        'total_debit',
        'total_credit',
        'profit',
    ];

    protected $casts = [
        'month' => 'integer',
        'year'  => 'integer',
        'total_debit' => 'decimal:2',
        'total_credit' => 'decimal:2',
        'profit' => 'decimal:2',
    ];

    /**
     * RELASI TRANSAKSI (dynamic query)
     */
    public function transactions()
    {
        return Transaction::whereMonth('date', $this->month)
            ->whereYear('date', $this->year);
    }

    /**
     * ACCESSOR: format periode
     */
    public function getPeriodAttribute()
    {
        return sprintf('%04d-%02d', $this->year, $this->month);
    }

    /**
     * ACCESSOR: nama bulan
     */
    public function getMonthNameAttribute()
    {
        return [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ][$this->month] ?? '-';
    }
}