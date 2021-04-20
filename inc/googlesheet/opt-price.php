<?php

add_action('woocommerce_before_calculate_totals', 'add_custom_price', 20, 1);
function add_custom_price($cart)
{

    if (is_admin() && !defined('DOING_AJAX'))
        return;

    if (did_action('woocommerce_before_calculate_totals') >= 2)
        return;

    foreach ($cart->get_cart() as $item) {

        $terms = get_the_terms($item['product_id'], 'product_cat');

        /* -20C */
        if (removeSymbols($terms) == "20") {
            /* 50 <-> 150 */
            if ($item['quantity'] >= 50 && $item['quantity'] <= 150) {
                $item['data']->set_price(80);
            }
            /* 151 <-> 750 */
            if ($item['quantity'] >= 151 && $item['quantity'] <= 750) {
                $item['data']->set_price(75);
            }
            /* 751 <-> 1200 */
            if ($item['quantity'] >= 751 && $item['quantity'] <= 1200) {
                $item['data']->set_price(69);
            }
            /* 1201 <-> 2500 */
            if ($item['quantity'] >= 1201 && $item['quantity'] <= 2500) {
                $item['data']->set_price(67);
            }
            /* 2501 <-> 5000 */
            if ($item['quantity'] >= 2501 && $item['quantity'] <= 5000) {
                $item['data']->set_price(0);
            }
        }
        /* -25C */
        if (removeSymbols($terms) == "25") {
            /* 50 <-> 150 */
            if ($item['quantity'] >= 50 && $item['quantity'] <= 150) {
                $item['data']->set_price(85);
            }
            /* 151 <-> 750 */
            if ($item['quantity'] >= 151 && $item['quantity'] <= 750) {
                $item['data']->set_price(82);
            }
            /* 751 <-> 1200 */
            if ($item['quantity'] >= 751 && $item['quantity'] <= 1200) {
                $item['data']->set_price(74);
            }
            /* 1201 <-> 2500 */
            if ($item['quantity'] >= 1201 && $item['quantity'] <= 2500) {
                $item['data']->set_price(72);
            }
            /* 2501 <-> 5000 */
            if ($item['quantity'] >= 2501 && $item['quantity'] <= 5000) {
                $item['data']->set_price(0);
            }
        }
        /* -30C */
        if (removeSymbols($terms) == "30") {
            /* 50 <-> 150 */
            if ($item['quantity'] >= 50 && $item['quantity'] <= 150) {
                $item['data']->set_price(88);
            }
            /* 151 <-> 750 */
            if ($item['quantity'] >= 151 && $item['quantity'] <= 750) {
                $item['data']->set_price(85);
            }
            /* 751 <-> 1200 */
            if ($item['quantity'] >= 751 && $item['quantity'] <= 1200) {
                $item['data']->set_price(80);
            }
            /* 1201 <-> 2500 */
            if ($item['quantity'] >= 1201 && $item['quantity'] <= 2500) {
                $item['data']->set_price(78);
            }
            /* 2501 <-> 5000 */
            if ($item['quantity'] >= 2501 && $item['quantity'] <= 5000) {
                $item['data']->set_price(0);
            }
        }
        /* -35C */
        if (removeSymbols($terms) == "35") {
            /* 50 <-> 150 */
            if ($item['quantity'] >= 50 && $item['quantity'] <= 150) {
                $item['data']->set_price(98);
            }
            /* 151 <-> 750 */
            if ($item['quantity'] >= 151 && $item['quantity'] <= 750) {
                $item['data']->set_price(95);
            }
            /* 751 <-> 1200 */
            if ($item['quantity'] >= 751 && $item['quantity'] <= 1200) {
                $item['data']->set_price(94);
            }
            /* 1201 <-> 2500 */
            if ($item['quantity'] >= 1201 && $item['quantity'] <= 2500) {
                $item['data']->set_price(92);
            }
            /* 2501 <-> 5000 */
            if ($item['quantity'] >= 2501 && $item['quantity'] <= 5000) {
                $item['data']->set_price(0);
            }
        }
        /* -40C */
        if (removeSymbols($terms) == "40") {
            /* 50 <-> 150 */
            if ($item['quantity'] >= 50 && $item['quantity'] <= 150) {
                $item['data']->set_price(105);
            }
            /* 151 <-> 750 */
            if ($item['quantity'] >= 151 && $item['quantity'] <= 750) {
                $item['data']->set_price(100);
            }
            /* 751 <-> 1200 */
            if ($item['quantity'] >= 751 && $item['quantity'] <= 1200) {
                $item['data']->set_price(98);
            }
            /* 1201 <-> 2500 */
            if ($item['quantity'] >= 1201 && $item['quantity'] <= 2500) {
                $item['data']->set_price(95);
            }
            /* 2501 <-> 5000 */
            if ($item['quantity'] >= 2501 && $item['quantity'] <= 5000) {
                $item['data']->set_price(0);
            }
        }
    }
}

function removeSymbols($var)
{
    $set_null = substr($var[0]->name, 1, 2);
    $set_one = substr($var[1]->name, 1, 2);
    $set_two = substr($var[2]->name, 1, 2);
    $set_three = substr($var[3]->name, 1, 2);

    if (ctype_digit($set_null)) {
        return substr($var[0]->name, 1, 2);
    }
    if (ctype_digit($set_one)) {
        return substr($var[1]->name, 1, 2);
    }
    if (ctype_digit($set_two)) {
        return substr($var[2]->name, 1, 2);
    }
    if (ctype_digit($set_three)) {
        return substr($var[3]->name, 1, 2);
    }
}

add_action('wp_footer', 'cart_update_qty_script');
function cart_update_qty_script()
{
    if (is_cart()) :
        ?>
        <script>
            jQuery('div.woocommerce').on('change', '.qty', function () {
                // jQuery("[name='update_cart']").trigger("click");
            });
        </script>
    <?php
    endif;
}
