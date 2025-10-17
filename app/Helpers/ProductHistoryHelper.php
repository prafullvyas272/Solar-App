<?php

namespace App\Helpers;

use App\Models\ProductHistory;
use App\Models\Product;
use App\Enums\HistoryType;

class ProductHistoryHelper
{
    /**
     * Store product history
     *
     * @return void
     */
    public static function storeProductHistory($product, $authUser, $historyType = null, $comment = null)
    {
        if ($product == null) {
            return;
        }
        if ($historyType == HistoryType::CREATED) {
            $comment = 'Product ' . $product->serial_number . ' Created By ' . $authUser->first_name . ' ' . $authUser->last_name;
        }
        if ($historyType == HistoryType::UPDATED) {
            $comment = 'Product ' . $product->serial_number . ' Updated By ' . $authUser->first_name . ' ' . $authUser->last_name;
        }
        if ($historyType == HistoryType::ASSIGNED) {
            $customer = $product->assignedTo;
            $customerName = $customer->first_name . ' ' . $customer->middle_name . ' ' . $customer->last_name;
            $comment = 'Product ' . $product->serial_number . ' Assigned to ' . $product->first_name . ' ' . $customerName;
        }

        ProductHistory::create([
            'product_id' => $product->id,
            'updated_by' => $product->created_by,
            'history_type' => $historyType,
            'comment' => $comment,
        ]);
    }




}
