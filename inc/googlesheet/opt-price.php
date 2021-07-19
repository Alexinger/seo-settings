<?php

include_once 'UpdatePrice.php';
$left_1 = $left_2 = $left_3 = $left_4 = $left_5 = $left_6 = $left_7 = $left_8 = $left_9 = $left_10 = '';
// Add custom calculated price to cart item data
//add_filter('woocommerce_add_cart_item_data', 'add_cart_simple_product_custom_price', 1, 4);
//function add_cart_simple_product_custom_price($cart_item_data, $product_id)
//{
//    $product = wc_get_product($product_id); // The WC_Product Object
//    // Only if product is not on sale
//    if ($product->is_on_sale())
//        return $cart_item_data;
//    $price = (float)$product->get_price();
//    // Set the custom amount in cart object
//    $cart_item_data['new_price'] = $price + 10;
//
//    return $cart_item_data;
//}
//add_action('woocommerce_checkout_update_order_review', 'add_custom_price', 1000, 2);

// add_action('woocommerce_review_order_before_shipping', 'add_custom_price', 1000, 2);

add_action('woocommerce_calculate_totals', 'add_custom_price', 25, 2);

function add_custom_price($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    $gid = get_option("tabs-shortcode-url");
    $id = get_option("tabs-shortcode-page");
    $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);

    if ($csv) {
        $update = new UpdatePrice();
        $update->update_get_option();
    }

    $left_1 = $left_2 = $left_3 = $left_4 = $left_5 = $left_6 = $left_7 = $left_8 = $left_9 = $left_10 = 0;
    // create variables left_1-10
    for ($i = 1; $i < 11; $i++) {
        ${"left_$i"} = get_option($i . '_row_left');
    }

    foreach ($cart->get_cart() as $cart_item_key => $item) {
        $terms = get_the_terms($item['product_id'], 'product_cat');
        $rowArray = max([$left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10]); // max value counter first row the table
        // all row on table, temperature
        $temperAll = [get_option('0_row_0_header'), get_option('0_row_1_header'), get_option('0_row_2_header'), get_option('0_row_3_header'), get_option('0_row_4_header'), get_option('0_row_5_header'), get_option('0_row_6_header'), get_option('0_row_7_header'), get_option('0_row_8_header'), get_option('0_row_9_header')];
        $count = $item['quantity']; // this count products
        $val = array_search(removeSymbols($terms), $temperAll); // index number && search column price

        getPriceProductsBack($val, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10);
    }

}
//function add_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {}
//add_action('woocommerce_add_to_cart', 'add_to_cart', 10, 6);
//add_action('woocommerce_add_to_cart', 'add_to_cart', 10, 6);
//add_action('woocommerce_remove_cart_item', 'remove_from_cart', 10, 1);
//add_action('woocommerce_after_cart_item_quantity_update', 'update_cart', 10, 3);

function getHookNotice()
{
    add_action('woocommerce_before_cart', 'notification_max_quantity');
    function notification_max_quantity()
    {
        $filterQuantity = array_filter([get_option('1_row_right'), get_option('2_row_right'), get_option('3_row_right'), get_option('4_row_right'), get_option('5_row_right'), get_option('6_row_right'), get_option('7_row_right'), get_option('8_row_right'), get_option('9_row_right'), get_option('10_row_right')], 'strlen');
        echo '<h3>При количестве больше ' . max($filterQuantity) . ' предоставим цены по телефону';
    }
}

function getCount($item)
{
    return preg_replace('/[^0-9]/', '', $item);
}

function removeSymbols($var)
{
    $str_zero = preg_replace('/[^0-9]/', '', $var[0]->name);
    $str_one = preg_replace('/[^0-9]/', '', $var[1]->name);
    $str_two = preg_replace('/[^0-9]/', '', $var[2]->name);
    $str_three = preg_replace('/[^0-9]/', '', $var[3]->name);
    $str_four = preg_replace('/[^0-9]/', '', $var[4]->name);
    $str_five = preg_replace('/[^0-9]/', '', $var[5]->name);
    $str_six = preg_replace('/[^0-9]/', '', $var[6]->name);
    $str_seven = preg_replace('/[^0-9]/', '', $var[7]->name);

    if ($str_zero) {
        return $str_zero;
    }
    if ($str_one) {
        return $str_one;
    }
    if ($str_two) {
        return $str_two;
    }
    if ($str_three) {
        return $str_three;
    }
    if ($str_four) {
        return $str_four;
    }
    if ($str_five) {
        return $str_five;
    }
    if ($str_six) {
        return $str_six;
    }
    if ($str_seven) {
        return $str_seven;
    }
}

