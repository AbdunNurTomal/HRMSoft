<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training_Onboard_Report extends CI_Controller {

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

    public function index($menu_id, $show_result = FALSE, $search_ids = array(), $search_criteria = array('training_status' => '','training_name' => '', 'action_from' => '', 'action_to' => '')) {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Training Onboard Report";
        $param['module_id'] = $this->module_id;
        $param['training_type_array'] = $this->Common_model->get_array('training_type');
        $param['training_status'] = $this->Common_model->get_array('training_status');
        $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Onboard_Report.php';
        $this->load->view('admin/home', $param);
    }
    
    public function get_Training_Onboard_Report() {

        $ids = $search_criteria = array();

        $search_criteria['training_status'] = $training_status = $this->input->post('training_status');
        $search_criteria['training_name'] = $training_name = $this->input->post('training_name');
        $search_criteria['action_from'] = $action_from = $this->input->post('action_from');
        $search_criteria['action_to'] = $action_to = $this->input->post('action_to');

        if (($training_status != '') || ($training_name != '') || ($action_from != '') || ($action_to != '')) {

            $this->db->select('id');
            /* ----Conditions---- */
            if ($training_status != '') {
                $this->db->where('training_status', $training_status);
            }
            if ($training_name != '') {
                $this->db->where('training_id', $training_name);
            }
            if ($action_from != '') {
                $this->db->where('issued_date >=', $this->Common_model->convert_to_mysql_date($action_from));
            }
            if ($action_to != '') {
                $this->db->where('issued_date <=', $this->Common_model->convert_to_mysql_date($action_to));
            }
            $ids = $this->db->get('main_training_status')->result_array();
        }
        //echo $this->db->last_query();
        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
    }

}
