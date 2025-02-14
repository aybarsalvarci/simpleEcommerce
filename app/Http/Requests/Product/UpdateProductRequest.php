<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|string|min:3|max:150",
            'slug' => "required|string|min:3|max:150",
            'seo_keywords' => "nullable|string|min:3|max:150",
            'seo_description' => "nullable|string|min:3|max:255",
            'category_id' => "required|integer|exists:categories,id",
            'stock' => "required|integer|min:0",
            'unit_price' => "required|decimal:0,4|min:0",
            'description' => "nullable|string|min:3|max:1000",
            'status' => "required|boolean",
            'images.*' => "file|image"
        ];
    }

    public function prepareForValidation(): void
    {
        if(!empty($slug))
        {
            $slug = str()->slug($this->slug);
        }
        else
        {
            $slug = str()->slug($this->name);
        }

        $this->merge([
            'slug' => $slug,
            'status' => $this->has('status')
        ]);
    }
}
