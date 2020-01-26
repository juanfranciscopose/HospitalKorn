<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
           'clinical_history_number' => 'required',
           'name' => 'required',
           'surname' => 'required',
           'birthdate' => 'required|before:today',
           'party' => 'required',
           'town' => 'required',
           'address' => 'required',
           'gender' => 'required',
           'document_type' => 'required',
           'document_number' => 'required',
        ];
    }
    public function messages()
    {   
        return [
            'clinical_history_number.required' => 'El número historia clínica es obligatorio',
            'name.required' => 'El nombre es obligatorio',
            'surname.required' => 'El apellido es obligatorio',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria',
            'party.required' => 'El partido es obligatorio',
            'town.required' => 'La localidad es obligatoria',
            'address.required' => 'La dirección es obligatoria',
            'gender.required' => 'El género es obligatorio',
            'document_type.required' => 'El tipo de documento es obligatorio',
            'document_number.required' => 'El número de documento es obligatorio'
        ];
    }
}
