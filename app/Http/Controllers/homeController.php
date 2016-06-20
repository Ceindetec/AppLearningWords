<?php

namespace LearningWords\Http\Controllers;

use Illuminate\Http\Request;

use LearningWords\Http\Requests;
use LearningWords\Http\Controllers\Controller;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function administracion(){
    	return view('administracion.index');
    }
}
