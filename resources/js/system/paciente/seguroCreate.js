$(document).ready(function () {
    if ($("#AseguradoConvenio_tipo_asegurado").val() == 1) {
        $("#searchPacienteTitular").attr('disabled', 'disabled');
        $("#contenedor_paciente").addClass('hide');
        $("#table-paciente").addClass('hide');
        $("#AseguradoConvenio_id_paciente_titular").val('');
        $("#paciente_titular").val('');

    }
    else {
        $("#searchPacienteTitular").removeAttr('disabled');
        $("#contenedor_paciente").removeClass('hide');
        $("#table-paciente").removeClass('hide');
    }
});
$("#AseguradoConvenio_tipo_asegurado").on('change', function () {
    if ($("#AseguradoConvenio_tipo_asegurado").val() == 1) {
        $("#searchPacienteTitular").attr('disabled', 'disabled');
        $("#contenedor_paciente").addClass('hide');
        $("#table-paciente").addClass('hide');
        $("#AseguradoConvenio_id_paciente_titular").val('');
        $("#paciente_titular").val('');
    }
    else {
        $("#searchPacienteTitular").removeAttr('disabled');
        $("#contenedor_paciente").removeClass('hide');
        $("#table-paciente").removeClass('hide');
    }
})
$("#btn-seguro").on("click", function () {
    if ($("#AseguradoConvenio_tipo_asegurado").val() == 1) {
        $("#AseguradoConvenio_id_paciente_titular").val($("#AseguradoConvenio_id_paciente").val());
    }
})
$("#searchPacienteTitular").on("keyup", filtroServicio);
function filtroServicio() {
    var texto = $(this).val();
    if (texto.length > 0) {
        $(".val").addClass("hide");
        $(".val[data-nombre*='" + texto + "']").removeClass("hide");
    }
    else
        $(".val").removeClass("hide");
}
$(".val").on("click", function () {
    $("#AseguradoConvenio_id_paciente_titular").val($(this).attr('data-paciente'));
    $("#paciente_titular").val($(this).attr('data-nombre'));
})
