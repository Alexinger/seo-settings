<?php
header('Content-Type: text/html; image/jpg; charset=utf-8');
/*
Plugin Name: Settings SEO
Plugin URI: https://github.com/Alexinger/seo-settings
Description: Плагин для быстрой настройки SEO элемнтов (меток, тегов и т.д.).
Version: 0.8.6
Author: Alexinger
Author URI: https://x-ali.ru
License: A "Slug" license name e.g. GPL2
*/
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : alex777anders@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
*/

if( ! class_exists( 'Smashing_Updater' ) ){
    include_once plugin_dir_path( __FILE__ ) . 'update.php';
}
$updater = new Smashing_Updater( __FILE__ );
$updater->set_username( 'Alexinger' );
$updater->set_repository( 'seo-settings' );
$updater->initialize();

//include_once plugin_dir_path(__FILE__) . 'plugin.php';
//include_once('updater.php');
//
//if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
//    $config = array(
//        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
//        'proper_folder_name' => 'plugin-name', // this is the name of the folder your plugin lives in
//        'api_url' => 'https://api.github.com/repos/username/repository-name', // the GitHub API url of your GitHub repo
//        'raw_url' => 'https://raw.github.com/username/repository-name/master', // the GitHub raw url of your GitHub repo
//        'github_url' => 'https://github.com/username/repository-name', // the GitHub url of your GitHub repo
//        'zip_url' => 'https://github.com/username/repository-name/zipball/master', // the zip url of the GitHub repo
//        'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
//        'requires' => '3.0', // which version of WordPress does your plugin require?
//        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
//        'readme' => 'README.md', // which file to use as the readme for the version number
//        'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
//    );
//    new WP_GitHub_Updater($config);
//}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
}


add_action( 'admin_menu', 'my_script_css' );
function my_script_css(){

	if($_SERVER['REQUEST_URI'] == '/wp-admin/admin.php?page=settings_header'){
		global $wpdb;
		// Максимальное значение ID в базе плагинов.
		$results = $wpdb->get_var("SELECT Max(id) FROM wp_my_custom_plugins");

		wp_enqueue_style( 'font_awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css' );
		wp_register_script( 'tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js' );
		wp_enqueue_script( 'tether' );

		wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );

		wp_register_style( 'my_style', plugins_url('/assets/css/style.css', __FILE__) );
		wp_enqueue_script( 'my_style' );

		wp_register_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js' );
		wp_enqueue_script( 'bootstrap_js' );

		wp_register_script( 'wcsf_example_ajax', plugins_url('/assets/js/script.js', __FILE__), array('jquery') );
		wp_enqueue_script( 'wcsf_example_ajax' );

		wp_register_script( 'cron-js', plugins_url('/assets/js/shortcode-cron.js', __FILE__), array('jquery') );
		wp_enqueue_script( 'cron-js' );

		$date = get_option( 'title-shortcode-1' );
		$count = get_option('array-count');
		wp_localize_script('cron-js', 'parametr', array(
			'date' => $date,
			'count' => $count,
			'db_count' => $results
		));

		wp_register_script( 'my_script_plugins', plugins_url('/assets/js/edit-plugins.js', __FILE__), array('jquery') );
		wp_enqueue_script( 'my_script_plugins' );
	}

};

