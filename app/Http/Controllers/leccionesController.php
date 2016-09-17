<?php

namespace LearningWords\Http\Controllers;
use DB;
use LearningWords\leccionesEnc;
use LearningWords\leccionesDet;
use LearningWords\categoria;
use LearningWords\palabrasEsp;
use LearningWords\palabrasEsp_categoria;
use LearningWords\controlAvance;
use LearningWords\evaluaciones;
use Illuminate\Http\Request;
use Guzzle\Tests\Plugin\Redirect;
use LearningWords\actividades;

use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;

class leccionesController extends Controller
{
    public $palabras;
    
    public function index()
    {
        return view('lecciones.index');
    }

//   public function editar(){
//       return view('lecciones.editarLeccion');
//   }
    public function create()
    {
        $categorias = categoria::select('id', 'nombre')->get();
        if (count($categorias) >0) {
            foreach ($categorias as $categoria)
                $listaCategorias[$categoria['id']] = $categoria['nombre'];
            return view('lecciones.crearLeccion', compact('listaCategorias'));
        }
        else{
            $listaCategorias = Array();
            return view('lecciones.crearLeccion', compact('listaCategorias'));
        }
    }

    public static function existenPalabras(){
        $palabras = palabrasEsp::all();
        if (count($palabras) > 0)
            return true;
        else
            return false;
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
        $leccion = leccionesEnc::find($id);
        if (count($leccion) >0){
            $band = $this->accionVerificarAvancesLeccion($id);
            if ($band == 0) {
                $data['encabezado'] = leccionesEnc::find($id);
                $categorias = categoria::select('id', 'nombre')->get();
                foreach ($categorias as $categoria)
                    $listaCategorias[$categoria['id']] = $categoria['nombre'];

                $data['categorias'] = $listaCategorias;
                return view('lecciones.editarLeccion', $data);
            }
            else
                return \Redirect::back();
        }
        else
            return \Redirect::route('lecciones.index');
    }

  
    public function update(Request $request, $id)
    {      
        $nombre = $request -> input("nombre");
        $usuario_documento = $request -> input("usuario_documento");
        $countNombre = leccionesEnc::where('nombre', $nombre)->
                                     where('usuario_documento', $usuario_documento)->count();
        if($countNombre>0)
            return 1;
        else
        {
            $enc = leccionesEnc::find($id);
            $enc->fill($request->all());
            $enc->save();
            return 0;
        }
    }

    
    public function destroy(Request $request){
        $leccion = leccionesEnc::find($request->id);
        $leccion->delete();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $usuario_documento
     * @return [json] listaLecciones: listado de lecciones creadas por un docente
     */
    function cargarLeccionesByDocente(){

        $listaLecciones = leccionesEnc::where('usuario_documento',\Auth::user()->documento)->get();
        foreach ($listaLecciones as $leccion)
            $leccion['canPalabras'] = $leccion->getTotalPalabras();
        return json_encode(["data"=>$listaLecciones]);
    }

    function cargarPalabrasBusqueda(Request $request){
        $id_categoria = $request -> input("id_categoria");
        
        $listapalabras = palabrasEsp_categoria::where('id_Categoria',$id_categoria)->get();       
        foreach ($listapalabras as $palabra)
            $palabra->getpalabra;
        return $listapalabras;
        //return ['data'=> $listapalabras];
    
    }

    function  accionVerificarAvancesLeccion($id_leccion){
        $countActividades = controlAvance::where('leccion_id', $id_leccion)->count();
        $countEvaluaciones = evaluaciones::where('leccion_id', $id_leccion)->count();

        if($countEvaluaciones > 0 ||  $countActividades > 0 )
            return 1;
        else
            return 0;
    }

    function checkEstadoLeccion(Request $request){
//        $id_leccion = $request -> input("id");
        $res = $this->accionVerificarAvancesLeccion($request->id);
        return $res;
    }



}
