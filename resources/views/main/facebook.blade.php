@extends('layouts.admin.principal')

@section('content')

    
<div class="panel panel-primary">
<div class="panel-heading">
 	 	Titulo del panel
 	 </div>
 	 <div class="panel-body">
 	 	<p><img src='{{$user->avatar}}'/></p>
 	 	<p>{{$user->name}}</p>
 	
 	 	
 	 </div>

</div>

@endsection

