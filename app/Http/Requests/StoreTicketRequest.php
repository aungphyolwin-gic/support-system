<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'title' => 'required',
            'message' => 'required',
            'label' => 'required|unique:labels,name',
            'category' => 'required|unique:categories,name',
            'priority' => 'required',
            'file'  => 'nullable'
        ];
    }
}
