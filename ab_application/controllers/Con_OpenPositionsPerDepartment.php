<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_OpenPositionsPerDepartment extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $user_name = null;
    public $user_email = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    
    public $parent_user = null;
    
    public $module_data = array();
    public $module_id = null;
    
    public function __construct() {
        parent::__construct();
        
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->user_name =$this->user_data['name'];
        $this->user_email =$this->user_data['username'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group =$this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];

    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header']="Open Positions Per Department";
        $param['module_id']=$this->module_id;
        $param['user_group'] = $this->user_group;
        $param['user_name'] = $this->user_name;
        $param['user_email'] = $this->user_email;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'sadmin/view_TalentAcquisition_dashbord.php';
        $this->load->view('admin/home', $param);
    }
    
   

}
