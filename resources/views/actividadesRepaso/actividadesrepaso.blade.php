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

	.pregunta{
		cursor: pointer;
	}

.activity{
	font-weight: bold;
}


@media (max-width: 768px) {
	.estado{
		font-size: 24px;
	}
	.activity{
		font-size: 32px;
	}
}
@media (min-width: 768px) and (max-width: 992px) {
	.estado{
		font-size: 34px;
	}
	.activity{
		font-size: 42px;
	}
}
@media (min-width: 992px) and (max-width: 1200px) {
	.estado{
		font-size: 44px;
	}
	.activity{
		font-size: 52px;
	}
}
@media (min-width: 1200px) {
	.estado{
		font-size: 48px;
	}
	.activity{
		font-size: 52px;
	}
}

.sizeEstado{
	font-size: 20px;
}

	.panel-activity:hover{
		box-shadow: 8px 8px 10px #888888;
	}


</style>
@endsection

@section('content')
<div class="page-title">
	<div class="title_left">
		{{--<h3>Lección a Repasar	</h3>--}}
	</div>
</div>

<div class="col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
<h3>{{$nombreleccion}}</h3>
		</div>
		<div class="panel-body">

			<div class="col-xs-12 col-md-offset-1 col-md-10">
			<div class="col-xs-12">
				<a href="#" onclick='actividaduno(); return false;'>
				<div class="panel panel-{{($actividad1=="Not started")?"danger":(($actividad1=="In progress")?"warning":"success")}} panel-activity">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								{{--<i class="fa fa-hand-pointer-o fa-5x" aria-hidden="true"></i>--}}
								<img src="..\Images\draganddrop-02.png" class="img-responsive" alt="Responsive image">
							</div>
							<div class="col-xs-9 text-right">
								{{--<i class="fa fa-question pregunta" aria-hidden="true"></i>--}}

								<div class="estado">Activity  <spam class="activity">1</spam></div>
							</div>
						</div>
					</div>

						<div class="panel-footer text-center">
							<span class="sizeEstado" >{{$actividad1}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
				</div>
				</a>
			</div>

				<div class="col-xs-12">
				<a href="#" onclick='actividaddos(); return false;'>
				<div class="panel panel-{{($actividad2=="Not started")?"danger":(($actividad2=="In progress")?"warning":"success")}} panel-activity">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								{{--<i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i>--}}
								<img src="..\Images\check-02.png" class="img-responsive" alt="Responsive image">
							</div>
							<div class="col-xs-9 text-right">
								{{--<i class="fa fa-question pregunta" aria-hidden="true"></i>--}}
								<div class="estado">Activity  <spam class="activity">2</spam></div>
							</div>
						</div>
					</div>
						<div class="panel-footer text-center">
							<span class="sizeEstado">{{$actividad2}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
				</div>
				</a>
			</div>

				<div class="col-xs-12">
				<a href="#" onclick='actividadtres(); return false;'>

					<div class="panel panel-{{($actividad3=="Not started")?"danger":(($actividad3=="In progress")?"warning":"success")}} panel-activity">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									{{--<i class="fa fa-list-ul fa-5x" aria-hidden="true"></i>--}}
									<img src="..\Images\list-02.png" class="img-responsive" alt="Responsive image">
								</div>
								<div class="col-xs-9 text-right">
									{{--<i class="fa fa-question pregunta" aria-hidden="true"></i>--}}
									<div class="estado">Activity  <spam class="activity">3</spam></div>
								</div>
							</div>
						</div>

							<div class="panel-footer text-center">
								<span class="sizeEstado" >{{$actividad3}}</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>

					</div>
				</a>
			</div>

			</div>


		</div>
{{--		<div class="panel-footer">
			{!! Form::button('Menu de Lecciones', array('class' => 'btn btn-success ', 'id'=>'menelecciones')) !!}
		</div>--}}
	</div>
</div>

	<div class="col-sm-6">
		<img src="..\Images\modelo1.png" class="img-responsive hidden-xs hidden-sm  hidden-md" alt="Responsive image">
		<img src="..\Images\modelo2.png" class="img-responsive hidden-xs hidden-lg" alt="Responsive image">
	</div>

@endsection

@section('scripts')
<script type="text/javascript">
var table;
	$(function(){
		$("#menuleccion").removeClass("hidden").addClass("show"); 
		$("#spanLeccion").text("{{$nombreleccion}}");
			sessionStorage.setItem('nombreLeccion', "{{$nombreleccion}}");

		$("#aLeccion").attr("href","{{route("actividadesRepaso",$idleccion)}}");
			sessionStorage.setItem('hrefaLeccion', "{{route("actividadesRepaso",$idleccion)}}");
		$("#aActividad1").attr("href","{{route("actividadUno",$idleccion)}}");
			sessionStorage.setItem('hrefaActividad1', "{{route("actividadUno",$idleccion)}}");
		$("#aActividad2").attr("href","{{route("actividadDos",$idleccion)}}");
			sessionStorage.setItem('hrefaActividad2', "{{route("actividadDos",$idleccion)}}");
		$("#aActividad3").attr("href","{{route("actividadTres",$idleccion)}}");
			sessionStorage.setItem('hrefaActividad3', "{{route("actividadTres",$idleccion)}}");

	});

function actividaduno(){
		window.location = "{{route("actividadUno",$idleccion)}}";
	return false;
}
function actividaddos(){
		window.location = "{{route("actividadDos",$idleccion)}}";
	return false;
}

function actividadtres(){
		window.location = "{{route("actividadTres",$idleccion)}}";
	return false;
}

	$("#menelecciones").on("click", function(){
		window.location = "{{route("actividadesRepaso.index")}}";
	});


</script>
@endsection