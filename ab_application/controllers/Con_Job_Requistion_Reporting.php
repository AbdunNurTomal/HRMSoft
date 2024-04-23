<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Job_Requistion_Reporting extends CI_Controller {

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
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];
        
        $this->load->model('Sendmail_model');
        
    }

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('action_from' => '','action_to' => '','requisition_id' => '','department_id' => '','position_id' => '','requisition_status' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Job Requistion Listing Reporting";
        $param['module_id']=$this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'req_status' => 1,'is_close' => 0)); //Approved
        } else {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
        }
        
        $param['department_query'] = $this->Common_model->listItem('main_department');
        $param['positions_query'] = $this->Common_model->listItem('main_positions');
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['rating_array'] = $this->Common_model->get_array('rating_array');
        $param['resume_type'] = $this->Common_model->get_array('resume_type');
        $param['priority_array'] = $this->Common_model->get_array('priority');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Job_Requistion_Reporting.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Job_Requistion_Reporting() {
        
        $ids = $search_criteria = array();

        $search_criteria['action_from'] = $action_from = $this->input->post('action_from');
        $search_criteria['action_to'] = $action_to = $this->input->post('action_to');
        $search_criteria['requisition_id'] = $requisition_id = $this->input->post('requisition_id');
        $search_criteria['department_id'] = $department_id = $this->input->post('department_id');
        $search_criteria['position_id'] = $position_id = $this->input->post('position_id');
        $search_criteria['requisition_status'] = $requisition_status = $this->input->post('requisition_status');

        if (($action_from != '') || ($action_to != '') || ($requisition_id != '') || ($department_id != '') || ($position_id != '') || ($requisition_status != '')) {
     
            $this->db->select('*');
            $this->db->from('main_opening_position');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } else {
                //$this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($action_from != '') {
                $this->db->where('requisitions_date >=', $this->Common_model->convert_to_mysql_date($action_from));
            }
            if ($action_to != '') {
                $this->db->where('requisitions_date <=', $this->Common_model->convert_to_mysql_date($action_to));
            }
            if ($requisition_id != '') {
                $this->db->where('id', $requisition_id);
            }
            if ($department_id != '') {
                $this->db->where('department_id', $department_id);
            }
            if ($position_id != '') {
                $this->db->where('position_id', $position_id);
            }
            if ($requisition_status != '') {
                $this->db->where('req_status', $requisition_status);
            }
           
            $search_data = $this->db->get()->result();
            
            //echo $this->db->last_query();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
    
    
}
