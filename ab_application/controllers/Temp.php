<?php

class Temp extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    public $module_data = array();
    public $module_id = null;

    function __construct() {
        parent::__construct();
        // Constructor Code Here....
    }

    function ind______ex() {
        $DB_name = "us_hrm";

        $res = $this->db->query("SHOW TABLES FROM " . $DB_name)->result();
        foreach ($res as $row) {
            $table_name = $row->Tables_in_us_hrm;

            echo '=>> ' . $table_name . '<br/>';

            //$this->db->query("alter table " . $table_name . " convert to character set utf8 collate utf8_general_ci");
        }
    }

    function index() {

        $file = fopen(Get_File_Directory('test/mahmud/temp_data.txt'), "r");
        $Data_Arr = array();

        $i = 0;
        while (!feof($file)) {
            $string = trim(fgets($file));

//            echo "<br/> ==>>> ".$string;
//            $ARR = explode('@', $string);
//            pr($ARR);

            $Data_Arr[$i]['leave_code'] = trim($string);

//            $Data_Arr[$i]['job_title'] = trim($ARR[0]);
//            $Data_Arr[$i]['job_family'] = trim($ARR[1]);
            $i++;
        }
        pr($Data_Arr);

//        $this->db->insert_batch('sample_employeeleavetypes', $Data_Arr);
    }

}

/*END OF FILE*/
