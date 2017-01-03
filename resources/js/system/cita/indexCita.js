$("#hr11").on("click", function () {
    $(".cabecera1").removeClass('hide');
    $(".form-actions").removeClass('hide');
})
$("#hr22").on("click", function () {
    $(".cabecera1").addClass('hide');
    $(".form-actions").addClass('hide');
})
$(".val").on("click", function () {
    var nombre = $(this).attr('data-nombre');
    var id_paciente = $(this).attr('id_paciente');
    $("#appendbutton").val(nombre);
    $("#paciente").val(id_paciente);
    $("#modalPaciente").modal('hide');
});
$(".val1").on("click", function () {
    var nombre = $(this).attr('data-nombre');
    var id_servicio = $(this).attr('id_servicio');
    $("#especialidad").val(nombre);
    $("#codigoatencion").val(id_servicio);
    $("#modalAtencion").modal('hide');
    activarHorario();
});
$("#Cita_fecha").on("change", function () {
    activarHorario();
})
function activarHorario() {
    if ($("#codigoatencion").val() != '' && $("#Cita_fecha").val() != '') {
        $("#Cita_hora_cita").removeAttr('disabled');
        $.ajax({
            url: $("#Cita_hora_cita").attr('data-atencion'),
            type: "post",
            data: {
                'atencion': $("#codigoatencion").val(),
                'fecha': $("#Cita_fecha").val(),
                'paciente': $("#paciente").val()
            },
            success: function (datos) {
                $("#Cita_hora_cita").html(datos);
            }
        });
        return false;
    }
}
$(document).ready(function () {
    pageSetUp();
    var hdr = {
        left: 'title',
        center: 'month,agendaWeek,agendaDay',
        right: 'prev,today,next'
    };
    $("#calendar").fullCalendar({});
    $('#calendar').fullCalendar({
        locale: 'es',
        header: hdr
    });
    $('.fc-right, .fc-center').hide();
    $('#calendar-buttons #btn-prev').click(function () {
        $('.fc-prev-button').click();
        return false;
    });
    $('#calendar-buttons #btn-next').click(function () {
        $('.fc-next-button').click();
        return false;
    });
    $('#calendar-buttons #btn-today').click(function () {
        $('.fc-today-button').click();
        return false;
    });
    $('#mt').click(function () {
        $('#calendar').fullCalendar('changeView', 'month');
    });
    $('#ag').click(function () {
        $('#calendar').fullCalendar('changeView', 'agendaWeek');
    });

    $('#td').click(function () {
        $('#calendar').fullCalendar('changeView', 'agendaDay');
    });
})


