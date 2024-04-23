<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_EmployeeEducationReporting extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('educationlevel' => '','employee_name' => '','department_id' => '','position_id' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Employee Education Reporting";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['employee_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));            
            $param['educationlevel_query']= $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['department_query']= $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['employee_query'] = $this->db->get_where('main_employees', array('isactive' => 1));            
            $param['educationlevel_query']= $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
            $param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
            $param['positions_query'] = $this->db->get_where('main_positions', array('isactive' => 1));
        }
        
//        $param['employee_education_query']= $this->db->get_where('main_emp_education', array('isactive' => 1));
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_EmployeeEducationReport.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_EmployeeEducationReporting() {
        
        $ids = $search_criteria = array();

        $search_criteria['educationlevel'] = $educationlevel = $this->input->post('educationlevel');
        $search_criteria['employee_name'] = $employee_name = $this->input->post('employee_name');
        $search_criteria['department_id'] = $department_id = $this->input->post('department_id');
        $search_criteria['position_id'] = $position_id = $this->input->post('position_id');

        if (($educationlevel != '') || ($employee_name != '') || ($department_id != '') || ($position_id != '')) {
     
            $this->db->select('*');
            $this->db->from('main_employees');
            $this->db->join('main_emp_education', 'main_emp_education.employee_id = main_employees.employee_id', "LEFT");
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', "LEFT");
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('main_employees.company_id', $this->company_id);
            } else {
                //$this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
           
            if ($educationlevel != '') {
                $this->db->where('main_emp_education.educationlevel', $educationlevel);
            }
            if ($employee_name != '') {
                $this->db->where('main_employees.employee_id', $employee_name); //main_emp_education
            }
            if ($department_id != '') {
                $this->db->where('main_emp_workrelated.department', $department_id);
            }
            if ($position_id != '') {
                $this->db->where('main_employees.position', $position_id);
            }
            $search_data = $this->db->get()->result();
            
            // echo $this->db->last_query();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
    
    
}

