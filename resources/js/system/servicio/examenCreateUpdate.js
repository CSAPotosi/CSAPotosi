$(document).ready(function () {
    if ($('#divselect').attr('data') == 'hide')
        $('#divselect').hide();
});

$('input[name = "ServicioForm[id_entidad]"]').iCheck({
    radioClass: 'iradio_flat-blue'
});
$('#selectentidad').select2();
$('#selectcategoria').select2();

$('input[name = "ServicioForm[id_entidad]"]').on('ifClicked', function (e) {
    if ($(this).val() == '1') {
        $("#divselect").hide('slow');
        $("#selectentidad").val('');
    }
    else {
        $("#divselect").show('slow');
        $("#selectentidad").val("a").trigger("change");
    }
});

$('#condiciones').on('focus', function () {
    $(this).attr('rows', '3');
});
$('#condiciones').on('focusout', function () {
    $(this).attr('rows', '1');
});
