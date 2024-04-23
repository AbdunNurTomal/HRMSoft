<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Alert extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
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
        $this->username = $this->user_data['username'];
        $this->name = $this->user_data['name'];
        $this->date_time = date("Y-m-d H:i:s");
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index()
    {
        $this->menu_id = $this->uri->segment(3);

        $param['menu_id'] = $this->menu_id;
        //$param['page_header'] = "General";
        $param['module_id'] = $this->module_id;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'alert/view_warning_msg.php';
        $this->load->view('admin/home', $param);
    }

    public function page_access_alert()
    {
        $this->menu_id = $this->uri->segment(3);

        $param['menu_id'] = $this->menu_id;
        //$param['page_header'] = "General";
        $param['module_id'] = $this->module_id;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'alert/view_page_access_alert.php';
        $this->load->view('admin/home', $param);
    }

    public function page_User_alert()
    {
        $this->menu_id = $this->uri->segment(3);

        $param['menu_id'] = $this->menu_id;
        //$param['page_header'] = "General";
        $param['module_id'] = $this->module_id;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'alert/view_page_User_alert.php';
        $this->load->view('admin/home', $param);
    }

    public function page_company_alert()
    {
        $this->menu_id = $this->uri->segment(3);

        $param['menu_id'] = $this->menu_id;
        //$param['page_header'] = "General";
        $param['module_id'] = $this->module_id;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'alert/view_page_company_alert.php';
        $this->load->view('admin/home', $param);
    }

   
}
