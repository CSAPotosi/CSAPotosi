$(function () {
    $("#fecha-reserva").datetimepicker({
        locale:'es',
        sideBySide:true,
        stepping:5
    });
});

$(function () {
    $("#fecha-inicio").datetimepicker({
        locale:'es',
        sideBySide:true
    });

    $("#fecha-fin").datetimepicker({
        locale:'es',
        sideBySide:true
    });
});