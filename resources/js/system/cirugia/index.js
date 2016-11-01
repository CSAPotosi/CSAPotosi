var hdr = {
    left: 'title',
    center: 'month,agendaWeek,agendaDay',
    right: 'prev,today,next'
};

$("#calendar").fullCalendar({
    locale:'es',
    header:hdr
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

$('#calendar-buttons #btn-month').click(function () {
    $('.fc-month-button').click();
    return false;
});

$('#calendar-buttons #btn-week').click(function () {
    $('.fc-agendaWeek-button').click();
    return false;
});

$('#calendar-buttons #btn-day').click(function () {
    $('.fc-agendaDay-button').click();
    return false;
});

$("#calendar-buttons a").click(function(){
    var moment = $('#calendar').fullCalendar('getDate');
    var month = moment.format('M');
    var year = moment.format('Y');
    var url = $(this).closest("#calendar-buttons").data("url");

    $.post(url,function(data){
        $("#calendar").fullCalendar('removeEvents');
        $("#calendar").fullCalendar( 'addEventSource', data );
    });
});

$(document).ready(function(){
    var url = $("#calendar-buttons").data("url");
    $.post(url,function(data){
        $("#calendar").fullCalendar('removeEvents');
        $("#calendar").fullCalendar( 'addEventSource', data );
    });
});