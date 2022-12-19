<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|unique:products,title,' . $this->product_id,
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file',
            'price' => 'required|integer',
            'old_price' => 'nullable|integer',
            'count' => 'required|integer',
            'is_published' => 'nullable',
            'category_id' => 'nullable|integer|exists:categories,id',
            'group_id' => 'nullable|integer|exists:groups,id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer|exists:tags,id',
            'colors' => 'nullable|array',
            'colors.*' => 'nullable|integer|exists:colors,id',
            'product_images' => 'nullable|array',
        ];
    }
}
