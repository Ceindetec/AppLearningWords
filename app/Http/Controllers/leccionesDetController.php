<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\leccionesDet; 

class leccionesDetController extends Controller
{   
    public function store(Request $request)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }

    public function detallelecciongrid(Request $request){
        $query = leccionesDet::where('leccion_id', $request->id)->get();
        foreach ($query as $qu) {
            $qu->getpalabra;
            $qu->getleccion;
        }
        return ['data'=> $query];
    }

    public function eliminardetlecciongrid(Request $request){
        $leccion = leccionesDet::find($request->id);
        $leccion->delete();
    }


    public function buscarpalabraleccion(Request $request){
        $count = leccionesDet::where('leccion_id',$request->leccion_id)->
                               where('palabra_id', $request->palabra_id)->count();
        return $count;
    }    
}
