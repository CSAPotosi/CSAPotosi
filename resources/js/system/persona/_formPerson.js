$(document).ready(function () {
    pageSetUp();

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
            }
        },
        messages: {
            num_doc: {
                required: "Este campo es necesario"
            },
            nombres: {
                required: "El nombre es Obligatorio"
            },
            primer_apellidos: {
                required: "El apellido es necesario"
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
    $('#bootstrap-wizard-1').bootstrapWizard({
        'tabClass': 'form-wizard',
        'onNext': function (tab, navigation, index) {
            var $valid = $("#wizard-1").valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            } else {
                $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                    'complete');
                $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                    .html('<i class="fa fa-check"></i>');
            }
        }
    });
});
/**
 * Created by cristian on 08/06/2016.
 */
