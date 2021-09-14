<?php

global $post;

define('UPLOADS', '/wp-content/uploads/recvizit');

require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

/*Скрываем скрытые поля, которые мешали отправке формы*/
add_filter('woocommerce_cart_needs_shipping', 'filter_function_disable_shipping');
function filter_function_disable_shipping($needs_shipping)
{
    return false;
}

/*Удаляем поля Страна и добавляет дополнительное скрытое поле названия файла*/
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields_1');
function custom_override_checkout_fields_1($fields)
{
    unset($fields['billing']['billing_order'], $fields['billing']['billing_last_name']);
    $fields['billing']['billing_country']['placeholder'] = 'Россия';
    $fields['billing']['billing_first_name']['default'] = 'working';

    return $fields;
}

/*Отображение поля формы "Загрузить реквизиты" и функция загрузки файла с помощью media_handle_upload()*/
add_action('woocommerce_checkout_order_review', 'add_file_field');
function add_file_field()
{
    echo '<h3 style="margin-bottom: -10px !important;">Загрузить реквизиты</h3>
            <div style="border: 1px solid #e2e2e2;margin: 20px 0;border-radius: 5px">
            <form name="form" autocomplete="off" method="post" enctype="multipart/form-data" class="recvizit" style="margin: 10px 0 15px;">
            <input id="image_uploads" type="file" name="imagefile" onchange="this.form.submit();this.form.reset()" class="button first" autocomplete="off" style="border:none !important;width: 100%;background: #ebe9eb !important;color: #ff5757 !important;border-radius: 0;"/>
            <!--<input type="submit" name="Submit" class="button last" value="Отправить" autocomplete="off" />-->
            <span style="margin-left: 10px;color: red;">*</span><span style="font-size: 12px;color: #9a9a9a;">После добавления файла реквизитов он загрузится автоматически!</span>
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

/*Заменяте название загруженного файла на IP клиента*/
add_filter('wp_handle_upload_prefilter', 'wp_modify_uploaded_file_names', 1, 1);
function wp_modify_uploaded_file_names($file)
{
    date_default_timezone_set('UTC');
    $info = pathinfo($file['name']);
    $ext = empty($info['extension']) ? '' : '.' . $info['extension'];
    $name = basename($file['name'], $ext);
    $date = date('Y-m-d');
    /*$dateL = new DateTime('2021-07-20');*/
    /*$dataFormat = $date->format('Y-m-d');*/
    $file['name'] = $_SERVER['REMOTE_ADDR'] . '_' . $date . $ext;

    return $file;
}

add_action('woocommerce_before_thankyou', 'mycontent_before_thankyou', 25);
function mycontent_before_thankyou($order_id)
{
    $upload_dir = (object)wp_upload_dir();
    $list = list_files($upload_dir->basedir . '/recvizit', 2);

    if (isset($list[0])) {

        foreach ($list as $item) {
            /*берет строку после последнеего слеша*/
            $str = explode('/', $item);
            /*перебирает все файлы в папке 'recvizit'*/
            $filename = array_pop($str);
            /*находится символ "_" и от него берет все символы дальше*/
            $searchSymbol = stripos($filename, '_');
            if ($searchSymbol) {
                /*из названия файла берет только время сохранения 2021-08-09*/
                $search = substr($filename, $searchSymbol + 1, 10);
                /*дата файла, берется из названия*/
                $last = new DateTime($search);
                /*текущая дата*/
                $target = new DateTime(date('Y-m-d'));

                /*сравнение даты*/
                $interval = $last->diff($target);
                if ($searchSymbol) {
                    $upload_info = wp_get_upload_dir();
                    $file = $upload_info['basedir'] . '/recvizit/' . $filename;
                    $dayLast = trim($interval->format('%R%a'), '+');
                   /*echo $file;*/
                    if ($dayLast > get_option('day_number')) {
                        wp_delete_file($file);
                    }
                }
            }
        }
    }
}

/*Запрещает создаввать миниарюры загруженных фотографий*/
add_filter('intermediate_image_sizes_advanced', 'no_image_resizing');
function no_image_resizing($size)
{
    $ret = array();
    return $ret;
}
//__________________________________________________________________________________________________________
