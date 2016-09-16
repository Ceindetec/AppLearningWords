<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;
use LearningWords\actividades;
use LearningWords\controlAvance;
use LearningWords\leccionesEnc;
use LearningWords\leccionesDet;
use LearningWords\traducciones;
use LearningWords\User;

use LearningWords\Http\Controllers\Controller;




class actividadesController extends Controller
{



    public function index(){

        $docentes = User::where("rol","docente")->where("institucion_id",\Auth::user()->institucion_id)->get();
        
       foreach($docentes as $docente)
            $listadocentes[$docente['documento']] = $docente['nombres']." ".$docente['apellidos'];

       return view('actividadesRepaso.index', compact('listadocentes'));
   }


    public function leccionesDocente($id_docente){

        $lecciones = leccionesEnc::where('usuario_documento', $id_docente)->get();
        $usuarioActual = \Auth::user();
        //$prueba = $usuarioActual->getControlAvance();
        foreach($lecciones as $leccion){
            if(isset($usuarioActual) && $usuarioActual->rol == 'estudiante'){
                $estados = $usuarioActual->getControlAvance($leccion->id);
                if($estados!=false){
                $noiniciado=0;
                $finalizado=0;
                foreach($estados as $estado){
                    //dd($estado);
                    if($estado->estado=="Not started"){
                        $noiniciado++;
                    }else if($estado->estado=="Completed"){
                        $finalizado++;
                    }
                }

                if($noiniciado==3)
                    $leccion['estado'] = "<div style='background-color:#ff3724; color: #fff8f6'>Not started </div>";
                else if($finalizado==3)
                    $leccion['estado'] = "<div style='background-color:#3a8039; color: #fff8f6'>Completed</div>";
                else
                    $leccion['estado'] = "<div style='background-color:#ff9811;color: #fff8f6'>In progress</div>";
                }else{
                    $leccion['estado'] = "<div style='background-color:#ff3724; color: #fff8f6'>Not started</div>";
                }
            }else{
                $leccion['estado'] = "rol incorrecto";

            }
        }

        //dd($lecciones);

        return json_encode(["data" => $lecciones]);

    }

    public function actividades($id){

        $leccion = leccionesEnc::where('id', $id)->get();

        if(count($leccion)>0){

            $data["nombreleccion"]=$leccion[0]->nombre;
            $data["idleccion"]=$id;
            $controls = controlAvance::where('leccion_id',$id)->where('usuario_documento',\Auth::user()->documento)->get();

            $actividades =actividades::all();

            //dd($actividades);

            if(count($controls)==0){

                foreach($actividades as $actividad){
                    $avances = new controlAvance();
                    $avances->actividad_id=$actividad->id;
                    $avances->usuario_documento=\Auth::user()->documento;
                    $avances->leccion_id=$id;
                    $avances->estado="Not started";
                    //dd($avances);
                    $avances->save();

                }

                $controls = controlAvance::where('leccion_id',$id)->where('usuario_documento',\Auth::user()->documento)->get();
            }


            foreach($controls as $control){

                //dd($control);
                //$nombreActividad = actividades::select("nombre")->where('id',$control->actividad_id)->get();
                $data["actividad".$control->actividad_id]=$control->estado;
            }

            //dd($data);
            return view('actividadesRepaso.actividadesrepaso',$data);
        }else{
            return \Redirect::back();
        }

    }

//    ------------------------------------------------------   adtividad UNO ------------------------------------------------------------------

    public function actividadUno($id_leccion){

        //maxCntCarPalabratra es cantidad de caracteres por palabra truduccion
        $maxCntCarPalabraTra=0;
        $maxCntCarPalabraEsp=0;

        $leccion = leccionesEnc::where('id', $id_leccion)->get();

        if(count($leccion)>0){
        $control = controlAvance::where('leccion_id',$id_leccion)->where('actividad_id',1)->where('usuario_documento',\Auth::user()->documento)->get();
        if($control[0]->estado!="Completed"){
            $control[0]->estado="In progress";
            $control[0]->save();
        }


        $listaTraducciones = array();
        $traduccionesMostrar = array();

        $numPalabras =leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->orderBy('palabra_id','asc')->count();

        $limite = floor($numPalabras/3);
        //dd($limite);

        $palabrasEspDet = leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->take($limite)->orderBy('palabra_id','asc')->get();
        foreach($palabrasEspDet as $palabraEsp){

            if($palabraEsp->getpalabra)
                    $maxCntCarPalabraEsp= (strlen($palabraEsp->getpalabra->palabra)>$maxCntCarPalabraEsp)?strlen($palabraEsp->getpalabra->palabra):$maxCntCarPalabraEsp;

            $traducciones = traducciones::select('palabra_id', 'traduccion')
                ->where('palabra_id', $palabraEsp->palabra_id)
                ->where('idiomas_id', 1)
                ->get();

            foreach($traducciones as $trad){


                $maxCntCarPalabraTra= (strlen($trad->traduccion)>$maxCntCarPalabraTra)?strlen($trad->traduccion):$maxCntCarPalabraTra;


                $listaTraducciones[$palabraEsp->palabra_id] = $trad->traduccion;
                $traduccionesMostrar[$palabraEsp->palabra_id] = $trad->traduccion;
            }

        }
        shuffle($traduccionesMostrar);
        $data['maxCntCarPalabraTra'] = $maxCntCarPalabraTra;
        $data['maxCntCarPalabraEsp'] = $maxCntCarPalabraEsp;
        $data['idleccion'] = $id_leccion;
        $data['palabrasEspDet'] = $palabrasEspDet;
        $data['listaTraducciones'] = $listaTraducciones;
        $data['traduccionesMostrar'] = $traduccionesMostrar;
        $data['leccion'] = $id_leccion;
            //dd($data);
        return view('actividadesRepaso.actividaduno',$data);
        }else{
            return \Redirect::back();
        }
    }

