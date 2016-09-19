@extends('layouts.admin.principal')

@section('css')
	{!!Html::style('css/jquery-ui-1.11.4/jquery-ui.css')!!}

<style>
td, th {
	text-align: center;
}
.draggable {
	width: {{$maxCntCarPalabraTra*15}}px;
	box-shadow: 5px 5px 5px #888888;
	color: #ffffff;
	padding: 3px 10px;
	border-radius: 5px;
 	cursor: pointer;
	background: #2a3f54;
	z-index: 100;
}

.draggableEnUso{
	background: #e8a710;
}

.noarrastable{
	width: {{$maxCntCarPalabraEsp*15}}px;
	color: #ffffff;
	padding: 3px 10px;
	border-radius: 5px;
	background: #3d7193;
}


.respuestas{
	border-radius: 5px;
	border: solid #888888 2px;
	/*width: 200px;*/
	height: 30px;
	background: #f2f2f2;
}
.borde-error{
	border: solid #a94442 2px;
}

.borde-correcto{
	border: solid #3c763d 2px;
}

.check{

}

</style>
@endsection

@section('content')
<div class="page-title">
	<div class="title_left">
		<h3>Activity 1</h3>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			Drag the correct translation to its word in spanish.
		</h3>		
		
	</div>
	<div class="panel-body padre" >
		{!!Form::open()!!}	
	<?php $i = 0;
	?>

	@foreach($palabrasEspDet as $valor)
		 
		 <div  class="row">
			<div class ="col-xs-3 col-md-offset-2" style="text-align:right"	>
				@if($valor->getpalabra)
					{!!Form::label(null,$valor->getpalabra->palabra,["class"=>"noarrastable text-center"])!!}
				@endif
			</div>
			<div class ="col-xs-2">

				<div id="respuesta{{$i}}" class=" form-control respuestas droppable" data-label="">

				</div>

			</div>	
			<div class ="col-md-2 ">
				{!!Form::label(null,$traduccionesMostrar[$i],['id'=>"label".$i,'class'=>'draggable text-center center-block'])!!}
			</div>			
		</div>		
		</br>
		<?php 
			$i++;
		?>
		@endforeach

		{!!Form::close()!!}	
	</div>
	<div class="panel-footer">

		<div class="row">
			<div class="col-xs-6">
				{!! Form::button('Verify !', array('class' => 'btn btn-success', 'id'=>'verificar')) !!}
			</div>
			<div class="col-xs-6">
				{!! Form::button('Next', array('class' => 'btn btn-success pull-right hidden', 'id'=>'siguiente')) !!}
				{!! Form::button('Activities menu', array('class' => 'btn btn-success pull-right ', 'id'=>'regresar')) !!}
			</div>
		</div>

	</div>

</div>

@endsection

@section('scripts')

	{!!Html::script('js/jquery-ui-1.11.4/jquery-ui.js')!!}

<script type="text/javascript">
	$("#menuleccion").removeClass("hidden").addClass("show");
	$("#spanLeccion").text(sessionStorage.getItem('nombreLeccion'));

	$("#aLeccion").attr("href",sessionStorage.getItem('hrefaLeccion'));
	$("#aActividad1").attr("href",sessionStorage.getItem('hrefaActividad1'));
	$("#aActividad2").attr("href",sessionStorage.getItem('hrefaActividad2'));
	$("#aActividad3").attr("href",sessionStorage.getItem('hrefaActividad3'));

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
//console.log("jumm");
				//$(this).addClass("draggableEnUso");


				$(".draggable").each(function(){
					$(this).removeClass("draggableEnUso");
				});


				$(".respuestas").each(function(index, obj) {
					if($(this).data("label")!="")
					//console.log($(this).data("label"));
							$("#"+$(this).data("label")).addClass("draggableEnUso");
				});
			}
		});

		$( ".droppable" ).droppable({
			drop: function(event, ui) {

				var contenido = ui.draggable[0].innerHTML;

				$(this).removeClass("borde-error");

				$(this).empty();

				$(".respuestas").each(function(index, obj) {
					//console.log($(this).children("span").html());
					if(($(this).children("span").html())==ui.draggable[0].innerHTML){
						//$(this).html("");
						$(this).empty();
						$(this).data("label","");
					}
					});
					$(this).append("<span>"+ui.draggable[0].innerHTML+"</span>");

					$(this).data("label",$(ui.draggable[0]).attr("id"));
					//$(this).droppable( "disable" );


			}

		});
	});


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
	//console.log(traduccionesJsonMos);
	//console.log(traduccionesJsonMos[0]);


$('#verificar').on('click', function ( ) {

	var i=0;
	var validar=true;

/*	$(".respuestas").each(function(index, obj){
		//console.log(obj);
		$(obj).children("i").remove();
	});*/

	$.each(traduccionesJson, function(index, obj) {
		//console.log($("#respuesta"+i).html());

		if(obj==$("#respuesta"+i).children("span").html()){
			$("#respuesta"+i).addClass("borde-correcto");
			$("#respuesta"+i).children("i").remove();
			$("#respuesta"+i).append("<i class='fa fa-check pull-right' aria-hidden='true' style='color: #3a8039;'></i>");
		}else{
			$("#respuesta"+i).addClass("borde-error");
			$("#respuesta"+i).children("i").remove();
			$("#respuesta"+i).append("<i class='fa fa-times pull-right' aria-hidden='true' style='color: #a94442'></i>");
			validar=false;
		}


		i++;
	});

	if(validar){
		/*Aqui va lo que se quiere que haga en la base de datos para guardar el progreso de la actividad*/
		$.ajax({
			type: "POST",
			context: document.body,
			url: '{{route('actividadFinalizada')}}',
			data: {'id_leccion':'{{$idleccion}}','id_actividad':1},
			success: function (data) {
				$("#siguiente").removeClass("hidden").addClass("show");
				$("#regresar").removeClass("hidden").addClass("show");
			},
			error: function () {
				console.log('error en la concexción');
			}
		});

	}
	
});

	$('#regresar').on('click', function ( ) {
		window.location = "{{route("actividadesRepaso",$leccion)}}";
	});
	$('#siguiente').on('click', function ( ) {
		window.location = "{{route("actividadDos",$leccion)}}";
	});
</script>
@endsection