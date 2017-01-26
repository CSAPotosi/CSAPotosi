$("#modal-quirofano").on("show.bs.modal",getSalas);
$("#tSala").on('change',getSalas);

//llamar salas
function getSalas(){
    var id_t_sala = $("#tSala").val();
    var url = $("#modal-quirofano").data("url");
    $("#modal-quirofano .modal-body .well").load(url,{id: id_t_sala},eventHandlersSalaItem);
}

//agregar eventos
function eventHandlersSalaItem(){
    $("#modal-quirofano .modal-body .well").find("#ninguno").remove();
    $(".item-sala").off().on("click",function(){
        return false;
    });
    $(".item-sala .item-sala-option.option-select").off().on("click",selectSala);
}

//seleccionar salas
function selectSala(){
    var value = $(this).find("input").val();
    var code = $(this).parents(".item-sala").eq(0).children(".tiles-body").eq(0).html().trim();
    var sType = $("#tSala option:selected").text();
    $("#quirofano").val(code + " ( "+sType+" )");
    $("#Cirugia_id_sala").val(value);
    $("#modal-quirofano").modal('hide');
}

$("#modal-paciente").on("show.bs.modal",getPacientes);

//traer pacientes
function getPacientes(){
    var url = $("#modal-paciente").data("url");
    $("#modal-paciente .modal-body .well").load(url,{id: 0},eventHandlersPaciente);
}

function eventHandlersPaciente(){
    $(".select-person").off().on("click",function () {
        var id_p = $(this).data("id");
        var nombre = $(this).data("name");
        var doc = $(this).data("doc");
        $("#paciente").val(nombre + " ( "+doc+" )");
        $("#Cirugia_id_historial").val(id_p);
        $("#modal-paciente").modal('hide');
    });
}

$("#Cirugia_tiempo_estimado").TouchSpin({
    min: 0,
    max: 1000,
    step: 5,
    verticalbuttons: true
});