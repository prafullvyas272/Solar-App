<?php

namespace App\Http\Requests\StockPurchase;

use App\Rules\ProductCSVFileRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockPurchaseRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_name' => ['required', 'string', 'max:255'],
            'purchase_invoice_no' => ['required', 'string', 'max:255'],
            'invoice_date' => ['required', 'date'],
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'brand' => ['required', 'string', 'max:255'],
            // 'model' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'between:1,1000', 'decimal:0,2'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'gst' => ['required', 'integer', 'in:5,12,18,28'],
            'invoice_copy' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png'],
            'serial_number' => 'nullable|min:8|max:20|unique:products,serial_number',
            'serial_number_multi' => 'nullable|array',
            'csv_file' => ['nullable', 'file', 'mimes:csv,txt', new ProductCSVFileRule()],
        ];
    }

    /**
     * Method to get stock purchase data
     */
    public function stockPurchaseData()
    {
        return $this->only(array_keys($this->rules()));
    }

}
