<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\ProductCategory;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SolarPanelRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $solarPanelProductCategoryId = 1;  // we can give a CRUD option for it later if required , then it will not be hardcoded
        $totalAvailableSolarPanels = Product::whereProductCategoryId($solarPanelProductCategoryId)->whereAssignedTo(null)->count();

        if ($totalAvailableSolarPanels < $value) {
            $fail("Limited stock available. Please reduce the quantity or wait for some days");
        }
    }
}
