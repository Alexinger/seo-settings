<?php

global $shortcode_tags;

include_once 'show-table-shortcode.php';
// Set product quantity added to cart (handling ajax add to cart)
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
    $args['min_value'] = get_option('1_row_left');
    return $args;
}

/* Для страницы товара задаем минимальную цену из таблицы*/
add_filter('woocommerce_quantity_input_min', 'truemisha_min_kolvo', 20, 2);
function truemisha_min_kolvo($min, $product)
{
    return get_option('1_row_left');
}

/* Для товара в корзине, задаем минимальную цену из таблицы */
add_filter('woocommerce_cart_item_quantity', 'truemisha_min_kolvo_cart', 20, 3);
function truemisha_min_kolvo_cart($product_quantity, $cart_item_key, $cart_item)
{

    $product = $cart_item['data'];
    return woocommerce_quantity_input(
        array(
            'input_name' => "cart[{$cart_item_key}][qty]",
            'input_value' => $cart_item['quantity'],
            'max_value' => $product->get_max_purchase_quantity(),
            'min_value' => get_option('1_row_left'),
            'product_name' => $product->get_name(),
        ),
        $product,
        false
    );
}

// Simple, grouped and external products
add_filter('woocommerce_product_get_price', 'custom_price', 9, 2);
function custom_price($price, $product)
{
    $str = strpos($product->name, '-');
    $temperatures = substr($product->name, $str + 1, 2);
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

    if ($product->is_in_stock()) {
        echo '<p class="price">' . apply_filters('woocommerce_get_price_html', '<span style="font-size: 20px;font-family: \'Open Sans\';">от </span>' . $price, $product) . '</p>';
    } else {
        echo "<a href='/404' class='button woocommerce-store-notice' style='margin-bottom: 15px'>Перейти в контакты</a>";
    }
}

function getTemperature($item)
{
    $str = strpos($item, '-');
    $temperature = substr($item, $str + 1, 2);
    return checkPriceSum($temperature);
}

