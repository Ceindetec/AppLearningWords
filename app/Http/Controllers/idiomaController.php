<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;

class idiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function espanol()
    {
        $config = [
            "sProcessing"=>     "Procesando...",
            "sLengthMenu"=>     "Mostrar _MENU_ registros",
            "sZeroRecords"=>    "No se encontraron resultados",
            "sEmptyTable"=>     "NingÃºn dato disponible en esta tabla",
            "sInfo"=>           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty"=>      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered"=>   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix"=>    "",
            "sSearch"=>         "Buscar:",
            "sUrl"=>            "",
            "sInfoThousands"=>  ",",
            "sLoadingRecords"=> "Cargando...",
            "oPaginate"=> [
            "sFirst"=>    "Primero",
            "sLast"=>     "Ãšltimo",
            "sNext"=>     "Siguiente",
            "sPrevious"=> "Anterior"
        ],
            "oAria"=> [
                "sSortAscending"=>  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending"=> ": Activar para ordenar la columna de manera descendente"
            ]
        ];

        return json_encode($config);
    }
}
