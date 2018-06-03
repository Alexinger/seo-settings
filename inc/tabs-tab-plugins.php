<?php

$settings = [];

add_option('check-update', 0);

$settings_required_plugins = [];
$get = 30;


$settings_recomended_plugins = array(
	'1' => array(
		'name' => 'a3 Lazy Load',
		'check' => is_plugin_active('a3-lazy-load/a3-lazy-load.php'),
		'active' => is_plugin_active('a3-lazy-load/a3-lazy-load.php'),
		'path' => 'a3-lazy-load/a3-lazy-load.php',
		'field' => 'plugin_field_recommended_1'
	),
	'2' => array(
		'name' => 'AdRotate',
		'check' => is_plugin_active('adrotate/adrotate.php'),
		'active' => is_plugin_active('adrotate/adrotate.php'),
		'path' => 'adrotate/adrotate.php',
		'field' => 'plugin_field_recommended_2'
	),
	'3' => array(
		'name' => 'Ajax Pagination and Infinite Scroll',
		'check' => false,
		'active' => false,
		'path' => '',
		'field' => 'plugin_field_recommended_3'
	),
	'4' => array(
		'name' => 'Cyr to Lat enhanced',
		'check' => is_plugin_active('cyr3lat/cyr-to-lat.php'),
		'active' => is_plugin_active('cyr3lat/cyr-to-lat.php'),
		'path' => 'cyr3lat/cyr-to-lat.php',
		'field' => 'plugin_field_recommended_4'
	),
	'5' => array(
		'name' => 'Disable All Wordpress Updates',
		'check' => is_plugin_active('disable-wordpress-updates/disable-updates.php'),
		'active' => is_plugin_active('disable-wordpress-updates/disable-updates.php'),
		'path' => 'disable-wordpress-updates/disable-updates.php',
		'field' => 'plugin_field_recommended_5'
	),
	'6' => array(
		'name' => 'DW Question Answer Pro',
		'check' => is_plugin_active('dw-question-answer-pro/dw-question-answer.php'),
		'active' => is_plugin_active('dw-question-answer-pro/dw-question-answer.php'),
		'path' => 'dw-question-answer-pro/dw-question-answer.php',
		'field' => 'plugin_field_recommended_6'
	),
	'7' => array(
		'name' => 'Galleries by Angie Makes',
		'check' => false,
		'active' => false,
		'path' => '',
		'field' => 'plugin_field_recommended_7'
	),
	'8' => array(
		'name' => 'Goods Catalog',
		'check' => is_plugin_active('goods-catalog/goods-cat.php'),
		'active' => is_plugin_active('goods-catalog/goods-cat.php'),
		'path' => 'goods-catalog/goods-cat.php',
		'field' => 'plugin_field_recommended_8'
	),
	'9' => array(
		'name' => 'Hierarchical HTML Sitemap',
		'check' => is_plugin_active('hierarchical-html-sitemap/hierarchical-sitemap.php'),
		'active' => is_plugin_active('hierarchical-html-sitemap/hierarchical-sitemap.php'),
		'path' => 'hierarchical-html-sitemap/hierarchical-sitemap.php',
		'field' => 'plugin_field_recommended_9'
	),
	'10' => array(
		'name' => 'Hyper Cache',
		'check' => is_plugin_active('hyper-cache/advanced-cache.php'),
		'active' => is_plugin_active('hyper-cache/advanced-cache.php'),
		'path' => 'hyper-cache/advanced-cache.php',
		'field' => 'plugin_field_recommended_10'
	),
	'11' => array(
		'name' => 'kk Star Ratings',
		'check' => is_plugin_active('kk-star-ratings/index.php'),
		'active' => is_plugin_active('kk-star-ratings/index.php'),
		'path' => 'kk-star-ratings/index.php',
		'field' => 'plugin_field_recommended_11'
	),
	'12' => array(
		'name' => 'Lightbox',
		'check' => false,
		'active' => false,
		'path' => '',
		'field' => 'plugin_field_recommended_12'
	),
	'13' => array(
		'name' => 'Q2W3 Fixed Widget',
		'check' => is_plugin_active('q2w3-fixed-widget/q2w3-fixed-widget.php'),
		'active' => is_plugin_active('q2w3-fixed-widget/q2w3-fixed-widget.php'),
		'path' => 'q2w3-fixed-widget/q2w3-fixed-widget.php',
		'field' => 'plugin_field_recommended_13'
	),
	'14' => array(
		'name' => 'Related Posts',
		'check' => false,
		'active' => false,
		'path' => '',
		'field' => 'plugin_field_recommended_14'
	),
	'15' => array(
		'name' => 'Subscribe to Comments Reloaded',
		'check' => is_plugin_active('subscribe-to-comments-reloaded/subscribe-to-comments-reloaded.php'),
		'active' => is_plugin_active('subscribe-to-comments-reloaded/subscribe-to-comments-reloaded.php'),
		'path' => 'subscribe-to-comments-reloaded/subscribe-to-comments-reloaded.php',
		'field' => 'plugin_field_recommended_15'
	),
	'16' => array(
		'name' => 'Table Press',
		'check' => is_plugin_active('tablepress/tablepress.php'),
		'active' => is_plugin_active('tablepress/tablepress.php'),
		'path' => 'tablepress/tablepress.php',
		'field' => 'plugin_field_recommended_16'
	),
	'17' => array(
		'name' => 'Taxonomy Images',
		'check' => is_plugin_active('taxonomy-images/taxonomy-images.php'),
		'active' => is_plugin_active('taxonomy-images/taxonomy-images.php'),
		'path' => 'taxonomy-images/taxonomy-images.php',
		'field' => 'plugin_field_recommended_17'
	),
	'18' => array(
		'name' => 'TotalPoll Pro',
		'check' => is_plugin_active('totalpool/totalpool.php'),
		'active' => is_plugin_active('totalpool/totalpool.php'),
		'path' => 'totalpool/totalpool.php',
		'field' => 'plugin_field_recommended_18'
	),
	'19' => array(
		'name' => 'wBounce',
		'check' => is_plugin_active('wbounce/wbounce.php'),
		'active' => is_plugin_active('wbounce/wbounce.php'),
		'path' => 'wbounce/wbounce.php',
		'field' => 'plugin_field_recommended_19'
	),
	'20' => array(
		'name' => 'Webcraftic Clearfy',
		'check' => false,
		'active' => false,
		'path' => '',
		'field' => 'plugin_field_recommended_20'
	),
	'21' => array(
		'name' => 'Widget Context',
		'check' => is_plugin_active('widget-context/widget-context.php'),
		'active' => is_plugin_active('widget-context/widget-context.php'),
		'path' => 'widget-context/widget-context.php',
		'field' => 'plugin_field_recommended_21'
	),
	'22' => array(
		'name' => 'WP No External Links',
		'check' => is_plugin_active('wp-noexternalinks/wp-noexternalinks.php'),
		'active' => is_plugin_active('wp-noexternalinks/wp-noexternalinks.php'),
		'path' => 'wp-noexternalinks/wp-noexternalinks.php',
		'field' => 'plugin_field_recommended_22'
	),
	'23' => array(
		'name' => 'WP-Optimize',
		'check' => is_plugin_active('wp-optimize/wp-optimize.php'),
		'active' => is_plugin_active('wp-optimize/wp-optimize.php'),
		'path' => 'wp-optimize/wp-optimize.php',
		'field' => 'plugin_field_recommended_23'
	),
	'24' => array(
		'name' => 'WPSmart Mobile',
		'check' => is_plugin_active('wpsmart-mobile/wpsmart.php'),
		'active' => is_plugin_active('wpsmart-mobile/wpsmart.php'),
		'path' => 'wpsmart-mobile/wpsmart.php',
		'field' => 'plugin_field_recommended_24'
	)
);
    global $wpdb;
    $prefix_db = $wpdb->get_blog_prefix() . 'seo_creator_plugins';
    $results = $wpdb->get_results("SELECT * FROM {$prefix_db}");
