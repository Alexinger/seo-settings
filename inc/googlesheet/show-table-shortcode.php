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
