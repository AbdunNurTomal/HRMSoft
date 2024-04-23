<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Requistion_Explorer extends CI_Controller {

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
        $param['page_header'] = "Training Requisition Explorer";
        $param['module_id'] = $this->module_id;

//        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
//            $param['query'] = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1));
//        } else {
//            $param['query'] = $this->db->get_where('main_training_requisition', array('isactive' => 1));
//        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Requistion_Explorer.php';
        $this->load->view('admin/home', $param);
    }

    public function data_load_rwq() {
        $id = $this->uri->segment(3);
        
        $approver_status = $this->Common_model->get_array('approver_status');
        
        if ($id=='null') {
       
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                $query = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1));
            } else {
                $query = $this->db->get_where('main_training_requisition', array('isactive' => 1));
            }
        
        } else {
          
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                $query = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1 , 'req_status' => $id));
            } else {
                $query = $this->db->get_where('main_training_requisition', array('isactive' => 1 , 'req_status' => $id ));
            }
            
        }
        
        if ($query->num_rows() > 0) {
            $sr = 0;
            foreach ($query->result() as $row) {                             
                
                if ($row->req_status == 0) {
                    $req_status = $approver_status[$row->req_status];
                } else {
                    $req_status = $approver_status[$row->req_status];
                } 
                
                $employee = explode(",", $row->employee);
                $employees = '';
                foreach ($employee as $emp) {
                    if ($employees == '') {
                        $employees = $this->Common_model->employee_name($emp);
                    } else {
                        $employees = $employees . "," . $this->Common_model->employee_name($emp);
                    }
                }
                
                $sr = $sr + 1;   
                echo"<tr><td>" . $sr . "</td><td>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td><td>" . $this->Common_model->show_date_formate($row->proposed_date) . "</td><td>" . $employees . "</td><td>" . $row->training_objective . "</td><td>" . $req_status . "</td></tr>"; //class='td-cw'
            }
        } else {
            echo'<tr><td colspan = 8 class="text-info">No data available in table.</td></tr>';
        }
        //echo $id;
    }
    
    
}
