<?php
header('Content-Type: text/html; image/jpg; charset=utf-8');
/*
Plugin Name: Settings SEO plugin
Plugin URI: https://github.com/Alexinger/seo-settings
Description: Плагин для быстрой настройки SEO элемнтов (меток, тегов и оптимизация).
Version: 1.0.5
Author: Alexinger
Author URI: https://x-ali.ru
License: A "Slug" license name e.g. GPL2
*/
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : alex777anders@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
*/

//include_once 'vars.php';

add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_deregister_script('jquery-core');
    wp_register_script('jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script('jquery');

    wp_register_script('my_script', plugins_url('/assets/js/script-theme.js', __FILE__), array('jquery'), time());
    wp_enqueue_script('my_script');

    wp_register_style('my_theme_style', plugins_url('/assets/css/style-theme.css', __FILE__));
    wp_enqueue_style('my_theme_style');
}

// Added counter Yandex in footer
include_once 'counter/counter-yandex.php';

add_action('wp_ajax_save_yandex', 'save_yandex_count');
function save_yandex_count()
{
    $option = $_POST['option'];
    $new_value = $_POST['new_value'];

    update_option($option, $new_value);
    die(
    json_encode(
        array(
            'message' => 'Save counter yandex. Success!'
        )
    )
    );
}

// Added counter Google in footer
include_once 'counter/counter-google.php';

add_action('wp_ajax_save_google', 'save_google_count');
function save_google_count()
{
    $option = $_POST['option'];
    $new_value = $_POST['new_value'];

    update_option($option, $new_value);
    die(
    json_encode(
        array(
            'message' => 'Save counter google. Success!'
        )
    )
    );
}