function wptuts_scripts_basic()
{
	// wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_register_style( 'my_theme_style', plugins_url('/assets/css/style-theme.css', __FILE__) );
	wp_enqueue_style( 'my_theme_style' );
	// wp_enqueue_script( 'bootstrap_js' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' );


add_action('admin_menu', 'settings_header');
function settings_header(){
	add_menu_page('Настройка плагина Woocommerce', 'Расширение Woo', 8, 'settings_header', 'options_page_header', 'dashicons-forms');
//	add_options_page('Настройка плагина Woocommerce', '<div><i class="fa fa-gears mr-2 text-info"></i>Расширение Woo</div>', 8, 'settings_header', 'options_page_header');
	// add_submenu_page( 'options_page_header', 'Управление содержимом', 'О плагине', 'settings_header', 'options_page_last');
}

add_action('wp_ajax_pluginajax', 'pluginajax_callback');
function pluginajax_callback(){
	parse_str($_POST['data'],$data);

	global $wpdb;

		$db_select_count_id = $wpdb->get_col($wpdb->prepare("SELECT id FROM wp_seo_creator_plugins"));
		foreach ($db_select_count_id as $item_id){
			if(true){
				$param_name_plugins = "name_plugins_{$item_id}";
				$param_path_plugins = "path_plugins_{$item_id}";

				update_row_plugin($item_id, $data[$param_name_plugins], $data[$param_path_plugins]);
			}
		}
		wp_die();
}

function insert_row_plugin($name, $path){
	global $wpdb;
	$wpdb->insert(
		$wpdb->get_blog_prefix() . 'seo_creator_plugins',
		array(
			'name_plugin' => $name,
			'path_plugin' => $path
			),
		array('%s', '%s'));
}

function update_row_plugin($id, $name, $path){
	global $wpdb;
	$wpdb->update(
		$wpdb->get_blog_prefix() . 'seo_creator_plugins',
		array(
			'name_plugin' => $name,
			'path_plugin' => $path,
			// 'active_plugin' => $active
		),
		array(
			'id' => $id
		),
		array('%s', '%s'),
		array('%d')
	);
}

function remove_row(){
	return;
}

add_action('wp_ajax_loadplaginajax', 'loadplaginajax_callback');
function loadplaginajax_callback(){
	global $wpdb;
	parse_str($_POST['data'], $data);
	if($data['plugin-check'] == 1 && get_option('check-update') == 0){
		update_option('check-update', 1);
		$set_default_plugin = [
			1 => ['name' => 'a3 Lazy Load', 'path' => 'a3-lazy-load/a3-lazy-load.php'],
			2 => ['name' => 'AdRotate', 'path' => 'adrotate/adrotate.php'],
			3 => ['name' => 'Ajax Pagination and Infinite Scroll', 'path' => ''],
			4 => ['name' => 'Cyr to Lat enhanced', 'path' => 'cyr3lat/cyr-to-lat.php'],
			5 => ['name' => 'Disable All Wordpress Updates', 'path' => 'disable-wordpress-updates/disable-updates.php'],
			6 => ['name' => 'DW Question Answer Pro', 'path' => 'dw-question-answer-pro/dw-question-answer.php'],
			7 => ['name' => 'Galleries by Angie Makes', 'path' => ''],
			8 => ['name' => 'Goods Catalog', 'path' => 'goods-catalog/goods-cat.php'],
			9 => ['name' => 'Hierarchical HTML Sitemap', 'path' => 'hierarchical-html-sitemap/hierarchical-sitemap.php'],
			10 => ['name' => 'Hyper Cache', 'path' => 'hyper-cache/advanced-cache.php' ],
			11 => ['name' => 'kk Star Ratings', 'path' => 'kk-star-ratings/index.php'],
			12 => ['name' => 'Lightbox', 'path' => ''],
			13 => ['name' => 'Q2W3 Fixed Widget', 'path' => 'q2w3-fixed-widget/q2w3-fixed-widget.php'],
			14 => ['name' => 'Related Posts', 'path' => ''],
			15 => ['name' => 'Subscribe to Comments Reloaded', 'path' => 'subscribe-to-comments-reloaded/subscribe-to-comments-reloaded.php'],
			16 => ['name' => 'Table Press', 'path' => 'tablepress/tablepress.php'],
			17 => ['name' => 'Taxonomy Images', 'path' => 'taxonomy-images/taxonomy-images.php'],
			18 => ['name' => 'TotalPoll Pro', 'path' => 'totalpool/totalpool.php'],
			19 => ['name' => 'wBounce', 'path' => 'wbounce/wbounce.php'],
			20 => ['name' => 'Webcraftic Clearfy', 'path' => ''],
			21 => ['name' => 'Widget Context', 'path' => 'widget-context/widget-context.php'],
			22 => ['name' => 'WP No External Links', 'path' => 'wp-noexternalinks/wp-noexternalinks.php'],
			23 => ['name' => 'WP-Optimize', 'path' => 'wp-optimize/wp-optimize.php'],
			24 => ['name' => 'WPSmart Mobile', 'path' => 'wpsmart-mobile/wpsmart.php']
		];
		foreach ($set_default_plugin as $item){
				insert_row_plugin($item['name'], $item['path']);
		}
	}
}

add_action('wp_ajax_myajax', 'myajax_callback');
function myajax_callback(){
	parse_str($_POST['data'], $data);

	// check-delivery
	if($data['check-delivery']){
		update_option('check-delivery', 'checked');
	}else{
		update_option('check-delivery', '');
	}
	if($data['tabs-check-delivery-name']) { update_option('tabs-check-delivery-name', $data['tabs-check-delivery-name']); } else { update_option('tabs-check-delivery-name', ''); }
	if($data['tabs-check-delivery-number']) { update_option('tabs-check-delivery-number', $data['tabs-check-delivery-number']); } else { update_option('tabs-check-delivery-number', ''); }
	if($data['tabs-check-delivery-content']) { update_option('tabs-check-delivery-content', $data['tabs-check-delivery-content']); } else { update_option('tabs-check-delivery-content', ''); }

	// check-garant
	if($data['check-garant']){
		update_option('check-garant', 'checked');
	}else{
		update_option('check-garant', '');
	}
	if($data['tabs-check-garant-name']) { update_option('tabs-check-garant-name', $data['tabs-check-garant-name']); } else { update_option('tabs-check-garant-name', ''); }
	if($data['tabs-check-garant-number']) { update_option('tabs-check-garant-number', $data['tabs-check-garant-number']); } else { update_option('tabs-check-garant-number', ''); }
	if($data['tabs-check-garant-content']) { update_option('tabs-check-garant-content', $data['tabs-check-garant-content']); } else { update_option('tabs-check-garant-content', ''); }

	// check-garant
	if($data['check-bay']){
		update_option('check-bay', 'checked');
	}else{
		update_option('check-bay', '');
	}
	if($data['tabs-check-bay-name']) { update_option('tabs-check-bay-name', $data['tabs-check-bay-name']); } else { update_option('tabs-check-bay-name', ''); }
	if($data['tabs-check-bay-number']) { update_option('tabs-check-bay-number', $data['tabs-check-bay-number']); } else { update_option('tabs-check-bay-number', ''); }
	if($data['tabs-check-bay-content']) { update_option('tabs-check-bay-content', $data['tabs-check-bay-content']); } else { update_option('tabs-check-bay-content', ''); }
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
function fieldajax_callback(){
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

	if($data['bil-field-orders']){
		update_option('bil-field-orders', $data['bil-field-orders']);
	}

	// no required Billing
	if($data['bil-field-first-name']){update_option('bil-field-first-name', 'checked');}else{update_option('bil-field-first-name', '');}
	if($data['bil-field-last-name']){update_option('bil-field-last-name', 'checked');}else{update_option('bil-field-last-name', '');}
	if($data['bil-field-company']){update_option('bil-field-company', 'checked');}else{update_option('bil-field-company', '');}
	if($data['bil-field-country']){update_option('bil-field-country', 'checked');}else{update_option('bil-field-country', '');}
	if($data['bil-field-address-1']){update_option('bil-field-address-1', 'checked');}else{update_option('bil-field-address-1', '');}
	if($data['bil-field-address-2']){update_option('bil-field-address-2', 'checked');}else{update_option('bil-field-address-2', '');}
	if($data['bil-field-city']){update_option('bil-field-city', 'checked');}else{update_option('bil-field-city', '');}
	if($data['bil-field-state']){update_option('bil-field-state', 'checked');}else{update_option('bil-field-state', '');}
	if($data['bil-field-postcode']){update_option('bil-field-postcode', 'checked');}else{update_option('bil-field-postcode', '');}
	if($data['bil-field-phone']){update_option('bil-field-phone', 'checked');}else{update_option('bil-field-phone', '');}
	if($data['bil-field-email']){update_option('bil-field-email', 'checked');}else{update_option('bil-field-email', '');}

	// remove fields Billing
	if($data['bil-remove-field-first-name']){update_option('bil-remove-field-first-name', 'checked');}else{update_option('bil-remove-field-first-name', '');}
	if($data['bil-remove-field-last-name']){update_option('bil-remove-field-last-name', 'checked');}else{update_option('bil-remove-field-last-name', '');}
	if($data['bil-remove-field-company']){update_option('bil-remove-field-company', 'checked');}else{update_option('bil-remove-field-company', '');}
	if($data['bil-remove-field-country']){update_option('bil-remove-field-country', 'checked');}else{update_option('bil-remove-field-country', '');}
	if($data['bil-remove-field-address-1']){update_option('bil-remove-field-address-1', 'checked');}else{update_option('bil-remove-field-address-1', '');}
	if($data['bil-remove-field-address-2']){update_option('bil-remove-field-address-2', 'checked');}else{update_option('bil-remove-field-address-2', '');}
	if($data['bil-remove-field-city']){update_option('bil-remove-field-city', 'checked');}else{update_option('bil-remove-field-city', '');}
	if($data['bil-remove-field-state']){update_option('bil-remove-field-state', 'checked');}else{update_option('bil-remove-field-state', '');}
	if($data['bil-remove-field-postcode']){update_option('bil-remove-field-postcode', 'checked');}else{update_option('bil-remove-field-postcode', '');}
	if($data['bil-remove-field-phone']){update_option('bil-remove-field-phone', 'checked');}else{update_option('bil-remove-field-phone', '');}
	if($data['bil-remove-field-email']){update_option('bil-remove-field-email', 'checked');}else{update_option('bil-remove-field-email', '');}

	wp_die();
}

add_action('wp_ajax_styleajax', 'styleajax_callback');
function styleajax_callback(){

//	$filename = 'https://x-ali.ru/wp-content/plugins/seo-settings/assets/css/style-theme.css';
//	$f = fopen( $filename, 'w' );
//	if(is_readable($filename)) {
//		update_option( 'file-style', 'Файл доступен для записи! ' );
//	}else{
//		update_option( 'file-style', 'Файл не доступен для записи!!! ' . $filename);
//	}
//	wp_die();
}

// Добавляем путь к плагину в его описании
add_filter( 'plugin_row_meta', 'true_echo_plugin_path', 10, 4 );
function true_echo_plugin_path( $plugin_meta, $plugin_file, $plugin_data, $status ) {
	echo '<code>' . $plugin_file . '</code><br />';
	return $plugin_meta;
}

// Основная страница настроек
function options_page_header(){
	include_once 'inc/home.php';
}

// Дополнительная страница настроек
function options_page_last(){
	include_once 'inc/home-last.php';
}

function mayak_button()
{
	if ( current_user_can('edit_posts') && current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'mayak_plugin');
		add_filter('mce_buttons_2', 'mayak_register_button');
	}
}
add_action('init', 'mayak_button');

function mayak_plugin($plugin_array){
	$plugin_array['mayak'] = plugins_url('seo-settings/assets/js/added-button.js');
	return $plugin_array;
}

function mayak_register_button($buttons){
	array_push($buttons, "yellow");
	return $buttons;
}

add_action('wp_ajax_cron', 'cron_callback');
function cron_callback() {
	parse_str( $_POST['data'], $data );

	update_option( 'title-cron', $data['title-cron'] );

// добавляем крон хук
	add_action( 'my_task_hook', 'my_task_function' );
	function my_task_function() {
		wp_mail( get_option('title-cron'), 'Доступность сайта', 'Запланированное письмо от WordPress.');
	}
	do_action('my_task_hook');

	wp_die();
}

include_once 'inc/tag-param/shortcode-param.php';

add_action('wp_ajax_create_shortcode', 'create_shortcode_callback');
function create_shortcode_callback() {
	parse_str( $_POST['data'], $data );

	update_option( 'title-shortcode-1', $data['title-shortcode-1'] );
	update_option('array-count', $data['count']);

	wp_die();
}
