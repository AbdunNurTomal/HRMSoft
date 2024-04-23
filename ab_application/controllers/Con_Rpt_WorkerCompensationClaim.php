<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Rpt_WorkerCompensationClaim extends CI_Controller {

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
    }

    public function index($menu_id, $show_result = FALSE, $search_ids = array(), $search_criteria = array('emp_id' => '', 'action_from' => '', 'action_to' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
         $extra_sql = "";
        if ($this->user_group == 11 || $this->user_group == 12) {
            $extra_sql = "AND company_id={$this->company_id}";
        }
        $inc_sql = "SELECT employee_id, first_name, middle_name, last_name FROM main_employees WHERE employee_id IN (SELECT DISTINCT(`employee_id`) FROM main_emp_actions WHERE `action_type`=1 {$extra_sql}) ORDER BY `employee_id` DESC";
        $param['emp_list'] = $this->db->query($inc_sql);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "WORKERS COMPENSATION CLAIM";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Rpt_WorkerCompensationClame.php';
        $this->load->view('admin/home', $param);
    }
    
    //get_WorkerCompensationClaim_data
    public function get_WorkerCompensationClaim_data() {

        $ids = $search_criteria = array();

        $search_criteria['emp_id'] = $emp_id = $this->input->post('emp_name');
        //$search_criteria['action_type'] = $action_type = $this->input->post('action_type');
        $search_criteria['action_from'] = $action_from = $this->input->post('action_from');
        $search_criteria['action_to'] = $action_to = $this->input->post('action_to');

        if (($emp_id != '') || ($action_from != '') || ($action_to != '')) {

            $this->db->select('id');
            /* ----Conditions---- */
            if ($emp_id != '') {
                $this->db->where('employee_id', $emp_id);
            }
//            if ($action_type != '') {
//                $this->db->where('action_type', $action_type);
//            }
            if ($action_from != '') {
                $this->db->where('action_date >=', $this->Common_model->convert_to_mysql_date($action_from));
            }
            if ($action_to != '') {
                $this->db->where('action_date <=', $this->Common_model->convert_to_mysql_date($action_to));
            }

            $this->db->where('action_type', 2);
            $ids = $this->db->get('main_emp_actions')->result_array();
        }

        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
    }

}
