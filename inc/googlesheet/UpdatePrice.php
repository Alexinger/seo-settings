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
        for ($h = 1; $h < 15; $h++) {
            // [-10] [-15] [-20] [-25] [-35] [-35] [-40] [?] [?] [?]
            update_option($h . '_header', substr($array[0][$h], 1, 2));
        }
        /* All column item temperature - (const) (-10, -15, -20, -25, -30, -35, -40) */
        for ($t = 1; $t < 8; $t++) {
            add_option($t . '_header', substr($array[0][$t], 1, 2));
        }
        /* All variables volume and temperature*/
        /* -10C -15C -20C -25C -30C -35C -40C -45C -50C -55C (50-150) */
        for ($s = 1; $s < 10; $s++) {
            for ($i = 1; $i < 10; $i++) {
                update_option($i . '_row_' . $s . '_header', $array[$i][$s]);
            }
        }
    }
}
