<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Activarlo en true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ //Campos que deben tener validación
            'nombre' => 'required|min:5|max:100',
            'email'  => 'required|unique:usuarios|max:100',
            'password'  => 'required|unique:usuarios|min:5|max:40'
        ];
    }
}
