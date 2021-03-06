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
    return $fields;
}

// Отображение поля формы "Загрузить реквизиты" и функция загрузки файла с помощью media_handle_upload()
add_action('woocommerce_before_checkout_form', 'add_file_field');
function add_file_field()
{
    echo "<h3 style='margin-bottom: 5px !important;margin-left: 15px;'>Загрузить реквизиты</h3>";
    echo '<form name="form" autocomplete="off" method="post" enctype="multipart/form-data" class="recvizit" style="margin: 10px 0 15px;">
            <input type="file" name="imagefile" class="button first" autocomplete="off" />
            <input type="submit" name="Submit" class="button last" value="Отправить" autocomplete="off" />
        </form>';

    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            $attach_id = media_handle_upload($file, $new_post);
            // echo wp_get_attachment_url($attach_id);//upload file URL
            update_option('fileLink', wp_get_attachment_url($attach_id));
            echo '<div style="background: #51a06d;border-radius: 10px;text-align: center;padding: 5px;margin: 5px 0;color: white;">Файл реквизитов успешно загружен!</div>';
        }
    }
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

// Удаляем файлы из папки RECVIZIT где храняться загруженные реквизиты
if (false) {
    $upload_info = wp_get_upload_dir();
    $file = $upload_info['basedir'] . '/recvizit/text.txt';
    wp_delete_file($file);
}

/* Delete Cache Files Here */
$dir = "recvizit/";
/*** cycle through all files in the directory ***/
foreach (glob($dir . "*") as $file) {
//foreach (glob($dir.'*.*') as $file){

    /*** if file is 24 hours (86400 seconds) old then delete it ***/
    if (filemtime($file) < time() - 172800) { // 2 days (172800)
        unlink($file);
    }
}
