<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Exit_Interview extends CI_Controller {

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
        $param['page_header'] = "Employee Exit Interview";
        $param['module_id'] = $this->module_id;

        $this->db->select('main_voluntary_info.id, first_name, middle_name, last_name, termination_type, main_voluntary_info.createddate');
        $this->db->join('main_employees', 'main_employees.employee_id = main_voluntary_info.employee_id');
        $voluntary_data = $this->db->get_where('main_voluntary_info', array('main_voluntary_info.company_id' => $this->company_id))->result_array();


        $this->db->select('main_involuntary_info.id, first_name, middle_name, last_name, termination_type, main_involuntary_info.createddate');
        $this->db->join('main_employees', 'main_employees.employee_id = main_involuntary_info.employee_id');
        $Involuntary_data = $this->db->get_where('main_involuntary_info', array('main_involuntary_info.company_id' => $this->company_id))->result_array();

//        pr($voluntary_data);
//        pr($Involuntary_data, 1);

        $param['Exit_Data'] = array_merge($voluntary_data, $Involuntary_data);

//        pr($param['Exit_Data'], 1);

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Exit_Interviews.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Exit_Interview() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Employee Exit Interview";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addExit_Interviews.php';
        $this->load->view('admin/home', $param);
    }

    public function insert_termination() {
        $termination_type = $this->uri->segment(3);

        if ($termination_type == 0) { /* ---- Voluntary Exit ( Resignation ) ---- */

            $this->form_validation->set_rules('employee_id', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('termination_type', 'Termination type', 'required|numeric|xss_clean', array('required' => "Please the enter required field, for more Info : %s."));
             $this->form_validation->set_rules('reason_for_leaving[]', 'REASON(S) FOR LEAVING', 'required', array('required' => "Please the enter required field, for more Info : %s."));


            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {
                $data = array(
                    'employee_id' => $this->input->post('employee_id'),
                    'company_id' => $this->company_id,
                    'termination_type' => $termination_type,
                    'name_optional' => $this->input->post('name_optional'),
                    'resign_date' => $this->Common_model->convert_to_mysql_date($this->input->post('resign_date')),
                    'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                    'job_title' => $this->input->post('job_title'),
                    'location' => $this->input->post('location'),
                    'reason_for_leaving' => json_encode($this->input->post('reason_for_leaving')),
                    'voluntary_rate' => json_encode($this->input->post('voluntary_rate')),
                    'additional_info' => $this->input->post('additional_info'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1
                );
                //pr($data, 1);

                $res = $this->Common_model->insert_data('main_voluntary_info', $data);
            }
        } else if ($termination_type == 1) { /* ---- In-voluntary Exit ( Termination ) ---- */

            $this->form_validation->set_rules('employee_id', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('termination_type', 'Termination type', 'required|numeric|xss_clean', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('reason_for_termination[]', 'Reason(s) for Termination', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {
                $data = array(
                    'employee_id' => $this->input->post('employee_id'),
                    'company_id' => $this->company_id,
                    'termination_type' => $termination_type,
                    'position_and_dept' => $this->input->post('position_and_dept'),
                    'reason_for_termination' => json_encode($this->input->post('reason_for_termination')),
                    'recomm_for_discharge' => json_encode($this->input->post('recomm_for_discharge')),
                    'interview_procedure' => json_encode($this->input->post('interview_procedure')),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1
                );

                $res = $this->Common_model->insert_data('main_involuntary_info', $data);
            }
        }

        if ($res) {
            echo $this->Common_model->show_massege(0, 1);
        } else {
            echo $this->Common_model->show_massege(1, 2);
        }
    }

    public function edit_termination() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['id'] = $id = $this->uri->segment(3);
        $param['termination_type'] = $termination_type = $this->uri->segment(4);
        // check permission to view the employee starts
        if ($termination_type == 0) {
            if ($this->user_group <= 3) {
            } else if ($this->user_group == 12 && $this->companyView) {
            } else {
                $this->KurunthamModel->checkPageAccess("emp_info_volentary", $this->uri->segment(3) , $this->company_id);
            }
        } else if($termination_type == 1) {
            if ($this->user_group <= 3) {
            } else if ($this->user_group == 12 && $this->companyView) {
            } else {
                $this->KurunthamModel->checkPageAccess("emp_info_involuntary", $this->uri->segment(3) , $this->company_id);
            }
        }
        // check permission to view the employee ends
        if ($termination_type == 0) {
            $param['page_header'] = "Edit Voluntary Termination";
            $param['termination_data'] = $this->db->get_where('main_voluntary_info', array('id' => $id))->row_array();
        } else if ($termination_type == 1) {
            $param['page_header'] = "Edit In-Voluntary Termination";
            $param['termination_data'] = $this->db->get_where('main_involuntary_info', array('id' => $id))->row_array();
        }

        $param['type'] = "2";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addExit_Interviews.php';
        $this->load->view('admin/home', $param);
    }

    public function update_exit_interview() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['id'] = $id = $this->uri->segment(3);
        $param['termination_type'] = $termination_type = $this->uri->segment(4);
        $Emp_Id = $this->input->post('term_employee_id');

        if ($termination_type == 0) { /* ---- Voluntary Exit ( Resignation ) ---- */

            $this->form_validation->set_rules('term_employee_id', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('termination_type', 'Termination type', 'required|numeric|xss_clean', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('reason_for_leaving[]', 'REASON(S) FOR LEAVING', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {
                $data = array(
                    'termination_type' => $termination_type,
                    'name_optional' => $this->input->post('name_optional'),
                    'resign_date' => $this->Common_model->convert_to_mysql_date($this->input->post('resign_date')),
                    'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                    'job_title' => $this->input->post('job_title'),
                    'location' => $this->input->post('location'),
                    'reason_for_leaving' => json_encode($this->input->post('reason_for_leaving')),
                    'voluntary_rate' => json_encode($this->input->post('voluntary_rate')),
                    'additional_info' => $this->input->post('additional_info'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time
                );

                $this->db->where('id', $id);
                $this->db->where('employee_id', $Emp_Id);
                $res = $this->db->update('main_voluntary_info', $data);
            }
        } else if ($termination_type == 1) { /* ---- In-voluntary Exit ( Termination ) ---- */

            $this->form_validation->set_rules('term_employee_id', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('termination_type', 'Termination type', 'required|numeric|xss_clean', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('reason_for_termination[]', 'Reason(s) for Termination', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {
                $data = array(
                    'termination_type' => $termination_type,
                    'position_and_dept' => $this->input->post('position_and_dept'),
                    'reason_for_termination' => json_encode($this->input->post('reason_for_termination')),
                    'recomm_for_discharge' => json_encode($this->input->post('recomm_for_discharge')),
                    'interview_procedure' => json_encode($this->input->post('interview_procedure')),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time
                );

                $this->db->where('id', $id);
                $this->db->where('employee_id', $Emp_Id);
                $res = $this->db->update('main_involuntary_info', $data);
            }
        }

        if ($res) {
            echo $this->Common_model->show_massege(2, 1);
        } else {
            echo $this->Common_model->show_massege(3, 2);
        }
    }
    
    public function ajax_set() {
        $id = $this->uri->segment(3);
        //$data = $this->Common_model->get_by_id_row('main_employees', $id);
        $data = $this->db->get_where('main_employees', array('employee_id' => $id))->row();
        echo json_encode($data);
    }
    
    public function get_ajax_position() {
        $position_id = $this->uri->segment(3);
        $position_name=$this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title');
        $data=array('position_name'=>$position_name);
        echo json_encode($data);
    }
    public function get_ajax_location() {
        $id = $this->uri->segment(3);
        $ddata = $this->db->get_where('main_emp_workrelated', array('employee_id' => $id))->row();
        $location_name=$this->Common_model->get_name($this,$ddata->location,'main_location','location_name');
        $data=array('location'=>$location_name);
        echo json_encode($data);
    }

    /*

      public function save_EmployeeTabs() {
      $this->form_validation->set_rules('tabs_name', 'Tabs Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
      $this->form_validation->set_rules('sequence', 'Sequence', 'required|numeric|xss_clean',array('required'=> "Please the enter required field, for more Info : %s."));
      $this->form_validation->set_rules('isactive', 'Status', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

      if ($this->form_validation->run() == FALSE) {
      echo $this->Common_model->show_validation_massege(validation_errors(),2);
      } else {

      $data = array('company_id' => $this->company_id,
      'tabs_name' => $this->input->post('tabs_name'),
      'sequence' => $this->input->post('sequence'),
      'createdby' => $this->user_id,
      'createddate' => $this->date_time,
      'isactive' => $this->input->post('isactive'),
      );
      $res = $this->Common_model->insert_data('main_employee_tabs', $data);

      if ($res) {
      echo $this->Common_model->show_massege(0,1);
      } else {
      echo $this->Common_model->show_massege(1,2);
      }
      }
      }

      function edit_entry() {
      $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
      $id = $this->uri->segment(3);

      $param['type']="2";
      $param['page_header']="Employee Tabs";
      $param['module_id']=$this->module_id;

      $param['query'] = $this->db->get_where('main_employee_tabs', array('id' => $id));

      $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
      $param['content'] = 'hr/view_addEmployeeTabs.php';
      $this->load->view('admin/home', $param);
      }

      public function edit_EmployeeTabs() {
      $this->form_validation->set_rules('tabs_name', 'Tabs Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
      $this->form_validation->set_rules('sequence', 'Sequence', 'required|numeric|xss_clean',array('required'=> "Please the enter required field, for more Info : %s."));
      $this->form_validation->set_rules('isactive', 'Status', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

      if ($this->form_validation->run() == FALSE) {
      echo $this->Common_model->show_validation_massege(validation_errors(),2);
      } else {

      $data = array('company_id' => $this->company_id,
      'tabs_name' => $this->input->post('tabs_name'),
      'sequence' => $this->input->post('sequence'),
      'modifiedby' => $this->user_id,
      'modifieddate' => $this->date_time,
      'isactive' => $this->input->post('isactive'),
      );

      $res = $this->Common_model->update_data('main_employee_tabs', $data, array('id' => $this->input->post('id')));

      if ($res) {
      echo $this->Common_model->show_massege(2,1);
      } else {
      echo $this->Common_model->show_massege(3,2);
      }
      }
      }

      public function delete_entry() {
      $id = $this->uri->segment(3);
      $this->Common_model->delete_by_id("main_employee_tabs", $id);
      redirect('Con_EmployeeTabs/');
      exit;
      }

     */
}
