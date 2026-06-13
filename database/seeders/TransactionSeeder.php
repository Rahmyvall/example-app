<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\ChartOfAccount;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // 🔥 AUTO CREATE COA JIKA BELUM ADA
        $coa401 = ChartOfAccount::firstOrCreate(
            ['code' => 401],
            ['name' => 'Gaji Karyawan', 'category_id' => 1]
        );

        $coa402 = ChartOfAccount::firstOrCreate(
            ['code' => 402],
            ['name' => 'Gaji Ketua MPR', 'category_id' => 1]
        );

        $coa602 = ChartOfAccount::firstOrCreate(
            ['code' => 602],
            ['name' => 'Bensin', 'category_id' => 2]
        );

        // 🔥 TRANSAKSI 1
        Transaction::updateOrCreate(
            [
                'date' => '2022-01-01',
                'coa_id' => $coa401->id,
            ],
            [
                'description' => 'Gaji Di Persuhaan A',
                'debit' => 0,
                'credit' => 5000000,
                'user_id' => null,
            ]
        );

        // 🔥 TRANSAKSI 2
        Transaction::updateOrCreate(
            [
                'date' => '2022-01-02',
                'coa_id' => $coa402->id,
            ],
            [
                'description' => 'Gaji Ketum',
                'debit' => 0,
                'credit' => 7000000,
                'user_id' => null,
            ]
        );

        // 🔥 TRANSAKSI 3
        Transaction::updateOrCreate(
            [
                'date' => '2022-01-10',
                'coa_id' => $coa602->id,
            ],
            [
                'description' => 'Bensin Anak',
                'debit' => 25000,
                'credit' => 0,
                'user_id' => null,
            ]
        );
    }
}
