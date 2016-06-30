<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\controlAvance;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\leccionesEnc;
use LearningWords\categoria;

class avancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $leccion = leccionesEnc::where('id', $id)->where('usuario_documento', \Auth::user()->documento)->get();
        if (count($leccion) >0)
            return view('avances', compact("leccion"));
        else
            return \Redirect::route('lecciones.index');
    }

    public function getAvances($id){
        $documentos = controlAvance::select('usuario_documento')->where('leccion_id',$id)->groupBy('usuario_documento')->get();
        foreach ($documentos as $documento){
            $documento['usuario'] = $documento->getNombreUsuario->nombres." ".$documento->getNombreUsuario->apellidos;
            $avances = controlAvance::where('leccion_id',$id)->where('usuario_documento',$documento->usuario_documento)->get();
            foreach ($avances as $avance){
                $documento[$avance->actividad_id] = $avance->estado;
            }
        }
        return json_encode(["data"=>$documentos]);
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
