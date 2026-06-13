<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Asset']);
        Category::firstOrCreate(['name' => 'Liability']);
        Category::firstOrCreate(['name' => 'Equity']);
        Category::firstOrCreate(['name' => 'Revenue']);
        Category::firstOrCreate(['name' => 'Expense']);
    }
}
