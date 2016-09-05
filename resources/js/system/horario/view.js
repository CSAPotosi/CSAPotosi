var currentP = null;

var ciclo = parseInt($("#ciclo").attr("data-ciclo"));

$(".spinner-both").spinner({
    color:"#ffffff",
    min:0,
    step:5
});

$(".clockpicker").clockpicker({
    placement:'top'
});

$(".item-periodo").on("click",function(){
    $(this).siblings().removeClass("item-periodo-selected");
    $(this).toggleClass("item-periodo-selected");

    if($(this).hasClass("item-periodo-selected")){
        currentP = $(this);
    }else{
        currentP = null;
    }
});

$("#table-horario>tbody tr>td").hover(function(){
    var index = $(this).index()-1;
    $("#table-horario>tbody tr").each(function(){
        $(this).children("td").eq(index).addClass("column-hover");
    });
},function(){
    $("#table-horario>tbody tr>td").removeClass("column-hover");
});

$(".lapse a").on("click",function(e){
    $(this).parents(".lapse").remove();
    rename();
    e.preventDefault();
});

$("#table-horario>tbody tr>td").on("click",function(){
    if(currentP != null){
        var lapse = getLapseJson(currentP);
        lapse.day = $(this).index();
        renderLapse(lapse);
    }else{
        alert("debe seleccionar un elemento");
    }
});

$.each(lapses,function(i,item){
    renderLapse(item);
});

function renderLapse(data){
    if(findLapses(data)){
        alert("No se puede");
        return false;
    }
    var data_2=null;
    var $new_lapse = null;
    var $cell = $("#table-horario>tbody>tr").eq(0).children("td").eq(data.day-1);
    var width = $cell.width();
    var unitHeight = $cell.parent("tr").height()/60;
    if(data.startMin + data.lenMin > 1440){
        $new_lapse = $("#templates").children(".lapse-partial").clone(true);
        data_2 = {
            periodo:data.periodo,
            startMin:0,
            day:(data.day % ciclo)+1,
            lenMin:data.lenMin
        };
        data.lenMin = 1440 - data.startMin;
        data_2.lenMin = data_2.lenMin - data.lenMin;
        $new_lapse.children(".block-lapse-end").width(width).height(unitHeight*data_2.lenMin)
            .attr("data-start",data_2.startMin).attr("data-len",data_2.lenMin).attr("data-day",data_2.day);
        $new_lapse.children("[id $= 'periodo']").val(data_2.periodo);
        $new_lapse.children("[id $= 'dia']").val(data_2.day);
    }
    else{
        $new_lapse = $("#templates").children(".lapse-full").clone(true);
    }
    $new_lapse.children(".block-lapse").width(width).height(unitHeight*data.lenMin)
        .attr("data-start",data.startMin).attr("data-len",data.lenMin).attr("data-day",data.day);
    $new_lapse.children("[id $= 'periodo']").val(data.periodo);
    $new_lapse.children("[id $= 'dia']").val(data.day);

    $("#form-edit-lapse").append($new_lapse);

    var pos = $cell.offset();
    pos.left=pos.left+(parseFloat($cell.css("padding-left")));
    pos.top += (unitHeight*data.startMin);
    $new_lapse.children(".block-lapse").offset(pos);

    if(data_2!=null){
        var $cell_2 = $("#table-horario>tbody>tr").eq(0).children("td").eq(data_2.day-1);
        var pos_2 = $cell_2.offset();
        pos_2.left=pos_2.left+(parseFloat($cell_2.css("padding-left")));
        pos_2.top += (unitHeight*data_2.startMin);
        $new_lapse.children(".block-lapse-end").offset(pos_2);
    }

    rename();
}

function findLapses(lapse){
    var ini = lapse.startMin;
    var fin = ini + lapse.lenMin;
    var day = lapse.day;
    var toReturn = false;
    if(fin > 1440){
        var ini_f = 0;
        var fin_f = fin - 1440;
        fin = 1440;
        var day_f = (day % ciclo)+1;
        $(".block[data-day="+ day_f +"]").each(function () {
            var m_ini = parseInt($(this).attr("data-start"));
            var m_fin = m_ini + parseInt($(this).attr("data-len"));

            if ( !(((ini_f>=m_ini&&ini_f>=m_fin)&&(fin_f>=m_ini&&fin_f>=m_fin))||((ini_f<=m_ini&&ini_f<=m_fin)&&(fin_f<=m_ini&&fin_f<=m_fin)))){
                toReturn = true;
                return false
            }
        });
    }
    $(".block[data-day="+ day +"]").each(function () {
        var m_ini = parseInt($(this).attr("data-start"));
        var m_fin = m_ini + parseInt($(this).attr("data-len"));
        if  ( !(((ini>=m_ini&&ini>=m_fin)&&(fin>=m_ini&&fin>=m_fin))||((ini<=m_ini&&ini<=m_fin)&&(fin<=m_ini&&fin<=m_fin)))){
            toReturn = true;
            return false;
        }
    });
    return toReturn;
}

function getLapseJson($item){
    var start = parseInt($item.attr("data-start_min"));
    var end = parseInt($item.attr("data-end_min"));
    var extra = 1440*parseInt($item.attr("data-type"));
    var lapse;
    lapse = {
        periodo: $item.attr("data-periodo"),
        startMin: start,
        lenMin: end + extra - start,
        day:0
    };
    return lapse;
}

function rename(){
    $("#form-edit-lapse>.lapse").each(function(i){
        $(this).children("[id$='periodo']")
            .attr("name","HorarioPeriodo["+i+"][id_periodo]")
            .attr("id","HorarioPeriodo_"+i+"_id_periodo");
        $(this).children("[id$='dia']")
            .attr("name","HorarioPeriodo["+i+"][dia]")
            .attr("id","HorarioPeriodo_"+i+"_dia");
    });
}