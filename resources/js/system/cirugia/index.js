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
    var current = $('#calendar').fullCalendar('getDate');
    var first = moment(current).startOf('month');
    var last = moment(current).endOf('month');
    var url = $(this).closest("#calendar-buttons").data("url");
    $.post(url,{
        firstDate: first.format('DD/MM/YYYY'),
        lastDate: last.format('DD/MM/YYYY')
    },function(data){
        $("#calendar").fullCalendar('removeEvents');
        $("#calendar").fullCalendar( 'addEventSource', data );
    });
});

$(document).ready(function(){
    var url = $("#calendar-buttons").data("url");
    var first = moment().startOf('month');
    var last = moment().endOf('month');
    $.post(url,{
        firstDate: first.format('DD/MM/YYYY'),
        lastDate: last.format('DD/MM/YYYY')
    },function(data){
        $("#calendar").fullCalendar('removeEvents');
        $("#calendar").fullCalendar( 'addEventSource', data );
    });
});