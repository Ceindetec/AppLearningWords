
/*permite procedimientos ajax para laravel*/
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var table = [];



var modalBs = $('#modalBs');
var modalBsContent = $('#modalBs').find(".modal-content");


$(function(){

    /*elimina boton de seleccion de filtros de la grid*/

    $('span[unselectable].k-dropdown-wrap.k-state-default').removeAttr('style');
    $('table .k-dropdown-wrap.k-state-default').css('display','none');
    handleAjaxModal();

    $(".animacarga").hide();
})




function handleAjaxModal() {


    // Limpia los eventos asociados para elementos ya existentes, asi evita duplicación
    $("a[data-modal]").unbind("click");
    // Evita cachear las transaccione Ajax previas
    $.ajaxSetup({ cache: false });

    // Configura evento del link para aquellos para los que desean abrir popups
    $("a[data-modal]").on("click", function (e) {
        var dataModalValue = $(this).data("modal");

        var dataid = $(this).attr('data-id');
        var url = "";
        if(dataid){
            index = $(this).attr('table') != ''? $(this).attr('table') : 0;
            var data = table[index].row( $(this).parents('tr') ).data();
            url = this.href+"?id="+data[dataid];
        }else{
            url = this.href;
        }

        modalBsContent.load(url, function (response, status, xhr) {
            switch (status) {
                case "success":
                modalBs.modal({ backdrop: 'static', keyboard: false }, 'show');

                if (dataModalValue == "modal-lg") {
                    modalBs.find(".modal-dialog").addClass("modal-lg");
                } else {
                    modalBs.find(".modal-dialog").removeClass("modal-lg");
                }

                break;

                case "error":
                var message = "Error de ejecución: " + xhr.status + " " + xhr.statusText;
                if (xhr.status == 403) $.msgbox(response, { type: 'error' });
                else $.msgbox(message, { type: 'error' });
                break;
            }

        });
        return false;
    });
}


function EventoFormularioModal(modal, onSuccess) {
    modal.find('form').submit(function () {
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (result) {
                onSuccess(result);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var message = "Error de ejecución: " + textStatus + " " + errorThrown;
                $.msgbox(message, { type: 'error' });
                console.log("Error: ");
            }
        });
        return false;
    });
}


