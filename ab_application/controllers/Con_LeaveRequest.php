<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_LeaveRequest extends CI_Controller {

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
        $param['page_header'] = "Leave Request";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            //$param['leave_type_query'] = $this->db->get_where('main_leave_policy', array('company_id' => $this->company_id, 'isactive' => 1));
            
            $this->db->select('*');
            $this->db->from('main_leave_policy');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_leave_policy.leave_year', date("Y"));
            $this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $param['leave_type_query'] = $this->db->get();
        }  else {
            //$param['leave_type_query'] = $this->db->get_where('main_leave_policy', array('isactive' => 1));
            $this->db->select('*');
            $this->db->from('main_leave_policy');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_leave_policy.leave_year', date("Y"));
            //$this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $param['leave_type_query'] = $this->db->get();
        } 
        
        // if ($this->user_group == 10) {//self
            //$param['employe'] = $this->db->get_where('main_employees', array('emp_user_id' => $this->user_id))->row();
             //$param['employee'] = $this->db->get_where('main_employees', array('employee_id' => $this->user_id))->row();
             $param['employee'] = $this->db->get_where('main_employees', array('emp_user_id' => $this->user_id))->row();
        /* } else {
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {//comp //hr manager
                $param['employe'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            } else {
                $param['employe'] = $this->Common_model->listItem('main_employees');
            }
        } */
        //echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_LeaveRequest.php';
        $this->load->view('admin/home', $param);
    }

    public function add_LeaveRequest() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Leave Request";
        $param['module_id'] = $this->module_id;

        $param['leave_type_query'] = $this->Common_model->listItem('main_employeeleavetypes');
        $param['employe'] = $this->Common_model->listItem('main_employees');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_addLeaveRequest.php';
        $this->load->view('admin/home', $param);
    }

    public function save_LeaveRequest() {
        // $this->form_validation->set_rules('leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required');
        // $this->form_validation->set_rules('applied_hour', 'Applied Hour', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applied_hour', 'Applied Hour', 'required');
        //$this->form_validation->set_rules('employee_id', 'Employee Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('from_date', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('to_date', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('from_date', 'From Date', 'trim|required|xss_clean|callback_compareLeaveDate');
        // $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|xss_clean|callback_compareLeaveDate');
        $this->form_validation->set_rules('from_date', 'From Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('reason', 'Reason', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('employee', 'Employee Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $this->form_validation->set_rules('employee', 'Employee Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $emp_id = $this->input->post('employee');
            $leave_req_status = $this->db->get_where('main_leave_request', array('employee_id' => $emp_id , 'leave_status' => 0 ))->row();
            $showWarning = false;
            if ($leave_req_status) {
                $showWarning = true;
            }
            $leave_req_status = false;

            if ($leave_req_status == TRUE) {
                echo $this->Common_model->show_validation_massege('A Leave Request Already Pending', 2);
            } else {
                if ( $this->input->post('applied_hour') > $this->input->post('available_leaves') ) {
                    echo $this->Common_model->show_validation_massege('You can not apply for more then your available leaves . ', 2);
                    exit();
                }
         
                $data = array('company_id' => $this->company_id,
                    'employee_id' => $this->input->post('employee'),
                    'available_leaves' => $this->input->post('available_leaves'),
                    'leave_type' => $this->input->post('leave_type'),
                    'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_date')),
                    'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_date')),
                    //'number_of_days' => $this->input->post('number_of_days'),
                    'applied_hour' => $this->input->post('applied_hour'),
                    'reason' => $this->input->post('reason'),
                    //'description' => $this->input->post('description'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->insert_data('main_leave_request', $data);

                if ($res) {
                    if ($showWarning) {
                        echo $this->Common_model->show_massege(21, 1);
                    } else {
                        echo $this->Common_model->show_massege(0, 1);
                    }
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
                
            }
        }
    }

    public function compareLeaveDate()
    {
        // Field validation succeeded.  Validate against database
        $fromDate = strtotime($this->input->post('from_date'));
        $toDate = strtotime($this->input->post('to_date'));

        if ($toDate >= $fromDate) {
            echo "<pre>". print_r($this->input->post(), 1) ."</pre>";exit;
            return True;
        } else {
            $this->form_validation->set_message('compareLeaveDate', '%s should be greater than Contract From Date.');
            return False;
        }
    }

    public function edit_entry() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Leave Request";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_leave_request', array('id' => $id));
        $param['leave_type_query'] = $this->Common_model->listItem('main_employeeleavetypes');
        $param['employe'] = $this->Common_model->listItem('main_employees');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_addLeaveRequest.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_LeaveRequest()
    {
        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applied_hour', 'Applied Hour', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('from_date', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('to_date', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('from_date', 'From Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reason', 'Reason', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee', 'Employee Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee'),
                'available_leaves' => $this->input->post('available_leaves'),
                'leave_type' => $this->input->post('leave_type'),
                'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_date')),
                'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_date')),
                //'number_of_days' => $this->input->post('number_of_days'),
                'applied_hour' => $this->input->post('applied_hour'),
                'reason' => $this->input->post('reason'),
               // 'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_leave_request', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_leave_request", $id);
        redirect('con_LeaveRequest/');
        exit;
    }

    public function get_leave_information() {
        $id = $this->uri->segment(3);
        $as = (explode('_', $id));
        $leave_type = $as[0];
        $emp_id = $as[1];

        $total_leave = $this->Common_model->get_selected_value($this, 'leave_type', $leave_type, 'main_leave_policy', 'max_limit');
        $this->db->select_min('leave_balence');
        $this->db->where('leave_type', $leave_type);
        $ys = $this->db->get_where('main_leave_transaction', array('employee_id' => $emp_id))->row();
        $take_leave = $ys->leave_balence;

        if ($take_leave != '') {
            echo $Ttake_leave = $take_leave;
        } else {
            echo $Ttake_leave = $total_leave;
        }
    }

    public function get_employee_name() {
        $emp_id = $this->uri->segment(3);
        $row = $this->db->get_where('main_employees', array('employee_id' => $emp_id))->row();
        $emp_name = "";
        if(!empty($emp_id)){
           $emp_name = $row->first_name . " " . $row->middle_name . " " . $row->last_name;
           $position_name = $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title');        
        }
        else{
              $emp_name ="";
              $position_name ="";
        }
        if ($emp_name) {
            echo $emp_name . "_" . $position_name . "_" . $emp_id;
        }
    }
    
    public function get_employee_leave_info() {
        
        $emp_id = $this->uri->segment(3);
        $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$emp_id, 'main_employees','state');
        $date = date("Y");

        if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) //Hr Manager //Company User //Admin //HR
        {
            $this->db->select('*');
            $this->db->from('main_leave_policy');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_leave_policy.leave_year', $date);
            $this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $query = $this->db->get();
            
        } else {

            $this->db->select('*');
            $this->db->from('main_leave_policy');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_leave_policy.leave_year', $date);
            //$this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $query = $this->db->get();
            
        }
        
        //echo $this->db->last_query();

        $lbalence = "";
        if ($query->num_rows() > 0) {

            $sr = 0;
            foreach ($query->result() as $row) {
                $sr++;

                $sql = "SELECT `leave_type`,sum(`number_of_days`) as ldays,sum(applied_hour) as app_hour  FROM `main_leave_transaction` WHERE `employee_id` = " . $emp_id . " and leave_type= " . $row->leave_type . "   group by `leave_type`";
                $tquery = $this->db->query($sql);

                $EnjoyLeave = 0;
                if ($tquery) {
                    if ($tquery->num_rows() > 0) {
                        foreach ($tquery->result() as $trow) {
                            $EnjoyLeave = $trow->app_hour;
                        }
                    }
                }

                $lbalence = ($row->max_limit - $EnjoyLeave);

                print"<tr><td>" . $sr . "</td><td>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') ." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "</td><td>" . $row->max_limit . "</td><td>" . $EnjoyLeave . "</td><td>" . $lbalence . "</td></tr>";
            }
        } else {
            echo'<tr><td colspan = 8 class="text-info">No leave type added.</td></tr>';
        }
    }
    
    
    public function load_Leave_Type() {
        $emp_id = $this->uri->segment(3);
        $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$emp_id, 'main_employees','state');
        
        if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            
            $this->db->select('main_leave_policy.leave_type, main_leave_policy.id AS mstID, main_employeeleavetypes.state');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_leave_policy.leave_year', date("Y"));
            $this->db->where('main_leave_policy.company_id', $this->company_id);
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $query = $this->db->get('main_leave_policy');
            
        } else {
            $this->db->select('main_leave_policy.leave_type, main_leave_policy.id AS mstID, main_employeeleavetypes.state');
            $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_leave_policy.leave_year', date("Y"));
            $this->db->order_by('main_leave_policy.id', 'DESC');
            $query = $this->db->get('main_leave_policy');
        }
        
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                $leave_code=$this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code');
                print"<option value=" . $row->leave_type . ">" . $leave_code ." - " . $this->Common_model->get_name($this, $row->state,'main_state','state_abbr'). "</option>";
            }
        } else {
            echo"<option> No leave type added </option>";
        }
    }

   

}
