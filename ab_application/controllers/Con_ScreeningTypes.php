<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Screeningtypes extends CI_Controller {

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
    public $companyView = false;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->user_group = $this->user_data['user_group'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Screening Type";
        $param['module_id']=$this->module_id;
        
        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_screening_types', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_screening_types', array('isactive' => 1));
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_ScreeningTypes.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_screening_types() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type'] = "1";
        $param['page_header'] = "Screening Type";
        $param['module_id']=$this->module_id;;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_addScreeningTypes.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_screening_types() 
    {
         $this->form_validation->set_rules('screening_type', 'Screening Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        }  
        else 
        {
            $data = array('company_id' => $this->company_id,
                'screening_type' => $this->input->post('screening_type'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->insert_data('main_screening_types',$data);
            
            if ($res) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
         
    }
    
    function edit_screening_types() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        
        $param['type']="2";
        $param['page_header']="Screening Type";	
        $param['module_id']=$this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_screening", $id, $this->company_id);
        }
        // check permission to view the employee ends

        $param['query'] = $this->db->get_where('main_screening_types', array('id' => $id));

	    $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_addScreeningTypes.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function update_screening_types() 
    {
       $this->form_validation->set_rules('screening_type', 'Screening Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        }  
        else 
        {
            $data = array('company_id' => $this->company_id,
                'screening_type' => $this->input->post('screening_type'),
                'description' => $this->input->post('description'),                
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->update_data('main_screening_types',$data,array('id' => $this->input->post('id')));
            
             if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    public function delete_screening_types() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_screening_types", $id);
        redirect('Con_ScreeningTypes/');
        exit;
    }
    
    
}

