<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Travel',
            'Installation',
            'Miscellaneous',
            'Repair',
            'Vendor Payment',
            'Office Expense',
        ];

        foreach ($categories as $category) {
            if (ExpenseCategory::where('name', $category)->doesntExist()) {
                ExpenseCategory::create(['name' => $category]);
            }
        }
    }
}
