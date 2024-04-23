<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_License_Reporting extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('action_from' => '','action_to' => '','expiration_from' => '','expiration_to' => '','department_id' => '','employee_id' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Employee License Informaiton  Reporting";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['location_query']= $this->db->get_where('main_location', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['department_query']= $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['location_query']= $this->db->get_where('main_location', array('isactive' => 1));
            $param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
            $param['positions_query'] = $this->db->get_where('main_positions', array('isactive' => 1));
            $param['employees_query'] = $this->db->get_where('main_employees', array('isactive' => 1));
        }
        $param['status_array'] = $this->Common_model->get_array('status');
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['asset_type'] = $this->db->get_where('main_assets_type', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['assets_category'] = $this->db->get_where('main_assets_category', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['assets_name_query'] = $this->db->get_where('main_assets_name', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['asset_type'] = $this->db->get_where('main_assets_type', array('isactive' => 1));
            $param['assets_category'] = $this->db->get_where('main_assets_category', array('isactive' => 1));
            $param['assets_name_query'] = $this->db->get_where('main_assets_name', array('isactive' => 1));
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Employee_License_Reporting.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Employee_License_Reporting() {
        
        $ids = $search_criteria = array();

        $search_criteria['action_from'] = $action_from = $this->input->post('action_from');
        $search_criteria['action_to'] = $action_to = $this->input->post('action_to');
        $search_criteria['expiration_from'] = $expiration_from = $this->input->post('expiration_from');
        $search_criteria['expiration_to'] = $expiration_to = $this->input->post('expiration_to');
        $search_criteria['department_id'] = $department_id = $this->input->post('department_id');
        $search_criteria['employee_id'] = $employee_id = $this->input->post('employee_id');
        

        if (($action_from != '') || ($action_to != '') || ($expiration_from != '') || ($expiration_to != '') || ($department_id != '') || ($employee_id != '') ) {
     
            $this->db->select('*');
            $this->db->from('main_employees');
            $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
            $this->db->join('main_emp_license', 'main_employees.employee_id = main_emp_license.employee_id');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('main_employees.company_id', $this->company_id);
            } else {
                //$this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($action_from != '') {
                $this->db->where('main_emp_license.issued_date >=', $this->Common_model->convert_to_mysql_date($action_from));
            }
            if ($action_to != '') {
                $this->db->where('main_emp_license.issued_date <=', $this->Common_model->convert_to_mysql_date($action_to));
            }
            if ($expiration_from != '') {
                $this->db->where('main_emp_license.expiration_date >=', $this->Common_model->convert_to_mysql_date($expiration_from));
            }
            if ($expiration_to != '') {
                $this->db->where('main_emp_license.expiration_date <=', $this->Common_model->convert_to_mysql_date($expiration_to));
            }
            if ($department_id != '') {
                $this->db->where('main_emp_workrelated.department', $department_id);
            }
            if ($employee_id != '') {
                $this->db->where('main_employees.employee_id >=', $employee_id);
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

