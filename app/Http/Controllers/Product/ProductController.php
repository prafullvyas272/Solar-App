<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use App\Models\StockPurchase;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stockPurchaseId = (int) $request->route('stockPurchase');
        $products = Product::where('stock_purchase_id', $stockPurchaseId)->get();

        return view('product.index', ['stockPurchaseId' => $stockPurchaseId, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, StockPurchase $stockPurchase)
    {
        $product = null;
        if ($request->has('id')) {
            $product = Product::find($request->input('id'));
        }
        return view('product.create', ['product' => $product, 'stockPurchaseId' => $stockPurchase->id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StockPurchase $stockPurchase)
    {
        $request->validate([
            'serial_number' => 'required|min:8|max:20',
            'serial_number_multi' => 'array',
        ]);

        $serials = array_filter(array_merge(
            [$request->input('serial_number')],
            $request->input('serial_number_multi', [])
        ));

        foreach ($serials as $serial) {
            Product::create([
                'serial_number' => $serial,
                'stock_purchase_id' => $stockPurchase->id,
                'created_by' => $stockPurchase->created_by,
                'product_category_id' => $stockPurchase->product_category_id,
            ]);
        }

        return redirect()->route('stock-purchase-products', ['stockPurchase' => $stockPurchase])
        ->with('success', 'Stock serial number created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $stockPurchaseId, string $productId)
    {
        $request->validate([
            'serial_number' => 'required|min:8|max:20'
        ]);

        $product = Product::find($productId);

        if ($product) {
            $product->update([
                'serial_number' => $request->input('serial_number'),
            ]);
        }
        return redirect()->route('stock-purchase-products', ['stockPurchase' => $stockPurchaseId])
        ->with('success', 'Stock serial number updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockPurchase $stockPurchase, Product $product)
    {
        $product->delete();

        return redirect()->route('stock-purchase-products', ['stockPurchase' => $stockPurchase])
        ->with('success', 'Serial number deleted successfully.');
    }
}
