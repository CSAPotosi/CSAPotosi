$("#txt-nombre").on("click", function () {
    $('#modal-personas').dialog('open');
    return false;
});

$(".table-row").on("click", function () {
    $("#id-persona").val($(this).attr("data-id-persona"));
    $("#nombre-completo").val($(this).children("td").eq(0).text() + " " + $(this).children("td").eq(1).text() + " " + $(this).children("td").eq(2).text());
    $(".documento-usuario").val($(this).children("td").eq(3).text());
})