<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\categoria;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\palabrasEsp;
use LearningWords\tiempoVerbal;
use LearningWords\tipoPalabra;
use LearningWords\traducciones;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;
use LearningWords\Http\Requests\RequestEditarPalabra;

class PalabraController extends Controller
{
    /**
     * Visualiza la pagina principal del registro de palabras.
     *
     * @return la vista palabras.palabras
     */
    public function index()
    {
        return view('palabras.palabras');
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
     * [update Edita la traduccion y la palabta en español].
     * @param  Request  $request [trae el idpalabra y la palabra español, y el idtraduccion y la traduccion correspondientes a la palabra que se quiere editar]
     * @return [json] [Respuesta satisfactoria o negativa a accion segun corresponda]
     */
    public function update(Request $request)
    {
        $result='';
        $cambios = 0;
        $Traduccion = traducciones::find($request->input('idTraduccion'));
        $Palabra_esp = palabrasEsp::find($request->input('idPalabra'));

        if ($Traduccion->traduccion != $request->input('traduccion')){
            $cant = traducciones::where('traduccion',$request->input('traduccion'))->count();
            if ($cant==0){
                $Traduccion->traduccion = $request->input('traduccion');
                $Traduccion->save();
                $cambios++;
            }
        }
        if ($Palabra_esp->palabra != $request->input('palabra')){
            $cant =  palabrasEsp::where('palabra', $request->input('palabra'))->count();
            if ($cant==0){
                $Palabra_esp->palabra = $request->input('palabra');
                $Palabra_esp->save();
                $cambios++;
            }
        }
        if ($cambios == 0){
            $result['estado'] = false;
            $result['mensaje'] = 'Debe introducir al menos un cambio.';
        }
        else {
            $result['estado'] = true;
            $result['mensaje'] = 'Cambios efectuados correctamente.';
        }
        return json_encode($result);
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
     * [getPalabras obtiene las palabras registradas en la base de datos]
     * @return [json] [data con la lista de palabras y sus traducciones]
     */
    public function getPalabras()
    {
        $query=traducciones::where('idiomas_id', 1)->get();
        foreach($query as $palabra){
            $palabra['español'] = $palabra->palabra_esp();
            $palabra['tiempo'] = $palabra->getTiempoVerbal->nombre;
        }
        return json_encode(["data" => $query]);
    }

    /**
     * [editarPalabra Regresa el modal que permite editar la palabra seleccionada]
     * @return [view] [palabras.modalEditarPalabra]
     */
    public function editarPalabra(Request $request){
        $query = traducciones::where('id', $request->input('id'))->get();
        $espanol = palabrasEsp::where('id', $query[0]->palabra_id)->get();
        $datosForm = ['palabra'=>$espanol[0]->palabra, 'traduccion'=>$query[0]->traduccion, 'idTraduccion'=>$query[0]->id, 'idPalabra'=>$espanol[0]->id, 'tiempo'=>$query[0]->tiempoverbal_id, 'tipo'=>$query[0]->tipo_id];
        return view('palabras.modalEditarPalabra', compact("datosForm"));
    }

    /**
     * [crearPalabra Regresa el modal que permite crear una nueva palabra]
     * @return [view] [palabras.modalCrearPalabra]
     */
    public  function crearPalabra(){
        $tiempos = tiempoVerbal::all();
        $tipos = tipoPalabra::all();
        $categorias = categoria::all();

        $arrayTiempos = Array();
        $arrayTipos = Array();
        $arrayCategorias = Array();

        foreach ($tiempos as $tiempo){
            $arrayTiempos[$tiempo->id] = $tiempo->nombre;
        }

        foreach ($tipos as $tipo) {
            $arrayTipos[$tipo->id] = $tipo->nombre;
        }

        foreach ($categorias as $categoria){
            $arrayCategorias[$categoria->id] = $categoria->nombre;
        }
        $arrayCategorias['otro']="Otro..";
        return view('palabras.modalCrearPalabra', compact("arrayTiempos", "arrayTipos", 'arrayCategorias'));

    }

    /**
     * [insertPalabra Valida e inserta la informacion de una nueva palabra].
     * @param  RequestEditarPalabra  $request [Trae toda la informacion ingresada por el usuario en el formulario de nueva palabra]
     * @return [json] [Respuesta satisfactoria o negativa a accion segun corresponda]
     */
    public function insertPalabra(Request $request){
//        $idpalabraEsp =
        dd($request->all());
    }
}
