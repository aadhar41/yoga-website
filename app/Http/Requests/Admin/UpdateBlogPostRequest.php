<?php

namespace App\Http\Requests\Admin;

use App\Models\BlogPost;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogPostRequest extends FormRequest
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
        $post = $this->route('blog');
        $postId = $post instanceof BlogPost ? $post->getKey() : $post;

        return [
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:220', Rule::unique('blog_posts', 'slug')->ignore($postId)],
            'excerpt' => ['nullable', 'string', 'max:600'],
            'body' => ['required', 'string', 'max:50000'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_published' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
        ]);
    }
}
