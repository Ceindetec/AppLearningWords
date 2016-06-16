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
		<h3>Editar lección</h3>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Agregar palabras</h3>		
	</div>
	<div class="panel-body">
		<div class="row">
			{!!Form::model($encabezado, ['route'=>['lecciones.update', $encabezado->id]])!!}	
				<div class="form-group">
					{!!Form::label('Nombre de la lección: ')!!}
				<div class="form-group">
					{!!Form::text('nombreleccion', $encabezado->nombre ,['class'=>'form-control', 'id' => 'nombreleccion', 'required', 'placeholder' => 'Asigne un nombre a la lección actual ...'])!!}
					{!! Form::hidden('leccion_id', $encabezado->id, ['id' => 'leccion_id']) !!}
				</div>
			{!!Form::close()!!}		

			{!!Form::open()!!}	
				<div class="form-group">
					{!!Form::label('Seleccione categoria: ')!!}
				<div class="form-group">
					{!!Form::select('categorias', $categorias ,null,['class'=>'form-control', 'id' => 'categ', 'required', 'placeholder' => 'Seleccione ...'])!!}
				</div>
				</div>				
				<div class="form-group">
					<div class="form-group">
					{!!Form::label('Buscar palabra: ')!!}		
					</div>		
					<div class="row">	
						<div class="form-group col-md-10">	
							{!!Form::select('Nombre', [], null, ['class'=>'form-control','readonly','id'=>'name', 'required','placeholder' => 'Escriba la palabra a buscar'])!!}
						</div>	
						<div class="form-group col-md-2 align-right">	
							{!! Form::button('Agregar', array('class' => 'btn btn-primary', 'id'=>'agregarPalabra')) !!}
						</div>	
					</div>	
				</div>								 			
			{!!Form::close()!!}			
		</div>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			Palabras en la lección actual
		</h3>	
	</div>
	<div class="panel-body">
		<table id="palabrasAgregadas" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Leccion</th>		
					<th>Palabra</th>						
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				
			
			</tbody>
		</table>
	</div>
	<div class="panel-footer" style="text-align:right">
		{!! Form::button('Guardar', array('class' => 'btn btn-success', 'id'=>'guardar')) !!}
	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

$(function(){
	table[0] = $('#palabrasAgregadas').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('detallelecciongrid', ['id' => $encabezado->id])!!}",
			"type": "POST"
		},
		columns: [ {data: 'id'}, {data:'getleccion.nombre'}, {data:'getpalabra.palabra'}],
		"columnDefs": [
		{
			"targets": [0],
			"visible": false,
			"searchable": false
		},
		{
			"targets": [3],
			"data": null,
			"defaultContent":  "<button class='btn btn-danger' onclick='eliminarPalabra(event)'>Eliminar</button>" 
		}
		],
		"scrollX": true
	} );
});


function eliminarPalabra(event){
	var element = event.target;
	$.msgbox("Esta seguro que desea elimnar este modulo", { type: 'confirm' }, function(result){
		if(result == 'Aceptar')
		{
			var data = table[0].row( $(element).parents('tr') ).data();
			$.post("{{route('eliminardetlecciongrid')}}",{'id':data.id},function(){
				table[0].ajax.reload();
			});
		}
	});
	
}

/*****************************************************************************************************************/
// Función que carga las palabras de una categoría seleccionada
/*****************************************************************************************************************/
$('#categ').on('change', function ( ) {
	var categoria = $('#categ').val();
	if(categoria){		
		$('#name').attr('readonly',false);
		$.post("{!!route('lecciones.categorias')!!}",{"id_categoria": categoria}, function(result){
			var data;		
			data = $.map(result, function (result) {
                    return {
                        text: result.palabra,
                        id: result.id
                    }
                });			
				$('#name').empty();
			 	$('#name').select2({
				 	data: data,
				 	language: "es",
				});
		});
	}		
	else
		$('#name').	attr('readonly',true);
});


/*****************************************************************************************************************/
// Función que agrega las palabras de manera temporal a la tabla de leccion
/*****************************************************************************************************************/
/*var palabras = [];
$('#guardar').attr('disabled',true);*/

$('#agregarPalabra').on('click', function () {
	var t = $('#palabrasAgregadas').DataTable();    
	var esta;
	var validator = $("form").kendoValidator().data("kendoValidator");
                    if (validator.validate()) {                         	
						//esta = buscarpalabra($('#name').val() , $('#leccion_id').val());	
						$.ajax({
								type : "POST",
								url : "{{route('leccionesDet.buscarpalabra')}}",
								async: true,
								data: {"leccion_id": $('#leccion_id').val(), "palabra_id": $('#name').val()},
								success: function(respuesta){
									if(respuesta > 0){							
										alert(1);
										
									}
									else{
										
										$.msgbox("La palabra " + $('#name option:selected').text() + " ya se encuentra en la lección actual.", { type: 'error' });		
									}		
								}	
						});		
				}	
});

function agregarpalabras(t){	
	t.row.add( [
		$('#name').val(),
		$('#name option:selected').text(),
		null
	] ).draw( false );   
palabras.push( $('#name').val());  
}

/*****************************************************************************************************************/
// Función que guarda la lección en la base de datos
/*****************************************************************************************************************/

/*$('#guardar').on('click', function () {

$.ajax({
			type : "POST",
			url : "{!!route('lecciones.store')!!}",
			async: false,
			data: {"nombre": $('#nombreleccion').val(), "usuario_documento": "86074808"},
			success: function(respuesta){
				if(respuesta.id > 0){
				var dataenvio = [];
				var aux = [];
				
				for(i=0; i< palabras.length; i++){
						aux[i] = {"palabra_id": palabras[i],"leccion_id": respuesta.id};
						dataenvio.push(aux[i]);
				}				
				$.post("{!!route('lecciones.guardardetalle')!!}",{"datos": dataenvio}, function(result){ 					
					if(result.status == 0){
						$.msgbox("Se registró la lección de manera exitosa.",{type:'success'},function (){
							window.location = "{!!route('lecciones.index')!!}";
						});
						
					}
						
					else
						$.msgbox("Se presentó un error durante el registro.",{type:'error'});
				});

				}
				else{
					$.msgbox("La lección con nombre " + $('#nombreleccion').val() + " ya se encuentra registrada. Asigne un nombre diferente.",{type:'error'});
				}
				
			}
		});
});*/



</script>

@endsection