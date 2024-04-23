<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_LeaveStatus extends CI_Controller {
    
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
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        if($this->user_type==2){ $this->company_id=$this->company_id;} else { $this->company_id=""; }
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Leave Status";
        $param['module_id']=$this->module_id;;
        
        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_leave_status', array('company_id' => $this->company_id));
        } else {
            $param['query'] = $this->db->get('main_leave_status');
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_LeaveStatus.php';
        $this->load->view('admin/home', $param);
    }

    public function add_leave_status() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type'] = "1";
        $param['page_header'] = "Leave Status";
        $param['module_id']=$this->module_id;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addLeaveStatus.php';
        $this->load->view('admin/home', $param);
    }

    public function save_leave_status() {
        $this->form_validation->set_rules('leave_status', 'Leave Status', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_massege(validation_errors(),2);
        } else {
            
            $data = array('company_id' => $this->company_id,
                'leave_status' => $this->input->post('leave_status'),                
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_leave_status', $data);

            if ($res) {
                echo $this->Common_model->show_massege('Data Insert Successful.', 1);
            } else {
                echo $this->Common_model->show_massege('Data Insert Not Successful.', 2);
            }
        }
    }

    function edit_leave_status() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
                
        $param['type']="2";
        $param['page_header']="Leave Status";	
        $param['module_id']=$this->module_id;
        
        $param['leave_query'] = $this->db->get_where('main_leave_status', array('id' => $id));
        
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addLeaveStatus.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function update_leave_status() {
        $this->form_validation->set_rules('leave_status', 'Leave Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_massege(validation_errors(),2);
        } else {
            
            $data = array('company_id' => $this->company_id,
               'leave_status' => $this->input->post('leave_status'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_leave_status', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege('This Post Edited Successfully',1);
            } else {
                echo $this->Common_model->show_massege('No Change found to update entry!',2);
            }
        }
    }

    public function delete_leave_status() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_leave_status", $id);
        redirect('con_LeaveStatus/');
        exit;
    }

}
