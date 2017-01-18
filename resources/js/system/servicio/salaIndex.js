var responsiveHelper_datatable_fixed_column = undefined;
var breakpointDefinition = {
    tablet : 1024,
    phone : 480
};

var language = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
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
};

var otable = $('#groups-table').DataTable({
    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'>r>"+
    "t"+
    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "autoWidth" : true,
    "oLanguage": language,
    "preDrawCallback" : function() {
        // Initialize the responsive datatables helper once.
        if (!responsiveHelper_datatable_fixed_column) {
            responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#groups-table'), breakpointDefinition);
        }
    },
    "rowCallback" : function(nRow) {
        responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
    },
    "drawCallback" : function(oSettings) {
        responsiveHelper_datatable_fixed_column.respond();
    }
});

$("#antecedentes-table thead th input[type=text],#groups-table thead th select").on( 'keyup change', function () {
    otable
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );