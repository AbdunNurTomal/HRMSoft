<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Position_ot extends CI_Controller {

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
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
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
        $param['page_header'] = "Position OT";
        $param['module_id']=$this->module_id;;
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_position_ot', array('company_id' => $this->company_id,'isactive' => 1));
            $param['position_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_position_ot', array('isactive' => 1));
            $param['position_query'] = $this->db->get_where('main_positions', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'attendance/view_PositionOt.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_Position_OT() 
    {
        $this->form_validation->set_rules('position_id', 'Position', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contract_hour', 'Contract Hour', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('max_ot_hour', 'Max OT Hour', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('ot_allow_hour', 'OT Allow Hour', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('company_id' => $this->company_id,
                'position_id' => $this->input->post('position_id'),
                'contract_hour' => $this->input->post('contract_hour'),
                'max_ot_hour' => $this->input->post('max_ot_hour'),
                'ot_allow_hour' => $this->input->post('ot_allow_hour'),
                'status' => $this->input->post('status'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->insert_data('main_position_ot',$data);
            
            if ($res) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
         
    }
    
    function ajax_edit_position() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_position_ot', $id);
        echo json_encode($data);
    }
    
    public function update_Position_OT() 
    {
        $this->form_validation->set_rules('position_id', 'Position', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contract_hour', 'Contract Hour', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('max_ot_hour', 'Max OT Hour', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('ot_allow_hour', 'OT Allow Hour', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('company_id' => $this->company_id,
                'position_id' => $this->input->post('position_id'),
                'contract_hour' => $this->input->post('contract_hour'),
                'max_ot_hour' => $this->input->post('max_ot_hour'),
                'ot_allow_hour' => $this->input->post('ot_allow_hour'),
                'status' => $this->input->post('status'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->update_data('main_position_ot',$data,array('id' => $this->input->post('ot_position_id')));
            
             if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    public function delete_group() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_holiday_group", $id);
        redirect('Con_Manageholidaygroup/');
        exit;
    }
    
    
}

