<div id="Editarmodulo">
 {!!Form::open()!!}
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4> Editar modulo RFID</h4>
  </div>
  <div class="modal-body">
 
      <div class="form-group">
        {!!Form::label('Id modulo RFID (*)')!!}
        {!!Form::text('idmodulo',null,['class'=>'form-control', 'required'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('Nombre oficina (*)')!!}
        {!!Form::email('Nombre',null,['class'=>'form-control', 'required'])!!}
      </div>
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
   <input type="submit" class="btn btn-success" value="Guardar">
 </div>
</div>
{!!Form::close()!!}



<script type="text/javascript">

//modalBs.modal('hide');

  var modal = $('#Editarmodulo');

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
    if(result.estado=true){
      $.msgbox(result.mensaje, { type: 'alert' }, function(){
         modalBs.modal('hide');
      });
    }
  }
</script>