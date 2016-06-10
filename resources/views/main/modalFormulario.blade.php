<div id="NombreDelModal">
 {!!Form::open()!!}
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4> Titulo del modal</h4>
  </div>
  <div class="modal-body">
 
      <div class="form-group">
        {!!Form::label('Usuario*')!!}
        {!!Form::text('usuario',null,['class'=>'form-control', 'required'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('E-mail*')!!}
        {!!Form::email('email',null,['class'=>'form-control', 'required', 'data-email-msg'=>'Formato de correo no valido'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('Contraseña*')!!}
        {!!Form::password('contra',['class'=>'form-control', 'required'])!!}
      </div>
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
   <input type="submit" class="btn btn-primary" value="Guardar">
 </div>
</div>
{!!Form::close()!!}



<script type="text/javascript">


  var modal = $('#NombreDelModal');

  $(function(){
    validarFormulario();// validar forularios con kendo
    EventoFormularioModal(modal, onSuccess)
  });

  function validarFormulario(){
    /*metodo de kendo para validar los formulario*/
    $('form').kendoValidator({
      //organiza los mensajes personalizados
       messages: {

             customRule1: "Debete tener mas de 3 caracteres",
             required: "Este campo es obligatorio",
         },
         //define reglas si necesita tener mas  de solo el campo requerido
        rules: {
          customRule1: function(input) {
              if (input.is("[name=usuario]")) {
                return input.val().length>3;
              }
              return true;
          }
        }
    });
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