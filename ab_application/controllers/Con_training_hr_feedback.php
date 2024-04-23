<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_training_hr_feedback extends CI_Controller {

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
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Training Feedback";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_status', array('company_id' => $this->company_id,'training_status' => 3,'hr_feedback_status' => 0 ,'isactive' => 1 ));
        } else {
            $param['query'] = $this->db->get_where('main_training_status', array('training_status' => 3,'hr_feedback_status' => 0 ,'isactive' => 1));
        }
        //echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_training_hr_feedback.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_Training_hr_Feedback() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        
        $param['training_id']= $this->uri->segment(3);
        $param['type'] = "1";
        $param['page_header'] = "Training Feedback";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_status'] = $this->db->get_where('main_training_status', array('company_id' => $this->company_id,'isactive' => 1 ,'training_status' => 3));
        } else {
            $param['training_status'] = $this->db->get_where('main_training_status', array('isactive' => 1,'training_status' => 3));
        }
       
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_hr_Feedback.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_Training_hr_Feedback() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('employee_id', 'Participant Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
           
            $data = array('company_id' => $this->company_id,
                'feedback_type' => 1,
                'training_id' => $this->input->post('training_id'),
                //'employee_id' => $this->input->post('employee_id'),
                'training_date' => $this->Common_model->convert_to_mysql_date($this->input->post('training_date')),
                'total_training_period' => $this->input->post('total_training_period'),
                'comments' => $this->input->post('comments'),
                'usefulforyou' => $this->input->post('usefulforyou'),
                'easytofollow' => $this->input->post('easytofollow'),
                'understandable' => $this->input->post('understandable'),
                'effectivemanner' => $this->input->post('effectivemanner'),
                'organisationinfuture' => $this->input->post('organisationinfuture'),
                'trainingoverall' => $this->input->post('trainingoverall'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_training_feedback', $data);
            
            $udata = array('hr_feedback_status' => 1 );
            $ures = $this->Common_model->update_data('main_training_status', $udata, array('training_id' => $this->input->post('training_id')));

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }
    
     function edit_Training_hr_Feedback() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Training Feedback";
        $param['module_id'] = $this->module_id;

         // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_training_feedback", $rid, $this->company_id);
        }
        // check permission to view the employee ends
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_status'] = $this->db->get_where('main_training_status', array('company_id' => $this->company_id,'isactive' => 1 ,'training_status' => 3));
        } else {
            $param['training_status'] = $this->db->get_where('main_training_status', array('isactive' => 1,'training_status' => 3));
        }

        $param['query'] = $this->db->get_where('main_training_feedback', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_hr_Feedback.php';
        $this->load->view('admin/home', $param);
    }
    
    public function update_Training_hr_Feedback() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('employee_id', 'Participant Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $data = array('company_id' => $this->company_id,
                'feedback_type' => 1,
                'training_id' => $this->input->post('training_id'),
                //'employee_id' => $this->input->post('employee_id'),
                'training_date' => $this->Common_model->convert_to_mysql_date($this->input->post('training_date')),
                'total_training_period' => $this->input->post('total_training_period'),
                'comments' => $this->input->post('comments'),
                'usefulforyou' => $this->input->post('usefulforyou'),
                'easytofollow' => $this->input->post('easytofollow'),
                'understandable' => $this->input->post('understandable'),
                'effectivemanner' => $this->input->post('effectivemanner'),
                'organisationinfuture' => $this->input->post('organisationinfuture'),
                'trainingoverall' => $this->input->post('trainingoverall'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_training_feedback', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    //delete_Training_Feedback
    
    public function delete_Training_hr_Feedback() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_training_feedback", $id);
        redirect('Con_training_hr_feedback/');
        exit;
    }
    
    
    public function load_participant_name() {
        $id = $this->uri->segment(3);
        
        $this->db->select('*');
        $this->db->from('main_training_status');
        $this->db->join('main_training_status_details', 'main_training_status.id = main_training_status_details.master_id');
        $this->db->where(array('main_training_status.training_id ' => $id));
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                $emp_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name');
                print"<option value=" . $row->employee_id . ">" . $emp_name . "</option>";
            }
        } else {
            echo"<option> No Employee Added </option>";
        }
    }
    
}
