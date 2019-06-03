<?php

/**
 * Получает информацию обо всех зарегистрированных размерах картинок.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 *
 * @param  boolean [$unset_disabled = true] Удалить из списка размеры с 0 высотой и шириной?
 * @return array Данные всех размеров.
 */

function get_image_sizes( $unset_disabled = true ) {
	$wais = & $GLOBALS['_wp_additional_image_sizes'];

	$sizes = array();

    // Отключаем разметку srcset
    add_filter('max_srcset_image_width', create_function('', 'return 1;'));

// Отключаем создание 768px изображений
    function unset_medium_large($sizes) {
        unset($sizes['medium_large']);
        return $sizes;
    }
    add_filter('intermediate_image_sizes_advanced', 'unset_medium_large');

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ] = array(
				'width'  => get_option( "{$_size}_size_w" ),
				'height' => get_option( "{$_size}_size_h" ),
				'crop'   => (bool) get_option( "{$_size}_crop" ),
			);
		}
        elseif ( isset( $wais[$_size] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $wais[ $_size ]['width'],
				'height' => $wais[ $_size ]['height'],
				'crop'   => $wais[ $_size ]['crop'],
			);
		}

		// size registered, but has 0 width and height
		if( $unset_disabled && ($sizes[ $_size ]['width'] == 0) && ($sizes[ $_size ]['height'] == 0) )
			unset( $sizes[ $_size ] );
	}

	return $sizes;
};

?>

<pre><?php print_r(get_image_sizes()); ?></pre>