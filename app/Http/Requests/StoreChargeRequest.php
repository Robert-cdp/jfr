<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreChargeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'school_year_id' => ['required', 'exists:school_years,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'payment_concept_id' => ['required', 'exists:payment_concepts,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['nullable', 'date'],
        ];
    }
}
