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
        if ($historyType == HistoryType::CREATED) {
            $comment = 'Product ' . $product->serial_number . ' Created By ' . $authUser->first_name . ' ' . $authUser->last_name;
        }
        if ($historyType == HistoryType::UPDATED) {
            $comment = 'Product ' . $product->serial_number . ' Updated By ' . $authUser->first_name . ' ' . $authUser->last_name;
        }
        if ($historyType == HistoryType::ASSIGNED) {
            $comment = 'Product ' . $product->serial_number . ' Assigned to ' . $product->assigned_to;
        }
        
        ProductHistory::create([
            'product_id' => $product->id,
            'updated_by' => $product->created_by,
            'history_type' => HistoryType::CREATED,
            'comment' => $comment,
        ]);
    }



    
}
