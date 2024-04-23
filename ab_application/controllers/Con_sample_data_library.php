<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_sample_data_library extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    public $module_data = array();
    public $module_id = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
        $this->load->model('hr_appraisal_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Master Data List";
        $param['module_id'] = $this->module_id;
        $param['company_id'] = $this->company_id;

        $DB_NAME = $this->db->database;
        $param['Sample_Data_Tables'] = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $DB_NAME . "' AND TABLE_NAME LIKE 'sample\_%'");

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'company_settings/view_sampleDataLibrary.php';
        $this->load->view('admin/home', $param);
    }

    public function process_sample_data() {

        //pr($this->input->post());
        
        $this->db->trans_begin();


        $sample_tbl = array();
        if (array_key_exists('sample_table_name', $this->input->post())) {
            $sample_tbl = $this->input->post('sample_table_name'); // Capturing sample table name of complete data
        }

        if (array_key_exists('Sample_Data_Array', $this->input->post())) {
            $Smpl_arr = $this->input->post('Sample_Data_Array');
            if (!empty($Smpl_arr)) {
                foreach ($Smpl_arr as $sample_tbl_name => $record_pk) {
                    $tmp_Arr = array();
                    foreach ($record_pk as $KEY => $VAL) {
                        $tmp_Arr[] = $KEY;
                    }
                    $Smpl_arr[$sample_tbl_name] = implode(', ', $tmp_Arr);
                    $sample_tbl[] = $sample_tbl_name; // Capturing sample table name of partial data
                }
            }
        }

        $sample_tbl = array_unique($sample_tbl); // Array with Unique sample table names
//        pr($sample_tbl);
//        pr($Smpl_arr, 1);


        if (!empty($sample_tbl)) {
            $DB_NAME = $this->db->database;
            /* ---------Common Table fields to Exclude---------             
              NC: **DO NOT CHANGE THE VALUE SEQUENCE OF `$Excluded` ARRAY. */
            //$Excluded = array('company_id', 'id', 'createdby', 'modifiedby', 'createddate', 'modifieddate');
            $Excluded = array('company_id', 'createdby', 'modifiedby', 'createddate', 'modifieddate');

            $PROCESS = TRUE;

            foreach ($sample_tbl as $replica_tbl) {
                $original_tbl = str_replace("sample_", "main_", $replica_tbl);

                if (!$this->db->table_exists($original_tbl)) {
                    continue;
                }

                /* ---------------Below condition checks the current sample table name in which Array---------------- */
                $xtra_sql = '';
                if ((array_key_exists('sample_table_name', $this->input->post())) && (in_array($replica_tbl, $this->input->post('sample_table_name')))) {
                    $xtra_sql = '';
                } elseif (array_key_exists($replica_tbl, $Smpl_arr)) {
                    $xtra_sql = ' WHERE id IN ( ' . $Smpl_arr[$replica_tbl] . ' )';
                }

                $this->db->trans_start();
                $this->db->query("SET @TABLE_FIELDS := (SELECT GROUP_CONCAT( COLUMN_NAME ) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$replica_tbl}' AND TABLE_SCHEMA='{$DB_NAME}')");
                foreach ($Excluded as $Excluded_Column) {
                    $this->db->query("SET @TABLE_FIELDS := REPLACE(@TABLE_FIELDS, '{$Excluded_Column},', '')");
                }
                $this->db->query("SET @TABLE_FIELDS := REPLACE(@TABLE_FIELDS, ',isactive', '')");
                $this->db->query("SET @SQL = CONCAT( 'SELECT ', @TABLE_FIELDS, ' FROM {$replica_tbl}','{$xtra_sql}')");
                $this->db->query("PREPARE Result FROM @SQL");
                $RESULT = $this->db->query("EXECUTE Result")->result_array();
                $this->db->trans_complete();

                if (empty($RESULT)) {
                    continue;
                }

                $common_array = array(
                    'company_id' => $this->company_id,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1
                );

                foreach ($RESULT as $index => $row) {
                    
                     $this->db->where('ref_id', $row['id']);
                     $this->db->where('company_id', $this->company_id);
                     $uquery = $this->db->get($original_tbl);
//                        if ($uquery->num_rows() > 0) {
//                            return true;
//                        } else {
//                            return false;
//                        }
        
                    //if (($this->Common_model->unique_check("ref_id", $row['id'], $original_tbl) == true) && ($this->Common_model->unique_check("company_id", $this->company_id, $original_tbl) == true))
                    if ($uquery->num_rows() > 0)
                    {
                        unset($RESULT[$index]);
                        //echo $this->Common_model->show_massege(20, 2);
                        continue;
                    }
                    
                    $RESULT[$index] = array_merge($row, $common_array);
                    $RESULT[$index]['ref_id'] = $row['id'];
                    unset($RESULT[$index]['id']);
                }

                //pr($RESULT, 0);
                if($RESULT)
                {
                    $res = $this->db->insert_batch($original_tbl, $RESULT);
                    
                    if ((array_key_exists('sample_table_name', $this->input->post())) && (in_array($replica_tbl, $this->input->post('sample_table_name')))) {
                        $this->db->insert('sampledata_track', array('company_id' => $this->company_id, 'sample_table_name' => $replica_tbl));
                    }
                    
//                    if ($res) {
//                        $this->db->insert('sampledata_track', array('company_id' => $this->company_id, 'sample_table_name' => $replica_tbl));
//                    } else {
//                        $PROCESS = FALSE;
//                    }
                }
                else
                {
                    $PROCESS = FALSE;
                }
            }
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }

            if ($flag) {
                echo $this->Common_model->show_massege(19, 1);
            } else {
                echo $this->Common_model->show_massege(20, 2);
            }
        }
    }

}
