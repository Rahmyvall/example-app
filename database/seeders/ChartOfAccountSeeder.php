<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {

            ChartOfAccount::updateOrCreate(
                ['code' => 400 + $i], // biar unik: 401,402,403...
                [
                    'name' => 'Account ' . $i,
                    'category_id' => 1,
                ]
            );
        }
    }
}
