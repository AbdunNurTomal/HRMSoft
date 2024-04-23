<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_i9 extends CI_Controller {

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

        //if($this->user_type==2){ $this->company_id=$this->company_id;} else { $this->company_id=""; }

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employee I-9";
        $param['module_id'] = $this->module_id;

        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_employee_i9', array('company_id' => $this->company_id));
        } else {
            $param['query'] = $this->db->get('main_employee_i9');
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Employee_i9.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Employee_I9() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Employee I-9";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployee_i9.php';
        $this->load->view('admin/home', $param);
    }

    public function save_ObI9() {


        $this->form_validation->set_rules('onboarding_employee', 'Onboarding Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {


            if ($this->input->post('under_penalty_of_perjury1')) {
                $under_penalty_of_perjury1 = $this->input->post('under_penalty_of_perjury1');
            } else {
                $under_penalty_of_perjury1 = "";
            }

            if ($this->input->post('under_penalty_of_perjury2')) {
                $under_penalty_of_perjury2 = $this->input->post('under_penalty_of_perjury2');
            } else {
                $under_penalty_of_perjury2 = "";
            }

            if ($this->input->post('under_penalty_of_perjury3')) {
                $under_penalty_of_perjury3 = $this->input->post('under_penalty_of_perjury3');
            } else {
                $under_penalty_of_perjury3 = "";
            }

            if ($this->input->post('under_penalty_of_perjury5')) {
                $under_penalty_of_perjury5 = $this->input->post('under_penalty_of_perjury5');
            } else {
                $under_penalty_of_perjury5 = "";
            }

            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('onboarding_employee'),
                'last_name' => $this->input->post('last_name'),
                'fast_name' => $this->input->post('fast_name'),
                'middle_initial' => $this->input->post('middle_initial'),
                'other_name' => $this->input->post('other_name'),
                'address' => $this->input->post('address'),
                'apt_number' => $this->input->post('apt_number'),
                'city_town' => $this->input->post('city_town'),
                'state' => $this->input->post('state'),
                'zip_code' => $this->input->post('zip_code'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'us_ssn' => $this->input->post('us_ssn'),
                'email_address' => $this->input->post('email_address'),
                'telephone_number' => $this->input->post('telephone_number'),
                'under_penalty_of_perjury1' => $under_penalty_of_perjury1,
                'under_penalty_of_perjury2' => $under_penalty_of_perjury2,
                'under_penalty_of_perjury3' => $under_penalty_of_perjury3,
                'lawful_permanent_resident' => $this->input->post('lawful_permanent_resident'),
                'under_penalty_of_perjury5' => $under_penalty_of_perjury5,
                'expiration_date' => $this->input->post('expiration_date'),
                'alien_registration_number' => $this->input->post('alien_registration_number'),
                'admission_number' => $this->input->post('admission_number'),
                'foreign_passport_number' => $this->input->post('foreign_passport_number'),
                'country_of_issuance' => $this->input->post('country_of_issuance'),
                'signature_date' => $this->input->post('signature_date'),
                'barcode' => $this->input->post('barcode'),
                'con_signature_date' => $this->input->post('con_signature_date'),
                'con_last_name' => $this->input->post('con_last_name'),
                'con_first_name' => $this->input->post('con_first_name'),
                'con_address' => $this->input->post('con_address'),
                'con_state' => $this->input->post('con_state'),
                'con_zip_code' => $this->input->post('con_zip_code'),
                'employer_name' => $this->input->post('employer_name'),
                'employer_document_title_a' => $this->input->post('employer_document_title_a'),
                'employer_document_title_b' => $this->input->post('employer_document_title_b'),
                'employer_document_title_c' => $this->input->post('employer_document_title_c'),
                'employer_issuing_authority_a' => $this->input->post('employer_issuing_authority_a'),
                'employer_issuing_authority_b' => $this->input->post('employer_issuing_authority_b'),
                'employer_issuing_authority_c' => $this->input->post('employer_issuing_authority_c'),
                'employer_document_number_a' => $this->input->post('employer_document_number_a'),
                'employer_document_number_b' => $this->input->post('employer_document_number_b'),
                'employer_document_number_c' => $this->input->post('employer_document_number_c'),
                'employer_expiration_date_a' => $this->input->post('employer_expiration_date_a'),
                'employer_expiration_date_b' => $this->input->post('employer_expiration_date_b'),
                'employer_expiration_date_c' => $this->input->post('employer_expiration_date_c'),
                'employer_document_title_a1' => $this->input->post('employer_document_title_a1'),
                'employer_issuing_authority_a1' => $this->input->post('employer_issuing_authority_a1'),
                'employer_document_number_a1' => $this->input->post('employer_document_number_a1'),
                'employer_expiration_date_a1' => $this->input->post('employer_expiration_date_a1'),
                'employer_document_title_a2' => $this->input->post('employer_document_title_a2'),
                'employer_issuing_authority_a2' => $this->input->post('employer_issuing_authority_a2'),
                'employer_document_number_a2' => $this->input->post('employer_document_number_a2'),
                'employer_expiration_date_a2' => $this->input->post('employer_expiration_date_a2'),
                'employer_certification_date' => $this->input->post('employer_certification_date'),
                'employer_signature_date' => $this->input->post('employer_signature_date'),
                'employer_last_name' => $this->input->post('employer_last_name'),
                'employer_first_name' => $this->input->post('employer_first_name'),
                'employer_address' => $this->input->post('employer_address'),
                'employer_city' => $this->input->post('employer_city'),
                'employer_state' => $this->input->post('employer_state'),
                'employer_zip_code' => $this->input->post('employer_zip_code'),
                'rehire_last_name' => $this->input->post('rehire_last_name'),
                'rehire_first_name' => $this->input->post('rehire_first_name'),
                'rehire_middle_initial' => $this->input->post('rehire_middle_initial'),
                'rehire_date' => $this->input->post('rehire_date'),
                'rehire_document_title' => $this->input->post('rehire_document_title'),
                'rehire_document_number' => $this->input->post('rehire_document_number'),
                'rehire_expiration_date' => $this->input->post('rehire_expiration_date'),
                'rehire_signature_date' => $this->input->post('rehire_signature_date'),
                'rehire_authorized_representative' => $this->input->post('rehire_authorized_representative'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );


            $res = $this->Common_model->insert_data('main_employee_i9', $data);
            //die("===>>> " . $this->db->_error_message());

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_entry() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Employee I-9";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_employee_i9', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployee_i9.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_ObI9() {
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if ($this->input->post('under_penalty_of_perjury1')) {
                $under_penalty_of_perjury1 = $this->input->post('under_penalty_of_perjury1');
            } else {
                $under_penalty_of_perjury1 = "";
            }

            if ($this->input->post('under_penalty_of_perjury2')) {
                $under_penalty_of_perjury2 = $this->input->post('under_penalty_of_perjury2');
            } else {
                $under_penalty_of_perjury2 = "";
            }

            if ($this->input->post('under_penalty_of_perjury3')) {
                $under_penalty_of_perjury3 = $this->input->post('under_penalty_of_perjury3');
            } else {
                $under_penalty_of_perjury3 = "";
            }

            if ($this->input->post('under_penalty_of_perjury5')) {
                $under_penalty_of_perjury5 = $this->input->post('under_penalty_of_perjury5');
            } else {
                $under_penalty_of_perjury5 = "";
            }

            $data = array('company_id' => $this->company_id,
                //'onboarding_employee_id' => $this->input->post('onboarding_employee'),
                'last_name' => $this->input->post('last_name'),
                'fast_name' => $this->input->post('fast_name'),
                'middle_initial' => $this->input->post('middle_initial'),
                'other_name' => $this->input->post('other_name'),
                'address' => $this->input->post('address'),
                'apt_number' => $this->input->post('apt_number'),
                'city_town' => $this->input->post('city_town'),
                'state' => $this->input->post('state'),
                'zip_code' => $this->input->post('zip_code'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'us_ssn' => $this->input->post('us_ssn'),
                'email_address' => $this->input->post('email_address'),
                'telephone_number' => $this->input->post('telephone_number'),
                'under_penalty_of_perjury1' => $under_penalty_of_perjury1,
                'under_penalty_of_perjury2' => $under_penalty_of_perjury2,
                'under_penalty_of_perjury3' => $under_penalty_of_perjury3,
                'lawful_permanent_resident' => $this->input->post('lawful_permanent_resident'),
                'under_penalty_of_perjury5' => $under_penalty_of_perjury5,
                'expiration_date' => $this->input->post('expiration_date'),
                'alien_registration_number' => $this->input->post('alien_registration_number'),
                'admission_number' => $this->input->post('admission_number'),
                'foreign_passport_number' => $this->input->post('foreign_passport_number'),
                'country_of_issuance' => $this->input->post('country_of_issuance'),
                'signature_date' => $this->input->post('signature_date'),
                'barcode' => $this->input->post('barcode'),
                'con_signature_date' => $this->input->post('con_signature_date'),
                'con_last_name' => $this->input->post('con_last_name'),
                'con_first_name' => $this->input->post('con_first_name'),
                'con_address' => $this->input->post('con_address'),
                'con_state' => $this->input->post('con_state'),
                'con_zip_code' => $this->input->post('con_zip_code'),
                'employer_name' => $this->input->post('employer_name'),
                'employer_document_title_a' => $this->input->post('employer_document_title_a'),
                'employer_document_title_b' => $this->input->post('employer_document_title_b'),
                'employer_document_title_c' => $this->input->post('employer_document_title_c'),
                'employer_issuing_authority_a' => $this->input->post('employer_issuing_authority_a'),
                'employer_issuing_authority_b' => $this->input->post('employer_issuing_authority_b'),
                'employer_issuing_authority_c' => $this->input->post('employer_issuing_authority_c'),
                'employer_document_number_a' => $this->input->post('employer_document_number_a'),
                'employer_document_number_b' => $this->input->post('employer_document_number_b'),
                'employer_document_number_c' => $this->input->post('employer_document_number_c'),
                'employer_expiration_date_a' => $this->input->post('employer_expiration_date_a'),
                'employer_expiration_date_b' => $this->input->post('employer_expiration_date_b'),
                'employer_expiration_date_c' => $this->input->post('employer_expiration_date_c'),
                'employer_document_title_a1' => $this->input->post('employer_document_title_a1'),
                'employer_issuing_authority_a1' => $this->input->post('employer_issuing_authority_a1'),
                'employer_document_number_a1' => $this->input->post('employer_document_number_a1'),
                'employer_expiration_date_a1' => $this->input->post('employer_expiration_date_a1'),
                'employer_document_title_a2' => $this->input->post('employer_document_title_a2'),
                'employer_issuing_authority_a2' => $this->input->post('employer_issuing_authority_a2'),
                'employer_document_number_a2' => $this->input->post('employer_document_number_a2'),
                'employer_expiration_date_a2' => $this->input->post('employer_expiration_date_a2'),
                'employer_certification_date' => $this->input->post('employer_certification_date'),
                'employer_signature_date' => $this->input->post('employer_signature_date'),
                'employer_last_name' => $this->input->post('employer_last_name'),
                'employer_first_name' => $this->input->post('employer_first_name'),
                'employer_address' => $this->input->post('employer_address'),
                'employer_city' => $this->input->post('employer_city'),
                'employer_state' => $this->input->post('employer_state'),
                'employer_zip_code' => $this->input->post('employer_zip_code'),
                'rehire_last_name' => $this->input->post('rehire_last_name'),
                'rehire_first_name' => $this->input->post('rehire_first_name'),
                'rehire_middle_initial' => $this->input->post('rehire_middle_initial'),
                'rehire_date' => $this->input->post('rehire_date'),
                'rehire_document_title' => $this->input->post('rehire_document_title'),
                'rehire_document_number' => $this->input->post('rehire_document_number'),
                'rehire_expiration_date' => $this->input->post('rehire_expiration_date'),
                'rehire_signature_date' => $this->input->post('rehire_signature_date'),
                'rehire_authorized_representative' => $this->input->post('rehire_authorized_representative'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );


            $res = $this->Common_model->update_data('main_employee_i9', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_employee_i9", $id);
        redirect('Con_Employee_i9/');
        exit;
    }

    public function download_pdf() {

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $this->load->library('Pdf');

        $param = array();
        $param['page_header'] = 'I9 Form';
        $param['i9_data'] = $this->db->get_where('main_employee_i9', array('id' => $id, 'isactive' => 1))->row_array();

        $code = $param['i9_data']['barcode'];

        $param['BarcodeName'] = $BarcodeName = date('Ymd_His_') . $code . '_barcode.png';


        /* ------ZEND Library for Generating Barcode------ */

        foreach (glob(Get_File_Directory('assets/barcode/*barcode.png')) as $filename) { // Unlink Junk files
            $URI_SGMT = explode('/', $filename);

            if (end($URI_SGMT) != $BarcodeName) {
                unlink($filename);
            }
        }

        $this->load->library('barcode');
        $this->barcode->load('Zend/Barcode');

        //load in folder Zend
        //generate barcode
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code, 'barHeight' => 40), array());
        imagepng($file, Get_File_Directory('assets/barcode/' . $BarcodeName));

        /* ----------------------------------------------- */


        //$tmp = $this->uri->segment(4);
        //if ($tmp == 1) {
        $this->pdf->load_view('hr/reports/employeei9_pdf', $param);
        $this->pdf->setPaper('A3', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("i9_form.pdf");
        //} else {
        //    $this->load->view('hr/reports/obi9_pdf', $param);
        //}
    }

}
