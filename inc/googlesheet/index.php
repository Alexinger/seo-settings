<?php

global $shortcode_tags;

// include_once 'opt-price.php'; not code
include_once 'show-table-shortcode.php';
// Set product quantity added to cart (handling ajax add to cart)
if (!get_option('statusTable')) {
    add_filter('woocommerce_add_to_cart_quantity', 'woocommerce_add_to_cart_quantity_callback', 10, 2);
    function woocommerce_add_to_cart_quantity_callback($quantity, $product_id)
    {
        if ($quantity < get_option('1_row_left')) {
            $quantity = get_option('1_row_left');
        }
        return $quantity;
    }

// Set the product quantity min value
    add_filter('woocommerce_quantity_input_args', 'woocommerce_quantity_input_args_callback', 10, 2);
    function woocommerce_quantity_input_args_callback($args, $product)
    {
        // $args['input_value'] = get_option('1_row_left');
        $args['min_value'] = get_option('1_row_left');
        // $args['input_value'] = is_cart() ? $args['input_value'] : get_option('1_row_left');
        return $args;
    }

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

        // hi
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

        // Check is_in_stock one page products
        if ($addp) {
            if ($product->is_in_stock()) {
                // are available
                echo '<p class="price">' . apply_filters('woocommerce_get_price_html', '<span style="font-size: 20px;font-family: \'Open Sans\';">от </span>' . $price, $product) . '</p>';
            } else {
                // not stock
                echo "<a href='/404' class='button woocommerce-store-notice' style='margin-bottom: 15px'>Перейти в контакты</a>";
            }
        } else {
            $this_price = $product->get_price() . ' ₽';
            echo $this_price;
        }
    }

    function getTemperature($item)
    {
        $str = strpos($item, '-');
        $temperature = substr($item, $str + 1, 2);
        if ($str) {
            return checkPriceSum($temperature);
        } else {
            return false;
        }
    }

