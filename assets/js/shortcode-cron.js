
jQuery(document).ready(function ($) {

    var count = 0;

    $('#form-send-cron').click(function (e) {
        e.preventDefault();
        var dataForm = $('#wp-cron').serialize();
        var data = {
            'action': 'cron',
            'data': dataForm
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Все отправлено!");
        });
    });

    $('#form-create-shortcode').click(function (e) {
        e.preventDefault();
        var dataForm = $('#extra-shortcode').serialize();
        var data = {
            'action': 'create_shortcode',
            'data': dataForm
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Шорткод сохранен!");
        });
    });

    function eventMiniModal(formText) {
        $('.block-modal-alert .alert').addClass('d-flex');
        $('.block-modal-alert .alert').text(formText);
        setTimeout(function () { $('.alert').removeClass('d-flex'); }, 3000);
    };

    var count = parametr.count - 1;
    $('#added-shortcode-fields').click(function () {
        var param = parametr.date;
        count++;
        var countLine = $('.line-field-shortcode');
        var content = "<div class='row col-12 line-field-shortcode'>\n" +
            "<div class='col-6'>" +
            "<div class='d-flex align-items-baseline my-2'>" +
            "<label for='formShortcodeTitle-" + count + "' class='mr-3 text-info'>Название</label>" +
            "<input type='text' class='form-control' id='formShortcodeTitle-" + count + "' name='title-shortcode-" + count + "' placeholder='Название шорткода' value='" + param + "'>" +
            "</div>" +
            "</div>" +
            "<div class='col-6'>" +
            "<div class='d-flex align-items-baseline my-2'>" +
            "<label for='formShortcodeParam-" + count + "' class='mr-3 text-info'>Параметры</label>" +
            "<input type='text' class='form-control' id='formShortcodeParam-" + count + "' placeholder='Параметры'>" +
            "</div>" +
            "</div>" +
            "<i class='fa fa-times text-danger position-absolute fa-2x d-flex align-self-center' title='удалить'></i>" +
            "</div>" +
            "<input type='hidden' name='count' value='" + countLine.length + "'>";

        if($('div.line-field-shortcode')){
            $('div.line-field-shortcode').last().after(function () {
                return content;
            });
        }else {
            // $('#added-shortcode-fields').lastChild().after(function () {
            //     return content;
            // });
        }

    });

    $('div').on('click', 'i.fa-times', function (e) {
        var set = $('.line-field-shortcode');
        if(set.length > 1){
            e.target.offsetParent.remove();
        }
        return;
    });

});

