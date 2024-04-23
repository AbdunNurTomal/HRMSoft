<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_PolicyReviewStatus extends CI_Controller {

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
        $param['page_header'] = "Policy Review";
        $param['module_id'] = $this->module_id;
        
       /*  if ($this->user_group == 10) { *///self
            $emp_id=$this->Common_model->get_selected_value($this, 'emp_user_id', $this->user_id, 'main_employees', 'employee_id') ;
            $param['policy'] = $this->db->get_where('main_emp_company_policies', array('employee_id' => $emp_id));
            $this->db->order_by('id', 'ASC');
       /*  } else {
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {//comp //hr manager
                $param['policy'] = $this->db->get_where('main_emp_company_policies', array('company_id' => $this->company_id,'is_aggree'=>1));
            } else {
                $param['policy'] = $this->db->get_where('main_emp_company_policies', array('is_aggree'=>1));
            }
        } */
//        echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_PolicyReviewStatus.php';
        $this->load->view('admin/home', $param);
    }
}
