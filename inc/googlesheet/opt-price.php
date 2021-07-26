<?php
include_once 'UpdatePrice.php';
add_action( 'woocommerce_before_mini_cart_contents', 'action_function_name_4627' );
function action_function_name_4627(){
    // add text mini cart contents
}
add_action('woocommerce_before_calculate_totals', 'add_custom_price', 1000, 1);
function add_custom_price($cart)
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    if (did_action('woocommerce_before_calculate_totals') >= 2) {
        return;
    }

    $gid = get_option("tabs-shortcode-url");
    $id = get_option("tabs-shortcode-page");
    $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);

    if ($csv) {
        $update = new UpdatePrice();
        $update->update_get_option();
    }

    // create variables left_1-10 and right_1-10
    $left_1 = $left_2 = $left_3 = $left_4 = $left_5 = $left_6 = $left_7 = $left_8 = $left_9 = $left_10 = '';

    for ($i = 1; $i < 11; $i++) {
        ${"left_$i"} = get_option($i . '_row_left');
    }

    foreach ($cart->get_cart() as $item) {
        $terms = get_the_terms($item['product_id'], 'product_cat');
        // max value counter first row the table
        $rowArray = max([$left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10]);
        $temperAll = [get_option('0_row_1_header'), get_option('0_row_2_header'), get_option('0_row_3_header'), get_option('0_row_4_header'), get_option('0_row_5_header'), get_option('0_row_6_header'), get_option('0_row_7_header'), get_option('0_row_8_header'), get_option('0_row_9_header'), get_option('0_row_10_header')];
        $count = $item['quantity']; // this count products
        // start index 0, added +1
        $index = array_search(removeSymbols($terms), getCount($temperAll)) + 1; // index number && search column price

        getPriceProductsBack($index, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10);
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
    return $args;
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