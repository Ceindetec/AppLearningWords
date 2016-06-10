<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;

use Utils;
use TestBl;
use Socialite; 



class mainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('index');
    }

    public function getViewModal()
    {
        return view('main.testmodal');
    }

    /**
     * funcion que me carga el modal para el text es llamada por get
     * 
     * @return retorna la vista que sera cargada en el modal
     */
    public function modalTest()
    {
        return view('main.modalTest');
    }

    /**
     * Funcion que me carga el modal para el ejemplo con formulario (entra por get)
     * 
     * @return retorna la vista que sera cargada en el modal
     */
    public function getModalFormulario()
    {
        return view('main.modalformulario');
    }

    /**
     * Funcion que me carga el modal para el ejemplo con formulario (entra por get)
     * 
     * @return retorna la vista que sera cargada en el modal
     */
    public function getViewProcedimientos()
    {


        return view('main.testProcedimientos');


    }

    /**
     * Funcion que procesa los datos enviados desde el modal que contiene un formulario entra por post
     * 
     * @param $rq -> este parametro recibe los datos enviados por el formulario para ser usado
     * 
     * @return $restult -> json que contiene el estatus de la operacion, mensaje opcional, y los datos de que se deseen regresar
     */

    public function postMamodalFormulario(Request $request)
    {
         $Bl = new TestBl();
         $result = $Bl->insTesData($request);
         return $result;
    }

    

    public function postPrubaproce(Request $rq)
    {

        $Bl = new TestBl();

        $datos = $Bl->getDatosGrid();

        $request = file_get_contents('php://input');

        $input = json_decode($request);

        $util = new Utils();

        return $util->getDataRequest($datos,$input);
        
    }


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
        //return views('facebook.index');
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        var_dump($user);
        //return view('main.facebook',compact('user'));
        
    }

}
