@extends('layouts.admin.principal')
<?php $user = Auth::user(); ?>
@section('content')
	<div>
		<p>Bienvenido al modulo de administración, dependiendo de las credenciales de tu cuenta de usuario podras crear, 
			modificar y eliminar suarios o instituciones</p>
	</div>
@endsection
