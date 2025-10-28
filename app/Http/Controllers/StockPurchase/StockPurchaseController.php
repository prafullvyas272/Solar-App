<?php

namespace App\Http\Controllers\StockPurchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockPurchase\StoreStockPurchaseRequest;
use App\Http\Requests\StockPurchase\UpdateStockPurchaseRequest;
use App\Models\ProductCategory;
use App\Models\StockPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Helpers\ApiResponse;
use App\Helpers\FileUploadHelper;
use App\Helpers\ProductHelper;
use App\Imports\Product\ProductImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StockPurchaseController extends Controller
{
    protected $fileUploadHelper;
    protected $productHelper;

    public function __construct(FileUploadHelper $fileUploadHelper, ProductHelper $productHelper ) {
        $this->fileUploadHelper = $fileUploadHelper;
        $this->productHelper = $productHelper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $stockPurchases = StockPurchase::with('productCategory')->get();

        return view('stockPurchase.index', compact('stockPurchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $productCategories = ProductCategory::all();
        $stockPurchase = null;
        if ($request->has('id')) {
            $stockPurchase = StockPurchase::with('products')->find($request->input('id'));
        }
        return view('stockPurchase.create', compact('productCategories', 'stockPurchase'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockPurchaseRequest $request)
    {
        try {

            DB::beginTransaction();

            $data = array_merge($request->stockPurchaseData(), ['created_by' => $request->user()->id]);
            $stockPurchase = StockPurchase::create($data);
            $path = $this->fileUploadHelper->uploadSupplierInvoiceCopy($request->file('invoice_copy'));

            $stockPurchase->update(['supplier_invoice_copy_path' => $path]);

            // Merge serial_number and serial_number_multi into a flat array, removing empties
            $serialNumbers = [];

            if ($request->filled('serial_number')) {
                $serialNumbers[] = $request->input('serial_number');
            }
            if (is_array($request->input('serial_number_multi'))) {
                foreach ($request->input('serial_number_multi') as $sn) {
                    if (!empty($sn)) {
                        $serialNumbers[] = $sn;
                    }
                }
            }

            $rows = [];
            if ($request->hasFile('csv_file')) {
                $file = $request->file('csv_file');
                $rows = Excel::toArray([], $file);

                // Remove header row
                unset($rows[0][0]);
                $rows = array_map(function ($row) {
                    return $row[0] ?? null;
                }, $rows[0]); // only get the first column

                // Remove nulls and reindex
                $rows = array_values(array_filter($rows, function($item) {
                    return !is_null($item) && $item !== '';
                }));
            }
            $allSerialNumbers = array_merge($rows ,$serialNumbers);


            // Now pass serialNumbers to createProductsWithSerialNumbers
            $this->productHelper->createProductsWithSerialNumbers($stockPurchase, $allSerialNumbers);
            // $this->productHelper->addProducts($request, $stockPurchase);


            DB::commit();

            return redirect()->route('stock-purchase.index')
            ->with('success', 'Stock purchase created successfully.');
        } catch (Throwable $exception) {
            dd($exception);
            Log::error('Something went wrong when purchasing stocks' . $exception);
            return response()->json([
                'message' => 'Something went wrong when purchasing stocks'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockPurchaseRequest $request, StockPurchase $stockPurchase)
    {
        try {
            $data = array_merge($request->stockPurchaseData(), ['created_by' => $request->user()->id]);

            DB::beginTransaction();

            if ($request->file('invoice_copy')) {
                $path = $this->fileUploadHelper->uploadSupplierInvoiceCopy($request->file('invoice_copy'));
                $data['supplier_invoice_copy_path'] = $path;
            }

            if ($request->input('quantity') != $stockPurchase->quantity) {
                $this->productHelper->updateProductsOnQuantityUpdate($stockPurchase, $request->input('quantity'));
            }

            $stockPurchase->update($data);

            DB::commit();

            return redirect()->route('stock-purchase.index')
            ->with('success', 'Stock purchase updated successfully.');
        } catch (Throwable $exception) {
            Log::error('Something went wrong when updating stock purchase details' . $exception);
            return response()->json([
                'message' => 'Something went wrong when updating stock purchase details'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockPurchase $stockPurchase)
    {
        try {
            $stockPurchase->delete();

            return redirect()->route('stock-purchase.index')
                ->with('success', 'Stock purchase deleted successfully.');

        } catch (\Throwable $exception) {
            Log::error('Something went wrong when deleting stock purchase' . $exception);
            return response()->json([
                'message' => 'Something went wrong when deleting stock purchase'
            ]);
        }
    }
}
