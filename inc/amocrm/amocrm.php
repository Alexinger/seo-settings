<?php

global $post;

define('UPLOADS', '/wp-content/uploads/recvizit');

require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

// Скрываем скрытые поля, которые мешали отправке формы
add_filter('woocommerce_cart_needs_shipping', 'filter_function_disable_shipping');
function filter_function_disable_shipping($needs_shipping)
{
    return false;
}

// Удаляем поля Страна и добавляет дополнительное скрытое поле названия файла
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields_1');
function custom_override_checkout_fields_1($fields)
{
    unset($fields['billing']['billing_order'], $fields['billing']['billing_last_name']);
    $fields['billing']['billing_country']['placeholder'] = 'Россия';
    $fields['billing']['billing_first_name']['default'] = 'working';
//    $fields['billing']['billing_company']['default'] = 'sdfsfdsdf';
    // $fields['billing']['billing_company']['placeholder'] = $_SERVER['REMOTE_ADDR'];
    // echo WC()->mailer()->get_emails()['WC_Email_New_Order']->recipient;

    return $fields;
}

// Отображение поля формы "Загрузить реквизиты" и функция загрузки файла с помощью media_handle_upload()
// woocommerce_after_checkout_form
add_action('woocommerce_checkout_order_review', 'add_file_field');
function add_file_field()
{
    echo '<h3 style="margin-bottom: -10px !important;">Загрузить реквизиты</h3>
            <div style="border: 2px solid #e2e2e2;margin: 20px 0;border-radius: 10px"
            <form name="form" autocomplete="off" method="post" enctype="multipart/form-data" class="recvizit" style="margin: 10px 0 15px;">
            <input type="file" name="imagefile" onchange="this.form.submit();this.form.reset()" class="button first" autocomplete="off" style="border:none !important;width: 100%;background: #dfdcde"/>
            <!--<input type="submit" name="Submit" class="button last" value="Отправить" autocomplete="off" />-->
        </div></form>';

    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            $attach_id = media_handle_upload($file, $new_post);
            // echo wp_get_attachment_url($attach_id);//upload file URL
            update_option('fileLink', wp_get_attachment_url($attach_id));
            echo '<div style="background: #51a06d;border-radius: 10px;text-align: center;padding: 5px;margin: 5px 0;color: white;">Файл реквизитов успешно загружен!</div>';
        }
    }
}
// Change button "Подтвердить заказ"
add_filter( 'woocommerce_order_button_html', 'truemisha_order_button_html' );
function truemisha_order_button_html( $button_html ) {
    return str_replace( 'Подтвердить заказ', 'Заказать', $button_html );
}

// Заменяте название загруженного файла на IP клиента
add_filter('wp_handle_upload_prefilter', 'wp_modify_uploaded_file_names', 1, 1);
function wp_modify_uploaded_file_names($file)
{
    $info = pathinfo($file['name']);
    $ext = empty($info['extension']) ? '' : '.' . $info['extension'];
    $name = basename($file['name'], $ext);

    $file['name'] = $_SERVER['REMOTE_ADDR'] . $ext;

    return $file;
}

// Запрещает создаввать миниарюры загруженных фотографий
add_filter('intermediate_image_sizes_advanced', 'no_image_resizing');
function no_image_resizing($size)
{
    $ret = array();
    return $ret;
}

add_action('woocommerce_before_thankyou', 'mycontent_before_thankyou', 25);

function mycontent_before_thankyou($order_id)
{
    // echo 'Hello orders';
    // Удаляем файлы из папки RECVIZIT где храняться загруженные реквизиты
    if (false) {
        $upload_info = wp_get_upload_dir();
        $file = $upload_info['basedir'] . '/recvizit/text.txt';
        wp_delete_file($file);
    }

    /* Delete Cache Files Here */
    $dir = "recvizit/";
    /** define the directory **/

    /*** cycle through all files in the directory ***/
    foreach (glob($dir . "*") as $file) {
//foreach (glob($dir.'*.*') as $file){

        /*** if file is 24 hours (86400 seconds) old then delete it ***/
        if (filemtime($file) < time() - 172800) { // 2 days (172800)
            unlink($file);
        }
    }
}

//__________________________________________________________________________________________________________
