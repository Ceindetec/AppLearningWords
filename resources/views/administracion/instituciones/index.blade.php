@extends('layouts.admin.principal')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Listado de Instituciones</div>
												
					<div class="panel-body">
						<p>
							<a class="btn btn-success" href="{{ route('instituciones.create') }}" role="button">
								Nueva Institución
							</a>
						</p>
						@include('administracion.instituciones.parciales.listaInstituciones') 						
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection