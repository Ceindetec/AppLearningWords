<?php

namespace LearningWords\Http\Requests;

use LearningWords\Http\Requests\Request;

class RequestEditarPalabra extends Request
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
            'palabra' => 'required|regex:/[A-ZñÑa-z ]*/|unique:palabras_esp,palabra',
            'traduccion' => 'required|regex:/[A-ZñÑa-z ]*/|unique:traducciones,traduccion'
        ];
    }

    public function messages()
    {
        return [
            'palabra.regex' => 'La palabra debe contener solo letras',
            'palabra.unique' => 'Palabra en español ya registrada',
            'traduccion.regex' => 'La palabra debe contener solo letras',
            'traduccion.unique' => 'Palabra en español ya registrada'
        ];
    }
}
