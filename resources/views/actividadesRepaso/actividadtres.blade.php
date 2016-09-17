@extends('layouts.admin.principal')

@section('css')
	{!!Html::style('css/jquery-ui-1.11.4/jquery-ui.css')!!}

	<style>
		td, th {
			text-align: center;
		}
		.draggable {
			width: {{$maxCntCarPalabraTra*12}}px;
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

		.respuestas{
			border-radius: 5px;
			border: solid #888888 2px;
			height: 30px;
			background: #f2f2f2;
		}
		.borde-error{
			border: solid #a94442 2px;
		}

		.borde-correcto{
			border: solid #3c763d 2px;
		}

		.noarrastable{
			width: {{$maxCntCarPalabraTra*15}}px;
			color: #ffffff;
			padding: 3px 10px;
			border-radius: 5px;
			background: #3d7193;
		}

	</style>
@endsection

@section('content')
	<div class="page-title">
		<div class="title_left">
			<h3>Activity 3</h3>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				Drag the correct translation to its word in spanish..
			</h3>

		</div>
		<div class="panel-body " >
			{!!Form::open()!!}
			<?php $i = 0;

			$repuestas = array();
			?>
			{{--	{!! Form::hidden('palabrasEsp', json_encode($palabrasEspDet), ['id' => 'palabrasEsp']) !!}
                    {!! Form::hidden('palabrasEsp', json_encode($listaTraducciones), ['id' => 'traducciones']) !!}
                    {!! Form::hidden('trad', json_encode($traduccionesMostrar), ['id' => 'trad']) !!}--}}

			@foreach($palabrasEspDet as $valor)

				<div  class="row padre">
					<div class ="  col-xs-4 col-sm-2  col-md-3 " style="text-align:right"	>
						@if($valor->getpalabra)
							{!!Form::label(null,$valor->getpalabra->palabra,["class"=>"noarrastable text-center"])!!}
							{{--{!! Form::hidden('palabra'.$i,$i, ['id' => 'palabra'.$i]) !!}--}}
						@endif
					</div>
					<div class ="col-xs-8 col-sm-3 col-md-2">

						{{--<div class="row">--}}
						<div id="respuesta{{$i}}" class="form-control respuestas droppable" ></div>

					</div>
					<div id="grupo{{$i}}" class ="col-xs-12 col-sm-7 col-md-7 ">

						@foreach($traduccionesMostrar[$valor->palabra_id] as  $index => $mostrar)



						{!!Form::label(null,$mostrar,['id'=>"label".$i."".$index,'class'=>'draggable text-center','data-grupo'=>$i])!!}


						@endforeach

					{{--</div>--}}
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
					{!! Form::button('Menu de Actividades', array('class' => 'btn btn-success pull-right', 'id'=>'regresar')) !!}
				</div>
			</div>

		</div>

	</div>

@endsection

@section('scripts')

	{!!Html::script('js/jquery-ui-1.11.4/jquery-ui.js')!!}
	{{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}

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


/*			$( ".draggable" ).draggable({
				//revert: true,
				helper:'clone',
				cursor: "crosshair",
				axis: "x",
				containment: $('.draggable').parent().parent(),
				stop: function( event, ui ) {
 $(".draggable").each(function(){
 $(this).removeClass("draggableEnUso");
 });


 $(".respuestas").each(function(index, obj) {
 if($(this).data("label")!="")
 //console.log($(this).data("label"));
 $("#"+$(this).data("label")).addClass("draggableEnUso");
 });
				}
			});*/



			$('.draggable').each(function(){
				$(this).draggable({
					helper:'clone',
					cursor: "crosshair",
					containment: $(this).parent().parent(),
					stop: function( event, ui ) {
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
			});



			$( ".droppable" ).droppable({
				drop: function(event, ui) {
					//dataIndex = ui.draggable.index()
					//console.log(ui.draggable.index());
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
		//console.log(traduccionesJsonMos);
		//console.log(traduccionesJsonMos[0]);


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

/*			$(".respuestas").each(function(){
				$("#respuesta"+i).addClass("borde-error");
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
					data: {'id_leccion':'{{$idleccion}}','id_actividad':3},
					success: function (data) {
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

	</script>
@endsection