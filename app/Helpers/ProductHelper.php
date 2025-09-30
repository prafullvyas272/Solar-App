<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\StockPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductHelper
{
    /**
     * Create multiple products with serial numbers.
     *
     * @param StockPurchase $stockPurchase
     * @return array  // Array of created Product models
     */
    public static function createProductsWithSerialNumbers(StockPurchase $stockPurchase)
    {
        $createdProducts = [];
        $authUser = Auth::user();

        DB::beginTransaction();
        try {
            $quantity = $stockPurchase->quantity;
            for ($i=0; $i < $quantity ; $i++) {
                Product::create([
                    'serial_number' => self::generateDummySerialNumber($stockPurchase, $authUser),
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

    public static function updateProductsOnQuantityUpdate(StockPurchase $stockPurchase, $requestQuantity )
    {
        // Create more
        if ($stockPurchase->quantity < $requestQuantity) {
            $authUser = Auth::user();
            $toCreate = $requestQuantity - $stockPurchase->quantity;
            for ($i = 0; $i < $toCreate; $i++) {
                Product::create([
                    'serial_number' => self::generateDummySerialNumber($stockPurchase, $authUser),
                    'stock_purchase_id' => $stockPurchase->id,
                    'product_category_id' => $stockPurchase->product_category_id,
                    'created_by' => $stockPurchase->created_by,
                ]);
            }
        }

        // If the requested quantity is less than the current quantity, delete the latest products
        if ($stockPurchase->quantity > $requestQuantity) {
            $toDelete = $stockPurchase->quantity - $requestQuantity;
            // Get the latest $toDelete products for this stock purchase, ordered by created_at descending
            $productsToDelete = Product::where('stock_purchase_id', $stockPurchase->id)
                ->orderBy('created_at', 'desc')
                ->take($toDelete)
                ->get();

            foreach ($productsToDelete as $product) {
                $product->delete();
            }
        }

    }

    public static function generateDummySerialNumber(StockPurchase $stockPurchase, $authUser)
    {
        $currentTime = Carbon::now();
        $authUserInitials = strtoupper(substr($authUser->first_name, 0, 1) . substr($authUser->last_name, 0, 1));
        $id = Product::where('stock_purchase_id', $stockPurchase->id)->count() + 1;
        $serialNumber = '#DSN' . $currentTime->format('is') . $authUserInitials . '00' . $id;
        return $serialNumber;
    }


    public function assignProductsToCustomer($customerId, $inverterSerialNumber, $totalNumberOfSolarPanels)
    {
        $solarPanelProductCategoryId = 1;  // we can give a CRUD option for it later if required , then it will not be hardcoded
        Product::where('serial_number', $inverterSerialNumber)->update(['assigned_to' => $customerId]);
        Product::where('product_category_id', $solarPanelProductCategoryId)
               ->where('assigned_to', null)
               ->take($totalNumberOfSolarPanels)
               ->update(['assigned_to' => $customerId]);
    }
}
