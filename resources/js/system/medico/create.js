$(document).ready(function () {
    pageSetUp();
    $('#bootstrap-wizard-1').bootstrapWizard({
        'tabClass': 'form-wizard',
        'onNext': function (tab, navigation, index) {
            var $valid = $("#wizard-1").valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            } else {
                $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                    'complete');
                $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                    .html('<i class="fa fa-check"></i>');
            }
        }
    });
});
$("#btnGuardarEspecialidad").on("click", CrearEspecialidad);
function CrearEspecialidad() {
    $.ajax({
        url: $(this).attr('data-url'),
        data: $("#formEspecialidad").serialize(),
        type: "post",
        success: function (datos) {
            var contenido = $("<div>").html(datos);
            if (contenido.children("#flag").val() == null) {
                $("#contenedorListaEspecialidad").html(datos);
                $("#modalEspecialidad").modal("hide");
                ;
                $("#formEspecialidad")[0].reset();
            }
            else {
                $('#contenedorFormularioEspecialidad').html(datos);
            }
        }

    });
    return false;
}
