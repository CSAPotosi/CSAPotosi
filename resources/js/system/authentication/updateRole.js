$(".tarea").on("click", function () {
    if ($(this).is(':checked')) {
        var name_t = $(this).val();
        $("#asignado").append($("#" + name_t.replace(/ /g, "_")));
    }
    else {
        var name_t = $(this).val();
        $("#desasignado1").append($("#" + name_t.replace(/ /g, "_")));
    }
});

$(".rol").on("click", function () {
    if ($(this).is(':checked')) {
        var name_r = $(this).val();
        $("#asignado").append($("#" + name_r.replace(/ /g, "_")));
    }
    else {
        var name_r = $(this).val();
        $("#desasignado2").append($("#" + name_r.replace(/ /g, "_")));
    }
});

$('#input-filter-1').keyup(function () {
    var that = this;
    $.each($('#desasignado1 tr'),
        function (i, val) {
            if ($(val).text().toUpperCase().indexOf($(that).val().toUpperCase()) == -1) {
                $('#desasignado1 tr').eq(i).hide();
            } else {
                $('#desasignado1 tr').eq(i).show();
            }
        });
});

$('#input-filter-2').keyup(function () {
    var that = this;
    $.each($('#desasignado2 tr'),
        function (i, val) {
            if ($(val).text().toUpperCase().indexOf($(that).val().toUpperCase()) == -1) {
                $('#desasignado2 tr').eq(i).hide();
            } else {
                $('#desasignado2 tr').eq(i).show();
            }
        });
});


$('#activarOculto').on("click", function () {
    $("#oculto").val("valor");
});

