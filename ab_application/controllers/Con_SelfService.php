<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_SelfService extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_group = null;
    public $module_id = null;
    public $date_time = null;
    public $module_data = array();
    public $companyView = false;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('hr_logged_in')) {
            redirect('chome/logout', 'refresh');
        }

        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        if (!$this->user_id) {
            redirect('chome/logout', 'refresh');
        }

        if ($this->uri->segment(3)) {
            $this->module_id = $this->uri->segment(3);
        }

        if (!$this->module_id) {
            $param['module_id'] = 2;
        } else {
            $param['module_id'] = $this->module_id;
        }

        // check module access starts
        $currentModuleId = 2; // Self-Service
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkModuleAccess($this->user_group, $currentModuleId, $this->user_module);
        }
        // check module access ends

        $module_session_array = array('module_id' => $param['module_id']);
        $this->session->set_userdata('active_module_id', $module_session_array);

        $param['user_id'] = $this->user_id;
        $param['user_group'] = $this->user_group;
        $param['page_header'] = "Self Service";

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'sadmin/view_SelfService_dashbord.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_electronic_form() {

        $this->form_validation->set_rules('scanvasData', 'Signature', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->trans_begin();
            
            $employee_id=$this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id,'main_employees','employee_id');
            
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_consent');
            if ($query->num_rows() > 0) {
                //echo $this->Common_model->show_validation_massege('This employee already Update ELECTRONIC SIGNATURES.', 2);
                //exit();
                
                $data = array('signature' => $this->input->post('scanvasData'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
                 
                $res = $this->Common_model->update_data('main_consent', $data, array('employee_id' => $employee_id));
                
                $res2 = $this->Common_model->update_data('main_employees', array('emp_signature' => $this->input->post('scanvasData')), array('employee_id' => $employee_id));
                
            }
            else
            {
                $data = array('company_id' => $this->company_id,
                    'user_id' => $this->user_id,
                    'employee_id' => $employee_id,
                    'signature' => $this->input->post('scanvasData'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
                $res = $this->Common_model->insert_data('main_consent', $data);
                
                $res2 = $this->Common_model->update_data('main_employees', array('emp_signature' => $this->input->post('scanvasData')), array('employee_id' => $employee_id));

            }
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }

            if ($flag) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

}
