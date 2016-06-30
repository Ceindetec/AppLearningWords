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
		{!!Form::model($encabezado, ['route'=>['lecciones.update', $encabezado->id]])!!}
			<div class="form-group">
				{!!Form::label('Nombre de la lección: ')!!}
				{!!Form::text('nombreleccion', $encabezado->nombre ,['class'=>'form-control', 'id' => 'nombreleccion', 'required', 'placeholder' => 'Asigne un nombre a la lección actual ...'])!!}
				{!! Form::hidden('leccion_id', $encabezado->id, ['id' => 'leccion_id']) !!}
			</div>
		{!!Form::close()!!}

		{!!Form::open()!!}
			<div class="form-group">
				{!!Form::label('Seleccione categoria: ')!!}
				{!!Form::select('categorias', $categorias ,null,['class'=>'form-control', 'id' => 'categ', 'required', 'placeholder' => 'Seleccione ...'])!!}
			</div>
			<div class="form-group">
				{!!Form::label('Buscar palabra: ')!!}
					<div class="row">
						<div class="col-sm-10">
							{!!Form::select('Nombre', [], null, ['class'=>'form-control','readonly','id'=>'name', 'required','placeholder' => 'Escriba la palabra a buscar'])!!}
						</div>	
						<div class="col-sm-2 text-center">
							{!! Form::button('Agregar', array('class' => 'btn btn-primary', 'id'=>'agregarPalabra')) !!}
						</div>	
					</div>
			</div>
		{!!Form::close()!!}
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
					<th>Palabra</th>
					<th>Traduccion</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				
			
			</tbody>
		</table>
	</div>
	<div class="panel-footer" style="text-align:right">
		{!! Form::button('Guardar', array('class' => 'btn btn-success', 'id'=>'guardar')) !!}
		{!! Form::button('Cancelar', array('class' => 'btn btn-success', 'id'=>'cancelar')) !!}
	</div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">

/** Variable global que contiene el id de la lección **/
var nombre_leccion = $('#nombreleccion').val();

/*****************************************************************************************************************/
// Función que construye el data table de los detalles de la lección.
/*****************************************************************************************************************/
$(function(){
	table[0] = $('#palabrasAgregadas').DataTable( {
		"language": {
			"url": "{!!route('espanol')!!}"
		},
		ajax: {
			url: "{!!route('detallelecciongrid', ['id' => $encabezado->id])!!}",
			"type": "POST"
		},
		columns: [ {data: 'id'}, {data:'getpalabra.palabra'}, {data:'getpalabra.get_traduccion.traduccion'}],
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

/*****************************************************************************************************************/
// Función que elimina de base de datos las palabras de la lección que se está editando.
/*****************************************************************************************************************/

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
		/** Obtiene las palabras asociadas a la categoria seleccionada **/
		$.post("{!!route('lecciones.categorias')!!}",{"id_categoria": categoria}, function(result){
			var datos;	
			var i = -1;	
			datos = $.map(result, function () {	
			i++;			
            return { text: result[i].getpalabra.palabra, id: result[i].getpalabra.id }  
               		});			
			/** Agrega los datos al select2 **/
				$('#name').empty();
			 	$('#name').select2({
				 	data: datos,
				 	language: "es",
				});
		});
	}		
	else
		$('#name').	attr('readonly',true);
});


/*****************************************************************************************************************/
// Función que agrega las palabras de la lección a la base de datos 
/*****************************************************************************************************************/

$('#agregarPalabra').on('click', function () {
	var t = $('#palabrasAgregadas').DataTable();    
	var esta;
	var validator = $("form").kendoValidator().data("kendoValidator");
                    if (validator.validate()) {                        	
						/** Verifica que la palabra a agregar no se encuentre en la lección para evitar duplicidad **/
						$.ajax({
								type : "POST",
								url : "{{route('leccionesDet.buscarpalabra')}}",
								async: true,
								data: {"leccion_id": $('#leccion_id').val(), "palabra_id": $('#name').val()},
								success: function(respuesta){
									/** Si el conteo es mayor de cero, la palabra ya fue agredada e impide su registro**/
									if(respuesta > 0){							
										$.msgbox("La palabra " + $('#name option:selected').text() + " ya se encuentra en la lección actual.", { type: 'error' });												
									}
									/** Si el conteo es menor que cero, registra la palabra en base de datos a la lección actual **/
									else{
										console.log("leccion_id: ", $('#leccion_id').val());
										console.log("palabra_id: ", $('#name').val());
										$.ajax({
											type : "POST",
											url : "{!!route('leccionesdet.store')!!}",
											async: true,
											data: {"leccion_id": $('#leccion_id').val(), "palabra_id": $('#name').val()},
											success: function(respuesta){
													table[0].ajax.reload();
											}
										});										
									}		
								}	
						});		
				}	
});

/*****************************************************************************************************************/
// Función que actualiza el nombre de la lección
/*****************************************************************************************************************/

$('#guardar').on('click', function () {

	if($('#nombreleccion').val() != nombre_leccion){
		$.ajax({
			type : "PUT",
			url : "{!!route('lecciones.update', $encabezado->id)!!}",
			async: true,
			data: {"nombre": $('#nombreleccion').val(), "usuario_documento": "{{\Auth::user()->documento}}"},
			success: function(respuesta){
				if (respuesta == 0){
						$.msgbox("Se actualizó la lección de manera exitosa.",{type:'success'},function (){
							window.location = "{!!route('lecciones.index')!!}";
						});
				}
				else{
						$.msgbox("El nombre de la lección ya se encuentra registrado.",{type:'error'});
				}
			}
		});
	}
	else{
		$.msgbox("Se actualizó la lección de manera exitosa.",{type:'success'},function (){
							window.location = "{!!route('lecciones.index')!!}";
						});
	}
});



$('#cancelar').on('click', function () {
	window.location="{!!route('lecciones.index')!!}";
});
</script>

@endsection