<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProgrammeRequest extends FormRequest
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
        $programme = $this->route('programme');
        $programmeId = is_object($programme) ? $programme->id : $programme;

        return [
            'programme_category_id' => ['required', 'exists:programme_categories,id'],
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('programmes', 'slug')->ignore($programmeId)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'overview' => ['nullable', 'string', 'max:10000'],
            'level' => ['nullable', 'string', 'max:100'],
            'duration_text' => ['nullable', 'string', 'max:100'],
            'format' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'sort_order' => $this->filled('sort_order') ? (int) $this->input('sort_order') : 0,
        ]);
    }
}
