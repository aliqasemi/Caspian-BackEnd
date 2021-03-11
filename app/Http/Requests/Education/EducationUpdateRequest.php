<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

class EducationUpdateRequest extends FormRequest
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
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'portfolio_id' => 'nullable|integer|exists:portfolio,id',
            'image' => 'nullable|file',
            'crop' => 'nullable|array',
            'crop.width' => 'nullable|int',
            'crop.height' => 'nullable|int'
        ];
    }
}
