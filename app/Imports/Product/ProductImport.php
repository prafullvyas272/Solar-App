<?php

namespace App\Imports\Product;

use App\Enums\HistoryType;
use App\Helpers\ProductHistoryHelper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductImport implements ToCollection
{

    protected $stockPurchaseId;
    protected $productCategoryId;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        try {
            $authUser = Auth::user();
            // Unsetting header row from CSV
            unset($collection[0]);

            foreach ($collection as $row) {
                $serialNumber = $row[0];

                $product = Product::create([
                    'serial_number' => $serialNumber,
                    'stock_purchase_id' => request()->route('stockPurchase')->id,
                    'created_by' => $authUser->id,
                    'product_category_id' => request()->route('stockPurchase')->product_category_id,
                ]);
                $productHistoryHelper = new ProductHistoryHelper();
                $productHistoryHelper->storeProductHistory($product, $authUser, HistoryType::CREATED);
            }
        } catch (\Throwable $e) {
            Log::error('Error importing products from CSV: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
        }
    }
}
