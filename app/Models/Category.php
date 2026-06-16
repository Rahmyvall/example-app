<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional, Laravel sudah otomatis mengenali 'categories')
     */
    protected $table = 'categories';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Field yang tidak boleh diisi (alternatif dari fillable)
     * protected $guarded = [];
     */

    /**
     * Relasi
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function chartOfAccounts()
    {
        return $this->hasMany(ChartOfAccount::class);
    }

    /**
     * Optional: Scope untuk pencarian
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%");
    }
}
