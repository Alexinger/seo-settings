jQuery(document).ready(function ($) {
    $("#main-wrapper").addClass("row-fluid");
    $('#customer_details div+div').remove();
    $('#customer_details div').removeClass('col-1').addClass('container-fluid');

    // $.getJSON('https://ipapi.co/json/', function(data) {
    //     console.log(JSON.stringify(data.ip, null, 2));
    //     const get_ip = JSON.stringify(data.ip, null, 2)
    //     $('#billing_company').placeholder = 'sdfsdf' . get_ip;
    // });

    // var checkout_form = $('form.checkout');
    // // woocommerce_checkout_place_order
    // checkout_form.on('woocommerce_checkout_place_order', function () {
    //     if ($('#billing_company').val() == '') {
    //         ('#billing_company').val('1234567');
    //     }
    //     return true;
    // });

});
