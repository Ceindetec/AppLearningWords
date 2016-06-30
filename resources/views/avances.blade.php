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
            <h3>
                Informe de avances
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <b>Leccion: </b>{{$leccion[0]->nombre}}
            </h3>
        </div>

        <div class="panel-body">
            <table id="avances" class="table table-striped table-bordered no-footer" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Identificacion</th>
                        <th>Estudiante</th>
                        <th>Actividad 1</th>
                        <th>Actividad 2</th>
                        <th>Actividad 3</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="panel-footer" style="text-align:right">
            {!! Form::button('Regresar', array('class' => 'btn btn-success', 'id'=>'cancelar')) !!}
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">

        $(function(){

            table[0] = $('#avances').DataTable( {
                "language": {
                    "url": "{!!route('espanol')!!}"
                },
                ajax: {
                    url: "{!!route('getAvances', $leccion[0]->id)!!}",
                    "type": "get"
                },
                columns: [  { data: 'usuario_documento' },
                    { data: 'usuario'},
                    { data: '0'},
                    { data: '1'},
                    { data: '2'}
                ],
                "scrollX": true
            } );

        });

        $('#cancelar').on('click', function () {
            window.location="{!!route('lecciones.index')!!}";
        });
    </script>
@endsection