<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Short_List_Candidate extends CI_Controller {

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

    public function index() {
       $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Shortlisted Candidates";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $status='2';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id,'isactive' => 1,'is_close' => 0));
        } else {
            $status='2';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            $param['query'] = $this->db->get_where('main_cv_management', array('isactive' => 1,'is_close' => 0));
        }
        //echo $this->db->last_query();
        
        $param['resume_type'] = $this->Common_model->get_array('resume_type');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Short_List_Candidate.php';
        $this->load->view('admin/home', $param);
    }
    
    function edit_SelectedCandidates() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        $requisition_id = $this->uri->segment(4);
        
        $param['type']="2";
        $param['page_header']="Shortlisted Candidates";	
        $param['module_id']=$this->module_id;

        $param['query'] = $this->db->get_where('main_cv_management', array('id' => $id));
        //echo $this->db->last_query();
        $param['interviewquery'] = $this->db->get_where('main_candidate_interview', array('requisition_id' => $requisition_id,'candidate_id' => $id,));
        //echo $this->db->last_query();
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addSelectedCandidates.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function update_SelectedCandidates(){
        
        $this->form_validation->set_rules('candidate_status', 'Candidate Status','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
          
            $this->db->trans_begin();
            
            $cdata = array('status' => $this->input->post('candidate_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $cres=$this->Common_model->update_data('main_cv_management',$cdata,array('id' => $this->input->post('candidate_id'),'requisition_id' => $this->input->post('requisition_id')));
            
            $idata = array('candidate_status' => $this->input->post('candidate_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $cres=$this->Common_model->update_data('main_candidate_interview',$idata,array('candidate_id' => $this->input->post('candidate_id'),'requisition_id' => $this->input->post('requisition_id')));
            
            $query = $this->db->get_where('main_cv_management', array('id' => $this->input->post('candidate_id'),'requisition_id' => $this->input->post('requisition_id'),'status' => 3))->row(); 
            $res2=$this->Sendmail_model->selected_candidate_send_mail($query->candidate_first_name,$query->candidate_email,'123456');
            
//            if($this->input->post('candidate_status')==3)//candidate_status 3 = selected//status
//            {
//                if($cres)
//                {
//                    $query = $this->db->get_where('main_cv_management', array('id' => $this->input->post('candidate_id'),'requisition_id' => $this->input->post('requisition_id'),'status' => 3))->row(); 
//
//                    $data = array('company_id' => $this->company_id,
//                        'email' => $query->candidate_email,
//                        'name' => $query->candidate_first_name,
//                        'password' => $this->Common_model->encrypt('123456'),
//                        'phone_no' => $query->contact_number,
//                        'user_group' => '10',
//                        'user_type' => '1',
//                        'createdby' => $this->user_id,
//                        'createddate' => $this->date_time,
//                        'isactive' => 1,
//                    );
//
//                    $res = $this->Common_model->insert_data('main_users', $data);
//                    if($res)
//                    {
//                        $res2=$this->Sendmail_model->selected_candidate_send_mail($query->candidate_first_name,$query->candidate_email,'123456');
//                    }
// 
//                }
//            }
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    
    public function update_Candidate_Status(){
        
        $this->form_validation->set_rules('candidate_status', 'Candidate Status','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_id[]', 'candidate', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            
            $this->db->trans_begin();
            
            $candidate_id = $this->input->post("candidate_id");
            for ($i = 0; $i < count($candidate_id); $i++) {
          
                $cdata[] = array('id' => $candidate_id[$i],
                    'status' => $this->input->post('candidate_status'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
                
                $idata[] = array('candidate_id' => $candidate_id[$i],
                    'candidate_status' => $this->input->post('candidate_status'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
            }
            
            $res = $this->db->update_batch('main_cv_management', $cdata, 'id');
            $res = $this->db->update_batch('main_candidate_interview', $idata, 'candidate_id');
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    
}

