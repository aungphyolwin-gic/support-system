<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'title' => 'filled',
            'message' => 'filled',
            'label' => 'filled|unique:labels,name',
            'category' => 'filled|unique:categories,name',
            'priority' => 'filled',
            'file'  => 'nullable'
        ];
    }
}
