<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_Accident extends CI_Controller {

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
        $param['type'] = "1";
        $param['page_header'] = "Employee Accident";
        $param['module_id'] = $this->module_id;

        /* if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
          $param['query'] = $this->db->get_where('main_emp_actions', array('action_type' => 2, 'company_id' => $this->company_id, 'isactive' => 1));
          } else {
          $param['query'] = $this->db->get_where('main_emp_actions', array('action_type' => 2, 'isactive' => 1));
          } */

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Employee_Accident.php';
        $this->load->view('admin/home', $param);
    }

    public function save_emp_acc_actions() {
        //pr($this->input->post());
        
        $accident_report = array();

        $this->form_validation->set_rules('employee_id', 'Accident Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->input->post('acc_action_type') == 1) {
            $this->form_validation->set_rules('accident_action_date', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('accident_location', 'Accident Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            $accident_report = array(
                'accident_time' => $this->input->post('accident_time'),
                'physician_name' => $this->input->post('physician_name'),
                'nature_of_injury' => $this->input->post('nature_of_injury'),
                'any_benefit_provider' => (array_key_exists('any_benefit_provider', $this->input->post())) ? $this->input->post('any_benefit_provider') : 0,
                'benefit_provider' => $this->input->post('benefit_provider_id'),
                'injury_type' => (($this->input->post('injury_type') != '') ? implode(',', $this->input->post('injury_type')) : ''),
                'injured_body_parts' => (($this->input->post('injured_body_parts') != '') ? implode(',', $this->input->post('injured_body_parts')) : ''),
                'how_accident_occured' => $this->input->post('how_accident_occured'),
                'activity_during_injury' => $this->input->post('activity_during_injury'),
                'detail_description' => $this->input->post('detail_description'),
                'explain_first_aid' => $this->input->post('explain_first_aid'),
                'explain_accident_causes' => $this->input->post('explain_accident_causes'),
                'measures_in_future' => $this->input->post('measures_in_future'),
                'comments_by_dept' => $this->input->post('comments_by_dept')
            );

            if ($this->input->post('acc_any_witness') == 1) {
                array_merge($accident_report, array(
                    'any_witness' => $this->input->post('acc_any_witness'),
                    'accident_witness' => $this->input->post('acc_witness_name'),
                    'accident_witness_phone' => $this->input->post('acc_witness_phone'),
                    'accident_witness_address' => $this->input->post('acc_witness_address')
                ));
            }
            if ($this->input->post('first_aid_given') == 1) {
                array_merge($accident_report, array(
                    'first_aid_given' => $this->input->post('first_aid_given'),
                    'firstAid_by_whom' => $this->input->post('firstAid_by_whom')
                ));
            }
        } else if ($this->input->post('acc_action_type') == 2) {
            $this->form_validation->set_rules('acc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if ($this->input->post('acc_report_supervisor')) {
                $acc_report_supervisor = $this->input->post('acc_report_supervisor');
            } else {
                $acc_report_supervisor = "";
            }

            if ($this->input->post('acc_report_hr')) {
                $acc_report_hr = $this->input->post('acc_report_hr');
            } else {
                $acc_report_hr = "";
            }

            if ($this->input->post('requires_hospitalization')) {
                $requires_hospitalization = $this->input->post('requires_hospitalization');
            } else {
                $requires_hospitalization = "";
            }

            $data = array(
                'employee_id' => $this->input->post('employee_id'),
                'company_id' => $this->company_id,
                'action_type' => 2,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('accident_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'report_supervisor' => $acc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('acc_supervisor_reported_by'),
                'report_hr' => $acc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_hr_report_date')),
                'hr_reported_by' => $this->input->post('acc_hr_reported_by'),
                'report_description' => $this->input->post('acc_report_description'),
                'employee_comments' => $this->input->post('acc_employee_comments'),
                'requires_hospitalization' => $requires_hospitalization,
                'clinic_name' => $this->input->post('clinic_name'),
                'discipline_type' => $this->input->post('acc_discipline_type'),
                'verbal_warning_by' => $this->input->post('acc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('acc_written_warning_by'),
                'counseled_by' => $this->input->post('acc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_to')),
                'subject' => $this->input->post('acc_subject'),
                'description' => $this->input->post('acc_description'),
                'improvement_plan' => $this->input->post('acc_improvement_plan'),
                'further_actions' => $this->input->post('acc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                /* ------------------------------ */
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
                    /* --------For Report info, '$accident_report' array will be merged here -------- */
            );

            $data = array_merge($data, $accident_report);

            //pr($data, 1);

            $res = $this->Common_model->insert_data('main_emp_actions', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Employee_Accident() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "2";
        $param['page_header'] = "Edit Employee Accident";
        $param['module_id'] = $this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_actions", $this->uri->segment(3), $this->company_id);
        }
        // check permission to view the employee ends

        $param['action_id'] = $action_id = $this->uri->segment(3);
        $param['query'] = $this->db->get_where('main_emp_actions', array('id' => $action_id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Employee_Accident.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_emp_acc_actions() {
        //pr($this->input->post(), 1);

        if ($this->input->post('acc_action_type') == 1) {
            $this->form_validation->set_rules('accident_action_date', 'Action Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        } else if ($this->input->post('acc_action_type') == 2) {
            $this->form_validation->set_rules('acc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            //$this->Common_model->phpAlert("aaaaaaaaaa");
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if ($this->input->post('acc_report_supervisor')) {
                $acc_report_supervisor = $this->input->post('acc_report_supervisor');
            } else {
                $acc_report_supervisor = "";
            }

            if ($this->input->post('acc_report_hr')) {
                $acc_report_hr = $this->input->post('acc_report_hr');
            } else {
                $acc_report_hr = "";
            }

            if ($this->input->post('requires_hospitalization')) {
                $requires_hospitalization = $this->input->post('requires_hospitalization');
            } else {
                $requires_hospitalization = "";
            }

            $data = array(
                'employee_id' => $this->input->post('employee_id'),
                'company_id' => $this->company_id,
                'action_type' => 2,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('accident_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'report_supervisor' => $acc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('acc_supervisor_reported_by'),
                'report_hr' => $acc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_hr_report_date')),
                'hr_reported_by' => $this->input->post('acc_hr_reported_by'),
                'report_description' => $this->input->post('acc_report_description'),
                'employee_comments' => $this->input->post('acc_employee_comments'),
                'requires_hospitalization' => $requires_hospitalization,
                'clinic_name' => $this->input->post('clinic_name'),
                'discipline_type' => $this->input->post('acc_discipline_type'),
                'verbal_warning_by' => $this->input->post('acc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('acc_written_warning_by'),
                'counseled_by' => $this->input->post('acc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_to')),
                'subject' => $this->input->post('acc_subject'),
                'description' => $this->input->post('acc_description'),
                'improvement_plan' => $this->input->post('acc_improvement_plan'),
                'further_actions' => $this->input->post('acc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                /* ------------------------------ */
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
                /* ---------------------------------------------------------- */
                'accident_time' => $this->input->post('accident_time'),
                'any_witness' => $this->input->post('acc_any_witness'),
                'accident_witness' => $this->input->post('acc_witness_name'),
                'accident_witness_phone' => $this->input->post('acc_witness_phone'),
                'accident_witness_address' => $this->input->post('acc_witness_address'),
                'first_aid_given' => $this->input->post('first_aid_given'),
                'firstAid_by_whom' => $this->input->post('firstAid_by_whom'),
                'physician_name' => $this->input->post('physician_name'),
                'nature_of_injury' => $this->input->post('nature_of_injury'),
                'any_benefit_provider' => $this->input->post('any_benefit_provider'),
                'benefit_provider' => $this->input->post('benefit_provider_id'),
                'injury_type' => (($this->input->post('injury_type') != '') ? implode(',', $this->input->post('injury_type')) : ''),
                'injured_body_parts' => (($this->input->post('injured_body_parts') != '') ? implode(',', $this->input->post('injured_body_parts')) : ''),
                'how_accident_occured' => $this->input->post('how_accident_occured'),
                'activity_during_injury' => $this->input->post('activity_during_injury'),
                'detail_description' => $this->input->post('detail_description'),
                'explain_first_aid' => $this->input->post('explain_first_aid'),
                'explain_accident_causes' => $this->input->post('explain_accident_causes'),
                'measures_in_future' => $this->input->post('measures_in_future'),
                'comments_by_dept' => $this->input->post('comments_by_dept')
            );
            
            // pr($data, 1);

            $res = $this->Common_model->update_data('main_emp_actions', $data, array('id' => $this->input->post('id_emp_accident')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
}
