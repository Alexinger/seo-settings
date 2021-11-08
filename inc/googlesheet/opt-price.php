<?php
include_once 'UpdatePrice.php';

if (!get_option('statusTable')) {
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
            $update->update_get_option_canister();
        }

        /* create variables незамерзайка left_1-10 */
        $left_1 = $left_2 = $left_3 = $left_4 = $left_5 = $left_6 = $left_7 = $left_8 = $left_9 = $left_10 = $left_11 = $left_12 = $left_13 = $left_14 = $left_15 = $left_16 = '';
        /* добавление переменных для количества по канистрам */
        $lefts_21 = $lefts_22 = $lefts_23 = $lefts_24 = $lefts_25 = $lefts_26 = $lefts_27 = $lefts_28 = $lefts_29 = $lefts_30 = '';

        /* цикл перебора и добавление в переменные значений первого столбца количества по НЕЗАМЕРЗАЙКЕ */
        for ($i = 1; $i < 11; $i++) {
            ${"left_$i"} = get_option($i . '_row_left');
        }
        /* цикл перебора и добавление в переменные значений первого столбца количества по КАНИСТРАМ */
        for ($s = 21; $s < 30; $s++) {
            ${"lefts_$s"} = get_option($s . '_rows_lefts');
        }

        foreach ($cart->get_cart() as $item) {
            $terms = get_the_terms($item['product_id'], 'product_cat');
            $str = strpos($terms[0]->name, '-');
            /* Если у товара есть TERMS то есть у незамерзайки 30 то это условие, иначе это канистры */
            if ($str === 0) {
                /*max value counter first row the table*/
                $rowArray = max([$left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10]);
                $temperAll = [get_option('0_row_1_header'), get_option('0_row_2_header'), get_option('0_row_3_header'), get_option('0_row_4_header'), get_option('0_row_5_header'), get_option('0_row_6_header'), get_option('0_row_7_header'), get_option('0_row_8_header'), get_option('0_row_9_header'), get_option('0_row_10_header')];

                /*this count products*/
                $count = $item['quantity'];

                /*start index 0, added +1*/
                $index = array_search(removeSymbols($terms), getCount($temperAll)) + 1; // index number && search column price
                if (removeSymbols($terms)) {
                    getPriceProductsBack($index, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10, $left_11, $left_12, $left_13, $left_14, $left_15, $left_16);
                }
            } else {
                /* Это вычисление для канистр */
                $termsCanister = get_the_title($item['product_id']);
/*echo "<br>" . $termsCanister . "<br>";*/
                /*max value counter first row the table*/
                $rowArrayCanister = max([$lefts_21, $lefts_22, $lefts_23, $lefts_24, $lefts_25, $lefts_26, $lefts_27, $lefts_28, $lefts_29, $lefts_30]);
                $temperAllCanister = [getCountCanister(get_option('20_rows_1_headers')), getCountCanister(get_option('20_rows_2_headers')), getCountCanister(get_option('20_rows_3_headers')), getCountCanister(get_option('20_rows_4_headers')), getCountCanister(get_option('20_rows_5_headers')), getCountCanister(get_option('20_rows_6_headers')), getCountCanister(get_option('20_rows_7_headers')), getCountCanister(get_option('20_rows_8_headers')), getCountCanister(get_option('20_rows_9_headers')), getCountCanister(get_option('20_rows_10_headers'))];
               /* echo getCountCanister(get_option('20_rows_1_headers')) . "<br>";
                echo getCountCanister(get_option('20_rows_2_headers')) . "<br>";
                echo getCountCanister(get_option('20_rows_3_headers')) . "<br>";
                echo getCountCanister(get_option('20_rows_4_headers')) . "<br>";
                echo getCountCanister(get_option('20_rows_5_headers')) . "<br>";*/
                /*this count products канистры */
                $counts = $item['quantity'];

                $indexs = array_search(removeSymbolsCanister($termsCanister), $temperAllCanister) +1; // index number && search column price
                /*echo "Index canister: " . $indexs;*/
                if (removeSymbolsCanister($termsCanister)) {
                    getPriceProductsBackCanister($indexs, $counts, $rowArrayCanister, $item, $lefts_21, $lefts_22, $lefts_23, $lefts_24, $lefts_25, $lefts_26, $lefts_27, $lefts_28, $lefts_29, $lefts_30);
                }
            }
        }
    }

    function getCanisterCode($item)
    {
        foreach ($item as $items) {
            if ($items !== '') {
                $str_c = strpos($items, '(');
                $code[] = substr($items, $str_c + 1, 4);
                return $code;
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
        /*var_dump($item);*/
        if (isset($item) && $item !== '' && is_array($item)) {
            foreach ($item as $grad) {
                if (strlen($grad) > 6) {
                    /*var_dump("Больше 6: " . $grad);*/
                    $msg = array();
                    $x = preg_replace('/[^0-9$]/', '', $item);
                    foreach ($x as $i) {
                        $msg[] = substr($i, 0, 2);
                    }
                    $set = $msg;;
                    return $set;
                }
            }
        }
        return preg_replace('/[^0-9$]/', '', $item);
    }


    function getCountCanister($item)
    {
        $str_c = strpos($item, '(');
        $codeCanister = substr($item, $str_c + 1, 4);
        return $codeCanister;
    }

    /*
     * @return string
     * "NS25"
     * */
    function removeSymbolsCanister($var)
    {
        $str_c = strpos($var, '(');
        $codeCanister = substr($var, $str_c + 1, 4);
        return $codeCanister;

    }

    function removeSymbols($var)
    {
        /*var_dump($var[0]);*/
        $str_0 = $str_1 = null;
        if ((isset($var[0]->name))) {
            $str_0 = preg_replace('/[^0-9]/', '', $var[0]->name);
        }
        if ((isset($var[1]->name))) {
            $str_1 = preg_replace('/[^0-9]/', '', $var[1]->name);
        }
        $str_2 = preg_replace('/[^0-9]/', '', $var[2]->name);
        $str_3 = preg_replace('/[^0-9]/', '', $var[3]->name);
        $str_4 = preg_replace('/[^0-9]/', '', $var[4]->name);
        $str_5 = preg_replace('/[^0-9]/', '', $var[5]->name);
        $str_6 = preg_replace('/[^0-9]/', '', $var[6]->name);
        $str_7 = preg_replace('/[^0-9]/', '', $var[7]->name);
        $str_8 = preg_replace('/[^0-9]/', '', $var[8]->name);
        $str_9 = preg_replace('/[^0-9]/', '', $var[9]->name);
        $str_10 = preg_replace('/[^0-9]/', '', $var[10]->name);
        $str_11 = preg_replace('/[^0-9]/', '', $var[11]->name);
        $str_12 = preg_replace('/[^0-9]/', '', $var[12]->name);
        $str_13 = preg_replace('/[^0-9]/', '', $var[13]->name);
        $str_14 = preg_replace('/[^0-9]/', '', $var[14]->name);
        $str_15 = preg_replace('/[^0-9]/', '', $var[15]->name);

        if ($str_0) {
            return $str_0;
        }
        if ($str_1) {
            return $str_1;
        }
        if ($str_2) {
            return $str_2;
        }
        if ($str_3) {
            return $str_3;
        }
        if ($str_4) {
            return $str_4;
        }
        if ($str_5) {
            return $str_5;
        }
        if ($str_6) {
            return $str_6;
        }
        if ($str_7) {
            return $str_7;
        }
        if ($str_8) {
            return $str_8;
        }
        if ($str_9) {
            return $str_9;
        }
        if ($str_10) {
            return $str_10;
        }
        if ($str_11) {
            return $str_11;
        }
        if ($str_12) {
            return $str_12;
        }
        if ($str_13) {
            return $str_13;
        }
        if ($str_14) {
            return $str_14;
        }
        if ($str_15) {
            return $str_15;
        }
    }

    add_action('wp_footer', 'cart_update_qty_script');
    function cart_update_qty_script()
    {
        if (is_cart()) : ?>
            <script>
                (function ($){
                    $('div.woocommerce').on('blur', '.qty', function () {
                        $("[name='update_cart']").trigger("click");
                    });
                })(JQuery);
            </script>
        <?php endif;
    }

    /*notice – обычное уведомление
    success – уведомление об успехе
    error – уведомление об ошибке
    getNotice($item, 'error', 'При вашем заказе в количестве %s, вы можете получить другие цены по контактам на этой <a href="/404">странице</a>');*/
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

    /*On single product pages Изменяем количество на странице одного товара*/
    add_filter('woocommerce_quantity_input_args', 'min_qty_filter_callback', 20, 2);
    function min_qty_filter_callback($args, $product)
    {
        $args['min_value'] = get_option('1_row_left');
        return $args;
    }

    /*On shop and archives pages Изменяем количество при добавлении в корзину*/
    add_filter('woocommerce_loop_add_to_cart_args', 'min_qty_loop_add_to_cart_args', 10, 2);
    function min_qty_loop_add_to_cart_args($args, $product)
    {
        $args['quantity'] = get_option('1_row_left');
        return $args;
    }

    function getPriceProductsBack($index, $count, $rowArray, $item, $left_1, $left_2, $left_3, $left_4, $left_5, $left_6, $left_7, $left_8, $left_9, $left_10, $left_11, $left_12, $left_13, $left_14, $left_15, $left_16)
    {
        if ($count < $rowArray) {
            if ($count <= $left_1) {
                $item['data']->set_price(get_option('1_row_' . $index . '_header'));
            }
            if ($count >= $left_1 && $count <= $left_2 && get_option('1_row_' . $index . '_header') !== '-') {
                $item['data']->set_price(get_option('1_row_' . $index . '_header'));
            }
            if ($count >= $left_2 && $count <= $left_3 && get_option('2_row_' . $index . '_header') !== '-') {
                getCount(get_option('2_row_' . $index . '_header')) ? $item['data']->set_price(get_option('2_row_' . $index . '_header')) : $item['data']->set_price(get_option('1_row_' . $index . '_header'));
            }
            if ($count >= $left_3 && $count <= $left_4 && get_option('3_row_' . $index . '_header') !== '-') {
                getCount(get_option('3_row_' . $index . '_header')) ? $item['data']->set_price(get_option('3_row_' . $index . '_header')) : $item['data']->set_price(get_option('2_row_' . $index . '_header'));
            }
            if ($count >= $left_4 && $count <= $left_5 && get_option('4_row_' . $index . '_header') !== '-') {
                getCount(get_option('4_row_' . $index . '_header')) ? $item['data']->set_price(get_option('4_row_' . $index . '_header')) : $item['data']->set_price(get_option('3_row_' . $index . '_header'));
            }
            if ($count >= $left_5 && $count <= $left_6 && get_option('5_row_' . $index . '_header') !== '-') {
                getCount(get_option('5_row_' . $index . '_header')) ? $item['data']->set_price(get_option('5_row_' . $index . '_header')) : $item['data']->set_price(get_option('4_row_' . $index . '_header'));
            }
            if ($count >= $left_6 && $count <= $left_7 && get_option('6_row_' . $index . '_header') !== '-') {
                getCount(get_option('6_row_' . $index . '_header')) ? $item['data']->set_price(get_option('6_row_' . $index . '_header')) : $item['data']->set_price(get_option('5_row_' . $index . '_header'));
            }
            if ($count >= $left_7 && $count <= $left_8 && get_option('7_row_' . $index . '_header') !== '-') {
                getCount(get_option('7_row_' . $index . '_header')) ? $item['data']->set_price(get_option('7_row_' . $index . '_header')) : $item['data']->set_price(get_option('6_row_' . $index . '_header'));
            }
            if ($count >= $left_8 && $count <= $left_9 && get_option('8_row_' . $index . '_header') !== '-') {
                getCount(get_option('8_row_' . $index . '_header')) ? $item['data']->set_price(get_option('8_row_' . $index . '_header')) : $item['data']->set_price(get_option('7_row_' . $index . '_header'));
            }
            if ($count >= $left_9 && $count <= $left_10 && get_option('9_row_' . $index . '_header') !== '-') {
                getCount(get_option('9_row_' . $index . '_header')) ? $item['data']->set_price(get_option('9_row_' . $index . '_header')) : $item['data']->set_price(get_option('8_row_' . $index . '_header'));
            }
            if ($count >= $left_10 && $count <= $left_11 && get_option('10_row_' . $index . '_header') !== '-') {
                getCount(get_option('10_row_' . $index . '_header')) ? $item['data']->set_price(get_option('10_row_' . $index . '_header')) : $item['data']->set_price(get_option('9_row_' . $index . '_header'));
            }
            if ($count >= $left_11 && $count <= $left_12 && get_option('11_row_' . $index . '_header') !== '-') {
                getCount(get_option('11_row_' . $index . '_header')) ? $item['data']->set_price(get_option('11_row_' . $index . '_header')) : $item['data']->set_price(get_option('10_row_' . $index . '_header'));
            }
            if ($count >= $left_12 && $count <= $left_13 && get_option('12_row_' . $index . '_header') !== '-') {
                getCount(get_option('12_row_' . $index . '_header')) ? $item['data']->set_price(get_option('12_row_' . $index . '_header')) : $item['data']->set_price(get_option('11_row_' . $index . '_header'));
            }
            if ($count >= $left_13 && $count <= $left_14 && get_option('13_row_' . $index . '_header') !== '-') {
                getCount(get_option('13_row_' . $index . '_header')) ? $item['data']->set_price(get_option('13_row_' . $index . '_header')) : $item['data']->set_price(get_option('12_row_' . $index . '_header'));
            }
            if ($count >= $left_14 && $count <= $left_15 && get_option('14_row_' . $index . '_header') !== '-') {
                getCount(get_option('14_row_' . $index . '_header')) ? $item['data']->set_price(get_option('14_row_' . $index . '_header')) : $item['data']->set_price(get_option('13_row_' . $index . '_header'));
            }
            if ($count >= $left_15 && $count <= $left_16 && get_option('15_row_' . $index . '_header') !== '-') {
                getCount(get_option('15_row_' . $index . '_header')) ? $item['data']->set_price(get_option('15_row_' . $index . '_header')) : $item['data']->set_price(get_option('14_row_' . $index . '_header'));
            }
        } else {
            $columnArray = [get_option('1_row_' . $index . '_header'), get_option('2_row_' . $index . '_header'), get_option('3_row_' . $index . '_header'), get_option('4_row_' . $index . '_header'), get_option('5_row_' . $index . '_header'), get_option('6_row_' . $index . '_header'), get_option('7_row_' . $index . '_header'), get_option('8_row_' . $index . '_header'), get_option('9_row_' . $index . '_header'), get_option('10_row_' . $index . '_header'), get_option('11_row_' . $index . '_header'), get_option('12_row_' . $index . '_header'), get_option('13_row_' . $index . '_header'), get_option('14_row_' . $index . '_header'), get_option('15_row_' . $index . '_header'), get_option('16_row_' . $index . '_header')];
            $newArray = array_diff($columnArray, array(0, null));
            $item['data']->set_price(min($newArray));
        }
    }

    function getPriceProductsBackCanister($indexs, $counts, $rowArrayCanister, $item, $lefts_1, $lefts_2, $lefts_3, $lefts_4, $lefts_5, $lefts_6, $lefts_7, $lefts_8, $lefts_9, $lefts_10)
    {
        if ($counts < $rowArrayCanister) {
            if ($counts <= $lefts_1) {
                $item['data']->set_price(get_option('21_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_1 && $counts <= $lefts_2 && get_option('21_rows_' . $indexs . '_headers') !== '-') {
                $item['data']->set_price(get_option('21_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_2 && $counts <= $lefts_3 && get_option('22_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('22_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('22_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('21_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_3 && $counts <= $lefts_4 && get_option('23_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('23_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('23_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('22_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_4 && $counts <= $lefts_5 && get_option('24_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('24_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('24_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('23_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_5 && $counts <= $lefts_6 && get_option('25_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('25_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('25_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('24_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_6 && $counts <= $lefts_7 && get_option('26_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('26_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('26_rows_' . $indexs . '_header')) : $item['data']->set_price(get_option('25_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_7 && $counts <= $lefts_8 && get_option('27_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('27_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('27_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('26_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_8 && $counts <= $lefts_9 && get_option('28_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('28_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('28_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('27_rows_' . $indexs . '_headers'));
            }
            if ($counts >= $lefts_9 && $counts <= $lefts_10 && get_option('29_rows_' . $indexs . '_headers') !== '-') {
                getCount(get_option('29_rows_' . $indexs . '_headers')) ? $item['data']->set_price(get_option('29_rows_' . $indexs . '_headers')) : $item['data']->set_price(get_option('28_rows_' . $indexs . '_headers'));
            }
        } else {
            $columnArrayCanister = [get_option('21_rows_' . $indexs . '_headers'), get_option('22_rows_' . $indexs . '_headers'), get_option('23_rows_' . $indexs . '_headers'), get_option('24_rows_' . $indexs . '_headers'), get_option('25_rows_' . $indexs . '_headers'), get_option('26_rows_' . $indexs . '_headers'), get_option('27_rows_' . $indexs . '_headers'), get_option('28_rows_' . $indexs . '_headers'), get_option('29_rows_' . $indexs . '_headers'), get_option('30_rows_' . $indexs . '_headers')];
            $newArrayCanister = array_diff($columnArrayCanister, array(0, null));
            $item['data']->set_price(min($newArrayCanister));
        }
    }
}