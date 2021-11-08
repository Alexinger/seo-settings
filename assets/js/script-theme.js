jQuery(document).ready(function ($) {
    $("#main-wrapper").addClass("row-fluid");
    $('#customer_details div+div').remove();
    $('#customer_details div').removeClass('col-1').addClass('container-fluid');

    // #place_order

    // $.getJSON('https://ipapi.co/json/', function(data) {
    //     console.log(JSON.stringify(data.ip, null, 2));
    //     const get_ip = JSON.stringify(data.ip, null, 2)
    //     $('#billing_company').placeholder = 'sdfsdf' . get_ip;
    // });

    // $("#image_uploads").on('change',function(){
    //     $("#form_uploads").submit();
    //     $("#form_uploads").reset();
    // });
    //
    // var click_btn_uploads = $('#image_uploads');
    //
    // function btn_not_disabled(){
    //     click_btn_uploads.on('click', function () {
    //         console.log('hello click');
    //         $('#place_order').removeAttr('disabled');
    //     });
    // }
    //
    // function btn_disabled(){
    //     click_btn_uploads.on('click', function () {
    //         console.log('hello click');
    //         $('#place_order').attr('disabled', 'disabled');
    //     });
    // }
});
