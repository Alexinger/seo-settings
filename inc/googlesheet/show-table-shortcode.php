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

    $start = '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;white-space: pre-wrap !important;vertical-align: middle;line-height: 0.7rem !important;}</style>'.
        '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>' .
        '<table class="table table-bordered table-hover table-my-style" style="background-color: ' . $atts['table_bg'] . '">
           <thead style="color: ' . $atts['table_color_value'] . '">
            <tr>';
    for ($i = 0; $i < 16; $i++) {
        if (isset($array[0][$i]) && $array[0][$i] != '') {
            $start .= '<th class="my-table-th">' . $array[0][$i] . '</th>';
        }
    }
    $start .= '</tr></thead>';

    for ($s = 1; $s < 16; $s++) {
        if (isset($array[$s][0]) && $array[$s][0] != '') {
            ${'tr' . $s} .= '<tr>';
            for ($i = 0; $i < 16; $i++) {
                if (isset($array[$s][$i]) && $array[$s][$i] != '') {
                    ${'tr' . $s} .= '<td class="my-table">' . $array[$s][$i] . '</td>';
                }
            }
            ${'tr' . $s} .= '</tr>';
        }
    }
    $end = '</table>';

    return $start . $tr1 . $tr2 . $tr3 . $tr4 . $tr5 . $tr6 . $tr7 . $tr8 . $tr9 . $tr10 . $tr11 . $tr12 . $tr13 . $tr14 . $tr15 . $end;
}

add_shortcode("google_sheet_canister", "get_google_sheet_canister");
function get_google_sheet_canister($atts = null)
{
    $atts = shortcode_atts([
        'title' => 'Прайс лист канистр',
        'title_color' => '#a5bf8f',
        'table_bg' => 'white',
        'table_color_value' => 'black',
    ], $atts);

    $gid = get_option("tabs-shortcode-url");
    $id = get_option("tabs-shortcode-page");
    $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
    $csv = explode("\r\n", $csv);
    $array = array_map('str_getcsv', $csv);

    $updateCanister = new UpdatePrice();
    $updateCanister->update_get_option_canister();

    $tr21 = $tr22 = $tr23 = $tr24 = $tr25 = $tr26 = $tr27 = $tr28 = $tr29 = $tr30 = $tr31 = $tr32 = $tr33 = $tr34 = $tr35 = null;

    $start = '<style>th.my-table { color: ' . $atts['table_color_value'] . ' !important;white-space: pre-wrap !important;vertical-align: middle;line-height: 0.7rem !important;}</style>' .
        '<h3 style="margin-bottom: 20px; text-align: center;color: ' . $atts['title_color'] . ';">' . $atts['title'] . '</h3>' .
        '<table class="table table-bordered table-hover table-my-style" style="background-color: ' . $atts['table_bg'] . '">
           <thead style="color: ' . $atts['table_color_value'] . '">
            <tr>';
    for ($i = 0; $i < 10; $i++) {
        if (isset($array[20][$i]) && $array[20][$i] !== '') {
            $start .= '<th class="my-table-th">' . $array[20][$i] . '</th>';
        }
    }
    $start .= '</tr></thead>';

    for ($s = 21; $s < 35; $s++) {

        ${'tr' . $s} .= '<tr>';
        for ($i = 0; $i < 8; $i++) {
            if (isset($array[$s][$i]) && $array[$s][$i] != '') {
                ${'tr' . $s} .= '<td class="my-table" style="white-space: pre-wrap !important;line-height: 0.9rem !important;vertical-align: bottom;">' . $array[$s][$i] . '</td>';
            }
        }
        ${'tr' . $s} .= '</tr>';
    }
    $end = '</table>';

    return $start . $tr21 . $tr22 . $tr23 . $tr24 . $tr25 . $tr26 . $tr27 . $tr28 . $tr29 . $tr30 . $tr31 . $tr32 . $tr33 . $tr34 . $tr35 . $end;
}
