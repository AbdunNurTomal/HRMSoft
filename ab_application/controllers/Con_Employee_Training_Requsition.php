<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_Training_Requsition extends CI_Controller {

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
        $param['page_header'] = "Training Requsition";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) { //Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
        } else if($this->user_group == 10) { //self user
            $emp_id = $this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id,'main_employees','employee_id');

            $this->db->where_in('employee', $emp_id);
            $trainss = $this->db->get('main_employee_training_requisition')->result_array();
            $tids = array_column($trainss, 'training_id');

            if ($tids) {
                if (!empty($tids)) {
                    $this->db->where_not_in('id', $tids);
                }
            }
            $this->db->join("main_training_requisition", "main_training_requisition.training_id = main_new_training.id");
            $this->db->like('main_training_requisition.employee', $emp_id);
            $param['query'] = $this->db->get_where('main_new_training', array(
                                                'main_new_training.company_id' => $this->company_id,
                                                'main_new_training.isactive' => 1
                                            ));
        } else {
            $param['query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
        }
        $this->db->order_by('id', 'ASC');
        // echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Employee_Training_Requsition.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_Employee_Training_Requsition() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $param['training_id'] = $this->uri->segment(3);
        
        $param['type'] = "1";
        $param['page_header'] = "Training Requsition";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
            //$param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.company_id' => $this->company_id,'main_employees.isactive' => 1));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 

        } else if($this->user_group == 10) {//self user
            $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
            
            $emp_id=$this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id,'main_employees','employee_id');
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.isactive' => 1,'main_employees.employee_id' => $emp_id));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 
        }
        else {
            $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
            //$param['employees_query'] = $this->db->get_where('main_employees', array('isactive' => 1));
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.isactive' => 1));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 
        }
        //echo $this->db->last_query();
       
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addEmployee_Training_Requisition.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_Training_Requisition() {
        
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('proposed_date', 'Proposed Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('training_objective', 'Training Objective', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $employees = '';
            if($this->input->post("employee_id"))
            {
                foreach ($this->input->post("employee_id") as $emp) {
                    if ($employees == '') {
                        $employees = $emp;
                    } else {
                        $employees = $employees . "," . $emp;
                    }
                }
            }
            
            $data = array('company_id' => $this->company_id,
                'proposed_date' => $this->Common_model->convert_to_mysql_date($this->input->post('proposed_date')),
                'training_id' => $this->input->post('training_id'),
                'employee' => $employees,
                'training_objective' => $this->input->post('training_objective'),
                //'training_output' => $this->input->post('training_output'),
                //'training_outcome' => $this->input->post('training_outcome'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_employee_training_requisition', $data);
            
            if($this->input->post("employee_id"))
            {
                //$proposed_date=$this->Common_model->convert_to_mysql_date($this->input->post('proposed_date'));
                //$eres = $this->Sendmail_model->training_send_mail($this->input->post("employee_id"),$proposed_date);
            }
            
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
            
        }
    }
    
     
}
