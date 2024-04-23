<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Interview_Result extends CI_Controller {

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
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];
        
        $this->load->model('Sendmail_model');
        
    }

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('requisition_idd' => '','rating_id' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Interview Result";
        $param['module_id']=$this->module_id;
        
//        if (!empty($search_ids)) {
//            $this->db->where_in('id', $search_ids);
//        }
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
//            $param['query'] = $this->db->get_where('main_candidate_interview', array('company_id' => $this->company_id,'isactive' => 1,'is_close' => 0));
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'req_status' => 1,'is_close' => 0)); //Approved
        } else {
//            $param['query'] = $this->db->get_where('main_candidate_interview', array('isactive' => 1,'is_close' => 0));
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
        }
        
        $param['rating_array'] = $this->Common_model->get_array('rating_array');
        $param['resume_type'] = $this->Common_model->get_array('resume_type');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Result.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Interview_Result() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_idd'] = $requisition_idd = $this->input->post('requisition_idd');
        $search_criteria['rating_id'] = $rating_id = $this->input->post('rating_id');

        if (($requisition_idd != '') || ($rating_id != '')) {
     
            $this->db->select('*');
            $this->db->from('main_candidate_interview');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } else {
                $this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($requisition_idd != '') {
                $this->db->where('requisition_id', $requisition_idd);
            }
            if ($rating_id != '') {
                $this->db->where('rating_id', $rating_id);
            }
           
            $search_data = $this->db->get()->result();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
    
    
}

