<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\StockPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ProductHistoryHelper;
use App\Enums\HistoryType;
use App\Models\ProductCategory;
use App\Imports\Product\ProductImport;
use Illuminate\Http\Request;
use Throwable;

class ProductHelper
{
    protected $productHistoryHelper;

    public function __construct(ProductHistoryHelper $productHistoryHelper)
    {
        $this->productHistoryHelper = $productHistoryHelper;
    }

    /**
     * Create multiple products with serial numbers.
     *
     * @param StockPurchase $stockPurchase
     * @return array  // Array of created Product models
     */
    public static function createProductsWithSerialNumbers(StockPurchase $stockPurchase, $serialNumbers = [])
    {
        $createdProducts = [];
        $authUser = Auth::user();

        DB::beginTransaction();
        try {
            $quantity = $stockPurchase->quantity;
            for ($i=0; $i < $quantity ; $i++) {
                $product = Product::create([
                    'serial_number' => isset($serialNumbers[$i]) ? $serialNumbers[$i] : null ,
                    'stock_purchase_id' => $stockPurchase->id,
                    'product_category_id' => $stockPurchase->product_category_id,
                    'created_by' => $stockPurchase->created_by,
                ]);
                ProductHistoryHelper::storeProductHistory($product, $authUser, HistoryType::CREATED);
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
                    // 'serial_number' => self::generateDummySerialNumber($stockPurchase, $authUser),
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
        // Get current time for possible use in serial number (not currently used)
        $currentTime = Carbon::now();

        // Get user initials (first letter of first and last name, uppercase)
        $authUserInitials = '';
        if (!empty($authUser->first_name)) {
            $authUserInitials .= strtoupper(substr($authUser->first_name, 0, 1));
        }
        if (!empty($authUser->last_name)) {
            $authUserInitials .= strtoupper(substr($authUser->last_name, 0, 1));
        }

        // Determine prefix based on product category
        $type = $stockPurchase->product_category_id == 1 ? 'SOP' : 'INV'; // SOP for solar panel, INV for inverter

        // Start with next available id for this stock purchase
        $id = Product::where('stock_purchase_id', $stockPurchase->id)->count() + 1;

        // Try to generate a unique serial number
        do {
            $randomNumber = rand(10000, 99999);
            $serialNumber = '#' . $type . $randomNumber . $authUserInitials . '00' . $id;
            $id++;
        } while (Product::where('serial_number', $serialNumber)->exists());

        return $serialNumber;
    }


    public function assignProductsToCustomer($customerId, $inverterSerialNumber, $solarPanelIds)
    {
        $solarPanelProductCategoryId = 1;  // we can give a CRUD option for it later if required , then it will not be hardcoded
        $authUser = Auth::user();

        $inverter = Product::where('serial_number', $inverterSerialNumber)->first();
        if ($inverter) {
            $inverter->update(['assigned_to' => $customerId]);
        }
        ProductHistoryHelper::storeProductHistory($inverter, $authUser, HistoryType::ASSIGNED);

        // unassign every assigned product to customer
        Product::where('assigned_to', $customerId)->where('product_category_id', 1)->update(['assigned_to' => null]);

        if ($solarPanelIds) {
            $products = Product::where('product_category_id', $solarPanelProductCategoryId)
            ->where('assigned_to', null)
            ->whereIn('id', $solarPanelIds)
            ->get();

            $authUser = Auth::user();
            foreach ($products as $product) {
                $product->update(['assigned_to' => $customerId]);
                ProductHistoryHelper::storeProductHistory($product, $authUser, HistoryType::ASSIGNED);
            }
        }

    }


    public function addProducts(Request $request, StockPurchase $stockPurchase)
    {
        try {
            DB::beginTransaction();

            $serials = array_filter(array_merge(
                [$request->input('serial_number')],
                $request->input('serial_number_multi', [])
            ));


            if ($request->hasFile('csv_file')) {
                $file = $request->file('csv_file');
                $rows = Excel::toArray([], $file);
                dd($rows);
            }

            foreach ($serials as $serial) {
                $prodcut = Product::create([
                    'serial_number' => $serial,
                    'stock_purchase_id' => $stockPurchase->id,
                    'created_by' => $stockPurchase->created_by,
                    'product_category_id' => $stockPurchase->product_category_id,
                ]);

                $this->productHistoryHelper->storeProductHistory($prodcut, $request->user(), HistoryType::CREATED);
            }

            $this->updateStockPurchaseQuantity($stockPurchase->id);

            DB::commit();
        } catch (Throwable $e) {
            \Log::error('Error in addProducts: ' . $e->getMessage(), ['exception' => $e]);
            return;
        }

    }

    public function updateStockPurchaseQuantity($stockPurchaseId)
    {
        $count = Product::whereStockPurchaseId($stockPurchaseId)->count();
        StockPurchase::whereId($stockPurchaseId)->update(['quantity' => $count]);
    }
}
