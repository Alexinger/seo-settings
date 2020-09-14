<?php

// Добавляет название записи, страницы, товава в нутрь контента.
// Использовать нужно так [tov_title]

add_shortcode(get_option('title-shortcode-1'), 'tovar_title');
function tovar_title(){
	$get_tovar_title = "<span class='tovar-title'> " . esc_html(get_the_title($post)) . " </span>";
	return $get_tovar_title;
}

// Показывает все мета теги одной прокручивающейся строкой.
// Можно добавить 3 параметра [tov_meta size="16" sort="RAND" speed="4"]
// Использовать нужно так [tov_meta]
add_shortcode('tov_meta', 'tovar_meta');
function tovar_meta($attr){

	extract(shortcode_atts(array(
		"size" => '16',
		"sort" => 'RAND',
		"speed" => '10'
	), $attr));

	$tag = wp_tag_cloud( array(
		'smallest'                  => $size,
		'largest'                   => $size,
		'unit'                      => 'pt',
		'number'                    => 0,
		'format'                    => 'flat',
		'separator'                 => "\n",
		'orderby'                   => 'name',
		'order'                     => $attr['sort'],
		'exclude'                   => null,
		'include'                   => null,
		'topic_count_text_callback' => 'default_topic_count_text',
		'link'                      => 'view',
		'taxonomy'                  => 'post_tag',
		'echo'                      => false,
	) );

	return "<marquee onmouseover='this.stop()' onmouseout='this.start()' scrollamount='" . $speed . "'>" . $tag . "</marquee>";
}

// Показавые категорию в товаре или посте.
// Использовать нужно так [cat_title]
add_shortcode('cat_title', 'categoryes_title');
function categoryes_title(){
	$categories = get_queried_object()->name;
	return esc_html($categories);
}
