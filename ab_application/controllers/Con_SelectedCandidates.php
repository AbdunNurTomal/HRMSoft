<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_SelectedCandidates extends CI_Controller {

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
        $param['page_header'] = "Selected Candidates";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $status='3';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id,'isactive' => 1,'is_close' => 0));
        } else {
            $status='3';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            $param['query'] = $this->db->get_where('main_cv_management', array('isactive' => 1,'is_close' => 0));
        }
        //echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_SelectedCandidates.php';
        $this->load->view('admin/home', $param);
    }
    
    function edit_SelectedCandidates() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        $requisition_id = $this->uri->segment(4);
        
        $param['type']="2";
        $param['page_header']="Shortlisted and Selected Candidates";	
        $param['module_id']=$this->module_id;

        $param['query'] = $this->db->get_where('main_cv_management', array('id' => $id,'requisition_id' => $requisition_id));
        $param['interviewquery'] = $this->db->get_where('main_interview_schedule', array('requisition_id' => $requisition_id,'candidate_name' => $id,));
        //echo $this->db->last_query();
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addSelectedCandidates.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function update_SelectedCandidates(){
        
        $this->form_validation->set_rules('candidate_status', 'Candidate Status','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_email', 'Candidate Email', 'trim|required|valid_email|is_unique[main_users.email]',array('required'=> "Please the enter required field, for more Info : %s.",'is_unique' => 'This User already exists, For more Info : %s.'));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
          
            $cdata = array('status' => $this->input->post('candidate_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $cres=$this->Common_model->update_data('main_cv_management',$cdata,array('id' => $this->input->post('candidate_id'),'requisition_id' => $this->input->post('requisition_id')));
            
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
            
            if ($cres) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    public function ajax_edit_candidate() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_cv_management', $id);
        echo json_encode($data);
    }
    
    
    public function save_selfuser_signup() {

        $this->form_validation->set_rules('email', 'User email', 'trim|required|valid_email|is_unique[main_users.email]', array('required' => "Please the enter required field, for more Info : %s.", 'is_unique' => 'This User already exists, For more Info : %s.'));
        $this->form_validation->set_rules('firstname', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('passwd', 'Password', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_id,
                'email' => $this->input->post('email'),
                'name' => $this->input->post('firstname'),
                // 'password' => $this->Common_model->encrypt($this->input->post('passwd')),
                'password' => md5($this->input->post('passwd')),
                'password_reset_hash' => md5($this->input->post('passwd')),
                'phone_no' => $this->input->post('phone_no'),
                'user_group' => '9',
                'user_type' => '1',
                'candidate_id' => $this->input->post('candidate_id'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_users', $data);

            $cdata = array('candidate_user_id' => $this->db->insert_id(),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $cres = $this->Common_model->update_data('main_cv_management', $cdata, array('id' => $this->input->post('candidate_id'), 'requisition_id' => $this->input->post('requisition_id')));

            $eres = $this->Sendmail_model->selfuser_send_mail($this->input->post('firstname'), $this->input->post('email'), $this->input->post('passwd'));

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function save_selfuser_otp() {

        $id = $this->uri->segment(3);
        $cdata=$this->db->get_where('main_cv_management', array('id' => $id,'isactive' => 1,'is_close' => 0))->row();
        $otp=$this->generatePassword(6,4);
       

        $this->db->where('candidate_id',$id);
        $query = $this->db->get('main_ob_users');
        if ($query->num_rows() > 0){

            $data = array(
                'candidate_email' => $cdata->candidate_email,
                'name' => $cdata->candidate_first_name ."  ".$cdata->candidate_last_name,
                'email' => 'loginemail@hrcsoft.com',
                'password' => password_hash($password, PASSWORD_DEFAULT),//bcrypt($otp),
                'otp' => $otp,
                'phone_no' => $cdata->contact_number,
                'isClose' => 0,
                'created_at' => $this->date_time,
                'updated_at' => $this->date_time,
                //'isactive' => 1,
            );

            $res=$this->Common_model->update_data('main_ob_users',$data,array('candidate_id' => $id));
        }
        else{

            $data = array('company_id' => $this->company_id,
                'candidate_id' => $id,
                'candidate_email' => $cdata->candidate_email,
                'name' => $cdata->candidate_first_name ."  ".$cdata->candidate_last_name,
                'email' => 'loginemail@hrcsoft.com',
                'password' => password_hash($password, PASSWORD_DEFAULT),//bcrypt($otp),
                'otp' => $otp,
                'phone_no' => $cdata->contact_number,
                'isClose' => 0,
                'created_at' => $this->date_time,
                'updated_at' => $this->date_time,
                //'isactive' => 1,
            );
            $res = $this->Common_model->insert_data('main_ob_users', $data);
        }
            

        $res = $this->Common_model->update_data('main_cv_management', array('is_send' => 1), array('id' => $id));

            // $cdata = array('candidate_user_id' => $this->db->insert_id(),
            //     'modifiedby' => $this->user_id,
            //     'modifieddate' => $this->date_time,
            //     'isactive' => '1',
            // );

            // $cres = $this->Common_model->update_data('main_cv_management', $cdata, array('id' => $this->input->post('candidate_id'), 'requisition_id' => $this->input->post('requisition_id')));

            //$eres = $this->Sendmail_model->selfuser_send_mail($this->input->post('firstname'), $this->input->post('email'), $this->input->post('passwd'));
            $eres = $this->Sendmail_model->selfuser_send_mail_otp($id,$cdata->candidate_email,$cdata->candidate_first_name ."  ".$cdata->candidate_last_name );

            // if ($res) {
            //     echo $this->Common_model->show_massege(0, 1);
            // } else {
            //     echo $this->Common_model->show_massege(1, 2);
            // }

            redirect('Con_SelectedCandidates/');
    }

    public function view_resume() {
        $resume_path = $this->uri->segment(3);
        if($resume_path!="")
        {
            $this->load->helper('download');
            $data = file_get_contents(base_url('/uploads/candidate_resume/' . $resume_path));
            force_download($resume_path, $data);
        }
    }

    public function generatePassword($length, $strength) 
        {
            $vowels = '13579';
            $consonants = '987654321';
            if ($strength & 1) 
            {
                $consonants .= 'BDGHJLMNPQRSTVWXZ';
            }
            if ($strength & 2) 
            {
                $vowels .= "AEUY";
            }
            if ($strength & 4) 
            {
                $consonants .= '23456789';
            }
            if ($strength & 8) 
            {
                $consonants .= '@#$%';
            }
            $password = '';
            $alt = time() % 2;
            for ($i = 0; $i < $length; $i++) 
            {
                if ($alt == 1) 
                {
                    $password .= $consonants[(rand() % strlen($consonants))];
                    $alt = 0;
                } 
                else 
                {
                    $password .= $vowels[(rand() % strlen($vowels))];
                    $alt = 1;
                }
            }
            return $password;
        }


    
    
    
}

