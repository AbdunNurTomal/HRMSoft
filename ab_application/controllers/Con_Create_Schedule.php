<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Create_Schedule extends CI_Controller {

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
    public $companyView = false;

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
        $this->companyView = $this->user_data['company_view'];

        $this->load->model('Sendmail_model');
    }

    public function index($menu_id=0, $show_result = FALSE, $search_data = array(), $search_criteria = array('requisition_idd' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_data'] = $search_data;
        $param['search_criteria'] = $search_criteria;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Create Schedule";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'req_status' => 1,'is_close' => 0)); //Approved
        } else {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Create_Schedule.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Candidate_Schedule() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_idd'] = $requisition_idd = $this->input->post('requisition_idd');

        if (($requisition_idd != '')) {
     
            $this->db->select('*');
            $this->db->from('main_schedule');
            
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

    public function add_Create_Schedule_index() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Create Schedule";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Create_Schedule_index.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_Create_Schedule() {

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Create Schedule";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['opening_position_query'] = $this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0,'company_id' => $this->company_id)); //Approved
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
        } else {
            $param['opening_position_query'] = $this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
            $param['employees_query'] = $this->Common_model->listItem('main_employees');
        }

        $param['approver_status'] = $this->Common_model->get_array('approver_status');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addCreate_Schedule.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Create_Schedule() {

        $this->form_validation->set_rules('schedule_group', 'Schedule Group', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('requisition_id', 'Requisition ID', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('location', 'Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('interview_type', 'Interview Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('interview_date', 'Interview Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->trans_begin();
            
            $interviewer = '';
            foreach ($this->input->post('interviewer') as $intr) {
                if ($interviewer == '') {
                    $interviewer = $intr;
                } else {
                    $interviewer = $interviewer . "," . $intr;
                }
            }
            
            
            $interview_date=$this->Common_model->convert_to_mysql_date($this->input->post('interview_date'));
            
            $inter = explode(",", $interviewer);
            $emp_id = array_map('intval', $inter);
            $this->db->where_in('interviewer', $emp_id);
            $schedule_chk_query = $this->db->get_where('main_schedule', array('interview_date' => $interview_date,'isactive' => 1));
            //echo $this->db->last_query();
            if ($schedule_chk_query->num_rows()>0) {
                echo $this->Common_model->show_validation_massege('This interviewer have a schedule in This Date.', 2);
                exit();
            }
            
            //====================================================================

            $data = array('company_id' => $this->company_id,
                'schedule_group' => $this->input->post('schedule_group'),
                'requisition_id' => $this->input->post('requisition_id'),
                'interviewer' => $interviewer,
                'location' => $this->input->post('location'),
                'interview_type' => $this->input->post('interview_type'),
                'interview_date' => $this->Common_model->convert_to_mysql_date($this->input->post('interview_date')),
                'interview_time' => $this->input->post('interview_time'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_schedule', $data);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }

            if ($flag) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Create_Schedule() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Create Schedule";
        $param['module_id'] = $this->module_id;
        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_schedule", $this->uri->segment(3), $this->company_id);
        }
        // check permission to view the employee ends

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['opening_position_query'] = $this->db->get_where('main_opening_position', array('req_status' => 1, 'is_close' => 0,'company_id' => $this->company_id)); //Approved
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
        } else {
            $param['opening_position_query'] = $this->db->get_where('main_opening_position', array('req_status' => 1,'is_close' => 0)); //Approved
            $param['employees_query'] = $this->Common_model->listItem('main_employees');
        }

        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['query'] = $this->db->get_where('main_schedule', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addCreate_Schedule.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Create_Schedule() {

        $this->form_validation->set_rules('schedule_group', 'Schedule Group', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('requisition_id', 'Requisition ID', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('location', 'Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('interview_type', 'Interview Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('interview_date', 'Interview Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->trans_begin();
            
            $interviewer = '';
            foreach ($this->input->post('interviewer') as $intr) {
                if ($interviewer == '') {
                    $interviewer = $intr;
                } else {
                    $interviewer = $interviewer . "," . $intr;
                }
            }

            $data = array('company_id' => $this->company_id,
                'schedule_group' => $this->input->post('schedule_group'),
                'requisition_id' => $this->input->post('requisition_id'),
                'interviewer' => $interviewer,
                'location' => $this->input->post('location'),
                'interview_type' => $this->input->post('interview_type'),
                'interview_date' => $this->Common_model->convert_to_mysql_date($this->input->post('interview_date')),
                'interview_time' => $this->input->post('interview_time'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_schedule', $data, array('id' => $this->input->post('int_id')));

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_Create_Schedule() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_schedule", $id);
        redirect('Con_Create_Schedule/');
        exit;
    }

}
