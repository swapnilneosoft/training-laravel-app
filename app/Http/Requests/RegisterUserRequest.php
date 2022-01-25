<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            "firstname"=>["required"],
            "lastname"=>["required"],
            "email"=>["required","email","unique:users,email"],
            "password"=>["required","same:confirm_password"],
            "status"=>["required"],
            "role_id"=>["required"]
        ];
    }
}
