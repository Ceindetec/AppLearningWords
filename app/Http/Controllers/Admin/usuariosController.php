<?php

namespace LearningWords\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LearningWords\institucion;
use LearningWords\User;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use LearningWords\Http\Requests\usuarioCreateRequest;
use Auth;

class usuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd("si estoy entrando");
        $data['usuarioAdmin'] = Auth::user();
        if($data['usuarioAdmin']->rol == 'superadmin'){
            $data['usuarios'] = User::whereIn('rol', ['superadmin', 'administrador'])->get();
        }elseif($data['usuarioAdmin']->rol == 'administrador'){
            $data['usuarios'] = User::where('institucion_id', $data['usuarioAdmin']->institucion_id)
                                    //->whereNotIn('documento', $data['usuarioAdmin']->documento)
                                    ->whereIn('rol', ['administrador', 'docente', 'estudiante'])
                                    ->get();
        }
        return view('administracion.usuarios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['usuarioAdmin'] = Auth::user();
        $instituciones = institucion::all();
        //dd($instituciones);
        foreach($instituciones as $institucion){
            //if($institucion->nombre != 'Ceindetec')
            $ins[$institucion->id] = $institucion->nombre;
        }
        $data['instituciones'] = $ins;
        return view('administracion.usuarios.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(usuarioCreateRequest $request)
    {
        //dd($request->all());
        $usuario = new User($request->all());
        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $usuario = User::find($id);
        return view('administracion.usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['usuario'] = User::find($id);
        $data['usuarioAdmin'] = Auth::user();
        $instituciones = institucion::all();
        //dd($instituciones);
        foreach($instituciones as $institucion){
            //if($institucion->nombre != 'Ceindetec')
            $ins[$institucion->id] = $institucion->nombre;
        }
        $data['instituciones'] = $ins;
        return view('administracion.usuarios.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(usuarioCreateRequest $request, $id)
    {
        //dd($id);
        $usuario = User::find($id);
        $usuario->fill($request->all());
        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultado = User::destroy($id);
        return redirect()->route('usuarios.index');
    }
}
