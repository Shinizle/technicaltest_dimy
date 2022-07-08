<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'customer_address_id' => ['required', 'exists:customer_addresses,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required','numeric', 'min:1'],
            'products.*.price' => ['required', 'numeric', 'min:0']
        ];
    }
}
