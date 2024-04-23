<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training_Status extends CI_Controller {

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
        $param['page_header'] = "Training Status";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1,'req_status' => 1 ));
        } else {
            $param['query'] = $this->db->get_where('main_training_requisition', array('isactive' => 1,'req_status' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Status.php';
        $this->load->view('admin/home', $param);
    }
    
     function edit_Training_Status() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        
        $status_query=$this->db->get_where('main_training_status', array('training_requisition_id ' => $id));
        if($status_query->num_rows() > 0)
        {
            $param['type'] = "2";
            $param['query'] = $status_query;
        }
        else {
            
             $param['type'] = "1";
             $param['query'] = $this->db->get_where('main_training_requisition', array('id' => $id));
             
        }

        $param['page_header'] = "Training Status";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Status.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Training_Status() {
        
        $this->form_validation->set_rules('training_status', 'Training Status', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('company_id' => $this->company_id,
                'training_id' => $this->input->post('training_id'),
                'training_requisition_id' => $this->input->post('training_requisition_id'),
                'training_status' => $this->input->post('training_status'),
                'certification' => $this->input->post('certification'),
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                'comments' => $this->input->post('comments'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            
            $res = $this->Common_model->insert_data('main_training_status', $data);
            
            $emp_ids = $this->input->post("emp_id");
            for ($i = 0; $i < count($emp_ids); $i++) {
                $edata[] = array('company_id' => $this->company_id,
                    'master_id' => $this->db->insert_id(),      
                    'employee_id' => $emp_ids[$i],
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );                
            } 
            
            $eres = $this->db->insert_batch('main_training_status_details', $edata); 
            
            $udata = array('training_status' => $this->input->post('training_status') );
            $ures = $this->Common_model->update_data('main_training_requisition', $udata, array('id' => $this->input->post('training_requisition_id')));
            
            
            if ($res && $eres) {
                $trquery = $this->db->get_where('main_new_training', array('id' => $this->input->post('training_id')))->row();
                
                $emptbl_ids = $this->input->post("emp_id");
                for ($i = 0; $i < count($emptbl_ids); $i++) {
                    $empdata[] = array('company_id' => $this->company_id,
                        'employee_id' => $emptbl_ids[$i],
                        'course_name' => $trquery->training_name,
                        'course_level' => $trquery->training_level,
                        'certification_name' => $this->input->post('certification'),
                        'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                        'description' => $this->input->post('comments'),
                        'training_type' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                }

               $empres = $this->db->insert_batch('main_emp_certification', $empdata); 
                
            }
            
            if ($res && $eres) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
            
        }
    }
    
    
    public function update_Training_Status() {
        
        $this->form_validation->set_rules('training_status', 'Training Status', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('company_id' => $this->company_id,
                'training_id' => $this->input->post('training_id'),
                'training_requisition_id' => $this->input->post('training_requisition_id'),
                'training_status' => $this->input->post('training_status'),
                'certification' => $this->input->post('certification'),
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                'comments' => $this->input->post('comments'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );
            
            $res = $this->Common_model->update_data('main_training_status', $data, array('id' => $this->input->post('id')));
            
            if($res)
            {
                $emp_del=$this->db->delete('main_training_status_details', array('master_id' => $this->input->post('id')));
            }
            
            if($emp_del)
            {
                $emp_ids = $this->input->post("emp_id");
                for ($i = 0; $i < count($emp_ids); $i++) {
                    $edata[] = array('company_id' => $this->company_id,
                        'master_id' => $this->input->post('id'),      
                        'employee_id' => $emp_ids[$i],
                        'modifiedby' => $this->user_id,
                        'modifieddate' => $this->date_time,
                        'isactive' => '1',
                    );                
                } 

                $eres = $this->db->insert_batch('main_training_status_details', $edata); 
            }
            
            $udata = array('training_status' => $this->input->post('training_status') );
            $ures = $this->Common_model->update_data('main_training_requisition', $udata, array('id' => $this->input->post('training_requisition_id')));
            
            
             if ($res && $eres) {
                $trquery = $this->db->get_where('main_new_training', array('id' => $this->input->post('training_id')))->row();
                
                $emptbl_ids = $this->input->post("emp_id");
                for ($i = 0; $i < count($emptbl_ids); $i++) {
                    $empdata[] = array('company_id' => $this->company_id,
                        'employee_id' => $emptbl_ids[$i],
                        'course_name' => $trquery->training_name,
                        'course_level' => $trquery->training_level,
                        'certification_name' => $this->input->post('certification'),
                        'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                        'description' => $this->input->post('comments'),
                        'training_type' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                }

               $empres = $this->db->insert_batch('main_emp_certification', $empdata); 
                
            }
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
}
