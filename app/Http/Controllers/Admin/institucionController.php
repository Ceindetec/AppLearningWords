<?php

namespace LearningWords\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LearningWords\institucion;
use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;
use Auth;

class institucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['instituciones'] = institucion::all();
        $data['usuarioAdmin'] = Auth::user();
        return view('administracion.instituciones.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.instituciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $institucion = new institucion($request->all());
        $institucion->save();
        return redirect()->route('instituciones.index');
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
        $data['institucion'] = institucion::find($id);
        return view('administracion.instituciones.edit', $data);
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
        $institucion = institucion::find($id);
        $institucion->fill($request->all());
        $institucion->save();
        return redirect()->route('instituciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultado = institucion::destroy($id);
        return redirect()->route('instituciones.index');
    }
}
