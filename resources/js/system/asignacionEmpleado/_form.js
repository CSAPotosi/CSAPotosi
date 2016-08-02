$(document).ready(function () {
    $(".select").on("click", function () {
        var nombre = $(this).attr("data-nombre");
        var id = $(this).attr("data-id");
        $("#AsignacionEmpleadoNombre").val(nombre);
        $("#AsignacionEmpleadoId").va(id);
    });
});
