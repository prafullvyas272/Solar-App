<?php

namespace Database\Seeders;

use App\Enums\TransactionType;
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

        $incomeCategories = [
            'Sales / Revenue',
            'Service Charges / Consulting Fees',
            'Commission Received',
            'Interest Income',
            'Rent Received (if applicable)',
            'Other Income / Miscellaneous',
        ];

        $expenseCategories = [
            'Salaries / Wages',
            'Rent / Office Space',
            'Utilities (Electricity, Water, Internet)',
            'Office Supplies / Stationery',
            'Fuel / Travel / Transportation',
            'Marketing / Advertising',
            'Repairs & Maintenance',
            'Taxes / GST / Other Levies',
            'Miscellaneous / Other Expenses',
        ];

        foreach ($categories as $category) {
            if (ExpenseCategory::where('name', $category)->doesntExist()) {
                ExpenseCategory::create(['name' => $category]);
            }
        }

        foreach ($incomeCategories as $category) {
            if (ExpenseCategory::where('name', $category)->doesntExist()) {
                ExpenseCategory::create(['name' => $category, 'expense_type' => TransactionType::INCOME->value]);
            }
        }

        foreach ($expenseCategories as $category) {
            if (ExpenseCategory::where('name', $category)->doesntExist()) {
                ExpenseCategory::create(['name' => $category, 'expense_type' => TransactionType::EXPENSE->value]);

            }
        }
    }
}
