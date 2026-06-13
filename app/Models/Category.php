<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional sebenarnya, Laravel sudah otomatis)
     */
    protected $table = 'categories';

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Cast data
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Relasi ke transactions (jika kategori dipakai untuk transaksi)
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
       public function chartOfAccounts()
    {
        return $this->hasMany(ChartOfAccount::class);
    }
}