<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;
use LearningWords\leccionesEnc;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;

class actividadesRepasoController extends Controller
{
    public function index(){
       $lecciones = leccionesEnc::where('usuario_documento', '86074808')->get();
        
       foreach($lecciones as $leccion)
            $listalecciones[$leccion['id']] = $leccion['nombre'];
        
       return view('actividadesRepaso.index', compact('listalecciones'));   
   }
}
