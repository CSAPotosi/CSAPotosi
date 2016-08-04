/**
 * Created by cristian on 29/07/2016.
 */
$(document).ready(function () {
    /*$("#searchServicio").on("keyup", function () {
        var texto = $(this).val();
        if (texto.length > 0) {
            $(".val").addClass("hide");
            $(".val[data-nombre*='" + texto + "']").removeClass("hide");
        }
        else {
            $(".val").removeClass("hide");
        }
     })*/
    $("#searchServicio").on("keyup", filtro);
    $(".select2").on("change", filtro);
    function filtro() {
        var texto = $(this).val();
        if (texto.length > 0) {
            $(".val").addClass("hide");
            $(".val[data-nombre*='" + texto + "']").removeClass("hide");
            $(".val[data-categoria*='" + texto + "']").removeClass("hide");
        }
        else
            $(".val").removeClass("hide");
    }
    $(".onoffswitch-checkbox").on("change", function () {
        $.ajax({
            url: $(this).attr("data-url"),
            type: "get"
        });
    });
    /*$(".select2").on("change",function () {
     var texto= $(this).val();
     $('.val1').addClass("hide");
     if(texto!="")
     $(".val1[data-categoria*='" + texto + "']").removeClass("hide");
     else
     $(".val1").removeClass("hide");
     })*/

})
/**
 * Created by cristian on 02/08/2016.
 */

