@extends('layouts.admin.principal')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Editar a {{$usuario->nombres}} {{$usuario->apellidos}}</div>
												
					<div class="panel-body">
						@include('administracion.usuarios.parciales.mensajes')
						{!! Form::model($usuario, ['route'=> ['usuarios.update', $usuario->documento], 'method'=>'PUT']) !!}	
							@include('administracion.usuarios.parciales.campos')
						  	<button type="submit" class="btn btn-success">Actualizar Datos</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection