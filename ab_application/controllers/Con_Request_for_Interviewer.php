<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Request_for_Interviewer extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_ids = array(), $schedule_id=0,$search_criteria = array('requisition_idd' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;
        $param['schedule_id'] = $schedule_id;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Request for Interviewer";
        $param['module_id'] = $this->module_id;
        
        $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['schedule_query'] = $this->db->get_where('main_schedule', array('company_id' => $this->company_id, 'is_close' => 0, 'isactive' => 1));
        } else {
            $param['schedule_query'] = $this->db->get_where('main_schedule', array('isactive' => 1, 'is_close' => 0));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Request_for_Interviewer.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Interviewer() {
        
        $ids = $search_criteria = array();

        $search_criteria['schedule_id'] = $schedule_id = $this->input->post('schedule_id');

        if (($schedule_id != '')) {
            
            //$schedule_query = $this->db->get_where('main_schedule', array('requisition_id' => $requisition_id,'isactive' => 1))->row();
     
            $this->db->select('interviewer');
            $this->db->from('main_schedule');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } else {
                $this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($schedule_id != '') {
                $this->db->where('id', $schedule_id);
            }
           
            $idss = $this->db->get()->row();
            if (!empty($idss)) {
                $ids = $idss->interviewer;
            } else {
                $ids = "";
            }
        }

        $this->index($this->uri->segment(3), TRUE, $ids,$schedule_id, $search_criteria);
        
    }
    
    public function save_Request_for_Interviewer() {
        
        $this->form_validation->set_rules('employee_id[]', 'Employee','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('schedule_id', 'Schedule ID','required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            
            $this->db->trans_begin();
            
            $schedule_query = $this->db->get_where('main_schedule', array('id' => $this->input->post('schedule_id'),'isactive' => 1))->row();
            
            $schedule_chk_query = $this->db->get_where('main_schedule', array('id' => $this->input->post('schedule_id'),'isactive' => 1));
            //echo $this->db->last_query();
            if ($schedule_chk_query->num_rows()== 0) {
                echo $this->Common_model->show_validation_massege('Schedule Not Created.', 2);
                exit();
            }
           
            $employee_id = $this->input->post("employee_id");
            foreach ($employee_id as $key => $val) {
                $emp = $this->db->get_where('main_employees', array('employee_id' => $val))->row();
                $interview_date=$this->Common_model->convert_to_mysql_date($schedule_query->interview_date);
                if ($emp->email != "") {
                    $eres = $this->Sendmail_model->employeeScheduled_mail($emp->first_name, $emp->email, $interview_date,$schedule_query->interview_time,$schedule_query->requisition_id);
                }
            }

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
