<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"  => "required|min:3\regex:/[a-zA-Z]",
            "email" => "required|email|unique:users",
            "role"  => "required",
            "password" => [
                "required",
                "min:8",
                "regex:/[a-z]/",
                "regex:/[A-Z]/",
                "regex:/[0-9]/",
                "regex:/[@$!#%]/",
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Yo, what should I call you?',
            'email.required' => 'We need your email address also',
            'role.required'  => 'c\'mon, you want to contact me without saying anything?',
            'password.required'       => 'the password is must'
        ];
    }
}
