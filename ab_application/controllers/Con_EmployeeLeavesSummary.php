<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_EmployeeLeavesSummary extends CI_Controller {

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

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Leave Summary";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_leave_request', array('company_id' => $this->company_id, 'leave_status' => 0));
        } else {
            $param['query'] = $this->db->get_where('main_leave_request', array('leave_status' => 0));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_EmployeeLeavesSummary.php';
        $this->load->view('admin/home', $param);
    }

    public function approve_leave() {
        $date = date("Y");
        $leave_req_id = $this->uri->segment(3);
        $available_leaves=$this->Common_model->get_selected_value($this, 'id', $leave_req_id, 'main_leave_request', 'available_leaves');
        $number_of_days = $this->Common_model->get_selected_value($this, 'id', $leave_req_id, 'main_leave_request', 'number_of_days');
        $applied_hour = $this->Common_model->get_selected_value($this, 'id', $leave_req_id, 'main_leave_request', 'applied_hour');
        //exit();
        
        if($available_leaves >= $applied_hour){
        
            $data = array('company_id' => $this->company_id,
                'leave_status' => 1,
                'leave_req_id' => $leave_req_id,
                'employee_id' => $this->Common_model->get_selected_value($this, 'id', $leave_req_id, 'main_leave_request', 'employee_id'),
                'leave_type' => $this->Common_model->get_selected_value($this, 'id', $leave_req_id, 'main_leave_request', 'leave_type'),
                'available_leaves' => $x = $available_leaves,
                //'number_of_days' => $y = $this->Common_model->get_selected_value($this, 'id', $leave_req_id, 'main_leave_request', 'number_of_days'),
                'applied_hour' => $y = $applied_hour,
                'leave_balence' => $x - $y,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->db->insert('main_leave_transaction', $data);

            $udata = array('leave_status' => 1);
            $ures = $this->Common_model->update_data('main_leave_request', $udata, array('id' => $leave_req_id));

            if ($res && $ures) {
                echo $this->Common_model->show_massege(12, 1);
            } else {
                echo $this->Common_model->show_massege(13, 2);
            }
        }
        else {
            echo $this->Common_model->show_massege(13, 2);
        }
    }

    public function view_leave_request() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $date = date("Y");

        $param['type'] = "2";
        $param['page_header'] = " Leave Explorer ";
        $param['module_id'] = $this->module_id;
        $param['query'] = $this->db->get_where('main_leave_request', array('id' => $id));
        
        $employee_id=$this->Common_model->get_name($this,$id,'main_leave_request','employee_id');
        $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$employee_id, 'main_employees','state');
        
        //echo $this->db->last_query();

        if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
            
            $this->db->select('*');
            $this->db->from('main_leave_policy');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_leave_policy.leave_year', $date);
            $this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $param['policy'] = $this->db->get();
            
        } else {
            
            $this->db->select('*');
            $this->db->from('main_leave_policy');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_leave_policy.leave_year', $date);
            //$this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $param['policy'] = $this->db->get();
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_emp_Leave.php';
        $this->load->view('admin/home', $param);
    }

    public function download_leave_request() {
        $this->load->library('Pdf');

        //$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param['page_header'] = "Time-Off Request";
        $param['emp_data'] = $this->db->get_where('main_leave_request', array('id' => $id))->row_array();

        $emp_data = $this->Common_model->get_multiple_names($this, $param['emp_data']['employee_id'], 'main_employees', 'first_name, middle_name, last_name, email, mobile_phone');
        $emp_data = (array) $emp_data;

        $this->db->select('main_department.department_name');
        $this->db->join(' main_department', 'main_department.id = main_emp_workrelated.department');
        $this->db->where('main_emp_workrelated.employee_id', $param['emp_data']['employee_id']);
        $q = $this->db->get('main_emp_workrelated');


        $param['emp_data'] = array_merge($param['emp_data'], $emp_data);
        $param['emp_data']['dept_name'] = $q->row('department_name');
        $param['Emp_Name'] = $Emp_Name = $param['emp_data']['first_name'] . ' ' . $param['emp_data']['middle_name'] . ' ' . $param['emp_data']['last_name'];

        $sql = 'SELECT CONCAT(first_name," ", middle_name," ", last_name) AS Sup_Name FROM main_employees'
                . ' WHERE `employee_id`=(SELECT `reporting_manager` FROM main_emp_workrelated WHERE `employee_id`=' . $param['emp_data']['employee_id'] . ')';

        $param['Supervisor_Name'] = $this->db->query($sql)->row("Sup_Name");

        $where_array = array('leavetype' => 1);
        if ($this->company_id != 0) {
            $where_array['company_id'] = $this->company_id;
        }
        $param['unpaid_leave_types'] = $this->db->get_where('main_employeeleavetypes', $where_array)->result();

        //$this->load->view('hr/reports/time_off_request', $param);

        $this->pdf->load_view('hr/reports/time_off_request', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("time_off_" . str_replace(' ', '', $Emp_Name) . ".pdf");
    }

    public function ajax_edit_leave() {
        $id = $this->uri->segment(3);
        $query = $this->Common_model->get_by_id_row('main_leave_request', $id);
        echo json_encode($query);
    }

    public function update_emp_leave() {
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applied_hour', 'Applied Hour', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('from_date', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('to_date', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('reason', 'Reason', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee'),
                'available_leaves' => $this->input->post('available_leaves'),
                'leave_type' => $this->input->post('leave_type'),
                //'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_date')),
                //'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_date')),
                //'number_of_days' => $this->input->post('number_of_days'),
                'applied_hour' => $this->input->post('applied_hour'),
                'reason' => $this->input->post('reason'),
                //'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );
//            $res = $this->Common_model->insert_data('main_leave_request', $data);
            $res = $this->Common_model->update_data('main_leave_request', $data, array('id' => $this->input->post('leave_req_id')));


            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function reject_leave() {
        $id = $this->uri->segment(3);
        $this->db->set('leave_status', 4);
        $this->db->where('id', $id);
        $this->db->update('main_leave_request');
        redirect('Con_EmployeeLeavesSummary/');
        exit;
    }

//            function edit_entry() {
//        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
//        $id = $this->uri->segment(3);
//
//        $param['type'] = "2";
//        $param['page_header'] = "Leave Summary";
//        $param['module_id'] = $this->module_id;
//
//        $param['query'] = $this->db->get_where('main_leave_request', array('id' => $id));
//        $param['leave_type_query'] = $this->Common_model->listItem('main_employeeleavetypes');
//
//        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
//        $param['content'] = 'self_service/view_addLeaveRequest.php';
//        $this->load->view('admin/home', $param);
//    }
}
