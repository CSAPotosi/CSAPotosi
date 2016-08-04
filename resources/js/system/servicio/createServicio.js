$('#select2').select2();
$('#select2').on('change', function () {
    $('#descripcion').html($(this).find(':selected').attr("data-descripcion"))
    $("#id_categoria").val($(this).find(':selected').val());
});

