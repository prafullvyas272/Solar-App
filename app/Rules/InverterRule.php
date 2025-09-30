<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class InverterRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $solarPanelProductCategoryId = 2;  // we can give a CRUD option for it later if required , then it will not be hardcoded
        $inverterExist = Product::whereProductCategoryId($solarPanelProductCategoryId)->whereSerialNumber($value)->whereAssignedTo(null)->exists();

        if (!$inverterExist) {
            $fail("Invalid Serial Number");
        }

    }
}
