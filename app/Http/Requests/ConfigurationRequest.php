<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
            'value' => 'required',
            'description' => 'required'
        ];
    }
    public function messages()
    {   
        return [
            'value.required' => 'El valor es obligatorio',
            'description.required' => 'La descripción es obligatorio',
        ];
    }
}
