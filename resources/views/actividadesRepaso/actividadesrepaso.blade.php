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

</style>
@endsection

@section('content')
<div class="page-title">
	<div class="title_left">
		<h3>Lección a Repasar	</h3>
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
				@if($actividad1=="No iniciada")
					<div class="panel panel-danger">
						@elseif($actividad1=="En progreso")
							<div class="panel panel-warning">
								@else
									<div class="panel panel-success">
										@endif
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-hand-pointer-o fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								<i class="fa fa-question pregunta" aria-hidden="true"></i>

								<div class="estado">Actividad Uno</div>
							</div>
						</div>
					</div>
					<a href="#" onclick='actividaduno(); return false;'>
						<div class="panel-footer">
							<span class="pull-left">{{$actividad1}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				@if($actividad2=="No iniciada")
					<div class="panel panel-danger">
				@elseif($actividad2=="En progreso")
					<div class="panel panel-warning">
				@else
					<div class="panel panel-success">
				@endif
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								<i class="fa fa-question pregunta" aria-hidden="true"></i>
								<div class="estado">Actividad Dos</div>
							</div>
						</div>
					</div>
					<a href="#" onclick='actividaddos(); return false;'>
						<div class="panel-footer">
							<span class="pull-left">{{$actividad2}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				@if($actividad3=="No iniciada")
					<div class="panel panel-danger">
						@elseif($actividad3=="En progreso")
							<div class="panel panel-warning">
								@else
									<div class="panel panel-success">
										@endif
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-list-ul fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								<i class="fa fa-question pregunta" aria-hidden="true"></i>
								<div class="estado">Actividad Tres</div>
							</div>
						</div>
					</div>
					<a href="#" onclick='actividadtres(); return false;'>
						<div class="panel-footer">
							<span class="pull-left">{{$actividad3}}</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			</div>


		</div>
		<div class="panel-footer">
			{!! Form::button('Menu de Lecciones', array('class' => 'btn btn-success ', 'id'=>'menelecciones')) !!}
		</div>

	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
var table;
	$(function(){


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