<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_OpeningsPositions extends CI_Controller {

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
        
        $this->load->model('Sendmail_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Job Positing";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'is_close' => 0,'req_status'=>1,'due_date > '=>date("Y-m-d")));
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('req_status'=>1,'is_close' => 0,'due_date > '=>date("Y-m-d")));
        }
        //echo $this->db->last_query();
        
        $param['opening_status'] = $this->Common_model->get_array('opening_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_OpeningsPositions.php';
        $this->load->view('admin/home', $param);
    }

    public function update_op_Status() {
        $this->form_validation->set_rules('op_status', 'Opening Position Status', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('open_position_date', 'Open Position Date', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id[]', 'Action Button', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $approver_id = $this->input->post("approver_id");
            for ($i = 0; $i < count($approver_id); $i++) {

                $data[] = array('id' => $approver_id[$i],
                    'op_status' => $this->input->post('op_status'),
                    'open_position_date' => $this->Common_model->convert_to_mysql_date($this->input->post('open_position_date')),                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );                
                $res = $this->db->update_batch('main_opening_position', $data, 'id');
            } 
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function view_opening_position() {
        
        $opn_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

//        $param['type'] = "1";
        $param['page_header'] = "Open Positions";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$opn_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $opn_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobOpeningPositionDetail.php';
        $this->load->view('admin/home', $param);
    }

    public function view_job_posting() {
        
        $opn_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

//      $param['type'] = "1";
        $param['page_header'] = "Job Positing";
        $param['module_id'] = $this->module_id;
        $param['req_id'] = $opn_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$opn_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $opn_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobPosting.php';
        $this->load->view('admin/home', $param);
    }
    
    
    public function add_job_posting_link() {
        
        $req_id=$this->uri->segment(3);
        //$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Job Positing";
        $param['module_id'] = $this->module_id;
        $param['req_id'] = $req_id;
        $param['company_id'] = $this->company_id;
        $param['logo']= base_url()."assets/img/hrc_logo.png";
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
            $param['skills_query'] = $this->db->get_where('main_skill_setup', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
            $param['skills_query']=$this->db->get_where('main_skill_setup', array('isactive' => 1)); //Approved 
        }

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$req_id ))->row();            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $req_id ))->row();            
        }

        //$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        //$param['content'] = 'talentacquisition/view_JobPosting.php';
        //$this->load->view('admin/home', $param);
        
        $this->load->view('sadmin/job_posting_link', $param);
        //$param['body']=$this->load->view('sadmin/job_posting_link', $param);
    }
    
    
    public function save_Resume() {
        
        $this->form_validation->set_rules('resume_type', 'resume type','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('req_id', 'Requisition','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_first_name', 'Candidate First Name','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_last_name', 'Candidate Last Name','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_email', 'Email','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_number', 'Contact Number','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('qualification[]', 'Qualification','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('work_experience', 'Work Experience','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('skill_set[]', 'Skill Set','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if (empty($_FILES["userfile"]['name']))
        {
            $this->form_validation->set_rules('userfile', 'Resume','required',array('required'=> "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $this->db->trans_begin();
            
            $msg="";
            $er_msg="";
            $file_name="";
            if (!empty($_FILES["userfile"]['name'])){
                $config['upload_path']          = './uploads/candidate_resume/';
                $config['allowed_types']        = 'doc|docx|txt|pdf';
                $config['max_size']             = 1024 * 8;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                //$new_name = time().$_FILES["userfile"]['name'];
                //$config['file_name'] = $new_name;

                $newFileName = $_FILES["userfile"]['name'];
                $fileExt = explode(".", $newFileName);
                $config['file_name'] = time().".".$fileExt[1];

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                    $msg = $this->upload->display_errors();
                    $er_msg = $this->upload->display_errors();
                }
                else
                {
                    $data = $this->upload->data();
                    $file_path = $data['file_path'];
                    $file_name = $data['file_name'];
                    if (file_exists($file_path)) {
                        $msg = "File successfully uploaded";
                    } else {
                        $msg = "Something went wrong when saving the file, please try again.";
                        $er_msg = "Something went wrong when saving the file, please try again.";
                    }
                }
            }
            if($er_msg!="")
            {
                echo $this->Common_model->show_validation_massege($er_msg,2);
                exit();
            }
            
            $skill_set = '';
            foreach ($this->input->post('skill_set') as $intr) {
                if ($skill_set == '') {
                    $skill_set = $intr;
                } else {
                    $skill_set = $skill_set . "," . $intr;
                }
            }
            
            $qualification = '';
            foreach ($this->input->post('qualification') as $intr) {
                if ($qualification == '') {
                    $qualification = $intr;
                } else {
                    $qualification = $qualification . "," . $intr;
                }
            }

            $data = array('company_id' => $this->input->post('company_id'),
                'resume_type' => $this->input->post('resume_type'),
                'requisition_id' => $this->input->post('req_id'),
//                'employee_id' => $employee_id,
//                'other_referral' => $other_referral,
                'candidate_first_name' => $this->input->post('candidate_first_name'),
                'candidate_last_name' => $this->input->post('candidate_last_name'),
                'candidate_email' => $this->input->post('candidate_email'),
                'contact_number' => $this->input->post('contact_number'),
                'qualification' => $qualification,
                'work_experience' => $this->input->post('work_experience'),
                'skill_set' => $skill_set,
                'education_summary' => $this->input->post('education_summary'),
                'state' => $this->input->post('state'),
//                'upload_resume_path' => $this->input->post('upload_resume_path'),
                //'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->insert_data('main_cv_management',$data);
            $insert_id = $this->db->insert_id();
            
            $upres = $this->Common_model->update_data('main_cv_management', array('upload_resume_path' => $file_name), array('id' => $insert_id));
            
            $res = $this->Sendmail_model->candidate_mail($this->input->post('candidate_first_name'),$this->input->post('candidate_email'));
            
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
         
    }
    
    
}
