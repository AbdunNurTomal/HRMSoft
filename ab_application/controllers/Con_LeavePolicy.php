<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class con_LeavePolicy extends CI_Controller {

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
    public $companyView = false;

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

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Leave Policy";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_leave_policy', array('company_id' => $this->company_id));
        } else {
            $param['query'] = $this->db->get_where('main_leave_policy', array());
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_LeavePolicy.php';
        $this->load->view('admin/home', $param);
    }

    public function add_leave_policy() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Leave Policy";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
            $param['leave_type'] = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 1));
        } else {
            $param['leave_type'] = $this->db->get_where('main_employeeleavetypes', array('isactive' => 1,'leavetype' => 1));
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addLeavePolicy.php';
        $this->load->view('admin/home', $param);
    }

    public function save_leave_policy() {
        
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_type', 'Employee Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_year', 'Leave Year', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applicable', 'Applicable', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('max_limit', 'Max Limit', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->where('leave_type', $this->input->post('leave_type'));
            $this->db->where('leave_year', $this->input->post('leave_year'));
            $this->db->where('company_id', $this->company_id);
            $query = $this->db->get('main_leave_policy');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave type already exist in this year.', 2);
                exit();
            } 
    
            $data = array('company_id' => $this->company_id,
                'max_limit' => $this->input->post('max_limit'),
                'leave_type' => $this->input->post('leave_type'),
                'applicable' => $this->input->post('applicable'),
                'employee_type' => $this->input->post('employee_type'),
                'off_day_leave_count' => $this->input->post('off_day_leave_count'),
                'fractional_leave' => $this->input->post('fractional_leave'),
                'leave_year' => $this->input->post('leave_year'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => $this->input->post('status'),
            );

            $res = $this->Common_model->insert_data('main_leave_policy', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_leave_policy() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Leave Policy";
        $param['module_id'] = $this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_leave_policy", $id, $this->company_id);
        }
        // check permission to view the employee ends

        $param['leave_management_query'] = $this->db->get_where('main_leave_policy', array('id' => $id));
        $param['emp_type'] = $this->Common_model->get_array('employee_type');
        if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
            $param['leave_type'] = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 1));
        } else {
            $param['leave_type'] = $this->db->get_where('main_employeeleavetypes', array('isactive' => 1,'leavetype' => 1));
        }
        $param['applicable'] = $this->Common_model->get_array('applicable');
        $param['yes_no_array'] = $this->Common_model->get_array('yes_no');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addLeavePolicy.php';
        $this->load->view('admin/home', $param);
    }

    public function update_leave_policy() {
        
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_type', 'Employee Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_year', 'Leave Year', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applicable', 'Applicable', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('max_limit', 'Max Limit', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->db->where('id !=',$this->input->post('id'));
            $this->db->where('leave_type', $this->input->post('leave_type'));
            $this->db->where('leave_year', $this->input->post('leave_year'));
            $this->db->where('company_id', $this->company_id);
            $query = $this->db->get('main_leave_policy');
  
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave type already exist in this year.', 2);
                exit();
            } 
            
            $data = array('company_id' => $this->company_id,
                'max_limit' => $this->input->post('max_limit'),
                'leave_type' => $this->input->post('leave_type'),
                'applicable' => $this->input->post('applicable'),
                'employee_type' => $this->input->post('employee_type'),
                'off_day_leave_count' => $this->input->post('off_day_leave_count'),
                'fractional_leave' => $this->input->post('fractional_leave'),
                'leave_year' => $this->input->post('leave_year'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => $this->input->post('status'),
            );

            $res = $this->Common_model->update_data('main_leave_policy', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_leave_policy() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_leave_policy", $id);
        redirect('Con_LeavePolicy/');
        exit;
    }

}
