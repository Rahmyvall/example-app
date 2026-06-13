<?php

namespace Database\Factories;

use App\Models\ChartOfAccount;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChartOfAccountFactory extends Factory
{
    protected $model = ChartOfAccount::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->numerify('###'),
            'name' => $this->faker->randomElement([
                'Meal Expense',
                'Transport Expense',
                'Office Supplies',
                'Sales Revenue',
                'Service Income',
            ]),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
