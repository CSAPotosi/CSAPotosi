$('#selectpersona').select2();

$(".rol").on("click", function () {
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


/*
 $("#txt-nombre").on("click", function () {
 $('#modal-personas').dialog('open');
 return false;
 });

 $(".table-row").on("click", function () {
 $("#id-persona").val($(this).attr("data-id-persona"));
 $("#nombre-completo").val($(this).children("td").eq(0).text() + " " + $(this).children("td").eq(1).text() + " " + $(this).children("td").eq(2).text());
 $(".documento-usuario").val($(this).children("td").eq(3).text());
 })*/

