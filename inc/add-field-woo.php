<?php

// Перехватываем
add_filter( 'woocommerce_default_address_fields' , 'no_required_checkout_fields' );
add_filter( 'woocommerce_checkout_fields' , 'no_required_checkout_fields' );
function no_required_checkout_fields( $fields ) {

	$fields['order']['order_comments']['placeholder'] = get_option('bil-field-orders');
	// no required Shipping
	if(get_option('bil-field-first-name') == 'checked'){$fields['billing']['billing_first_name']['required'] = false;}else{$fields['billing']['billing_first_name']['required'] = true;}
	if(get_option('bil-field-last-name') == 'checked'){$fields['billing']['billing_last_name']['required'] = false;}else{$fields['billing']['billing_last_name']['required'] = true;}
	if(get_option('bil-field-company') == 'checked'){$fields['billing']['billing_company']['required'] = false;}else{$fields['billing']['billing_company']['required'] = true;}
	if(get_option('bil-field-country') == 'checked'){$fields['billing']['billing_country']['required'] = false;}else{$fields['billing']['billing_country']['required'] = true;}
	if(get_option('bil-field-address-1') == 'checked'){$fields['address_1']['required'] = false;}else{$fields['address_1']['required'] = true;}
	if(get_option('bil-field-address-2') == 'checked'){$fields['billing']['billing_address_2']['required'] = false;}else{$fields['billing']['billing_address_2']['required'] = true;}
	if(get_option('bil-field-city') == 'checked'){$fields['city']['required'] = false;}else{$fields['city']['required'] = true;}
	if(get_option('bil-field-state') == 'checked'){$fields['state']['required'] = false;}else{$fields['state']['required'] = true;}
	if(get_option('bil-field-postcode') == 'checked'){$fields['postcode']['required'] = false;}else{$fields['postcode']['required'] = true;}
	if(get_option('bil-field-phone') == 'checked'){$fields['billing']['billing_phone']['required'] = false;}else{$fields['billing']['billing_phone']['required'] = true;}
	if(get_option('bil-field-email') == 'checked'){$fields['billing']['billing_email']['required'] = false;}else{$fields['billing']['billing_email']['required'] = true;}

	// remove field Billing
	if(get_option('bil-remove-field-first-name') == 'checked'){unset($fields['billing']['billing_first_name']);}
	if(get_option('bil-remove-field-last-name') == 'checked'){unset($fields['billing']['billing_last_name']);}
	if(get_option('bil-remove-field-company') == 'checked'){unset($fields['billing']['billing_company']);}
	if(get_option('bil-remove-field-country') == 'checked'){unset($fields['billing']['billing_country']);}
	if(get_option('bil-remove-field-address-1') == 'checked'){unset($fields['billing']['billing_address_1']);}
	if(get_option('bil-remove-field-address-2') == 'checked'){unset($fields['billing']['billing_address_2']);}
	if(get_option('bil-remove-field-city') == 'checked'){unset($fields['billing']['billing_city']);}
	if(get_option('bil-remove-field-state') == 'checked'){unset($fields['billing']['billing_state']);}
	if(get_option('bil-remove-field-postcode') == 'checked'){unset($fields['billing']['billing_postcode']);}
	if(get_option('bil-remove-field-phone') == 'checked'){unset($fields['billing']['billing_phone']);}
	if(get_option('bil-remove-field-email') == 'checked'){unset($fields['billing']['billing_email']);}

	// no required Shipping
//	if(get_option('ship-field-last-name') == 'checked'){$fields['shipping']['shipping_last_name']['required'] = false;}else{$fields['shipping']['shipping_last_name']['required'] = true;}
//	if(get_option('ship-field-address') == 'checked'){$fields['shipping']['shipping_address_1']['required'] = false;}else{$fields['shipping']['shipping_address_1']['required'] = true;}
//	if(get_option('ship-field-phone') == 'checked'){$fields['shipping']['shipping_phone']['required'] = false;}else{$fields['shipping']['shipping_phone']['required'] = true;}
//	if(get_option('ship-field-postcode') == 'checked'){$fields['shipping']['shipping_postcode']['required'] = false;}else{$fields['shipping']['shipping_postcode']['required'] = true;}
//	if(get_option('ship-field-state') == 'checked'){$fields['shipping']['shipping_state']['required'] = false;}else{$fields['shipping']['shipping_state']['required'] = true;}
	return $fields;
}
/*Убрали ненужные поля формы оформления заказа*/
// add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {



	// unset($fields['billing']['billing_billing']);
	// unset($fields['shipping']['shipping_country']);

	// remove field Billing
//	if(get_option('bil-remove-field-company') == 'checked'){unset($fields['billing']['billing_company']);}
	// if(get_option('bil-remove-field-country') == 'checked'){unset($fields['billing']['billing_country']);}
//	if(get_option('bil-remove-field-state') == 'checked'){unset($fields['billing']['billing_state']);}
//	if(get_option('bil-remove-field-postcode') == 'checked'){unset($fields['billing']['billing_postcode']);}

	// remove field Shipping
//	if(get_option('ship-remove-field-company') == 'checked'){unset($fields['shipping']['shipping_company']);}
	// if(get_option('ship-remove-field-country') == 'checked'){unset($fields['shipping']['shipping_country']);}
//	if(get_option('ship-remove-field-state') == 'checked'){unset($fields['shipping']['shipping_state']);}
//	if(get_option('ship-remove-field-postcode') == 'checked'){unset($fields['shipping']['shipping_postcode']);}
//	if(get_option('ship-remove-field-phone') == 'checked'){unset($fields['shipping']['shipping_phone']);}

//	$fields['order']['order_comments']['placeholder'] = 'Можете указать то, что важно для вас, например, пожелания по доставке ...';
//	return $fields;
}