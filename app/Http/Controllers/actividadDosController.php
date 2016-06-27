<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\leccionesDet;
use LearningWords\traducciones;
use LearningWords\Http\Controllers\Controller;

class actividadDosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index($id){
        $listaTraducciones = array();
        $traduccionesMostrar = array();
        $palabrasEspDet = leccionesDet::select('palabra_id')->where('leccion_id', $id)->orderBy('palabra_id','asc')->get();
        foreach($palabrasEspDet as $palabraEsp){
         $traducciones = traducciones::select('palabra_id', 'traduccion')
             ->where('palabra_id', $palabraEsp->palabra_id)
             ->where('idiomas_id', 1)
             ->get();
         $palabraEsp->getpalabra;
         foreach($traducciones as $trad){
          $listaTraducciones[$palabraEsp->palabra_id] = $trad->traduccion;
          $traduccionesMostrar[$palabraEsp->palabra_id] = $trad->traduccion;
         }

        }
        shuffle($traduccionesMostrar);
        $data['palabrasEspDet'] = $palabrasEspDet;
        $data['listaTraducciones'] = $listaTraducciones;

   //dd($listaTraducciones);

        $data['traduccionesMostrar'] = $traduccionesMostrar;
       $data['leccion'] = $id;

        return view('actividadesRepaso.actividaddos',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
