
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

    var canvas1 = document.getElementById('canvas-tmp-1'),
        canvas2 = document.getElementById('canvas-tmp-2'),
        canvas3 = document.getElementById('canvas-tmp-3'),
        canvas4 = document.getElementById('canvas-tmp-4'),
        canvas5 = document.getElementById('canvas-tmp-5'),
        canvas6 = document.getElementById('canvas-tmp-6');

    var ctx1 = canvas1.getContext('2d'),
        ctx2 = canvas2.getContext('2d'),
        ctx3 = canvas3.getContext('2d'),
        ctx4 = canvas4.getContext('2d'),
        ctx5 = canvas5.getContext('2d'),
        ctx6 = canvas6.getContext('2d');

    // Template №1
    ctx1.strokeRect(0,0,200,180);
    // banner
    ctx1.beginPath();
    ctx1.rect(0, 0, 200, 30);
    ctx1.closePath();
    ctx1.fillStyle = "#d2d2d2";
    ctx1.fill();

    // ctx1.rotate(Math.PI/4);
    ctx1.fillStyle = "#000";
    ctx1.font = '14px Arial';
    ctx1.fillText("баннер", 75, 20);



    // menu
    ctx1.beginPath();
    ctx1.rect(0, 30, 200, 20);
    ctx1.closePath();
    ctx1.fillStyle = "#9393ff";
    ctx1.fill();
    ctx1.fillStyle = "#fff";
    ctx1.font = '14px Arial';
    ctx1.fillText("меню", 80, 44);

    // left sidebar
    ctx1.beginPath();
    ctx1.rect(0, 50, 50, 130);
    ctx1.closePath();
    ctx1.fillStyle = "#26292c";
    ctx1.fill();

    // footer
    ctx1.beginPath();
    ctx1.rect(0, 160, 200, 20);
    ctx1.closePath();
    ctx1.fillStyle = "grey";
    ctx1.fill();
    ctx1.fillStyle = "#fff";
    ctx1.font = '14px Arial';
    ctx1.fillText("подвал", 75, 174);

    // Template №2
    ctx2.strokeRect(0,0,200,180);
    // banner
    ctx2.beginPath();
    ctx2.rect(0, 0, 200, 30);
    ctx2.closePath();
    ctx2.fillStyle = "#d2d2d2";
    ctx2.fill();
    ctx2.fillStyle = "#000";
    ctx2.font = '14px Arial';
    ctx2.fillText("баннер", 75, 20);

    // menu
    ctx2.beginPath();
    ctx2.rect(0, 30, 200, 20);
    ctx2.closePath();
    ctx2.fillStyle = "#9393ff";
    ctx2.fill();
    ctx2.fillStyle = "#fff";
    ctx2.font = '14px Arial';
    ctx2.fillText("меню", 80, 44);


    // right sidebar
    ctx2.beginPath();
    ctx2.rect(150, 50, 50, 130);
    ctx2.closePath();
    ctx2.fillStyle = "#26292c";
    ctx2.fill();

    // footer
    ctx2.beginPath();
    ctx2.rect(0, 160, 200, 20);
    ctx2.closePath();
    ctx2.fillStyle = "grey";
    ctx2.fill();
    ctx2.fillStyle = "#fff";
    ctx2.font = '14px Arial';
    ctx2.fillText("подвал", 75, 174);

    // Template №3
    ctx3.strokeRect(0,0,200,180);
    // banner
    ctx3.beginPath();
    ctx3.rect(0, 0, 200, 30);
    ctx3.closePath();
    ctx3.fillStyle = "#d2d2d2";
    ctx3.fill();
    ctx3.fillStyle = "#000";
    ctx3.font = '14px Arial';
    ctx3.fillText("баннер", 75, 20);

    // menu
    ctx3.beginPath();
    ctx3.rect(0, 30, 200, 20);
    ctx3.closePath();
    ctx3.fillStyle = "#9393ff";
    ctx3.fill();
    ctx3.fillStyle = "#fff";
    ctx3.font = '14px Arial';
    ctx3.fillText("меню", 80, 44);

    // left sidebar
    ctx3.beginPath();
    ctx3.rect(0, 50, 50, 130);
    ctx3.closePath();
    ctx3.fillStyle = "#26292c";
    ctx3.fill();

    // right sidebar
    ctx3.beginPath();
    ctx3.rect(150, 50, 50, 130);
    ctx3.closePath();
    ctx3.fillStyle = "#26292c";
    ctx3.fill();

    // footer
    ctx3.beginPath();
    ctx3.rect(0, 160, 200, 20);
    ctx3.closePath();
    ctx3.fillStyle = "grey";
    ctx3.fill();
    ctx3.fillStyle = "#fff";
    ctx3.font = '14px Arial';
    ctx3.fillText("подвал", 75, 174);


    // Template №4
    ctx4.strokeRect(0,0,200,180);

    // menu
    ctx4.beginPath();
    ctx4.rect(0, 0, 200, 20);
    ctx4.closePath();
    ctx4.fillStyle = "#9393ff";
    ctx4.fill();
    ctx4.fillStyle = "#fff";
    ctx4.font = '14px Arial';
    ctx4.fillText("меню", 80, 13);

    // left sidebar
    ctx4.beginPath();
    ctx4.rect(0, 20, 50, 140);
    ctx4.closePath();
    ctx4.fillStyle = "#26292c";
    ctx4.fill();

    // right sidebar
    ctx4.beginPath();
    ctx4.rect(150, 20, 50, 140);
    ctx4.closePath();
    ctx4.fillStyle = "#26292c";
    ctx4.fill();

    // footer
    ctx4.beginPath();
    ctx4.rect(0, 160, 200, 20);
    ctx4.closePath();
    ctx4.fillStyle = "grey";
    ctx4.fill();
    ctx4.fillStyle = "#fff";
    ctx4.font = '14px Arial';
    ctx4.fillText("подвал", 75, 174);


    // Template №5
    ctx5.strokeRect(0,0,200,180);

    // menu
    ctx5.beginPath();
    ctx5.rect(0, 0, 200, 20);
    ctx5.closePath();
    ctx5.fillStyle = "#9393ff";
    ctx5.fill();
    ctx5.fillStyle = "#fff";
    ctx5.font = '14px Arial';
    ctx5.fillText("меню", 80, 13);

    // rubrik-1
    ctx5.beginPath();
    ctx5.rect(20, 30, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-2
    ctx5.beginPath();
    ctx5.rect(80, 30, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-3
    ctx5.beginPath();
    ctx5.rect(140, 30, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-4
    ctx5.beginPath();
    ctx5.rect(20, 70, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-5
    ctx5.beginPath();
    ctx5.rect(80, 70, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-6
    ctx5.beginPath();
    ctx5.rect(140, 70, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-7
    ctx5.beginPath();
    ctx5.rect(20, 110, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-8
    ctx5.beginPath();
    ctx5.rect(80, 110, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // rubrik-9
    ctx5.beginPath();
    ctx5.rect(140, 110, 40, 35);
    ctx5.closePath();
    ctx5.fillStyle = "orange";
    ctx5.fill();

    // footer
    ctx5.beginPath();
    ctx5.rect(0, 160, 200, 20);
    ctx5.closePath();
    ctx5.fillStyle = "grey";
    ctx5.fill();
    ctx5.fillStyle = "#fff";
    ctx5.font = '14px Arial';
    ctx5.fillText("подвал", 75, 174);


    // Template №6
    ctx6.strokeRect(0,0,200,180);

    // menu
    ctx6.beginPath();
    ctx6.rect(0, 0, 200, 20);
    ctx6.closePath();
    ctx6.fillStyle = "#9393ff";
    ctx6.fill();
    ctx6.fillStyle = "#fff";
    ctx6.font = '14px Arial';
    ctx6.fillText("меню", 80, 13);

    // rubrik-1
    ctx6.beginPath();
    ctx6.strokeRect(20, 30, 160, 35);
    ctx6.rect(25, 35, 30, 25);
    ctx6.closePath();
    ctx6.fillStyle = "grey";
    ctx6.fill();
    ctx6.moveTo(70,40);
    ctx6.lineTo(165,40);
    ctx6.moveTo(70,45);
    ctx6.lineTo(165,45);
    ctx6.moveTo(70,50);
    ctx6.lineTo(165,50);
    ctx6.moveTo(70,55);
    ctx6.lineTo(165,55);
    ctx6.stroke();

    // rubrik-2
    ctx6.beginPath();
    ctx6.strokeRect(20, 70, 160, 35);
    ctx6.rect(25, 75, 30, 25);
    ctx6.closePath();
    ctx6.fillStyle = "grey";
    ctx6.fill();
    ctx6.moveTo(70,80);
    ctx6.lineTo(165,80);
    ctx6.moveTo(70,85);
    ctx6.lineTo(165,85);
    ctx6.moveTo(70,90);
    ctx6.lineTo(165,90);
    ctx6.moveTo(70,95);
    ctx6.lineTo(165,95);
    ctx6.stroke();

    // rubrik-3
    ctx6.beginPath();
    ctx6.strokeRect(20, 110, 160, 35);
    ctx6.rect(25, 115, 30, 25);
    ctx6.closePath();
    ctx6.fillStyle = "grey";
    ctx6.fill();
    ctx6.moveTo(70,120);
    ctx6.lineTo(165,120);
    ctx6.moveTo(70,125);
    ctx6.lineTo(165,125);
    ctx6.moveTo(70,130);
    ctx6.lineTo(165,130);
    ctx6.moveTo(70,135);
    ctx6.lineTo(165,135);
    ctx6.stroke();

    // footer
    ctx6.beginPath();
    ctx6.rect(0, 160, 200, 20);
    ctx6.closePath();
    ctx6.fillStyle = "grey";
    ctx6.fill();
    ctx6.fillStyle = "#fff";
    ctx6.font = '14px Arial';
    ctx6.fillText("подвал", 75, 174);
});