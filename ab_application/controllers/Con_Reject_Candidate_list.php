<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Reject_Candidate_list extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('requisition_idd' => '')) {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Rejected Candidates List";
        $param['module_id']=$this->module_id;
   
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['opening_position_query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id, 'req_status' => 1, 'is_close' => 0)); //Approved
        } else {
            $param['opening_position_query'] = $this->db->get_where('main_opening_position', array('req_status' => 1, 'is_close' => 0)); //Approved
        }
        $param['resume_type'] = $this->Common_model->get_array('resume_type');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Reject_Candidate_list.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Reject_Candidate() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_idd'] = $requisition_idd = $this->input->post('requisition_idd');

        if (($requisition_idd != '') ) {
     
            $status='4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            
            $this->db->select('*');
            $this->db->from('main_cv_management');
            $this->db->where('is_notify', 0);
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } else {
                $this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($requisition_idd != '') {
                $this->db->where('requisition_id', $requisition_idd);
            }
           
            $search_data = $this->db->get()->result();
            
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
    public function notify_Reject_Candidate() {

        $this->form_validation->set_rules('rejected_id[]', 'Candidates', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->trans_begin();

            $candidate_id = $this->input->post("rejected_id");
            for ($i = 0; $i < count($candidate_id); $i++) {
                
                foreach ($candidate_id as $key => $val) {
                    $candidate = $this->db->get_where('main_cv_management', array('id' => $val))->row();
                    if ($candidate->candidate_email != "") {
                        $eres = $this->Sendmail_model->notify_Reject_mail($candidate->candidate_first_name, $candidate->candidate_email);
                    }
                }
            
                $cdata[] = array('id' => $candidate_id[$i],
                    'is_notify' => 1,
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
            }
            $res = $this->db->update_batch('main_cv_management', $cdata, 'id');

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(12, 1);
            } else {
                echo $this->Common_model->show_massege(13, 2);
            }
        }
    }

}

