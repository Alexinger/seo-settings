jQuery(document).ready(function ($) {

    $('[data-toggle="tooltip"]').tooltip();
    $('.x-row').addClass('row');

    var text = "Данные успешно сохраненны!";

    $('#submit-btn').click(function (e) {
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

    $('#table-field-submit-btn').click(function (e) {
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

    $('#style-submit-btn').click(function (e) {
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
        setTimeout(function () {
            $('.alert').removeClass('d-flex');
        }, 3000);
    };

    function clickChangeOn(e) {
        if ($('.check-' + e).prop('checked')) {
            $('.tabs-check-' + e).removeClass('d-none');
            // $('.check-' + e).val('yes');
        } else {
            $('.tabs-check-' + e).addClass('d-none');
            // $('.check-' + e).val('no');
        }
    }

    // Click element checkbox and show block tabs.
    function clickChange(event) {
        if ($('.check-' + event.data.name).prop('checked')) {
            $('.tabs-check-' + event.data.name).removeClass('d-none');
        } else {
            $('.tabs-check-' + event.data.name).addClass('d-none');
        }

    };

    $('.check-garant').on('click', {name: "garant"}, clickChange);
    $('.check-bay').on('click', {name: "bay"}, clickChange);
    $('.check-delivery').on('click', {name: "delivery"}, clickChange);

    $('.dropdown-toggle').dropdown('toggle');


    $('.last-check').change(function (e) {
        if (e.currentTarget.classList[1] == 'last-check' && e.target.checked) {
            e.currentTarget.offsetParent.previousElementSibling.childNodes[0].checked = true;
        }

    });

    // Remove counter yandex in sites
    $('.removeCounterYandex').click(function () {
        $('.fieldCounterYandex').removeClass('d-none');
        $(this).addClass('d-none');
    });

    // Added option counter Yandex
    $(document).on( 'click','.btnSaveYandex', function (event) {
        event.preventDefault();
        let input_val = document.getElementById('countPutYandex').value;
        let name_option = 'counter_code_yandex';
        if(input_val) {
            updateOptionYandex(name_option, input_val);
        }
    });

    function updateOptionYandex($option, $new_value) {
        var data = {
            action: 'save_yandex',
            option: $option,
            new_value: $new_value
        };

        $.post(ajaxurl, data, function (response) {
            alert('Код счетсчика успешно изменен!');
            window.location.reload();
        });
    }

    // Remove counter google in sites
    $('.removeCounterGoogle').click(function () {
        $('.fieldCounterGoogle').removeClass('d-none');
        $('.removeCounterGoogle').addClass('d-none');
    });

    // Added option counter Google
    $(document).on( 'click','.btnSaveGoogle', function (event) {
        event.preventDefault();
        let input_val = document.getElementById('countPutGoogle').value;
        let name_option = 'counter_code_google';
        if(input_val) {
            updateOptionGoogle(name_option, input_val);
        }
    });

    function updateOptionGoogle($option, $new_value) {
        var data = {
            action: 'save_google',
            option: $option,
            new_value: $new_value
        };

        $.post(ajaxurl, data, function (response) {
            alert('Код Google счетсчика успешно изменен!');
            window.location.reload();
        });
    }

    /*Event click button check page and post*/
    $(document).on('keyup paste input', '.contenteditable', function (event) {

        // let x = document.getElementsByClassName('editFieldsTasks')[0];
        // let idProduct = document.getElementsByClassName("idProduct")[0];

        let checkButton = 'checkbox-result_' + this.id;
        let set = document.getElementById(this.id);
        // console.log(set);
        let checkTrue = document.getElementsByClassName(checkButton)[0];

        if(set.textContent.length > 0){
            checkTrue.classList.add('fa-close');
            checkTrue.classList.add('fa-danger');
            checkTrue.classList.remove('fa-check');
            checkTrue.classList.remove('text-success');
        }else{
            checkTrue.classList.remove('fa-close');
            checkTrue.classList.remove('fa-danger');
            checkTrue.classList.add('fa-check');
            checkTrue.classList.add('text-success');
        }
    });

    // $('body').on('focus', '[contenteditable]', function() {
    //     const $this = $(this);
    //     $this.data('before', $this.html());
    // }).on('blur keyup paste input', '[contenteditable]', function() {
    //     const $this = $(this);
    //     if ($this.data('before') !== $this.html()) {
    //         $this.data('before', $this.html());
    //         $this.trigger('change');
    //     }
    // });

    $('form').submit(function(e){
        // e.preventDefault();

        // $.ajax({
        //     type: "POST",
        //     url: "post.php",
        //     datatype: "text",
        //     data: {enter : $("#enter").val() },
        //     success: function(data) {
        //         console.log(data);
        //     }
        // });
    });

    // // Added option counter Google
    // $(document).on( 'click','.btnSaveShortcode', function (event) {
    //     event.preventDefault();
    //     let input_val = document.getElementById('countPutGoogle').value;
    //     let name_option = 'counter_code_google';
    //     if(input_val) {
    //         updateOptionShortcode(name_option, input_val);
    //     }
    // });
    //
    // function updateOptionShortcode($option, $new_value) {
    //     var data = {
    //         action: 'save_google',
    //         option: $option,
    //         new_value: $new_value
    //     };
    //
    //     $.post(ajaxurl, data, function (response) {
    //         alert('Код Google счетсчика успешно изменен!');
    //         window.location.reload();
    //     });
    // }

    function updateOptionShortcode($option, $new_value, $msg = 'Все отлично сохранилось!') {
        var data = {
            action: 'save_shortcode',
            option: $option,
            new_value: $new_value
        };

        $.post(ajaxurl, data, function (response) {
            alert($msg);
            window.location.reload();
        });
    }

    // Added option counter Google
    $(document).on( 'click','.btnSaveShortcode', function (event) {
        event.preventDefault();
        let input_url = document.getElementById('tabs-shortcode-url').value;
        let input_page = document.getElementById('tabs-shortcode-page').value;
        let name_option_url = 'tabs-shortcode-url';
        let name_option_page = 'tabs-shortcode-page';

        if(input_url && input_page) {
            updateOptionShortcode(name_option_url, input_url);
            updateOptionShortcode(name_option_page, input_page);
        }
    });

    // Added option On Off Google table
    $(document).on( 'click','.btnOnOffShortcode', function (event) {
        event.preventDefault();
        let getStatus = document.getElementById('on-off-class').value;
        if(!getStatus) {
            updateOptionShortcode('statusTable', 'textUnder', 'Google таблица отключена!');
        }else{
            updateOptionShortcode('statusTable', '', 'Google таблица снова включена!');
        }
    });

    // Added count day, when remove files in folder 'recvizit'
    $(document).on( 'click','.countDay', function (event) {
        event.preventDefault();
        let getStatus = document.getElementById('day_number').value;
        updateOptionShortcode('day_number', getStatus, 'Кол-во дней сохранено!');
    });

    // Saved fields AmoCrm email
    $(document).on( 'click','.btnSaveAmoCrmEmail', function (event) {
        event.preventDefault();
        let input_email = document.getElementById('amocrm-to-email').value;
        let name_option_email = 'amocrm-to-email';

        if(input_email) {
            updateOptionShortcode(name_option_email, input_email);
        }
    });

});
