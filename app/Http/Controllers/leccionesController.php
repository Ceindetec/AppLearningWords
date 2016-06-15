<?php

namespace LearningWords\Http\Controllers;
use DB;
use LearningWords\leccionesEnc;
use LearningWords\leccionesDet;
use LearningWords\categoria;
use LearningWords\palabrasEsp;
use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;

class leccionesController extends Controller
{
    public $palabras;
    
    public function index()
    {
        return view('lecciones.index');
    }

   
    public function create()
    {
        $categorias = categoria::select('id', 'nombre')->get();
        foreach($categorias as $categoria)
            $listaCategorias[$categoria['id']] = $categoria['nombre'];
        return view('lecciones.crearLeccion', compact('listaCategorias'));
    }

   
    public function store(Request $request){

    $nombre = $request->input("nombre");
    $docente = $request->input("usuario_documento");

    $esta = $this->checkNombreLeccionByDocente($docente, $nombre);     
        if($esta == 0){
            $var = new leccionesEnc($request->all());
            $var->save();      
            return response()->json(["id" => $var->id]);
        }
        else{
            return response()->json(["id" => 0]);
        }
       
    }

    public function checkNombreLeccionByDocente($documento, $nombre_leccion){

        $count = leccionesEnc::where('nombre', $nombre_leccion)->where('usuario_documento', $documento)->count();
        return $count;
    }

    public function guardarDetalleLeccion(Request $request){
        DB::beginTransaction();
        $this->palabras = $request->input("datos");
        try{           
            foreach ($this->palabras as $dato) {
                    DB::table('lecciones_dets')->insert(['leccion_id' => $dato["leccion_id"],'palabra_id' => $dato["palabra_id"] ]); 
            }
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(["status" => 1 ]);
        }
        DB::commit();
        return response()->json(["status" => 0]);
    }

   
    public function show($id)
    {
        $var = leccionesEnc::find($id);        
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

    
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

        $listaLecciones = leccionesEnc::where('usuario_documento','86071518')->get();       
        return json_encode(["data"=>$listaLecciones]);
    }

    function cargarPalabrasBusqueda(Request $request){
        $id_categoria = $request -> input("id_categoria");
        $listapalabras = palabrasEsp::select('id','palabra')->where('categorias_id',$id_categoria)->get();       
        return $listapalabras;
    }
}
