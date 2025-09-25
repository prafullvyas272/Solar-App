<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\StockPurchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductHelper
{
    /**
     * Create multiple products with serial numbers.
     *
     * @param StockPurchase $stockPurchase
     * @param array $serialNumbers // Array of serial numbers to create products for
     * @return array  // Array of created Product models
     */
    public static function createProductsWithSerialNumbers(StockPurchase $stockPurchase, $serialNumbers)
    {
        $createdProducts = [];

        DB::beginTransaction();
        try {
            foreach ($serialNumbers as $serialNumber) {
                Product::create([
                    'serial_number' => $serialNumber,
                    'stock_purchase_id' => $stockPurchase->id,
                    'product_category_id' => $stockPurchase->product_category_id,
                    'created_by' => $stockPurchase->created_by,
                ]);
            }
            DB::commit();
            return $createdProducts;
        } catch (\Throwable $e) {
            Log::error('Something went wrong when creating serial numbers' . $e);
            DB::rollBack();
            throw $e;
        }
    }
}
