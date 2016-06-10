@extends('layouts.admin.principal')

@section('content')
    
<div class="panel panel-primary">
<div class="panel-heading">
 	 	Titulo del panel
 	 </div>
 	 <div class="panel-body">
 	 	<p>Cuepor del panel</p>
 	 	<a href="../main/modaltest" class="btn btn-primary" data-modal="">Test modal pequeño</a>
 	 	<a href="../main/modaltest" class="btn btn-primary" data-modal="modal-lg">Test modal grande</a>

 	 	<a href="../main/modalformulario" class="btn btn-primary" data-modal="">Test modal formulario</a>
 	 	
 	 </div>
  	 <div class="panel-footer">
  	 	el footer del panel
  	 </div>
</div>

@endsection