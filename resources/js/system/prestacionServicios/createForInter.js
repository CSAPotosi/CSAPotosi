$(document).ready(calcular);
$("table tbody tr td input:text").keyup(calcular);

$('.select-item').on('click',function(){
    var $item = $(this).closest('.service');
    $item.toggleClass('service service-selected').addClass('hidden');
    $("#form-add-services table tbody").append($item.find("tr"));
    calcular();
});

$('.selected-item').on('click',function () {
    var id_serv = $(this).closest("td").find("input:hidden[ name $='[id_servicio]' ]").eq(0).val();
    id_ele = "#service-"+id_serv;
    var $item = $(this).closest("tr");
    $item.find("input:text[name $= '[cantidad]' ]").val(1);
    $(id_ele).find("table tbody").append($item);
    $(id_ele).toggleClass('service service-selected').removeClass('hidden');
    calcular();
});

function calcular(){
    var total = 0;
    $("#form-add-services table tbody tr").each(function(){
        var tempVal = $(this).find("td").eq(2).text();
        var pu = ($.isNumeric(tempVal))? parseFloat(tempVal):0;

        tempVal = $(this).find("td").eq(3).find("input").eq(0).val();
        var cant = ($.isNumeric(tempVal))? parseFloat(tempVal):0;

        var subtotal = cant*pu;
        $(this).find("td").last().text(subtotal);
        $(this).find("input[name $= '[subtotal]']").eq(0).val(subtotal);

        total +=subtotal;
    });
    $("#form-add-services table tfoot tr td").last().text(total);
    if($("#form-add-services table tbody tr").length>0&&total>0)
        $("#send-form-prestacion").prop("disabled",false);
    else
        $("#send-form-prestacion").prop("disabled",true);
}