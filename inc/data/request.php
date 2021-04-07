<?php


$nameSite = Trim(stripslashes($_POST['nameSite']));
//$phone = Trim(stripslashes($_POST['phone']));
//$email = Trim(stripslashes($_POST['email']));
//$website = Trim(stripslashes($_POST['website']));


update_option('site_title', $nameSite);

//add_option('menu_name', 'Главная');
//add_option('menu_phone', '');
//add_option('menu_email', '');
//add_option('menu_txt', '');
//add_option('banner', '');
//add_option('site_description', '');
//add_option('site_color_top_navbar', '');
//add_option('site_color_bg', '');
//add_option('site_color_footer_bg', '');
//add_option('site_width', '');

