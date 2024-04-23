<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training_Achievement extends CI_Controller {

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
    public $companyView = false;

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
        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Training Achievement";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_achievement', array('company_id' => $this->company_id,'isactive' => 1 ));
        } else {
            $param['query'] = $this->db->get_where('main_training_achievement', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Achievement.php';
        $this->load->view('admin/home', $param);
        
    }
    
    public function add_Training_Achievement() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Training Achievement";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_status'] = $this->db->get_where('main_training_status', array('company_id' => $this->company_id,'isactive' => 1 ,'training_status' => 3));
        } else {
            $param['training_status'] = $this->db->get_where('main_training_status', array('isactive' => 1,'training_status' => 3));
        }
       
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Achievement.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_Training_Achievement() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_date', 'Date OF Training', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
           
            $data = array('company_id' => $this->company_id,
                'training_id' => $this->input->post('training_id'),
                'training_date' => $this->Common_model->convert_to_mysql_date($this->input->post('training_date')),
                'total_training_period' => $this->input->post('total_training_period'),
                'training_objective' => $this->input->post('training_objective'),
                'training_output' => $this->input->post('training_output'),
                'training_outcome' => $this->input->post('training_outcome'),
                'comments' => $this->input->post('comments'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_training_achievement', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
            
        }
    }
    
     function edit_Training_Achievement() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Training Achievement";
        $param['module_id'] = $this->module_id;
         // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_training_staus", $id, $this->company_id);
        }
        // check permission to view the employee ends

        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_status'] = $this->db->get_where('main_training_status', array('company_id' => $this->company_id,'isactive' => 1 ,'training_status' => 3));
        } else {
            $param['training_status'] = $this->db->get_where('main_training_status', array('isactive' => 1,'training_status' => 3));
        }

        $param['query'] = $this->db->get_where('main_training_achievement', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Achievement.php';
        $this->load->view('admin/home', $param);
    }
    
    public function update_Training_Achievement() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_date', 'Date OF Training', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $data = array('company_id' => $this->company_id,
                'training_id' => $this->input->post('training_id'),
                'training_date' => $this->Common_model->convert_to_mysql_date($this->input->post('training_date')),
                'total_training_period' => $this->input->post('total_training_period'),
                'training_objective' => $this->input->post('training_objective'),
                'training_output' => $this->input->post('training_output'),
                'training_outcome' => $this->input->post('training_outcome'),
                'comments' => $this->input->post('comments'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_training_achievement', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    
    public function delete_Training_Achievement() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_training_achievement", $id);
        redirect('Con_Training_Achievement/');
        exit;
    }
    
    
    
}
