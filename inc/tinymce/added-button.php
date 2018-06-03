<?php

/**
* Add "Styles" drop-down
*/
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
	function tuts_mce_editor_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
}

/**
* Add styles/classes to the "Styles" drop-down
*/
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
function tuts_mce_before_init( $settings ) {
	$style_formats = array(
		array(
			'title' => 'Теги для страницы',
			'items' => array(
				array(
					'title' => 'Горизонтальный блок - строка (row)',
					'block' => 'div',
					'classes' => 'row',
					'wrapper' => true
				),
				array(
					'title' => 'Вертикальные блоки 3/9 (col)',
					'block' => 'div',
					'classes' => 'col-3 col-md-3 col-lg-3',
					'wrapper' => true
				)
			)
		),
		array(
			'title' => 'Testimonial',
			'selector' => 'p',
			'classes' => 'testimonial',
		),
		array(
			'title' => 'Warning Box',
			'block' => 'div',
			'classes' => 'warning box',
			'wrapper' => true
		),
		array(
			'title' => 'Red Uppercase Text',
			'inline' => 'span',
			'styles' => array(
				'color' => '#ff0000',
				'fontWeight' => 'bold',
				'textTransform' => 'uppercase'
			)
		)
);

$settings['style_formats'] = json_encode( $style_formats );
	return $settings;
}
