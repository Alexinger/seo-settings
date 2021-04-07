<?php

global $shortcode_tags;

add_shortcode("google_sheet", "get_google_sheet");

function get_google_sheet($atts = null)
{
    $atts = shortcode_atts([
        'title' => 'Прайс лист',
        'title_color' => '#a5bf8f',
        'table_bg' => 'white',
        'table_color_value' => 'black',
    ], $atts);

    // $id = '19Tv0hdhBAmniibBTt2TKlXRtdhki6Rr3KSRMh-AcpTc';
    // $gid = '725782487';
    $gid = get_option("tabs-shortcode-url");
    $id = get_option("tabs-shortcode-page");
    $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
    $csv = explode("\r\n", $csv);
    $array = array_map('str_getcsv', $csv);
    get_table($array, $atts);
}

function get_table($array, $atts)
{
    echo '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;}</style>';
    echo '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>';
    echo '
    <table class="table table-bordered table-hover" style="background-color: ' . $atts['table_bg'] . '">
  <thead style="color: ' . $atts['table_color_value'] . '">
    <tr>';
    for ($h = 0; $h < 10; $h++) {
        if ($array[0][$h] !== NULL) {
            echo '<td class="my-table">' . $array[0][$h] . '</td>';
        }
    }

    echo '</tr>
  </thead>
  <tbody style="color: ' . $atts['table_color_value'] . '">';

    for ($i = 1; $i < 15; $i++) {
        echo '<tr>';
        for ($t = 0; $t < 10; $t++) {
            if ($array[$i][$t] !== NULL) {
                echo '<td class="my-table">' . $array[$i][$t] . '</td>';
            }
        }
        echo '</tr>';
    }

    echo '
  </tbody>
</table>
    ';
}

?>

    <style>
        th.my-table {
            /*font-weight: 700 !important;*/
            line-height: 2rem !important;
            text-align: center !important;
        }

        td.my-table {
            vertical-align: center !important;
            line-height: 2rem !important;
            text-align: center !important;
            /*font-family: cursive;*/
            /*font-size: x-large;*/
        }
    </style>

<?
