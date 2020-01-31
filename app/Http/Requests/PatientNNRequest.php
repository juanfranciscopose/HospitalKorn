<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientNNRequest extends FormRequest
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
            'clinical_history_number' => 'required|numeric'
        ];
    }
    public function messages()
    {   
        return [
            'clinical_history_number.required' => 'El número historia clínica es obligatorio'
        ];
    }
}
