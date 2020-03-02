<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*Check Request cho form reset password */
class ResetPasswordRequest extends FormRequest
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
            'email.email' => 'KHÔNG PHẢI EMAIL',
            'email.exists' =>'EMAIL KHÔNG TỒN TẠI',
            'passwordConfirm.same' => 'PASSWORD CONFIRM KHÔNG GIỐNG PASSWORD'
        ];
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => "required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/",
            'passwordConfirm' => 'required|same:password'
        ];
    }
}
