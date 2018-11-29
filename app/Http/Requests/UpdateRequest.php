<?php

namespace App\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
            'phone.phone_number' => 'required|between:9,12|regex:/^[1-9][0-9]+/',
        ];
    }

    public function messages()
    {
        return [
            // 'phone.phone_number.required' => 'Vui lòng nhập số điện thoại.',
            // 'phone.phone_number.between' => 'Số điện thoại là dãy số từ 9 đến 12 chữ số.',
            // 'phone.phone_number.regex' => 'Số điện thoại là không bắt đầu từ số 0.',
        ];
    }
}
