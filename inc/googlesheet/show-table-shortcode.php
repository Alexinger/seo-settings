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

    $start = '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;}</style>' .
        '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>' .
        '<table class="table table-bordered table-hover table-my-style" style="background-color: ' . $atts['table_bg'] . '">
           <thead style="color: ' . $atts['table_color_value'] . '">
            <tr>
                <td class="my-table">' . $array[0][0] . '</td>
                <td class="my-table">' . $array[0][1] . '</td>
                <td class="my-table">' . $array[0][2] . '</td>
                <td class="my-table">' . $array[0][3] . '</td>
                <td class="my-table">' . $array[0][4] . '</td>
                <td class="my-table">' . $array[0][5] . '</td>
                <td class="my-table">' . $array[0][6] . '</td>
                <td class="my-table">' . $array[0][7] . '</td>
                <td class="my-table">' . $array[0][8] . '</td>
            </tr>
           </thead>';

    if ($array[1][0]) {
        $tr1 = '<tr>
                  <td class="my-table">' . $array[1][0] . '</td>
                  <td class="my-table">' . $array[1][1] . '</td>
                  <td class="my-table">' . $array[1][2] . '</td>
                  <td class="my-table">' . $array[1][3] . '</td>
                  <td class="my-table">' . $array[1][4] . '</td>
                  <td class="my-table">' . $array[1][5] . '</td>
                  <td class="my-table">' . $array[1][6] . '</td>
                  <td class="my-table">' . $array[1][7] . '</td>
                  <td class="my-table">' . $array[1][8] . '</td>
                </tr>';
    }

    if ($array[2][0]) {
        $tr2 = '<tr>
                 <td class="my-table">' . $array[2][0] . '</td>
                 <td class="my-table">' . $array[2][1] . '</td>
                 <td class="my-table">' . $array[2][2] . '</td>
                 <td class="my-table">' . $array[2][3] . '</td>
                 <td class="my-table">' . $array[2][4] . '</td>
                 <td class="my-table">' . $array[2][5] . '</td>
                 <td class="my-table">' . $array[2][6] . '</td>
                 <td class="my-table">' . $array[2][7] . '</td>
                 <td class="my-table">' . $array[2][8] . '</td>
               </tr>';
    }

    if ($array[3][0]) {
        $tr3 = '<tr>
                 <td class="my-table">' . $array[3][0] . '</td>
                 <td class="my-table">' . $array[3][1] . '</td>
                 <td class="my-table">' . $array[3][2] . '</td>
                 <td class="my-table">' . $array[3][3] . '</td>
                 <td class="my-table">' . $array[3][4] . '</td>
                 <td class="my-table">' . $array[3][5] . '</td>
                 <td class="my-table">' . $array[3][6] . '</td>
                 <td class="my-table">' . $array[3][7] . '</td>
                 <td class="my-table">' . $array[3][8] . '</td>
                </tr>';
    }

    if ($array[4][0]) {
        $tr4 = '<tr>
                 <td class="my-table">' . $array[4][0] . '</td>
                 <td class="my-table">' . $array[4][1] . '</td>
                 <td class="my-table">' . $array[4][2] . '</td>
                 <td class="my-table">' . $array[4][3] . '</td>
                 <td class="my-table">' . $array[4][4] . '</td>
                 <td class="my-table">' . $array[4][5] . '</td>
                 <td class="my-table">' . $array[4][6] . '</td>
                 <td class="my-table">' . $array[4][7] . '</td>
                 <td class="my-table">' . $array[4][8] . '</td>
                </tr>';
    }
    if ($array[5][0]) {
        $tr5 = '<tr>
                 <td class="my-table">' . $array[5][0] . '</td>
                 <td class="my-table">' . $array[5][1] . '</td>
                 <td class="my-table">' . $array[5][2] . '</td>
                 <td class="my-table">' . $array[5][3] . '</td>
                 <td class="my-table">' . $array[5][4] . '</td>
                 <td class="my-table">' . $array[5][5] . '</td>
                 <td class="my-table">' . $array[5][6] . '</td>
                 <td class="my-table">' . $array[5][7] . '</td>
                 <td class="my-table">' . $array[5][8] . '</td>
                </tr>';
    }
    if ($array[6][0]) {
        $tr6 = '<tr>
                 <td class="my-table">' . $array[6][0] . '</td>
                 <td class="my-table">' . $array[6][1] . '</td>
                 <td class="my-table">' . $array[6][2] . '</td>
                 <td class="my-table">' . $array[6][3] . '</td>
                 <td class="my-table">' . $array[6][4] . '</td>
                 <td class="my-table">' . $array[6][5] . '</td>
                 <td class="my-table">' . $array[6][6] . '</td>
                 <td class="my-table">' . $array[6][7] . '</td>
                 <td class="my-table">' . $array[6][8] . '</td>
                </tr>';
    }
    if ($array[7][0]) {
        $tr7 = '<tr>
                 <td class="my-table">' . $array[7][0] . '</td>
                 <td class="my-table">' . $array[7][1] . '</td>
                 <td class="my-table">' . $array[7][2] . '</td>
                 <td class="my-table">' . $array[7][3] . '</td>
                 <td class="my-table">' . $array[7][4] . '</td>
                 <td class="my-table">' . $array[7][5] . '</td>
                 <td class="my-table">' . $array[7][6] . '</td>
                 <td class="my-table">' . $array[7][7] . '</td>
                 <td class="my-table">' . $array[7][8] . '</td>
                </tr>';
    }
    if ($array[8][0]) {
        $tr8 = '<tr>
                 <td class="my-table">' . $array[8][0] . '</td>
                 <td class="my-table">' . $array[8][1] . '</td>
                 <td class="my-table">' . $array[8][2] . '</td>
                 <td class="my-table">' . $array[8][3] . '</td>
                 <td class="my-table">' . $array[8][4] . '</td>
                 <td class="my-table">' . $array[8][5] . '</td>
                 <td class="my-table">' . $array[8][6] . '</td>
                 <td class="my-table">' . $array[8][7] . '</td>
                 <td class="my-table">' . $array[8][8] . '</td>
                </tr>';
    }
    if ($array[9][0]) {
        $tr9 = '<tr>
                 <td class="my-table">' . $array[9][0] . '</td>
                 <td class="my-table">' . $array[9][1] . '</td>
                 <td class="my-table">' . $array[9][2] . '</td>
                 <td class="my-table">' . $array[9][3] . '</td>
                 <td class="my-table">' . $array[9][4] . '</td>
                 <td class="my-table">' . $array[9][5] . '</td>
                 <td class="my-table">' . $array[9][6] . '</td>
                 <td class="my-table">' . $array[9][7] . '</td>
                 <td class="my-table">' . $array[9][8] . '</td>
                </tr>';
    }
    if ($array[10][0]) {
        $tr10 = '<tr>
                 <td class="my-table">' . $array[10][0] . '</td>
                 <td class="my-table">' . $array[10][1] . '</td>
                 <td class="my-table">' . $array[10][2] . '</td>
                 <td class="my-table">' . $array[10][3] . '</td>
                 <td class="my-table">' . $array[10][4] . '</td>
                 <td class="my-table">' . $array[10][5] . '</td>
                 <td class="my-table">' . $array[10][6] . '</td>
                 <td class="my-table">' . $array[10][7] . '</td>
                 <td class="my-table">' . $array[10][8] . '</td>
                </tr>';
    }
    $end = '</table>';

    return $start . $tr1 . $tr2 . $tr3 . $tr4 . $tr5 . $tr6 . $tr7 . $tr8 . $tr9 . $tr10 . $end;
}
