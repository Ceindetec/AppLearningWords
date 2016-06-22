<div class="panel panel-default">
    <div class="panel-heading"> Datos requeridos </div>
                  
    <div class="panel-body">
        <div class="form-group">
        	{!! Form::label('nombre', 'Nombre de la Institución') !!}
        	{!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ej. Ceindetec']) !!}
    	</div>
    	<div class="form-group">
    		{!! Form::label('nit', 'NIT de la institución') !!}
    		{!! Form::text('nit', null, ['class'=>'form-control', 'placeholder'=>'Ej. 90210312']) !!}
    	</div>
    	<div class="form-group">
        	{!! Form::label('cantidad_licencias', 'Cantidad de licencias') !!}
        	{!! Form::text('cantidad_licencias', null, ['class'=>'form-control']) !!}
    	</div>
    </div>
</div>