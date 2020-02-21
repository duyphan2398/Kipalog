<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'username.unique' => 'USERNAME ĐÃ TỒN TẠI',
            'email.unique' => 'EMAIL ĐÃ TỒN TẠI',
            'email.email' => 'KHÔNG PHẢI EMAIL',
            'passwordConfirm.same' => 'PASSWORD CONFIRM KHÔNG GIỐNG PASSWORD'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => "required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/",
            'passwordConfirm' => 'required|same:password'
        ];
    }
}
