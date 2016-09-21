<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\categoria;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\leccionesDet;
use LearningWords\palabrasEsp;
use LearningWords\palabrasEsp_categoria;
use LearningWords\tiempoVerbal;
use LearningWords\tipoPalabra;
use LearningWords\traducciones;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;
use LearningWords\Http\Requests\RequestEditarPalabra;
use LearningWords\Http\Requests\RequestCategoria;
header('Content-Type: text/html; charset=UTF-8');
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
     * [update Valida informacion que llega y solicita updates].
     * @param  Request $request [Trae toda la informacion del formulario de actualizacion]
     * @return [json] [Respuesta satisfactoria o negativa a accion segun corresponda]
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $result = '';
        $palEspanol = ucwords(mb_strtolower($request->input('palabra')));
        $traduccion = ucwords(mb_strtolower($request->input('traduccion')));
        $respuesta = "";
        $result['estado'] = false;
        $cantIguales = 0;
        $cambios = 0;

        $Traduccion = traducciones::find($request->input('idTraduccion'));
        $Palabra_esp = palabrasEsp::find($request->input('idPalabra'));
//        dd($Palabra_esp);
        if($palEspanol != "" && $traduccion != "" && count($request->input('categorias')) > 0){
            $catIngresadas = $request->input('categorias');
            $catExistentes = preg_split("/,/", $request->input('categoria'));

            for ($i = 0; $i<count($catIngresadas); $i++){
                for($j=0; $j<count($catExistentes); $j++){
                    if($catExistentes[$j] == $catIngresadas[$i])
                        $cantIguales++;
                }
            }
            if($palEspanol !== $Palabra_esp->palabra) {
                $val = 1;
//                dd($palEspanol);
                $cant = palabrasEsp::where('palabra', $palEspanol)->get();
//                dd("if" . count($cant) . " > 0");
                if (count($cant) > 0) {
                    if ($palEspanol !== $cant[0]->palabra)
                        $val = 0;
                } else
                    $val = 0;
//                dd($val);
                if ($val==0){
                    $Palabra_esp->palabra = $palEspanol;
                    $Palabra_esp->save();
                    $cambios++;
                }
            }

            if($cantIguales != count($catExistentes) || $cantIguales!= count($catIngresadas)){
                $afectadas = palabrasEsp_categoria::where('id_palabraEsp', '=', $request->input('idPalabra'))->delete();
                for ($i=0; $i<count($catIngresadas); $i++)
                    $this->insertPalabraEsp_Categoria($request->input('idPalabra'), $catIngresadas[$i]);
                $cambios++;
            }

            if($request->input('tipo') == 5){
                $reg = traducciones::where('traduccion', $traduccion)->where('tiempoverbal_id', $request->input('tiempo'))->get();
                if (count($reg) == 0){
                    $Traduccion->traduccion = $traduccion;
                    $Traduccion->tipo_id = 5;
                    $Traduccion->tiempoverbal_id = $request->input('tiempo');
                    $Traduccion->save();
                    $cambios++;
                }
            }
            else{
                $reg = traducciones::where('traduccion', $traduccion)->where('tipo_id', $request->input('tipo'))->get();
                if (count($reg) == 0){
                    $Traduccion->traduccion = $traduccion;
                    $Traduccion->tipo_id = $request->input('tipo');
                    $Traduccion->tiempoverbal_id = 1;
                    $Traduccion->save();
                    $cambios++;
                }
            }

            if ($cambios == 0){
                $respuesta = 'Debe introducir al menos un cambio.';
            }
            else {
                $result['estado'] = true;
                $respuesta = 'Cambios efectuados correctamente.';
            }
        }
        else {
            $respuesta = "Por favor diligenciar toda la informacion solicitada!";
        }
        $result['mensaje'] = $respuesta;
        return json_encode($result);
    }

    /**
     * Valida y elimina el registro de palabra solicitado
     * @param  Request $request contiene id de palabra y traduccion
     */
    public function destroy(Request $request)
    {
        $idpalabra = $request->input('idEsp');
        $idTraduccion = $request->input('id');
        $cantTraducciones = traducciones::where('palabra_id', $idpalabra)->count();
        if ($cantTraducciones > 1){
            traducciones::destroy($idTraduccion);
        }
        else{
            traducciones::destroy($idTraduccion);
            palabrasEsp_categoria::where('id_palabraEsp', $idpalabra)->delete();
            leccionesDet::where('palabra_id', $idpalabra)->delete();
            palabrasEsp::destroy($idpalabra);
        }
    }

    /**
     * [getPalabras obtiene las palabras registradas en la base de datos]
     * @return [json] [data con la lista de palabras y sus traducciones]
     */
    public function getPalabras()
    {
        $query=traducciones::where('idiomas_id', 1)->get();//DATO DE IDIOMA QUEMADO, PARA OBTENER DE VARIABLE DE SESION IDIOMA
        foreach($query as $palabra){
            $palabra['español'] = $palabra->palabra_esp();
            $palabra['idEspanol'] = $palabra->palabra_id;
            $palabra['tiempo'] = $palabra->getTiempoVerbal->nombre;
        }
        return json_encode(["data" => $query]);
    }

    /**
     * [ModaleditarPalabra Regresa el modal que permite editar la palabra seleccionada]
     * @return [view] [palabras.modalEditarPalabra]
     */
    public function ModaleditarPalabra(Request $request){
        $query = traducciones::where('id', $request->input('id'))->get();
        $espanol = palabrasEsp::where('id', $query[0]->palabra_id)->get();
        $tiposP = $this->getTiposPalabras();
        $tiemposV = $this->getTiemposVerbales();
        $categoriasP = $this->getCategorias();
        $categoria = $this->getCategoriasdePalabra($espanol[0]->id);
        $datosForm = ['categoria'=>$categoria,'palabra'=>$espanol[0]->palabra, 'traduccion'=>$query[0]->traduccion, 'idTraduccion'=>$query[0]->id, 'idPalabra'=>$espanol[0]->id, 'tiempo'=>$query[0]->tiempoverbal_id, 'tipo'=>$query[0]->tipo_id];
        return view('palabras.modalEditarPalabra', compact("datosForm", "tiemposV", "tiposP", "categoriasP"));
    }

    /**
     * [getCategoriasdePalabra Trae las categorias asociadas a una palabra]
     * @return [Array] [id's categorias asociadas a palabra]
     */
    public function getCategoriasdePalabra($idPalabraEsp){
        $categorias = palabrasEsp_categoria::select('id_Categoria')->where('id_palabraEsp', $idPalabraEsp)->get();
        $rta = "";
        for ($i=0; $i<count($categorias); $i++) {
            if ($i + 1 < count($categorias))
                $rta = $rta . $categorias[$i]->id_Categoria . ",";
            else
                $rta = $rta . $categorias[$i]->id_Categoria;
        }
        return $rta;
    }

    /**
     * [getTiemposVerbales Trae tiempos verbales registrados en la BD]
     * @return [Array] [Listado de tiempos verbales]
     */
    public function getTiemposVerbales(){
        $tiempos = tiempoVerbal::all();
        $arrayTiempos = Array();
        foreach ($tiempos as $tiempo)
            $arrayTiempos[$tiempo->id] = $tiempo->nombre;
        return $arrayTiempos;
    }

    /**
     * [getTiposPalabras Trae tipos de palabras registradas en la BD]
     * @return [Array] [Listado de tipos de palabras]
     */
    public function getTiposPalabras(){
        $tipos = tipoPalabra::all();
        $arrayTipos = Array();
        foreach ($tipos as $tipo)
            $arrayTipos[$tipo->id] = $tipo->nombre;
        return $arrayTipos;
    }

    /**
     * [getCategorias Trae categorias registradas en la BD]
     * @return [Array] [Listado de categorias]
     */
    public function getCategorias(){
        $categorias = categoria::all();
        $arrayCategorias = Array();
        foreach ($categorias as $categoria)
            $arrayCategorias[$categoria->id] = $categoria->nombre;
        return $arrayCategorias;
    }

    /**
     * [ModalcrearPalabra Regresa el modal que permite crear una nueva palabra]
     * @return [view] [palabras.modalCrearPalabra]
     */
    public function ModalcrearPalabra(){
        $arrayTipos = $this->getTiposPalabras();
        $arrayCategorias = $this->getCategorias();
        return view('palabras.modalCrearPalabra', compact("arrayTipos", 'arrayCategorias'));
    }

    /**
     * [insertarPalabra Valida informacion que llega y solicita incersiones].
     * @param  Request $request [Trae toda la informacion ingresada por el usuario en el formulario de nueva palabra]
     * @return [json] [Respuesta satisfactoria o negativa a accion segun corresponda]
     */
    public function insertarPalabra(Request $request){
//        dd($request->all());
        $result = '';
        $palEspanol = utf8_encode(ucwords(mb_strtolower($request->input('palabra'))));
        $traduccion = ucwords(mb_strtolower($request->input('traduccion')));
        $respuesta = "";
        $result['estado'] = false;

        if ($palEspanol != "" && $traduccion != "" && count($request->input('categoria')) != 0 ){
            if(isset($request->checkTiempos)){
                if ($this->validarExistencia($palEspanol, $traduccion, 'N/A')) {
                    $respuesta = "Verbo ya registrado";
                }
                elseif ($this->validarExistencia($request->input('prEspañol'), $request->input('prIngles'), 'pres')) {
                    $respuesta = "Verbo en presente ya registrado";
                }
                elseif ($this->validarExistencia($request->input('paEspañol'), $request->input('paIngles'), 'past')) {
                    $respuesta = "Verbo en pasado ya registrado";
                }
                elseif ($this->validarExistencia($request->input('fuEspañol'), $request->input('fuIngles'), 'part')) {
                    $respuesta = "Verbo en participio ya registrado";
                }
                else{
                    $idTraduccion = $this->ejecutarInsertPalabras($palEspanol, $traduccion, null, 'N/A', $request->input('categoria'), $request->input('tipo'));
                    $this->ejecutarInsertPalabras($request->input('prEspañol'), $request->input('prIngles'), $idTraduccion, 'pres', null, $request->input('tipo'));
                    $this->ejecutarInsertPalabras($request->input('paEspañol'), $request->input('paIngles'), $idTraduccion, 'past', null, $request->input('tipo'));
                    $this->ejecutarInsertPalabras($request->input('fuEspañol'), $request->input('fuIngles'), $idTraduccion, 'part', null, $request->input('tipo'));
                    $respuesta = "Nuevo contenido registrado correctamente!";
                    $result['estado'] = true;
                }
            }
            else
                if ($this->validarExistencia($palEspanol, $traduccion, 'N/A')) {
                    $respuesta = "Palabra ya registrada";
                }
                else {
                    $this->ejecutarInsertPalabras($request->input('palabra'), $request->input('traduccion'), null, 'N/A', $request->input('categoria'), $request->input('tipo'));
                    $respuesta = "Nuevo contenido registrado correctamente!";
                    $result['estado'] = true;
                }
        }
        else {
            $respuesta = "Falta Informacion";
        }
//        dd($respuesta);
        $result['mensaje'] = $respuesta;
        return json_encode($result);
    }

    /**
     * [insertCategoria Inserta nueva categoria en BD].
     * @param  RequestCategoria $request [Trae la informacion de la categoria]
     * @return [int] [Devuelve el id de la categoria insertada]
     */
    public function insertCategoria(RequestCategoria $request){
        $nombre = ucwords(strtolower($request->input('nombre')));
//        dd($nombre);
        $categoria = new categoria();
        $categoria->nombre = $nombre;
        $categoria->save();
        return ($categoria->id);
    }

    /**
     * [validarExistencia Examina la existencia de la palabra en español y la traduccion solicitadas tiempos modales solicitados a insertar].
     * @param  $espanol [Contiene la palabra en español solicitada a ingresar]
     *         $traduccion [contiene la palabraen ingles a ingresar]
     *         $tiempo [contiene el tiempo verbal de la palabra a ingresar]
     * @return [bool] [contiene valor logico que indica la existencia o no de la palabra y la traduccion]
     */
    public function validarExistencia($espanol, $traduccion, $siglaTiempo){
        $texto = false;
//        dd(utf8_encode($espanol));
        $idEspanol = palabrasEsp::select('id')->where('palabra',$espanol)->get();
        $regtraduccion = traducciones::where('traduccion', $traduccion)->get();
        $tiempo = tiempoVerbal::select('id')->where('sigla', $siglaTiempo)->get();
        if(count($idEspanol)>0 && count($regtraduccion)>0){
            if($regtraduccion[0]->palabra_id == $idEspanol[0]->id && $regtraduccion[0]->tiempoverbal_id == $tiempo[0]->id) {
                $texto = true;
            }
        }
        return $texto;
    }

    /**
     * [ejecutarInsertPalabras valida que la palabra y traduccion a ingresar no se repitan y lanza inserts].
     * @param  RequestCategoria $request [Trae la informacion del formulario de insertar nueva palabra]
     * @return [int] [Devuelve el id de la traduccion insertada]
     */
    public function ejecutarInsertPalabras($palEspanol, $traduccion, $padreid, $siglaTiempoV, $arrayCategorias, $tipo){
        $respuesta="";
        $palEspanol = ucwords(mb_strtolower($palEspanol));
        $traduccion = ucwords(mb_strtolower($traduccion));

        $idpalabraEsp = palabrasEsp::select('id', 'palabra')->where('palabra', $palEspanol)->get();

        if (count($idpalabraEsp) > 0) {
            if ($idpalabraEsp[0]->palabra !== $palEspanol)
                $idpalabraEsp = null;
        }

        $regTraduccion = traducciones::where('traduccion', $traduccion)->get();

        if(count($regTraduccion)>0 && count($idpalabraEsp)>0){
            $respuesta = "Palabra y traduccion ya registradas";
        }
        elseif (count($regTraduccion)==0 && count($idpalabraEsp)>0){
            //obtener categorias asociadas a palabra en español ingrersada
            $categoriasRegistradas = palabrasEsp_categoria::select('id_Categoria')->where('id_palabraEsp', $idpalabraEsp[0]->id)->get();
            //Comparar las categorias con las ingresadas por el usuario y si no existe alguna, insertarla
            for($i=0; $i<count($arrayCategorias); $i++){
                $existe=0;
                for($j=0; $j<count($categoriasRegistradas); $j++){
                    if($categoriasRegistradas[$j]->id_Categoria == $arrayCategorias[$i])
                        $existe = $existe+1;
                }
                if ($existe == 0){
                    $this->insertPalabraEsp_Categoria($idpalabraEsp[0]->id, $arrayCategorias[$i]);
                }
            }
            //Insertar traduccion
            $idTraduccionInsertada = $this->insertTraduccion($idpalabraEsp[0]->id, $traduccion, $tipo, $siglaTiempoV, $padreid);
            $respuesta = $idTraduccionInsertada;
        }
        else{
            //Añadir palabra esp
            $idPEspInsertada = $this->insertPalabraEsp($palEspanol);
            //Añadir categorias de palabra en español
            for ($i=0; $i<count($arrayCategorias); $i++)
                $this->insertPalabraEsp_Categoria($idPEspInsertada, $arrayCategorias[$i]);
            //Añadir traduccion con id palabraEsp
            $idTraduccionInsertada = $this->insertTraduccion($idPEspInsertada, $traduccion, $tipo, $siglaTiempoV, $padreid);
            $respuesta = $idTraduccionInsertada;
        }
        return ($respuesta);
    }

    /**
     * [insertPalabraEsp_Categoria Asocia una categoria a una palabra].
     * @param  $idPalabraEsp [id palabra en español a asociar con categoria]
     *         $idCategoria [id categoria a asociar a una palabra]
     */
    public function insertPalabraEsp_Categoria($idPalabraEsp, $idCategoria){
        $palabra_categorias = new palabrasEsp_categoria();
        $palabra_categorias->id_palabraEsp =  $idPalabraEsp;
        $palabra_categorias->id_Categoria = $idCategoria;
        $palabra_categorias->save();
    }

    /**
     * [insertTraduccion Inserta traduccion a la tabla traducciones].
     * @param  $idPalabraEsp [id Palabra en español asociada a la traduccion]
     *         $traduccion [traduccion de la palabra en español]
     *         $idTipo [id Tipo de palabra asociado a la traduccion]
     *         $siglaTiempoV [sigla con el tiempo verbal a buscar en tiempos_verbales]
     * @return [int] [Devuelve el id de la traduccion insertada]
     */
    public function insertTraduccion($idPalabraEsp, $traduccion, $idTipo, $siglaTiempoV, $padreId){
        $objTraduccion = new traducciones();
        $objTraduccion->palabra_id = $idPalabraEsp;
        $tiempo = tiempoVerbal::select('id')->where('sigla', $siglaTiempoV)->get();
        $objTraduccion->tiempoverbal_id = $tiempo[0]->id;
        $objTraduccion->idiomas_id = 1;//DATO QUEMADO, SE DEBE SACAR DE LA VARIABLE DE SESION IDIOMA
        $objTraduccion->traduccion = $traduccion;
        $objTraduccion->tipo_id = $idTipo;
        if ($padreId != null)
            $objTraduccion->padre_id = $padreId;
        $objTraduccion->save();
        return $objTraduccion->id;
    }

    /**
     * [insertPalabraEsp inserta palabra en español a la tabla palabras_esp].
     * @param  $palabraEsp [nombre de palabra en español a insertar]
     * @return [int] [Devuelve el id de la palabra en español insertada]
     */
    public function insertPalabraEsp($palabraEsp){
        $pEsp = new palabrasEsp();
        $pEsp->palabra = $palabraEsp;
        $pEsp->save();
        return $pEsp->id;
    }


}
