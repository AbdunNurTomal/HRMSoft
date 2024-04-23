<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Rpt_I_9 extends CI_Controller {

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

    public function index($menu_id, $show_result = FALSE, $search_ids = array(), $search_criteria = array('emp_id' => '' )) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "I-9";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Rpt_I_9.php';
        $this->load->view('admin/home', $param);
    }
    
    public function action_filter() {
        
        $ids = $search_criteria = array();

        $search_criteria['emp_id'] = $emp_id = $this->input->post('employee_id');
        //$search_criteria['incident_from'] = $incident_from = $this->input->post('incident_from');
        //$search_criteria['incident_to'] = $incident_to = $this->input->post('incident_to');

        //if (($emp_id != '') || ($incident_from != '') || ($incident_to != '')) {
        if ($emp_id != '') {
            $this->db->select('id');
            /* ----Conditions---- */
            if ($emp_id != '') {
                $this->db->where('onboarding_employee_id', $emp_id);
            }
//            if ($incident_from != '') {
//                $this->db->where('action_date >=', $this->Common_model->convert_to_mysql_date($incident_from));
//            }
//            if ($incident_to != '') {
//                $this->db->where('action_date <=', $this->Common_model->convert_to_mysql_date($incident_to));
//            }

            $this->db->where('isactive', 1);
            $ids = $this->db->get('main_ob_i9')->result_array();
        }

        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
        
    }

}
