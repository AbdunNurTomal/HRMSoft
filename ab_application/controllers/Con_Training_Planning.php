<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training_Planning extends CI_Controller {

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
        $param['page_header'] = "Training Scheduling";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_planning', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_training_planning', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Planning.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Training_Planning() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Training Scheduling";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Planning.php';
        $this->load->view('admin/home', $param);
    }
    

    public function save_Training_Planning() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_location', 'Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_date', 'Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_time', 'Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $data = array('company_id' => $this->company_id,
                'training_id' => $this->input->post('training_id'),
                'training_location' => $this->input->post('training_location'),
                'training_date' => $this->Common_model->convert_to_mysql_date($this->input->post('training_date')),
                'training_time' => $this->input->post('training_time'),
                'instructor' => $this->input->post('instructor'),
                'training_cost' => $this->input->post('training_cost'),
                'facilitator' => $this->input->post('facilitator'),
                'capacity' => $this->input->post('capacity'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_training_planning', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Training_Planning() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Training Scheduling";
        $param['module_id'] = $this->module_id;
         // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_training", $id, $this->company_id);
        }
        // check permission to view the employee ends
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
        }

        $param['query'] = $this->db->get_where('main_training_planning', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Planning.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Training_Planning() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_location', 'Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_date', 'Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_time', 'Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $data = array('company_id' => $this->company_id,
                'training_id' => $this->input->post('training_id'),
                'training_location' => $this->input->post('training_location'),
                'training_date' => $this->Common_model->convert_to_mysql_date($this->input->post('training_date')),
                'training_time' => $this->input->post('training_time'),
                'instructor' => $this->input->post('instructor'),
                'training_cost' => $this->input->post('training_cost'),
                'facilitator' => $this->input->post('facilitator'),
                'capacity' => $this->input->post('capacity'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_training_planning', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_Training_Planning() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_training_planning", $id);
        redirect('Con_Training_Planning/');
        exit;
    }
    

}
