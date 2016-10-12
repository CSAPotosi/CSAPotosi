$("#modal-sala").on("show.bs.modal",getSalas);
$("#tSala").on('change',getSalas);


//llamar salas
function getSalas(){
    var id_t_sala = $("#tSala").val();
    var url = $("#modal-sala").data("url");
    $("#modal-sala .modal-body .well").load(url,{id: id_t_sala},eventHandlersSalaItem);
}

//agregar eventos
function eventHandlersSalaItem(){
    $(".item-sala").off().on("click",function(){
        return false;
    });
    $(".item-sala .item-sala-option.option-select").off().on("click",selectSala);
}

//seleccionar salas
function selectSala(){
    var $input = $(this).find("input");
    var code = $(this).parents(".item-sala").eq(0).children(".tiles-body").eq(0).html();
    var sType = $("#tSala option:selected").text();

    var $selectedSala = $("#selected-sala");
    $selectedSala.find(".inner h3").html(code);
    $selectedSala.find(".inner p").html(sType);
    $selectedSala.find("#form-inter-sala").html($input);
    $(".btn-change-sala").removeAttr("disabled").removeClass("disabled");
    $("#modal-sala").modal('hide');
}

$(".btn-change-sala").on("click",function(){
    $("#form-inter-sala").submit();
});
