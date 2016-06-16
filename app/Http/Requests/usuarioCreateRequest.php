<?php

namespace LearningWords\Http\Requests;

use LearningWords\Http\Requests\Request;
use Auth;

class usuarioCreateRequest extends Request
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
        $usuarioActual = Auth::user();
        //dd($usuarioActual->rol);
        if($usuarioActual->rol == 'superadmin'){
            return [
                'documento' => 'required',
                'rol' => 'in:superadmin,administrador'
            ];
        }
        if($usuarioActual->rol == 'administrador'){
            return [
                'documento' => 'required',
                'rol' => 'in:administrador,docente,estudiante'
            ];
        }
        if($usuarioActual->rol == 'docente'){
            return [
                'documento' => 'required',
                'rol' => 'in:docente'
            ];
        }
        if($usuarioActual->rol == 'estudiante'){
            return [
                'documento' => 'required',
                'rol' => 'in:estudiante'
            ];
        }
    }
}
