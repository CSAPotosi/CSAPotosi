/**
 * Created by cristian on 29/07/2016.
 */
$(document).ready(function () {
    $("#searchServicio").on("keyup", function () {
        var texto = $(this).val();
        if (texto.length > 0) {
            $(".val").addClass("hide");
            $(".val[data-nombre*='" + texto + "']").removeClass("hide");
        }
        else {
            $(".val").removeClass("hide");
        }
    })
    $("#btnCategorias").on("click", function () {
        $("#searchCategorias").removeClass("hidden");
    })

    $(".onoffswitch-checkbox").on("change", function () {
        $.ajax({
            url: $(this).attr("data-url"),
            type: "get"
        });
    });
})
/**
 * Created by cristian on 02/08/2016.
 */
