jQuery(document).ready(function ($) {

    $('[data-toggle="tooltip"]').tooltip();

    var text = "Данные успешно сохраненны!";

    $('#submit-btn').click(function(e) {
        e.preventDefault();
        tinyMCE.triggerSave();
        var dataForm = $('#form-tabs').serialize();
        var data = {
            'action': 'myajax',
            'data': dataForm
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Все успешно сохранилось!");
        });
    });

    $('#table-field-submit-btn').click(function(e) {
        e.preventDefault();
        var dataFormField = $('#table-field-submit').serialize();
        var data = {
            'action': 'fieldajax',
            'data': dataFormField
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Данные полей изменены!");
        });
    });

    $('#style-submit-btn').click(function(e) {
        e.preventDefault();
        tinyMCE.triggerSave();
        var dataFormStyle = $('#form-style').serializeArray();
        var data = {
            'action': 'styleajax',
            'data': dataFormStyle
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Стили сохранены!");
        });
    });

    clickChangeOn('garant');
    clickChangeOn('bay');
    clickChangeOn('delivery');

    function eventMiniModal(formText) {
        $('.block-modal-alert .alert').addClass('d-flex');
        $('.block-modal-alert .alert').text(formText);
        setTimeout(function () { $('.alert').removeClass('d-flex'); }, 3000);
    };

    function clickChangeOn(e){
        if($('.check-' + e).prop('checked')){
            $('.tabs-check-' + e).removeClass('d-none');
            // $('.check-' + e).val('yes');
        }else{
            $('.tabs-check-' + e).addClass('d-none');
            // $('.check-' + e).val('no');
        }
    }
    // Click element checkbox and show block tabs.
    function clickChange(event) {
        if($('.check-' + event.data.name).prop('checked')){
            $('.tabs-check-' + event.data.name).removeClass('d-none');
        }else{
            $('.tabs-check-' + event.data.name).addClass('d-none');
        }

    };

    $('.check-garant').on('click', { name: "garant" }, clickChange);
    $('.check-bay').on('click', { name: "bay" }, clickChange);
    $('.check-delivery').on('click', { name: "delivery" }, clickChange);

    $('.dropdown-toggle').dropdown('toggle');


    $('.last-check').change(function (e) {
        if(e.currentTarget.classList[1] == 'last-check' && e.target.checked){
            e.currentTarget.offsetParent.previousElementSibling.childNodes[0].checked = true;
        }
    });

    v
});