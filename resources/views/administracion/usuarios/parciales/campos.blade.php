<div class="panel panel-default">
    <div class="panel-heading"> Datos requeridos </div>
                  
    <div class="panel-body">
        <div class="form-group">
        	{!! Form::label('nombres', 'Nombre del Usuario') !!}
        	{!! Form::text('nombres', null, ['class'=>'form-control', 'placeholder'=>'Ej. Jesus Andres']) !!}
    	</div>
    	<div class="form-group">
    		{!! Form::label('apellidos', 'Apellidos del Usuario') !!}
    		{!! Form::text('apellidos', null, ['class'=>'form-control', 'placeholder'=>'Ej. Vargas Vanegas']) !!}
    	</div>
        <div class="form-group">
        	{!! Form::label('documento', 'Documento') !!}
        	{!! Form::text('documento', null, ['class'=>'form-control', 'placeholder'=>'Ej. 86000999']) !!}
    	</div>
    	<div class="form-group">
        	{!! Form::label('password', 'Contraseña') !!}
        	{!! Form::password('password', ['class'=>'form-control']) !!}
    	</div>
        @if(isset($usuarioAdmin))
        @if($usuarioAdmin->rol == 'superadmin')
        <div class="form-group">
            {!! Form::label('institucion_id', 'Institucion') !!}
            {!! Form::select('institucion_id', $instituciones, null, ['class'=>'form-control']) !!}
        </div>
        @elseif($usuarioAdmin->rol == 'administrador')
        <div class="form-group">
            {!! Form::hidden('institucion_id', $usuarioAdmin->institucion_id, ['class'=>'form-control']) !!}
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('rol', 'Tipo de cuenta') !!}
            @if($usuarioAdmin->rol == 'administrador')
            {!! Form::select('rol',['docente' => 'Docente', 'estudiante' => 'Estudiante', 'administrador' => 'Administrador'], 'docente',['class'=>'form-control']) !!}
            @elseif($usuarioAdmin->rol == 'superadmin')
            {!! Form::select('rol',['superadmin' => 'SuperAdmin', 'administrador' => 'Administrador'], 'administrador',['class'=>'form-control']) !!}
            @endif
        </div>
        @endif
    </div>
</div>