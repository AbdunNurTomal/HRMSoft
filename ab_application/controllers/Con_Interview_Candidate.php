<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Interview_Candidate extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('requisition_idd' => '','schedule_group' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Interview Panel";
        $param['module_id']=$this->module_id;
        
//        if (!empty($search_ids)) {
//            $this->db->where_in('id', $search_ids);
//        }
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
//            $status='0,4';
//            $status = explode(",", $status);
//            $status_id = array_map('intval', $status);
//            $this->db->where_in('interview_status', $status_id);
//            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'isactive' => 1,'is_close' => 0));
//        
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'req_status' => 1,'is_close' => 0)); //Approved
        } else {
//            $status='0,4';
//            $status = explode(",", $status);
//            $status_id = array_map('intval', $status);
//            $this->db->where_in('interview_status', $status_id);
//            $param['query'] = $this->db->get_where('main_interview_schedule', array('isactive' => 1,'is_close' => 0));
//            
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
        }
        
        $param['resume_type'] = $this->Common_model->get_array('resume_type');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Candidate.php';
        $this->load->view('admin/home', $param);
    }
    
    public function load_schedule_group() {
        
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_schedule', array('isactive' => 1, 'requisition_id' => $id));

        print"<option></option>";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->schedule_group . "</option>";
            }
        } else {
            echo"<option> No schedule group add </option>";
        }
        
    }
    
    public function search_for_Interview() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_idd'] = $requisition_idd = $this->input->post('requisition_idd');
        $search_criteria['schedule_group'] = $schedule_group = $this->input->post('schedule_group');

        if (($requisition_idd != '') || ($schedule_group != '')) {
     
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('main_interview_schedule.interview_status', $status_id);
            
            $this->db->select('main_interview_schedule.*');
            $this->db->from('main_interview_schedule');
            $this->db->join('main_cv_management','main_cv_management.id=main_interview_schedule.candidate_name');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('main_interview_schedule.company_id', $this->company_id);
            } else {
                $this->db->where('main_interview_schedule.createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($requisition_idd != '') {
                $this->db->where('main_interview_schedule.requisition_id', $requisition_idd);
            }
            if ($schedule_group != '') {
                $this->db->where('main_interview_schedule.schedule_id', $schedule_group);
            }
            
           $search_data = $this->db->get()->result();
        }
        else {
            $search_data = array();
        }

        $this->index($this->uri->segment(3), TRUE, $search_data, $search_criteria);
        
    }
    
    
    function set_Interview_panel() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        
        $param['type']="3";
        $param['page_header']="Interview Panel";	
        $param['module_id']=$this->module_id;

        $param['query'] = $this->db->get_where('main_interview_schedule', array('id' => $id));
        //echo $this->db->last_query();
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addInterview_Candidate.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function view_resume() {
        $resume_path = $this->uri->segment(3);
        if($resume_path!="")
        {
            $this->load->helper('download');
            $data = file_get_contents(base_url('/uploads/candidate_resume/' . $resume_path));
            force_download($filename, $data);
        }
    }
    
    public function update_interview_status(){
        
        $this->form_validation->set_rules('up_interview_status', 'Interview Status','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('up_candidate_status', 'Candidate Status','required',array('required'=> "Please the enter required field, for more Info : %s."));
       
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            
            $this->db->trans_begin();
            
            $data = array('interview_status' => $this->input->post('up_interview_status'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
           
            $res=$this->Common_model->update_data('main_interview_schedule',$data,array('id' => $this->input->post('interview_schedule_id')));
            
            $cdata = array('status' => $this->input->post('up_candidate_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $cres=$this->Common_model->update_data('main_cv_management',$cdata,array('id' => $this->input->post('candidate_id')));
            
            $idata = array('company_id' => $this->company_id,
                'requisition_id' => $this->input->post('requisition_id'),
                'schedule_id' => $this->input->post('schedule_id'),
                'candidate_id' => $this->input->post('candidate_id'),
                'interview_status' => $this->input->post('up_interview_status'),
                'candidate_status' => $this->input->post('up_candidate_status'),
                'rating_id' => $this->input->post('rating_id'),
                'comments' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->insert_data('main_candidate_interview',$idata);
            
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
    
    public function delete_Scheduled() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_interview_schedule", $id);
        redirect('Con_Interview_Candidate/');
        exit;
    }
    
    public function view_Candidate() {
        
        $si_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Schedule Interview";
        $param['module_id'] = $this->module_id;
        $param['type']="4";

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'id' =>$si_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('id' => $si_id ));            
        }        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addInterview_Candidate.php';
        $this->load->view('admin/home', $param);
    }
    
    public function load_candidate_dropdown() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_cv_management', array('requisition_id' => $id,'status' => 0));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->candidate_first_name . "</option>";
            }
        } else {
            echo"<option> No Candidate Added </option>";
        }
    }
    
    public function load_candidate_status() {
        $id = $this->uri->segment(3);
        //$query = $this->db->get_where('main_cv_management', array('requisition_id' => $id));
        $candidate_status = $this->Common_model->get_array('candidate_status');
        if ($id == 0) {
            print"<option></option>";
            foreach ($candidate_status as $key=> $val) {
                if($key==1)
                {
                    print"<option value=" . $key . ">" . $val . "</option>";
                }
            }
        } else if($id == 3)
        {
            print"<option></option>";
            foreach ($candidate_status as $key=> $val) {
                if($key==2 || $key==5)
                {
                    print"<option value=" . $key . ">" . $val . "</option>";
                }
            } 
        } else if($id == 4)
        {
            print"<option></option>";
            foreach ($candidate_status as $key=> $val) {
                if($key==6)
                {
                    print"<option value=" . $key . ">" . $val . "</option>";
                }
            } 
        }else {
            echo"<option> No Candidate Added </option>";
        }
    }
    
}

