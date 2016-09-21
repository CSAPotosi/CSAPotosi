$("#searchServicio").on("keyup", filtro);
function filtro() {
    var texto = $(this).val();
    if (texto.length > 0) {
        $(".val").addClass("hide");
        $(".val[data-nombre*='" + texto + "']").removeClass("hide");
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