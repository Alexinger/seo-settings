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
    update_get_option($array);
    get_table($array, $atts);
}

function get_table($array, $atts)
{
    echo '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;}</style>';
    echo '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>';
    echo '
    <table class="table table-bordered table-hover" style="background-color: ' . $atts['table_bg'] . ';table-layout: fixed !important;font-size: 0.7em !important;font-family: sans-serif !important;">
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

function update_get_option($array)
{
    /* head row - name table */

    echo "<pre>";

    /* All row item water - NEW */
    update_option('1_row_left', $array[1][0]); // 50
    update_option('1_row_right', $array[1][1]); // 151

    update_option('2_row_left', $array[2][0]); // 151
    update_option('2_row_right', $array[2][1]); // 750

    update_option('3_row_left', $array[3][0]); // 751
    update_option('3_row_right', $array[3][1]); // 1200

    update_option('4_row_left', $array[4][0]); // 1201
    update_option('4_row_right', $array[4][1]); // 2500

    update_option('5_row_left', $array[5][0]); // ?
    update_option('5_row_right', $array[5][1]); // ?

    update_option('6_row_left', $array[5][0]); // ?
    update_option('6_row_right', $array[5][1]); // ?

    update_option('7_row_left', $array[5][0]); // ?
    update_option('7_row_right', $array[5][1]); // ?

    update_option('8_row_left', $array[5][0]); // ?
    update_option('8_row_right', $array[5][1]); // ?

    update_option('9_row_left', $array[5][0]); // ?
    update_option('9_row_right', $array[5][1]); // ?

    update_option('10_row_left', $array[5][0]); // ?
    update_option('10_row_right', $array[5][1]); // ?

    /* All column item temperature - (const) NEW */
    update_option('1_header', substr($array[0][2], 1, 2)); // temperature -10
    update_option('2_header', substr($array[0][3], 1, 2)); // temperature -15
    update_option('3_header', substr($array[0][4], 1, 2)); // temperature -20
    update_option('4_header', substr($array[0][5], 1, 2)); // temperature -25
    update_option('5_header', substr($array[0][6], 1, 2)); // temperature -30
    update_option('6_header', substr($array[0][7], 1, 2)); // temperature -35
    update_option('7_header', substr($array[0][8], 1, 2)); // temperature -40

    /* All column item temperature - (const) (-10, -15, -20, -25, -30, -35, -40) */
    for ($temperature = 1; $temperature < 8; $temperature++) {
        update_option($temperature . '_header', substr($array[0][$temperature + 1], 1, 2));
    }

    /* All variables volume and temperature*/
    for ($count = 1; $count < 7;$count++) {
        for ($volume = 1; $volume < 11; $volume++) {
            update_option($volume . '_row_' . $count . '_header', $array[$volume][$count + 1]);
        }
    }

    /* -10 */
    /* (50-150) value (-) */
    /* (151-750) value (-) */
    /* (751-1200) value (-) */
    /* (1201-2500) value (-) */
    /* (2501-5001) value (-)*/
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */

    /* -15 */
    /* (50-150) value (-) */
    /* (151-750) value (-) */
    /* (751-1200) value (-) */
    /* (1201-2500) value (-) */
    /* (2501-5001) value (-)*/
    /* (?) value (-) */
    /* (?) value (-) */
    /* (?) value (-) */
    /* (?) value (-) */
    /* (?) value (-) */

    /* -20 */
    /* (50-150) value (80) */
    /* (151-750) value (75) */
    /* (751-1200) value (69) */
    /* (1201-2500) value (67)*/
    /* (2501-5001) value (по звонку) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */

    /* All temperature -25 NEW */
    /* (50-150) value (85) */
    /* (151-750) value (82) */
    /* (751-1200) value (74) */
    /* (1201-2500) value (72) */
    /* (2501-5001) value (по звонку) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */
    /* (?) value (?) */

    /* All temperature -30 NEW */
    /* -30C (50-150) */
    update_option('1_row_5_header', $array[1][6]); // value (88)
    /* -30C (151-750) */
    update_option('2_row_5_header', $array[2][6]); // value (85)
    /* -30C (751-1200) */
    update_option('3_row_5_header', $array[3][6]); // value (80)
    /* -30C (1201-2500) */
    update_option('4_row_5_header', $array[4][6]); // value (78)
    /* -30C (2501-5001) */
    update_option('5_row_5_header', $array[5][6]); // value (по звонку)
    /* -30C (?) */
    update_option('6_row_5_header', $array[6][6]); // value (?)
    /* -30C (?) */
    update_option('7_row_5_header', $array[7][6]); // value (?)
    /* -30C (?) */
    update_option('8_row_5_header', $array[8][6]); // value (?)
    /* -30C (?) */
    update_option('9_row_5_header', $array[9][6]); // value (?)
    /* -30C (?) */
    update_option('10_row_5_header', $array[10][6]); // value (?)

    /* All temperature -35 NEW */
    /* -35C (50-150) */
    update_option('1_row_6_header', $array[1][7]); // value (98)
    /* -35C (151-750) */
    update_option('2_row_6_header', $array[2][7]); // value (95)
    /* -35C (751-1200) */
    update_option('3_row_6_header', $array[3][7]); // value (94)
    /* -35C (1201-2500) */
    update_option('4_row_6_header', $array[4][7]); // value (92)
    /* -35C (2501-5001) */
    update_option('5_row_6_header', $array[5][7]); // value (по звонку)
    /* -35C (?) */
    update_option('6_row_6_header', $array[6][7]); // value (?)
    /* -35C (?) */
    update_option('7_row_6_header', $array[7][7]); // value (?)
    /* -35C (?) */
    update_option('8_row_6_header', $array[8][7]); // value (?)
    /* -35C (?) */
    update_option('9_row_6_header', $array[9][7]); // value (?)
    /* -35C (?) */
    update_option('10_row_6_header', $array[10][7]); // value (?)

    /* All temperature -40 NEW */
    /* -40C (50-150) */
    update_option('1_row_7_header', $array[1][8]); // value (105)
    /* -40C (151-750) */
    update_option('2_row_7_header', $array[2][8]); // value (100)
    /* -40C (751-1200) */
    update_option('3_row_7_header', $array[3][8]); // value (98)
    /* -40C (1201-2500) */
    update_option('4_row_7_header', $array[4][8]); // value (95)
    /* -40C (2501-5001) */
    update_option('5_row_7_header', $array[5][8]); // value (по звонку)
    /* -40C (?) */
    update_option('6_row_7_header', $array[6][8]); // value (?)
    /* -40C (?) */
    update_option('7_row_7_header', $array[7][8]); // value (?)
    /* -40C (?) */
    update_option('8_row_7_header', $array[8][8]); // value (?)
    /* -40C (?) */
    update_option('9_row_7_header', $array[9][8]); // value (?)
    /* -40C (?) */
    update_option('10_row_7_header', $array[10][8]); // value (?)

    echo get_option('five_row_five_header');


//    echo "<hr>";
//    var_dump($array[0][5] . ' ' . $array[1][0] . ' - ' . $array[1][1]);
//    var_dump($array[1][0 + 5]);
//    var_dump($array[0][5] . ' ' . $array[2][0] . ' - ' . $array[2][1]);
//    var_dump($array[2][0 + 5]);
//    var_dump($array[0][5] . ' ' . $array[3][0] . ' - ' . $array[3][1]);
//    var_dump($array[3][0 + 5]);
//    var_dump($array[0][5] . ' ' . $array[4][0] . ' - ' . $array[4][1]);
//    var_dump($array[4][0 + 5]);
//    var_dump($array[0][5] . ' ' . $array[5][0] . ' - ' . $array[5][1]);
//    var_dump($array[5][0 + 4]);
//    echo "</pre>";

    // update_option();
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
        table{
            table-layout: fixed !important;
            font-size: 0.7em !important;
            font-family: sans-serif !important;
        }
    </style>

<?