function checkPriceSum($item = null)
{
    $filterPrice10 = array_filter([
        is_numeric(get_option('1_row_1_header')) ? get_option('1_row_1_header') : '',
        is_numeric(get_option('2_row_1_header')) ? get_option('2_row_1_header') : '',
        is_numeric(get_option('3_row_1_header')) ? get_option('3_row_1_header') : '',
        is_numeric(get_option('4_row_1_header')) ? get_option('4_row_1_header') : '',
        is_numeric(get_option('5_row_1_header')) ? get_option('5_row_1_header') : '',
        is_numeric(get_option('6_row_1_header')) ? get_option('6_row_1_header') : '',
        is_numeric(get_option('7_row_1_header')) ? get_option('7_row_1_header') : '',
        is_numeric(get_option('8_row_1_header')) ? get_option('8_row_1_header') : '',
        is_numeric(get_option('9_row_1_header')) ? get_option('9_row_1_header') : '',
        is_numeric(get_option('10_row_1_header')) ? get_option('10_row_1_header') : '']);

    $filterPrice15 = array_filter([
        is_numeric(get_option('1_row_2_header')) ? get_option('1_row_2_header') : '',
        is_numeric(get_option('2_row_2_header')) ? get_option('2_row_2_header') : '',
        is_numeric(get_option('3_row_2_header')) ? get_option('3_row_2_header') : '',
        is_numeric(get_option('4_row_2_header')) ? get_option('4_row_2_header') : '',
        is_numeric(get_option('5_row_2_header')) ? get_option('5_row_2_header') : '',
        is_numeric(get_option('6_row_2_header')) ? get_option('6_row_2_header') : '',
        is_numeric(get_option('7_row_2_header')) ? get_option('7_row_2_header') : '',
        is_numeric(get_option('8_row_2_header')) ? get_option('8_row_2_header') : '',
        is_numeric(get_option('9_row_2_header')) ? get_option('9_row_2_header') : '',
        is_numeric(get_option('10_row_2_header')) ? get_option('10_row_2_header') : '']);

    $filterPrice20 = array_filter([
        is_numeric(get_option('1_row_3_header')) ? get_option('1_row_3_header') : '',
        is_numeric(get_option('2_row_3_header')) ? get_option('2_row_3_header') : '',
        is_numeric(get_option('3_row_3_header')) ? get_option('3_row_3_header') : '',
        is_numeric(get_option('4_row_3_header')) ? get_option('4_row_3_header') : '',
        is_numeric(get_option('5_row_3_header')) ? get_option('5_row_3_header') : '',
        is_numeric(get_option('6_row_3_header')) ? get_option('6_row_3_header') : '',
        is_numeric(get_option('7_row_3_header')) ? get_option('7_row_3_header') : '',
        is_numeric(get_option('8_row_3_header')) ? get_option('8_row_3_header') : '',
        is_numeric(get_option('9_row_3_header')) ? get_option('9_row_3_header') : '',
        is_numeric(get_option('10_row_3_header')) ? get_option('10_row_3_header') : '']);

    $filterPrice25 = array_filter([
        is_numeric(get_option('1_row_4_header')) ? get_option('1_row_4_header') : '',
        is_numeric(get_option('2_row_4_header')) ? get_option('2_row_4_header') : '',
        is_numeric(get_option('3_row_4_header')) ? get_option('3_row_4_header') : '',
        is_numeric(get_option('4_row_4_header')) ? get_option('4_row_4_header') : '',
        is_numeric(get_option('5_row_4_header')) ? get_option('5_row_4_header') : '',
        is_numeric(get_option('6_row_4_header')) ? get_option('6_row_4_header') : '',
        is_numeric(get_option('7_row_4_header')) ? get_option('7_row_4_header') : '',
        is_numeric(get_option('8_row_4_header')) ? get_option('8_row_4_header') : '',
        is_numeric(get_option('9_row_4_header')) ? get_option('9_row_4_header') : '',
        is_numeric(get_option('10_row_4_header')) ? get_option('10_row_4_header') : '']);

    $filterPrice30 = array_filter([
        is_numeric(get_option('1_row_5_header')) ? get_option('1_row_5_header') : '',
        is_numeric(get_option('2_row_5_header')) ? get_option('2_row_5_header') : '',
        is_numeric(get_option('3_row_5_header')) ? get_option('3_row_5_header') : '',
        is_numeric(get_option('4_row_5_header')) ? get_option('4_row_5_header') : '',
        is_numeric(get_option('5_row_5_header')) ? get_option('5_row_5_header') : '',
        is_numeric(get_option('6_row_5_header')) ? get_option('6_row_5_header') : '',
        is_numeric(get_option('7_row_5_header')) ? get_option('7_row_5_header') : '',
        is_numeric(get_option('8_row_5_header')) ? get_option('8_row_5_header') : '',
        is_numeric(get_option('9_row_5_header')) ? get_option('9_row_5_header') : '',
        is_numeric(get_option('10_row_5_header')) ? get_option('10_row_5_header') : '']);

    $filterPrice35 = array_filter([
        is_numeric(get_option('1_row_6_header')) ? get_option('1_row_6_header') : '',
        is_numeric(get_option('2_row_6_header')) ? get_option('2_row_6_header') : '',
        is_numeric(get_option('3_row_6_header')) ? get_option('3_row_6_header') : '',
        is_numeric(get_option('4_row_6_header')) ? get_option('4_row_6_header') : '',
        is_numeric(get_option('5_row_6_header')) ? get_option('5_row_6_header') : '',
        is_numeric(get_option('6_row_6_header')) ? get_option('6_row_6_header') : '',
        is_numeric(get_option('7_row_6_header')) ? get_option('7_row_6_header') : '',
        is_numeric(get_option('8_row_6_header')) ? get_option('8_row_6_header') : '',
        is_numeric(get_option('9_row_6_header')) ? get_option('9_row_6_header') : '',
        is_numeric(get_option('10_row_6_header')) ? get_option('10_row_6_header') : '']);

    $filterPrice40 = array_filter([
        is_numeric(get_option('1_row_7_header')) ? get_option('1_row_7_header') : '',
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
            return min($filterPrice20);
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

add_action('woocommerce_before_calculate_totals', 'add_custom_price', 1000, 1);
function add_custom_price($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
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

    foreach ($cart->get_cart() as $item) {
        echo 'value: ' . $item['data']->set_price(123);
        return;

        $terms = get_the_terms($item['product_id'], 'product_cat');
        $rowArray = max([$left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10]); // max value counter first row the table
        // all row on table, temperature
        $temperAll = [get_option('0_row_1_header'), get_option('0_row_2_header'), get_option('0_row_3_header'), get_option('0_row_4_header'), get_option('0_row_5_header'), get_option('0_row_6_header'), get_option('0_row_7_header'), get_option('0_row_8_header'), get_option('0_row_9_header'), get_option('0_row_10_header')];
        $count = $item['quantity']; // this count products
        $index = array_search(removeSymbols($terms), removeSymbolsTemp($temperAll)); // index number && search column price

//        getPriceProductsBack($index, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10);
    }

}

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

function removeSymbolsTemp($var)
{
    return preg_replace('/[^0-9]/', '', $var);
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

// Изменяем количество при добавлении в корзину
add_filter('woocommerce_loop_add_to_cart_args', 'min_qty_loop_add_to_cart_args', 10, 2);
function min_qty_loop_add_to_cart_args($args, $product)
{
    $args['quantity'] = get_option('1_row_left');
    return $args;
}

function getRemoveSymbol($item)
{
    return substr($item, 1, 2);
}

function getPriceProductsBack($index, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10)
{
    if ($count < $rowArray) {
        if ($count <= $left_1) {
            $item['data']->set_price(get_option('1_row_' . $index . '_header'));
        }
        if ($count > $left_1 && $count <= $left_2 && get_option('1_row_' . $index . '_header') !== '-') {
            $item['data']->set_price(get_option('1_row_' . $index . '_header'));
        }
        if ($count > $left_2 && $count <= $left_3 && get_option('2_row_' . $index . '_header') !== '-') {
            getCount(get_option('2_row_' . $index . '_header')) ? $item['data']->set_price(get_option('2_row_' . $index . '_header')) : $item['data']->set_price(get_option('1_row_' . $index . '_header'));
        }
        if ($count > $left_3 && $count <= $left_4 && get_option('3_row_' . $index . '_header') !== '-') {
            getCount(get_option('3_row_' . $index . '_header')) ? $item['data']->set_price(get_option('3_row_' . $index . '_header')) : $item['data']->set_price(get_option('2_row_' . $index . '_header'));
        }
        if ($count > $left_4 && $count <= $left_5 && get_option('4_row_' . $index . '_header') !== '-') {
            getCount(get_option('4_row_' . $index . '_header')) ? $item['data']->set_price(get_option('4_row_' . $index . '_header')) : $item['data']->set_price(get_option('3_row_' . $index . '_header'));
        }
        if ($count > $left_5 && $count <= $left_6 && get_option('5_row_' . $index . '_header') !== '-') {
            getCount(get_option('5_row_' . $index . '_header')) ? $item['data']->set_price(get_option('5_row_' . $index . '_header')) : $item['data']->set_price(get_option('4_row_' . $index . '_header'));
        }
        if ($count > $left_6 && $count <= $left_7 && get_option('6_row_' . $index . '_header') !== '-') {
            getCount(get_option('6_row_' . $index . '_header')) ? $item['data']->set_price(get_option('6_row_' . $index . '_header')) : $item['data']->set_price(get_option('5_row_' . $index . '_header'));
        }
        if ($count > $left_7 && $count <= $left_8 && get_option('7_row_' . $index . '_header') !== '-') {
            getCount(get_option('7_row_' . $index . '_header')) ? $item['data']->set_price(get_option('7_row_' . $index . '_header')) : $item['data']->set_price(get_option('6_row_' . $index . '_header'));
        }
        if ($count > $left_8 && $count <= $left_9 && get_option('8_row_' . $index . '_header') !== '-') {
            getCount(get_option('8_row_' . $index . '_header')) ? $item['data']->set_price(get_option('8_row_' . $index . '_header')) : $item['data']->set_price(get_option('7_row_' . $index . '_header'));
        }
        if ($count > $left_9 && $count <= $left_10 && get_option('9_row_' . $index . '_header') !== '-') {
            getCount(get_option('9_row_' . $index . '_header')) ? $item['data']->set_price(get_option('9_row_' . $index . '_header')) : $item['data']->set_price(get_option('8_row_' . $index . '_header'));
        }
    } else {
        $columnArray = [get_option('1_row_' . $index . '_header'), get_option('2_row_' . $index . '_header'), get_option('3_row_' . $index . '_header'), get_option('4_row_' . $index . '_header'), get_option('5_row_' . $index . '_header'), get_option('6_row_' . $index . '_header'), get_option('7_row_' . $index . '_header'), get_option('8_row_' . $index . '_header'), get_option('9_row_' . $index . '_header'), get_option('10_row_' . $index . '_header')];
        $newArray = array_diff($columnArray, array(0, null));
        $item['data']->set_price(min($newArray));
    }
}

class UpdatePrice
{
    public static function update_get_option()
    {

        $gid = get_option("tabs-shortcode-url");
        $id = get_option("tabs-shortcode-page");
        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
        $csv = explode("\r\n", $csv);
        $array = array_map('str_getcsv', $csv);

        /* All row item water - NEW */
        for ($row = 1; $row < 10; $row++) {
            // [50] [151] [751] [1201] [2501] [?] [?] [?] [?] [?]
            update_option($row . '_row_left', $array[$row][0]);
        }
        /* All column item temperature - (const) NEW */
        for ($h = 1; $h < 15; $h++) {
            // [-10] [-15] [-20] [-25] [-35] [-35] [-40] [?] [?] [?]
            update_option($h . '_header', substr($array[0][$h], 1, 2));
        }
        /* All variables volume and temperature*/
        /* -10C -15C -20C -25C -30C -35C -40C -45C -50C -55C (50-150) */
        for ($s = 1; $s < 10; $s++) {
            for ($i = 1; $i < 10; $i++) {
                update_option($i . '_row_' . $s . '_header', $array[$i][$s]);
            }
        }
    }
}

add_shortcode("google_sheet", "get_google_sheet");
function get_google_sheet($atts = null)
{
    $atts = shortcode_atts([
        'title' => 'Прайс лист',
        'title_color' => '#a5bf8f',
        'table_bg' => 'white',
        'table_color_value' => 'black',
    ], $atts);

    $gid = get_option("tabs-shortcode-url");
    $id = get_option("tabs-shortcode-page");
    $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
    $csv = explode("\r\n", $csv);
    $array = array_map('str_getcsv', $csv);

    $update = new UpdatePrice();
    $update->update_get_option();

    $tr1 = $tr2 = $tr3 = $tr4 = $tr5 = $tr6 = $tr7 = $tr8 = $tr9 = $tr10 = null;

    $start = '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;}</style>' .
        '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>' .
        '<table class="table table-bordered table-hover table-my-style" style="background-color: ' . $atts['table_bg'] . '">
           <thead style="color: ' . $atts['table_color_value'] . '">
            <tr>';
    for ($i = 0; $i < 20; $i++) {
        if (isset($array[0][$i]) && $array[0][$i] !== '' && $array[0][$i] !== null) {
            $start .= '<th class="my-table">' . $array[0][$i] . '</th>';
        }
    }
    $start .= '</tr></thead>';

    for ($s = 1; $s < 15; $s++) {
        if (isset($array[$s][0]) && $array[$s][0] !== '' && $array[$s][0] !== null) {
            ${'tr' . $s} .= '<tr>';
            for ($i = 0; $i < 15; $i++) {
                if (isset($array[$s][$i]) && $array[$s][$i] !== '' && $array[$s][$i] !== null) {
                    ${'tr' . $s} .= '<td class="my-table">' . $array[$s][$i] . '</td>';
                }
            }
            ${'tr' . $s} .= '</tr>';
        }
    }
    $end = '</table>';

    return $start . $tr1 . $tr2 . $tr3 . $tr4 . $tr5 . $tr6 . $tr7 . $tr8 . $tr9 . $tr10 . $end . '</tr>';
}
