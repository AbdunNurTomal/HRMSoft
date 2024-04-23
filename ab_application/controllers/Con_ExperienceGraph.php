<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ExperienceGraph extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_name = null;
    public $user_email = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
    public $module_id = null;
    public $module_data = null;
    public $date_time = null;

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('hr_logged_in')) {
            redirect('chome/logout', 'refresh');
        }

        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_name = $this->user_data['name'];
        $this->user_email = $this->user_data['username'];
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

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Number of Employees by Experience";
        $param['module_id'] = $this->module_id;
        $param['company_id'] = $this->company_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'dashboard/view_experienceGraph.php';
        $this->load->view('admin/home', $param);
    }

}
