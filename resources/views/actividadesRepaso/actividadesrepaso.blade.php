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

			<div class="col-lg-3 col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-hand-pointer-o fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								<i class="fa fa-question" aria-hidden="true"></i>

								<div>New Comments!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								<i class="fa fa-question" aria-hidden="true"></i>
								<div>New Comments!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-list-ul fa-5x" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9 text-right">
								<i class="fa fa-question" aria-hidden="true"></i>
								<div>New Comments!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			 <div class = 'form-group'>
				<div class = 'col-md-4' style="text-align:center">
					<button class='btn btn-primary button_x' onclick='actividaduno()'>Actividad uno</button>
				</div>
				<div class = 'col-md-4' style="text-align:center">
					<button class='btn btn-success button_x' onclick='actividaddos()'>Actividad dos</button>
				</div>
				<div class = 'col-md-4' style="text-align:center">
					<button class='btn btn-info button_x' onclick='actividadtres()'>Actividad tres</button>
				</div>
			</div>

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
}
function actividaddos(){
		window.location = "{{route("actividadDos",$idleccion)}}";
}

function actividadtres(){
		window.location = "{{route("actividadTres",$idleccion)}}";
}



</script>
@endsection