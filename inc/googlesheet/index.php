<?php

global $shortcode_tags;

// include_once 'opt-price.php'; not code
include_once 'show-table-shortcode.php';

/* Для страницы товара задаем минимальную цену из таблицы*/
add_filter('woocommerce_quantity_input_min', 'truemisha_min_kolvo', 100, 2);

function truemisha_min_kolvo($min, $product)
{
    return get_option('1_row_left');
}

/* Для товара в корзине, задаем минимальную цену из таблицы */
add_filter('woocommerce_cart_item_quantity', 'truemisha_min_kolvo_cart', 100, 3);

function truemisha_min_kolvo_cart($product_quantity, $cart_item_key, $cart_item)
{

    $product = $cart_item['data'];
    $min = get_option('1_row_left');


    return woocommerce_quantity_input(
        array(
            'input_name' => "cart[{$cart_item_key}][qty]",
            'input_value' => $cart_item['quantity'],
            'max_value' => $product->get_max_purchase_quantity(),
            'min_value' => $min,
            'product_name' => $product->get_name(),
        ),
        $product,
        false
    );
}

// Simple, grouped and external products
// add_filter('woocommerce_product_get_regular_price', 'custom_price', 9, 2);
// add_filter('woocommerce_product_get_price', 'custom_price', 9, 2);

function custom_price($price, $product)
{
    $str = strpos($product->name, '-');
    $temperatures = substr($product->name, $str + 1, 2);

    // return getMinPrice($temperatures, $price);
    return checkPriceSum($temperatures);

}

// Added a new product price from the google table
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'custom_simple_product_price_html', 10);
function custom_simple_product_price_html()
{
    global $product;
    $addp = getTemperature($product->name);
    $price = wc_price($addp) . $product->get_price_suffix();
    echo '<p class="price">' . apply_filters('woocommerce_get_price_html', '<span style="font-size: 20px;font-family: \'Open Sans\';">от </span>' . $price, $product) . '</p>';
}

function getTemperature($item)
{
    $str = strpos($item, '-');
    $temperature = substr($item, $str + 1, 2);
    return checkPriceSum($temperature);
}

