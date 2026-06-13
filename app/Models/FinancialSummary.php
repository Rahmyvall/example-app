<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialSummary extends Model
{
    use HasFactory;

    /**
     * Nama tabel (optional kalau sudah sesuai konvensi bisa dihapus)
     */
    protected $table = 'financial_summary';

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'category',
        'amount_2022_01',
        'amount_2022_02',
        'amount_2022_03',
    ];

    /**
     * Casting tipe data agar lebih konsisten
     */
    protected $casts = [
        'amount_2022_01' => 'integer',
        'amount_2022_02' => 'integer',
        'amount_2022_03' => 'integer',
    ];

    /**
     * Timestamp aktif (default Laravel sudah true)
     */
    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | OPTIONAL: Accessor (biar format angka lebih rapi)
    |--------------------------------------------------------------------------
    */

    public function getAmount202201Attribute($value)
    {
        return (int) $value;
    }

    public function getAmount202202Attribute($value)
    {
        return (int) $value;
    }

    public function getAmount202203Attribute($value)
    {
        return (int) $value;
    }

    /*
    |--------------------------------------------------------------------------
    | OPTIONAL: Scope (filter kategori)
    |--------------------------------------------------------------------------
    */

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}