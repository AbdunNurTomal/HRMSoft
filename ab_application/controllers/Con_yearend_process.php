<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_yearend_process extends CI_Controller {

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
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('employee_id' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;

        if($menu_id==0){
            $param['menu_id'] = $this->menu_id;
        }else{
            $param['menu_id'] = $menu_id;
        }
        
        $param['page_header'] = "Year End Process";
        $param['module_id'] = $this->module_id;

        if(empty($search_data)){
            if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
                $param['query'] = $this->db->get_where('main_yearend_process', array('company_id' => $this->company_id,'isactive' => 1))->result();
            } else {
                $param['query'] = $this->db->get_where('main_yearend_process', array('isactive' => 1))->result();
            }
        }else{
            $param['query']=$search_data;
        }
        
        
        if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {//                                      
            $sql = "SELECT DISTINCT employee_id FROM main_employees WHERE company_id=".$this->company_id;
            $param['amployee']=$this->db->query($sql);
        } else {                                   
            $sql = "SELECT DISTINCT employee_id FROM main_employees";
            $param['amployee']=$this->db->query($sql);
        }
        //echo $this->db->last_query(); 

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'self_service/view_yearend_process.php';
        $this->load->view('admin/home', $param);
    }
    
    public function total_status($id = null) {
        $leave_status = $this->Common_model->get_array('approver_status');
        
        if ($id != null) {
            $query = $this->db->get_where('main_leave_request', array('leave_status' => $id));
        } else {
            if ($this->user_type == 2) {
            $query = $this->db->get_where('main_leave_request', array('company_id' => $this->company_id));
        } else {
            $query = $this->db->get('main_leave_request');
        }
        }

        if ($query->num_rows() > 0) {
            $sr = 0;
            foreach ($query->result() as $row) {
                $sr = $sr + 1;
                print"<tr><td>" . $sr . "</td><td>" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'last_name') . "</td><td>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td><td>" . date('m-d-Y',strtotime($row->createddate)) . "</td><td>" . $row->available_leaves . "</td><td>" . $row->applied_hour . "</td><td>" . ucwords($row->reason) . "</td><td>" . $leave_status[$row->leave_status] . "</td></tr>";
            }
        } else {
            echo'<tr><td colspan = 8 class="text-info">No Plan added.</td></tr>';
        }
    }

    public function yearend_process() {
        //$leave_status = $this->Common_model->get_array('approver_status');

        //$leave = $this->input->post('leave_status');
        $closing_date = $this->input->post('closing_date');
        //$employee_id = $this->input->post('employee_id');
        //$to_datee = $this->Common_model->convert_to_mysql_date($this->input->post('to_date'));
        //$from_datee = $this->Common_model->convert_to_mysql_date($this->input->post('from_date'));

//        if ($leave == "") {
//            $leave_statusc = "";
//        } else {
//            $leave_statusc = $this->input->post('leave_status');
//        }
//        if ($employee == "") {
//            $employe = "";
//        } else {
//            $employe = $employee;
//        }
//        if ($from_datee == "") {
//            $from_date = "";
//        } else {
//            $from_date = $from_datee;
//        }
//        if ($to_datee == "") {
//            $to_date = "";
//        } else {
//            $to_date = $to_datee;
//        } 

//         if ($this->user_group == 12) {

//             $this->db->select("*");
//             $this->db->from("main_leave_request");
//             $this->db->where('company_id', $this->company_id);
//             if($leave!=""){
//             $this->db->where('leave_status', $leave);
//             }if($employee){
//             $this->db->where('employee_id', $employee);
//             }if($from_datee){
//             $this->db->where('from_date >=', $from_datee);
//             }if($to_datee){
//             $this->db->where('to_date <=', $to_datee);
//             }
//             $query = $this->db->get();
// //            echo $this->db->last_query($query);exit();
//         } else {
//             $this->db->select("*");
//             $this->db->from("main_leave_request");
//             if($leave!=""){
//             $this->db->where('leave_status', $leave);
//             }if($employee){
//             $this->db->where('employee_id', $employee);
//             }if($from_datee){
//             $this->db->where('from_date >=', $from_datee);
//             }if($to_datee){
//             $this->db->where('to_date <=', $to_datee);
//             }
//             $query = $this->db->get();
//         }
        
//         //echo $this->db->last_query();exit();

//         if ($query->num_rows() > 0) {
//             $sr = 0;
//             foreach ($query->result() as $row) {
//                 $sr++;
//                 print"<tr><td>" . $sr . "</td><td>" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'last_name') . "</td><td>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td><td>" . date('m-d-Y',strtotime($row->createddate)) . "</td><td>" . $row->available_leaves . "</td><td>" . $row->applied_hour . "</td><td>" . ucwords($row->reason) . "</td><td>" . $leave_status[$row->leave_status] . "</td></tr>";
//             }
//         } else {
//             echo'<tr><td colspan = 8 class="text-info">No Plan added.</td></tr>';
//         }

            $dates = explode("-", $closing_date);
            $yr= $dates[2];

            $query = $this->db->get_where('main_yearend_process', array('year' => $yr, 'company_id' => $this->company_id));
            $count = $query->num_rows();

            if($count>0){
                echo $this->Common_model->show_validation_massege('This Year Already Processed . ', 2);
                exit();
            }

            //$this->db->select('first_name, middle_name, last_name');isactive
            $query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
            //echo $this->db->last_query();

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $this->Common_model->employee_pto_yearend_process($row->employee_id, $closing_date);
                }
            }

            echo $this->Common_model->show_massege(22, 1);

            // redirect('Con_yearend_process/', 'refresh');
            // exit;
            

    }


    public function search_employee() {
        
        $ids = $search_criteria = array();

        $search_criteria['employee_id'] = $employee_id = $this->input->post('employee_id');
       
        
        if ($employee_id != '') {
            $this->db->select('*');
            $this->db->from('main_yearend_process');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } 
            
            /* ----Conditions---- */
            if ($employee_id != '') {
                $this->db->where('employee_id', $employee_id);
            }
            
            $search_data = $this->db->get()->result();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }


    public function ajax_edit_yearend_process() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_yearend_process', $id);
        echo json_encode($data);
    }

    public function edit_yearend_process() {

        $this->form_validation->set_rules('carry_balance', 'Carry Balance', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array(
                'carry_balance' => $this->input->post('carry_balance'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_yearend_process', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    

}
