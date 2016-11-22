$(".operacion").on("click", function () {
    if ($(this).is(':checked')) {
        var name = $(this).val();
        $("#asignado").append($("#" + name.replace(/ /g, "_")));
    }
    else {
        var name = $(this).val();
        $("#desasignado").append($("#" + name.replace(/ /g, "_")));
    }
});


$('#input-filter').keyup(function () {
    var that = this;
    $.each($('#desasignado tr'),
        function (i, val) {
            if ($(val).text().toUpperCase().indexOf($(that).val().toUpperCase()) == -1) {
                $('tr').eq(i).hide();
            } else {
                $('tr').eq(i).show();
            }
        });
});


$('#activarOculto').on("click", function () {
    $("#oculto").val("valor");
});