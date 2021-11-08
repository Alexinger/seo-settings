<?php

class UpdatePrice
{
    public function update_get_option()
    {
        $gid = get_option("tabs-shortcode-url");
        $id = get_option("tabs-shortcode-page");
        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
        $csv = explode("\r\n", $csv);
        $array = array_map('str_getcsv', $csv);

        /* All row item water - NEW */
        for ($row = 1; $row < 10; $row++) {
            /*[50] [151] [751] [1201] [2501] [?] [?] [?] [?] [?]*/
            if(isset($array[$row][0]) && $array[$row][0] !== ''){
                update_option($row . '_row_left', $array[$row][0]);
            }
        }

        /* All column item temperature - (const) NEW */
        for ($header = 1; $header < 15; $header++) {
            // [-10] [-15] [-20] [-25] [-35] [-35] [-40] [?] [?] [?]
            if(isset($array[0][$header])){
                update_option($header . '_header', substr(isset($array[0][$header]), 1, 2));
            }
        }

        /* -10C -15C -20C -25C -30C -35C -40C -45C -50C -55C (50-150) */
        for ($s = 0; $s < 15; $s++) {
            for ($i = 0; $i < 15; $i++) {
                if(isset($array[$i][$s+1])){
                    update_option($i . '_row_' . $s . '_header', $array[$i][$s + 1]);
                }
            }
        }
    }
    public function update_get_option_canister()
    {
        $gid = get_option("tabs-shortcode-url");
        $id = get_option("tabs-shortcode-page");
        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
        $csv = explode("\r\n", $csv);
        $array = array_map('str_getcsv', $csv);

        /* All row item water - NEW */
        for ($row = 21; $row < 35; $row++) {
            /*[50] [151] [751] [1201] [2501] [?] [?] [?] [?] [?]*/
            if(isset($array[$row][0])){
                update_option($row . '_rows_lefts', $array[$row][0]);
            }
        }

        /* All column item temperature - (const) NEW */
        for ($header = 0; $header < 10; $header++) {
            // [-10] [-15] [-20] [-25] [-35] [-35] [-40] [?] [?] [?]
            if(isset($array[20][$header])){
                $str_c = strpos($array[20][$header], '(');
                update_option($header . '_headers', substr($array[20][$header], $str_c+1, 4));
            }
        }

        /* -10C -15C -20C -25C -30C -35C -40C -45C -50C -55C (50-150) */
        for ($s = 0; $s < 30; $s++) {
            for ($i = 20; $i < 30; $i++) {
                if(isset($array[$i][$s+1])){
                    update_option($i . '_rows_' . $s . '_headers', $array[$i][$s]);
                }
            }
        }


    }
}
