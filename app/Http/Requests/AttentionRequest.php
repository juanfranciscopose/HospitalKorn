<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttentionRequest extends FormRequest
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
            'patient_id' => 'required|numeric',
            'diagnostic' => 'required|string|max:191',
            'reason' => 'required|string|max:191',
            'derivation' => 'numeric|nullable',
            'observation' => 'string|nullable|max:191', 
            'articulation' => 'nullable|string|max:191', 
            'internment' => 'required|numeric',
            'pharmacotherapy' => 'string|nullable|max:191',
            'date' => 'required|date',
            'accompaniment' => 'nullable|string|max:191'
        ];
    }
    public function messages()
    {   
        return [
            'patient_id.required' => 'El ID del paciente es obligatorio',
            'date.required' => 'La fecha es obligatorio',
            'diagnostic.required' => 'El diagnostico es obligatorio',
            'reason.required' => 'El motivo es obligatorio',
            'internment.required' => 'Es obligatorio saber si el paciente queda internado',
        ];
    }
}
