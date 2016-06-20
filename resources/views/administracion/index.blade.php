@extends('layouts.admin.principal')
<?php $user = Auth::user(); ?>
@section('content')
	<div>
		<p>Bienvenido al modulo de administración, dependiendo de las credenciales de tu cuenta de usuario podras crear, 
			modificar y eliminar suarios o instituciones</p>
	</div>
	{{--
	@if($user->rol == 'superadmin')
	<div>
		<a href="{{ route('instituciones.index') }}" role="button" class="btn btn-primary">Instituciones</a>
	</div>
	@endif
	<div>
		<a href="{{ route('usuarios.index') }}" role="button" class="btn btn-success">Usuarios</a>
	</div>--}}
@endsection
