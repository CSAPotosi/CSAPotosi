$(document).ready(function(){
	//variables para guardar los inputs de id_cuenta, codigo, nombre
	var codigo=null;

	$(".codigoinput").on('dblclick',function(){
		$('#modalListaCuenta').modal('show');
		codigo=$(this);
	});
	
	$(".id_cuenta").on("click",function(){
		codigo.val($(this).text().trim());
		$('#modalListaCuenta').modal('hide')
	});
});
	