<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:category,id',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Tên sản phẩm là bắt buộc.',
    //         'price.required' => 'Giá sản phẩm không được để trống.',
    //         'price.numeric' => 'Giá sản phẩm phải là số.',
    //         'stock.required' => 'Số lượng sản phẩm không được để trống.',
    //         'stock.integer' => 'Số lượng phải là số nguyên.',
    //         'category_id.exists' => 'Danh mục không hợp lệ.',
    //     ];
    // }
}
