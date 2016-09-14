<div id="editarPalabra">
    {!!Form::model($datosForm, array('route' => array('updatePal')))!!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4> Edit word</h4>
    </div>
    <div class="modal-body">
        {!!Form::hidden('idTraduccion')!!}
        {!!Form::hidden('idPalabra')!!}
        {{--{!!Form::hidden('tiempo')!!}--}}
        {{--{!!Form::hidden('tipo')!!}--}}
        {!!Form::hidden('categoria', null, ['id'=>'categoria'])!!}
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('palabra','Word in Spanish (*)')!!}</div>
            <div class="col-xs-12">{!!Form::text('palabra',null,['class'=>'form-control solo-letra', 'required'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12">{!!Form::label('traduccion','Translation (*)')!!}</div>
            <div class="col-xs-12">{!!Form::text('traduccion',null,['class'=>'form-control solo-letra', 'required'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">{!!Form::label('tipo','Type')!!}</div>
            <div class="col-xs-6">{!!Form::label('tiempo','Verbal tense')!!}</div>
            <div class="col-xs-6">{!!Form::select('tipo', $tiposP ,null ,['class'=>'form-control', 'id'=>'tipo'])!!}</div>
            <div class="col-xs-6">{!!Form::select('tiempo', $tiemposV ,null ,['class'=>'form-control'])!!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">{!!Form::label('categoria', 'Category (*)',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">{!!Form::label('newCategoria', 'New',['class'=>'control-label']) !!}</div>
            <div class="col-xs-6">
                {!!Form::select('categorias[]', $categoriasP ,null ,['class'=>'form-control select2_multiple','style'=>'width:100%;',  'multiple'=>'multiple', 'id'=>'categorias'])!!}
            </div>
            <div class="col-xs-4">{!!Form::text('newCategoria',null,['class'=>'form-control solo-letra', 'id'=>'newCategoria'])!!}</div>
            <div class="col-xs-2 text-center">
                <button type="button" class="btn btn-primary" onclick="nuevaCat()"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Save">
    </div>
</div>
{!!Form::close()!!}



<script type="text/javascript">

    var modal = $('#editarPalabra');

    $(function(){
        validarFormulario();// validar forularios con kendo
        EventoFormularioModal(modal, onSuccess);

        $("#categorias").select2({
            maximumSelectionLength: 5,
            placeholder: "Min 1, Max 5..",
            allowClear: true
        });
        var data = $("#categoria").val();
        var dataarray = data.split(",");
        $("#categorias").val(dataarray);
//        alert ( $("#categorias").val());
        $("#categorias").select2();

        $('.solo-letra').keyup(function (){
            this.value = (this.value + '').replace(/[^A-Za-z ]/g, '');
        });

        if ($("#tipo option:selected").text() != "Verbo"){
            $('#tiempo').attr('disabled', true);
        }

        $("#tipo").change(function(){
            if ($("#tipo option:selected").text() == "Verbo")
                $('#tiempo').attr('disabled', false);
            else
                $('#tiempo').attr('disabled', true);
        });
    });

    function validarFormulario(){
        /*metodo de kendo para validar los formulario*/
        $('form').kendoValidator();
    }

    function nuevaCat(){
        if ($("#newCategoria").val() != ""){
            var nombre = $("#newCategoria");
            $.ajax({
                type:"POST",
                context: document.body,
                url: '{{route('insertCategoria')}}',
                data:{ 'nombre' : nombre.val()},
                success: function(data){
                    $.msgbox("Category successfully added", { type: 'success'});
                    $("#categorias").append('<option value="' + data + '" selected="selected">' + nombre.val() + '</option>');
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
            alert("You must enter a new category name");
            $("#newCategoria").focus();
        }

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