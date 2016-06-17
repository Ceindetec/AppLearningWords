@extends('layouts.admin.principal')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Usuarios</div>
												
					<div class="panel-body">
						<p>
							<a class="btn btn-success" href="{{ route('usuarios.create') }}" role="button">
								Nuevo Usuario
							</a>
						</p>
						@include('administracion.usuarios.parciales.listaUsuarios') 						
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection