<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_w4 extends CI_Controller {

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
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employee W-4";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_emp_w4', array('company_id' => $this->company_id, 'isactive' => 1));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Employee_w4.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Employee_w4() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
     
        $param['type'] = "1";
        $param['page_header'] = "Employee W-4";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployee_w4.php';
        $this->load->view('admin/home', $param);
    }

    public function save_obw4() {

        $insert_data = array();
        $post_data = $this->input->post();

        $this->form_validation->set_rules('ob_eeo_emp_id', 'Select Candidate', 'required', array('required' => "Please select the Required field, %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $insert_data['employee_id'] = $post_data['ob_eeo_emp_id'];
            $insert_data['term_A'] = $post_data['term_A'];
            $insert_data['term_B'] = $post_data['term_B'];
            $insert_data['term_C'] = $post_data['term_C'];
            $insert_data['term_D'] = $post_data['term_D'];
            $insert_data['term_E'] = $post_data['term_E'];
            $insert_data['term_F'] = $post_data['term_F'];
            $insert_data['term_G'] = $post_data['term_G'];
            $insert_data['term_H'] = $post_data['term_H'];
            $insert_data['first_middle_name'] = $post_data['first_middle_name'];
            $insert_data['last_name'] = $post_data['last_name'];
            $insert_data['ssn'] = $post_data['ssn'];
            $insert_data['home_address'] = $post_data['home_address'];
            if (array_key_exists('marital_status', $post_data)) {
                $insert_data['marital_status'] = $post_data['marital_status'];
            }
            $insert_data['city_state_zip'] = $post_data['city_state_zip'];
            if (array_key_exists('replacement_card', $post_data)) {
                $insert_data['replacement_card'] = $post_data['replacement_card'];
            }
            $insert_data['total_num_allowance'] = $post_data['total_num_allowance'];
            $insert_data['additional_amount'] = $post_data['additional_amount'];
            $insert_data['claim_exemption'] = $post_data['claim_exemption'];
            $insert_data['name_and_address'] = $post_data['name_and_address'];
            $insert_data['office_code'] = $post_data['office_code'];
            $insert_data['ein'] = $post_data['ein'];
            $insert_data['deduc_1'] = $post_data['deduc_1'];
            $insert_data['deduc_2'] = $post_data['deduc_2'];
            $insert_data['deduc_3'] = $post_data['deduc_3'];
            $insert_data['deduc_4'] = $post_data['deduc_4'];
            $insert_data['deduc_5'] = $post_data['deduc_5'];
            $insert_data['deduc_6'] = $post_data['deduc_6'];
            $insert_data['deduc_7'] = $post_data['deduc_7'];
            $insert_data['deduc_8'] = $post_data['deduc_8'];
            $insert_data['deduc_9'] = $post_data['deduc_9'];
            $insert_data['deduc_10'] = $post_data['deduc_10'];
            $insert_data['multijob_1'] = $post_data['multijob_1'];
            $insert_data['multijob_2'] = $post_data['multijob_2'];
            $insert_data['multijob_3'] = $post_data['multijob_3'];
            $insert_data['multijob_4'] = $post_data['multijob_4'];
            $insert_data['multijob_5'] = $post_data['multijob_5'];
            $insert_data['multijob_6'] = $post_data['multijob_6'];
            $insert_data['multijob_7'] = $post_data['multijob_7'];
            $insert_data['multijob_8'] = $post_data['multijob_8'];
            $insert_data['multijob_9'] = $post_data['multijob_9'];

            $insert_data['company_id'] = $this->company_id;
            $insert_data['createddate'] = $this->date_time;
            $insert_data['createdby'] = $this->user_id;
            $insert_data['isactive'] = 1;

            $res = $this->Common_model->insert_data('main_emp_w4', $insert_data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Employeew4() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Employee W-4";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_emp_w4', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployee_w4.php';
        $this->load->view('admin/home', $param);
    }

    public function update_obw4() {

        $data = array();
        $post_data = $this->input->post();
        $id = $this->uri->segment(3);

        /* $this->form_validation->set_rules('ob_eeo_emp_id', 'Select Candidate', 'required', array('required' => "Please select the Required field, %s."));

          if ($this->form_validation->run() == FALSE) {
          echo $this->Common_model->show_validation_massege(validation_errors(), 2);
          } else { */

        /* $data['ob_eeo_emp_id'] = $post_data['ob_eeo_emp_id']; */
        $data['term_A'] = $post_data['term_A'];
        $data['term_B'] = $post_data['term_B'];
        $data['term_C'] = $post_data['term_C'];
        $data['term_D'] = $post_data['term_D'];
        $data['term_E'] = $post_data['term_E'];
        $data['term_F'] = $post_data['term_F'];
        $data['term_G'] = $post_data['term_G'];
        $data['term_H'] = $post_data['term_H'];
        $data['first_middle_name'] = $post_data['first_middle_name'];
        $data['last_name'] = $post_data['last_name'];
        $data['ssn'] = $post_data['ssn'];
        $data['home_address'] = $post_data['home_address'];
        if (array_key_exists('marital_status', $post_data)) {
            $data['marital_status'] = $post_data['marital_status'];
        }
        $data['city_state_zip'] = $post_data['city_state_zip'];
        if (array_key_exists('replacement_card', $post_data)) {
            $data['replacement_card'] = $post_data['replacement_card'];
        }
        $data['total_num_allowance'] = $post_data['total_num_allowance'];
        $data['additional_amount'] = $post_data['additional_amount'];
        $data['claim_exemption'] = $post_data['claim_exemption'];
        $data['name_and_address'] = $post_data['name_and_address'];
        $data['office_code'] = $post_data['office_code'];
        $data['ein'] = $post_data['ein'];
        $data['deduc_1'] = $post_data['deduc_1'];
        $data['deduc_2'] = $post_data['deduc_2'];
        $data['deduc_3'] = $post_data['deduc_3'];
        $data['deduc_4'] = $post_data['deduc_4'];
        $data['deduc_5'] = $post_data['deduc_5'];
        $data['deduc_6'] = $post_data['deduc_6'];
        $data['deduc_7'] = $post_data['deduc_7'];
        $data['deduc_8'] = $post_data['deduc_8'];
        $data['deduc_9'] = $post_data['deduc_9'];
        $data['deduc_10'] = $post_data['deduc_10'];
        $data['multijob_1'] = $post_data['multijob_1'];
        $data['multijob_2'] = $post_data['multijob_2'];
        $data['multijob_3'] = $post_data['multijob_3'];
        $data['multijob_4'] = $post_data['multijob_4'];
        $data['multijob_5'] = $post_data['multijob_5'];
        $data['multijob_6'] = $post_data['multijob_6'];
        $data['multijob_7'] = $post_data['multijob_7'];
        $data['multijob_8'] = $post_data['multijob_8'];
        $data['multijob_9'] = $post_data['multijob_9'];

        $data['createddate'] = $this->date_time;
        $data['createdby'] = $this->user_id;

        $res = $this->Common_model->update_data('main_emp_w4', $data, array('id' => $id));

        if ($res) {
            echo $this->Common_model->show_massege(2, 1);
        } else {
            echo $this->Common_model->show_massege(3, 2);
        }
        /* } */
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_emp_w4", $id);
        redirect('main_emp_w4');
        exit;
    }

    public function ajax_get_candidate_data($ob_employee_id = '') {
        //$this->db->join('main_ob_contact_information', 'main_ob_contact_information.onboarding_employee_id = main_ob_personal_information.onboarding_employee_id', 'LEFT');
        
        $this->db->join('main_state', 'main_state.id = main_employees.state', 'LEFT');
        $this->db->join('main_county', 'main_county.id = main_employees.county', 'LEFT');
        $obw4 = $this->db->get_where('main_employees', array('main_employees.employee_id' => $ob_employee_id))->row();
        $ssn_code['ssn_code']=$this->Common_model->decrypt($obw4->ssn_code);
        $ssn_code = (object) $ssn_code;
        $result = (object) array_merge((array) $obw4, (array) $ssn_code);
        echo json_encode($result);
        exit();
    }

    public function download_pdf() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $tmp = $this->uri->segment(4);

        $param = array();

        $param['data'] = $this->db->get_where('main_emp_w4', array('id' => $id, 'isactive' => 1))->row_array();
        $param['page_header'] = 'W4 Form';

//        pr( $param['data']);
//        if ($tmp == 1) {
        $this->pdf->load_view('hr/reports/empw4_pdf', $param);
        $this->pdf->setPaper('A3', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("w4_form.pdf");
//        } else {
//            $this->load->view('hr/reports/obw4_pdf', $param);
//        }
    }

}
