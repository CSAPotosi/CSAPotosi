var json_def = null;
$(document).ready(function () {
    json_def = JSON.parse($("#Parametro_def_par").val());
    formBuilder();
    checkParamType();
});

$("#param_type").on("change",function(){
    json_def = {};
    json_def.type = $(this).val();
    formBuilder();
});

$(".numeric .has-range").on("click",function(){
    if($(this).prop("checked"))
        json_def.range = {"min":null,"max":null};
    else
        delete json_def.range;
    formBuilder();
});

$(".numeric .input-range").on("keyup",function(){
    var value = $(this).val();
    if(!$.isNumeric(value))
        if($(this).hasClass('input-range-min'))
            json_def.range.min = null;
        else
            json_def.range.max = null;
    if($(this).hasClass('input-range-min'))
        json_def.range.min = Number(value);
    else
        json_def.range.max = Number(value);
    validate();
    $("#Parametro_def_par").val(JSON.stringify(json_def));
});
$(".list .btn-add-item").on("click",function(){
    var value = $(this).closest(".list").find(".input-add-item").eq(0).val();
    if(value.length > 0){
        if(!("list" in json_def))
            json_def.list = [];
        if($.inArray(value,json_def.list)==-1)
            json_def.list.push(value);
        $(this).closest(".list").find(".input-add-item").eq(0).val("");
        formBuilder();
    }
    return false;
});

$(".item .remove-item-list").on("click",function(){
    var value = $(this).closest(".item").find(".texto").eq(0).text();
    var index = json_def.list.indexOf(value);
    if(index != -1)
        json_def.list.splice(index,1);
    formBuilder();
    return false;
});
function formBuilder(){
    $("#param_type").val(json_def.type);
    switch (json_def.type){
        case "numeric":
            var $template = $("#templates .numeric").clone(true);
            if("range" in json_def){
                $template.find(".input-range").prop("disabled",false);
                $template.find(".has-range").prop("checked",true);
                $template.find(".input-range-min").val(json_def.range.min);
                $template.find(".input-range-max").val(json_def.range.max);
            }else{
                $template.find(".input-range").prop("disabled",true);
                $template.find(".has-range").prop("checked",false);
            }
            $(".param_def_options").html($template);
            break;
        case "list":
            var $template = $("#templates .list").clone(true);
            var list = [];
            if("list" in json_def)
                list = json_def.list;
            for(var item in list){
                var $templateItem = $("#templates .item").clone(true);
                $templateItem.find(".texto").text(list[item]);
                $template.find(".item-list").append($templateItem);
            }
            $(".param_def_options").html($template);
            delete json_def.range;
            break;
        default:
            $(".param_def_options").children().remove();
            delete json_def.range;
            break;
    }

    $("#Parametro_def_par").val(JSON.stringify(json_def));
    validate();
}

$("form").on("submit",function(){
    return validate();
});
function validate(){
    $(".input-error").text("");
    var flag = true;
    if("range" in json_def){
        if(json_def.range.min == null || json_def.range.max == null){
            flag = false;
            $(".input-error").text("Algun limite es ingresado es invalido");
        }
    }
    if(json_def.type == "list"){
        if(("list" in json_def) && json_def.list.length == 0){
            flag = false;
            $(".input-error").text("No existen suficientes elementos en la lista");
        }
        if(!("list" in json_def)){
            flag = false;
            $(".input-error").text("No existen suficientes elementos en la lista");
        }
    }
    return flag;
}

$("#Parametro_tipo_par").on("change",checkParamType);

function checkParamType(){
    var type = $("#Parametro_tipo_par").val();
    if(type == 0){
        $("#Parametro_val_ref").closest(".row").removeClass("hide");
    }else{
        $("#Parametro_val_ref").closest(".row").addClass("hide");
    }
}