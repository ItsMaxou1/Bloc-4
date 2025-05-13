<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'cover' => 'required|string',
        ];
    }
}
