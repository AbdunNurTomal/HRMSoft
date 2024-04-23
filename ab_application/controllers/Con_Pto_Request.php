<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Pto_Request extends CI_Controller {

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
        $param['page_header'] = "PTO Request";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Self user //Hr Manager //Company User //Admin //HR
            $param['leave_type_query'] = $this->db->get_where('main_pto_settings', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['leave_type_query'] = $this->db->get_where('main_pto_settings', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        
        // if ($this->user_group == 10) {//self
            $emp_id = $this->Common_model->get_selected_value($this, 'emp_user_id', $this->user_id, 'main_employees', 'employee_id');
            //$param['employe'] = $this->db->get_where('main_employees', array('emp_user_id' => $this->user_id,'isactive' => 1));
            $param['employee'] = $this->db->get_where('main_employees', array('emp_user_id' => $this->user_id))->row();
            //echo $this->db->last_query();
        /* } else {
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                $param['employe'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
            } else {
                $param['employe'] = $this->Common_model->listItem('main_employees');
            }
        } */
        //echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_PtoRequest.php';
        $this->load->view('admin/home', $param);
    }

    public function save_ptoLeaveRequest() {

        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('available_balance', 'Available Balance', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('applied_hours', 'Applied Hour', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        // $this->form_validation->set_rules('from_date', 'From Date', 'trim|required|xss_clean', array('required' => "Please enter the required field, for more Info : %s."));
        // $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|xss_clean', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('single_employee_id', 'Employee Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $emp_id=$this->input->post('single_employee_id');
            $pto_req_status = $this->db->get_where('main_pto_request', array('employee_id' => $emp_id , 'status' => 0 ))->row();
            $showWarning = false;
            if ($pto_req_status) {
                $showWarning = true;
            }
            $pto_req_status = false;
                
            if($pto_req_status == TRUE){
                echo $this->Common_model->show_validation_massege('A PTO Request Already Pending', 2);
                exit();
            }
            
            $data = array(
                'employee_id' => $this->input->post('single_employee_id'),
                'company_id' => $this->company_id,
                'leave_type' => $this->input->post('leave_type'),
                'available_balance' => $this->input->post('available_balance'),
                'applied_hours' => $this->input->post('applied_hours'),
                'approved_hours' => $this->input->post('applied_hours'),
                // 'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_date')),
                // 'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_date')),
                'description' => $this->input->post('description'),
                'status' => 0,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
            );
            
            //print_r($data);exit();
            $res = $this->Common_model->insert_data('main_pto_request', $data);
            //$res = $this->db->insert('main_pto_request', $data);

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

    public function get_pto_leave_info($emp_id) {
        echo $this->Common_model->employee_pto_info($emp_id);
    }
    
    public function load_Leave_Type() {
        $emp_id = $this->uri->segment(3);
        $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$emp_id, 'main_employees','state');
        
        if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            
            $this->db->select('paid_leave_type, main_pto_settings.id AS mstID, main_employeeleavetypes.state');
            $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_pto_settings.company_id', $this->company_id);
            $this->db->order_by('main_pto_settings.id', 'DESC');
            $query = $this->db->get('main_pto_settings');
            
        } else {
            $this->db->select('paid_leave_type, main_pto_settings.id AS mstID, main_employeeleavetypes.state');
            $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_pto_settings.company_id', $this->company_id);
            $this->db->order_by('main_pto_settings.id', 'DESC');
            $query = $this->db->get('main_pto_settings');
        }
        
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                $leave_code=$this->Common_model->get_name($this, $row->paid_leave_type, 'main_leave_types', 'leave_code');
                print"<option value=" . $row->paid_leave_type . ">" . $leave_code ." - " . $this->Common_model->get_name($this, $row->state,'main_state','state_abbr'). "</option>";
            }
        } else {
            echo"<option> No leave type added </option>";
        }
    }

}
