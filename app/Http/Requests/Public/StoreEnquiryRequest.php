<?php

namespace App\Http\Requests\Public;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'website' => ['nullable', 'max:0'], // Honeypot anti-spam field
            'programme_id' => ['nullable', 'integer', 'exists:programmes,id'],
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email:rfc,dns', 'max:190'],
            'phone' => ['required', 'string', 'min:7', 'max:30'],
            'preference' => ['required', 'string', Rule::in(['online', 'offline', 'either'])],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'min:5', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'website.max' => 'Unable to process submission.',
            'preferred_date.after_or_equal' => 'Preferred date cannot be in the past.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'email' => strtolower(trim((string) $this->input('email'))),
            'phone' => trim((string) $this->input('phone')),
            'preferred_time' => $this->filled('preferred_time') ? trim((string) $this->input('preferred_time')) : null,
            'message' => trim((string) $this->input('message')),
        ]);
    }
}
