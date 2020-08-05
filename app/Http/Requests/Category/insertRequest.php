<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class insertRequest extends FormRequest
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
            'name_category' => 'unique:category',
        ];
    }
    public function messages()
    {
        return [
            'name_category.unique' => 'Tên danh mục đã tồn tại'
        ];
    }
}
