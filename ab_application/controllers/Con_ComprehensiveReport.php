<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ComprehensiveReport extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
     public $employee_id = null;
    
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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('action_from' => '','action_to' => '','location_id' => '','department_id' => '','position_id' => '','employee_id' => '','isactive' => 1)) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Comprehensive Report";
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
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_ComprehensiveReport.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_ComprehensiveReport() {
        
        $ids = $search_criteria = array();

        $search_criteria['action_from'] = $action_from = $this->input->post('action_from');
        $search_criteria['action_to'] = $action_to = $this->input->post('action_to');
        $search_criteria['location_id'] = $location_id = $this->input->post('location_id');
        $search_criteria['department_id'] = $department_id = $this->input->post('department_id');
        $search_criteria['position_id'] = $position_id = $this->input->post('position_id');
        $search_criteria['employee_id'] = $employee_id = $this->input->post('employee_id');
        $search_criteria['isactive'] = $isactive = $this->input->post('isactive');

        if (($action_from != '') || ($action_to != '') || ($location_id != '') || ($department_id != '') || ($position_id != '') || ($employee_id != '') || ($isactive != '')) {
     
            $this->db->select('*');
            $this->db->from('main_employees');
            $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
            $this->db->join('main_emp_wage_compensation', 'main_employees.employee_id = main_emp_wage_compensation.employee_id');
            
            $this->db->where('main_employees.isactive', 1);
            $this->db->where('main_emp_workrelated.isactive', 1);
            $this->db->where('main_emp_wage_compensation.isactive', 1);

            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('main_employees.company_id', $this->company_id);
            } else {
                //$this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($action_from != '') {
                 $from_date = $this->Common_model->convert_to_mysql_date($action_from);
                 $dayOnly = date("d", strtotime($from_date));
                 $monthOnly = date("m", strtotime($from_date));
                $this->db->where('MONTH(main_employees.hire_date) >=', $monthOnly);
                $this->db->where('DAY(main_employees.hire_date) >=', $dayOnly);
                //$this->db->where('main_employees.hire_date >=', $this->Common_model->convert_to_mysql_date($action_from));
            }
            if ($action_to != '') {
                $to_date = $this->Common_model->convert_to_mysql_date($action_to);
                $dayOnly = date("d", strtotime($to_date));
                $monthOnly = date("m", strtotime($to_date));
                $this->db->where('MONTH(main_employees.hire_date) <=', $monthOnly);
                $this->db->where('DAY(main_employees.hire_date) <=', $dayOnly);
               // $this->db->where('main_employees.hire_date <=', $this->Common_model->convert_to_mysql_date($action_to));
            }
            if ($location_id != '') {
                $this->db->where('main_emp_workrelated.location', $location_id);
            }
            if ($department_id != '') {
                $this->db->where('main_emp_workrelated.department', $department_id);
            }
            if ($position_id != '') {
                $this->db->where('main_employees.position', $position_id);
            }
            if ($employee_id != '') {
                $this->db->where('main_employees.employee_id', $employee_id);
            }
            if ($isactive != '') {
                $this->db->where('main_employees.isactive', $isactive);
            }
            $search_data = $this->db->get()->result();
            
            //echo $this->db->last_query();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
     public function employeeDetails() {
        $this->menu_id = $this->uri->segment(3);
        // $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Comprehensive Report";
        $param['module_id'] = $this->module_id;
        //$employee_id = $this->uri->segment(3);

        // if ($this->user_type == 2) {
        //     $param['query'] = $this->db->get_where('main_leave_request', array('company_id' => $this->company_id));
        // } else {
        //     $param['query'] = $this->db->get_where('main_leave_request', array('leave_status' => 1));
        // }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/reports/view_employee_details.php';
        $this->load->view('admin/home', $param);
    }

     public function comprehensive_report(){
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $employee_id = $this->uri->segment(3);
        $param['employee_id'] = $employee_id;
       // $emp = $this->db->get_where('main_employees', array('id' => $employee_id))->row_array(); */
        //$employee_id = $this->uri->segment(3);
            $emp = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
            if ($emp) {
                foreach ($emp->result() as $prow) { 
                   $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','last_name');
                }
            }                 
        $this->pdf->load_view('hr/reports/emp_info_pdf', $param);
        $this->pdf->setPaper('A4', 'portrait');
        //$this->pdf->SetWarnings('false');
        $this->pdf->render();
        $this->pdf->stream("employee_info_$employee_name.pdf");
            

    } 
        
}

