function click() {
    $("input[type='checkbox'],input[type='radio']").iCheck({
        checkboxClass: "icheckbox_minimal-red",
        radioClass: "iradio_minimal-blue"
    });
    $(".especialidad").on("ifChecked", function () {
        var valor = $(this).val();
        seleccionado(valor);
    });
    function seleccionado(valor) {
        $("#" + valor + " :input").removeAttr('disabled');
        $("#contenedorAsignadas").append($("#" + valor + ""));

    }

    $(".especialidad").on("ifUnchecked", function () {
        var valor = $(this).val();
        deseleccionar(valor);
    });
    function deseleccionar(valor) {
        $("#" + valor + " :input").attr('disabled', 'disabled');
        $("#desasignar").append($("#" + valor + ""));
    }
}
click();

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
                $("#formEspecialidad")[0].reset();
                click();
            }
            else {
                $('#contenedorFormularioEspecialidad').html(datos);
            }
        }

    });
    return false;
}
