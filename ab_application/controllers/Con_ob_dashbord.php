<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ob_dashbord extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
    public $username = null;
    public $name = null;
    public $date_time = null;
    public $module_data = array();
    public $module_id = null;
    public $companyView = false;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('hr_logged_in')) {
            redirect('chome/logout', 'refresh');
        }

        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->username = $this->user_data['username'];
        $this->name = $this->user_data['name'];
        $this->date_time = date("Y-m-d H:i:s");
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->session->unset_userdata('onboarding_employee');

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        if (!$this->user_id) {
            redirect('chome/logout', 'refresh');
        } else {
            if ($this->uri->segment(3)) {
                $this->module_id = $this->uri->segment(3);
            }

            if (!$this->module_id) {
                $param['module_id'] = 3;
            } else {
                $param['module_id'] = $this->module_id;
            }

            // check module access starts
            $currentModuleId = 3; // Onboarding
            if ($this->user_group <= 3) {
            } else if ($this->user_group == 12 && $this->companyView) {
            } else {
                $this->KurunthamModel->checkModuleAccess($this->user_group, $currentModuleId, $this->user_module);
            }
            // check module access ends

            $module_session_array = array('module_id' => $param['module_id']);
            $this->session->set_userdata('active_module_id', $module_session_array);

            $param['user_id'] = $this->user_id;
            $param['user_type'] = $this->user_type;
            $param['company_id'] = $this->company_id;
            $param['page_header'] = "Onboarding Status";
            $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
            $param['content'] = 'sadmin/view_ob_dashbord.php';
            $this->load->view('admin/home', $param);
        }
    }

}
