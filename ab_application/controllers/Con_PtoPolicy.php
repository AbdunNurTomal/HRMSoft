<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_PtoPolicy extends CI_Controller {

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
        $param['page_header'] = "Pto Policy";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 12 || $this->user_group==11) {
            $param['query'] = $this->db->get_where('main_pto_policy', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_pto_policy', array('isactive' => 1));
        }
       
        $param['leave_type_query'] = $this->Common_model->listItem('main_employeeleavetypes');
        $param['accrual_period_array'] = $this->Common_model->get_array('accrual_period');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_PtoPolicy.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Pto_Policy() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Pto Policy";
        $param['module_id'] = $this->module_id;
        $param['states'] = $this->Common_model->listItem('main_state');
        $param['accrual_period_array'] = $this->Common_model->get_array('accrual_period');
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['leave_type_query'] = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 0));
        } else {
            $param['leave_type_query'] = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 0));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addPtoPolicy.php';
        $this->load->view('admin/home', $param);
    }

    public function save_pto_policy() {

        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_amt', 'Accrual Amount', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_period', 'Accrual period', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('start_days_after_hire', 'Start Days After Hire', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            if ($this->input->post('track_time_off')) {
                $track_time_off = $this->input->post('track_time_off');
            } else {
                $track_time_off = "";
            }

            $data = array('company_id' => $this->company_id,
                'track_time_off' => $track_time_off,
                'rollover_on' => $this->input->post('rollover_on'),
                'leave_type' => $this->input->post('leave_type'),
                'accrual_amt' => $this->input->post('accrual_amt'),
                'accrual_period' => $this->input->post('accrual_period'),
                'start_days_after_hire' => $this->input->post('start_days_after_hire'),
                'max_accrual' => $this->input->post('max_accrual'),
                'max_available' => $this->input->post('max_available'),
                'max_carryover' => $this->input->post('max_carryover'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_pto_policy', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }
    
    function edit_pto_policy() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Pto Policy";
        $param['module_id'] = $this->module_id;
        $param['state_id'] = str_replace("%20", " ", $this->uri->segment(4));

        $param['query'] = $this->db->get_where('main_pto_policy', array('id' => $id));
        $param['accrual_period_array'] = $this->Common_model->get_array('accrual_period');
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['leave_type_query'] = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 0));
        } else {
            $param['leave_type_query'] = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 0));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addPtoPolicy.php';
        $this->load->view('admin/home', $param);
    }
    
    public function update_pto_policy() {

        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_amt', 'Accrual Amount', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_period', 'Accrual period', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('start_days_after_hire', 'Start Days After Hire', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            if ($this->input->post('track_time_off')) {
                $track_time_off = $this->input->post('track_time_off');
            } else {
                $track_time_off = "";
            }

            $data = array('company_id' => $this->company_id,
                'track_time_off' => $track_time_off,
                'rollover_on' => $this->input->post('rollover_on'),
                'leave_type' => $this->input->post('leave_type'),
                'accrual_amt' => $this->input->post('accrual_amt'),
                'accrual_period' => $this->input->post('accrual_period'),
                'start_days_after_hire' => $this->input->post('start_days_after_hire'),
                'max_accrual' => $this->input->post('max_accrual'),
                'max_available' => $this->input->post('max_available'),
                'max_carryover' => $this->input->post('max_carryover'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res = $this->Common_model->update_data('main_pto_policy', $data, array('id' => $this->input->post('id')));
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function delete_pto_policy() {
        echo $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_pto_policy", $id);
        redirect('Con_PtoPolicy/');
        exit;
    }

}
