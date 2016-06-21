<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\leccionesDet;
use LearningWords\traducciones;
use LearningWords\Http\Controllers\Controller;

class actividadUnoController extends Controller
{
    
    public function index($id){
    	$listaTraducciones = array();
    	$traduccionesMostrar = array();
    	$palabrasEspDet = leccionesDet::select('palabra_id')->where('leccion_id', $id)->orderBy('palabra_id','asc')->get();
    	foreach($palabrasEspDet as $palabraEsp){
    		$traducciones = traducciones::select('palabra_id', 'traduccion')
    										->where('palabra_id', $palabraEsp->palabra_id)
    										->where('idiomas_id', 1)
    										->get();
    	
    										foreach($traducciones as $trad){
    											$listaTraducciones[$palabraEsp->palabra_id] = $trad->traduccion;
    											$traduccionesMostrar[$palabraEsp->palabra_id] = $trad->traduccion;
    										}
    		

    		
    	}
    	shuffle($traduccionesMostrar); 
    	$data['palabrasEspDet'] = $palabrasEspDet;
    	$data['listaTraducciones'] = $listaTraducciones;
    	$data['traduccionesMostrar'] = $traduccionesMostrar;
    	return view('actividadesRepaso.actividaduno',$data);
    }

    public function store(Request $request){
        
    }
}
