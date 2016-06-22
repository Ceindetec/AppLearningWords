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
		<h3>Actividad de repaso uno</h3>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			Escribe el numero de la traducción frente a cada palabra en español.
		</h3>		
		
	</div>
	<div class="panel-body" >
		{!!Form::open()!!}	
	<?php $i = 0;
	
		$repuestas = array(); 
	?>
		{!! Form::hidden('palabrasEsp', json_encode($palabrasEspDet), ['id' => 'palabrasEsp']) !!}
		{!! Form::hidden('palabrasEsp', json_encode($listaTraducciones), ['id' => 'traducciones']) !!}
		{!! Form::hidden('trad', json_encode($traduccionesMostrar), ['id' => 'trad']) !!}
	
	@foreach($palabrasEspDet as $valor)
		 
		 <div class="row">
			<div class ="col-md-3 col-md-offset-2" style="text-align:right"	>
				@if($valor->getpalabra)
					{!!Form::label($valor->getpalabra->palabra)!!}
					{!! Form::hidden('palabra'.$i,$i, ['id' => 'palabra'.$i]) !!}
				@endif
			</div>
			<div class ="col-md-2">
				{!!Form::text('La respuesta '.$i, null ,['class'=>'form-control', 'id' => 'respuesta'.$i, 'required'])!!}
			</div>	
			<div class ="col-md-offset-1 col-md-3">
				{!!Form::label($i.".")!!}				
				{!!Form::label($traduccionesMostrar[$i])!!} 
			</div>			
		</div>		
		</br>
		<?php 
			$i++;
			$count++;
		?>
		@endforeach
		{!!Form::close()!!}	
	</div>
	<div class="panel-footer">		
		{!! Form::button('Siguiente >>', array('class' => 'btn btn-success', 'id'=>'siguiente')) !!}
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	/*palabras = $('#palabrasEsp').val();
	palabrasJson = JSON.parse(palabras);*/

	traduccion = $('#traducciones').val();
	traduccionJson = JSON.parse(traduccion);
	console.log(traduccionJson);
	
	//console.log("traducciones: ",$('#traducciones').val());
	//console.log("mostrar: ",$('#trad').val());
	mostrarTrad = $('#trad').val();
	trad = JSON.parse(mostrarTrad);
	console.log("vector",trad)

$('#siguiente').on('click', function ( ) {
	var validator = $("form").kendoValidator().data("kendoValidator");
                    if (validator.validate()) { 
                    	
                    	for(i=0;i<trad.length;i++){
                    		respuesta = traduccionJson[$('#respuesta'+i).val()];
                    		console.log("respuesta"+i,respuesta);
							console.log("trad"+i,trad[i]);
                    		/*if(respuesta == trad[i]){
								console.log("respuesta"+i,respuesta);
								console.log("trad"+i,trad[i]);
                    		}*/
                    	}
						//console.log($('#respuesta'+i).val());
						
                    }
	
});
	
	
</script>
@endsection