add_action('admin_menu', 'my_script_css');
function my_script_css()
{

    if ($_SERVER['REQUEST_URI'] == '/wp-admin/admin.php?page=settings_header') {
        global $wpdb;
        // Максимальное значение ID в базе плагинов.
        $results = $wpdb->get_var("SELECT Max(id) FROM wp_my_custom_plugins");

        wp_enqueue_style('font_awesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');


        wp_register_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
        wp_enqueue_script('tether');

        wp_enqueue_style('bootstrap_css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap_css');

        wp_enqueue_style('bootstrap_mdb', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.0/css/mdb.min.css');
        wp_enqueue_script('bootstrap_mdb');

        wp_register_style('my_style', plugins_url('/assets/css/style.css', __FILE__));
        wp_enqueue_script('my_style');

        wp_register_script('jquery_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
        wp_enqueue_script('jquery_min_js');

        wp_register_script('poper_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js');
        wp_enqueue_script('poper_min_js');

        wp_register_script('bootstrap_min_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js');
        wp_enqueue_script('bootstrap_min_js');

        wp_register_script('mdb_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.0/js/mdb.min.js');
        wp_enqueue_script('mdb_min_js');

        wp_register_script('wcsf_example_ajax', plugins_url('/assets/js/script.js', __FILE__), array('jquery'), time());
        wp_enqueue_script('wcsf_example_ajax');

        wp_register_script('cron-js', plugins_url('/assets/js/shortcode-cron.js', __FILE__), array('jquery'));
        wp_enqueue_script('cron-js');

        $date = get_option('title-shortcode-1');
        $count = get_option('array-count');
        wp_localize_script('cron-js', 'parametr', array(
            'date' => $date,
            'count' => $count,
            'db_count' => $results
        ));

        wp_register_script('my_script_plugins', plugins_url('/assets/js/edit-plugins.js', __FILE__), array('jquery'));
        wp_enqueue_script('my_script_plugins');
    }

}


add_action('admin_menu', 'settings_header');
function settings_header()
{
    add_menu_page('Настройка оптимизации для сайта', 'Расширение WC', 'edit_pages', 'settings_header', 'options_page_header', 'dashicons-forms');
}

add_action('wp_ajax_pluginajax', 'pluginajax_callback');
function pluginajax_callback()
{
    parse_str($_POST['data'], $data);

    var_dump($data);
    global $wpdb;

    $db_select_count_id = $wpdb->get_col($wpdb->prepare("SELECT id FROM wp_seo_creator_plugins"));
    foreach ($db_select_count_id as $item_id) {
        if (true) {
            $param_name_plugins = "name_plugins_{$item_id}";
            $param_path_plugins = "path_plugins_{$item_id}";

            update_row_plugin($item_id, $data[$param_name_plugins], $data[$param_path_plugins]);
        }
    }
    wp_die();
}

function insert_row_plugin($name, $path)
{
    global $wpdb;
    $wpdb->insert(
        $wpdb->get_blog_prefix() . 'seo_creator_plugins',
        array(
            'name_plugin' => $name,
            'path_plugin' => $path
        ),
        array('%s', '%s'));
}

function update_row_plugin($id, $name, $path)
{
    global $wpdb;
    $wpdb->update(
        $wpdb->get_blog_prefix() . 'seo_creator_plugins',
        array(
            'name_plugin' => $name,
            'path_plugin' => $path,
        ),
        array(
            'id' => $id
        ),
        array('%s', '%s'),
        array('%d')
    );
}

add_action('wp_ajax_myajax', 'myajax_callback');
function myajax_callback()
{
    parse_str($_POST['data'], $data);

    // check-delivery
    if ($data['check-delivery']) {
        update_option('check-delivery', 'checked');
    } else {
        update_option('check-delivery', '');
    }
    if ($data['tabs-check-delivery-name']) {
        update_option('tabs-check-delivery-name', $data['tabs-check-delivery-name']);
    } else {
        update_option('tabs-check-delivery-name', '');
    }
    if ($data['tabs-check-delivery-number']) {
        update_option('tabs-check-delivery-number', $data['tabs-check-delivery-number']);
    } else {
        update_option('tabs-check-delivery-number', '');
    }
    if ($data['tabs-check-delivery-content']) {
        update_option('tabs-check-delivery-content', $data['tabs-check-delivery-content']);
    } else {
        update_option('tabs-check-delivery-content', '');
    }

    // check-garant
    if ($data['check-garant']) {
        update_option('check-garant', 'checked');
    } else {
        update_option('check-garant', '');
    }
    if ($data['tabs-check-garant-name']) {
        update_option('tabs-check-garant-name', $data['tabs-check-garant-name']);
    } else {
        update_option('tabs-check-garant-name', '');
    }
    if ($data['tabs-check-garant-number']) {
        update_option('tabs-check-garant-number', $data['tabs-check-garant-number']);
    } else {
        update_option('tabs-check-garant-number', '');
    }
    if ($data['tabs-check-garant-content']) {
        update_option('tabs-check-garant-content', $data['tabs-check-garant-content']);
    } else {
        update_option('tabs-check-garant-content', '');
    }

    // check-garant
    if ($data['check-bay']) {
        update_option('check-bay', 'checked');
    } else {
        update_option('check-bay', '');
    }
    if ($data['tabs-check-bay-name']) {
        update_option('tabs-check-bay-name', $data['tabs-check-bay-name']);
    } else {
        update_option('tabs-check-bay-name', '');
    }
    if ($data['tabs-check-bay-number']) {
        update_option('tabs-check-bay-number', $data['tabs-check-bay-number']);
    } else {
        update_option('tabs-check-bay-number', '');
    }
    if ($data['tabs-check-bay-content']) {
        update_option('tabs-check-bay-content', $data['tabs-check-bay-content']);
    } else {
        update_option('tabs-check-bay-content', '');
    }
    wp_die();
}

// Подключаем табы в Woocommerce
include_once 'inc/add-tabs-woo.php';
include_once 'inc/add-field-woo.php';

/*
	TODO: Нужно сделать создание таблиц при активации плагина или его обновлении.
	Плагин находится 'inc/data/dbConnect.php'
*/

include_once 'inc/data/dbConnect.php';

add_action('wp_ajax_fieldajax', 'fieldajax_callback');
function fieldajax_callback()
{
    global $wpdb;
    parse_str($_POST['data'], $data);

    $table_custom_plugins = $wpdb->get_blog_prefix() . 'my_custom_plugins';

    $wpdb->insert($table_custom_plugins, array(
        "name_plugin" => "first parameter 2",
        "check_plugin" => "true",
        "active_plugin" => "false",
        "path_plugin" => "Это путь до корня плагина",
        "field_plugin" => "Дополнительное поля для значений"
    ), array("%s", "%s", "%s", "%s", "%s"));

    if ($data['bil-field-orders']) {
        update_option('bil-field-orders', $data['bil-field-orders']);
    }

    // no required Billing
    if ($data['bil-field-first-name']) {
        update_option('bil-field-first-name', 'checked');
    } else {
        update_option('bil-field-first-name', '');
    }
    if ($data['bil-field-last-name']) {
        update_option('bil-field-last-name', 'checked');
    } else {
        update_option('bil-field-last-name', '');
    }
    if ($data['bil-field-company']) {
        update_option('bil-field-company', 'checked');
    } else {
        update_option('bil-field-company', '');
    }
    if ($data['bil-field-country']) {
        update_option('bil-field-country', 'checked');
    } else {
        update_option('bil-field-country', '');
    }
    if ($data['bil-field-address-1']) {
        update_option('bil-field-address-1', 'checked');
    } else {
        update_option('bil-field-address-1', '');
    }
    if ($data['bil-field-address-2']) {
        update_option('bil-field-address-2', 'checked');
    } else {
        update_option('bil-field-address-2', '');
    }
    if ($data['bil-field-city']) {
        update_option('bil-field-city', 'checked');
    } else {
        update_option('bil-field-city', '');
    }
    if ($data['bil-field-state']) {
        update_option('bil-field-state', 'checked');
    } else {
        update_option('bil-field-state', '');
    }
    if ($data['bil-field-postcode']) {
        update_option('bil-field-postcode', 'checked');
    } else {
        update_option('bil-field-postcode', '');
    }
    if ($data['bil-field-phone']) {
        update_option('bil-field-phone', 'checked');
    } else {
        update_option('bil-field-phone', '');
    }
    if ($data['bil-field-email']) {
        update_option('bil-field-email', 'checked');
    } else {
        update_option('bil-field-email', '');
    }

    // remove fields Billing
    if ($data['bil-remove-field-first-name']) {
        update_option('bil-remove-field-first-name', 'checked');
    } else {
        update_option('bil-remove-field-first-name', '');
    }
    if ($data['bil-remove-field-last-name']) {
        update_option('bil-remove-field-last-name', 'checked');
    } else {
        update_option('bil-remove-field-last-name', '');
    }
    if ($data['bil-remove-field-company']) {
        update_option('bil-remove-field-company', 'checked');
    } else {
        update_option('bil-remove-field-company', '');
    }
    if ($data['bil-remove-field-country']) {
        update_option('bil-remove-field-country', 'checked');
    } else {
        update_option('bil-remove-field-country', '');
    }
    if ($data['bil-remove-field-address-1']) {
        update_option('bil-remove-field-address-1', 'checked');
    } else {
        update_option('bil-remove-field-address-1', '');
    }
    if ($data['bil-remove-field-address-2']) {
        update_option('bil-remove-field-address-2', 'checked');
    } else {
        update_option('bil-remove-field-address-2', '');
    }
    if ($data['bil-remove-field-city']) {
        update_option('bil-remove-field-city', 'checked');
    } else {
        update_option('bil-remove-field-city', '');
    }
    if ($data['bil-remove-field-state']) {
        update_option('bil-remove-field-state', 'checked');
    } else {
        update_option('bil-remove-field-state', '');
    }
    if ($data['bil-remove-field-postcode']) {
        update_option('bil-remove-field-postcode', 'checked');
    } else {
        update_option('bil-remove-field-postcode', '');
    }
    if ($data['bil-remove-field-phone']) {
        update_option('bil-remove-field-phone', 'checked');
    } else {
        update_option('bil-remove-field-phone', '');
    }
    if ($data['bil-remove-field-email']) {
        update_option('bil-remove-field-email', 'checked');
    } else {
        update_option('bil-remove-field-email', '');
    }

    wp_die();
}

// Добавляем путь к плагину в его описании
add_filter('plugin_row_meta', 'true_echo_plugin_path', 10, 4);
function true_echo_plugin_path($plugin_meta, $plugin_file, $plugin_data, $status)
{
    echo '<code>' . $plugin_file . '</code><br />';
    return $plugin_meta;
}

// Основная страница настроек
function options_page_header()
{
    include_once 'inc/home.php';
}

// Дополнительная страница настроек
function options_page_last()
{
    include_once 'inc/home-last.php';
}

function mayak_button()
{
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'mayak_plugin');
        add_filter('mce_buttons_2', 'mayak_register_button');
    }
}

