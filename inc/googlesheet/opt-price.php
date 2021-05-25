<?php
include_once 'UpdatePrice.php';
add_action('woocommerce_before_calculate_totals', 'add_custom_price', 100, 2);

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
    $right_1 = $right_2 = $right_3 = $right_4 = $right_5 = $right_6 = $right_7 = $right_8 = $right_9 = $right_10 = '';

    for ($i = 1; $i < 11; $i++) {
        ${"left_$i"} = get_option($i . '_row_left');
        ${"right_$i"} = get_option($i . '_row_right');
    }

    foreach ($cart->get_cart() as $item) {
        $terms = get_the_terms($item['product_id'], 'product_cat');
        /* -10C */
        // var_dump($terms[0]->name);
        // var_dump($terms);
        if (removeSymbols($terms) === get_option('1_header')) {
            $count = $item['quantity'] || 0;
            /* до 50 */
            if ($left_1 && $count < $left_1) {
                $count = $left_1;
                $item['data']->set_price(get_option('1_row_1_header'));
            }
            /* 50 <-> 150 */
            if ($left_1 && $count >= $left_1 && $count <= $right_1) {
                $item['data']->set_price(get_option('1_row_1_header'));
            }
            /* 151 <-> 750 */
            if ($left_2 && $count >= $left_2 && $count <= $right_2) {
                getCount(get_option('2_row_1_header')) ? $item['data']->set_price(get_option('2_row_1_header')) : $item['data']->set_price(get_option('1_row_1_header'));
            }
            /* 751 <-> 1200 */
            if ($left_3 && $count >= $left_3 && $count <= $right_3) {
                getCount(get_option('3_row_1_header')) ? $item['data']->set_price(get_option('3_row_1_header')) : $item['data']->set_price(get_option('2_row_1_header'));
            }
            /* 1201 <-> 2500 */
            if ($left_4 && $count >= $left_4 && $count <= $right_4) {
                getCount(get_option('4_row_1_header')) ? $item['data']->set_price(get_option('4_row_1_header')) : $item['data']->set_price(get_option('3_row_1_header'));
            }
            /* 2501 <-> 5000 */
            if ($left_5 && $count >= $left_5 && $count <= $right_5) {
                getCount(get_option('5_row_3_header')) ? $item['data']->set_price(get_option('5_row_1_header')) : $item['data']->set_price(get_option('4_row_1_header'));
            }
            /* 5001 <-> 10000 */
            if ($left_6 && $count >= $left_6 && $count <= $right_6) {
                getCount(get_option('6_row_1_header')) ? $item['data']->set_price(get_option('6_row_1_header')) : $item['data']->set_price(get_option('5_row_1_header'));
            }
            /* 10001 <-> 15000 */
            if ($left_7 && $count >= $left_7 && $count <= $right_7) {
                getCount(get_option('7_row_1_header')) ? $item['data']->set_price(get_option('7_row_1_header')) : $item['data']->set_price(get_option('6_row_1_header'));
            }
            /* 15001 <-> 20000 */
            if ($left_8 && $count >= $left_8 && $count <= $right_8) {
                getCount(get_option('8_row_1_header')) ? $item['data']->set_price(get_option('8_row_1_header')) : $item['data']->set_price(get_option('7_row_1_header'));
            }
            /* ? */
            if ($left_9 && $count >= $left_9 && $count <= $right_9) {
                getCount(get_option('9_row_1_header')) ? $item['data']->set_price(get_option('9_row_1_header')) : $item['data']->set_price(get_option('8_row_1_header'));
            }
            /* ? */
            if ($left_10 && $count >= $left_10 && $count <= $right_10) {
                getCount(get_option('10_row_1_header')) ? $item['data']->set_price(get_option('10_row_1_header')) : $item['data']->set_price(get_option('9_row_1_header'));
            }
        }

        /* -15C */
        if (removeSymbols($terms) === get_option('2_header')) {
            $count = $item['quantity'];
            /* до 50 */
            if ($count < $left_1) {
                $item['quantity'] = $left_1;
                if (get_option('1_row_2_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_2_header'));
            }
            /* 50 <-> 150 */
            if ($left_1 && $count >= $left_1 && $count <= $right_1) {
                if (get_option('1_row_2_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_2_header'));
            }
            /* 151 <-> 750 */
            if ($left_2 && $count >= $left_2 && $count <= $right_2) {
                if (get_option('1_row_2_header') === "-") {
                    return;
                }
                getCount(get_option('2_row_2_header')) ? $item['data']->set_price(get_option('2_row_2_header')) : $item['data']->set_price(get_option('1_row_2_header'));
            }
            /* 751 <-> 1200 */
            if ($left_3 && $count >= $left_3 && $count <= $right_3) {
                if (get_option('2_row_2_header') === "-") {
                    return;
                }
                getCount(get_option('3_row_2_header')) ? $item['data']->set_price(get_option('3_row_2_header')) : $item['data']->set_price(get_option('2_row_2_header'));
            }
            /* 1201 <-> 2500 */
            if ($left_4 && $count >= $left_4 && $count <= $right_4) {
                if (get_option('3_row_2_header') === "-") {
                    return;
                }
                getCount(get_option('4_row_2_header')) ? $item['data']->set_price(get_option('4_row_2_header')) : $item['data']->set_price(get_option('3_row_2_header'));
            }
            /* 2501 <-> 5000 */
            if ($left_5 && $count >= $left_5 && $count <= $right_5) {
                if (get_option('4_row_2_header') === '-') {
                    return;
                }
                getCount(get_option('5_row_2_header')) ? $item['data']->set_price(get_option('5_row_2_header')) : $item['data']->set_price(get_option('4_row_2_header'));
            }
            /* 5001 <-> 10000 */
            if ($left_6 && $count >= $left_6 && $count <= $right_6) {
                if (get_option('5_row_2_header') === '-') {
                    return;
                }
                getCount(get_option('6_row_2_header')) ? $item['data']->set_price(get_option('6_row_2_header')) : $item['data']->set_price(get_option('5_row_2_header'));
            }
            /* 10001 <-> 15000 */
            if ($left_7 && $count >= $left_7 && $count <= $right_7) {
                if (get_option('6_row_2_header') === '-') {
                    return;
                }
                getCount(get_option('7_row_2_header')) ? $item['data']->set_price(get_option('7_row_2_header')) : $item['data']->set_price(get_option('6_row_2_header'));
            }
            /* 15001 <-> 20000 */
            if ($left_8 && $count >= $left_8 && $count <= $right_8) {
                if (get_option('7_row_2_header') === '-') {
                    return;
                }
                getCount(get_option('8_row_2_header')) ? $item['data']->set_price(get_option('8_row_2_header')) : $item['data']->set_price(get_option('7_row_2_header'));
            }
            /* ? */
            if ($count >= $left_9 && $count <= $right_9) {
                if (get_option('8_row_2_header') === '-') {
                    return;
                }
                getCount(get_option('9_row_2_header')) ? $item['data']->set_price(get_option('9_row_2_header')) : $item['data']->set_price(get_option('8_row_2_header'));
            }
            /* ? */
            if ($count >= $left_10 && $count <= $right_10) {
                if (get_option('9_row_2_header') === '-') {
                    return;
                }
                getCount(get_option('10_row_2_header')) ? $item['data']->set_price(get_option('10_row_2_header')) : $item['data']->set_price(get_option('9_row_2_header'));
            }
        }

        /* -20C */
        if (removeSymbols($terms) === get_option('3_header')) {
            $count = $item['quantity'];
            /* до 50 */
            if ($count < $left_1) {
                $count = $left_1;
                if (get_option('1_row_3_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_3_header'));
            }
            /* 50 <-> 150 */
            if ($count >= $left_1 && $count <= $right_1) {
                if (get_option('1_row_3_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_3_header'));
            }
            /* 151 <-> 750 */
            if ($count >= $left_2 && $count <= $right_2) {
                if (get_option('2_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('2_row_3_header')) ? $item['data']->set_price(get_option('2_row_3_header')) : $item['data']->set_price(get_option('1_row_3_header'));
            }
            /* 751 <-> 1200 */
            if ($count >= $left_3 && $count <= $right_3) {
                if (get_option('3_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('3_row_3_header')) ? $item['data']->set_price(get_option('3_row_3_header')) : $item['data']->set_price(get_option('2_row_3_header'));
            }
            /* 1201 <-> 2500 */
            if ($count >= $left_4 && $count <= $right_4) {
                if (get_option('4_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('4_row_3_header')) ? $item['data']->set_price(get_option('4_row_3_header')) : $item['data']->set_price(get_option('3_row_3_header'));
            }
            /* 2501 <-> 5000 */
            if ($count >= $left_5 && $count <= $right_5) {
                if (get_option('5_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('5_row_3_header')) ? $item['data']->set_price(get_option('5_row_3_header')) : $item['data']->set_price(get_option('4_row_3_header'));
            }
            /* 5001 <-> 10000 */
            if ($left_6 && $count >= $left_6 && $count <= $right_6) {
                if (get_option('6_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('6_row_3_header')) ? $item['data']->set_price(get_option('6_row_3_header')) : $item['data']->set_price(get_option('5_row_3_header'));
            }
            /* 10001 <-> 15000 */
            if ($left_7 && $count >= $left_7 && $count <= $right_7) {
                if (get_option('7_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('7_row_3_header')) ? $item['data']->set_price(get_option('7_row_3_header')) : $item['data']->set_price(get_option('6_row_3_header'));
            }
            /* 15001 <-> 20000 */
            if ($left_8 && $count >= $left_8 && $count <= $right_8) {
                if (get_option('8_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('8_row_3_header')) ? $item['data']->set_price(get_option('8_row_3_header')) : $item['data']->set_price(get_option('7_row_3_header'));
            }
            /* ? */
            if ($left_9 && $count >= $left_9 && $count <= $right_9) {
                if (get_option('9_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('9_row_3_header')) ? $item['data']->set_price(get_option('9_row_3_header')) : $item['data']->set_price(get_option('8_row_3_header'));
            }
            /* ? */
            if ($left_10 && $count >= $left_10 && $count <= $right_10) {
                if (get_option('10_row_3_header') === '-') {
                    return;
                }
                getCount(get_option('10_row_3_header')) ? $item['data']->set_price(get_option('10_row_3_header')) : $item['data']->set_price(get_option('9_row_3_header'));
            }
        }

        /* -25C */
        if (removeSymbols($terms) == get_option('4_header')) {
            $count = $item['quantity'];
            /* до 50 */
            if ($count < $left_1) {
                $count = $left_1;
                if (get_option('1_row_4_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_4_header'));
            }
            /* 50 <-> 150 */
            if ($left_1 && $count >= $left_1 && $count <= $right_1) {
                if (get_option('1_row_4_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_4_header'));
            }
            /* 151 <-> 750 */
            if ($left_2 && $count >= $left_2 && $count <= $right_2) {
                if (get_option('2_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('2_row_4_header')) ? $item['data']->set_price(get_option('2_row_4_header')) : $item['data']->set_price(get_option('1_row_4_header'));
            }
            /* 751 <-> 1200 */
            if ($left_3 && $count >= $left_3 && $count <= $right_3) {
                if (get_option('3_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('3_row_4_header')) ? $item['data']->set_price(get_option('3_row_4_header')) : $item['data']->set_price(get_option('2_row_4_header'));
            }
            /* 1201 <-> 2500 */
            if ($left_4 && $count >= $left_4 && $count <= $right_4) {
                if (get_option('4_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('4_row_4_header')) ? $item['data']->set_price(get_option('4_row_4_header')) : $item['data']->set_price(get_option('3_row_4_header'));
            }
            /* 2501 <-> 5000 */
            if ($left_5 && $count >= $left_5 && $count <= $right_5) {
                if (get_option('5_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('5_row_4_header')) ? $item['data']->set_price(get_option('5_row_4_header')) : $item['data']->set_price(get_option('4_row_4_header'));
            }
            /* null */
            if ($left_6 && $count >= $left_6 && $count <= $right_6) {
                if (get_option('6_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('6_row_4_header')) ? $item['data']->set_price(get_option('6_row_4_header')) : $item['data']->set_price(get_option('5_row_4_header'));
            }
            /* null */
            if ($left_7 && $count >= $left_7 && $count <= $right_7) {
                if (get_option('7_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('7_row_4_header')) ? $item['data']->set_price(get_option('7_row_4_header')) : $item['data']->set_price(get_option('6_row_4_header'));
            }
            /* null */
            if ($left_8 && $count >= $left_8 && $count <= $right_8) {
                if (get_option('8_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('8_row_4_header')) ? $item['data']->set_price(get_option('8_row_4_header')) : $item['data']->set_price(get_option('7_row_4_header'));
            }
            /* null */
            if ($left_9 && $count >= $left_9 && $count <= $right_9) {
                if (get_option('9_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('9_row_4_header')) ? $item['data']->set_price(get_option('9_row_4_header')) : $item['data']->set_price(get_option('8_row_4_header'));
            }
            /* null */
            if ($left_10 && $count >= $left_10 && $count <= $right_10) {
                if (get_option('10_row_4_header') === '-') {
                    return;
                }
                getCount(get_option('10_row_4_header')) ? $item['data']->set_price(get_option('10_row_4_header')) : $item['data']->set_price(get_option('9_row_4_header'));
            }
        }
        /* -30C */
        if (removeSymbols($terms) === get_option('5_header')) {
            $count = $item['quantity'];
            /* до 50 */
            if ($count < $left_1) {
                $count = $left_1;
                if (get_option('1_row_5_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_5_header'));
            }
            /* 50 <-> 150 */
            if ($count >= $left_1 && $count <= $right_1) {
                if (get_option('1_row_5_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_5_header'));
            }
            /* 151 <-> 750 */
            if ($count >= $left_2 && $count <= $right_2) {
                if (get_option('2_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('2_row_5_header')) ? $item['data']->set_price(get_option('2_row_5_header')) : $item['data']->set_price(get_option('1_row_5_header'));
            }
            /* 751 <-> 1200 */
            if ($count >= $left_3 && $count <= $right_3) {
                if (get_option('3_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('3_row_5_header')) ? $item['data']->set_price(get_option('3_row_5_header')) : $item['data']->set_price(get_option('2_row_5_header'));
            }
            /* 1201 <-> 2500 */
            if ($count >= $left_4 && $count <= $right_4) {
                if (get_option('4_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('4_row_5_header')) ? $item['data']->set_price(get_option('4_row_5_header')) : $item['data']->set_price(get_option('3_row_5_header'));
            }
            /* 2501 <-> 5000 */
            if ($count >= $left_5 && $count <= $right_5) {
                if (get_option('5_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('5_row_5_header')) ? $item['data']->set_price(get_option('5_row_5_header')) : $item['data']->set_price(get_option('4_row_5_header'));
            }
            /* ? */
            if ($count >= $left_6 && $count <= $right_6) {
                if (get_option('6_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('6_row_5_header')) ? $item['data']->set_price(get_option('6_row_5_header')) : $item['data']->set_price(get_option('5_row_5_header'));
            }
            /* ? */
            if ($count >= $left_7 && $count <= $right_7) {
                if (get_option('7_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('7_row_5_header')) ? $item['data']->set_price(get_option('7_row_5_header')) : $item['data']->set_price(get_option('6_row_5_header'));
            }
            /* ? */
            if ($count >= $left_8 && $count <= $right_8) {
                if (get_option('8_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('8_row_5_header')) ? $item['data']->set_price(get_option('8_row_5_header')) : $item['data']->set_price(get_option('7_row_5_header'));
            }
            /* ? */
            if ($count >= $left_9 && $count <= $right_9) {
                if (get_option('9_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('9_row_5_header')) ? $item['data']->set_price(get_option('9_row_5_header')) : $item['data']->set_price(get_option('8_row_5_header'));
            }
            /* ? */
            if ($count >= $left_10 && $count <= $right_10) {
                if (get_option('10_row_5_header') === '-') {
                    return;
                }
                getCount(get_option('10_row_5_header')) ? $item['data']->set_price(get_option('10_row_5_header')) : $item['data']->set_price(get_option('9_row_5_header'));
            }
        }
        /* -35C */
        if (removeSymbols($terms) === get_option('6_header')) {
            /* до 50 */
            $count = $item['quantity'];
            echo "-35 = " . $count . "<br>";
            if ($count < $left_1) {
                $count = $left_1;
                if (get_option('1_row_6_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_6_header'));
            }
            /* 50 <-> 150 */
            if ($count >= $left_1 && $count <= $right_1) {
                if (get_option('1_row_6_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_6_header'));
            }
            /* 151 <-> 750 */
            if ($count >= $left_2 && $count <= $right_2) {
                if (get_option('2_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('2_row_6_header')) ? $item['data']->set_price(get_option('2_row_6_header')) : $item['data']->set_price(get_option('1_row_6_header'));
            }
            /* 751 <-> 1200 */
            if ($count >= $left_3 && $count <= $right_3) {
                if (get_option('3_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('3_row_6_header')) ? $item['data']->set_price(get_option('3_row_6_header')) : $item['data']->set_price(get_option('2_row_6_header'));
            }
            /* 1201 <-> 2500 */
            if ($count >= $left_4 && $count <= $right_4) {
                if (get_option('4_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('4_row_6_header')) ? $item['data']->set_price(get_option('4_row_6_header')) : $item['data']->set_price(get_option('3_row_6_header'));
            }
            /* 2501 <-> 5000 */
            if ($count >= $left_5 && $count <= $right_5) {
                if (get_option('5_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('5_row_6_header')) ? $item['data']->set_price(get_option('5_row_6_header')) : $item['data']->set_price(get_option('4_row_6_header'));
            }
            /* null */
            if ($count >= $left_6 && $count <= $right_6) {
                if (get_option('6_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('6_row_6_header')) ? $item['data']->set_price(get_option('6_row_6_header')) : $item['data']->set_price(get_option('5_row_6_header'));
            }
            /* null */
            if ($count >= $left_7 && $count <= $right_7) {
                if (get_option('7_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('7_row_6_header')) ? $item['data']->set_price(get_option('7_row_6_header')) : $item['data']->set_price(get_option('6_row_6_header'));
            }
            /* null */
            if ($count >= $left_8 && $count <= $right_8) {
                if (get_option('8_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('8_row_6_header')) ? $item['data']->set_price(get_option('8_row_6_header')) : $item['data']->set_price(get_option('7_row_6_header'));
            }
            /* null */
            if ($count >= $left_9 && $count <= $right_9) {
                if (get_option('9_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('9_row_6_header')) ? $item['data']->set_price(get_option('9_row_6_header')) : $item['data']->set_price(get_option('8_row_6_header'));
            }
            /* null */
            if ($count >= $left_10 && $count <= $right_10) {
                if (get_option('10_row_6_header') === '-') {
                    return;
                }
                getCount(get_option('10_row_6_header')) ? $item['data']->set_price(get_option('10_row_6_header')) : $item['data']->set_price(get_option('9_row_6_header'));
            }
        }
        /* -40C */
        if (removeSymbols($terms) === get_option('7_header')) {
            $count = $item['quantity'];
            /* до 50 */
            if ($count < $left_1) {
                $count = $left_1;
                if (get_option('1_row_7_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_7_header'));
            }
            /* 50 <-> 150 */
            if ($count >= $left_1 && $count <= $right_1) {
                if (get_option('1_row_7_header') === '-') {
                    return;
                }
                $item['data']->set_price(get_option('1_row_7_header'));
            }
            /* 151 <-> 750 */
            if ($count >= $left_2 && $count <= $right_2) {
                if (get_option('2_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('2_row_7_header')) ? $item['data']->set_price(get_option('2_row_7_header')) : $item['data']->set_price(get_option('1_row_7_header'));
            }
            /* 751 <-> 1200 */
            if ($count >= $left_3 && $count <= $right_3) {
                if (get_option('3_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('3_row_7_header')) ? $item['data']->set_price(get_option('3_row_7_header')) : $item['data']->set_price(get_option('2_row_7_header'));
            }
            /* 1201 <-> 2500 */
            if ($count >= $left_4 && $count <= $right_4) {
                if (get_option('4_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('4_row_7_header')) ? $item['data']->set_price(get_option('4_row_7_header')) : $item['data']->set_price(get_option('3_row_7_header'));
            }
            /* 2501 <-> 5000 */
            if ($count >= $left_5 && $count <= $right_5) {
                if (get_option('5_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('5_row_7_header')) ? $item['data']->set_price(get_option('5_row_7_header')) : $item['data']->set_price(get_option('4_row_7_header'));
            }
            /* ? */
            if ($count >= $left_6 && $count <= $right_6) {
                if (get_option('6_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('6_row_7_header')) ? $item['data']->set_price(get_option('6_row_7_header')) : $item['data']->set_price(get_option('5_row_7_header'));
            }
            /* ? */
            if ($count >= $left_7 && $count <= $right_7) {
                if (get_option('7_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('7_row_7_header')) ? $item['data']->set_price(get_option('7_row_7_header')) : $item['data']->set_price(get_option('6_row_7_header'));
            }
            /* ? */
            if ($count >= $left_8 && $count <= $right_8) {
                if (get_option('8_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('8_row_7_header')) ? $item['data']->set_price(get_option('8_row_7_header')) : $item['data']->set_price(get_option('7_row_7_header'));
            }
            /* ? */
            if ($count >= $left_9 && $count <= $right_9) {
                if (get_option('9_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('9_row_7_header')) ? $item['data']->set_price(get_option('9_row_7_header')) : $item['data']->set_price(get_option('8_row_7_header'));
            }
            /* ? */
            if ($count >= $left_10 && $count <= $right_10) {
                if (get_option('10_row_7_header') === '-') {
                    return;
                }
                getCount(get_option('10_row_7_header')) ? $item['data']->set_price(get_option('10_row_7_header')) : $item['data']->set_price(get_option('9_row_7_header'));
            }
        }
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
