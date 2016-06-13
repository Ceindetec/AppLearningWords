@extends('layouts.admin.principal')

@section('css')
<style>
td, th {
	text-align: center;
}
</style>
@endsection

@section('content')
<div class="page-title">
	<div class="title_left">
		<h3>
			Registro de lecciones
		</h3>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>		
		<a href="{!!route('lecciones.create')!!}" class="btn btn-success">Crear nueva lección</a>
	</div>
	<div class="panel-body">
		<table id="leccionesByDocente" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>			
					<th>Nombre lección</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">

$(function(){

	/*$('#leccionesByDocente').on('init.dt', function ( ) {
		handleAjaxModal();
	});*/

	table[0] = $('#leccionesByDocente').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('lecciones.cargar')!!}",
			"type": "POST"
		},
		columns: [  { data: 'id' },
					{ data: 'nombre'}
				 ],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		{
			"targets": [2],
			"data": null,
			"defaultContent": "<a href={!!route('lecciones.edit')!!} data-id='id' table='0'; class='btn btn-primary'>Editar</a>" 
		},
		{
			"targets": [3],
			"data": null,
			"defaultContent":  "<button class='btn btn-danger' onclick='eliminarLeccion(event)'>Eliminar</button>" 
		}
		],
		"scrollX": true
	} );

});

function eliminarLeccion(event){
	var element = event.target;
	$.msgbox("¿Esta seguro que desea elimnar esta lección?", { type: 'confirm' }, function(result){
		if(result == 'Aceptar')
			var data = table[0].row( $(element).parents('tr') ).remove().draw( false );
	});
	
}

</script>

@endsection