?>

<div class="block-modal-alert-plugin position-fixed m-auto">
    <div class="alert alert-success align-items-center text-center d-none save-plugin-alert align-items-center justify-content-center" role="alert"></div>
</div>

<form id="form-plugin">
	<button type="button" id="submit-plugin" class="list-group-item list-group-item-action bg-secondary text-white d-inline text-uppercase">
        <div class="d-inline-flex align-items-center" data-toggle="collapse" href="#collapseMainPlugins" role="button" aria-expanded="true"
             aria-controls="collapseMainPlugins"><i class="icon-main fa fa-angle-right fa-2x mx-2"></i><span data-toggle="tooltip" data-placement="top" title="Показать/Скрыть список" role="tooltip">Плагины</span></div>
        <span class="btn btn-sm ml-5 btn-light my-btn-new-field btn-outline-success" data-toggle="tooltip" data-placement="top" title="Добавить новую строку" style="vertical-align: super;"><i class="fa fa-plus"></i></span>
        <span id="submit-load-plugin" class="btn btn-sm ml-2 btn-light btn-outline-light" style="vertical-align: super;" data-toggle="tooltip" data-placement="top" title="Подгрузить готовый шаблон плагинов"><i class="fa fa-braille mr-1"></i> Загрузить набор плагинов</span>
        <input class="plugin-check" type="hidden" name="plugin-check" value="1">
        <span class="btn btn-link btn-sm bg-success ml-2 btn-light my-btn-save-field" style="vertical-align: super;">Сохранить</span>
        <span class="btn btn-sm ml-2 btn-light my-btn-new-field btn-outline-success" data-toggle="tooltip" data-placement="top" title="Обновить страницу" style="vertical-align: super;" onclick="location.reload();"><i class="fa fa-refresh"></i></span>
        <?php
        foreach ( $results as $result ){
	        if (is_plugin_active($result->path_plugin)){
		        $all_elm = $all_elm + 1;
	        }
	        $active_elm = $active_elm + 1;
        }
        ?>
        <span class="pull-right code mt-1 mr-3">Всего: <?php echo $active_elm = $active_elm == NULL ? 0 : $active_elm; ?></span>
        <span class="mx-3 pull-right code mt-1">Активных: <?php echo $all_elm = $all_elm == NULL ? 0 : $all_elm; ?></span>
	</button>
    <div class="collapse show" id="collapseMainPlugins">
    <ul class="list-group mt-3">
	<?php foreach ( $results as $result ) : ?>
		<li id="<?php echo $result->id; ?>" class="list-group-item d-flex align-items-center justify-content-between <?php echo is_plugin_active($result->path_plugin) ? "bg-active-font" : ""; ?>">
            <div class="w-100">
                <input class="no-active-fields w-50 my-1" name="name_plugins_<?php echo $result->id; ?>" value="<?php echo $result->name_plugin; ?>" readonly />
                <span class="mx-3 hidden block-edit-remove">
                    <i class="fa fa-edit text-success mx-1" title="редактировать"></i>
                    <i class="fa fa-times text-danger mx-1" title="удалить"></i>
                </span>
                <input type="hidden" name="<?php echo $result->id; ?>">
                <div class="w-100">
                    <input class="w-75 no-active-fields fields-path-plugin code text-lowercase text-info" name="path_plugins_<?php echo $result->id; ?>" value="<?php echo $result->path_plugin; ?>" readonly />
                    <i class="fa fa-pencil text-warning ml-3" title="изменить путь плагина"></i>
