<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class con_Organization_info extends CI_Controller {

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

        if ($this->user_group !=1 || $this->user_group !=2 || $this->user_group !=3) {
            $this->db->order_by('sequence', 'ASC');
            $result = $this->db->get_where('main_organization_settings', array('company_id' => $this->company_id, 'isactive' => 1))->result();
            //echo $this->db->last_query();
        } else {
            $this->db->order_by('sequence', 'ASC');
            $result = $this->db->get_where('main_organization_settings', array('isactive' => 1))->result();
            //echo $this->db->last_query();
        }

        // echo "<pre>". print_r($result, 1) ."</pre>";exit;

        /* die("====>>> ".$this->db->last_query()); */

        $org = array();
        // if (!empty($result)) {
        if ($result) {
            $i = 0;
            foreach ($result as $row) {
                $this->db->join('main_positions', 'main_positions.id = main_employees.position', 'LEFT');
                $record = $this->db->get_where('main_employees', array('employee_id' => $row->employee_id))->row();

                $org[$i]['node_id'] = $row->employee_id;
                $org[$i]['parent_id'] = $row->hierarchy;
                $org[$i]['node'] = $record ? $record->first_name : "-";
                $org[$i]['position'] = $record ? $this->Common_model->get_name($this, $record->positionname, 'main_jobtitles', 'job_title') : "-";
                $org[$i]['email'] = $record ? $record->email : "-";
                $org[$i]['phone'] = $record ? $record->mobile_phone : "-";
                $org[$i]['img_path'] = $record ? (($record->image_name != '') ? 'uploads/emp_image/' . $record->image_name : 'uploads/blank.png') : "-";

                if ($row->hierarchy > 0) {
                    // $org[$i]['parent'] = $record ? ($this->Common_model->get_row_by_field('employee_id', 'main_employees', $row->hierarchy)->first_name) : "-";
                    $employee = $this->Common_model->get_row_by_field('employee_id', 'main_employees', $row->hierarchy);
                    $org[$i]['parent'] = $employee ? $employee->first_name : "-";
                } else {
                    $org[$i]['parent'] = null;
                }
                $i++;
            }
        }
        //pr($result);
        //pr($org, 1);

        $param['organogram'] = $org;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Oganization Information";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'organization/view_organization_info.php';
        $this->load->view('admin/home', $param);
    }

}
