<?php

namespace App\Http\Requests\Client;

use App\Rules\InverterRule;
use App\Rules\SolarPanelRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number_of_panels' => ['nullable', 'numeric', 'min:1', 'max:2000', new SolarPanelRule()],
            'inverter_serial_number' => ['nullable', 'string', new InverterRule()],
            'solar_serial_number' => ['nullable', 'array'],
            'solar_serial_number.*' => [
                'required_with:solar_serial_number',
                'string',
                'exists:products,serial_number,assigned_to,NULL'
            ],
        ];
    }
}
