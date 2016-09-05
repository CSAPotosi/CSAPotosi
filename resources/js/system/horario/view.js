$(document).ready(function(){
    $('input:checkbox').each(function(){
        var self = $(this),
            label = self.next(),
            label_text = label.text();

        label.remove();
        self.iCheck({
            checkboxClass: 'icheckbox_line-blue',
            insert: '<div class="icheck_line-icon"></div>' + label_text
        });
    });
});