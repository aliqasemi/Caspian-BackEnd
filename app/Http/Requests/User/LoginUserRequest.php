<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' => 'email|required_without_all:phoneNumber',
            'phoneNumber' => 'regex:/(09)[0-9]{9}/|digits:11|required_without_all:email',
            'password' => 'required'
        ];
    }
}