<!--                    <a class="popover-dismiss" tabindex="0" data-container="body" role="button" title="Описание плагина (тест)" data-toggle="popover" data-trigger="toggle" data-placement="right" data-content="--><?php
//                        echo $result->path_plugin;?><!--">-->
<!--                        <i class="fa fa-question-circle-o text-info ml-1"></i></a>-->
                </div>
            </div>

            <span>
				<span class="badge badge-pill font-weight-light mx-1 <?php echo is_plugin_active($result->path_plugin) ? "badge-success" : "badge-secondary"; ?>" style="padding-bottom: 5px;"><?php echo is_plugin_active($result->path_plugin) ? "Установлен и активирован" : "Не активирован или отсутсвует"; ?></span>
			</span>
		</li>
	<?php endforeach; ?>
</ul>
    </div>
    <button type="button" class="list-group-item list-group-item-action bg-info text-white d-inline text-uppercase" data-toggle="collapse" href="#collapseExtendedPlugins" role="button" aria-expanded="false"
            aria-controls="collapseExtendedPlugins" title="Показать/Скрыть список плагинов">
        <div class="d-inline-flex align-items-center"><i class="icon-extended fa fa-angle-right fa-2x mx-2"></i>Рекомендуемые плагины</div>
        <span>
            <i class="fa pull-right ml-4 mt-1 mr-2 <?php echo (count($settings_recomended_plugins) == get_option('check-active-plugins')) ? "fa-check-square-o text-warning" : "fa-exclamation-circle text-danger"; ?>" style="font-size: 22px;"></i>
        </span>
        <span class="pull-right code mt-1">Всего: <?php echo count($settings_recomended_plugins); ?></span>
        <span class="mx-3 pull-right code mt-1">Активных: <?php
			$get_element = 0;
			for( $i = 1 ; $i < count($settings_recomended_plugins); $i++){
				if($settings_recomended_plugins[$i]['active'] == true){
					//var_dump($settings_required_plugins[$i]['active']);
					$get_element = $get_element + 1;
				};
			}
			echo $get_element;
			?></span>
    </button>
    <div class="collapse" id="collapseExtendedPlugins">
    <ul class="list-group mt-3">

	<?php foreach ( $settings_recomended_plugins as $key => $massiv ) : ?>
	<li class="list-group-item d-flex align-items-center justify-content-between <?php echo $massiv['active'] == true ? "bg-active-font" : ""; ?>">
		<?php echo $massiv['name']; ?>
			<span class="align-items-center d-flex">
				<span class="badge badge-pill font-weight-light mx-1 <?php echo $massiv['check'] == true ? "badge-success" : "badge-secondary"; ?>" style="padding-bottom: 5px;"><?php echo $massiv['check'] == true ? "Установлен" : "Отсутсвует"; ?></span>
				<span class="badge badge-pill font-weight-light mx-1 <?php echo $massiv['active'] == true ? "badge-success" : "badge-secondary"; ?>" style="padding-bottom: 5px;"><?php echo $massiv['active'] == true ? "Активирован" : "Не активирован"; ?></span>
			</span>
		</li>
	<?php endforeach; ?>
    </ul>
    </div>
</form>
