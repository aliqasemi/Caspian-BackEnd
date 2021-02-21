<?php

namespace App\Http\Requests\User;

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
            'firstname' => 'required|max:55',
            'lastname' => 'required|max:55',
            'phoneNumber' => 'required|regex:/(09)[0-9]{9}/|digits:11|unique:users',
            'email' => 'required|email|unique:users',
            'address' => 'nullable|string|max:150|unique:users',
            'password' => 'required|confirmed'
        ];
    }
}
