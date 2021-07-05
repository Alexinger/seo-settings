jQuery(document).ready(function ($) {
    $("#main-wrapper").addClass("row-fluid");
    $('#customer_details div+div').remove();
    $('#customer_details div').removeClass('col-1').addClass('container-fluid');
});
