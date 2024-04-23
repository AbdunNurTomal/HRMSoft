<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Rpt_Employee_Details extends CI_Controller {

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
        $param['page_header'] = "Pay Frequency";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Rpt_Employee_Details.php';
        $this->load->view('admin/home', $param);
    }

    public function get_employee_search_result() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $post_data = $this->input->post();
        // echo "<pre>".print_r($this->session->userdata('hr_logged_in'),1)."</pre>";exit;

        $param['view_columns'] = $post_data;

        $search_conditions = array();
        /* ---------- Fixed Searching Conditions ---------- */
        if ($this->user_group == 11 || $this->user_group == 12) { // `Company` or, `HR Manager` User
            $search_conditions['main_employees.company_id'] = $this->company_id;
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $search_conditions['main_employees.company_id'] = $this->company_id;
        } else if ($this->user_group == 10) { // `Self` User
            $search_conditions['main_employees.emp_user_id'] = $this->user_id;
        }

        /* ---------- Searching Criteria ---------- */
        if (isset($post_data['emp_status']) && ($post_data['emp_status'] != 2)) { // Active or, In-active Search
            $search_conditions['main_employees.isactive'] = $post_data['emp_status'];
        }
        if (isset($post_data['state_id']) && ($post_data['state_id'] != '')) { // `State` Search
            $search_conditions['main_employees.state'] = $post_data['state_id'];
        }
        if (isset($post_data['county_id']) && ($post_data['county_id'] != '')) { // `County` Search
            $search_conditions['main_employees.county'] = $post_data['county_id'];
        }
        if (isset($post_data['positions_id']) && ($post_data['positions_id'] != '')) { // `Position` Search
            $search_conditions['main_employees.position'] = $post_data['positions_id'];
        }
        if (isset($post_data['location_id']) && ($post_data['location_id'] != '')) { // `Location` Search
            $search_conditions['main_emp_workrelated.location'] = $post_data['location_id'];
        }
        if (isset($post_data['department_id']) && ($post_data['department_id'] != '')) { // `Department` Search
            $search_conditions['main_emp_workrelated.department'] = $post_data['department_id'];
        }

        $this->db->trans_start();
        $this->db->select('*, main_employees.employee_id AS Emp_ID, main_employees.isactive AS Emp_Active');
        $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'LEFT');
        $this->db->join('main_location', 'main_location.id = main_emp_workrelated.location', 'LEFT');
        $this->db->order_by('main_employees.employee_id', 'DESC');
        $param['query'] = $this->db->get_where('main_employees', $search_conditions);
        $this->db->trans_complete();

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employee Search Details";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Rpt_Employee_Details_Search.php';
        $this->load->view('admin/home', $param);
    }

}
