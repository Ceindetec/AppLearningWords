<div id="crearPalabra">
    {!!Form::model(null, array('route' => array('insertPalabra')))!!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4> Crear palabra</h4>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('palabra', 'Palabra Español (*)')!!}</div>
            <div class="col-xs-12">{!!Form::text('palabra',null,['class'=>'form-control', 'required'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('traduccion', 'Traduccion (*)')!!}</div>
            <div class="col-xs-12">{!!Form::text('traduccion',null,['class'=>'form-control', 'required'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">{!!Form::label('categoria', 'Categoria',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">{!!Form::label('newCategoria', 'Nueva',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">
                {!!Form::select('categoria[]', $arrayCategorias ,null ,['class'=>'form-control select2_multiple','style'=>'width:100%;',  'multiple'=>'multiple', 'id'=>'categoria', 'required'])!!}
            </div>
            <div class="col-xs-4">{!!Form::text('newCategoria',null,['class'=>'form-control', 'id'=>'newCategoria'])!!}</div>
            <div class="col-xs-2 text-center">
                <button type="button" class="btn btn-primary" onclick="nuevaCat()"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="form-group row" id="padreCheck">
            <div class="col-xs-12">{!!Form::label('tipo', 'Tipo',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">
                {!!Form::select('tipo', $arrayTipos ,null ,['class'=>'form-control'])!!}
            </div>
        </div>
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
        EventoFormularioModal(modal, onSuccess);

        $("#categoria").select2({
            maximumSelectionLength: 5,
            placeholder: "Min 1, Max 5..",
            allowClear: true
        });

        $("#tipo").change(function(){
            $("#divCheck").remove();
            $("#divTiempos").remove();
            if ($("#tipo option:selected").text() == "Verbo"){
                $("#tipo").parent().after("<div class='col-xs-6 text-center' id='divCheck'><input type='checkbox' name='checkTiempos' id='checkTiempos' value='seleccionado'> ¿Agregar tiempos verbales?</div>");
            }
        });
    });

    function nuevaCat(){
        if ($("#newCategoria").val() != ""){
            var nombre = $("#newCategoria");
            $.ajax({
                type:"POST",
                context: document.body,
                url: '{{route('insertCategoria')}}',
                data:{ 'nombre' : nombre.val()},
                success: function(data){
                    $.msgbox("Categoria agregada correctamente", { type: 'success'});
                    $("#categoria").append('<option value="' + data + '" selected="selected">' + nombre.val() + '</option>');
                    nombre.val("");
                },
                error: function(data){
                    var respuesta =JSON.parse(data.responseText);
                    var arr = Object.keys(respuesta).map(function(k) { return respuesta[k] });
                    var mensaje="";
                    for (var i=0; i<arr.length; i++)
                        mensaje += arr[i][0]+"\n";
                    nombre.val("");
                    $.msgbox(mensaje, { type: 'error'});
                    $("#newCategoria").focus();

                }
            });
        }
        else {
            alert("Debe ingresar un nombre de categoria nueva");
            $("#newCategoria").focus();
        }

    }

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
                                            "<div class='col-xs-2 text-center'><label for='fuEspañol'>Participio</label></div>" +
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