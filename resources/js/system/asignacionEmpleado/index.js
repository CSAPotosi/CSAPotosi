$("#searchEmpleadoAsignado").on("keyup", filtroServicio);
function filtroServicio() {
    var texto = $(this).val();
    if (texto.length > 0) {
        $(".val").addClass("hide");
        $(".val[data-nombre*='" + texto + "']").removeClass("hide");
    }
    else
        $(".val").removeClass("hide");
}
