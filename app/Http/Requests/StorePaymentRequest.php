<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'charge_id' => ['required', 'exists:charges,id'],
            'receipt_number' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', 'string', 'max:100'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