    //    ------------------------------------------------------   adtividad DOS ------------------------------------------------------------------


    public function actividadDos($id_leccion){

        $maxCntCarPalabraTra=0;
        $leccion = leccionesEnc::where('id', $id_leccion)->get();

        if(count($leccion)>0){
        $control = controlAvance::where('leccion_id',$id_leccion)->where('actividad_id',2)->where('usuario_documento',\Auth::user()->documento)->get();
        if($control[0]->estado!="Completed"){
            $control[0]->estado="In progress";
            $control[0]->save();
        }

        $numPalabras =leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->orderBy('palabra_id','asc')->count();

        $inicio = floor($numPalabras/3);
        $fin= $inicio+$inicio;

        //dd($inicio ." -> ".$fin);

        $listaTraducciones = array();
        $traduccionesMostrar = array();
        $palabrasEspDet = leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->skip($fin)->take(5)->orderBy('palabra_id','asc')->get();
        foreach($palabrasEspDet as $palabraEsp){

            $traducciones = traducciones::select('palabra_id', 'traduccion')
                ->where('palabra_id', $palabraEsp->palabra_id)
                ->where('idiomas_id', 1)
                ->get();
            $palabraEsp->getpalabra;
            foreach($traducciones as $trad){
                $maxCntCarPalabraTra= (strlen($trad->traduccion)>$maxCntCarPalabraTra)?strlen($trad->traduccion):$maxCntCarPalabraTra;
                $listaTraducciones[$palabraEsp->palabra_id] = $trad->traduccion;
                $traduccionesMostrar[$palabraEsp->palabra_id] = $trad->traduccion;
            }

        }
        shuffle($traduccionesMostrar);
        $data['maxCntCarPalabraTra'] = $maxCntCarPalabraTra;
        $data['idleccion'] = $id_leccion;
        $data['palabrasEspDet'] = $palabrasEspDet;
        $data['listaTraducciones'] = $listaTraducciones;

        //dd($listaTraducciones);

        $data['traduccionesMostrar'] = $traduccionesMostrar;
        $data['leccion'] = $id_leccion;
//dd($data);
        return view('actividadesRepaso.actividaddos',$data);
        }else{
            return \Redirect::back();
        }
    }
    //    ------------------------------------------------------   adtividad TRES ------------------------------------------------------------------

