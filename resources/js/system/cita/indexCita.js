$("#hr11").on("click", function () {
    $(".cabecera1").removeClass('hide');
    $(".form-actions").removeClass('hide');
})
$("#hr22").on("click", function () {
    $(".cabecera1").addClass('hide');
    $(".form-actions").addClass('hide');
})
$(".val").on("click", function () {
    var nombre = $(this).attr('data-nombre');
    var id_paciente = $(this).attr('id_paciente');
    $("#appendbutton").val(nombre);
    $("#paciente").val(id_paciente);
    $("#modalPaciente").modal('hide');
});
$(".val1").on("click", function () {
    var nombre = $(this).attr('data-nombre');
    var id_servicio = $(this).attr('id_servicio');
    $("#especialidad").val(nombre);
    $("#codigoatencion").val(id_servicio);
    $("#modalAtencion").modal('hide');
});
