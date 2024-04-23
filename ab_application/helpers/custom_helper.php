<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Just a Custom Helper
 * @package	CodeIgniter <root> | system | helpers
 * 
 * @author	Mahmud Hassan
 */
// ------------------------------------------------------------------------

if (!function_exists('pr')) {

    /**
     * Function: pr()
     *
     * Just prints content in the array
     */
    function pr($arr = array(), $flag = 0) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        if ($flag != 0) {
            die("==============ARRAY PRINT==============");
        }
    }

}


if (!function_exists('date_diff_calculate')) {

    /**
     * Function: age_calculate()
     *
     * Calculates Age from Date of Birth
     */
    function date_diff_calculate($from = '1801-01-01', $to = 'today') {
        return date_diff(date_create($from), date_create($to));
    }

}

if (!function_exists('addOrdinalNumberSuffix')) {

    /**
     * Function: dateFormatConvert()
     *
     * Changes given date format to `MySql` date format
     */
    function addOrdinalNumberSuffix($num) {
        if (!in_array(($num % 100), array(11, 12, 13))) {
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1: return $num . 'st';
                case 2: return $num . 'nd';
                case 3: return $num . 'rd';
            }
        }
        return $num . 'th';
    }

}



if (!function_exists('Get_File_Directory')) {

    /**
     * Function: Get_File_Directory()
     *
     * Generates the Server Directory path of the given File Path.
     */
    function Get_File_Directory($PATH) {
        $ROOT_DIR = str_replace(basename($_SERVER['SCRIPT_FILENAME']), "", $_SERVER['SCRIPT_FILENAME']);
        return $ROOT_DIR . $PATH;
    }

}

if (!function_exists('date_from_timestamp')) {

    /**
     * Function: date_from_timestamp()
     *
     * Retrieves only date from given Timestamp
     * DEFAULT FORMAT: `01-JAN-2017`
     */
    function date_from_timestamp($timestamp, $date_format = '') {

        $FORMAT = 'd-M-Y';
        if ($date_format != '') {
            $FORMAT = $date_format;
        }
        return date($FORMAT, strtotime($timestamp));
    }

}


if (!function_exists('number_to_words')) {

    /**
     * Function: number_to_words()
     *
     * Simply Converts `Number` to `Word`
     */
    function number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}

// show tables from code_hrm

if (!function_exists('Clear_Database')) {

    /**
     * Function: Clear_Database()
     *
     * Only for Developer use. **Do not Alter it`s definition!!
     */
    function Clear_Database($CI, $security_code = "") {
        //password : DBdestroy2017
        $salt_key = "aa367fed93dc5a63c3802a66eb47b104fe6a2f6c";
        $DB_name = "us_hrm"; // $CI->db->database;

        $excluded = array(
            /* List of Table(s) NOT to TRUNCATE */
            'main_users',
            'main_usergroup',
            'main_roles_privileges',
            'main_module',
            'main_menu',
            'main_state',
            'tbl_employmentstatus'
        );

        if ($security_code != "") {
            if ($salt_key == sha1($security_code)) {
                $res = $CI->db->query("SHOW TABLES FROM " . $DB_name)->result();
                foreach ($res as $row) {
                    $table_name = $row->Tables_in_us_hrm;
                    if (!in_array($table_name, $excluded)) {
                        $CI->db->query("TRUNCATE " . $DB_name . '.' . $table_name);
                    }
                }
            }
        }
        redirect('Chome/logout');
    }

}

if (!function_exists('customize_name')) {

    /**
     * Function: Clear_Database()
     *
     * Converts format from "given_name" --> "Given Name"
     */
    function customize_name($subject) {
        $var = str_replace('_', ' ', $subject);
        $var = ucwords($var);
        return trim($var);
    }

}

if (!function_exists('get_sub_users')) {

    /**
     * Function: get_sub_users()
     *
     * Retrieve All `Sub user(s)` under provided `Parent user` from database by `User Id`
     */
    function get_sub_users($user_id) {
        $CI = & get_instance();

        $CI->db->select('id');
        $res1 = $CI->db->get_where('main_users', array('parent_user' => $user_id))->result_array();

        $result1 = array_column($res1, 'id');
        $result1[] = $user_id;

        $CI->db->where_in('parent_user', $result1);
        $res2 = $CI->db->get('main_users')->result_array();

        $result2 = array_column($res2, 'id');
        $result2[] = $user_id;

        if (!empty($result2)) {
            return implode(', ', $result2);
        } else {
            return -1;
        }
    }

}

if ( ! function_exists('force_ssl'))
{
    function force_ssl()
    {
		$CI =& get_instance();
        if ( ! $CI->input->server('HTTPS'))
        {
			$CI->config->config['base_url'] = $CI->config->config['base_url_absolute_ssl'];
			redirect($CI->uri->uri_string());
        }
    }
}
 
if ( ! function_exists('remove_ssl'))
{
	function remove_ssl()
	{
		$CI =& get_instance();
        if ($CI->input->server('HTTPS'))
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = $CI->config->config['base_url_absolute'];
			redirect($CI->uri->uri_string());
        }
	}
}