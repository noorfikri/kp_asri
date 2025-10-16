<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'stocks' => 'required|array|min:1',
            'stocks.*.size_id' => 'required|exists:sizes,id',
            'stocks.*.colour_id' => 'required|exists:colours,id',
            'stocks.*.stock' => 'required|integer|min:0',
        ];
    }
}
