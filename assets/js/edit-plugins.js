jQuery(document).ready(function ($) {

    $('[data-toggle="popover"]').popover();

    $('ul').on('hover', 'li.list-group-item', function (e) {
        $(e.currentTarget.children[0].children[1]).toggleClass('hidden');
    });

    $('ul').on('click', 'i.fa-times', function (e) {
        e.target.offsetParent.remove();
    });

    // При потере фокуса, убираем обводку текста
    $('ul').on('blur', 'input.no-active-fields, input.active-fields', function(e){
        var get_edit_text = e.currentTarget.offsetParent.firstElementChild.firstElementChild;
        get_edit_text.setAttribute('readonly', 'readonly');
        get_edit_text.classList.remove('active-fields');
        get_edit_text.classList.add('no-active-fields');

        // удаляем иконку 'check' и ставим иконку 'edit'
        var check = get_edit_text.nextElementSibling.firstElementChild;
        check.classList.remove('fa-check');
        check.classList.add('fa-edit');
    });

    // При клике на клавише Enter, убираем возможность редактирования поля
    $('ul').on('keypress', 'input.no-active-fields, input.active-fields', function(e){
        if(e.which == 13){
            var get_edit_text = e.currentTarget.offsetParent.firstElementChild.firstElementChild;
            get_edit_text.setAttribute('readonly', 'readonly');
            get_edit_text.classList.remove('active-fields');
            get_edit_text.classList.add('no-active-fields');

            var check = get_edit_text.nextElementSibling.firstElementChild;
            check.classList.remove('fa-check');
            check.classList.add('fa-edit');
        }
    });

    $('ul').on('keypress', 'input.fields-path-plugin', function(e){
        if(e.which == 13){
            var get_edit_text = e.currentTarget.offsetParent.firstElementChild.lastElementChild.firstElementChild;
            get_edit_text.setAttribute('readonly', 'readonly');
            get_edit_text.classList.remove('active-fields');
            get_edit_text.classList.add('no-active-fields');
        };
    });


    // При нажатии на иконку редактирование строки, устанавливается фокус и меняет иконка c 'edit' на 'check'
    $('ul').on('click', 'i.fa-edit', function (e) {
        var get_edit_text = e.currentTarget.offsetParent.firstElementChild.firstElementChild;
        get_edit_text.removeAttribute('readonly');
        get_edit_text.classList.remove('active-fields');
        get_edit_text.classList.add('no-active-fields');
        get_edit_text.focus();

        // меняем иконку с 'edit' на 'check'
        var get_edit_ok_class = e.currentTarget;
        get_edit_ok_class.classList.remove('fa-edit');
        get_edit_ok_class.classList.add('fa-check');
    });

    // При нажатии на иконку чек строки меняем иконку c 'check' на 'edit'
    $('ul').on('click', 'i.fa-check', function (e) {
        var get_edit_text = e.currentTarget.offsetParent.firstElementChild.firstElementChild;
        get_edit_text.classList.add('no-active-fields');
        get_edit_text.classList.remove('active-fields');
        get_edit_text.setAttribute('readonly', 'readonly');

        // меняем иконку с 'check' на 'edit'
        console.log(e.currentTarget)
        // var get_edit_ok_class = e.currentTarget;
        // get_edit_ok_class.classList.add('fa-edit');
        // get_edit_ok_class.classList.remove('fa-check');
    });


    // При потере фокуса, убираем обводку текста для редактирования путей плагина
    $('ul').on('blur', 'input.fields-path-plugin', function(e){
        var get_edit_text = e.currentTarget.offsetParent.firstElementChild.lastElementChild.firstElementChild;
        get_edit_text.setAttribute('readonly', 'readonly');
        get_edit_text.classList.remove('active-fields');
        get_edit_text.classList.add('no-active-fields');
    });



    // По клику на иконке 'fa-arrow-right' показывать дополнительное поле для указания пути к плагину.
    $('ul').on('click', 'i.fa-pencil', function (e) {
        var get_edit_text = e.currentTarget.offsetParent.firstElementChild.lastElementChild.firstElementChild;
        get_edit_text.removeAttribute('readonly');
        get_edit_text.classList.remove('active-fields');
        get_edit_text.classList.add('no-active-fields');
        get_edit_text.focus();
    });

    // Событие при смене иконки с 'check' на 'edit', убираем возможность редактировать поле и удаляем класс подсветки.
    $('ul').on('click', 'i.fa-check', function (e) {
        var get_edit_ok_class = e.currentTarget;
        get_edit_ok_class.classList.remove('fa-check');
        get_edit_ok_class.classList.add('fa-edit');

        var get_edit_text = e.currentTarget.offsetParent.firstElementChild.firstElementChild;
        get_edit_text.removeAttribute('disabled');
        get_edit_text.classList.remove('active-fields');
    });

    function removeEditInput(target) {
        return target.removeAttr('readonly');
    }
    function addedEditInput() {

    }

        var count = parseInt(parametr.db_count);
        $('.my-btn-new-field').click(function () {
        count++;
        var content = "<li class='list-group-item d-flex align-items-center justify-content-between'>" +
            "<div>" +
                "<span contenteditable='false' class='new-fields' name='" + count + "'>Новая строка</span>" +
                "<span class='ml-3 hidden block-edit-remove'>" +
                    "<i class='fa fa-edit text-success mx-1' title='редактировать'></i>" +
                    "<i class='fa fa-times text-danger mx-1' title='удалить'></i>" +
                "</span>" +
            "</div>" +
			"<span>" +
				"<span class='badge badge-pill font-weight-light mx-1 badge-secondary' style='padding-bottom: 5px;'>Отсутсвует</span>" +
				"<span class='badge badge-pill font-weight-light mx-1 badge-secondary' style='padding-bottom: 5px;'>Не активирован</span>" +
			"</span>" +
		"</li>";

        $('li.list-group-item').eq(0).before(function () {
           return content;
        });
    });

    // $('.my-btn-save-field').click(function () {
    //     document.appendChild('<span class="alert alert-success">Тестовое сохранение изменений!!!</span>')
    //     // alert("Тестовое сохраненине изменений!!!");
    // });


    $('.my-btn-save-field').click(function(e) {
        e.preventDefault();
        var dataFormPlugin = $('#form-plugin').serialize();
        var data = {
            'action': 'pluginajax',
            'data': dataFormPlugin
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Все изменения сохранены!");
        });
    });
    $('#submit-load-plugin').click(function (e) {
        e.preventDefault();
        var dataLoadPlugin = $('.plugin-check').serialize();
        var data = {
            'action': 'loadplaginajax',
            'data': dataLoadPlugin
        };
        $.post(ajaxurl, data, function () {
            eventMiniModal("Плагины загружены в базу данных WP!");
        })
    })

    function eventMiniModal(formText) {
        $('.save-plugin-alert').addClass('d-flex')
        $('.save-plugin-alert').text(formText);
        setTimeout(function () { $('.save-plugin-alert').removeClass('d-flex'); }, 3000);
    };

    $('#collapseExtendedPlugins').on('hidden.bs.collapse', function () {
        $('.icon-extended').addClass('fa-angle-right');
        $('.icon-extended').removeClass('fa-angle-down');
    });

    $('#collapseExtendedPlugins').on('shown.bs.collapse', function () {
        $('.icon-extended').addClass('fa-angle-down');
        $('.icon-extended').removeClass('fa-angle-right');
    });

    if($('#collapseMainPlugins').hasClass('show')){
        $('.icon-main').addClass('fa-angle-down');
        $('.icon-main').removeClass('fa-angle-right');
    }
    99
    $('#collapseMainPlugins').on('hidden.bs.collapse', function () {
            $('.icon-main').addClass('fa-angle-right');
            $('.icon-main').removeClass('fa-angle-down');
    });

    $('#collapseMainPlugins').on('shown.bs.collapse', function () {
        $('.icon-main').addClass('fa-angle-down');
        $('.icon-main').removeClass('fa-angle-right');
    });

});