<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class storeProduct extends FormRequest
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
            'sale' => 'Lt:price',
            'detail' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Chi tiết sản phẩm không được để trống'
        ];
    }
}
