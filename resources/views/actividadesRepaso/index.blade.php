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
		<h3>Actividades de repaso</h3>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="form-group">
					{!!Form::label('Seleccione la lección: ')!!}
				<div class="form-group">
					{!!Form::select('lecciones', $listalecciones ,null,['class'=>'form-control', 'id' => 'lecciones', 'required', 'placeholder' => 'Seleccione ...'])!!}
				</div>	
		
		</div>
	</div>
	<div class="panel-body">
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
@endsection

@section('scripts')
<script type="text/javascript">

function actividaduno(){
	var leccion= $('#lecciones').val();
	if(leccion)		
		window.location = "actividaduno/" + leccion;
	else
		$.msgbox("Debe seleccionar una lección para repasar.",{type:'error'});
}
function actividaddos(){
	var leccion = $('#lecciones').val();
	if(leccion){
		window.location = "actividaddos/" + leccion;

	}
	else{
		$.msgbox("Debe seleccionar una lección para repasar.",{type:'error'});
	}

}

function actividadtres(){
	var leccion = $('#lecciones').val();
	if(leccion){
		window.location = "actividadtres/" + leccion;

	}
	else{
		$.msgbox("Debe seleccionar una lección para repasar.",{type:'error'});
	}

}



</script>
@endsection