add_action('wp_footer', 'cart_update_qty_script');
function cart_update_qty_script()
{
    if (is_cart()) :
        ?>
        <script>
            jQuery('div.woocommerce').on('blur', '.qty', function () {
                jQuery("[name='update_cart']").trigger("click");
            });
        </script>
    <?php
    endif;
}

//notice – обычное уведомление
//success – уведомление об успехе
//error – уведомление об ошибке
// getNotice($item, 'error', 'При вашем заказе в количестве %s, вы можете получить другие цены по контактам на этой <a href="/404">странице</a>');
function getNotice($item, $status, $text)
{
    wc_print_notice(
        sprintf(
            $text,
            $item['quantity']
        ),
        $status
    );
}

// On single product pages Изменяем количество на странице одного товара
add_filter('woocommerce_quantity_input_args', 'min_qty_filter_callback', 20, 2);
function min_qty_filter_callback($args, $product)
{
    $args['min_value'] = get_option('1_row_left');
    return $args;
}

// On shop and archives pages Изменяем количество при добавлении в корзину
add_filter('woocommerce_loop_add_to_cart_args', 'min_qty_loop_add_to_cart_args', 10, 2);
function min_qty_loop_add_to_cart_args($args, $product)
{
    $args['quantity'] = get_option('1_row_left');
    // $product->get_regular_price();
    return $args;
}

function getRemoveSymbol($item)
{
    return substr($item, 1, 2);
}

function getPriceProductsBack($val, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10)
{
    $columnArray = [get_option('1_row_' . $val . '_header'), get_option('2_row_' . $val . '_header'), get_option('3_row_' . $val . '_header'), get_option('4_row_' . $val . '_header'), get_option('5_row_' . $val . '_header'), get_option('6_row_' . $val . '_header'), get_option('7_row_' . $val . '_header'), get_option('8_row_' . $val . '_header'), get_option('9_row_' . $val . '_header'), get_option('10_row_' . $val . '_header')];
    if ($count < $rowArray) {
        if ($count <= $left_1) {
            if (get_option('1_row_' . $val . '_header') !== '-') {
//                echo 'value: ' . $val . '<br>';
//                echo get_option('1_row_'.$val.'_header'). "<br>";
                $item['data']->set_price(get_option('1_row_' . $val . '_header'));
            }
        }
        if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_' . $val . '_header') !== '-') {
            $item['data']->set_price(get_option('1_row_' . $val . '_header'));
        }
        if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_' . $val . '_header') !== '-') {
            getCount(get_option('2_row_' . $val . '_header')) ? $item['data']->set_price(get_option('2_row_' . $val . '_header')) : $item['data']->set_price(get_option('1_row_' . $val . '_header'));
        }
        if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_' . $val . '_header') !== '-') {
            getCount(get_option('3_row_' . $val . '_header')) ? $item['data']->set_price(get_option('3_row_' . $val . '_header')) : $item['data']->set_price(get_option('2_row_' . $val . '_header'));
        }
        if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_' . $val . '_header') !== '-') {
            getCount(get_option('4_row_' . $val . '_header')) ? $item['data']->set_price(get_option('4_row_' . $val . '_header')) : $item['data']->set_price(get_option('3_row_' . $val . '_header'));
        }
        if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_' . $val . '_header') !== '-') {
            getCount(get_option('5_row_' . $val . '_header')) ? $item['data']->set_price(get_option('5_row_' . $val . '_header')) : $item['data']->set_price(get_option('4_row_' . $val . '_header'));
        }
        if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_' . $val . '_header') !== '-') {
            getCount(get_option('6_row_' . $val . '_header')) ? $item['data']->set_price(get_option('6_row_' . $val . '_header')) : $item['data']->set_price(get_option('5_row_' . $val . '_header'));
        }
        if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_' . $val . '_header') !== '-') {
            getCount(get_option('7_row_' . $val . '_header')) ? $item['data']->set_price(get_option('7_row_' . $val . '_header')) : $item['data']->set_price(get_option('6_row_' . $val . '_header'));
        }
        if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_' . $val . '_header') !== '-') {
            getCount(get_option('8_row_' . $val . '_header')) ? $item['data']->set_price(get_option('8_row_' . $val . '_header')) : $item['data']->set_price(get_option('7_row_' . $val . '_header'));
        }
        if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_' . $val . '_header') !== '-') {
            getCount(get_option('9_row_' . $val . '_header')) ? $item['data']->set_price(get_option('9_row_' . $val . '_header')) : $item['data']->set_price(get_option('8_row_' . $val . '_header'));
        }
    } else {
        $newArray = array_diff($columnArray, array(0, null));
        $item['data']->set_price(min($newArray));
    }
}