add_action('init', 'mayak_button');

function mayak_plugin($plugin_array)
{
    $plugin_array['mayak'] = plugins_url('seo-settings/assets/js/added-button.js', time());
    return $plugin_array;
}

function mayak_register_button($buttons)
{
    array_push($buttons, "yellow");
    return $buttons;
}

add_action('wp_ajax_cron', 'cron_callback');
function cron_callback()
{
    parse_str($_POST['data'], $data);

    update_option('title-cron', $data['title-cron']);

// добавляем крон хук
    add_action('my_task_hook', 'my_task_function');
    function my_task_function()
    {
        wp_mail(get_option('title-cron'), 'Доступность сайта', 'Запланированное письмо от WordPress.');
    }

    do_action('my_task_hook');

    wp_die();
}

include_once 'inc/tag-param/shortcode-param.php';

add_action('wp_ajax_create_shortcode', 'create_shortcode_callback');
function create_shortcode_callback()
{
    parse_str($_POST['data'], $data);

    update_option('title-shortcode-1', $data['title-shortcode-1']);
    update_option('array-count', $data['count']);

    wp_die();
}

function exec_php($matches)
{
    eval('ob_start();' . $matches[1] . '$inline_execute_output = ob_get_contents();ob_end_clean();');
    return $inline_execute_output;
}

function inline_php($content)
{
    $content = preg_replace_callback('/\[exeeec\]((.|\n)*?)\[\/exeeec\]/', 'exec_php', $content);
    $content = preg_replace('/\[exeeec off\]((.|\n)*?)\[\/exeeec\]/', '$1', $content);
    return $content;
}
add_filter('the_content', 'inline_php', 0);

## Отключает Гутенберг (новый редактор блоков в WordPress).
## ver: 1.2
if( 'disable_gutenberg' ){
    remove_theme_support( 'core-block-patterns' ); // WP 5.5

    add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

    // отключим подключение базовых css стилей для блоков
    // ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
    remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

    // Move the Privacy Policy help notice back under the title field.
    add_action( 'admin_init', function(){
        remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
        add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
    } );
}


