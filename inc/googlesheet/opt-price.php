<?php
include_once 'UpdatePrice.php';
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

//    function getMinPrice($item){
//        $newArray = array_diff($item, array(0, null));
//        return '100';
//    }

    foreach ($cart->get_cart() as $item) {
        $terms = get_the_terms($item['product_id'], 'product_cat');
        // max value counter first row the table
        $rowArray = max([$left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10]);

        $columnArray_10 = [get_option('1_row_0_header'), get_option('2_row_0_header'), get_option('3_row_0_header'), get_option('4_row_0_header'), get_option('5_row_0_header'), get_option('6_row_0_header'), get_option('7_row_0_header'), get_option('8_row_0_header'), get_option('9_row_0_header'), get_option('10_row_0_header')];
        $columnArray_15 = [get_option('1_row_1_header'), get_option('2_row_1_header'), get_option('3_row_1_header'), get_option('4_row_1_header'), get_option('5_row_1_header'), get_option('6_row_1_header'), get_option('7_row_1_header'), get_option('8_row_1_header'), get_option('9_row_1_header'), get_option('10_row_1_header')];
        $columnArray_20 = [get_option('1_row_2_header'), get_option('2_row_2_header'), get_option('3_row_2_header'), get_option('4_row_2_header'), get_option('5_row_2_header'), get_option('6_row_2_header'), get_option('7_row_2_header'), get_option('8_row_2_header'), get_option('9_row_2_header'), get_option('10_row_2_header')];
        $columnArray_25 = [get_option('1_row_3_header'), get_option('2_row_3_header'), get_option('3_row_3_header'), get_option('4_row_3_header'), get_option('5_row_3_header'), get_option('6_row_3_header'), get_option('7_row_3_header'), get_option('8_row_3_header'), get_option('9_row_3_header'), get_option('10_row_3_header')];
        $columnArray_30 = [get_option('1_row_4_header'), get_option('2_row_4_header'), get_option('3_row_4_header'), get_option('4_row_4_header'), get_option('5_row_4_header'), get_option('6_row_4_header'), get_option('7_row_4_header'), get_option('8_row_4_header'), get_option('9_row_4_header'), get_option('10_row_4_header')];
        $columnArray_35 = [get_option('1_row_5_header'), get_option('2_row_5_header'), get_option('3_row_5_header'), get_option('4_row_5_header'), get_option('5_row_5_header'), get_option('6_row_5_header'), get_option('7_row_5_header'), get_option('8_row_5_header'), get_option('9_row_5_header'), get_option('10_row_5_header')];
        $columnArray_40 = [get_option('1_row_6_header'), get_option('2_row_6_header'), get_option('3_row_6_header'), get_option('4_row_6_header'), get_option('5_row_6_header'), get_option('6_row_6_header'), get_option('7_row_6_header'), get_option('8_row_6_header'), get_option('9_row_6_header'), get_option('10_row_6_header')];
        $columnArray_45 = [get_option('1_row_7_header'), get_option('2_row_7_header'), get_option('3_row_7_header'), get_option('4_row_7_header'), get_option('5_row_7_header'), get_option('6_row_7_header'), get_option('7_row_7_header'), get_option('8_row_7_header'), get_option('9_row_7_header'), get_option('10_row_7_header')];
        $columnArray_50 = [get_option('1_row_8_header'), get_option('2_row_8_header'), get_option('3_row_8_header'), get_option('4_row_8_header'), get_option('5_row_8_header'), get_option('6_row_8_header'), get_option('7_row_8_header'), get_option('8_row_8_header'), get_option('9_row_8_header'), get_option('10_row_8_header')];

        /* -10C */
        if (removeSymbols($terms) === get_option('1_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_1_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_0_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_0_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_0_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_0_header') !== '-') {
                        getCount(get_option('2_row_0_header')) ? $item['data']->set_price(get_option('2_row_0_header')) : $item['data']->set_price(get_option('1_row_0_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_0_header') !== '-') {
                        getCount(get_option('3_row_0_header')) ? $item['data']->set_price(get_option('3_row_0_header')) : $item['data']->set_price(get_option('2_row_0_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_0_header') !== '-') {
                        getCount(get_option('4_row_0_header')) ? $item['data']->set_price(get_option('4_row_0_header')) : $item['data']->set_price(get_option('3_row_0_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_0_header') !== '-') {
                        getCount(get_option('5_row_0_header')) ? $item['data']->set_price(get_option('5_row_0_header')) : $item['data']->set_price(get_option('4_row_0_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_0_header') !== '-') {
                        getCount(get_option('6_row_0_header')) ? $item['data']->set_price(get_option('6_row_0_header')) : $item['data']->set_price(get_option('5_row_0_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_0_header') !== '-') {
                        getCount(get_option('7_row_0_header')) ? $item['data']->set_price(get_option('7_row_0_header')) : $item['data']->set_price(get_option('6_row_0_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_0_header') !== '-') {
                        getCount(get_option('8_row_0_header')) ? $item['data']->set_price(get_option('8_row_0_header')) : $item['data']->set_price(get_option('7_row_0_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_0_header') !== '-') {
                        getCount(get_option('9_row_0_header')) ? $item['data']->set_price(get_option('9_row_0_header')) : $item['data']->set_price(get_option('8_row_0_header'));
                    }
                }
            } else {
                $newArray_10 = array_diff($columnArray_10, array(0, null));
                $item['data']->set_price(min($newArray_10));
            }
        }

        /* -15C */
        if (removeSymbols($terms) === get_option('2_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_2_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_1_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_1_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_1_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_1_header') !== '-') {
                        getCount(get_option('2_row_1_header')) ? $item['data']->set_price(get_option('2_row_1_header')) : $item['data']->set_price(get_option('1_row_1_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_1_header') !== '-') {
                        getCount(get_option('3_row_1_header')) ? $item['data']->set_price(get_option('3_row_1_header')) : $item['data']->set_price(get_option('2_row_1_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_1_header') !== '-') {
                        getCount(get_option('4_row_1_header')) ? $item['data']->set_price(get_option('4_row_1_header')) : $item['data']->set_price(get_option('3_row_1_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_1_header') !== '-') {
                        getCount(get_option('5_row_1_header')) ? $item['data']->set_price(get_option('5_row_1_header')) : $item['data']->set_price(get_option('4_row_1_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_1_header') !== '-') {
                        getCount(get_option('6_row_1_header')) ? $item['data']->set_price(get_option('6_row_1_header')) : $item['data']->set_price(get_option('5_row_1_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_1_header') !== '-') {
                        getCount(get_option('7_row_1_header')) ? $item['data']->set_price(get_option('7_row_1_header')) : $item['data']->set_price(get_option('6_row_1_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_1_header') !== '-') {
                        getCount(get_option('8_row_1_header')) ? $item['data']->set_price(get_option('8_row_1_header')) : $item['data']->set_price(get_option('7_row_1_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_1_header') !== '-') {
                        getCount(get_option('9_row_1_header')) ? $item['data']->set_price(get_option('9_row_1_header')) : $item['data']->set_price(get_option('8_row_1_header'));
                    }
                }
            } else {
                $newArray_15 = array_diff($columnArray_15, array(0, null));
                $item['data']->set_price(min($newArray_15));
            }
        }

        /* -20C */
        if (removeSymbols($terms) === get_option('3_header')) {
            $count = $item['quantity'];
            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_3_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_2_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_2_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_2_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_2_header') !== '-') {
                        getCount(get_option('2_row_2_header')) ? $item['data']->set_price(get_option('2_row_2_header')) : $item['data']->set_price(get_option('1_row_2_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_2_header') !== '-') {
                        getCount(get_option('3_row_2_header')) ? $item['data']->set_price(get_option('3_row_2_header')) : $item['data']->set_price(get_option('2_row_2_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_2_header') !== '-') {
                        getCount(get_option('4_row_2_header')) ? $item['data']->set_price(get_option('4_row_2_header')) : $item['data']->set_price(get_option('3_row_2_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_2_header') !== '-') {
                        getCount(get_option('5_row_2_header')) ? $item['data']->set_price(get_option('5_row_2_header')) : $item['data']->set_price(get_option('4_row_2_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_2_header') !== '-') {
                        getCount(get_option('6_row_2_header')) ? $item['data']->set_price(get_option('6_row_2_header')) : $item['data']->set_price(get_option('5_row_2_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_2_header') !== '-') {
                        getCount(get_option('7_row_2_header')) ? $item['data']->set_price(get_option('7_row_2_header')) : $item['data']->set_price(get_option('6_row_2_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_2_header') !== '-') {
                        getCount(get_option('8_row_2_header')) ? $item['data']->set_price(get_option('8_row_2_header')) : $item['data']->set_price(get_option('7_row_2_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_2_header') !== '-') {
                        getCount(get_option('9_row_2_header')) ? $item['data']->set_price(get_option('9_row_2_header')) : $item['data']->set_price(get_option('8_row_2_header'));
                    }
                }
            } else {
                $newArray_20 = array_diff($columnArray_20, array(0, null));
                $item['data']->set_price(min($newArray_20));
            }
        }

        /* -25C */
        if (removeSymbols($terms) == get_option('4_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_4_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_3_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_3_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_3_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_3_header') !== '-') {
                        getCount(get_option('2_row_3_header')) ? $item['data']->set_price(get_option('2_row_3_header')) : $item['data']->set_price(get_option('1_row_3_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_3_header') !== '-') {
                        getCount(get_option('3_row_3_header')) ? $item['data']->set_price(get_option('3_row_3_header')) : $item['data']->set_price(get_option('2_row_3_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_3_header') !== '-') {
                        getCount(get_option('4_row_3_header')) ? $item['data']->set_price(get_option('4_row_3_header')) : $item['data']->set_price(get_option('3_row_3_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_3_header') !== '-') {
                        getCount(get_option('5_row_3_header')) ? $item['data']->set_price(get_option('5_row_3_header')) : $item['data']->set_price(get_option('4_row_3_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_3_header') !== '-') {
                        getCount(get_option('6_row_3_header')) ? $item['data']->set_price(get_option('6_row_3_header')) : $item['data']->set_price(get_option('5_row_3_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_3_header') !== '-') {
                        getCount(get_option('7_row_3_header')) ? $item['data']->set_price(get_option('7_row_3_header')) : $item['data']->set_price(get_option('6_row_3_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_3_header') !== '-') {
                        getCount(get_option('8_row_3_header')) ? $item['data']->set_price(get_option('8_row_3_header')) : $item['data']->set_price(get_option('7_row_3_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_3_header') !== '-') {
                        getCount(get_option('9_row_3_header')) ? $item['data']->set_price(get_option('9_row_3_header')) : $item['data']->set_price(get_option('8_row_3_header'));
                    }
                }
            } else {
                $newArray_25 = array_diff($columnArray_25, array(0, null));
                $item['data']->set_price(min($newArray_25));
            }
        }

        /* -30C */
        if (removeSymbols($terms) === get_option('5_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_5_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_4_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_4_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_4_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_4_header') !== '-') {
                        getCount(get_option('2_row_4_header')) ? $item['data']->set_price(get_option('2_row_4_header')) : $item['data']->set_price(get_option('1_row_4_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_4_header') !== '-') {
                        getCount(get_option('3_row_4_header')) ? $item['data']->set_price(get_option('3_row_4_header')) : $item['data']->set_price(get_option('2_row_4_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_4_header') !== '-') {
                        getCount(get_option('4_row_4_header')) ? $item['data']->set_price(get_option('4_row_4_header')) : $item['data']->set_price(get_option('3_row_4_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_4_header') !== '-') {
                        getCount(get_option('5_row_4_header')) ? $item['data']->set_price(get_option('5_row_4_header')) : $item['data']->set_price(get_option('4_row_4_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_4_header') !== '-') {
                        getCount(get_option('6_row_4_header')) ? $item['data']->set_price(get_option('6_row_4_header')) : $item['data']->set_price(get_option('5_row_4_header'));
                    }

                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_4_header') !== '-') {
                        getCount(get_option('7_row_4_header')) ? $item['data']->set_price(get_option('7_row_4_header')) : $item['data']->set_price(get_option('6_row_4_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_4_header') !== '-') {
                        getCount(get_option('8_row_4_header')) ? $item['data']->set_price(get_option('8_row_4_header')) : $item['data']->set_price(get_option('7_row_4_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_4_header') !== '-') {
                        getCount(get_option('9_row_4_header')) ? $item['data']->set_price(get_option('9_row_4_header')) : $item['data']->set_price(get_option('8_row_4_header'));
                    }
                }
            } else {
                $newArray_30 = array_diff($columnArray_30, array(0, null));
                $item['data']->set_price(min($newArray_30));
            }
        }

        /* -35C */
        if (removeSymbols($terms) === get_option('6_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_6_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_5_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_5_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_5_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_5_header') !== '-') {
                        getCount(get_option('2_row_5_header')) ? $item['data']->set_price(get_option('2_row_5_header')) : $item['data']->set_price(get_option('1_row_5_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_5_header') !== '-') {
                        getCount(get_option('3_row_5_header')) ? $item['data']->set_price(get_option('3_row_5_header')) : $item['data']->set_price(get_option('2_row_5_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_5_header') !== '-') {
                        getCount(get_option('4_row_5_header')) ? $item['data']->set_price(get_option('4_row_5_header')) : $item['data']->set_price(get_option('3_row_5_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_5_header') !== '-') {
                        getCount(get_option('5_row_5_header')) ? $item['data']->set_price(get_option('5_row_5_header')) : $item['data']->set_price(get_option('4_row_5_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_5_header') !== '-') {
                        getCount(get_option('6_row_5_header')) ? $item['data']->set_price(get_option('6_row_5_header')) : $item['data']->set_price(get_option('5_row_5_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_5_header') !== '-') {
                        getCount(get_option('7_row_5_header')) ? $item['data']->set_price(get_option('7_row_5_header')) : $item['data']->set_price(get_option('6_row_5_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_5_header') !== '-') {
                        getCount(get_option('8_row_5_header')) ? $item['data']->set_price(get_option('8_row_5_header')) : $item['data']->set_price(get_option('7_row_5_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_5_header') !== '-') {
                        getCount(get_option('9_row_5_header')) ? $item['data']->set_price(get_option('9_row_5_header')) : $item['data']->set_price(get_option('8_row_5_header'));
                    }
                }
            } else {
                $newArray_35 = array_diff($columnArray_35, array(0, null));
                $item['data']->set_price(min($newArray_35));
            }
        }
        /* -40C */
        if (removeSymbols($terms) === get_option('7_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_7_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_6_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_6_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_6_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_6_header') !== '-') {
                        getCount(get_option('2_row_6_header')) ? $item['data']->set_price(get_option('2_row_6_header')) : $item['data']->set_price(get_option('1_row_6_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_6_header') !== '-') {
                        getCount(get_option('3_row_6_header')) ? $item['data']->set_price(get_option('3_row_6_header')) : $item['data']->set_price(get_option('2_row_6_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_6_header') !== '-') {
                        getCount(get_option('4_row_6_header')) ? $item['data']->set_price(get_option('4_row_6_header')) : $item['data']->set_price(get_option('3_row_6_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_6_header') !== '-') {
                        getCount(get_option('5_row_6_header')) ? $item['data']->set_price(get_option('5_row_6_header')) : $item['data']->set_price(get_option('4_row_6_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_6_header') !== '-') {
                        getCount(get_option('6_row_6_header')) ? $item['data']->set_price(get_option('6_row_6_header')) : $item['data']->set_price(get_option('5_row_6_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_6_header') !== '-') {
                        getCount(get_option('7_row_6_header')) ? $item['data']->set_price(get_option('7_row_6_header')) : $item['data']->set_price(get_option('6_row_6_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_6_header') !== '-') {
                        getCount(get_option('8_row_6_header')) ? $item['data']->set_price(get_option('8_row_6_header')) : $item['data']->set_price(get_option('7_row_6_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_6_header') !== '-') {
                        getCount(get_option('9_row_6_header')) ? $item['data']->set_price(get_option('9_row_6_header')) : $item['data']->set_price(get_option('8_row_6_header'));
                    }
                }
            } else {
                $newArray_40 = array_diff($columnArray_40, array(0, null));
                $item['data']->set_price(min($newArray_40));
            }
        }
        /* -45C */
        if (removeSymbols($terms) === get_option('8_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_8_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_7_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_7_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_7_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_7_header') !== '-') {
                        getCount(get_option('2_row_7_header')) ? $item['data']->set_price(get_option('2_row_7_header')) : $item['data']->set_price(get_option('1_row_7_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_7_header') !== '-') {
                        getCount(get_option('3_row_7_header')) ? $item['data']->set_price(get_option('3_row_7_header')) : $item['data']->set_price(get_option('2_row_7_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_7_header') !== '-') {
                        getCount(get_option('4_row_7_header')) ? $item['data']->set_price(get_option('4_row_7_header')) : $item['data']->set_price(get_option('3_row_7_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_7_header') !== '-') {
                        getCount(get_option('5_row_7_header')) ? $item['data']->set_price(get_option('5_row_7_header')) : $item['data']->set_price(get_option('4_row_7_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_7_header') !== '-') {
                        getCount(get_option('6_row_7_header')) ? $item['data']->set_price(get_option('6_row_7_header')) : $item['data']->set_price(get_option('5_row_7_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_7_header') !== '-') {
                        getCount(get_option('7_row_7_header')) ? $item['data']->set_price(get_option('7_row_7_header')) : $item['data']->set_price(get_option('6_row_7_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_7_header') !== '-') {
                        getCount(get_option('8_row_7_header')) ? $item['data']->set_price(get_option('8_row_7_header')) : $item['data']->set_price(get_option('7_row_7_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_7_header') !== '-') {
                        getCount(get_option('9_row_7_header')) ? $item['data']->set_price(get_option('9_row_7_header')) : $item['data']->set_price(get_option('8_row_7_header'));
                    }
                }
            } else {
                $newArray_45 = array_diff($columnArray_45, array(0, null));
                $item['data']->set_price(min($newArray_45));
            }
        }
        /* -50C */
        if (removeSymbols($terms) === get_option('9_header')) {
            $count = $item['quantity'];

            /* до 50 */
            if ($count < $rowArray) {
                if ($count < $left_1) {
                    if (get_option('1_row_9_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_8_header'));
                    }
                }
                /* 50 <-> 150 */
                if ($left_2) {
                    if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_8_header') !== '-') {
                        $item['data']->set_price(get_option('1_row_8_header'));
                    }
                }
                /* 151 <-> 750 */
                if ($left_3) {
                    if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_8_header') !== '-') {
                        getCount(get_option('2_row_8_header')) ? $item['data']->set_price(get_option('2_row_8_header')) : $item['data']->set_price(get_option('1_row_8_header'));
                    }
                }
                /* 751 <-> 1200 */
                if ($left_4) {
                    if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_8_header') !== '-') {
                        getCount(get_option('3_row_8_header')) ? $item['data']->set_price(get_option('3_row_8_header')) : $item['data']->set_price(get_option('2_row_8_header'));
                    }
                }
                /* 1201 <-> 2500 */
                if ($left_5) {
                    if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_8_header') !== '-') {
                        getCount(get_option('4_row_8_header')) ? $item['data']->set_price(get_option('4_row_8_header')) : $item['data']->set_price(get_option('3_row_8_header'));
                    }
                }
                /* 2501 <-> 5000 */
                if ($left_6) {
                    if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_8_header') !== '-') {
                        getCount(get_option('5_row_8_header')) ? $item['data']->set_price(get_option('5_row_8_header')) : $item['data']->set_price(get_option('4_row_8_header'));
                    }
                }
                /* 5001 <-> 10000 */
                if ($left_7) {
                    if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_8_header') !== '-') {
                        getCount(get_option('6_row_8_header')) ? $item['data']->set_price(get_option('6_row_8_header')) : $item['data']->set_price(get_option('5_row_8_header'));
                    }
                }
                /* 10001 <-> 15000 */
                if ($left_8) {
                    if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_8_header') !== '-') {
                        getCount(get_option('7_row_8_header')) ? $item['data']->set_price(get_option('7_row_8_header')) : $item['data']->set_price(get_option('6_row_8_header'));
                    }
                }
                /* 15001 <-> 20000 */
                if ($left_9) {
                    if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_8_header') !== '-') {
                        getCount(get_option('8_row_8_header')) ? $item['data']->set_price(get_option('8_row_8_header')) : $item['data']->set_price(get_option('7_row_8_header'));
                    }
                }
                /* ? */
                if ($left_10) {
                    if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_8_header') !== '-') {
                        getCount(get_option('9_row_8_header')) ? $item['data']->set_price(get_option('9_row_8_header')) : $item['data']->set_price(get_option('8_row_8_header'));
                    }
                }
            } else {
                $newArray_50 = array_diff($columnArray_50, array(0, null));
                $item['data']->set_price(min($newArray_50));
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

// Добавить поле "количество", на странице всех товарав
//add_filter( 'woocommerce_loop_add_to_cart_link', function( $html, $product ) {
//    if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
//        $html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="wcb2b-quantity" method="post" enctype="multipart/form-data">';
//        $html .= woocommerce_quantity_input( array(), $product, false );
//        $html .= '<button type="submit" class="button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
//        $html .= '</form>';
//    }
//    return $html;
//}, 10, 2 );

add_action('woocommerce_review_order_after_order_total', 'checkout_review_order_custom_field');

function checkout_review_order_custom_field()
{
    echo '<tr><td>Text here</td><td>';

    woocommerce_form_field('my_split_checkbox', array(
        'type' => 'checkbox',
        'class' => array('checkbox_field'),
        'label' => __('', 'woocommerce'),
        'required' => false,
    ));

    echo '</td></tr>';
}

// add_action( 'woocommerce_before_calculate_totals', 'add_custom_prices' );
// function add_custom_prices( $cart_object ) {
//    $custom_price = 9; // This will be your custome price
//    foreach ( $cart_object->cart_contents as $key => $value ) {
//        // $value['data']->price = $custom_price;
//        // for WooCommerce version 3+ use:
//        $value['data']->set_price($custom_price);
//    }
// }
