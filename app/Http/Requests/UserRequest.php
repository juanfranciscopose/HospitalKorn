<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required',
            'active' => 'required',
            'password' => 'required',
            'name' => 'required',
            'surname' => 'required'
         ];
    }
    public function messages()
    {   
        return [
            'email.required' => 'El correo electrónico es obligatorio',
            'active.required' => 'El estado del usuario es obligatorio',
            'password.required' => 'La contraseña es obligatorio',
            'name.required' => 'El nombre es obligatorio',
            'surname.required' => 'El apellido es obligatorio',
        ];
    }
}
