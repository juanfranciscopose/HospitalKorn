<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required|numeric',
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email',
            'active' => 'required|numeric'
         ];
    }
    public function messages()
    {   
        return [
            'id.required' => 'El ID es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'active.required' => 'El estado del usuario es obligatorio',
            'name.required' => 'El nombre es obligatorio',
            'surname.required' => 'El apellido es obligatorio',
        ];
    }
}
