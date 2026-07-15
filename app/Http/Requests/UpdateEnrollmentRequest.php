<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'school_year_id' => ['required', 'exists:school_years,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'enrollment_date' => ['required', 'date'],
            'is_active' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
