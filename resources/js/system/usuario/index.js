var timeout = undefined;

$(document).ready(function () {
    getUsuarioListAjax();
});

function preLoad() {
    $("#btn-load-usuarios").attr("disabled", true)
        .html("<i class='fa fa-refresh fa-spin'></i> Cargando...");
}

function postLoad() {
    $("#btn-load-usuarios").attr("disabled", false).html("Ver mas");
}

function error() {
    alert("Ha ocurrido un error al momento de solicitar datos, por favor vuelva a intentar...");
}

function getUsuarioListAjax() {
    var pageAttr = $("#btn-load-usuarios").attr("page");
    var queryAttr = $("#input-search-usuarios").val();
    var statusAttr = $("#pick-status-usuario>li.active>a").attr("status");
    $.ajax({
        url: $("#btn-load-usuarios").attr("url"),
        data: {page: pageAttr, query: queryAttr, status: statusAttr},
        method: 'post',
        success: function (info) {
            var count_items = $("<div>" + info + "</div>").find(".col-md-4").length;

            $("#usuario-list").append(info);
            $("#btn-load-usuarios").attr("page", 1 + parseInt($("#btn-load-usuarios").attr("page")));

            if (count_items < $("#btn-load-usuarios").attr("limit"))
                $("#btn-load-usuarios").hide();

        },
        beforeSend: preLoad,
        complete: postLoad,
        error: error
    });
}

function newAjaxRequest() {
    $("#usuario-list>.col-md-4").remove();
    $("#btn-load-usuarios").attr("page", "0").show();
    getUsuarioListAjax();
}


//disparadores
$("#btn-load-usuarios").on("click", function () {
    getUsuarioListAjax();
});

$("#input-search-usuarios").on("keyup", function (e) {
    if ((e.keyCode >= 32 && e.keyCode <= 126) || e.keyCode == 13 || e.keyCode == 8) {
        if (timeout != undefined)
            clearTimeout(timeout);
        timeout = setTimeout(function () {
            newAjaxRequest();
        }, 1000);
    }
});

$("#pick-status-usuario a").on("click", function () {
    var selText = $(this).text();
    var $this = $(this);
    $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
    $this.parents('.dropdown-menu').find('li').removeClass('active');
    $this.parent().addClass('active');
    newAjaxRequest();
});