function checkPriceSum($item = null)
{
    // UpdatePrice::update_get_option();

    $filterPrice10 = array_filter([is_numeric(get_option('1_row_1_header')) ? get_option('1_row_1_header') : '',
    is_numeric(get_option('2_row_1_header')) ? get_option('2_row_1_header') : '',
    is_numeric(get_option('3_row_1_header')) ? get_option('3_row_1_header') : '',
    is_numeric(get_option('4_row_1_header')) ? get_option('4_row_1_header') : '',
    is_numeric(get_option('5_row_1_header')) ? get_option('5_row_1_header') : '',
    is_numeric(get_option('6_row_1_header')) ? get_option('6_row_1_header') : '',
    is_numeric(get_option('7_row_1_header')) ? get_option('7_row_1_header') : '',
    is_numeric(get_option('8_row_1_header')) ? get_option('8_row_1_header') : '',
    is_numeric(get_option('9_row_1_header')) ? get_option('9_row_1_header') : '',
    is_numeric(get_option('10_row_1_header')) ? get_option('10_row_1_header') : '']);

    $filterPrice15 = array_filter([is_numeric(get_option('1_row_2_header')) ? get_option('1_row_2_header') : '',
        is_numeric(get_option('2_row_2_header')) ? get_option('2_row_2_header') : '',
        is_numeric(get_option('3_row_2_header')) ? get_option('3_row_2_header') : '',
        is_numeric(get_option('4_row_2_header')) ? get_option('4_row_2_header') : '',
        is_numeric(get_option('5_row_2_header')) ? get_option('5_row_2_header') : '',
        is_numeric(get_option('6_row_2_header')) ? get_option('6_row_2_header') : '',
        is_numeric(get_option('7_row_2_header')) ? get_option('7_row_2_header') : '',
        is_numeric(get_option('8_row_2_header')) ? get_option('8_row_2_header') : '',
        is_numeric(get_option('9_row_2_header')) ? get_option('9_row_2_header') : '',
        is_numeric(get_option('10_row_2_header')) ? get_option('10_row_2_header') : '']);

    $filterPrice20 = array_filter([is_numeric(get_option('1_row_3_header')) ? get_option('1_row_3_header') : '',
        is_numeric(get_option('2_row_3_header')) ? get_option('2_row_3_header') : '',
        is_numeric(get_option('3_row_3_header')) ? get_option('3_row_3_header') : '',
        is_numeric(get_option('4_row_3_header')) ? get_option('4_row_3_header') : '',
        is_numeric(get_option('5_row_3_header')) ? get_option('5_row_3_header') : '',
        is_numeric(get_option('6_row_3_header')) ? get_option('6_row_3_header') : '',
        is_numeric(get_option('7_row_3_header')) ? get_option('7_row_3_header') : '',
        is_numeric(get_option('8_row_3_header')) ? get_option('8_row_3_header') : '',
        is_numeric(get_option('9_row_3_header')) ? get_option('9_row_3_header') : '',
        is_numeric(get_option('10_row_3_header')) ? get_option('10_row_3_header') : '']);

    $filterPrice25 = array_filter([is_numeric(get_option('1_row_4_header')) ? get_option('1_row_4_header') : '',
        is_numeric(get_option('2_row_4_header')) ? get_option('2_row_4_header') : '',
        is_numeric(get_option('3_row_4_header')) ? get_option('3_row_4_header') : '',
        is_numeric(get_option('4_row_4_header')) ? get_option('4_row_4_header') : '',
        is_numeric(get_option('5_row_4_header')) ? get_option('5_row_4_header') : '',
        is_numeric(get_option('6_row_4_header')) ? get_option('6_row_4_header') : '',
        is_numeric(get_option('7_row_4_header')) ? get_option('7_row_4_header') : '',
        is_numeric(get_option('8_row_4_header')) ? get_option('8_row_4_header') : '',
        is_numeric(get_option('9_row_4_header')) ? get_option('9_row_4_header') : '',
        is_numeric(get_option('10_row_4_header')) ? get_option('10_row_4_header') : '']);

    $filterPrice30 = array_filter([is_numeric(get_option('1_row_5_header')) ? get_option('1_row_5_header') : '',
        is_numeric(get_option('2_row_5_header')) ? get_option('2_row_5_header') : '',
        is_numeric(get_option('3_row_5_header')) ? get_option('3_row_5_header') : '',
        is_numeric(get_option('4_row_5_header')) ? get_option('4_row_5_header') : '',
        is_numeric(get_option('5_row_5_header')) ? get_option('5_row_5_header') : '',
        is_numeric(get_option('6_row_5_header')) ? get_option('6_row_5_header') : '',
        is_numeric(get_option('7_row_5_header')) ? get_option('7_row_5_header') : '',
        is_numeric(get_option('8_row_5_header')) ? get_option('8_row_5_header') : '',
        is_numeric(get_option('9_row_5_header')) ? get_option('9_row_5_header') : '',
        is_numeric(get_option('10_row_5_header')) ? get_option('10_row_5_header') : '']);

    $filterPrice35 = array_filter([is_numeric(get_option('1_row_6_header')) ? get_option('1_row_6_header') : '',
        is_numeric(get_option('2_row_6_header')) ? get_option('2_row_6_header') : '',
        is_numeric(get_option('3_row_6_header')) ? get_option('3_row_6_header') : '',
        is_numeric(get_option('4_row_6_header')) ? get_option('4_row_6_header') : '',
        is_numeric(get_option('5_row_6_header')) ? get_option('5_row_6_header') : '',
        is_numeric(get_option('6_row_6_header')) ? get_option('6_row_6_header') : '',
        is_numeric(get_option('7_row_6_header')) ? get_option('7_row_6_header') : '',
        is_numeric(get_option('8_row_6_header')) ? get_option('8_row_6_header') : '',
        is_numeric(get_option('9_row_6_header')) ? get_option('9_row_6_header') : '',
        is_numeric(get_option('10_row_6_header')) ? get_option('10_row_6_header') : '']);

    $filterPrice40 = array_filter([is_numeric(get_option('1_row_7_header')) ? get_option('1_row_7_header') : '',
        is_numeric(get_option('2_row_7_header')) ? get_option('2_row_7_header') : '',
        is_numeric(get_option('3_row_7_header')) ? get_option('3_row_7_header') : '',
        is_numeric(get_option('4_row_7_header')) ? get_option('4_row_7_header') : '',
        is_numeric(get_option('5_row_7_header')) ? get_option('5_row_7_header') : '',
        is_numeric(get_option('6_row_7_header')) ? get_option('6_row_7_header') : '',
        is_numeric(get_option('7_row_7_header')) ? get_option('7_row_7_header') : '',
        is_numeric(get_option('8_row_7_header')) ? get_option('8_row_7_header') : '',
        is_numeric(get_option('9_row_7_header')) ? get_option('9_row_7_header') : '',
        is_numeric(get_option('10_row_7_header')) ? get_option('10_row_7_header') : '']);

    switch ($item) {
        case '10' :
            return min($filterPrice10);
        case '15' :
            return min($filterPrice15);
        case '20' :
            return $filterPrice20[6];
        case '25' :
            return min($filterPrice25);
        case '30' :
            return min($filterPrice30);
        case '35' :
            return min($filterPrice35);
        case '40' :
            return min($filterPrice40);
    }
}

