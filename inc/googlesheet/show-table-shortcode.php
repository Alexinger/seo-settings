<?php
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

    $tr1 = $tr2 = $tr3 = $tr4 = $tr5 = $tr6 = $tr7 = $tr8 = $tr9 = $tr10 = $tr11 = $tr12 = $tr13 = $tr14 = $tr15 = $tr16 = null;

    $start = '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;}</style>' .
        '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>' .
        '<table class="table table-bordered table-hover table-my-style" style="background-color: ' . $atts['table_bg'] . '">
           <thead style="color: ' . $atts['table_color_value'] . '">
            <tr>';
    for ($i = 0; $i < 16; $i++) {
        if (isset($array[0][$i])) {
            $start .= '<th class="my-table" style="white-space: pre-wrap;vertical-align: middle;line-height: 0.7rem;">' . $array[0][$i] . '</th>';
        }
    }
    $start .= '</tr></thead>';

    for ($s = 1; $s < 16; $s++) {
        if (isset($array[$s][0])) {
            ${'tr' . $s} .= '<tr>';
            for ($i = 0; $i < 16; $i++) {
                if (isset($array[$s][$i])) {
                    ${'tr' . $s} .= '<td class="my-table">' . $array[$s][$i] . '</td>';
                }
            }
            ${'tr' . $s} .= '</tr>';
        }
    }

    $end = '</table>';

   // echo '<div class="widget_shopping_cart_content">' . woocommerce_mini_cart() . '</div>';

    return $start . $tr1 . $tr2 . $tr3 . $tr4 . $tr5 . $tr6 . $tr7 . $tr8 . $tr9 . $tr10 . $tr11 . $tr12 . $tr13 . $tr14 . $tr15 . $end . '</tr>';
}
