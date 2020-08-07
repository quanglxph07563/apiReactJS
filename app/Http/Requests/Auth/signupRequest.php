<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class signupRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại',
            'password_confirm.same' =>'Mật khẩu nhập lại không chính xác'
        ];
    }
}
