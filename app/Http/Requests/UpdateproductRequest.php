<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'store_id' => 'required|int|exists:stores,id',
            'category_id' => 'required|int|exists:categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,draft,archived',
            'image' => 'required',
            'price' => 'required|numeric',
            'compare_price' => 'required|numeric|gt:price',
            'tags' => 'nullable|array',
        ];

    }
}
