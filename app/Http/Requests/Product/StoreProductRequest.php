<?php

namespace App\Http\Requests\Product;

use App\Rules\ProductCSVFileRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'serial_number' => 'required_without:csv_file|nullable|min:8|max:20|unique:products,serial_number',
            'serial_number_multi' => 'nullable|array',
            'csv_file' => ['nullable', 'file', 'mimes:csv,txt', new ProductCSVFileRule()],
        ];
    }
}
