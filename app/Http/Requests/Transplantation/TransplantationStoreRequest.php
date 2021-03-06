<?php

namespace App\Http\Requests\Transplantation;

use Illuminate\Foundation\Http\FormRequest;

class TransplantationStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|file',
            'crop' => 'nullable|array',
            'crop.width' => 'nullable|int',
            'crop.height' => 'nullable|int'
        ];
    }
}
