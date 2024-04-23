<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_EmployeeExperienceReporting extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('min_exp' => '','max_exp' => '','employee_name' => '','department_id' => '','position_id' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Employee Experience Reporting";
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
        $param['content'] = 'report/view_EmployeeExperienceReporting.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_EmployeeExperienceReporting() {
        
        $ids = $search_criteria = array();

        $search_criteria['min_exp'] = $min_exp = $this->input->post('min_exp');
        $search_criteria['max_exp'] = $max_exp = $this->input->post('max_exp');
        $search_criteria['employee_name'] = $employee_name = $this->input->post('employee_name');
        $search_criteria['department_id'] = $department_id = $this->input->post('department_id');
        $search_criteria['position_id'] = $position_id = $this->input->post('position_id');

        if (($min_exp != '') || ($max_exp != '') || ($employee_name != '') || ($department_id != '') || ($position_id != '')) {
     
            $this->db->select('main_employees.employee_id,'
                    . 'main_employees.first_name,'
                    . 'main_employees.middle_name,'
                    . 'main_employees.last_name,'
                    . 'main_employees.salutation,'
                    . 'main_emp_workrelated.department,'
                    . 'main_emp_experience.comp_name,'
                    . 'main_emp_experience.emp_position,'
                    . 'main_emp_experience.from_date,'
                    . 'main_emp_experience.to_date,'
                    . 'main_emp_experience.reason_for_leaving,'
                    . 'main_emp_experience.id,'
                    . 'main_employees.isactive,'
                    . 'main_emp_workrelated.department,'
                    . 'main_employees.position');
            $this->db->from('main_employees');
            $this->db->join('main_emp_experience', 'main_emp_experience.employee_id = main_employees.id', "LEFT");
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id','LEFT');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('main_employees.company_id', $this->company_id);
            } else {
                //$this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
           
            /* if ($educationlevel != '') {
                $this->db->where('main_emp_education.educationlevel', $educationlevel);
            } */

           if ($min_exp != '') {
               /* $min_exp= explode('-',$min_exp);
               $min_exp=$min_exp[2].'-'.$min_exp[0].'-'.$min_exp[1];//exit;
               $this->db->where('main_emp_experience.from_date', $min_exp); */
               $from_date = $this->Common_model->convert_to_mysql_date($min_exp);
                 $dayOnly = date("d", strtotime($from_date));
                 $monthOnly = date("m", strtotime($from_date));
                $this->db->where('MONTH(main_emp_experience.from_date) >=', $monthOnly);
                $this->db->where('DAY(main_emp_experience.from_date) >=', $dayOnly);
            }
            if ($max_exp != '') {
               /*  $max_exp=$max_exp[2].'-'.$max_exp[0].'-'.$max_exp[1];//
                $this->db->where('main_emp_experience.to_date', $max_exp); */
                $to_date = $this->Common_model->convert_to_mysql_date($max_exp);
                 $dayOnly = date("d", strtotime($to_date));
                 $monthOnly = date("m", strtotime($to_date));
                $this->db->where('MONTH(main_emp_experience.to_date) <=', $monthOnly);
                $this->db->where('DAY(main_emp_experience.to_date) <=', $dayOnly);
            }
            if ($employee_name != '') {
                $this->db->where('main_employees.employee_id', $employee_name);//main_emp_experience
            }
            if ($department_id != '') {
                $this->db->where('main_emp_workrelated.department', $department_id);
            }
            if ($position_id != '') {
                $this->db->where('main_employees.position', $position_id);
            }
            $search_data = $this->db->get()->result();
            
            // echo $this->db->last_query();
        } else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
    
    
}

