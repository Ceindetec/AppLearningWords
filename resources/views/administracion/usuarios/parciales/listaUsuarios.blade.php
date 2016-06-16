<div class="panel panel-default">
	<div class="panel-heading"> Listado de usuarios</div>
								
	<div class="panel-body">
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Documento</th>
				<th>Institución</th>
				<th>Función</th>
				<th>Acciones</th>
			</tr>
			@foreach($usuarios as $usuario)
			<tr>
				<td>{{$usuario->id}}</td>
				<td>{{$usuario->nombres}} {{$usuario->apellidos}}</td>
				<td>{{$usuario->documento}}</td>
				<td>
					@if($usuario->institucion != null)
						{{ $usuario->institucion->nombre }}
					@else
						<p>N/A</p>
					@endif
				</td>
				<td>{{$usuario->rol}}</td>
				<td>
					<a href="{{ route('usuarios.edit', $usuario->documento) }}" role="button" class="btn btn-primary">Editar</a>
					<a href="{{ route('usuarios.destroy', $usuario->documento) }}" role="button" class="btn btn-danger">Eliminar</a>
				</td>
			</tr>
			@endforeach
		</table>
		
	</div>
	<div class="panel-footer"> Listado de usuarios</div>
</div>