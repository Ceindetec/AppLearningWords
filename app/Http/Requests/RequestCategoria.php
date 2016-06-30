<?php

namespace LearningWords\Http\Requests;

use LearningWords\Http\Requests\Request;

class RequestCategoria extends Request
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
            'nombre' => 'required|unique:categorias,nombre|regex:/[A-ZñÑa-z ]*/'
        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => 'Categoria ya registrada en la base de datos',
            'nombre.required' => 'Debe ingresar un nombre para la nueva categoria',
            'nombre.regex'=>'El nombre de la nueva categoria no debe contener números'
        ];
    }
}
