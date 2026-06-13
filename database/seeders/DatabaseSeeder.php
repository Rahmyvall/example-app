<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ChartOfAccountSeeder;
use Database\Seeders\TransactionSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
            ]
        );

        $this->call([
            CategorySeeder::class,
            ChartOfAccountSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
