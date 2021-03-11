<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioUpdateRequest extends FormRequest
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
            'description' => 'nullable|string',
            'portfolio_id' => 'nullable|integer|exists:transplantation,id',
            'image' => 'nullable|file',
            'crop' => 'nullable|array',
            'crop.width' => 'nullable|int',
            'crop.height' => 'nullable|int'
        ];
    }
}
