<?php

namespace App\Http\Requests\Transplantation;

use Illuminate\Foundation\Http\FormRequest;

class TransplantationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'category' => 'nullable|string',
        ];
    }
}
