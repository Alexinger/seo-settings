jQuery(document).ready(function ($) {
    $('#main-wrapper').addClass('row-fluid');


    setInterval(function () {
        $('#shipping_method li:first>label').text('Нужна доставка');
        $('#shipping_method li:last>label').text('Самовывоз');
    }, 500);
});