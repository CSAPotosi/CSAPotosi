$(document).ready(function(){
	$("#buttonpdf").on("click",function(){
		var content = $("#report").html();
		content = content.replace('reportButton', 'invisible');
		$("#hiddenpdf").val(content);
	});
});