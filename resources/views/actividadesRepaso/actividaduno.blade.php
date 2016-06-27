@extends('layouts.admin.principal')

@section('css')
	{!!Html::style('css/jquery-ui-1.11.4/jquery-ui.css')!!}

<style>
td, th {
	text-align: center;
}
.draggable {
	padding: 3px 10px;
	border-radius: 5px;
 cursor: pointer;
	background: #ccc;
	z-index: 100;
}

.respuestas{
	border-radius: 5px;
	border: solid #888888 2px;
	width: 200px;
	height: 30px;
	background: #f2f2f2;
}
.borde-error{
	border: solid #a94442 2px;
}

.borde-correcto{
	border: solid #3c763d 2px;
}



</style>
@endsection

@section('content')
<div class="page-title">
	<div class="title_left">
		<h3>Actividad de repaso uno</h3>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			Escribe el numero de la traducción frente a cada palabra en español.
		</h3>		
		
	</div>
	<div class="panel-body padre" >
		{!!Form::open()!!}	
	<?php $i = 0;

		$repuestas = array();
	?>
{{--	{!! Form::hidden('palabrasEsp', json_encode($palabrasEspDet), ['id' => 'palabrasEsp']) !!}
		{!! Form::hidden('palabrasEsp', json_encode($listaTraducciones), ['id' => 'traducciones']) !!}
		{!! Form::hidden('trad', json_encode($traduccionesMostrar), ['id' => 'trad']) !!}--}}

	@foreach($palabrasEspDet as $valor)
		 
		 <div  class="row">
			<div class ="col-md-3 col-md-offset-2" style="text-align:right"	>
				@if($valor->getpalabra)
					{!!Form::label($valor->getpalabra->palabra)!!}
					{{--{!! Form::hidden('palabra'.$i,$i, ['id' => 'palabra'.$i]) !!}--}}
				@endif
			</div>
			<div class ="col-md-2">

				<div id="respuesta{{$i}}" class=" form-control respuestas droppable" >


				</div>

			</div>	
			<div class ="col-md-offset-1 col-md-3 ">
				{!!Form::label(null,$traduccionesMostrar[$i],['class'=>'draggable'])!!}
			</div>			
		</div>		
		</br>
		<?php 
			$i++;
			//$count++;
		?>
		@endforeach

		{!!Form::close()!!}	
	</div>
	<div class="panel-footer">

		<div class="row">
			<div class="col-xs-6">
				{!! Form::button('Verificar', array('class' => 'btn btn-success', 'id'=>'verificar')) !!}
			</div>
			<div class="col-xs-6">
				{!! Form::button('Siguiente', array('class' => 'btn btn-success pull-right hidden', 'id'=>'siguiente')) !!}
				{!! Form::button('Menu de Actividades', array('class' => 'btn btn-success pull-right hidden', 'id'=>'regresar')) !!}
			</div>
		</div>

	</div>

</div>

@endsection

@section('scripts')

	{!!Html::script('js/jquery-ui-1.11.4/jquery-ui.js')!!}
	{{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}

<script type="text/javascript">

	$(function(){

		$(".respuestas").each(function(){
			$(this).empty();
		});

		$( ".draggable" ).draggable({
			//revert: true,
		helper:'clone',
			cursor: "crosshair",
			containment: "div.padre",
			stop: function( event, ui ) {

			}
		});

		$( ".droppable" ).droppable({
			drop: function(event, ui) {
				//dataIndex = ui.draggable.index()
					//console.log(ui.draggable.index());
				var contenido = ui.draggable[0].innerHTML;

				$(this).removeClass("borde-error");
				$(".respuestas").each(function(index, obj) {
					if(($(this).html())==ui.draggable[0].innerHTML){
						//$(this).html("");
						$(this).empty();
					}
					});
					$(this).html(ui.draggable[0].innerHTML);
					//$(this).droppable( "disable" );


			}

		});
	});





	/*palabras = $('#palabrasEsp').val();
	palabrasJson = JSON.parse(palabras);*/

	var palabrasEsp = '{!! json_encode($palabrasEspDet) !!}';

	//console.log(JSON.parse(palabrasEsp));
	var palabrasJsonEsp = JSON.parse(palabrasEsp);
	//console.log(palabrasJsonEsp[6]);
	//console.log("{{$i}}");


	var traducciones = '{!! json_encode($listaTraducciones) !!}';
	//console.log(JSON.parse(traducciones));
	var traduccionesJson = JSON.parse(traducciones);

	//console.log(traduccionesJson);


	var traduccionesmostrar = '{!! json_encode($traduccionesMostrar) !!}';
	var traduccionesJsonMos = JSON.parse(traduccionesmostrar);
	console.log(traduccionesJsonMos);
	console.log(traduccionesJsonMos[0]);


/*	traduccion = $('#traducciones').val();
	traduccionJson = JSON.parse(traduccion);
	//console.log(traduccionJson);

	//console.log("traducciones: ",$('#traducciones').val());
	//console.log("mostrar: ",$('#trad').val());
	mostrarTrad = $('#trad').val();
	trad = JSON.parse(mostrarTrad);
	//console.log("vector",trad)*/

$('#verificar').on('click', function ( ) {

	var i=0;
	var validar=true;

	$(".respuestas").each(function(){
		$("#respuesta"+i).addClass("borde-error");
	});

	$.each(traduccionesJson, function(index, obj) {
		//console.log($("#respuesta"+i).html());

		if(obj==$("#respuesta"+i).html()){
			$("#respuesta"+i).addClass("borde-correcto");
		}else{
			$("#respuesta"+i).addClass("borde-error");
			validar=false;
		}


		i++;
	});

	if(validar){



		/*Aqui va lo que se quiere que haga en la base de datos para guardar el progreso de la actividad*/



		$("#siguiente").removeClass("hidden").addClass("show");
		$("#regresar").removeClass("hidden").addClass("show");

	}
	
});

	$('#regresar').on('click', function ( ) {
		window.location = "../actividadesRepaso";
	});
	$('#siguiente').on('click', function ( ) {
		window.location = "../actividaddos/{{$leccion}}";
	});
</script>
@endsection