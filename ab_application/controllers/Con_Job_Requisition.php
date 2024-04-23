<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Job_Requisition extends CI_Controller {

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
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Job Requisition List";
        $param['module_id'] = $this->module_id;

        //$this->db->where_not_in('req_status', $search_ids);
        
        $this->db->where('req_status', 0);
        $this->db->where('is_close', 0);
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Job_Requisition.php';
        $this->load->view('admin/home', $param);
        
    }
    
    
    public function add_job_Requisition_index() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Job Requisition";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Job_Requisition_index.php';
        $this->load->view('admin/home', $param);
    }

    public function add_job_Requisition() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Job Requisition";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['location_query'] = $this->db->get_where('main_location', array('company_id' => $this->company_id));
            $param['department_query'] = $this->db->get_where('main_department', array('company_id' => $this->company_id));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id));
            $param['reporting_manager_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $param['employmentstatus_query'] = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id));
            $param['skills_query'] = $this->db->get_where('main_skill_setup', array('company_id' => $this->company_id));
        } else {
            $param['location_query'] = $this->Common_model->listItem('main_location');
            $param['department_query'] = $this->Common_model->listItem('main_department');
            $param['positions_query'] = $this->Common_model->listItem('main_positions');
            $param['reporting_manager_query'] = $this->db->get_where('main_employees', array('isactive' => 1));
            $param['employees_query'] = $this->Common_model->listItem('main_employees');
            $param['employmentstatus_query'] = $this->Common_model->listItem('main_employmentstatus');
            $param['skills_query'] = $this->db->get_where('main_skill_setup', array('isactive' => 1));
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['experience_array'] = $this->Common_model->get_array('experience_array');
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addJobRequisition.php';
        $this->load->view('admin/home', $param);
    }
    

    public function save_job_Requisition() {
        
        $this->form_validation->set_rules('requisitions_date', 'Requisition Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('due_date', 'Due Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department_id', 'Department', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position_id', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('reporting_manager_id', 'Reporting Manager', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_category', 'Employee Category', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->trans_begin();
            
            $position_name=$this->Common_model->get_name($this,$this->input->post('position_id'),'main_jobtitles', 'job_title');
            $requisition_code = $this->Common_model->return_requisition_code('id','main_opening_position',$position_name);
            
            if ($this->input->post('wages') == 2) {
                $hourly_rate = $this->input->post('hourly_rate');
            } else {
                $hourly_rate = "";
            }
            
            $required_skills = '';
            $req_skills = $this->input->post('required_skills');
            if($req_skills){
                foreach ($req_skills as $intr) {
                    if ($required_skills == '') {
                        $required_skills = $intr;
                    } else {
                        $required_skills = $required_skills . "," . $intr;
                    }
                }
            }
            
            $required_qualification = '';
            $req_qualification = $this->input->post('required_qualification');
            if($req_qualification){
                foreach ( $req_qualification as $intr) {
                    if ($required_qualification == '') {
                        $required_qualification = $intr;
                    } else {
                        $required_qualification = $required_qualification . "," . $intr;
                    }
                }
            }

            $data = array('company_id' => $this->company_id,
                'requisition_code' => $requisition_code,
                'requisitions_date' => $this->Common_model->convert_to_mysql_date($this->input->post('requisitions_date')),
                'due_date' => $this->Common_model->convert_to_mysql_date($this->input->post('due_date')),
                'location_id' => $this->input->post('location_id'),
                'department_id' => $this->input->post('department_id'),
                'position_id' => $this->input->post('position_id'),
                'reporting_manager_id' => $this->input->post('reporting_manager_id'),
                'employee_category' => $this->input->post('employee_category'),
                'wages' => $this->input->post('wages'),
                'salary_range' => $this->input->post('salary_range'),
                'hourly_rate' => $hourly_rate,
                'posting' => $this->input->post('posting'),
                'no_of_positions' => $this->input->post('no_of_positions'),
                'hire_reason' => $this->input->post('hire_reason'),
                'replacing_emp' => $this->input->post('replacing_emp'),
                'employment_status_id' => $this->input->post('employment_status_id'),
                'priority' => $this->input->post('priority'),
                'required_qualification' => $required_qualification,
                'experience_range' => $this->input->post('experience_range'),
//                'job_description' => $this->input->post('job_description'),
                'required_skills' => $required_skills,
                'position_description' => $this->input->post('position_description'),
                'job_posting_text' => $this->input->post('job_posting_text'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_opening_position', $data);

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

    function edit_job_Requisition() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Job Requisition";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['location_query'] = $this->db->get_where('main_location', array('company_id' => $this->company_id));
            $param['department_query'] = $this->db->get_where('main_department', array('company_id' => $this->company_id));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id));
            $param['reporting_manager_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $param['employmentstatus_query'] = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id));
            $param['skills_query'] = $this->db->get_where('main_skill_setup', array('company_id' => $this->company_id));
        } else {
            $param['location_query'] = $this->Common_model->listItem('main_location');
            $param['department_query'] = $this->Common_model->listItem('main_department');
            $param['positions_query'] = $this->Common_model->listItem('main_positions');
            $param['reporting_manager_query'] = $this->db->get_where('main_employees', array('isactive' => 1));
            $param['employees_query'] = $this->Common_model->listItem('main_employees');
            $param['employmentstatus_query'] = $this->Common_model->listItem('main_employmentstatus');
            $param['skills_query'] = $this->db->get_where('main_skill_setup', array('isactive' => 1));
        }

        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['OpeningsPositions_query'] = $this->db->get_where('main_opening_position', array('id' => $id));
        $param['experience_array'] = $this->Common_model->get_array('experience_array');

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_open_position", $this->uri->segment(3), $this->company_id);
        }
        // check permission to view the employee ends
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['educationlevel_query'] = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addJobRequisition.php';
        $this->load->view('admin/home', $param);
    }

    public function update_job_Requisition() {
        
        $this->form_validation->set_rules('requisitions_date', 'Requisition Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('due_date', 'Due Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department_id', 'Department', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position_id', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('reporting_manager_id', 'Reporting Manager', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_category', 'Employee Category', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->trans_begin();
            
            if ($this->input->post('wages') == 2) {
                $hourly_rate = $this->input->post('hourly_rate');
            } else {
                $hourly_rate = "";
            }
            
            $required_skills = '';
            $req_skills = $this->input->post('required_skills');
            if($req_skills){
                foreach ($req_skills as $intr) {
                    if ($required_skills == '') {
                        $required_skills = $intr;
                    } else {
                        $required_skills = $required_skills . "," . $intr;
                    }
                }
            }
            
            $required_qualification = '';
            $req_qualification = $this->input->post('required_qualification');
            if($req_qualification){
                foreach ( $req_qualification as $intr) {
                    if ($required_qualification == '') {
                        $required_qualification = $intr;
                    } else {
                        $required_qualification = $required_qualification . "," . $intr;
                    }
                }
            }

            $data = array('company_id' => $this->company_id,
                //'requisition_code' => $this->input->post('requisition_code'),
                'requisitions_date' => $this->Common_model->convert_to_mysql_date($this->input->post('requisitions_date')),
                'due_date' => $this->Common_model->convert_to_mysql_date($this->input->post('due_date')),
                'location_id' => $this->input->post('location_id'),
                'department_id' => $this->input->post('department_id'),
                'position_id' => $this->input->post('position_id'),
                'reporting_manager_id' => $this->input->post('reporting_manager_id'),
                'employee_category' => $this->input->post('employee_category'),
                'wages' => $this->input->post('wages'),
                'salary_range' => $this->input->post('salary_range'),
                'hourly_rate' => $hourly_rate,
                'posting' => $this->input->post('posting'),
                'no_of_positions' => $this->input->post('no_of_positions'),
                'hire_reason' => $this->input->post('hire_reason'),
                'replacing_emp' => $this->input->post('replacing_emp'),
                'employment_status_id' => $this->input->post('employment_status_id'),
                'priority' => $this->input->post('priority'),
                'required_qualification' => $required_qualification,
                'experience_range' => $this->input->post('experience_range'),
//                'job_description' => $this->input->post('job_description'),
                'required_skills' => $required_skills,
                'position_description' => $this->input->post('position_description'),
                'job_posting_text' => $this->input->post('job_posting_text'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_opening_position', $data, array('id' => $this->input->post('id')));

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

    public function delete_job_Requisition() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_opening_position", $id);
        redirect('Con_Job_Requisition/');
        exit;
    }

    public function approve_job_Requisition() {
        $id = $this->uri->segment(3);
        //$this->Common_model->delete_by_id("main_opening_position", $id);

        $data = array('req_status' => 1,
            'modifiedby' => $this->user_id,
            'modifieddate' => $this->date_time,
            'isactive' => '1',
        );

        $res = $this->Common_model->update_data('main_opening_position', $data, array('id' => $id));


        redirect('Con_Job_Requisition/');
        exit;
    }
    
    public function view_requisition() {
        
        $req_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Job Requisition Detail";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$req_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $req_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobRequisitionDetail_app.php';
        $this->load->view('admin/home', $param);
    }


    public function save_Position_Settings() {
        $this->form_validation->set_rules('position', 'position', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('job_title' => $this->input->post('position'),
                'job_family' => $this->input->post('position'),
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_jobtitles', $data);

            $data2 = array('company_id' => $this->company_id,
                'job_family' => $this->input->post('position'),
                'positionname' => $this->db->insert_id(),
                //'gl_code' => $this->input->post('county_name'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res2 = $this->Common_model->insert_data('main_positions', $data2);

            if ($res2) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }

        }
    }


    public function save_qualification() {
        
        $this->form_validation->set_rules('qualification', 'Qualification','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Description','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_id,
                'educationlevelcode' => $this->input->post('qualification'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            $res = $this->Common_model->insert_data('main_educationlevelcode', $data);
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }
    public function save_req_skills() {
        
        $this->form_validation->set_rules('req_skills', 'Required Skills','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Description','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_id,
                'skill_name' => $this->input->post('req_skills'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            $res = $this->Common_model->insert_data('main_skill_setup', $data);
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

}
