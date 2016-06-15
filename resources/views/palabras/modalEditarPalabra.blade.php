<div id="editarPalabra">
    {!!Form::model($datosForm, array('route' => array('updatePal')))!!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4> Editar palabra</h4>
    </div>
    <div class="modal-body">
        {!!Form::hidden('idTraduccion')!!}
        {!!Form::hidden('idPalabra')!!}
        <div class="form-group">
            {!!Form::label('Palabra Español (*)')!!}
            {!!Form::text('palabra',null,['class'=>'form-control', 'required'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('Traduccion (*)')!!}
            {!!Form::text('traduccion',null,['class'=>'form-control', 'required'])!!}
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-success" value="Guardar">
    </div>
</div>
{!!Form::close()!!}



<script type="text/javascript">

    var modal = $('#editarPalabra');

    $(function(){
        validarFormulario();// validar forularios con kendo
        EventoFormularioModal(modal, onSuccess)
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