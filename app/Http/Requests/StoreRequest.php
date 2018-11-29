<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:20|min:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'image_user' => 'mimes:jpeg,jpg,png|max:1000',
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Vui lòng nhập họ tên.',
            // 'name.min' => 'Họ tên phải chứa tối thiểu 6 kí tự.',
            // 'name.max' => 'Họ tên chứa tối thiểu 20 kí tự.',
            // 'email.required' => 'Vui lòng nhập email.',
            // 'email.email' => 'Email không hợp lệ.',
            // 'password.required' => 'Vui lòng nhập mật khẩu.',
            // 'password.min' => 'Mật khẩu phải chứa tối thiểu 6 kí tự.',
        ];
    }
}
