<?php

class TestBl{
	

	public function TestBl(){}

	public function getDatosGrid(){
		$prueba = \DB::select('CALL getDatosPrueba');
		return $prueba;
	}

	public function insTesData($request){

		$usuario =  $request->input('usuario');
		$direccion =  $request->input('email');
		$telefono = $request->input('contra');
		$prueba = \DB::select('CALL InsertarTest(?,?,?)', array($usuario,$direccion,$telefono));
		$result['estado'] = true;
		$result['mensaje'] = 'Registrado correctamente';
		return json_encode($result);
	}
}

?>