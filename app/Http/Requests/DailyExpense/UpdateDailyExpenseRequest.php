<?php

namespace App\Http\Requests\DailyExpense;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDailyExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'expense_category_id' => ['required', 'exists:expense_categories,id'],
            'description' => ['nullable', 'string', 'max:1000'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_mode' => ['required'],
            'paid_by' => ['required'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'receipt_path' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,pdf', 'max:2048'],
        ];
    }

    public function dailyExpenseData()
    {
        return $this->only(array_keys($this->rules()));
    }
}
