<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Product\ProductImport;
use App\Models\Product;
use App\Models\ProductCategory;


class ProductCSVFileRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $rows = Excel::toArray(new ProductImport, $value)[0];
        // unset first row (header)
        unset($rows[0]);

        // Check if there are any rows after header
        if (empty($rows)) {
            $fail('The CSV file must contain at least one data row.');
            return;
        }

        $serialNumbers = [];
        foreach ($rows as $index => $row) {
            // Check for exactly 2 columns
            if (count($row) !== 2) {
                $fail("Row " . ($index + 2) . " must have exactly 2 columns (SNo, CategoryID).");
                return;
            }

            $sno = trim($row[0]);
            $categoryId = trim($row[1]);

            // Validate SNo: minimum 8 digits, numeric
            if (!preg_match('/^\d{8,}$/', $sno)) {
                $fail("Row " . ($index + 2) . ": SNo must be numeric and at least 8 digits.");
                return;
            }

            // Check for duplicate SNo in file
            if (in_array($sno, $serialNumbers)) {
                $fail("Row " . ($index + 2) . ": Duplicate SNo '{$sno}' found in the file.");
                return;
            }
            $serialNumbers[] = $sno;

            // Check SNo uniqueness in products table
            if (Product::where('serial_number', $sno)->exists()) {
                $fail("Row " . ($index + 2) . ": SNo '{$sno}' already exists in products.");
                return;
            }

            // Check CategoryID exists in product_categories table
            if (!ProductCategory::where('id', $categoryId)->exists()) {
                $fail("Row " . ($index + 2) . ": CategoryID '{$categoryId}' does not exist.");
                return;
            }
        }

    }
}
