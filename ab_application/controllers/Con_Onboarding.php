<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Onboarding extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_group_ParentId = null;
    public $user_menu = null;
    public $user_module = null;
    public $candidate_id = 0;
    public $menu_id = null;
    public $date_time = null;
    public $username = null;
    public $name = null;
    public $policy_id = "";
    public $module_data = array();
    public $module_id = null;
    public $onboarding_employee_data = array();
    public $ob_employee_id = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_group_ParentId = $this->user_data['user_group_ParentId'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        //if(isset($this->user_data['candidate_id']))
        if(array_key_exists('candidate_id', $this->user_data))   
        {
            if($this->user_data['candidate_id'] != "")
            {
                $this->candidate_id = $this->user_data['candidate_id'];
            }
        }

        $this->username = $this->user_data['username'];
        $this->name = $this->user_data['name'];

        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->load->model('Sendmail_model');
    }

    public function index() {

        //print_r($this->session->userdata('active_module_id'));exit();
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        //$this->session->unset_userdata('onboarding_employee');
        //echo $this->module_id;exit();
        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Onboarding Configuration";
        if($this->session->userdata('active_module_id')){
            $param['module_id'] = $this->module_id;
        }else{
            $param['module_id'] = $this->user_module;
            $module_session_array = array('module_id' => $this->user_module);
            $this->session->set_userdata('active_module_id', $module_session_array);
        }
        $param['user_type'] = $this->user_type;

        //echo $this->user_group;exit();
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        if ($this->user_group == 9 || $this->user_group_ParentId == 9) {
            $param['type'] = "1";
            $param['content'] = 'ob/view_addonboarding_dashbord.php';
        } else {
            $param['content'] = 'ob/view_onboarding_user.php';
        }

        $this->load->view('admin/home', $param);
    }

    public function view_onboarding_company_entry_function() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['user_id'] = $this->user_id;
        $param['user_type'] = $this->user_type;
        $param['type'] = "1";
        $param['page_header'] = "Onboarding Configuration";

        if ($this->uri->segment(3) == "") {
            $param['module_id'] = $this->module_id;
        } else {
            $param['module_id'] = 3;
            $this->candidate_id = $this->uri->segment(3);

            $param['candidate_query'] = $this->Common_model->get_by_id_row('main_cv_management', $this->candidate_id);

            $candidate_id_array = array();
            $candidate_id_array = array('candidate_id' => $this->candidate_id);
            $this->session->set_userdata('candidate', $candidate_id_array);
        }
        
        $param['candidate_id'] = $this->candidate_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'ob/view_addonboarding_dashbord.php';
        $this->load->view('admin/home', $param);
    }

    public function view_onboarding_self_user_function() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Onboarding Configuration";
        $param['module_id'] = $this->module_id;
        $param['user_type'] = $this->user_type;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'ob/view_onboarding_selfuser_creation.php';
        $this->load->view('admin/home', $param);
    }

    public function save_selfuser_signup() {

        //$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[main_users.email]', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('firstname', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('passwd', 'Password', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('phone_no', 'Phone No', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $user_group_res = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'parent_id' => 9,'isactive' => 1))->result();
            
            if($user_group_res[0]->id){
                $user_group_id=$user_group_res[0]->id;
            }else{
                $user_group_id=9;
            }

            $data = array('company_id' => $this->company_id,
                'email' => $this->input->post('email'),
                'name' => $this->input->post('firstname'),
                // 'password' => $this->Common_model->encrypt($this->input->post('passwd')),
                'password' => md5($this->input->post('passwd')),
                'phone_no' => $this->input->post('phone_no'),
                'user_group' => $user_group_id,
                'user_type' => '1',
                'password_reset_hash' => md5($this->input->post('passwd')),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            //print_r($data);die();

            $res = $this->Common_model->insert_data('main_users', $data);

            $res = $this->Sendmail_model->selfuser_send_mail($this->input->post('firstname'), $this->input->post('email'), $this->input->post('passwd'));

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function add_Onboarding() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        //$this->session->unset_userdata('onboarding_employee');

        $param['type'] = "1";
        $param['page_header'] = "Onboarding Configuration";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'ob/view_addonboarding_dashbord.php';
        $this->load->view('admin/home', $param);
    }

    //=============================================================================

    public function save_Onboarding_personalinformation() {

        if ($this->user_group == 9) {
            $this->session->unset_userdata('candidate');

            if ($this->Common_model->unique_check("createdby", $this->user_id, "main_ob_personal_information") == true) {
                echo $this->Common_model->show_validation_massege_normal('This User Already Create onboarding Information. Please Update Your Information.', 2);
                exit();
            }
        }

        $candidate_data = $this->session->userdata('candidate');
        $this->candidate_id = $candidate_data['candidate_id'];

        if ($this->candidate_id == "") {
            $this->candidate_id = 0;
        }

        if ($this->candidate_id != 0) {
            if ($this->Common_model->unique_check("candidate_id", $this->candidate_id, "main_ob_personal_information") == true) {
                echo $this->Common_model->show_validation_massege_normal('This Candidate Already Create onboarding information. Please Update Your Information.', 2);
                exit();
            }
        }

        $this->form_validation->set_rules('onboarding_firstname', 'First name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('onboarding_dateofbirth', 'Date OF Birth', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('onboarding_lastname', 'Last Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('onboarding_socialsecuritynumber', 'Social Security Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege_normal(validation_errors(), 2);
        } else {
            if ($this->input->post('onboarding_employee_id') == "") {
                $onboarding_employee_id = $this->Common_model->return_next_id('id', 'main_ob_personal_information');
                $data = array('onboarding_employee_id' => $onboarding_employee_id,
                    'company_id' => $this->company_id,
                    'onboarding_firstname' => $this->input->post('onboarding_firstname'),
                    'onboarding_middlename' => $this->input->post('onboarding_middlename'),
                    'onboarding_lastname' => $this->input->post('onboarding_lastname'),
                    'onboarding_suffix' => $this->input->post('onboarding_suffix'),
                    'onboarding_maidenname' => $this->input->post('onboarding_maidenname'),
                    'onboarding_dateofbirth' => $this->Common_model->convert_to_mysql_date($this->input->post('onboarding_dateofbirth')),
                    'onboarding_socialsecuritynumber' => $this->input->post('onboarding_socialsecuritynumber'),
                    'gender' => $this->input->post('gender'),
                    'candidate_id' => $this->candidate_id,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                //print_r($data);exit();

                $res = $this->Common_model->insert_data('main_ob_personal_information', $data);

                if ($res) {

                    $mail_data = array('onboarding_employee_id' => $onboarding_employee_id,
                        'personalinformation' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                    $mail_res = $this->Common_model->insert_data('main_ob_send_mail', $mail_data);

                    $ob_emp_sess_array = array();
                    $ob_emp_sess_array = array('onboarding_employee_id' => $onboarding_employee_id);
                    $this->session->set_userdata('onboarding_employee', $ob_emp_sess_array);

                    echo $this->Common_model->show_massege_normal(0, 1) . "_" . $onboarding_employee_id;
                } else {
                    echo $this->Common_model->show_massege_normal(1, 2) . "_" . $onboarding_employee_id;
                }
            } else {

                $onboarding_employee_id = $this->input->post('onboarding_employee_id');
                $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                    'company_id' => $this->company_id,
                    'onboarding_firstname' => $this->input->post('onboarding_firstname'),
                    'onboarding_middlename' => $this->input->post('onboarding_middlename'),
                    'onboarding_lastname' => $this->input->post('onboarding_lastname'),
                    'onboarding_suffix' => $this->input->post('onboarding_suffix'),
                    'onboarding_maidenname' => $this->input->post('onboarding_maidenname'),
                    'onboarding_dateofbirth' => $this->Common_model->convert_to_mysql_date($this->input->post('onboarding_dateofbirth')),
                    'onboarding_socialsecuritynumber' => $this->input->post('onboarding_socialsecuritynumber'),
                    'gender' => $this->input->post('gender'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->update_data('main_ob_personal_information', $data, array('onboarding_employee_id' => $this->input->post('onboarding_employee_id')));

                if ($res) {
                    $ob_emp_sess_array = array();
                    $ob_emp_sess_array = array('onboarding_employee_id' => $onboarding_employee_id);
                    $this->session->set_userdata('onboarding_employee', $ob_emp_sess_array);

                    echo $this->Common_model->show_massege_normal(2, 1) . "_" . $onboarding_employee_id;
                } else {
                    echo $this->Common_model->show_massege_normal(3, 2) . "_" . $onboarding_employee_id;
                }
            }
        }
    }

    //=============================================================================

    public function save_onboarding_contactinformation() {

        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email|is_unique[main_ob_contact_information.email_address]', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege_normal(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            if ($this->input->post('ob_con_emp_id') == "") {
                $data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'company_id' => $this->company_id,
                    'email_address' => $this->input->post('email_address'),
                    'home_phone' => $this->input->post('home_phone'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    'work_phone' => $this->input->post('work_phone'),
                    'street_address1' => $this->input->post('street_address1'),
                    'street_address2' => $this->input->post('street_address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode'),
                    'county' => $this->input->post('county'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->insert_data('main_ob_contact_information', $data);

                if ($res) {

                    $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                        'contactinformation' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                    $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));


                    echo $this->Common_model->show_massege_normal(0, 1) . "_" . $this->ob_employee_id;
                } else {
                    echo $this->Common_model->show_massege_normal(1, 2) . "_" . "";
                }
            } else {
                $data = array('onboarding_employee_id' => $this->input->post('ob_con_emp_id'),
                    'company_id' => $this->company_id,
                    'email_address' => $this->input->post('email_address'),
                    'home_phone' => $this->input->post('home_phone'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    'work_phone' => $this->input->post('work_phone'),
                    'street_address1' => $this->input->post('street_address1'),
                    'street_address2' => $this->input->post('street_address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode'),
                    'county' => $this->input->post('county'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->update_data('main_ob_contact_information', $data, array('onboarding_employee_id' => $this->input->post('ob_con_emp_id')));

                if ($res) {
                    echo $this->Common_model->show_massege_normal(2, 1) . "_" . $this->input->post('ob_con_emp_id');
                } else {
                    echo $this->Common_model->show_massege_normal(3, 2) . "_" . $this->input->post('ob_con_emp_id');
                }
            }
        }
    }

    //=============================================================================  

    public function save_onboarding_emergencycontact() {
        $this->form_validation->set_rules('first_name', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('relationship_with_employee', 'Relationship With Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('primary_phone', 'Primary Phone', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege_normal(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            if ($this->input->post('ob_emc_emp_id') == "") {
                $data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'company_id' => $this->company_id,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'relationship_with_employee' => $this->input->post('relationship_with_employee'),
                    'primary_phone' => $this->input->post('primary_phone'),
                    'secondary_phone' => $this->input->post('secondary_phone'),
                    'address' => $this->input->post('address'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->insert_data('main_ob_emergencycontact', $data);

                if ($res) {

                    $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                        'emergencycontact' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                    $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                    echo $this->Common_model->show_massege_normal(0, 1) . "_" . $this->ob_employee_id;
                } else {
                    echo $this->Common_model->show_massege_normal(1, 2) . "_" . "";
                }
            } else {
                $data = array('onboarding_employee_id' => $this->input->post('ob_emc_emp_id'),
                    'company_id' => $this->company_id,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'relationship_with_employee' => $this->input->post('relationship_with_employee'),
                    'primary_phone' => $this->input->post('primary_phone'),
                    'secondary_phone' => $this->input->post('secondary_phone'),
                    'address' => $this->input->post('address'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->update_data('main_ob_emergencycontact', $data, array('onboarding_employee_id' => $this->input->post('ob_emc_emp_id')));

                if ($res) {
                    echo $this->Common_model->show_massege_normal(2, 1) . "_" . $this->input->post('ob_emc_emp_id');
                } else {
                    echo $this->Common_model->show_massege_normal(3, 2) . "_" . $this->input->post('ob_emc_emp_id');
                }
            }
        }
    }

    //=============================================================================   

    public function save_onboarding_employmenthistory() {
        $this->form_validation->set_rules('employer', 'Employer', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('start_date', 'Start Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('end_date', 'End Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'employer' => $this->input->post('employer'),
                'position' => $this->input->post('position'),
                'start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('start_date')),
                'end_date' => $this->Common_model->convert_to_mysql_date($this->input->post('end_date')),
                'reason_for_leaving' => $this->input->post('reason_for_leaving'),
                'contact_employee' => $this->input->post('contact_employee'),
                'supervisor_name' => $this->input->post('supervisor_name'),
                'phone_no' => $this->input->post('phone_no'),
                'starting_compensation' => $this->input->post('starting_compensation'),
                'ending_compensation' => $this->input->post('ending_compensation'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_ob_employmenthistory', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'employmenthistory' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );
                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(1, 2) . "_" . "";
            }
        }
    }

    public function ajax_edit_employmenthistory() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_employmenthistory', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_employmenthistory() {
        $this->form_validation->set_rules('employer', 'Employer', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('start_date', 'Start Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('end_date', 'End Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->ob_employee_id = $this->input->post('onboarding_employee_id');
            $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                'company_id' => $this->company_id,
                'employer' => $this->input->post('employer'),
                'position' => $this->input->post('position'),
                'start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('start_date')),
                'end_date' => $this->Common_model->convert_to_mysql_date($this->input->post('end_date')),
                'reason_for_leaving' => $this->input->post('reason_for_leaving'),
                'contact_employee' => $this->input->post('contact_employee'),
                'supervisor_name' => $this->input->post('supervisor_name'),
                'phone_no' => $this->input->post('phone_no'),
                'starting_compensation' => $this->input->post('starting_compensation'),
                'ending_compensation' => $this->input->post('ending_compensation'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_ob_employmenthistory', $data, array('id' => $this->input->post('employmenthistory_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . "";
            }
        }
    }

    public function delete_entry_employmenthistory() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_employmenthistory", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

//==============================================================================    

    public function save_onboarding_reference() {
        $this->form_validation->set_rules('name', 'Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('relationship', 'Relationship', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'name' => $this->input->post('name'),
                'relationship' => $this->input->post('relationship'),
                'reference_email' => $this->input->post('reference_email'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_ob_reference', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'reference' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(1, 2) . "_" . "";
            }
        }
    }

    public function ajax_edit_reference() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_reference', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_reference() {
        $this->form_validation->set_rules('name', 'Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('relationship', 'Relationship', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->ob_employee_id = $this->input->post('onboarding_employee_id');
            $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                'company_id' => $this->company_id,
                'name' => $this->input->post('name'),
                'relationship' => $this->input->post('relationship'),
                'reference_email' => $this->input->post('reference_email'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_ob_reference', $data, array('id' => $this->input->post('onboarding_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . "";
            }
        }
    }

    public function delete_entry_reference() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_reference", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_onboarding_education() {
        $this->form_validation->set_rules('educationlevel', 'Education Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('institution_name', 'Institution Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'educationlevel' => $this->input->post('educationlevel'),
                'institution_name' => $this->input->post('institution_name'),
                'no_of_years' => $this->input->post('no_of_years'),
                'graduated' => $this->input->post('graduated'),
                'degree_obtained' => $this->input->post('degree_obtained'),
                'edu_remarks' => $this->input->post('edu_remarks'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_ob_education', $data);

            if ($res) {
                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'education' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );
                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(1, 2) . "_" . "";
            }
        }
    }

    public function ajax_edit_education() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_education', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_education() {
        $this->form_validation->set_rules('educationlevel', 'Education Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('institution_name', 'Institution Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->ob_employee_id = $this->input->post('onboarding_employee_id');
            $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                'company_id' => $this->company_id,
                'educationlevel' => $this->input->post('educationlevel'),
                'institution_name' => $this->input->post('institution_name'),
                'no_of_years' => $this->input->post('no_of_years'),
                'graduated' => $this->input->post('graduated'),
                'degree_obtained' => $this->input->post('degree_obtained'),
                'edu_remarks' => $this->input->post('edu_remarks'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_ob_education', $data, array('id' => $this->input->post('education_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . "";
            }
        }
    }

    public function delete_entry_education() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_education", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_onboarding_criminalhistory() {
        $this->form_validation->set_rules('offense_type', 'Offense Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('offense', 'Offense', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('offense_date', 'Offense Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('city', 'City', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'offense_type' => $this->input->post('offense_type'),
                'offense' => $this->input->post('offense'),
                'offense_date' => $this->Common_model->convert_to_mysql_date($this->input->post('offense_date')),
                'city' => $this->input->post('city'),
                'county' => $this->input->post('county'),
                'offense_state' => $this->input->post('offense_state'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_ob_criminalhistory', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'criminalhistory' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(1, 2) . "_" . $this->ob_employee_id;
            }
        }
    }

    public function ajax_edit_criminalhistory() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_criminalhistory', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_criminalhistory() {
        $this->form_validation->set_rules('offense_type', 'Offense Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('offense', 'Offense', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('offense_date', 'Offense Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('city', 'City', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->ob_employee_id = $this->input->post('onboarding_employee_id');
            $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                'company_id' => $this->company_id,
                'offense_type' => $this->input->post('offense_type'),
                'offense' => $this->input->post('offense'),
                'offense_date' => $this->Common_model->convert_to_mysql_date($this->input->post('offense_date')),
                'city' => $this->input->post('city'),
                'county' => $this->input->post('county'),
                'offense_state' => $this->input->post('offense_state'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_ob_criminalhistory', $data, array('id' => $this->input->post('criminalhistory_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . "";
            }
        }
    }

    public function delete_entry_criminalhistory() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_criminalhistory", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_onboarding_directdeposit() {

        $this->form_validation->set_rules('bank_name', 'Bank Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('account_number', 'Account Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('routing_number', 'routing Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('account_type', 'Account Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'bank_name' => $this->input->post('bank_name'),
                'account_number' => $this->input->post('account_number'),
                'routing_number' => $this->input->post('routing_number'),
                'account_type' => $this->input->post('account_type'),
                'amount_type' => $this->input->post('amount_type'),
                'acc_value' => $this->input->post('acc_value'),
                'paid_check' => $this->input->post('paid_check'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_ob_direct_deposit', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'direct_deposit' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(1, 2) . "_" . "";
            }
        }
    }

    public function ajax_edit_directdeposit() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_direct_deposit', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_directdeposit() {
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('account_number', 'Account Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('routing_number', 'routing Number', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('account_type', 'Account Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->ob_employee_id = $this->input->post('onboarding_employee_id');
            $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                'company_id' => $this->company_id,
                'bank_name' => $this->input->post('bank_name'),
                'account_number' => $this->input->post('account_number'),
                'routing_number' => $this->input->post('routing_number'),
                'account_type' => $this->input->post('account_type'),
                'amount_type' => $this->input->post('amount_type'),
                'acc_value' => $this->input->post('acc_value'),
                'paid_check' => $this->input->post('paid_check'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_ob_direct_deposit', $data, array('id' => $this->input->post('directdeposit_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . "";
            }
        }
    }

    public function delete_entry_directdeposit() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_direct_deposit", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_onboarding_companypolicies() {

//        $this->form_validation->set_rules('policy_id[]', 'Policy', 'required');
//        
//        if ($this->form_validation->run() == FALSE) {
//            echo $this->Common_model->show_massege(validation_errors(), 2);
//        } else {

        $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
        $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

        if ($this->ob_employee_id == "") {

            if ($this->input->post("policy_id")) {
                $policy_id = $this->input->post("policy_id");

                $data = array();
                $k = 0;
                for ($i = 0; $i < count($policy_id); $i++) {
                    $k++;
                    $data[$i] = array('onboarding_employee_id' => $this->ob_employee_id,
                        'company_id' => $this->company_id,
                        'policy_id' => $policy_id[$i],
                        'is_aggree' => $this->input->post("is_aggree" . $k),
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                }
            }

            $res = $this->db->insert_batch('main_ob_company_policies', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'company_policy' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege_normal(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege_normal(1, 2) . "_" . $this->ob_employee_id;
            }
        } else {

            $this->db->where('onboarding_employee_id', $this->ob_employee_id);
            $this->db->delete('main_ob_company_policies');

            if ($this->input->post("policy_id")) {
                $policy_id = $this->input->post("policy_id");

                $data = array();
                $k = 0;
                for ($i = 0; $i < count($policy_id); $i++) {
                    $k++;
                    $data[$i] = array('onboarding_employee_id' => $this->ob_employee_id,
                        'company_id' => $this->company_id,
                        'policy_id' => $policy_id[$i],
                        'is_aggree' => $this->input->post("is_aggree" . $k),
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                }
            }

            $res = $this->db->insert_batch('main_ob_company_policies', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'company_policy' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege_normal(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege_normal(3, 2) . "_" . $this->ob_employee_id;
            }
        }
        //}
    }

    //==========================================================================
    //==========================================================================

    public function save_onboarding_eeopolicies() {
        $this->form_validation->set_rules('eeo_id', 'Self Identification', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege_normal(validation_errors(), 2);
        } else {
            if ($this->input->post('ob_eeo_emp_id') == "") {

                $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

                $data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'company_id' => $this->company_id,
                    'policy_id' => $this->input->post("eeo_id"),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->insert_data('main_ob_eeo_policies', $data);

                if ($res) {

                    $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                        'eeo_policy' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );

                    $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                    echo $this->Common_model->show_massege_normal(0, 1) . "_" . $this->ob_employee_id;
                } else {
                    echo $this->Common_model->show_massege_normal(1, 2) . "_" . $this->ob_employee_id;
                }
            } else {

                $data = array('onboarding_employee_id' => $this->input->post('ob_eeo_emp_id'),
                    'company_id' => $this->company_id,
                    'policy_id' => $this->input->post("eeo_id"),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->update_data('main_ob_eeo_policies', $data, array('onboarding_employee_id' => $this->input->post('ob_eeo_emp_id')));

                if ($res) {
                    echo $this->Common_model->show_massege_normal(2, 1) . "_" . $this->input->post('ob_eeo_emp_id');
                } else {
                    echo $this->Common_model->show_massege_normal(3, 2) . "_" . $this->input->post('ob_eeo_emp_id');
                }
            }
        }
    }

    //==========================================================================

    public function save_onboarding_enrolling() {
        $this->form_validation->set_rules('obenrolling_fast_name', 'Fast Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_last_name', 'Last Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_relationship', 'Relationship', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_gender', 'Gender', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_birthdate', 'Date Of Birth', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'fast_name' => $this->input->post('obenrolling_fast_name'),
                'middle_name' => $this->input->post('obenrolling_middle_name'),
                'last_name' => $this->input->post('obenrolling_last_name'),
                'suffix' => $this->input->post('obenrolling_suffix'),
                'relationship' => $this->input->post('obenrolling_relationship'),
                'gender' => $this->input->post('obenrolling_gender'),
                'date_of_birth' => $this->Common_model->convert_to_mysql_date($this->input->post('obenrolling_birthdate')),
                'age' => $this->input->post('obenrolling_age'),
                'ssn' => $this->input->post('obenrolling_ssn'),
                'is_collage_student' => $this->input->post('obenrolling_iscollage_student'),
                'is_tobacco_user' => $this->input->post('obenrolling_istobacco_user'),
                //'employee_address' => $this->input->post('obenrolling_employee_address'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_ob_enrolling', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'enrolling' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_enrolling() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_enrolling', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_enrolling() {

        $this->form_validation->set_rules('obenrolling_fast_name', 'Fast Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_last_name', 'Last Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_relationship', 'Relationship', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_gender', 'Gender', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('obenrolling_birthdate', 'Date Of Birth', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->ob_employee_id = $this->input->post('onboarding_employee_id');
            $data = array('onboarding_employee_id' => $this->input->post('onboarding_employee_id'),
                'company_id' => $this->company_id,
                'fast_name' => $this->input->post('obenrolling_fast_name'),
                'middle_name' => $this->input->post('obenrolling_middle_name'),
                'last_name' => $this->input->post('obenrolling_last_name'),
                'suffix' => $this->input->post('obenrolling_suffix'),
                'relationship' => $this->input->post('obenrolling_relationship'),
                'gender' => $this->input->post('obenrolling_gender'),
                'date_of_birth' => $this->Common_model->convert_to_mysql_date($this->input->post('obenrolling_birthdate')),
                'age' => $this->input->post('obenrolling_age'),
                'ssn' => $this->input->post('obenrolling_ssn'),
                'is_collage_student' => $this->input->post('obenrolling_iscollage_student'),
                'is_tobacco_user' => $this->input->post('obenrolling_istobacco_user'),
                //'employee_address' => $this->input->post('obenrolling_employee_address'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_ob_enrolling', $data, array('id' => $this->input->post('enrolling_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_enrolling() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_enrolling", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_onboarding_benefit() {

        $this->form_validation->set_rules('provider', 'Provider', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('eligible_date', 'eligible date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('enrolled_date', 'enrolled date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('benefit_enrolling', 'Enrolling', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'enrolling' => $this->input->post('benefit_enrolling'),
                'provider' => $this->input->post('provider'),
                'benefit_type' => $this->input->post('benefit_type'),
                'eligible_date' => $this->Common_model->convert_to_mysql_date($this->input->post('eligible_date')),
                'enrolled_date' => $this->Common_model->convert_to_mysql_date($this->input->post('enrolled_date')),
                'percent_dollars' => $this->input->post('percent_dollars'),
                'employee_portion' => $this->input->post('employee_portion'),
                'employer_portion' => $this->input->post('employer_portion'),
                'description' => $this->input->post('description'),
                'deduction_frequency' => $this->input->post('deduction_frequency'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => $this->input->post('benefit_status'),
            );
            $res = $this->Common_model->insert_data('main_ob_benefit', $data);

            if ($res) {

                $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'benefit' => 1,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

                echo $this->Common_model->show_massege(0, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(1, 2) . "_" . $this->ob_employee_id;
            }
        }
    }

    public function ajax_edit_benefit() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_ob_benefit', $id);
        echo json_encode($data);
    }

    public function edit_onboarding_benefit() {

        $this->form_validation->set_rules('provider', 'Provider', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('eligible_date', 'eligible date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('enrolled_date', 'enrolled date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('benefit_enrolling', 'Enrolling', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            $data = array('onboarding_employee_id' => $this->ob_employee_id,
                'company_id' => $this->company_id,
                'enrolling' => $this->input->post('benefit_enrolling'),
                'provider' => $this->input->post('provider'),
                'benefit_type' => $this->input->post('benefit_type'),
                'eligible_date' => $this->Common_model->convert_to_mysql_date($this->input->post('eligible_date')),
                'enrolled_date' => $this->Common_model->convert_to_mysql_date($this->input->post('enrolled_date')),
                'percent_dollars' => $this->input->post('percent_dollars'),
                'employee_portion' => $this->input->post('employee_portion'),
                'employer_portion' => $this->input->post('employer_portion'),
                'description' => $this->input->post('description'),
                'deduction_frequency' => $this->input->post('deduction_frequency'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => $this->input->post('benefit_status'),
            );

            $res = $this->Common_model->update_data('main_ob_benefit', $data, array('id' => $this->input->post('benefit_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . $this->ob_employee_id;
            }
        }
    }

    public function delete_entry_benefit() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_ob_benefit", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }



    //=========================================================================

    public function save_onboarding_documents() {
        $res=TRUE;
        if ($res) {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];
            echo $this->Common_model->show_massege_normal(0, 1) . "_" . $this->ob_employee_id;
        } else {
            echo $this->Common_model->show_massege_normal(1, 2) . "_" . "";
        }
        exit();

        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email|is_unique[main_ob_contact_information.email_address]', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege_normal(validation_errors(), 2);
        } else {
            $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
            $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

            if ($this->input->post('ob_con_emp_id') == "") {
                $data = array('onboarding_employee_id' => $this->ob_employee_id,
                    'company_id' => $this->company_id,
                    'email_address' => $this->input->post('email_address'),
                    'home_phone' => $this->input->post('home_phone'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    'work_phone' => $this->input->post('work_phone'),
                    'street_address1' => $this->input->post('street_address1'),
                    'street_address2' => $this->input->post('street_address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode'),
                    'county' => $this->input->post('county'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->insert_data('main_ob_contact_information', $data);

                if ($res) {

                    $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                        'contactinformation' => 1,
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                    $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));


                    echo $this->Common_model->show_massege_normal(0, 1) . "_" . $this->ob_employee_id;
                } else {
                    echo $this->Common_model->show_massege_normal(1, 2) . "_" . "";
                }
            } else {
                $data = array('onboarding_employee_id' => $this->input->post('ob_con_emp_id'),
                    'company_id' => $this->company_id,
                    'email_address' => $this->input->post('email_address'),
                    'home_phone' => $this->input->post('home_phone'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    'work_phone' => $this->input->post('work_phone'),
                    'street_address1' => $this->input->post('street_address1'),
                    'street_address2' => $this->input->post('street_address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode'),
                    'county' => $this->input->post('county'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                $res = $this->Common_model->update_data('main_ob_contact_information', $data, array('onboarding_employee_id' => $this->input->post('ob_con_emp_id')));

                if ($res) {
                    echo $this->Common_model->show_massege_normal(2, 1) . "_" . $this->input->post('ob_con_emp_id');
                } else {
                    echo $this->Common_model->show_massege_normal(3, 2) . "_" . $this->input->post('ob_con_emp_id');
                }
            }
        }
    }

    //==========================================================================
    //==========================================================================

    public function submit_onboarding_data() {

        $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
        $this->ob_employee_id = $this->onboarding_employee_data['onboarding_employee_id'];

        $query = $this->db->get_where('main_ob_send_mail', array('onboarding_employee_id' => $this->ob_employee_id));
        if ($query) {
            foreach ($query->result() as $obrow) {
                $personal_information = $obrow->personalinformation;
                $contactinformation = $obrow->contactinformation;
                $emergencycontact = $obrow->emergencycontact;
                $employmenthistory = $obrow->employmenthistory;
                $reference = $obrow->reference;
                $education = $obrow->education;
                $criminalhistory = $obrow->criminalhistory;
                $direct_deposit = $obrow->direct_deposit;
                $company_policy = $obrow->company_policy;
                $eeo_policy = $obrow->eeo_policy;
                $enrolling = $obrow->enrolling;
                $benefit = $obrow->benefit;
                $status = $obrow->status;
            }
        }

        if ($personal_information != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up all Tab information . ', 2) . "_" . "PersonalInformation";
        } else if ($contactinformation != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Contact Information Tab Information . ', 2) . "_" . "ContactInformation";
        } else if ($emergencycontact != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Emergency Contact Tab Information . ', 2) . "_" . "emergencycontact";
        } 
        // else if ($employmenthistory != 1) {
        //     echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Employment History Tab Information . ', 2) . "_" . "employmenthistory";
        // } else if ($reference != 1) {
        //     echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Reference Tab Information . ', 2) . "_" . "reference";
        // } else if ($education != 1) {
        //     echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Education Tab Information . ', 2) . "_" . "education";
        // }
//        else if ( $criminalhistory != 1) {
//            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Criminal History Tab Information . ', 2). "_" . "criminalhistory";
//        } 
        else if ($company_policy != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Company Policy Tab Information . ', 2) . "_" . "companypolicies";
        } else if ($eeo_policy != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up EEO Policy Tab Information . ', 2) . "_" . "eeo";
        } else if ($enrolling != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Enrolling Tab Information . ', 2) . "_" . "enrolling";
        } else if ($benefit != 1) {
            echo $this->Common_model->show_validation_massege(' Data Submit Not Successful. Please fill up Benefit Tab Information . ', 2) . "_" . "benefit";
        } else if ($status == 1) {
            echo $this->Common_model->show_validation_massege(' Already Submit Your Application . ', 2);
        } else {

            $mail_data = array('onboarding_employee_id' => $this->ob_employee_id,
                'status' => 1,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $mail_res = $this->Common_model->update_data('main_ob_send_mail', $mail_data, array('onboarding_employee_id' => $this->ob_employee_id));

            if ($mail_res) {
                echo $this->Common_model->show_massege(6, 1) . "_" . $this->ob_employee_id;
            } else {
                echo $this->Common_model->show_massege(7, 2) . "_" . $this->ob_employee_id;
            }
        }
    }

    //==========================================================================
}
