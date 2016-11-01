$(document).ready(function () {
    $("input[type='checkbox'],input[type='radio']").iCheck({
        checkboxClass: "icheckbox_minimal-red",
        radioClass: "iradio_minimal-blue"
    });
    $(".servicio").on("ifChecked", function () {
        var valor = $(this).val();
        seleccionado(valor);
    });
    function seleccionado(valor) {
        ($("#" + valor + "")).removeClass('nombre-busca');
        $("#contenedor2").append($("#" + valor + ""));
        $("#" + valor + "").children("[name='ocultar']").removeClass("hidden");
        $("#" + valor + "").children("[name='datos']").addClass("hidden");
    }

    $(".servicio").on("ifUnchecked", function () {
        var valor = $(this).val();
        deseleccionar(valor);
    });
    function deseleccionar(valor) {
        ($("#" + valor + "")).addClass('nombre-busca');
        $("#contenedor1").append($("#" + valor + ""));
        $("#" + valor + "").children("[name='ocultar']").addClass("hidden");
        $("#" + valor + "").children("[name='datos']").removeClass("hidden");
    }

    $("#searchServicios").on("keyup", function () {
        var texto = $(this).val();
        if (texto.length > 0) {
            $(".nombre-busca").addClass("hide");
            $(".nombre-busca[data-nombre*='" + texto + "']").removeClass("hide");
        }
        else {
            $(".nombre-busca").removeClass("hide");
        }
    });
});

