$("#btnEnviarUpdate").click(function () {
    $("#PersonaForm_responsable").val($("#contacto").val() + "-" + $("#parentesco").val() + "-" + $("#telefono").val() + "-" + $("#direccion").val())
})
