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
        update_option('1_row_left', $array[1][0]); // 50
        update_option('1_row_right', $array[1][1]); // 151

        update_option('2_row_left', $array[2][0]); // 151
        update_option('2_row_right', $array[2][1]); // 750

        update_option('3_row_left', $array[3][0]); // 751
        update_option('3_row_right', $array[3][1]); // 1200

        update_option('4_row_left', $array[4][0]); // 1201
        update_option('4_row_right', $array[4][1]); // 2500

        update_option('5_row_left', $array[5][0]); // 2501
        update_option('5_row_right', $array[5][1]); // 5000

        update_option('6_row_left', $array[6][0]); // ?
        update_option('6_row_right', $array[6][1]); // ?

        update_option('7_row_left', $array[7][0]); // ?
        update_option('7_row_right', $array[7][1]); // ?

        update_option('8_row_left', $array[8][0]); // ?
        update_option('8_row_right', $array[8][1]); // ?

        update_option('9_row_left', $array[9][0]); // ?
        update_option('9_row_right', $array[9][1]); // ?

        update_option('10_row_left', $array[10][0]); // ?
        update_option('10_row_right', $array[10][1]); // ?

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
            add_option($temperature . '_header', substr($array[0][$temperature + 1], 1, 2));
        }
        /* All variables volume and temperature*/
        for ($count = 1; $count < 7; $count++) {
            for ($volume = 1; $volume < 11; $volume++) {
                add_option($volume . '_row_' . $count . '_header', $array[$volume][$count + 1]);
            }
        }


        /* All temperature -10 NEW */
        /* -10C (50-150) */
        if(isset($array[1][2])){
            update_option('1_row_1_header', $array[1][2]); // value (-)
        }
        /* -10C (151-750) */
        if(isset($array[2][2])) {
            update_option('2_row_1_header', $array[2][2]); // value (-)
        }
        /* -10C (751-1200) */
        if(isset($array[3][2])) {
            update_option('3_row_1_header', $array[3][2]); // value (-)
        }
        /* -10C (1201-2500) */
        if(isset($array[4][2])) {
            update_option('4_row_1_header', $array[4][2]); // value (-)
        }
        /* -10C (2501-5001) */
        if(isset($array[5][2])) {
            update_option('5_row_1_header', $array[5][2]); // value (-)
        }
        /* -10C (?) */
        if(isset($array[6][2])) {
            update_option('6_row_1_header', $array[6][2]); // value (?)
        }
        /* -10C (?) */
        if(isset($array[7][2])) {
            update_option('7_row_1_header', $array[7][2]); // value (?)
        }
        /* -10C (?) */
        if(isset($array[8][2])) {
            update_option('8_row_1_header', $array[8][2]); // value (?)
        }
        /* -10C (?) */
        if(isset($array[9][2])) {
            update_option('9_row_1_header', $array[9][2]); // value (?)
        }
        /* -10C (?) */
        if(isset($array[10][2])) {
            update_option('10_row_1_header', $array[10][2]); // value (?)
        }


        /* All temperature -15 NEW */
        /* -15C (50-150) */
        if(isset($array[1][3])) {
            update_option('1_row_2_header', $array[1][3]); // value (-)
        }
        /* -15C (151-750) */
        if(isset($array[2][3])) {
            update_option('2_row_2_header', $array[2][3]); // value (-)
        }
        /* -15C (751-1200) */
        if(isset($array[3][3])) {
            update_option('3_row_2_header', $array[3][3]); // value (-)
        }
        /* -15C (1201-2500) */
        if(isset($array[4][3])) {
            update_option('4_row_2_header', $array[4][3]); // value (-)
        }
        /* -15C (2501-5001) */
        if(isset($array[5][3])) {
            update_option('5_row_2_header', $array[5][3]); // value (-)
        }
        /* -15C (?) */
        if(isset($array[6][3])) {
            update_option('6_row_2_header', $array[6][3]); // value (?)
        }
        /* -15C (?) */
        if(isset($array[7][3])) {
            update_option('7_row_2_header', $array[7][3]); // value (?)
        }
        /* -15C (?) */
        if(isset($array[8][3])) {
            update_option('8_row_2_header', $array[8][3]); // value (?)
        }
        /* -15C (?) */
        if(isset($array[9][3])) {
            update_option('9_row_2_header', $array[9][3]); // value (?)
        }
        /* -15C (?) */
        if(isset($array[10][3])) {
            update_option('10_row_2_header', $array[10][3]); // value (?)
        }

        /* All temperature -20 NEW */
        /* -20C (50-150) */
        if(isset($array[1][4])) {
            update_option('1_row_3_header', $array[1][4]); // value (80)
        }
        /* -20C (151-750) */
        if(isset($array[2][4])) {
            update_option('2_row_3_header', $array[2][4]); // value (75)
        }
        /* -20C (751-1200) */
        if(isset($array[3][4])) {
            update_option('3_row_3_header', $array[3][4]); // value (69)
        }
        /* -20C (1201-2500) */
        if(isset($array[4][4])) {
            update_option('4_row_3_header', $array[4][4]); // value (67)
        }
        /* -20C (2501-5001) */
        if(isset($array[5][4])) {
            update_option('5_row_3_header', $array[5][4]); // value (по звонку)
        }
        /* -20C (?) */
        if(isset($array[6][4])) {
            update_option('6_row_3_header', $array[6][4]); // value (?)
        }
        /* -20C (?) */
        if(isset($array[7][4])) {
            update_option('7_row_3_header', $array[7][4]); // value (?)
        }
        /* -20C (?) */
        if(isset($array[8][4])) {
            update_option('8_row_3_header', $array[8][4]); // value (?)
        }
        /* -20C (?) */
        if(isset($array[9][4])) {
            update_option('9_row_3_header', $array[9][4]); // value (?)
        }
        /* -20C (?) */
        if(isset($array[10][4])) {
            update_option('10_row_3_header', $array[10][4]); // value (?)
        }

        /* All temperature -25 NEW */
        /* -25C (50-150) */
        if(isset($array[1][5])) {
            update_option('1_row_4_header', $array[1][5]); // value (85)
        }
        /* -25C (151-750) */
        if(isset($array[2][5])) {
            update_option('2_row_4_header', $array[2][5]); // value (82)
        }
        /* -25C (751-1200) */
        if(isset($array[3][5])) {
            update_option('3_row_4_header', $array[3][5]); // value (74)
        }
        /* -25C (1201-2500) */
        if(isset($array[4][5])) {
            update_option('4_row_4_header', $array[4][5]); // value (72)
        }
        /* -25C (2501-5001) */
        if(isset($array[5][5])) {
            update_option('5_row_4_header', $array[5][5]); // value (по звонку)
        }
        /* -25C (?) */
        if(isset($array[6][5])) {
            update_option('6_row_4_header', $array[6][5]); // value (?)
        }
        /* -25C (?) */
        if(isset($array[7][5])) {
            update_option('7_row_4_header', $array[7][5]); // value (?)
        }
        /* -25C (?) */
        if(isset($array[8][5])) {
            update_option('8_row_4_header', $array[8][5]); // value (?)
        }
        /* -25C (?) */
        if(isset($array[9][5])) {
            update_option('9_row_4_header', $array[9][5]); // value (?)
        }
        /* -25C (?) */
        if(isset($array[10][5])) {
            update_option('10_row_4_header', $array[10][5]); // value (?)
        }

        /* All temperature -30 NEW */
        /* -30C (50-150) */
        if(isset($array[1][6])) {
            update_option('1_row_5_header', $array[1][6]); // value (88)
        }
        /* -30C (151-750) */
        if(isset($array[2][6])) {
            update_option('2_row_5_header', $array[2][6]); // value (85)
        }
        /* -30C (751-1200) */
        if(isset($array[3][6])) {
            update_option('3_row_5_header', $array[3][6]); // value (80)
        }
        /* -30C (1201-2500) */
        if(isset($array[4][6])) {
            update_option('4_row_5_header', $array[4][6]); // value (78)
        }
        /* -30C (2501-5001) */
        if(isset($array[5][6])) {
            update_option('5_row_5_header', $array[5][6]); // value (по звонку)
        }
        /* -30C (?) */
        if(isset($array[6][6])) {
            update_option('6_row_5_header', $array[6][6]); // value (?)
        }
        /* -30C (?) */
        if(isset($array[7][6])) {
            update_option('7_row_5_header', $array[7][6]); // value (?)
        }
        /* -30C (?) */
        if(isset($array[8][6])) {
            update_option('8_row_5_header', $array[8][6]); // value (?)
        }
        /* -30C (?) */
        if(isset($array[9][6])) {
            update_option('9_row_5_header', $array[9][6]); // value (?)
        }
        /* -30C (?) */
        if(isset($array[10][6])) {
            update_option('10_row_5_header', $array[10][6]); // value (?)
        }

        /* All temperature -35 NEW */
        /* -35C (50-150) */
        if(isset($array[1][7])) {
            update_option('1_row_6_header', $array[1][7]); // value (98)
        }
        /* -35C (151-750) */
        if(isset($array[2][7])) {
            update_option('2_row_6_header', $array[2][7]); // value (95)
        }
        /* -35C (751-1200) */
        if(isset($array[3][7])) {
            update_option('3_row_6_header', $array[3][7]); // value (94)
        }
        /* -35C (1201-2500) */
        if(isset($array[4][7])) {
            update_option('4_row_6_header', $array[4][7]); // value (92)
        }
        /* -35C (2501-5001) */
        if(isset($array[5][7])) {
            update_option('5_row_6_header', $array[5][7]); // value (по звонку)
        }
        /* -35C (?) */
        if(isset($array[6][7])) {
            update_option('6_row_6_header', $array[6][7]); // value (?)
        }
        /* -35C (?) */
        if(isset($array[7][7])) {
            update_option('7_row_6_header', $array[7][7]); // value (?)
        }
        /* -35C (?) */
        if(isset($array[8][7])) {
            update_option('8_row_6_header', $array[8][7]); // value (?)
        }
        /* -35C (?) */
        if(isset($array[9][7])) {
            update_option('9_row_6_header', $array[9][7]); // value (?)
        }
        /* -35C (?) */
        if(isset($array[10][7])) {
            update_option('10_row_6_header', $array[10][7]); // value (?)
        }

        /* All temperature -40 NEW */
        /* -40C (50-150) */
        if($array[1][8]) {
            update_option('1_row_7_header', $array[1][8]); // value (105)
            // var_dump($array[1][8]);
        }
        /* -40C (151-750) */
        if($array[2][8]) {
            update_option('2_row_7_header', $array[2][8]); // value (100)
        }
        /* -40C (751-1200) */
        if(isset($array[3][8])) {
            update_option('3_row_7_header', $array[3][8]); // value (98)
        }
        /* -40C (1201-2500) */
        if(isset($array[4][8])) {
            update_option('4_row_7_header', $array[4][8]); // value (95)
        }
        /* -40C (2501-5001) */
        if(isset($array[5][8])) {
            update_option('5_row_7_header', $array[5][8]); // value (по звонку)
        }
        /* -40C (?) */
        if(isset($array[6][8])) {
            update_option('6_row_7_header', $array[6][8]); // value (?)
        }
        /* -40C (?) */
        if(isset($array[7][8])) {
            update_option('7_row_7_header', $array[7][8]); // value (?)
        }
        /* -40C (?) */
        if(isset($array[8][8])) {
            update_option('8_row_7_header', $array[8][8]); // value (?)
        }
        /* -40C (?) */
        if(isset($array[9][8])) {
            update_option('9_row_7_header', $array[9][8]); // value (?)
        }
        /* -40C (?) */
        if(isset($array[10][8])) {
            update_option('10_row_7_header', $array[10][8]); // value (?)
        }

    }
}
