<?php

namespace App\Http\Controllers\ProductHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductHistoryController extends Controller
{
    public function index(Product $product)
    {
        $productHistories = $product->histories()->with('product.productCategory')->latest()->get();
        return view('product-history.index', compact('productHistories'));
    }
}
