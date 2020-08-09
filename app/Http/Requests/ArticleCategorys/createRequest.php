<?php

namespace App\Http\Requests\ArticleCategorys;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
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
            'name_category' => 'unique:article_categories',
        ];
    }
    public function messages()
    {
        return [
            'name_category.unique' => 'Tên danh mục bài viết đã tồn tại'
        ];
    }
}
