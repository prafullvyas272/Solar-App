<?php

namespace App\Http\Requests\QuotationItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateQuotationItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.hsn' => ['required', 'string', 'max:50'],
            'items.*.rate' => ['required', 'numeric', 'min:0'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.tax' => ['required', 'in:12,18,28'],
        ];
    }
}
