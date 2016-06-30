@extends('layouts.admin.principal')

@section('css')
	{!!Html::style('css/jquery-ui-1.11.4/jquery-ui.css')!!}

	<style>
		td, th {
			text-align: center;
		}

		.respuestas{
			border-radius: 5px;
			border: solid 2px;
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
				Escribe la traducción correspondiente a la palabra.
			</h3>

		</div>
		<div class="panel-body padre" >
			{!!Form::open()!!}
			<?php $i = 0;

			?>
			@foreach($palabrasEspDet as $valor)


			@endforeach


			@foreach($listaTraducciones as $valor)
				<div  class="row">
					<div class ="col-md-3 col-md-offset-2" style="text-align:right"	>
						@if($valor)
							{!!Form::label($valor)!!}
							{{--{!! Form::hidden('palabra'.$i,$i, ['id' => 'palabra'.$i]) !!}--}}
						@endif
					</div>
					<div class ="col-md-2">
						<div class="form-group has-feedback">
							{!!Form::text('La respuesta '.$i, null ,['class'=>'form-control respuestas', 'id' => 'respuesta'.$i, 'required'])!!}
							<span class="glyphicon  form-control-feedback " aria-hidden="true"></span>
						</div>


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

		var palabrasEsp = '{!! json_encode($palabrasEspDet) !!}';

		//console.log(JSON.parse(palabrasEsp));
		var palabrasJsonEsp = JSON.parse(palabrasEsp);
		//console.log(palabrasJsonEsp[0].getpalabra);
		//console.log("{{$i}}");

		var traducciones = '{!! json_encode($listaTraducciones) !!}';
		//console.log(JSON.parse(traducciones));
		var traduccionesJson = JSON.parse(traducciones);

		//console.log(traduccionesJson);


		var traduccionesmostrar = '{!! json_encode($traduccionesMostrar) !!}';
		var traduccionesJsonMos = JSON.parse(traduccionesmostrar);
		//console.log(traduccionesJsonMos);
		//console.log(traduccionesJsonMos[0]);

		$.each(palabrasJsonEsp,function(index, valor){
			console.log(valor.getpalabra.palabra);
		});
		/*	traduccion = $('#traducciones').val();
		 traduccionJson = JSON.parse(traduccion);
		 //console.log(traduccionJson);

		 //console.log("traducciones: ",$('#traducciones').val());
		 //console.log("mostrar: ",$('#trad').val());
		 mostrarTrad = $('#trad').val();
		 trad = JSON.parse(mostrarTrad);
		 //console.log("vector",trad)*/

		$(".respuestas").on('click', function ( ) {

			$(this).parent().removeClass("has-error");
			$(this).parent().removeClass("has-success");
			$(this).siblings().removeClass("glyphicon-ok");
			$(this).siblings().removeClass("glyphicon-remove");
		});


		$('#verificar').on('click', function ( ) {

			var i=0;
			var validar=true;
			$.each(palabrasJsonEsp,function(index, valor){

				console.log(valor.getpalabra.palabra.toLowerCase()+" -> " +$("#respuesta"+i).val().toLowerCase());

				if(valor.getpalabra.palabra.toLowerCase()==$("#respuesta"+i).val().toLowerCase()){

					$("#respuesta"+i).parent().addClass("has-success");
					$("#respuesta"+i).siblings().addClass("glyphicon-ok");
				}else{
					$("#respuesta"+i).parent().addClass("has-error");
					$("#respuesta"+i).siblings().addClass("glyphicon-remove");
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
			window.location = "../actividadtres/{{$leccion}}";
		});

	</script>
@endsection