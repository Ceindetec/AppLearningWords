@extends('layouts.admin.principal')

@section('css')
<style>
td, th {
	text-align: center;
}
</style>
@endsection

@section('content')
<!-- <div class="page-title">
	<div class="title_left">
		<h3>
			Registro de lecciones
		</h3>
	</div>
</div> -->
<div class="clearfix"></div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			
		</h3>		
		 <a href="{!!route('lecciones.create')!!}" class="btn btn-success">Create new lesson</a> 
	</div>

	<div class="panel-body">
		<table id="leccionesByDocente" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>			
					<th>Lesson name</th>
					<th>Words</th>
					<th>Edit</th>
					<th>Progress</th>
					<th>Remove</th>
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

	table[0] = $('#leccionesByDocente').DataTable( {
		// "language": {
		// 	"url": "{!!route('espanol')!!}"
		// },
		ajax: {
			url: "{!!route('lecciones.cargar')!!}",
			"type": "POST"
		},
		columns: [  { data: 'id' },
					{ data: 'nombre'},
					{ data: 'canPalabras'}
				 ],
		"columnDefs": [
			{
				"targets": [0],
				"visible": false,
				"searchable": false
			},
			{
				"targets": [3],
				"data": null,
				"defaultContent": "<button class='btn btn-info' onclick='editarLeccion(event)'>Edit</button>"
			},
			{
				"targets": [4],
				"data": null,
				"defaultContent": "<button class='btn btn-info' onclick='consultarLeccion(event)'>Consult</button>"

			},
			{
				"targets": [5],
				"data": null,
				"defaultContent": "<button class='btn btn-danger' onclick='eliminarLeccion(event)'>Remove</button>"
			}
		],
		"scrollX": true
	} );

});

function editarLeccion(event){
	var element = event.target;
	var data = table[0].row( $(element).parents('tr') ).data();
	$.ajax({
			type : "POST",
			url : "{!!route('lecciones.verificar')!!}",
			async: false,
			data: {"id": data.id},
			success: function(respuesta){
					if(respuesta > 0){
						$.msgbox("You can not edit lessons where students have already conducted rehearsals or evaluations.",{type:'error'});
					}
					else{
						//window.location = "";
						window.location = "lecciones/"+data.id+"/edit";
						{{--sessionStorage.setItem('idLeccion', data.id);--}}
						{{--window.location = "{!!route('lecciones.editar')!!}";--}}
					}
			}
		});
}

function consultarLeccion(event){
	var element = event.target;
	var data = table[0].row( $(element).parents('tr') ).data();
	$.ajax({
		type : "POST",
		url : "{!!route('lecciones.verificar')!!}",
		async: false,
		data: {"id": data.id},
		success: function(respuesta){
			if(respuesta > 0){
				window.location = "progresos/"+data.id;
			}
			else
				$.msgbox("Although there are no shares registered for the selected lesson.",{type:'alert'});
		}
	});
}

function eliminarLeccion(event){
	var element = event.target;
	var data = table[0].row( $(element).parents('tr') ).data();
	$.ajax({
			type : "POST",
			url : "{!!route('lecciones.verificar')!!}",
			async: true,
			data: {"id": data.id},
			success: function(respuesta){				
					if(respuesta > 0){
						$.msgbox("The lesson has selected rework or evaluations of activities carried out by students. Are you sure you want to delete this lesson?", { type: 'confirm' }, function(result){
							if(result == 'Aceptar'){
								eliminar(data.id);	
								table[0].row( $(element).parents('tr') ).remove().draw( false );
							}
						
					});
					}
					else{
						$.msgbox("Are you sure you want to delete this lesson?", { type: 'confirm' }, function(result){
							if(result == 'Aceptar'){
								eliminar(data.id);	
								table[0].row( $(element).parents('tr') ).remove().draw( false );
							}
						});
					}	
			}
		});	
}

/*****************************************************************************************************************/
// Función que construye el data table de los detalles de la lección.
/*****************************************************************************************************************/
function eliminar(datos){
	
	$.ajax({
			type : "delete",
			url : "{!! route('lecciones.destroy') !!}",
			async: false,
			data: {"id": datos},
			success: function(respuesta){
				$.msgbox("Se ha eliminado de manera exitosa la lección.",{type:'success'});
			}
		});
}
</script>

@endsection