jQuery('select').niceSelect();
jQuery('.radioinput').customInput();
jQuery('.radioinput2').customInput();
// jQuery('[data-toggle="tooltip"]').tooltip();
jQuery('.datetimepicker1').datetimepicker(
    {
        locale: 'vi',
        useCurrent: true,
        minDate: 'now',
        format: 'DD/MM/YYYY',
    }
);