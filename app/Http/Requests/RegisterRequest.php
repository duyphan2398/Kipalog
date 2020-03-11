<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*Check Request cho form đăng ký của user*/
class RegisterRequest extends FormRequest
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
    public function messages()
    {
        return [
            'username.alpha_num' => 'USERNAME MUST BE ENTIRELY ALPHA-NUMERIC CHARACTERS',
            'username.unique' => 'USERNAME ALREADY EXISTS',
            'email.unique' => 'EMAIL ALREADY EXISTS',
            'email.email' => 'EMAIL IS NOT TRUE',
            'passwordConfirm.same' => 'PASSWORD CONFIRM IS NOT SAME THE PASSWORD'
        ];
    }

    public function rules()
    {
        return [
            'name'     => 'required|max:30|regex:/^[\a-zA-Z\s\-]+$/u',
            'username' => 'required|unique:users|alpha_num',
            'email' => 'required|unique:users|email',
            'password' => "required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/",
            'passwordConfirm' => 'required|same:password'
        ];
    }
}
