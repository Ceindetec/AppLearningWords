<div class="panel panel-default">
	<div class="panel-heading"> Listado de Instituciones</div>
								
	<div class="panel-body">
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>NIT</th>
				<th>Licencias</th>
				<th>Acciones</th>
			</tr>
			@foreach($instituciones as $institucion)			
			<tr>
				<td>{{$institucion->id}}</td>
				<td>{{$institucion->nombre}}</td>
				<td>{{$institucion->nit}}</td>
				<td>{{$institucion->cantidad_licencias}}</td>
				<td>					
					<a href="{{ route('instituciones.edit', $institucion->id) }}" role="button" class="btn btn-primary">Editar</a>
					<a href="{{ route('instituciones.destroy', $institucion->id) }}" role="button" class="btn btn-danger">Eliminar</a>
				</td>
			</tr>			
			@endforeach
		</table>
		
	</div>
</div>