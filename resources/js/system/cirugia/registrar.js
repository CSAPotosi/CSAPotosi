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

$("#add-p").on("click",function () {
    var $newItem = $("#template").find(".row").clone(true);
    $("#personal").append($newItem);
    rename();
});

$(".remove-p").off().on("click",function(){
    $(this).closest(".row").remove();
    rename();
});

function rename(){
    $("#personal").children(".row").each(function(i){
        $(this).find("[name $= '[id_per]']").attr('name', 'PersonalCirugia['+i+'][id_per]');
        $(this).find("[name $= '[rol_cirugia]']").attr('name', 'PersonalCirugia['+i+'][rol_cirugia]');
        $(this).find("[name $= '[responsable]']").attr('name', 'PersonalCirugia['+i+'][responsable]');
    });
}

$(".responsable").on('click',function () {
    $(".responsable").not(this).removeAttr('checked');
});

$("#modal-personal").on("show.bs.modal",getPersonal);
$("#modal-personal").on("hidden.bs.modal",function () {
    $(".btn-select-p").removeClass('selected');
});
//traer pacientes
function getPersonal(){
    var url = $("#modal-personal").data("url");
    $("#modal-personal .modal-body .well").load(url,{id: 0},eventHandlersPersonal);
}

$(".btn-select-p").on('click',function () {
    $(".btn-select-p").removeClass('selected');
    $(this).addClass('selected');
});

function eventHandlersPersonal(){
    $(".select-person").off().on("click",function () {
        var id_p = $(this).data("id");
        var nombre = $(this).data("name");
        var doc = $(this).data("doc");
        if($("#personal").find("input[type=hidden][name $= '[id_per]' ][value = "+id_p+"]").length==0){
            var group = $('.btn-select-p.selected').eq(0).closest('.input-group');
            group.find('input[type=text]').val(nombre + " ( "+doc+" )");
            group.find('input[type=hidden]').val(id_p);
            $("#modal-personal").modal('hide');
        }
        /*
        $("#paciente").val(nombre + " ( "+doc+" )");
        $("#Cirugia_id_historial").val(id_p);
        */
    });
}