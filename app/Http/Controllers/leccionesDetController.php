<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\leccionesDet; 

class leccionesDetController extends Controller
{   
    public function store(Request $request)
    {
        $leccion_id = $request->input("leccion_id");
        $palabra_id = $request->input("palabra_id");
        DB::table('lecciones_dets')->insert(['leccion_id' => $leccion_id,'palabra_id' => $palabra_id ]); 
    }

 
    public function destroy($id)
    {
        //
    }

    public function detallelecciongrid(Request $request){
        $query = leccionesDet::where('leccion_id', $request->id)->get();
        foreach ($query as $qu) {
            $qu->getpalabra->getTraduccion;
        }
//        dd($query);
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
