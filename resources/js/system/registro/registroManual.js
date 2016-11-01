var tick;
function stop() {
    clearTimeout(tick);
}
function simple_reloj() {
    var ut = new Date();
    var h, m, s;
    var time = "        ";
    h = ut.getHours();
    m = ut.getMinutes();
    s = ut.getSeconds();
    if (s <= 9) s = "0" + s;
    if (m <= 9) m = "0" + m;
    if (h <= 9) h = "0" + h;
    time += h + ":" + m + ":" + s;
    document.getElementById('reloj').innerHTML = time;
    tick = setTimeout("simple_reloj()", 1000);
}
stop();
simple_reloj();
$("#ci").on("keyup", function () {
    var valor = $(this).val();
    if (valor.length >= 6) {
        $("#contenedorInfoEmpleado").removeClass('hidden');
        $.ajax({
            url: $(this).attr("data-url"),
            type: "post",
            data: $("#formBusqueda").serialize(),
            success: function (datos) {
                $("#contenedorInfoEmpleado").html(datos);
            }
        });
        return false;
    }
    if (valor.length <= 5) {
        $("#contenedorInfoEmpleado").addClass('hidden');
    }
})
$("#btnEnviar").on("click", function () {
    if ($("#ci").val().length >= 6) {
        if ($("#id_asignacion").val() != "") {
            $.ajax({
                url: $(this).attr("data-url"),
                type: "post",
                data: $("#formRegistro").serialize(),
                success: function (datos) {
                    $("#contenedorInfoEmpleado").html(datos);
                    $("#ci").val("");
                    $("#id_aignacion").val("");
                }
            });
            return false;
        }
    }
});
