<?php

if(get_option("check-delivery") == 'checked') { add_filter( 'woocommerce_product_tabs', 'woo_delivery_product_tab' ); }
if(get_option("check-garant") == 'checked') { add_filter( 'woocommerce_product_tabs', 'woo_garant_product_tab' ); }
if(get_option("check-bay") == 'checked') { add_filter( 'woocommerce_product_tabs', 'woo_bay_product_tab' ); }

// Added the DELIVERY tab
function woo_delivery_product_tab($tabs)
{
	if(get_option("check-delivery") == 'checked'){
		$title = get_option("tabs-check-delivery-name");
		$priority = get_option("tabs-check-delivery-number");

		$tabs['delivery_tab'] = array(
			'title' => __( $title, 'woocommerce' ),
			'priority' => $priority,
			'callback' => 'woo_delivery_product_tab_content',
		);
		return $tabs;
	}
}
// Content the Delivery tab
function woo_delivery_product_tab_content()
{
	$content = get_option("tabs-check-delivery-content");
	echo do_shortcode(stripslashes($content));
}

// Added the GARANT tab
function woo_garant_product_tab($tabs)
{
	if(get_option("check-garant") == 'checked'){
		$title = get_option("tabs-check-garant-name");
		$priority = get_option("tabs-check-garant-number");

		$tabs['garant_tab'] = array(
			'title' => __( $title, 'woocommerce' ),
			'priority' => $priority,
			'callback' => 'woo_garant_product_tab_content',
		);
		return $tabs;
	}
}
// Content the Garant tab
function woo_garant_product_tab_content()
{
	$content = get_option("tabs-check-garant-content");
	echo do_shortcode(stripslashes($content));
}

// Added the BAY tab
function woo_bay_product_tab($tabs)
{
		$title = get_option("tabs-check-bay-name");
		$priority = get_option("tabs-check-bay-number");

		$tabs['bay_tab'] = array(
			'title' => __( $title, 'woocommerce' ),
			'priority' => $priority,
			'callback' => 'woo_bay_product_tab_content',
		);
		return $tabs;
}
// Content the bay tab
function woo_bay_product_tab_content()
{
	$content = get_option("tabs-check-bay-content");
	echo do_shortcode(stripslashes($content));
}