<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_EmpCandidateScreening extends CI_Controller {

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
    
    public $screeningtypes= null;
    public $companyView = false;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        if($this->user_type==2){ $this->company_id=$this->company_id;} else { $this->company_id=""; }
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Employee Candidate Screening";
        $param['module_id']=$this->module_id;
        
        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_bgcheckdetails', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_bgcheckdetails', array('isactive' => 1));
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_EmpCandidateScreening.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_EmpCandidateScreening() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type'] = "1";
        $param['page_header'] = "Employee Candidate Screening";
        $param['module_id']=$this->module_id;
        
         if ($this->user_type == 2) {
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $param['screening_types_query'] = $this->db->get_where('main_screening_types', array('company_id' => $this->company_id));
            $param['agencies_query'] = $this->db->get_where('main_agencies', array('company_id' => $this->company_id));
        } else {
            $param['employees_query'] = $this->db->get('main_employees');
            $param['screening_types_query'] = $this->db->get('main_screening_types');
            $param['agencies_query'] = $this->db->get('main_agencies');
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_addEmpCandidateScreening.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_EmpCandidateScreening() 
    {
        $this->form_validation->set_rules('employee_candidate','Employee','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('agency_id','Agency','required',array('required'=> "Please the enter required field, for more Info : %s."));
         
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            
            if($this->input->post("screeningtypes"))
            {
                $k=0;
                foreach ($this->input->post("screeningtypes") as $key) {
                    if ($k==0){ $this->screeningtypes =$key; } else { $this->screeningtypes = $this->screeningtypes .",".$key; }
                    $k++;
                }
            }
            
            
            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee_candidate'),
                'screening_types' => $this->screeningtypes,
                'agency_id' => $this->input->post('agency_id'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->insert_data('main_bgcheckdetails',$data);
            
            if ($res) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
         
    }
    
    function edit_EmpCandidateScreening() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        
        $param['type']="2";
        $param['page_header']="Employee Candidate Screening";	
        $param['module_id']=$this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_check", $id, $this->company_id);
        }
        // check permission to view the employee ends

        $param['query'] = $this->db->get_where('main_bgcheckdetails', array('id' => $id));
        
        if ($this->user_type == 2) {
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $param['screening_types_query'] = $this->db->get_where('main_screening_types', array('company_id' => $this->company_id));
            $param['agencies_query'] = $this->db->get_where('main_agencies', array('company_id' => $this->company_id));
        } else {
            $param['employees_query'] = $this->db->get('main_employees');
            $param['screening_types_query'] = $this->db->get('main_screening_types');
            $param['agencies_query'] = $this->db->get('main_agencies');
        }
        
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_addEmpCandidateScreening.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function update_EmpCandidateScreening() 
    {
        $this->form_validation->set_rules('employee_candidate','Employee','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('agency_id', 'Agency','required',array('required'=> "Please the enter required field, for more Info : %s."));
         
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            if($this->input->post("screeningtypes"))
            {
                $k=0;
                foreach ($this->input->post("screeningtypes") as $key) {
                    if ($k==0){ $this->screeningtypes =$key; } else { $this->screeningtypes = $this->screeningtypes .",".$key; }
                    $k++;
                }
            }
            
            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee_candidate'),
                'screening_types' => $this->screeningtypes,
                'agency_id' => $this->input->post('agency_id'),            
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->update_data('main_bgcheckdetails',$data,array('employee_id' => $this->input->post('employee_candidate')));
            
             if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    public function delete_EmpCandidateScreening() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_bgcheckdetails", $id);
        redirect('con_EmpCandidateScreening/');
        exit;
    }
    
    
}

