<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_Incident extends CI_Controller {

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
        $param['page_header'] = "Employee Incident";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_emp_actions', array('action_type' => 1, 'company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_emp_actions', array('action_type' => 1, 'isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Employee_Incident.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Employee_Incident() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Employee Incident";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployee_Incident.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Employee_Incident() {
        //pr($this->input->post(), 1);

        $accident_report = array();
        if ($this->input->post('inc_action_type') == 1) {
            $this->form_validation->set_rules('inc_action_date', 'Action Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('incident_category', 'Incident Category', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('tncident_type', 'Incident Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('accident_location', 'Incident Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            $accident_report = array(
                'any_witness' => (array_key_exists('inc_any_witness', $this->input->post())) ? $this->input->post('inc_any_witness') : 0,
                'accident_witness' => $this->input->post('inc_witness_name'),
                'accident_witness_phone' => $this->input->post('inc_witness_phone'),
                'accident_witness_address' => $this->input->post('inc_witness_address'),
                'accident_time' => $this->input->post('accident_time')
            );
        } else if ($this->input->post('inc_action_type') == 2) {
            $this->form_validation->set_rules('inc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            if ($this->input->post('inc_report_supervisor')) {
                $inc_report_supervisor = $this->input->post('inc_report_supervisor');
            } else {
                $inc_report_supervisor = "";
            }

            if ($this->input->post('inc_report_hr')) {
                $inc_report_hr = $this->input->post('inc_report_hr');
            } else {
                $inc_report_hr = "";
            }


            $data = array('employee_id' => $this->input->post('employee_id'),
                'company_id' => $this->company_id,
                'action_type' => 1,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'incident_category' => $this->input->post('incident_category'),
                'tncident_type' => $this->input->post('tncident_type'),
                'report_supervisor' => $inc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('inc_supervisor_reported_by'),
                'report_hr' => $inc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_hr_report_date')),
                'hr_reported_by' => $this->input->post('inc_hr_reported_by'),
                'report_description' => $this->input->post('inc_report_description'),
                'employee_comments' => $this->input->post('inc_employee_comments'),
                'discipline_type' => $this->input->post('inc_discipline_type'),
                'verbal_warning_by' => $this->input->post('inc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('inc_written_warning_by'),
                'counseled_by' => $this->input->post('inc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_to')),
                'subject' => $this->input->post('inc_subject'),
                'description' => $this->input->post('inc_description'),
                'improvement_plan' => $this->input->post('inc_improvement_plan'),
                'further_actions' => $this->input->post('inc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                /* ------------------------------ */
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $data = array_merge($data, $accident_report);

            $res = $this->Common_model->insert_data('main_emp_actions', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Employee_Incident() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "2";
        $param['page_header'] = "Edit Employee Incident";
        $param['module_id'] = $this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_actions", $this->uri->segment(3) , $this->company_id);
        }
        // check permission to view the employee ends

        $param['query'] = $this->db->get_where('main_emp_actions', array('id' => $this->uri->segment(3)));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployee_Incident.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Employee_Incident() {

        //pr($this->input->post());


        $accident_report = array();
        if ($this->input->post('inc_action_type') == 1) {
            $this->form_validation->set_rules('inc_action_date', 'Action Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('incident_category', 'Incident Category', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('tncident_type', 'Incident Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            if ($this->input->post('inc_any_witness')) {
                $inc_any_witness = $this->input->post('inc_any_witness');
            } else {
                $inc_any_witness = "";
            }

            $accident_report = array(
                'any_witness' => $inc_any_witness,
                'accident_witness' => $this->input->post('inc_witness_name'),
                'accident_witness_phone' => $this->input->post('inc_witness_phone'),
                'accident_witness_address' => $this->input->post('inc_witness_address'),
                'accident_time' => $this->input->post('accident_time')
            );
        } else if ($this->input->post('inc_action_type') == 2) {
            $this->form_validation->set_rules('inc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }


        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if ($this->input->post('inc_report_supervisor')) {
                $inc_report_supervisor = $this->input->post('inc_report_supervisor');
            } else {
                $inc_report_supervisor = "";
            }

            if ($this->input->post('inc_report_hr')) {
                $inc_report_hr = $this->input->post('inc_report_hr');
            } else {
                $inc_report_hr = "";
            }

            $data = array('employee_id' => $this->input->post('employee_id'),
                'company_id' => $this->company_id,
                'action_type' => 1,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'incident_category' => $this->input->post('incident_category'),
                'tncident_type' => $this->input->post('tncident_type'),
                'report_supervisor' => $inc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('inc_supervisor_reported_by'),
                'report_hr' => $inc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_hr_report_date')),
                'hr_reported_by' => $this->input->post('inc_hr_reported_by'),
                'report_description' => $this->input->post('inc_report_description'),
                'employee_comments' => $this->input->post('inc_employee_comments'),
                'discipline_type' => $this->input->post('inc_discipline_type'),
                'verbal_warning_by' => $this->input->post('inc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('inc_written_warning_by'),
                'counseled_by' => $this->input->post('inc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_to')),
                'subject' => $this->input->post('inc_subject'),
                'description' => $this->input->post('inc_description'),
                'improvement_plan' => $this->input->post('inc_improvement_plan'),
                'further_actions' => $this->input->post('inc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                /* ------------------------------ */
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            $data = array_merge($data, $accident_report);
            //pr($data);

            $res = $this->Common_model->update_data('main_emp_actions', $data, array('id' => $this->input->post('id_emp_inc')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function upload_action_image_file($upload_type) {
        $status = "";
        $msg = "";
        $file_element_name = 'action_image_file';

        if ($status != "error") {
            if (($upload_type == 'I-D') || ($upload_type == 'A-D')) {
                $config['upload_path'] = './uploads/action_document/';
                $config['allowed_types'] = 'pdf|doc|xml|txt|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                $config['max_size'] = '1000KB';
                $config['encrypt_name'] = FALSE;
            } else {
                $config['upload_path'] = './uploads/action_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1024 * 8;
                $config['encrypt_name'] = FALSE;
            }

            $newFileName = $_FILES[$file_element_name]['name'];
            if ($newFileName) {
                $fileExt = explode(".", $newFileName);
                $filename = time() . "." . $fileExt[1];
                $config['file_name'] = $filename;
            }

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $file_path = $data['file_path'];
                $file_name = $data['file_name'];
                if (file_exists($file_path)) {
                    $status = "success";
                    $msg = "File Successfully uploaded";
                    //echo $this->Common_model->show_massege($_POST['employee_id'],2);
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }

        if ($status == "success") {
            echo $this->Common_model->show_validation_massege($msg, 1) . "__" . $file_name;
        } else {
            echo $this->Common_model->show_validation_massege($msg, 2);
        }
    }

}
