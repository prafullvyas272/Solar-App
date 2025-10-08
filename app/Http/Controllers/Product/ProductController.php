<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use App\Models\StockPurchase;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Helpers\ProductHistoryHelper;
use App\Enums\HistoryType;
use App\Imports\Product\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    protected $productHistoryHelper;

    public function __construct(ProductHistoryHelper $productHistoryHelper)
    {
        $this->productHistoryHelper = $productHistoryHelper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stockPurchaseId = (int) $request->route('stockPurchase');
        $categories = ProductCategory::all();
        $products = Product::with(['assignedTo', 'productCategory'])->where('stock_purchase_id', $stockPurchaseId)->get();

        return view('product.index', ['stockPurchaseId' => $stockPurchaseId, 'products' => $products, 'categories' => $categories]);
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
    public function store(StoreProductRequest $request, StockPurchase $stockPurchase)
    {

        try {
            \DB::beginTransaction();

            $serials = array_filter(array_merge(
                [$request->input('serial_number')],
                $request->input('serial_number_multi', [])
            ));


            if ($request->hasFile('csv_file')) {
                $file = $request->file('csv_file');
                $productImport = new ProductImport($file);
                Excel::import($productImport, $file);
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

            \DB::commit();

            return redirect()->route('stock-purchase-products', ['stockPurchase' => $stockPurchase])
                ->with('success', 'Stock serial number created successfully.');
        } catch (\Throwable $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong while creating stock serial numbers.');
        }
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
            $this->productHistoryHelper->storeProductHistory($product, $request->user(), HistoryType::UPDATED);
        }
        return redirect()->route('stock-purchase-products', ['stockPurchase' => $stockPurchaseId])
        ->with('success', 'Stock serial number updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockPurchase $stockPurchase, Product $product)
    {
        try {
            \DB::beginTransaction();

            $product->delete();
            $this->updateStockPurchaseQuantity($stockPurchase->id);

            \DB::commit();

            return redirect()->route('stock-purchase-products', ['stockPurchase' => $stockPurchase])
                ->with('success', 'Serial number deleted successfully.');
        } catch (\Throwable $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong while deleting the serial number.');
        }
    }

    public function updateStockPurchaseQuantity($stockPurchaseId)
    {
        $count = Product::whereStockPurchaseId($stockPurchaseId)->count();
        StockPurchase::whereId($stockPurchaseId)->update(['quantity' => $count]);
    }
}
