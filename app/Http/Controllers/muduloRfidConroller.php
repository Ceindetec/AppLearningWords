<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;

class muduloRfidConroller extends Controller
{
    /**
     * Visualiza la pagina principal del registro de modulos.
     *
     * @return la vista administracion.modulorfid.index
     */
    public function index()
    {
        return view('administracion.modulorfid.index');
    }

    /**
     * [editarmoduloRFID regresa el modal que permite editar la informacion de un modulo especifico]
     * @param  Request $request [en este caso trae el id correspondiente al modulo que se quiere editar]
     * @return [view]           [administracion.modulorfid.modaleditarmodulo ]
     */
    public function editarmoduloRFID(Request $request){
        $id = $request->input('id');
        return view('administracion.modulorfid.modaleditarmodulo');
    }

    /**
     * [registrarmoduloRFID regresa el modal que permite registrar nuevos modulos rfid]
     * @return [view] [administracion.modulorfid.modalregistrarmodulo]
     */
    public function registrarmoduloRFID(){
        return view('administracion.modulorfid.modalregistrarmodulo');
    }

    /**
     * [gridmodulosRFID obtiene la data que sera cargada en la grid que visualiza la lista de modulos existen]
     * @return [json] [data con la lista de modulos]
     */
    function gridmodulosRFID(){

        return json_encode(['data'=>[['id' => 1, 'idmodulo'=>'121312312','nombre'=>'ofina 1'], 
           ['id' => 2, 'idmodulo'=>'12qwe','nombre'=>'ofina 2'], 
           ['id' => 3, 'idmodulo'=>'1213rttry2','nombre'=>'sala de juntas']
           ]]);
    }
}
