<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
    'date',
    'coa_id',
    'description',
    'debit',
    'credit',
    'user_id',
];

    protected $casts = [
        'date'   => 'date',
        'debit'  => 'decimal:2',
        'credit' => 'decimal:2',
    ];

    /**
     * Relasi ke Chart Of Account
     */
    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class, 'coa_id');
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias relasi COA
     */
    public function coa()
    {
        return $this->belongsTo(ChartOfAccount::class, 'coa_id');
    }

    /**
     * Scope Debit
     */
    public function scopeDebit($query)
    {
        return $query->where('debit', '>', 0);
    }

    /**
     * Scope Credit
     */
    public function scopeCredit($query)
    {
        return $query->where('credit', '>', 0);
    }

    /**
     * Cek transaksi debit
     */
    public function getIsDebitAttribute()
    {
        return $this->debit > 0;
    }

    /**
     * Cek transaksi kredit
     */
    public function getIsCreditAttribute()
    {
        return $this->credit > 0;
    }

    /**
     * Nominal transaksi
     */
    public function getAmountAttribute()
    {
        return $this->debit > 0
            ? $this->debit
            : $this->credit;
    }
}