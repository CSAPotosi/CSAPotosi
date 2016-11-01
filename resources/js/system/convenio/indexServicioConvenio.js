$("#btnConvenioServicio").on("click", CrearServicioConvenio);
function clickSelector() {
    $("input[type='checkbox'],input[type='radio']").iCheck({
        checkboxClass: "icheckbox_minimal-red",
        radioClass: "iradio_minimal-blue"
    });
    $(".servicio").on("ifChecked", function () {
        var valor = $(this).val();
        seleccionado(valor);
    });
    function seleccionado(valor) {
        $("#contenedor2").append($("#" + valor + ""));
        $("#" + valor + "").children("[name='ocultar']").removeClass("hidden");
        $("#" + valor + "").children("[name='datos']").addClass("hidden");

    }

    $(".servicio").on("ifUnchecked", function () {
        var valor = $(this).val();
        deseleccionar(valor);
    });
    function deseleccionar(valor) {
        $("#contenedor1").append($("#" + valor + ""));
        $("#" + valor + "").children("[name='ocultar']").addClass("hidden");
        $("#" + valor + "").children("[name='datos']").removeClass("hidden");
    }
}
function CrearServicioConvenio() {
    $.ajax({
        url: $(this).attr('data-url'),
        type: "post",
        data: $("#detalle-form-convenio-servicio").serialize(),
        success: function (datos) {
            var contenido = $("<div>").html(datos);
            if (contenido.children("#flag").val() == null) {
                $("#servicioconvenio").modal("hide");
                window.location = datos;
            }
            else {
                $("#contenedorlistaconvenio").html(datos);
                clickSelector();
            }
        }
    });
}
$(".convenioCheckbox").on("ifChecked", function () {
    $.ajax({
        url: $(this).attr("data-url"),
        type: "get"
    });
});
$(".convenioCheckbox").on("ifUnchecked", function () {
    $.ajax({
        url: $(this).attr("data-url"),
        type: "get"
    });
});
$("#searchConvenioServicio").on("keyup", function () {
    var texto = $(this).val();
    if (texto.length > 0) {
        $(".valor").addClass("hide");
        $(".valor[data-nombre*='" + texto + "']").removeClass("hide");
    }
    else {
        $(".valor").removeClass("hide");
    }
});