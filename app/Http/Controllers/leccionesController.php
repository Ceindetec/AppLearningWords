<?php

namespace LearningWords\Http\Controllers;

use LearningWords\leccionesEnc;
use LearningWords\categoria;
use LearningWords\palabrasEsp;
use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;

class leccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lecciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = categoria::select('id', 'nombre')->get();
        foreach($categorias as $categoria)
            $listaCategorias[$categoria['id']] = $categoria['nombre'];
        return view('lecciones.crearLeccion', compact('listaCategorias'));
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
        $var = leccionesEnc::find($id);        
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

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $usuario_documento
     * @return json listaLecciones: listado de lecciones creadas por un docente
     */
    // TO DO
    // Implementar recepcion de parametro usuario_documento para filtrar
    function cargarLeccionesByDocente(){

        $listaLecciones = leccionesEnc::where('usuario_documento',1)->get();
       
        return json_encode(["data"=>$listaLecciones]);
    }

    function cargarPalabrasBusqueda($id_categoria){

        $listapalabras = palabrasEsp::where('categorias_id',$id_categoria)->get();       
        return json_encode(["data"=>$listaLecciones]);
    }
}
