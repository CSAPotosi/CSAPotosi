//variables para guardar los inputs de id_cuenta, codigo, nombre
var id_cuenta = null;
var codigo = null;
var nombrecuenta = null;

$("#btn-add-cuentavalor").on("click",function(){
	var index = $("#DetalleDeCuentas>tbody>tr:last").data("index");
	var nuevo = $("#DetalleDeCuentas>tbody>tr:last").clone(true);
	nuevo.data("index",index+1);
	nuevo.find("input").each(function(){
		$(this).attr("name",$(this).attr("name").replace("["+index+"]","["+(index+1)+"]"));
		$(this).attr("id",$(this).attr("id").replace("_"+index+"_","_"+(index+1)+"_"));
	});
	nuevo.find("input").val("");
	$("#DetalleDeCuentas tbody").append(nuevo);
});

$("#btn-remove-cuentavalor").on("click",function(){
	var ultimo = $("#DetalleDeCuentas>tbody>tr:last");
	var indice = ultimo.data("index");
	if (indice>0)
		ultimo.remove();
});

$(".codigoinput").on('focusout',function(){
	var codigoescrito = ($(this).val());
	var celdadelcodigo = $("#"+codigoescrito);
	//se selecciona fila actual de inputs
	id_cuenta = $(this).prev();
	codigo = $(this);
	nombrecuenta = $(this).closest("td").next().children();
	//asigno valores
	id_cuenta.val(celdadelcodigo.data("idcuenta"));
	nombrecuenta.val(celdadelcodigo.next().text());
});

$(".codigoinput").on('dblclick',function(){
	$('#modalListaCuenta').modal('show');
	//se selecciona fila actual de inputs
	id_cuenta = $(this).prev();
	codigo = $(this);
	nombrecuenta = $(this).closest("td").next().children();
});

$(".id_cuenta").on("click",function(){
	id_cuenta.val($(this).data("idcuenta"));
	codigo.val($(this).text().trim());
	nombrecuenta.val($(this).next().text());
	$('#modalListaCuenta').modal('hide')
});

$("#DetalleDeCuentas").on("change","input.debito", function() {
	var suma=0;
	$("#DetalleDeCuentas input.debito").each(function(indice,elemento){
		if($.isNumeric($(elemento).val()))
			suma+=parseInt($(elemento).val());
	});
	$("#debitos").text(suma);
});
$("#DetalleDeCuentas").on("change","input.credito", function() {
	var suma=0;
	$("#DetalleDeCuentas input.credito").each(function(indice,elemento){
		if($.isNumeric($(elemento).val()))
			suma+=parseInt($(elemento).val());
	});
	$("#creditos").text(suma);
});
