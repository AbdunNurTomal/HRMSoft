<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_EmployeeLeaveTracking extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('from_date'=>'','to_date'=>'','leave_type' => '','employee_name' => '','department_id' => '','absent_type' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Employee Leave Tracking  Reporting";
        $param['module_id']=$this->module_id;
  
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['employee_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));            
            $param['main_employeeleavetypes']= $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['department_query']= $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));

        } else {
            $param['employee_query'] = $this->db->get_where('main_employees', array('isactive' => 1));            
            $param['main_employeeleavetypes']= $this->db->get_where('main_employeeleavetypes', array('isactive' => 1));
            $param['department_query']= $this->db->get_where('main_department', array('isactive' => 1));
            $param['positions_query'] = $this->db->get_where('main_positions', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_EmployeeLeaveTrackingReporting.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_EmployeeLeaveTrackingReporting() {
        
        $ids = $search_criteria = array();

        $search_criteria['from_date'] = $from_date = $this->input->post('from_date');
        $search_criteria['to_date'] = $to_date = $this->input->post('to_date');
        $search_criteria['leave_type'] = $leave_type = $this->input->post('leave_type');
        $search_criteria['employee_name'] = $employee_name = $this->input->post('employee_name');
        $search_criteria['department_id'] = $department_id = $this->input->post('department_id');
        $search_criteria['absent_type'] = $absent_type = $this->input->post('absent_type');

        if (($from_date!='' && $to_date!='') ||$employee_name != '' || $leave_type != '' || $department_id != '' || $absent_type != '') {
            $this->db->select('main_employees.employee_id,'
                    . 'main_employees.first_name,'
                    . 'main_employees.middle_name,'
                    . 'main_employees.last_name,'
                    . 'main_employees.position,'
                    . 'main_emp_accrual_leave.leave_type,'
                    . 'main_emp_accrual_leave.used_hour,'
                    . 'main_emp_accrual_leave.id,'
                    . 'main_employees.isactive,'
                    . 'main_emp_workrelated.department,'
                    . 'main_employees.salutation');
            $this->db->from('main_employees');
            $this->db->join('main_emp_accrual_leave', 'main_emp_accrual_leave.employee_id = main_employees.id','left');
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id','left');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('main_employees.company_id', $this->company_id);
            } else {
                //$this->db->where('createdby', $this->user_id);
            }

            if ($from_date!='' && $to_date!='') {
                $from_date=$this->Common_model->convert_to_mysql_date($from_date);
                $to_date  =$this->Common_model->convert_to_mysql_date($to_date);      
                $this->db->where("main_emp_accrual_leave.from_date BETWEEN '".$from_date."' AND '".$to_date."'");
                // $this->db->where('main_emp_actions.action_date <=',$to_date);
            }
   
            if ($employee_name != '') {
                $this->db->where('main_employees.employee_id', $employee_name);//main_emp_accrual_leave
            }
            if ($department_id != '') {
                $this->db->where('main_emp_workrelated.department', $department_id);
            }
            if ($absent_type != '') {
                $this->db->where('main_emp_accrual_leave.leave_type', $leave_type);
            }
            $search_data = $this->db->get()->result();
            
            // echo $this->db->last_query();
        } else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
}
