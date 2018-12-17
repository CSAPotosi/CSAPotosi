$(document).ready(function(){
	//variables para guardar los inputs de id_cuenta, codigo, nombre
	
	$(".codigoinput").on('dblclick',function(){
		$('#modalListaCuenta').modal('show');
	});
	
	$(".id_cuenta").on("click",function(){
		$('#id_cuenta').val($(this).data("idcuenta"));
		$('.codigoinput').val($(this).text().trim());
		$('#modalListaCuenta').modal('hide')
	});
	
});
	