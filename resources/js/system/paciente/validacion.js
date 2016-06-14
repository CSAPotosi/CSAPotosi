$(document).ready(function () {
    pageSetUp();
    $("#num_doc").keyup(function () {
        $("#PersonaForm_num_doc").val(($(this).val()));
    });
    $("#nombres").keyup(function () {
        $("#PersonaForm_nombres").val(($(this).val()));
    });
    $("#primer_apellido").keyup(function () {
        $("#PersonaForm_primer_apellido").val(($(this).val()));
    });
    $("#fecha_nac").keyup(function () {
        $("#PersonaForm_fecha_nac").val($(this).val())
    });
    var $validator = $("#wizard-1").validate({
        rules: {
            num_doc: {
                required: true
            },
            nombres: {
                required: true
            },
            primer_apellido: {
                required: true
            },
            fecha_nac: {
                required: true
            }
        },
        messages: {
            num_doc: {
                required: "El Numero de Docuemnto es necesario"
            },
            nombres: {
                required: "El Nombre es requerido"
            },
            primer_apellido: {
                required: "El Apellido es necesario"
            },
            fecha_nac: {
                required: "La Fecha de Nacimiento es necesario"
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});
