jQuery(document).ready(function ($) {
    $('#main-wrapper').addClass('row-fluid');


    setTimeout(function () {
        $('#shipping_method li>label[for="shipping_method_0_flat_rate2"]').text('Нужна доставка');
        $('#shipping_method li>label[for="shipping_method_0_local_pickup1"]').text('Самовывоз');
    }, 1000);
});