<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'string|required|min:3|max:100',
            'slug' => 'required|string|min:3|max:100|unique:categories,slug',
            'status' => 'required|boolean'
        ];
    }

    public function prepareForValidation(): void
    {
        if(!empty($this->slug)) {
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
