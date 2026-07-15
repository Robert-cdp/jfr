<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentConceptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'institution_id' => ['required', 'exists:institutions,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'default_amount' => ['required', 'numeric', 'min:0'],
            'is_monthly' => ['boolean'],
            'allow_partial_payments' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_monthly' => $this->boolean('is_monthly'),
            'allow_partial_payments' => $this->boolean('allow_partial_payments'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
