<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_CV_Bank extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    public $companyView = false;
    
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
        $this->companyView = $this->user_data['company_view'];
        
        $this->load->model('Sendmail_model');
        
    }

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('requisition_id' => '','resume_type' => '','qualification' => '','skill_set' => '','experience' => '','status' => '')) {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
            
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "CV Bank";
        $param['module_id']=$this->module_id;

        $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
        $param['candidate_status'] = $this->Common_model->get_array('candidate_status');
        $param['resume_type'] = $this->Common_model->get_array('resume_type');
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
            $param['skill_query']=$this->db->get_where('main_skill_setup', array('company_id' => $this->company_id,'isactive' => 1)); 
        } else {
            $param['skill_query']=$this->db->get_where('main_skill_setup', array('isactive' => 1)); 
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
        }
        
        $this->db->select('work_experience');
        $this->db->order_by('work_experience', 'desc');
        $this->db->group_by('work_experience');
        $param['experience_query'] = $this->db->get('main_cv_management');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_CV_Bank.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_CV_Bank() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_id'] = $requisition_id = $this->input->post('requisition_id');
        $search_criteria['resume_type'] = $resume_type = $this->input->post('resume_type');
        $search_criteria['qualification'] = $qualification = $this->input->post('qualification');
        $search_criteria['experience'] = $experience = $this->input->post('experience');
        $search_criteria['skill_set'] = $skill_set = $this->input->post('skill_set');
        $search_criteria['status'] = $status = $this->input->post('status');
        
        if (($requisition_id != '') || ($resume_type != '') || ($status != '') || ($qualification != '') || ($experience != '') || ($skill_set != '')) {
     
            $this->db->select('*');
            $this->db->from('main_cv_management');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } 
            
            /* ----Conditions---- */
            if ($requisition_id != '') {
                $this->db->where('requisition_id', $requisition_id);
            }
            if ($resume_type != '') {
                $this->db->where('resume_type', $resume_type);
            }
            if ($status != '') {
                $this->db->where('status', $status);
            }
            if ($qualification != '') {
                $qualification = explode(",", $qualification);
                $qualification = array_map('intval', $qualification);
                $this->db->where_in('qualification', $qualification);
            }
            if ($experience != '') {
                $this->db->like('work_experience', $experience);
            }
            if ($skill_set != '') {
                $skill_set = explode(",", $skill_set);
                $skill_set = array_map('intval', $skill_set);
                $this->db->where_in('skill_set', $skill_set);
            }
            
            $search_data = $this->db->get()->result();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
   
    public function download_resume() {
        $resume_path = $this->uri->segment(3);
        if($resume_path!="")
        {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/candidate_resume/' . $resume_path));
            $url = Get_File_Directory('/uploads/candidate_resume/' . $resume_path);
            $data = file_get_contents($url);
            force_download($resume_path, $data);
        }
    }
    
    public function view_CVManagement() {
        
        $cvm_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "CV Management";
        $param['module_id'] = $this->module_id;
        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_CV", $this->uri->segment(3), $this->company_id);
        }
        // check permission to view the employee ends
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'company_id' => $this->company_id)); //Approved
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
        } else {
           $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved
           $param['employees_query'] = $this->Common_model->listItem('main_employees');
        }

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id,'id' =>$cvm_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_cv_management', array('id' => $cvm_id ));            
        }        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_CVmanagementDetail.php';
        $this->load->view('admin/home', $param);
    }
    
    
}

