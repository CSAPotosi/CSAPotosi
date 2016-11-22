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


/*  opciones del plugin datatables
 $("#desasignado").dataTable({
 "paging": false,
 "info": false,
 "language": {
 "searchPlaceholder": "BUSCAR...",
 "sProcessing":     "Procesando...",
 "sLengthMenu":     "Mostrar _MENU_ registros",
 "sZeroRecords":    "No se encontraron resultados",
 "sEmptyTable":     "Ningún dato disponible en esta tabla",
 "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
 "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
 "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
 "sInfoPostFix":    "",
 "sSearch":         "",
 "sUrl":            "",
 "sInfoThousands":  ",",
 "sLoadingRecords": "Cargando...",
 "oPaginate": {
 "sFirst":    "Primero",
 "sLast":     "Último",
 "sNext":     "Siguiente",
 "sPrevious": "Anterior"
 },
 "oAria": {
 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
 }
 },
 });
 */