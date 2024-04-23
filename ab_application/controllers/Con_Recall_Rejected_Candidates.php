<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Recall_Rejected_Candidates extends CI_Controller {

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
        $param['page_header'] = "Re-Call Rejected Candidates";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $status='4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $status='4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('status', $status_id);
            $param['query'] = $this->db->get_where('main_cv_management', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        
        $param['resume_type'] = $this->Common_model->get_array('resume_type');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Recall_Rejected_Candidates.php';
        $this->load->view('admin/home', $param);
    }
    
       
    public function Recall_Rejected_Candidates() {
        $id = $this->uri->segment(3);
        
        $cdata = array('status' => 0,
            'is_recall' => 1,
            'modifiedby' => $this->user_id,
            'modifieddate' => $this->date_time,
            'isactive' => '1',
        );

        $cres = $this->Common_model->update_data('main_cv_management', $cdata, array('id' => $this->uri->segment(3)));
        redirect('Con_Recall_Rejected_Candidates/');
        exit;
    }
    
    public function update_Rejected_Candidates() {

        $this->form_validation->set_rules('rejected_id[]', 'Candidates', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->trans_begin();
            
            $rejected_id = $this->input->post("rejected_id");
            for ($i = 0; $i < count($rejected_id); $i++) {
                $cdata[] = array('status' => 0,
                    'id' => $rejected_id[$i],
                    'is_recall' => 1,
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

