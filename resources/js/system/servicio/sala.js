$(document).ready(getSalas);

$("#tSala").on('change',getSalas);

//llamadas ajax
function getSalas(){
    var id_t_sala = $("#tSala").val();
    var url = $("#form-t-sala").attr("action");
    $("#widget-grid header").addClass("widget-body-ajax-loading");
    $("#widget-grid").find(".widget-body-container").load(url,{id: id_t_sala},eventHandlersSalaItem);
}

//cargar eventos
function eventHandlersSalaItem(){
    $("#widget-grid header").removeClass("widget-body-ajax-loading");
    $(".widget-body-container .item-sala").off().on("click",function(){
        return false;
    });
    $(".widget-body-container .item-sala .item-sala-option.option-state").off().on("click",changeState);
}

//Cambiar estados
function changeState(){
    var $item = $(this).parents(".info-tiles").eq(0);
    var state = parseInt($(this).data("to_state"));
    var url = $(this).data("url");
    $.post(url,{state: state});
    switch (state){
        case 1:
            $(this).data("to_state",3);
            $item.find(".tiles-heading").text("DISPONIBLE");
            $item.find(".tiles-footer").text("A MANTENIMIENTO");
            break;
        case 3:
            $(this).data("to_state",1);
            $item.find(".tiles-heading").text("MANTENIMIENTO");
            $item.find(".tiles-footer").text("A DISPONIBLE");
            break;
    }
    $item.toggleClass("tiles-facebook tiles-twitter");
}