<?php
global $wpdb;

$table_creator_plugins = $wpdb->get_blog_prefix() . 'seo_creator_plugins';
$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
// Таблица для рекомендованных плагинов
$sql = "CREATE TABLE {$table_creator_plugins}(
	id int(15) unsigned auto_increment,
	name_plugin varchar(255) NOT NULL default '',
	check_plugin bit(1) NOT NULL default 0,
	active_plugin bit(1) NOT NULL default 0,
	path_plugin varchar(255) NOT NULL default '',
	field_plugin varchar(255) NOT NULL default '',
	PRIMARY KEY  (id),
	KEY name_plugin (name_plugin)
) {$charset_collate};";
dbDelta($sql);


