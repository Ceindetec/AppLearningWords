<div id="crearPalabra">
    {!!Form::model(null, array('route' => array('insertPalabra')))!!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4> Crear palabra</h4>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('Palabra Español (*)')!!}</div>
            <div class="col-xs-12">{!!Form::text('palabra',null,['class'=>'form-control', 'required'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('Traduccion (*)')!!}</div>
            <div class="col-xs-12">{!!Form::text('traduccion',null,['class'=>'form-control', 'required'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('categoria', 'Categoria',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">
                {!!Form::select('categoria', $arrayCategorias ,null ,['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="form-group row" id="padreCheck">
            <div class="col-xs-12">{!!Form::label('tipo', 'Tipo',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">
                {!!Form::select('tipo', $arrayTipos ,null ,['class'=>'form-control'])!!}
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--{!!Form::label('Traduccion (*)')!!}--}}
            {{--{!!Form::text('traduccion',null,['class'=>'form-control', 'required'])!!}--}}
        {{--</div>--}}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-success" value="Guardar">
    </div>
</div>
{!!Form::close()!!}



<script type="text/javascript">
    var modal = $('#crearPalabra');

    $(function(){
        //validarFormulario();// validar forularios con kendo
        EventoFormularioModal(modal, onSuccess)

        $("#categoria").change(function(){
            $("#newCat").remove();
            if ($("#categoria").val() == "otro"){
                $("#categoria").parent().after("<div class='col-xs-6' id='newCat'> <input  type='text' class='form-control' name='newCategoria' required autofocus> </div>");
            }
        });

        $("#tipo").change(function(){
            $("#divCheck").remove();
            $("#divTiempos").remove();
            if ($("#tipo option:selected").text() == "Verbo"){
                $("#tipo").parent().after("<div class='col-xs-6 text-center' id='divCheck'><input type='checkbox' name='checkTiempos' id='checkTiempos' value='seleccionado'> ¿Agregar tiempos verbales?</div>");
            }
        });
    });

    $("#padreCheck").on('change', '#checkTiempos', function(){
        $("#divTiempos").remove();
        if ($(this).prop('checked')){
            $("#padreCheck").after("<div class='panel panel-default' id='divTiempos'>" +
                                        "<div class='panel-heading'>Tiempos Verbales</div>" +
                                        "<div class='panel-body'>"+
                                            "<div class='form-group row'>"+
                                            "<div class='col-xs-2 text-center'><label for='prEspañol'>Presente</label></div>" +
                                            "<div class='col-xs-4 text-center'><input type='text' class='form-control' name='prEspañol' required></div>" +
                                            "<div class='col-xs-2 text-center'><label for='prIngles'>Traduccion</label></div>" +
                                            "<div class='col-xs-4 text-center'><input type='text' class='form-control' name='prIngles' required></div>" +
                                            "</div>" +
                                            "<div class='form-group row'>"+
                                            "<div class='col-xs-2 text-center'><label for='paEspañol'>Pasado</label></div>" +
                                            "<div class='col-xs-4 text-center'><input type='text' class='form-control' name='paEspañol' required></div>" +
                                            "<div class='col-xs-2 text-center'><label for='paIngles'>Traduccion</label></div>" +
                                            "<div class='col-xs-4 text-center'><input type='text' class='form-control' name='paIngles' required></div>" +
                                            "</div>" +
                                            "<div class='form-group row'>"+
                                            "<div class='col-xs-2 text-center'><label for='fuEspañol'>Futuro</label></div>" +
                                            "<div class='col-xs-4 text-center'><input type='text' class='form-control' name='fuEspañol' required></div>" +
                                            "<div class='col-xs-2 text-center'><label for='fuIngles'>Traduccion</label></div>" +
                                            "<div class='col-xs-4 text-center'><input type='text' class='form-control' name='fuIngles' required></div>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>");
        }
    });

    function validarFormulario(){
        /*metodo de kendo para validar los formulario*/
        $('form').kendoValidator();
    }
    function onSuccess(result) {
        result = JSON.parse(result)
        console.log(result);
        if(result.estado){
            $.msgbox(result.mensaje, { type: 'success' }, function(){
                modalBs.modal('hide');
                table[0].ajax.reload();
            });
        }
        else {
            $.msgbox(result.mensaje, { type: 'error' }, function(){
            });
        }
    }
</script>