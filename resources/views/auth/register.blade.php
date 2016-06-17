@extends('templates.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombres</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nombres" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Apellidos</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="apellidos" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Documento</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="documento" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirmar Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Institución</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tipo</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection