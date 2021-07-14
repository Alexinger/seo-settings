<?php

class UpdatePrice
{
    public static function update_get_option()
    {
        $gid = get_option("tabs-shortcode-url");
        $id = get_option("tabs-shortcode-page");
        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $gid . '/export?format=csv&gid=' . $id);
        $csv = explode("\r\n", $csv);
        $array = array_map('str_getcsv', $csv);

        /* All row item water - NEW */
        for ($row = 1; $row < 10; $row++) {
            // [50] [151] [751] [1201] [2501] [?] [?] [?] [?] [?]
            update_option($row . '_row_left', $array[$row][0]);
        }

        /* All column item temperature - (const) NEW */
        for ($header = 1; $header < 10; $header++) {
            // [-10] [-15] [-20] [-25] [-35] [-35] [-40] [?] [?] [?]
            update_option(${$header . '_header'}, substr(isset($array[0][$header]), 1, 2));
        }

        /* All column item temperature - (const) (-10, -15, -20, -25, -30, -35, -40) */
        for ($temperature = 1; $temperature < 8; $temperature++) {
            add_option($temperature . '_header', substr($array[0][$temperature + 1], 1, 2));
        }
        /* All variables volume and temperature*/
        for ($count = 0; $count < 7; $count++) {
            for ($volume = 0; $volume < 11; $volume++) {
                add_option($volume . '_row_' . $count . '_header', $array[$volume][$count + 1]);
            }
        }
        /* -10C -15C -20C -25C -30C -35C -40C -45C -50C -55C (50-150) */
        for ($s = 0; $s < 10; $s++) {
            for ($i = 0; $i < 10; $i++) {
                update_option($i . '_row_' . $s . '_header', $array[$i][$s + 1]);
            }
        }
    }
}
