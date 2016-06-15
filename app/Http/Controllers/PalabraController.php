<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\palabrasEsp;
use LearningWords\traducciones;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
            $result['mensaje'] = 'Debe introducir al menos un cambio';
        }
        else {
            $result['estado'] = true;
            $result['mensaje'] = 'Cambios efectuados';
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
        $datosForm = ['palabra'=>$espanol[0]->palabra, 'traduccion'=>$query[0]->traduccion, 'idTraduccion'=>$query[0]->id, 'idPalabra'=>$espanol[0]->id];
        return view('palabras.modalEditarPalabra', compact("datosForm"));
    }
    /**
     * [updatePal ejecuta accion encargada del update de la palabra seleccionada]
     */
    public function updatePal(){

    }


}
