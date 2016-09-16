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
.estado{
	font-size: 24px;
}

	.pregunta{
		cursor: pointer;
	}

.activity{
	font-weight: bold;
	font-size: 34px;
}

</style>
@endsection

@section('content')
<div class="page-title">
	<div class="title_left">
		{{--<h3>Lección a Repasar	</h3>--}}
	</div>
</div>

<div class="col-sm-10 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
<h3>{{$nombreleccion}}</h3>
		</div>
		<div class="panel-body">

			<div class="col-xs-12 col-md-offset-1">
			<div class="col-lg-3 col-md-6">
				<a href="#" onclick='actividaduno(); return false;'>
				<div class="panel panel-{{($actividad1=="Not started")?"danger":(($actividad1=="In progress")?"warning":"success")}}">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-hand-pointer-o fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								{{--<i class="fa fa-question pregunta" aria-hidden="true"></i>--}}

								<div class="estado">Activity  <spam class="activity">1</spam></div>
							</div>
						</div>
					</div>

						<div class="panel-footer">
							<span class="pull-left">{{$actividad1}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
				</div>
				</a>
			</div>

			<div class="col-lg-3 col-md-6">
				<a href="#" onclick='actividaddos(); return false;'>
				<div class="panel panel-{{($actividad2=="Not started")?"danger":(($actividad2=="In progress")?"warning":"success")}}">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								{{--<i class="fa fa-question pregunta" aria-hidden="true"></i>--}}
								<div class="estado">Activity  <spam class="activity">2</spam></div>
							</div>
						</div>
					</div>
						<div class="panel-footer">
							<span class="pull-left">{{$actividad2}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
				</div>
				</a>
			</div>

			<div class="col-lg-3 col-md-6">
				<a href="#" onclick='actividadtres(); return false;'>

					<div class="panel panel-{{($actividad3=="Not started")?"danger":(($actividad3=="In progress")?"warning":"success")}}">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-list-ul fa-5x" aria-hidden="true"></i>
								</div>
								<div class="col-xs-9 text-right">
									{{--<i class="fa fa-question pregunta" aria-hidden="true"></i>--}}
									<div class="estado">Activity  <spam class="activity">3</spam></div>
								</div>
							</div>
						</div>

							<div class="panel-footer">
								<span class="pull-left">{{$actividad3}}</span>
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
@endsection

@section('scripts')
<script type="text/javascript">
var table;
	$(function(){
		$("#menuleccion").removeClass("hidden").addClass("show");
		$("#spanLeccion").text("{{$nombreleccion}}");
		$("#aLeccion").attr("href","{{route("actividadesRepaso",$idleccion)}}");
		$("#aActividad1").attr("href","{{route("actividadUno",$idleccion)}}");
		$("#aActividad2").attr("href","{{route("actividadDos",$idleccion)}}");
		$("#aActividad3").attr("href","{{route("actividadTres",$idleccion)}}");

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