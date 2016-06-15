@extends('layouts.admin.principal')



@section('content')


<div class="page-title">
	<div class="title_left">
		<h3>
			Registro de modulo RFID 
		</h3>
	</div>
</div>
<div class="clearfix"></div>




<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
		<a href="{!!route('registrarmodulo')!!}" class="btn btn-success" data-modal="">Registrar nuevo modulo</a>
	</div>
	<div class="panel-body">
		<table id="MudulosRFID" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Id modulo</th>
					<th>Nombre oficina</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">select 2</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				{!!Form::select('size', [], null, ['class'=>'col-md-8'])!!}
			</div>
			
		</div>
	</div>



@endsection

@section('scripts')

<script type="text/javascript">

$(function(){

	

	$('#MudulosRFID').on('init.dt', function ( ) {
		handleAjaxModal();
	});

	table[0] = $('#MudulosRFID').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('gridmodulosRFID')!!}",
			"type": "POST"
		},
		columns: [  { data: 'id' },
		{ data: 'idmodulo' },
		{ data: 'nombre' }],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		{
			"targets": [3],
			"data": null,
			"defaultContent": "<a href={!!route('editarmodulo')!!} data-modal='' data-id='id' table='0'; class='btn btn-primary'>Editar</a>" 
		},
		{
			"targets": [4],
			"data": null,
			"defaultContent":  "<button class='btn btn-danger' onclick='eliminar(event)'>Eliminar</button>" 
		}
		],
		"scrollX": true
	} );

});

function eliminar(event){
	var element = event.target;
	$.msgbox("Esta seguro que desea elimnar este modulo", { type: 'confirm' }, function(result){
		if(result == 'Aceptar')
			var data = table[0].row( $(element).parents('tr') ).remove().draw( false );
	});
	
}


var data = [{id: '0', text: 'Text to display'}, { id: '1',text: 'deiby'}, { id: '2',text: 'julian'}, { id: '3',text: 'cristian'},
			 {id: '4', text: 'Text to display'}, { id: '5',text: 'deiby'}, { id: '6',text: 'julian'}, { id: '7',text: 'cristian'}]

$('select').select2({
  data: data,
  language: "es"
});

</script>

@endsection