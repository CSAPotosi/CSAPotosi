$(document).ready(function () {
    $("#searchServicio").on("keyup", filtroServicio);
    function filtroServicio() {
        var texto = $(this).val();
        if (texto.length > 0) {
            $(".val").addClass("hide");
            $(".val[data-titulo*='" + texto + "']").removeClass("hide");
        }
        else
            $(".val").removeClass("hide");
    }

    $("#hr11").on("click", function () {
        $("#selector").removeClass("hidden");
    });
    $("#hr22").on("click", function () {
        $("#selector").addClass("hidden");
    });
    $("#selector").on("change", function () {
        var tipo = $(this).val();
        if (tipo == 0)
            $(".servExamen").removeClass("hidden");
        else {
            $(".servExamen").addClass("hidden");
            $(".servExamen[data-tipo*='" + tipo + "']").removeClass("hidden");
        }
    })
    $("input[type='checkbox'],input[type='radio']").iCheck({
        checkboxClass: "icheckbox_minimal-red",
        radioClass: "iradio_minimal-blue"
    });
    $(".checkeded").on("ifChecked", function () {
        var valor = $(this).val();
        $("#" + valor + "").children().children().children("[name='ocultar']").removeClass("hide");
        $("#" + valor + "").children().children().prop("class", "val2");
        $("#" + valor + "").parent().addClass("hide");
        $("#contenedorDetallePrestacion").append($("#" + valor + "").children());
        calcular($(".val2"));
    });
    $(".checkeded").on("ifUnchecked", function () {
        var valor = $(this).val();
        $("#" + valor + "").parent().removeClass("hide");
        $("#" + valor + "").append($(this).parent().parent().parent());
        $("#" + valor + "").children().children().children("[name='ocultar']").addClass("hide");
        $("#" + valor + "").children().children().prop("class", "val1");
        calcular($(".val2"));
    });
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    function calcular(lista) {
        var suma = 0;
        lista.each(function (index) {
            var cant = parseInt($(this).children().children(".cantidad").val());
            if (isNaN(cant)) {
                cant = 0;
            }
            suma = suma + (parseInt($(this).attr("data-precio")) * cant);
        });
        $("#detallePrestacionTotal").val(suma);
    }

    $("#btnDetalleServicios").on("click", enviarPrestacionServicios);
    function enviarPrestacionServicios() {
        alert($("#formPrestacionServicios").attr("data-url"));
        $.ajax({
            url: $("#formPrestacionServicios").attr("data-url"),
            type: "post",
            data: $("#formPrestacionServicios").serialize(),
            success: function (datos) {
                detallePrestacion(datos.jsonPrestacion);
            }
        });
        return false;
    }

    function detallePrestacion(valor) {
        var lista = $(".val2");
        lista.each(function (index) {
            alert(valor);
            $(this).children().children(".id_prestacion").val(valor);
        });
    }

});
