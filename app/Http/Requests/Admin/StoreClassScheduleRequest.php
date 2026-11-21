<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClassScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'title' => ['required', 'string', 'max:180'],
            'days_of_week' => ['required', 'string', 'max:120'],
            'start_time' => ['required', 'string', 'max:40'],
            'end_time' => ['nullable', 'string', 'max:40'],
            'mode' => ['required', 'string', Rule::in(['online', 'offline', 'hybrid'])],
            'venue_name' => ['nullable', 'string', 'max:180'],
            'venue_address' => ['nullable', 'string', 'max:300'],
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
