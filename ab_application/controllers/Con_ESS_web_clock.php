<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ESS_web_clock extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $company_id = null;
    public $date_time = null;
    public $module_data = array();
    public $module_id = null;

//    public $employee_id = null;

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

        $this->session->unset_userdata('employee');
        
        if($this->user_id!="")
        {
            $swipeClockId = $this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id, 'main_employees','sweepclock_id');
        }

        // $param['employee_id'] = sprintf("%07d", $employee_id);
        $param['swipe_clock_id'] = $swipeClockId;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employee Details";
        $param['module_id'] = $this->module_id;

        $param['status_array'] = $this->Common_model->get_array('status');
        $param['marital_status_array'] = $this->Common_model->get_array('marital_status');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_ESS_web_clock.php';
        $this->load->view('admin/home', $param);
    }

}
