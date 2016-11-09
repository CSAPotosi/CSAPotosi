var timeout = undefined;

$(document).ready(function () {
    getEmpleadoListAjax();
});

function preLoad() {
    $("#btn-load-patients").attr("disabled", true)
        .html("<i class='fa fa-refresh fa-spin'></i> Cargando...");
}

function postLoad() {
    $("#btn-load-patients").attr("disabled", false).html("Ver mas");
}

function error() {
    alert("Ha ocurrido un error al momento de solicitar datos, por favor vuelva a intentar...");
}

function getEmpleadoListAjax() {
    var pageAttr = $("#btn-load-patients").attr("data-page");
    var queryAttr = $("#input-search-empleados").val();
    $.ajax({
        url: $("#btn-load-patients").attr("data-url"),
        data: {page: pageAttr, query: queryAttr},
        method: 'post',
        success: function (info) {
            var count_items = $("<div>" + info + "</div>").find(".col-md-4").length;

            $("#empleado-list").append(info);
            $("#btn-load-patients").attr("data-page", 1 + parseInt($("#btn-load-patients").attr("data-page")));

            if (count_items < $("#btn-load-patients").attr("data-limit"))
                $("#btn-load-patients").hide();

        },
        beforeSend: preLoad,
        complete: postLoad,
        error: error
    });
}

function newAjaxRequest() {
    $("#empleado-list>.col-md-4").remove();
    $("#btn-load-patients").attr("data-page", "0").show();
    getEmpleadoListAjax();
}


//disparadores
$("#btn-load-patients").on("click", function () {
    getEmpleadoListAjax();
});

$("#input-search-empleados").on("keyup", function (e) {
    if ((e.keyCode >= 32 && e.keyCode <= 126) || e.keyCode == 13 || e.keyCode == 8) {
        if (timeout != undefined)
            clearTimeout(timeout);
        timeout = setTimeout(function () {
            newAjaxRequest();
        }, 1000);
    }
});