    public function actividadTres($id_leccion){
        $maxCntCarPalabraTra=0;
        $maxCntCarPalabraEsp=0;

            $leccion = leccionesEnc::where('id', $id_leccion)->get();

            if(count($leccion)>0){
        $control = controlAvance::where('leccion_id',$id_leccion)->where('actividad_id',3)->where('usuario_documento',\Auth::user()->documento)->get();
        if($control[0]->estado!="Completed"){
            $control[0]->estado="In progress";
            $control[0]->save();
        }

        $listaTraducciones = array();
        $traduccionesMostrar = array();
        $Traducciones =array();

        $numPalabras =leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->orderBy('palabra_id','asc')->count();

        $inicio = floor($numPalabras/3);
        $fin= $inicio+$inicio;
        $palabrasEspDet = leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->skip($fin)->take($numPalabras)->orderBy('palabra_id','asc')->get();

        foreach($palabrasEspDet as $palabraEsp){
            if($palabraEsp->getpalabra)
                $maxCntCarPalabraEsp= (strlen($palabraEsp->getpalabra->palabra)>$maxCntCarPalabraEsp)?strlen($palabraEsp->getpalabra->palabra):$maxCntCarPalabraEsp;

            $traducciones = traducciones::select('id', 'traduccion')
                ->where('palabra_id', $palabraEsp->palabra_id)
                ->where('idiomas_id', 1)
                ->get();
            $Traducciones[$traducciones[0]->id]=$traducciones[0]->traduccion;
        }

        foreach($palabrasEspDet as $palabraEsp){
            $traducciones = traducciones::select('id', 'traduccion')
                ->where('palabra_id', $palabraEsp->palabra_id)
                ->where('idiomas_id', 1)
                ->get();

            foreach($traducciones as $trad){
                $listaTraduccionesextras =array();
                $maxCntCarPalabraTra= (strlen($trad->traduccion)>$maxCntCarPalabraTra)?strlen($trad->traduccion):$maxCntCarPalabraTra;
                $listaAMostrar = array();
                $listaTraducciones[$palabraEsp->palabra_id] = $trad->traduccion;
                $listaTraduccionesextras=$Traducciones;

                unset($listaTraduccionesextras[$traducciones[0]->id]);
                shuffle($listaTraduccionesextras);

                for($i=0;$i<count($listaTraduccionesextras);$i++){
                    if($i>2)
                        break;
                    $listaAMostrar[]=$listaTraduccionesextras[$i];
                }
                $listaAMostrar[]=$trad->traduccion;
                shuffle($listaAMostrar);



                $traduccionesMostrar[$palabraEsp->palabra_id] = $listaAMostrar;
            }

        }
        //shuffle($traduccionesMostrar);
        $data['maxCntCarPalabraTra'] = $maxCntCarPalabraTra;
        $data['maxCntCarPalabraEsp'] = $maxCntCarPalabraEsp;
        $data['idleccion'] = $id_leccion;
        $data['palabrasEspDet'] = $palabrasEspDet;
        $data['listaTraducciones'] = $listaTraducciones;
        $data['traduccionesMostrar'] = $traduccionesMostrar;
        $data['leccion'] = $id_leccion;
        //dd($data);
        return view('actividadesRepaso.actividadtres',$data);
            }else{
                return \Redirect::back();
            }
    }

//    ------------------------------------------------------   adtividad TRES 1 ------------------------------------------------------------------

    public function actividadTres1($id_leccion){

        $leccion = leccionesEnc::where('id', $id_leccion)->get();

        if(count($leccion)>0){
            $control = controlAvance::where('leccion_id',$id_leccion)->where('actividad_id',3)->where('usuario_documento',\Auth::user()->documento)->get();
            if($control[0]->estado!="Completed"){
                $control[0]->estado="In progress";
                $control[0]->save();
            }

            $listaTraducciones = array();
            $traduccionesMostrar = array();
            $Traducciones =array();

            $numPalabras =leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->orderBy('palabra_id','asc')->count();

            $inicio = floor($numPalabras/3);
            $fin= $inicio+$inicio;
            $palabrasEspDet = leccionesDet::select('palabra_id')->where('leccion_id', $id_leccion)->skip($fin)->take($numPalabras)->orderBy('palabra_id','asc')->get();

            foreach($palabrasEspDet as $palabraEsp){
                $traducciones = traducciones::select('id', 'traduccion')
                    ->where('palabra_id', $palabraEsp->palabra_id)
                    ->where('idiomas_id', 1)
                    ->get();
                $Traducciones[$traducciones[0]->id]=$traducciones[0]->traduccion;
            }

            foreach($palabrasEspDet as $palabraEsp){
                $traducciones = traducciones::select('id', 'traduccion')
                    ->where('palabra_id', $palabraEsp->palabra_id)
                    ->where('idiomas_id', 1)
                    ->get();

                foreach($traducciones as $trad){
                    $listaTraduccionesextras =array();
                    $listaAMostrar = array();
                    $listaTraducciones[$palabraEsp->palabra_id] = $trad->traduccion;
                    $listaTraduccionesextras=$Traducciones;

                    unset($listaTraduccionesextras[$traducciones[0]->id]);
                    shuffle($listaTraduccionesextras);

                    for($i=0;$i<count($listaTraduccionesextras);$i++){
                        if($i>2)
                            break;
                        $listaAMostrar[]=$listaTraduccionesextras[$i];
                    }
                    $listaAMostrar[]=$trad->traduccion;
                    shuffle($listaAMostrar);



                    $traduccionesMostrar[$palabraEsp->palabra_id] = $listaAMostrar;
                }

            }
            //shuffle($traduccionesMostrar);
            $data['idleccion'] = $id_leccion;
            $data['palabrasEspDet'] = $palabrasEspDet;
            $data['listaTraducciones'] = $listaTraducciones;
            $data['traduccionesMostrar'] = $traduccionesMostrar;
            $data['leccion'] = $id_leccion;
            dd($data);
            return view('actividadesRepaso.actividadtres1',$data);
        }else{
            return \Redirect::back();
        }
    }








    public function controlAvanceFinalisada(Request $request){

        $control = controlAvance::where('leccion_id',$request->input("id_leccion"))->where('actividad_id',$request->input("id_actividad"))->where('usuario_documento',\Auth::user()->documento)->get();
            $control[0]->estado="Completed";
            $control[0]->save();

    }



}
