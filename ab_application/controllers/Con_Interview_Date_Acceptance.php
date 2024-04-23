<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Interview_Date_Acceptance extends CI_Controller {

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
        
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Interview Date Acceptance";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('interview_status', $status_id);
            $this->db->where_not_in('acceptance_status', 1);
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('interview_status', $status_id);
            $this->db->where_not_in('acceptance_status', 1);
            $param['query'] = $this->db->get_where('main_interview_schedule', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Date_Acceptance.php';
        $this->load->view('admin/home', $param);
    }
    
    public function view_Interview_Date_Acceptance() {
        
        $si_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Interview Date Acceptance";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'id' =>$si_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('id' => $si_id ));            
        }
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Date_Approval.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_allInterview_Date_Acceptance() {
         
        $this->form_validation->set_rules('acceptance_status', ' Status ', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id', 'Action Button', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $approver_id = $this->input->post("approver_id");
            $approver = (explode(",",$approver_id));
            foreach ($approver as $approve_status) {

                $data[] = array('id' => $approve_status,
                    'acceptance_status' => $this->input->post('acceptance_status'),                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                ); 
            }                
            $res = $this->db->update_batch('main_interview_schedule', $data, 'id');
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function save_Interview_Date_Acceptance() {

        $this->form_validation->set_rules('acceptance_status', 'Status', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('acceptance_status' => $this->input->post('acceptance_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_interview_schedule', $data, array('id' => $this->input->post('schedule_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function showInterviewDateAcceptance()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order");
        $search = $this->input->get("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'main_interview_schedule.id',
            1=>'main_interview_schedule.requisition_id',
            2=>'main_interview_schedule.interviewer',
            4=>'main_interview_schedule.candidate_name',
            5=>'main_interview_schedule.requisitions_date',
            7=>'main_interview_schedule.interview_status',
            8=>'main_interview_schedule.acceptance_status',
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }

        $this->db->limit($length, $start);
        $this->db->select('main_interview_schedule.id, main_interview_schedule.requisition_id, main_interview_schedule.interviewer, main_interview_schedule.candidate_name, main_interview_schedule.interview_status, main_interview_schedule.acceptance_status');
        $this->db->from('main_interview_schedule');
        $status='0,4';
        $status = explode(",", $status);
        $status_id = array_map('intval', $status);
        $this->db->where_in('interview_status', $status_id);
        $this->db->where_not_in('acceptance_status', 1);
        //$this->db->where('main_opening_position.company_id', $this->company_id);
        $this->db->where('main_interview_schedule.isactive', 1);

        if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('main_interview_schedule.company_id', $this->company_id);
        }
        $interview_acceptance = $this->db->get()->result();
        // echo "<pre>". print_r($employees) ."</pre>";exit;
      
        $data = array();
        $interview_status = $this->Common_model->get_array('interview_status');
        $approver_status = $this->Common_model->get_array('approver_status');
        foreach ($interview_acceptance as $row) {
            $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
            //$sl++;
            $pdt = $row->id;
            $exp_interviewer = explode(",", $row->interviewer);
            $interviewer = "";
            foreach ($exp_interviewer as $key => $val) {
                if ($interviewer == "") {
                    $interviewer = $this->Common_model->get_selected_value($this, 'employee_id', $val, 'main_employees', 'first_name');
                } else {
                    $interviewer = $interviewer . " , " . $this->Common_model->get_selected_value($this, 'employee_id', $val, 'main_employees', 'first_name');
                }
            }
            $data[] = array(
                $row->id,
                $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code'),
                $interviewer,
                $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title'),
                $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_first_name'),
                $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_email'),
                $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'contact_number'),
                $interview_status[$row->interview_status],
                $approver_status[$row->acceptance_status],
               '<div class="action-buttons">'
                    . '<a title="Preview" href="' . base_url() . 'Con_Interview_Date_Acceptance/view_Interview_Date_Acceptance/' . $row->id . '/" ><i class="fa fa-lg fa-eye"></i></a>&nbsp;&nbsp;'
                    . '</div>' 
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $total_interview_acceptance = $this->totalInterviewAcceptance();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_interview_acceptance,
            "recordsFiltered" => $total_interview_acceptance,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalInterviewAcceptance()
    {
        //$departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        //$this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $status='0,4';
        $status = explode(",", $status);
        $status_id = array_map('intval', $status);
        $this->db->where_in('interview_status', $status_id);
        $this->db->where_not_in('acceptance_status', 1);
        //$this->db->where('main_opening_position.company_id', $this->company_id);
        $this->db->where('main_interview_schedule.isactive', 1);
        if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('main_interview_schedule.company_id', $this->company_id);
        }
        //$this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_interview_schedule");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }
    
   
    
}

