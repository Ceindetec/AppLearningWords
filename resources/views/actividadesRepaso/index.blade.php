@extends('layouts.admin.principal')

@section('css')
<style>
td, th {
	text-align: center;
}
.button_x {
	height:100px;
	width: 200px;
}

</style>
@endsection

@section('content')
<div class="page-title">
	<!-- <div class="title_left">
		<h3>Lecciones a Repasar</h3>
	</div> -->
</div>

<div class="col-sm-10 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<form class="form-horizontal">
				<div class="form-group">
							{!!Form::label(null,'Select a Teaching: ',['class'=>"col-sm-3 control-label"])!!}
						<div class="col-sm-8">
							{!!Form::select('docentes', $listadocentes ,null,['class'=>'form-control', 'id' => 'docentes', 'required'])!!}
						</div>

				</div>

			</form>
		</div>
		<div class="panel-body">
{{--			 <div class = 'form-group'>
				<div class = 'col-md-4' style="text-align:center">
					<button class='btn btn-primary button_x' onclick='actividaduno()'>Actividad uno</button>
				</div>
				<div class = 'col-md-4' style="text-align:center">
					<button class='btn btn-success button_x' onclick='actividaddos()'>Actividad dos</button>
				</div>
				<div class = 'col-md-4' style="text-align:center">
					<button class='btn btn-info button_x' onclick='actividadtres()'>Actividad tres</button>
				</div>
			</div>--}}


			<table id="lecciones" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>id</th>
					<th>Lección</th>
					{{--<th>Estado</th>--}}
					<th>Estado</th>
					<th>Acciones</th>

				</tr>
				</thead>
				<tbody></tbody>
			</table>


		</div>


	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
var table;
	$(function(){
		$('#lecciones').on('init.dt', function ( ) {
			handleAjaxModal();
		});
		llenarGrid($("#docentes").val());
	});

	$("#docentes").on("change",function(){
		console.log("el ide es "+ $("#docentes").val());

		table.destroy();
		llenarGrid($("#docentes").val());
		i++;
/*		$.ajax({
			type:"GET",
			context: document.body,
			url: 'actividadesRepaso/'+$("#docentes").val(),
			//data: {'id_docente': $("#docentes").val()} ,
			success: function(data){
				if (data=="exito") {

				}else {

				}
			},
			error: function(){
				console.log('error en la concexción');
			}
		});*/
	});




http://localhost/ingles/public/leccionesRepaso/86071522?_=1467216393792
	function llenarGrid(id_docente){



		table = $('#lecciones').DataTable( {
			"language": {
				"lengthMenu": "Show _MENU_ words per page",
				"zeroRecords": "No matching words found",
				"info": "Showing _START_ to _END_ of _TOTAL_ words",
				"infoEmpty": "No words available",
				"infoFiltered": "(filtered from _MAX_ total words)"
			},
			ajax: {
				url: "actividadesRepaso/"+id_docente,
				"type": "GET"
			},
			columns: [  { data: 'id' },
				{ data: 'nombre' },
				{ data: 'estado' }],

			"columnDefs": [
				{
					"targets": [0],
					"visible": false,
					"searchable": false
				},
				{
					"targets": [3],
					"data": null,
					"defaultContent":  "<button class='btn btn-primary' onclick='repasar(event)'>Repasar</button>"
				}
			],
			"scrollX": true
		} );
	}


function actividaduno(){
	var leccion= $('#lecciones').val();
	if(leccion)		
		window.location = "actividaduno/" + leccion;
	else
		$.msgbox("Debe seleccionar una lección para repasar.",{type:'error'});
}
function actividaddos(){
	var leccion = $('#lecciones').val();
	if(leccion){
		window.location = "actividaddos/" + leccion;

	}
	else{
		$.msgbox("Debe seleccionar una lección para repasar.",{type:'error'});
	}

}

function actividadtres(){
	var leccion = $('#lecciones').val();
	if(leccion){
		window.location = "actividadtres/" + leccion;

	}
	else{
		$.msgbox("Debe seleccionar una lección para repasar.",{type:'error'});
	}

}

function  repasar(evento){
	var elemento = evento.target;
	console.log(elemento);
	var data = table.row($(elemento).parents('tr')).data();
	//console.log(data['id']);

	window.location = "actividades/" + data['id'];

}

</script>
@endsection