//function getCount($item)
//{
//    return preg_replace('/[^0-9]/', '', $item);
//}

    function checkPriceSum($item = null)
    {
        $temperAll = [mb_strimwidth(get_option('0_row_1_header'), 0, 3), mb_strimwidth(get_option('0_row_2_header'), 0, 3), mb_strimwidth(get_option('0_row_3_header'), 0, 3), mb_strimwidth(get_option('0_row_4_header'), 0, 3), mb_strimwidth(get_option('0_row_5_header'), 0, 3), mb_strimwidth(get_option('0_row_6_header'), 0, 3), mb_strimwidth(get_option('0_row_7_header'), 0, 3), mb_strimwidth(get_option('0_row_8_header'), 0, 3), mb_strimwidth(get_option('0_row_9_header'), 0, 3), mb_strimwidth(get_option('0_row_10_header'), 0, 3)];

        $index = array_search($item, getCount($temperAll)) + 1; // index number && search column price

        // var_dump(getCount($temperAll));

        $filterPrice = array_filter([is_numeric(get_option('1_row_' . $index . '_header')) ? get_option('1_row_' . $index . '_header') : '',
            is_numeric(get_option('2_row_' . $index . '_header')) ? get_option('2_row_' . $index . '_header') : '',
            is_numeric(get_option('3_row_' . $index . '_header')) ? get_option('3_row_' . $index . '_header') : '',
            is_numeric(get_option('4_row_' . $index . '_header')) ? get_option('4_row_' . $index . '_header') : '',
            is_numeric(get_option('5_row_' . $index . '_header')) ? get_option('5_row_' . $index . '_header') : '',
            is_numeric(get_option('6_row_' . $index . '_header')) ? get_option('6_row_' . $index . '_header') : '',
            is_numeric(get_option('7_row_' . $index . '_header')) ? get_option('7_row_' . $index . '_header') : '',
            is_numeric(get_option('8_row_' . $index . '_header')) ? get_option('8_row_' . $index . '_header') : '',
            is_numeric(get_option('9_row_' . $index . '_header')) ? get_option('9_row_' . $index . '_header') : '',
            is_numeric(get_option('10_row_' . $index . '_header')) ? get_option('9_row_' . $index . '_header') : '',
            is_numeric(get_option('11_row_' . $index . '_header')) ? get_option('10_row_' . $index . '_header') : '',
            is_numeric(get_option('12_row_' . $index . '_header')) ? get_option('12_row_' . $index . '_header') : '',
            is_numeric(get_option('13_row_' . $index . '_header')) ? get_option('13_row_' . $index . '_header') : '',
            is_numeric(get_option('14_row_' . $index . '_header')) ? get_option('14_row_' . $index . '_header') : '',
            is_numeric(get_option('15_row_' . $index . '_header')) ? get_option('15_row_' . $index . '_header') : '']);
        return min($filterPrice);
    }

    function getMinPrice($item, $price)
    {
        $minPrice5 = min(array_filter([get_option('1_row_0_header'), get_option('2_row_0_header'), get_option('3_row_0_header'), get_option('4_row_0_header'), get_option('5_row_0_header'), get_option('6_row_0_header'), get_option('7_row_0_header'), get_option('8_row_0_header'), get_option('9_row_0_header'), get_option('10_row_0_header'), get_option('11_row_0_header'), get_option('12_row_0_header'), get_option('13_row_0_header'), get_option('14_row_0_header'), get_option('15_row_0_header')], 'strlen'));
        $minPrice10 = min(array_filter([get_option('1_row_1_header'), get_option('2_row_1_header'), get_option('3_row_1_header'), get_option('4_row_1_header'), get_option('5_row_1_header'), get_option('6_row_1_header'), get_option('7_row_1_header'), get_option('8_row_1_header'), get_option('9_row_1_header'), get_option('10_row_1_header'), get_option('11_row_1_header'), get_option('12_row_1_header'), get_option('13_row_1_header'), get_option('14_row_1_header'), get_option('15_row_1_header')], 'strlen'));
        $minPrice15 = min(array_filter([get_option('1_row_2_header'), get_option('2_row_2_header'), get_option('3_row_2_header'), get_option('4_row_2_header'), get_option('5_row_2_header'), get_option('6_row_2_header'), get_option('7_row_2_header'), get_option('8_row_2_header'), get_option('9_row_2_header'), get_option('10_row_2_header'), get_option('11_row_2_header'), get_option('12_row_2_header'), get_option('13_row_2_header'), get_option('14_row_2_header'), get_option('15_row_2_header')], 'strlen'));
        $minPrice20 = min(array_filter([get_option('1_row_3_header'), get_option('2_row_3_header'), get_option('3_row_3_header'), get_option('4_row_3_header'), get_option('5_row_3_header'), get_option('6_row_3_header'), get_option('7_row_3_header'), get_option('8_row_3_header'), get_option('9_row_3_header'), get_option('10_row_3_header'), get_option('11_row_3_header'), get_option('12_row_3_header'), get_option('13_row_3_header'), get_option('14_row_3_header'), get_option('15_row_3_header')], 'strlen'));
        $minPrice25 = min(array_filter([get_option('1_row_4_header'), get_option('2_row_4_header'), get_option('3_row_4_header'), get_option('4_row_4_header'), get_option('5_row_4_header'), get_option('6_row_4_header'), get_option('7_row_4_header'), get_option('8_row_4_header'), get_option('9_row_4_header'), get_option('10_row_4_header'), get_option('11_row_4_header'), get_option('12_row_4_header'), get_option('13_row_4_header'), get_option('14_row_4_header'), get_option('15_row_4_header')], 'strlen'));
        $minPrice30 = min(array_filter([get_option('1_row_5_header'), get_option('2_row_5_header'), get_option('3_row_5_header'), get_option('4_row_5_header'), get_option('5_row_5_header'), get_option('6_row_5_header'), get_option('7_row_5_header'), get_option('8_row_5_header'), get_option('9_row_5_header'), get_option('10_row_5_header'), get_option('11_row_5_header'), get_option('12_row_5_header'), get_option('13_row_5_header'), get_option('14_row_5_header'), get_option('15_row_5_header')], 'strlen'));
        $minPrice35 = min(array_filter([get_option('1_row_6_header'), get_option('2_row_6_header'), get_option('3_row_6_header'), get_option('4_row_6_header'), get_option('5_row_6_header'), get_option('6_row_6_header'), get_option('7_row_6_header'), get_option('8_row_6_header'), get_option('9_row_6_header'), get_option('10_row_6_header'), get_option('11_row_6_header'), get_option('12_row_6_header'), get_option('13_row_6_header'), get_option('14_row_6_header'), get_option('15_row_6_header')], 'strlen'));
        $minPrice40 = min(array_filter([get_option('1_row_7_header'), get_option('2_row_7_header'), get_option('3_row_7_header'), get_option('4_row_7_header'), get_option('5_row_7_header'), get_option('6_row_7_header'), get_option('7_row_7_header'), get_option('8_row_7_header'), get_option('9_row_7_header'), get_option('10_row_7_header'), get_option('11_row_7_header'), get_option('12_row_7_header'), get_option('13_row_7_header'), get_option('14_row_7_header'), get_option('15_row_7_header')], 'strlen'));
        $minPrice45 = min(array_filter([get_option('1_row_8_header'), get_option('2_row_8_header'), get_option('3_row_8_header'), get_option('4_row_8_header'), get_option('5_row_8_header'), get_option('6_row_8_header'), get_option('7_row_8_header'), get_option('8_row_8_header'), get_option('9_row_8_header'), get_option('10_row_8_header'), get_option('11_row_8_header'), get_option('12_row_8_header'), get_option('13_row_8_header'), get_option('14_row_8_header'), get_option('15_row_8_header')], 'strlen'));
        $minPrice50 = min(array_filter([get_option('1_row_9_header'), get_option('2_row_9_header'), get_option('3_row_9_header'), get_option('4_row_9_header'), get_option('5_row_9_header'), get_option('6_row_9_header'), get_option('7_row_9_header'), get_option('8_row_9_header'), get_option('9_row_9_header'), get_option('10_row_9_header'), get_option('11_row_9_header'), get_option('12_row_9_header'), get_option('13_row_9_header'), get_option('14_row_9_header'), get_option('15_row_9_header')], 'strlen'));
        $minPrice55 = min(array_filter([get_option('1_row_10_header'), get_option('2_row_10_header'), get_option('3_row_10_header'), get_option('4_row_10_header'), get_option('5_row_10_header'), get_option('6_row_10_header'), get_option('7_row_10_header'), get_option('8_row_10_header'), get_option('9_row_10_header'), get_option('10_row_10_header'), get_option('11_row_10_header'), get_option('12_row_10_header'), get_option('13_row_10_header'), get_option('14_row_10_header'), get_option('15_row_10_header')], 'strlen'));
        $minPrice60 = min(array_filter([get_option('1_row_11_header'), get_option('2_row_11_header'), get_option('3_row_11_header'), get_option('4_row_11_header'), get_option('5_row_11_header'), get_option('6_row_11_header'), get_option('7_row_11_header'), get_option('8_row_11_header'), get_option('9_row_11_header'), get_option('10_row_11_header'), get_option('11_row_11_header'), get_option('12_row_11_header'), get_option('13_row_11_header'), get_option('14_row_11_header'), get_option('15_row_11_header')], 'strlen'));

        switch ((string)$item) {
            case '5' :
                return getNumeric($minPrice5) ? $minPrice5 : $price;
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
            case '45' :
                return getNumeric($minPrice45) ? $minPrice45 : $price;
            case '50' :
                return getNumeric($minPrice50) ? $minPrice50 : $price;
            case '55' :
                return getNumeric($minPrice55) ? $minPrice55 : $price;
            case '60' :
                return getNumeric($minPrice60) ? $minPrice60 : $price;
            default :
                return $price;
        }
    }

    function getNumeric($item)
    {
        return preg_replace('/[^0-9]/', '', $item);
    }
}