function getMinPrice($item, $price)
{
    $minPrice10 = min(array_filter([get_option('1_row_1_header'), get_option('2_row_1_header'), get_option('3_row_1_header'), get_option('4_row_1_header'), get_option('5_row_1_header'), get_option('6_row_1_header'), get_option('7_row_1_header'), get_option('8_row_1_header'), get_option('9_row_1_header'), get_option('10_row_1_header')], 'strlen'));
    $minPrice15 = min(array_filter([get_option('1_row_2_header'), get_option('2_row_2_header'), get_option('3_row_2_header'), get_option('4_row_2_header'), get_option('5_row_2_header'), get_option('6_row_2_header'), get_option('7_row_2_header'), get_option('8_row_2_header'), get_option('9_row_2_header'), get_option('10_row_2_header')], 'strlen'));
    $minPrice20 = min(array_filter([get_option('1_row_3_header'), get_option('2_row_3_header'), get_option('3_row_3_header'), get_option('4_row_3_header'), get_option('5_row_3_header'), get_option('6_row_3_header'), get_option('7_row_3_header'), get_option('8_row_3_header'), get_option('9_row_3_header'), get_option('10_row_3_header')], 'strlen'));
    $minPrice25 = min(array_filter([get_option('1_row_4_header'), get_option('2_row_4_header'), get_option('3_row_4_header'), get_option('4_row_4_header'), get_option('5_row_4_header'), get_option('6_row_4_header'), get_option('7_row_4_header'), get_option('8_row_4_header'), get_option('9_row_4_header'), get_option('10_row_4_header')], 'strlen'));
    $minPrice30 = min(array_filter([get_option('1_row_5_header'), get_option('2_row_5_header'), get_option('3_row_5_header'), get_option('4_row_5_header'), get_option('5_row_5_header'), get_option('6_row_5_header'), get_option('7_row_5_header'), get_option('8_row_5_header'), get_option('9_row_5_header'), get_option('10_row_5_header')], 'strlen'));
    $minPrice35 = min(array_filter([get_option('1_row_6_header'), get_option('2_row_6_header'), get_option('3_row_6_header'), get_option('4_row_6_header'), get_option('5_row_6_header'), get_option('6_row_6_header'), get_option('7_row_6_header'), get_option('8_row_6_header'), get_option('9_row_6_header'), get_option('10_row_6_header')], 'strlen'));
    $minPrice40 = min(array_filter([get_option('1_row_7_header'), get_option('2_row_7_header'), get_option('3_row_7_header'), get_option('4_row_7_header'), get_option('5_row_7_header'), get_option('6_row_7_header'), get_option('7_row_7_header'), get_option('8_row_7_header'), get_option('9_row_7_header'), get_option('10_row_7_header')], 'strlen'));

    switch ((string)$item) {
        case '10' :
            return getNumeric($minPrice10) ? $minPrice10 : $price;
        case '15' :
            return getNumeric($minPrice15) ? $minPrice15 : $price;
        case '20' :
            return getNumeric($minPrice20) ? $minPrice20 : $price;
        case '25' :
            return getNumeric($minPrice25) ? $minPrice25 : $price;
        case '30' :
            return getNumeric($minPrice30) ? $minPrice30 : $price;
        case '35' :
            return getNumeric($minPrice35) ? $minPrice35 : $price;
        case '40' :
            return getNumeric($minPrice40) ? $minPrice40 : $price;
        default :
            return $price;
    }
}

function getNumeric($item)
{
    return preg_replace('/[^0-9]/', '', $item);
}
