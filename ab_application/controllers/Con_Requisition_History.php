<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Requisition_History extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_ids = array(), $search_criteria = array('requisition_id' => '','qualification' => '','skill_set' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Requisition History";
        $param['module_id'] = $this->module_id;
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;

        //$this->db->where('req_status !=', 0);
        //$this->db->where('is_close', 0);
        
        if (!empty($search_ids)) {
            $this->db->where_in('id', $search_ids);
        }
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
            $param['skill_query']=$this->db->get_where('main_skill_setup', array('company_id' => $this->company_id,'isactive' => 1)); 
        } else {
            $param['skill_query']=$this->db->get_where('main_skill_setup', array('isactive' => 1)); 
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
        }
        
        $this->db->select('qualification');
        $this->db->order_by('qualification', 'desc');
        $this->db->group_by('qualification');
        $param['qualification_query'] = $this->db->get('main_cv_management');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Requisition_History.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_requisition() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_id'] = $requisition_id = $this->input->post('requisition_id');
        $search_criteria['skill_set'] = $skill_set = $this->input->post('skill_set');
        $search_criteria['qualification'] = $qualification = $this->input->post('qualification');

        if (($requisition_id != '') || ($qualification != '') || ($skill_set != '')) {
     
            $this->db->select('id');
            $this->db->from('main_opening_position');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } else {
                $this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($requisition_id != '') {
                $this->db->where('id', $requisition_id);
            }
            if ($skill_set != '') {
                //$this->db->like('skill_set', $skill_set);
                $skill_set = explode(",", $skill_set);
                $skill_set = array_map('intval', $skill_set);
                $this->db->where_in('required_skills', $skill_set);
            }
            if ($qualification != '') {
                //$this->db->like('required_qualification', $qualification);
                //$this->db->like('skill_set', $skill_set);
                $qualification = explode(",", $qualification);
                $qualification = array_map('intval', $qualification);
                $this->db->where_in('required_qualification', $qualification);
            }
            
            $ids = $this->db->get()->result_array();
        }

        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
        
    }

    
    public function view_Requisition_History() {
        
        $req_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Requisition History";
        $param['module_id'] = $this->module_id;
        $param['req_id'] = $req_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$req_id));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $req_id));            
        }
        
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Histor_Details.php';
        $this->load->view('admin/home', $param);
    }
    
    


}
