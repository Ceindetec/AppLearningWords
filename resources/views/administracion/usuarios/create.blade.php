@extends('layouts.admin.principal')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Nuevo usuario</div>
					<div class="panel-body">
						@include('administracion.usuarios.parciales.mensajes')
						
						{!! Form::open(['route'=> ['usuarios.store'], 'method'=>'POST']) !!}
						
						@include('administracion.usuarios.parciales.campos')
					  	<button type="submit" class="btn btn-primary">Crear Usuario</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection