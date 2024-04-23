<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_configaration extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
    public $module_id = null;
    public $menu_id = null;
    public $date_time = null;
    public $insert_company_id = null;
    public $insert_company_user_id = null;
    public $company_settings_id = null;
    public $companyView = false;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('hr_logged_in')) {
            redirect('Chome/logout', 'refresh');
        }

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

        $company_data = $this->session->userdata('company');
        $this->company_settings_id = $company_data['company_settings_id'];
        $this->companyView = $this->user_data['company_view'];

        $this->load->model('Sendmail_model');
    }

//    public function index() {
//        $this->menu_id = $this->uri->segment(3);
//        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
//
//        $param['module_id'] = $this->module_id;
//
//        $param['user_group'] = $this->user_group;
//        $param['user_id'] = $this->user_id;
//        $param['page_header'] = "Configaration";
//
//        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
//        $param['content'] = 'company_settings/view_configaration.php';
//        $this->load->view('admin/home', $param);
//    }
    //==========================================================================
    //==========================================================================
    //public function view_company_setting_list() {
    public function index() {
        if (!$this->user_id) {
            redirect('Chome/logout', 'refresh');
        }

        $this->session->unset_userdata('company');

        $param['module_id'] = $this->module_id;
        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Company Settings List";

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'company_settings/view_company_setting_list.php';
        $this->load->view('admin/home', $param);
    }

    public function add_company_setting() {
        if (!$this->user_id) {
            redirect('Chome/logout', 'refresh');
        }

        if(!$this->module_id)$this->module_id=0;

        $param['state_query'] = $this->Common_model->listItem('main_state');
        $param['module_id'] = $this->module_id;
        $param['type'] = 1;
        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Company Settings";

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'company_settings/view_company_setting.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_company_setting() {
        if (!$this->user_id) {
            redirect('chome/logout', 'refresh');
        }
        $id =$this->uri->segment(3);
        $company_settings_array = array();
        $company_settings_array = array('company_settings_id' => $this->uri->segment(3));
        $this->session->set_userdata('company', $company_settings_array);

        $param['query'] = $this->db->get_where('main_company', array('id' => $this->uri->segment(3)));
        
        $param['corporation_type_array'] = $this->Common_model->get_array('corporation_type');
        $param['billing_type_array'] = $this->Common_model->get_array('billing_type');
        $param['pricing_setup_array'] = $this->Common_model->get_array('pricing_setup');
        $param['payable_type_array'] = $this->Common_model->get_array('payable_type');
        $param['status_array'] = $this->Common_model->get_array('status');
        
        $param['state_query'] = $this->Common_model->listItem('main_state');
        //$param['county_query'] = $this->db->get_where('main_county', array('isactive' => 1));
          // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            //print_r($this->uri->segment(3)); exit;
            $this->KurunthamModel->checkPageAccess("company", $id, $this->company_id);
        }
        // check permission to view the employee ends
        $param['type'] = 2;
        $param['module_id'] = $this->module_id;
        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Company Settings";

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'company_settings/view_company_setting.php';
        $this->load->view('admin/home', $param);
    }

    //==========================================================================

    public function save_company_settings() {

       require_once( 'assets/slimimage/server/slim.php');
        $images = Slim::getImages('slim');

        $this->form_validation->set_rules('company_full_name', 'Company Full Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('company_short_name', 'Company Short Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('corporation_type', 'Corporation Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('ein_number', 'EIN Number', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('billing_cycle', 'Billing Cycle', 'required', array('required' => "Please enter the required field, for more Info : %s."));
       // $this->form_validation->set_rules('billing_type', 'Billing Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('address_1', 'Address 1', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('county_id', 'County', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('state', 'State', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('zip_code', 'Zip Code', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_1', 'Primary Phone', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('HR360_GUID', 'GUID', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if ($this->input->post('company_ID') == "") {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[main_users.email]', array('required' => "Please enter the required field, for more Info : %s."));
                if ($this->form_validation->run() == FALSE) {
                    echo $this->Common_model->show_validation_massege(validation_errors(), 2);
                } else {
                    
                    $this->db->trans_begin();
                    
                    $data = array('user_id' => $this->user_id,
                        'company_full_name' => $this->input->post('company_full_name'),
                        'company_short_name' => $this->input->post('company_short_name'),
                        'show_in_header' => $this->input->post('show_in_header'),
                        'corporation_type' => $this->input->post('corporation_type'),
                        'ein_number' => $this->input->post('ein_number'),
                        'address_1' => $this->input->post('address_1'),
                        'address_2' => $this->input->post('address_2'),
                        'county_id' => $this->input->post('county_id'),
                        'state' => $this->input->post('state'),
                        'city' => $this->input->post('city'),
                        'zip_code' => $this->input->post('zip_code'),
                        'phone_1' => $this->input->post('phone_1'),
                        'phone_2' => $this->input->post('phone_2'),
                        'fax_no' => $this->input->post('fax_no'),
                        'email' => $this->input->post('email'),
                        'mobile_phone' => $this->input->post('mobile_phone'),
                        
                        //'billing_cycle' => $this->input->post('billing_cycle'),
                        /*'billing_type' => $this->input->post('billing_type'),
                        'rate' => $this->input->post('rate'),
                        'pricing_setup' => $this->input->post('pricing_setup'),
                        'payable_type' => $this->input->post('payable_type'),*/
                        //'employee_type' => $this->input->post('employee_type'),
                        'leave_track_by' => $this->input->post('leave_track_by'),
                        'HR360_GUID' => $this->input->post('HR360_GUID'),
                        //'db_user' => 'ci_dev',
                        //'db_password' => 'bd511b2bdbcb83766886f187df70250epmafede99aab1e77b495a24fe502495264a',
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        //'isactive' => $this->input->post('status'),
                        'isactive' => '1',
                    );

                    $res = $this->Common_model->insert_data('main_company', $data);
                    $this->insert_company_id = $this->db->insert_id();
                    $this->company_settings_id = $this->insert_company_id;

                    //===========================================================
                    $imgfilename = "";
                    if ($images) {
                        foreach ($images as $image) {
                            $fileExt = explode(".", $image['input']['name']);
                            $imgfilename = $this->insert_company_id . "." . $fileExt[1];
                            @unlink($_FILES[$imgfilename]);
                            $file = Slim::saveFile($image['output']['data'], $imgfilename, 'uploads/companylogo', false);
                        }
                    }
                    
                    $db_name="us_hrm_".$this->insert_company_id;
                    $ldata = array('company_logo' => $imgfilename);
                    $logores = $this->Common_model->update_data('main_company', $ldata, array('id' => $this->insert_company_id));

                    //===========================================================

                    $company_settings_array = array();
                    $company_settings_array = array('company_settings_id' => $this->insert_company_id);
                    $this->session->set_userdata('company', $company_settings_array);
                    
                    $gpass = $this->Common_model->generate_rand_password();
                    // $cpass=$this->Common_model->encrypt($gpass);
                    $cpass = md5($gpass);
                    
                    $udata = array('company_id' => $this->insert_company_id,
                        'name' => $this->input->post('company_full_name'),
                        'email' => $this->input->post('email'),
                        'password' => $cpass,
                        'parent_user' => $this->user_id,
                        'user_group' => 12,
                        'user_type' => '2',
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => '1',
                        'password_reset_hash' => $cpass
                    );

                    $ures = $this->Common_model->insert_data('main_users', $udata);
                    $this->insert_company_user_id = $this->db->insert_id();

                    $company_user_data = array('company_user_id' => $this->insert_company_user_id);
                    $uresd = $this->Common_model->update_data('main_company', $company_user_data, array('id' => $this->insert_company_id));

                    if ($this->input->post('email')!="") {
                        $this->Sendmail_model->company_creation_mail($this->input->post('company_full_name'),$this->input->post('email'), $gpass);
                    }

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $flag = 0;
                    } else {
                        $this->db->trans_commit();
                        $flag = 1;
                    }
            
                    if ($flag) {
                        echo $this->Common_model->show_massege(0, 1) . "_" . $this->insert_company_id . "_" . $this->insert_company_user_id;
                    } else {
                        echo $this->Common_model->show_massege(1, 2) . "_" . $this->insert_company_id . "_" . $this->insert_company_user_id;
                    }
                }

            } else {
                $this->db->trans_begin();
                
                $imgfilename="";
                if ($images) {
                    foreach ($images as $image) {
                        $fileExt = explode(".", $image['input']['name']);
                        $imgfilename = $this->input->post('company_ID') . "." . $fileExt[1];
                        @unlink($_FILES[$imgfilename]);
                        $file = Slim::saveFile($image['output']['data'], $imgfilename, 'uploads/companylogo', false);
                    }
                }

                //'user_id' => $this->user_id,
                $data = array('company_full_name' => $this->input->post('company_full_name'),
                    'company_short_name' => $this->input->post('company_short_name'),
                    'corporation_type' => $this->input->post('corporation_type'),
                    'show_in_header' => $this->input->post('show_in_header'),
                    'ein_number' => $this->input->post('ein_number'),
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'county_id' => $this->input->post('county_id'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'zip_code' => $this->input->post('zip_code'),
                    'phone_1' => $this->input->post('phone_1'),
                    'phone_2' => $this->input->post('phone_2'),
                    'fax_no' => $this->input->post('fax_no'),
                    'email' => $this->input->post('email'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    
                    //'billing_cycle' => $this->input->post('billing_cycle'),
                    'billing_type' => $this->input->post('billing_type'),
                    'rate' => $this->input->post('rate'),
                    'pricing_setup' => $this->input->post('pricing_setup'),
                    'payable_type' => $this->input->post('payable_type'),
                    'company_logo' => $imgfilename,
                    //'employee_type' => $this->input->post('employee_type'),
                    'leave_track_by' => $this->input->post('leave_track_by'),
                    'HR360_GUID' => $this->input->post('HR360_GUID'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    //'isactive' => $this->input->post('status'),
                     'isactive' => '1',
                );
                //print_r($data);exit();

                $res = $this->Common_model->update_data('main_company', $data, array('id' => $this->input->post('company_ID')));
                      /* User data update in main user table*/
                $udata = array( 'email' => $this->input->post('email'),
                     'modifiedby' => $this->user_id,
                     'modifieddate' => $this->date_time,
                    /*'name' => $this->input->post('company_full_name'),
                     'password' => $this->Common_model->encrypt('123456'),
                     'password' => md5('123456'),
                     'parent_user' => $this->user_id,
                     'user_group' => 12,
                     'user_type' => '2',
                     'isactive' => $this->input->post('status'),*/
                );

                $ures = $this->Common_model->update_data('main_users', $udata, array('id' => $this->input->post('company_user_id')));
                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $flag = 0;
                } else {
                    $this->db->trans_commit();
                    $flag = 1;
                }

                if ($flag) {
                    echo $this->Common_model->show_massege(2, 1) . "_" . $this->input->post('company_ID') . "_" . $this->input->post('company_user_id');
                } else {
                    echo $this->Common_model->show_massege(3, 2);
                }
            }
        }

    }

    //==========================================================================
    //============================location======================================

    public function save_location() {

        $this->form_validation->set_rules('location_name', 'Location Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_person', 'Contact Person', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('address_1', 'Address 1', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('location_name', $this->input->post('location_name'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_location');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Location Name already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'location_name' => $this->input->post('location_name'),
                //'location_code' => $this->input->post('location_code'),
                'contact_person' => $this->input->post('contact_person'),
                'contact_number' => $this->input->post('contact_number'),
                'email' => $this->input->post('email'),
                'started_on' => $this->Common_model->convert_to_mysql_date($this->input->post('started_on')),
                'time_zone' => $this->input->post('location_time_zone'),
                'county_id' => $this->input->post('location_county_id'),
                'state_id' => $this->input->post('location_state_id'),
                'city' => $this->input->post('location_city'),
                'zipcode' => $this->input->post('location_zipcode'),
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->insert_data('main_location', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_location() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_location', $id);
        echo json_encode($data);
    }

    public function edit_location() {

        $this->form_validation->set_rules('location_name', 'Location Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_person', 'Contact Person', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('address_1', 'Address 1', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('location_id'));
            $this->db->where('location_name', $this->input->post('location_name'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_location');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Location Name already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'location_name' => $this->input->post('location_name'),
                //'location_code' => $this->input->post('location_code'),
                'contact_person' => $this->input->post('contact_person'),
                'contact_number' => $this->input->post('contact_number'),
                'email' => $this->input->post('email'),
                'started_on' => $this->Common_model->convert_to_mysql_date($this->input->post('started_on')),
                'time_zone' => $this->input->post('location_time_zone'),
                'county_id' => $this->input->post('location_county_id'),
                'state_id' => $this->input->post('location_state_id'),
                'city' => $this->input->post('location_city'),
                'zipcode' => $this->input->post('location_zipcode'),
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_location', $data, array('id' => $this->input->post('location_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_location() {
        $id = $this->uri->segment(3);
        
        $this->db->where('location', $id);
        $this->db->where('company_id', $this->company_settings_id);
        $query = $this->db->get('main_emp_workrelated');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This location is already in use. If you want to delete, you have to free the location first.', 2);
            exit();
        }
            
        $res = $this->Common_model->delete_by_id("main_location", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }
    
     public function delete_multiple_location() {
        
        //$lCheck = $this->input->post("lCheck");
        $locationCheck = '';
        if($this->input->post("lCheck"))
        {
            /* foreach ($this->input->post("employee_id") as $emp) {
                if ($employees == '') {
                    $employees = $emp;
                } else {
                    $employees = $employees . "," . $emp;
                }
            } */
            $locationCheck = $this->input->post("lCheck");
        }
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where_in('location', $locationCheck);
        $query = $this->db->get('main_emp_workrelated');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This location is already in use. If you want to delete, you have to free the location first.', 2);
            exit();
        }
            
        if(!empty($locationCheck))
        {
            $checked_location = (explode(",",$locationCheck));
            foreach ($checked_location as $checked) {
            //for ($i = 0; $i < count($locationCheck); $i++) {

                $data[] = array('id' => $checked,
                    'isactive' => '0',
                );                
            } 
           // print_r($data); exit;
            $res = $this->db->update_batch('main_location', $data, 'id');
            if ($res) {
                echo $this->Common_model->show_massege(4, 1);
            } else {
                echo $this->Common_model->show_massege(5, 2);
            }
            
        }else {
            
            echo $this->Common_model->show_validation_massege('Select at least one checkbox.', 2);
        }
       
        
    }

    //==========================================================================
    //=========================department=======================================

    public function save_department() {

        $this->form_validation->set_rules('department_name', 'Department Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('department_name', $this->input->post('department_name'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_department');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Department Name already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'department_name' => $this->input->post('department_name'),
                //'department_code' => $this->input->post('department_code'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );


            $res = $this->Common_model->insert_data('main_department', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_department() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_department', $id);
        echo json_encode($data);
    }

    public function edit_department() {

        $this->form_validation->set_rules('department_name', 'Department Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('department_id'));
            $this->db->where('department_name', $this->input->post('department_name'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_department');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Department Name already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'department_name' => $this->input->post('department_name'),
                //'department_code' => $this->input->post('department_code'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_department', $data, array('id' => $this->input->post('department_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_department() {
        $id = $this->uri->segment(3);
        
        $this->db->where('department', $id);
        $this->db->where('company_id', $this->company_settings_id);
        $query = $this->db->get('main_emp_workrelated');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This department is already in use. If you want to delete, you have to free the department first.', 2);
            exit();
        }

        $res = $this->Common_model->delete_by_id("main_department", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //=========================== business_type ================================

    public function business_type_categories($id) {

        $id = str_replace('%20', ' ', $id);
        $this->db->like('main_type', $id);
        $query = $this->db->get_where('main_business_type', array());

        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->sub_type . "</option>";
            }
        } else {
            echo"<option> No business type Added </option>";
        }
    }

    public function save_businesstype() {

        $this->form_validation->set_rules('business_type', 'Business Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('sub_categories', 'Sub Categories', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('business_type', $this->input->post('business_type'));
            $this->db->where('sub_categories', $this->input->post('sub_categories'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_com_business_type');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Business Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'business_type' => $this->input->post('business_type'),
                'sub_categories' => $this->input->post('sub_categories'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            //print_r($data);exit();
            
            $res = $this->Common_model->insert_data('main_com_business_type', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_businesstype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_com_business_type', $id);
        echo json_encode($data);
    }

    public function edit_businesstype() {

        $this->form_validation->set_rules('business_type', 'Business Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('sub_categories', 'Sub Categories', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('businesstype_id'));
            $this->db->where('business_type', $this->input->post('business_type'));
            $this->db->where('sub_categories', $this->input->post('sub_categories'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_com_business_type');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Business Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'business_type' => $this->input->post('business_type'),
                'sub_categories' => $this->input->post('sub_categories'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_com_business_type', $data, array('id' => $this->input->post('businesstype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function save_new_business_type() {

        if ($this->input->post('exist_business_type') == 1) {
            $this->form_validation->set_rules('new_business_type_select', 'Business Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        } else {
            $this->form_validation->set_rules('new_business_type', 'Business Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        }

        //$this->form_validation->set_rules('new_job_family', 'Job Family', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('new_sub_categories[]', 'Sub Categories', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $sub_categories = $this->input->post('new_sub_categories');
            $count = count($sub_categories);

            for ($i = 0; $i < $count; $i++) {

                if ($this->input->post('exist_business_type') == 1) {
                    $this->db->where('main_type', $this->input->post('new_business_type_select'));
                } else {
                    $this->db->where('main_type', $this->input->post('new_business_type'));
                }
                $this->db->where('company_id', $this->company_settings_id);
                $this->db->where('sub_type', $sub_categories[$i]);
                $query = $this->db->get('main_business_type');
                if ($query->num_rows() > 0) {
                    echo $this->Common_model->show_validation_massege('This Business Type ( "' . $sub_categories[$i] . '" ) already exist.', 2);
                    exit();
                }

                $data[$i] = array('company_id' => $this->company_settings_id,
                    'sub_type' => $sub_categories[$i],
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                );

                if ($this->input->post('exist_business_type') == 1) {
                    $data[$i]['main_type'] = $this->input->post('new_business_type_select');
                } else {
                    $data[$i]['main_type'] = $this->input->post('new_business_type');
                }
            }

            $res = $this->db->insert_batch('main_business_type', $data);
//            $res = $this->Common_model->insert_data('main_business_type', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function delete_businesstype() {
        $id = $this->uri->segment(3);
       
        $res = $this->Common_model->delete_by_id("main_com_business_type", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }
    
    //==========================================================================
    //========================payfrequency======================================

    public function save_payfrequency() {

        $this->form_validation->set_rules('pay_frequency', 'Pay Period', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('freqtype', $this->input->post('pay_frequency'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_payfrequency');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Pay Period already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'freqtype' => $this->input->post('pay_frequency'),
                //'freqcode' => $this->input->post('short_code'),
                'freqdescription' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_payfrequency', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_payfrequency() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_payfrequency', $id);
        echo json_encode($data);
    }

    public function edit_payfrequency() {

        $this->form_validation->set_rules('pay_frequency', 'Pay Period', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('payfrequency_id'));
            $this->db->where('freqtype', $this->input->post('pay_frequency'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_payfrequency');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Pay Period already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'freqtype' => $this->input->post('pay_frequency'),
                //'freqcode' => $this->input->post('short_code'),
                'freqdescription' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_payfrequency', $data, array('id' => $this->input->post('payfrequency_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_payfrequency() {
        $id = $this->uri->segment(3);
        
        $freqtype=$this->Common_model->get_name($this,$id,'main_payfrequency','freqtype');
        
        $this->db->where('wages', $freqtype);
        $this->db->where('company_id', $this->company_settings_id);
        $query = $this->db->get('main_emp_workrelated');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This Pay Frequency is already in use. If you want to delete, you have to free the Pay Frequency first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_payfrequency", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function save_new_payfrequency() {

        $this->form_validation->set_rules('freqcode', 'Pay Frequency', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('wage_houre', 'Wage Houre', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('freqcode', $this->input->post('freqcode'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_payfrequency_type');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Pay Frequency already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'freqcode' => $this->input->post('freqcode'),
                'wage_houre' => $this->input->post('wage_houre'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            //pr($data);
            $res = $this->Common_model->insert_data('main_payfrequency_type', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    //==========================================================================
    //=========================jobtitle=========================================

    public function save_jobtitle() {

        $this->form_validation->set_rules('jobtitlename', 'Job Title', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('jobtitlecode', 'Job Title Code', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'jobtitlename' => $this->input->post('jobtitlename'),
                'jobtitlecode' => $this->input->post('jobtitlecode'),
                'minexperiencerequired' => $this->input->post('minexperiencerequired'),
                'jobpaygradecode' => $this->input->post('jobpaygradecode'),
                'jobpayfrequency' => $this->input->post('jobpayfrequency'),
                'jobdescription' => $this->input->post('jobdescription'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_jobtitles', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_jobtitle() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_jobtitles', $id);
        echo json_encode($data);
    }

    public function edit_jobtitle() {

        $this->form_validation->set_rules('jobtitlename', 'Job Title', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('jobtitlecode', 'Job Title Code', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_settings_id,
                'jobtitlename' => $this->input->post('jobtitlename'),
                'jobtitlecode' => $this->input->post('jobtitlecode'),
                'minexperiencerequired' => $this->input->post('minexperiencerequired'),
                'jobpaygradecode' => $this->input->post('jobpaygradecode'),
                'jobpayfrequency' => $this->input->post('jobpayfrequency'),
                'jobdescription' => $this->input->post('jobdescription'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_jobtitles', $data, array('id' => $this->input->post('jobtitle_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_jobtitle() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_jobtitles", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //==========================position========================================

    public function load_positionname($job_family) {
        //$job_family = $this->input->post('job_family');

        $job_family = str_replace('%20', ' ', $job_family);
        $this->db->like('job_family', $job_family);
        $query = $this->db->get('main_jobtitles');

        //$output = '';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                //$output .= "<option value=" . $row->id . ">" . $row->job_title . "</option>";
                print"<option value=" . $row->id . ">" . $row->job_title . "</option>";
            }
        } else {
            //$output .= "<option> No business type Added </option>";
            echo"<option> No Position Added </option>";
        }

        //echo json_encode(array('response' => $output));
    }

    public function save_position() {

        $this->form_validation->set_rules('job_family', 'Job Family', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('positionname', 'Position', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('job_family', $this->input->post('job_family'));
            $this->db->where('positionname', $this->input->post('positionname'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_positions');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Position already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'job_family' => $this->input->post('job_family'),
                'positionname' => $this->input->post('positionname'),
                'gl_code' => $this->input->post('gl_code'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_positions', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_position() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_positions', $id);
        echo json_encode($data);
    }

    public function edit_position() {

        $this->form_validation->set_rules('positionname', 'Position', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('position_id'));
            $this->db->where('job_family', $this->input->post('job_family'));
            $this->db->where('positionname', $this->input->post('positionname'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_positions');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Position already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'job_family' => $this->input->post('job_family'),
                'positionname' => $this->input->post('positionname'),
                'gl_code' => $this->input->post('gl_code'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_positions', $data, array('id' => $this->input->post('position_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_position() {
        $id = $this->uri->segment(3);
        
        $positionname=$this->Common_model->get_name($this,$id,'main_positions','positionname');
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('position', $positionname);
        //$this->db->where('isactive', 1);
        $query = $this->db->get('main_employees');
        //echo $this->db->last_query();exit();
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This position is already in use. If you want to delete, you have to free the position first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_positions", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function save_new_position() {

        if ($this->input->post('exist_job_family') == 1) {
            $this->form_validation->set_rules('new_job_family_select', 'Job Family', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        } else {
            $this->form_validation->set_rules('new_job_family', 'Job Family', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        }

        //$this->form_validation->set_rules('new_job_family', 'Job Family', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('position_name[]', 'Position', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            //$company_data = $this->session->userdata('company');
            //$this->company_settings_id = $company_data['company_settings_id'];


            $position_name = $this->input->post('position_name');
            $count = count($position_name);

            for ($i = 0; $i < $count; $i++) {

                if ($this->input->post('exist_job_family') == 1) {
                    $this->db->where('job_family', $this->input->post('new_job_family_select'));
                } else {
                    $this->db->where('job_family', $this->input->post('new_job_family'));
                }

                $this->db->where('job_title', $position_name[$i]);
                $query = $this->db->get('main_jobtitles');
                if ($query->num_rows() > 0) {
                    echo $this->Common_model->show_validation_massege('This Position ( "' . $position_name[$i] . '" )  already exist.', 2);
                    exit();
                }

                $data[$i] = array('job_title' => $position_name[$i],
                    'isactive' => '1',
                );

                if ($this->input->post('exist_job_family') == 1) {
                    $data[$i]['job_family'] = $this->input->post('new_job_family_select');
                } else {
                    $data[$i]['job_family'] = $this->input->post('new_job_family');
                }
            }

//            $data = array(//'job_family' => $this->input->post('new_job_family'),
//                'job_title' => $this->input->post('position_name'),
//                'isactive' => '1',
//            );
            //pr($data,1);
            $res = $this->db->insert_batch('main_jobtitles', $data);
            //$res = $this->Common_model->insert_data('main_jobtitles', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    //==========================================================================
    //========================= employee status ================================

    public function save_employeestatus() {

        $this->form_validation->set_rules('workcodename', 'Work Code', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('workcodename', $this->input->post('workcodename'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $uquery = $this->db->get('main_employmentstatus');

            if ($uquery->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Work Code already exists.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'workcodename' => $this->input->post('workcodename'),
                //'workcode' => $this->input->post('workcode'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_employmentstatus', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_employeestatus() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_employmentstatus', $id);
        echo json_encode($data);
    }

    public function edit_employeestatus() {

        $this->form_validation->set_rules('workcodename', 'Work Code', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('employeestatus_id'));
            $this->db->where('workcodename', $this->input->post('workcodename'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_employmentstatus');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Work Code already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'workcodename' => $this->input->post('workcodename'),
                //'workcode' => $this->input->post('workcode'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_employmentstatus', $data, array('id' => $this->input->post('employeestatus_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_employeestatus() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_employmentstatus", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //=========================== language =====================================

    public function save_language() {

        $this->form_validation->set_rules('languagename', 'Language', 'required', array('required' => "Please enter the required field, for more Info : %s."));
       
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('languagename', $this->input->post('languagename'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_com_language');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Language already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'languagename' => $this->input->post('languagename'),
//                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_com_language', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_language() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_com_language', $id);
        echo json_encode($data);
    }

    public function edit_language() {

        $this->form_validation->set_rules('languagename', 'Language', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('language_id'));
            $this->db->where('languagename', $this->input->post('languagename'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_com_language');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Language already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'languagename' => $this->input->post('languagename'),
//                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_com_language', $data, array('id' => $this->input->post('language_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_language() {
        $id = $this->uri->segment(3);
        
        $languagesid=$this->Common_model->get_name($this,$id,'main_com_language','languagename');
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('languagesid', $languagesid);
        $this->db->where('isactive', 1);
        $query = $this->db->get('main_emp_languages');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This languages is already in use. If you want to delete, you have to free the languages first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_com_language", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //============================ leave type ==================================

    public function save_leavetype() {

        $this->form_validation->set_rules('leavetypeid', 'Leave Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_code', 'Leave Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('leavetype', $this->input->post('leavetypeid'));
            $this->db->where('leave_code', $this->input->post('leave_code'));
            $this->db->where('state', $this->input->post('state_id'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_employeeleavetypes');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave Key already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'leavetype' => $this->input->post('leavetypeid'),
                'state' => $this->input->post('state_id'),
                'leave_code' => $this->input->post('leave_code'),
                'leave_short_code' => $this->input->post('leave_short_code'),
                //'leave_code' => $this->Common_model->get_name($this, $this->input->post('leave_code'), 'main_leave_types', 'leave_code'),
                //'leave_short_code' => $this->input->post('leave_short_code'),
                'is_paid' => $this->input->post('is_paid'),
                'status' => $this->input->post('emp_status'),
                'description' => $this->input->post('description'),
                //'track_by' => $this->input->post('track_by'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_employeeleavetypes', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_leavetype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_employeeleavetypes', $id);
        echo json_encode($data);
    }

    public function edit_leavetype() {

        $this->form_validation->set_rules('leavetypeid', 'Leave Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_code', 'Leave Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('leavetype_id'));
            $this->db->where('leavetype', $this->input->post('leavetypeid'));
            $this->db->where('leave_code', $this->input->post('leave_code'));
            $this->db->where('state', $this->input->post('state_id'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_employeeleavetypes');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave Key already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'leavetype' => $this->input->post('leavetypeid'),
                'state' => $this->input->post('state_id'),
                'leave_code' => $this->input->post('leave_code'),
                'leave_short_code' => $this->input->post('leave_short_code'),
                //'leave_code' => $this->Common_model->get_name($this, $this->input->post('leave_code'), 'main_leave_types', 'leave_code'),
                //'leave_short_code' => $this->input->post('leave_short_code'),
                'is_paid' => $this->input->post('is_paid'),
                'status' => $this->input->post('emp_status'),
                'description' => $this->input->post('description'),
                //'track_by' => $this->input->post('track_by'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_employeeleavetypes', $data, array('id' => $this->input->post('leavetype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_leavetype() {
        $id = $this->uri->segment(3);
        
        $leave_code=$this->Common_model->get_name($this,$id,'main_employeeleavetypes','leave_code');
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('leave_type', $leave_code);
        $this->db->where('isactive', 1);
        $query = $this->db->get('main_leave_request');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This leave type is already in use. If you want to delete, you have to free the leave type first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_employeeleavetypes", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function search_leave_short_code($id) {
        $leave_short_code = $this->Common_model->get_name($this, $id, 'main_leave_types', 'leave_short_code');
        if ($leave_short_code) {
            echo $leave_short_code;
        } else {
            echo "";
        }
    }

    //==========================================================================
    //=========================== education ====================================

    public function save_education() {

        $this->form_validation->set_rules('educationlevelcode', 'Education Level', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('educationlevelcode', $this->input->post('educationlevelcode'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_educationlevelcode');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Education Level already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'educationlevelcode' => $this->input->post('educationlevelcode'),
                'degree' => $this->input->post('degree'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_educationlevelcode', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_education() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_educationlevelcode', $id);
        echo json_encode($data);
    }

    public function edit_education() {

        $this->form_validation->set_rules('educationlevelcode', 'Education Level', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('education_id'));
            $this->db->where('educationlevelcode', $this->input->post('educationlevelcode'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_educationlevelcode');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Education Level already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'educationlevelcode' => $this->input->post('educationlevelcode'),
                'degree' => $this->input->post('degree'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_educationlevelcode', $data, array('id' => $this->input->post('education_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_education() {
        $id = $this->uri->segment(3);
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('educationlevel', $id);
        $this->db->where('isactive', 1);
        $query = $this->db->get('main_emp_education');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This Education Level is already in use. If you want to delete, you have to free the Education Level first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_educationlevelcode", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //============================= bank account type ==========================

    public function save_bankaccounttype() {

        $this->form_validation->set_rules('bank_account_type', 'Bank Account Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('bank_account_type', $this->input->post('bank_account_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_bank_account_types');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Account Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'bank_account_type' => $this->input->post('bank_account_type'),
//                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_bank_account_types', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_bankaccounttype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_bank_account_types', $id);
        echo json_encode($data);
    }

    public function edit_bankaccounttype() {

        $this->form_validation->set_rules('bank_account_type', 'Bank Account Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('bankaccounttype_id'));
            $this->db->where('bank_account_type', $this->input->post('bank_account_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_bank_account_types');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Account Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'bank_account_type' => $this->input->post('bank_account_type'),
//                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_bank_account_types', $data, array('id' => $this->input->post('bankaccounttype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_bankaccounttype() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_bank_account_types", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //=========================== competency levels ============================

    public function save_competencylevels() {

        $this->form_validation->set_rules('competencylevels', 'Competency Levels', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('competencylevels', $this->input->post('competencylevels'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_competencylevels');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Competency Levels already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'competencylevels' => $this->input->post('competencylevels'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_competencylevels', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_competencylevels() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_competencylevels', $id);
        echo json_encode($data);
    }

    public function edit_competencylevels() {

        $this->form_validation->set_rules('competencylevels', 'Competency Levels', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('competencylevels_id'));
            $this->db->where('competencylevels', $this->input->post('competencylevels'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_competencylevels');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Competency Levels already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'competencylevels' => $this->input->post('competencylevels'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_competencylevels', $data, array('id' => $this->input->post('competencylevels_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_competencylevels() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_competencylevels", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //========================== discipline type ===============================

    public function save_disciplinetype() {

        $this->form_validation->set_rules('discipline_type', 'Discipline Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('discipline_type', $this->input->post('discipline_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_disciplinetype');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Discipline Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'discipline_type' => $this->input->post('discipline_type'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_disciplinetype', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_disciplinetype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_disciplinetype', $id);
        echo json_encode($data);
    }

    public function edit_disciplinetype() {

        $this->form_validation->set_rules('discipline_type', 'Discipline Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('disciplinetype_id'));
            $this->db->where('discipline_type', $this->input->post('discipline_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_disciplinetype');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Discipline Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'discipline_type' => $this->input->post('discipline_type'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_disciplinetype', $data, array('id' => $this->input->post('disciplinetype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_disciplinetype() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_disciplinetype", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //=========================== incidenttype =================================

    public function save_incidenttype() {

        $this->form_validation->set_rules('incident_type', 'Incident Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('incident_type', $this->input->post('incident_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_incidenttype');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Incident Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'incident_type' => $this->input->post('incident_type'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_incidenttype', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_incidenttype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_incidenttype', $id);
        echo json_encode($data);
    }

    public function edit_incidenttype() {

        $this->form_validation->set_rules('incident_type', 'Incident Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('incidenttype_id'));
            $this->db->where('incident_type', $this->input->post('incident_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_incidenttype');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Incident Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'incident_type' => $this->input->post('incident_type'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_incidenttype', $data, array('id' => $this->input->post('incidenttype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_incidenttype() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_incidenttype", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //============================ benefits type ===============================

    public function save_benefitstype() {

        $this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('benefit_type', $this->input->post('benefit_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_benefit_type');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Benefit Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'benefit_type' => $this->input->post('benefit_type'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_benefit_type', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_benefitstype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_benefit_type', $id);
        echo json_encode($data);
    }

    public function edit_benefitstype() {

        $this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('benefitstype_id'));
            $this->db->where('benefit_type', $this->input->post('benefit_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_benefit_type');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Benefit Type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'benefit_type' => $this->input->post('benefit_type'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_benefit_type', $data, array('id' => $this->input->post('benefitstype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_benefitstype() {
        $id = $this->uri->segment(3);
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('benefit_type', $id);
        $this->db->where('isactive', 1);
        $query = $this->db->get('main_emp_benefit');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This Benefits Type is already in use. If you want to delete, you have to free the Benefits Type first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_benefit_type", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_benefitsprovider() {

        $this->form_validation->set_rules('service_provider_name', 'Service Provider Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('states', 'States', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_name', 'Contact Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('address1', 'Address 1', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('service_provider_name', $this->input->post('service_provider_name'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_benefits_provider');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Service Provider Name already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'service_provider_name' => $this->input->post('service_provider_name'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'states' => $this->input->post('states'),
                'zipcode' => $this->input->post('zipcode'),
                'contact_name' => $this->input->post('contact_name'),
                'phone_no' => $this->input->post('phone_no'),
                'ext' => $this->input->post('ext'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'acc_number' => $this->input->post('acc_number'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_benefits_provider', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_benefitsprovider() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_benefits_provider', $id);
        echo json_encode($data);
    }

    public function edit_benefitsprovider() {

        $this->form_validation->set_rules('service_provider_name', 'Service Provider Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('states', 'States', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_name', 'Contact Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('address1', 'Address 1', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('benefitsprovider_id'));
            $this->db->where('service_provider_name', $this->input->post('service_provider_name'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_benefits_provider');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Service Provider Name already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'service_provider_name' => $this->input->post('service_provider_name'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'states' => $this->input->post('states'),
                'zipcode' => $this->input->post('zipcode'),
                'contact_name' => $this->input->post('contact_name'),
                'phone_no' => $this->input->post('phone_no'),
                'ext' => $this->input->post('ext'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'acc_number' => $this->input->post('acc_number'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_benefits_provider', $data, array('id' => $this->input->post('benefitsprovider_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_benefitsprovider() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_benefits_provider", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_dependent_information() {

        $this->form_validation->set_rules('fast_name', 'Fast Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('relationship', 'Relationship', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'fast_name' => $this->input->post('fast_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'suffix' => $this->input->post('suffix'),
                'relationship' => $this->input->post('relationship'),
                'date_of_birth' => $this->Common_model->convert_to_mysql_date($this->input->post('dependent_birthdate')),
                'gender' => $this->input->post('gender'),
                'age' => $this->input->post('dependent_age'),
                'ssn' => $this->input->post('ssn'),
                'is_collage_student' => $this->input->post('is_collage_student'),
                'is_tobacco_user' => $this->input->post('is_tobacco_user'),
                'employee_address' => $this->input->post('employee_address'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_depandent_information', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_dependent() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_depandent_information', $id);
        echo json_encode($data);
    }

    public function update_dependent_information() {
        $this->form_validation->set_rules('fast_name', 'Fast Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('last_name', 'Last Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('relationship', 'Relationship', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_settings_id,
                'fast_name' => $this->input->post('fast_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'suffix' => $this->input->post('suffix'),
                'relationship' => $this->input->post('relationship'),
                'date_of_birth' => $this->Common_model->convert_to_mysql_date($this->input->post('dependent_birthdate')),
                'gender' => $this->input->post('gender'),
                'age' => $this->input->post('dependent_age'),
                'ssn' => $this->input->post('ssn'),
                'is_collage_student' => $this->input->post('is_collage_student'),
                'is_tobacco_user' => $this->input->post('is_tobacco_user'),
                'employee_address' => $this->input->post('employee_address'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_depandent_information', $data, array('id' => $this->input->post('id_dependent')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_dependent_information() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_depandent_information", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_relationshipstatus() {

        $this->form_validation->set_rules('relationship_status', 'Relationship Status', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('relationship_status', $this->input->post('relationship_status'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_relationship_status');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This relationship status already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'relationship_status' => $this->input->post('relationship_status'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_relationship_status', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_relationshipstatus() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_relationship_status', $id);
        echo json_encode($data);
    }

    public function edit_relationshipstatus() {

        $this->form_validation->set_rules('relationship_status', 'Relationship Status', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('relationshipstatus_id'));
            $this->db->where('relationship_status', $this->input->post('relationship_status'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_relationship_status');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This relationship status already exist.', 2);
                exit();
            }
            
            $data = array('company_id' => $this->company_settings_id,
                'relationship_status' => $this->input->post('relationship_status'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_relationship_status', $data, array('id' => $this->input->post('relationshipstatus_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_relationshipstatus() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_relationship_status", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //==========================================================================

    public function view_company_policies() {
        if (!$this->user_id) {
            redirect('chome/logout', 'refresh');
        }

        $param['module_id'] = 0;
        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Company Solicies";

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'sadmin/view_company_policies.php';
        $this->load->view('admin/home', $param);
    }

    public function upload_policy_file() {
        
        $status = "";
        $msg = "";
        $file_element_name = 'policy_file';

        if ($status != "error") {
            $config['upload_path'] = './uploads/com_policy/';
            $config['allowed_types'] = 'gif|jpg|png|doc|docx|txt|pdf';
            $config['max_size'] = 1024 * 12;
            $config['encrypt_name'] = FALSE;

            // $newFileName = $_FILES[$file_element_name]['name'];
            $uploadedFileName = @pathinfo($_FILES[$file_element_name]['name'])["filename"];
            $uploadedFileNameOrg = $uploadedFileName;
            $uploadedFileExtension = @pathinfo($_FILES[$file_element_name]['name'])["extension"];
            $newFileName = str_replace(" ", "_", $uploadedFileName);
            $newFileName = str_replace(".", "_", $newFileName) . "." . $uploadedFileExtension;
            // $fileExt = explode(".", $newFileName);
            $filename = time() . "." . $uploadedFileExtension;
            $config['file_name'] = $filename;

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
                    $msg = "File successfully uploaded";
                    //echo $this->Common_model->show_massege($_POST['employee_id'],2);
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }

        if ($status == "success") {
            echo $this->Common_model->show_validation_massege($msg, 1) . "__" . $file_name . "__" . ($uploadedFileNameOrg . "." . $uploadedFileExtension);
        } else {
            echo $this->Common_model->show_validation_massege($msg, 2);
        }
        //echo json_encode(array('status' => $status, 'msg' => $msg));
        //echo $this->Common_model->show_massege($msg,2);
    }

    public function save_companypolicies() {

        $this->form_validation->set_rules('policy_name', 'Policy Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'policy_name' => $this->input->post('policy_name'),
                'description' => $this->input->post('description'),
                'custom_text' => $this->input->post('hidden_custom_text'),
                'file_name' => $this->input->post('actual_policy_filename'),
                'policy_file_path' => $this->input->post('policy_file_path'),
                'is_singture' => $this->input->post('is_singture'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            //print_r($data);
            $res = $this->Common_model->insert_data('main_company_policies', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_companypolicies() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_company_policies', $id);
        echo json_encode($data);
    }

    public function edit_companypolicies() {
        $this->form_validation->set_rules('policy_name', 'Policy Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_settings_id,
                'policy_name' => $this->input->post('policy_name'),
                'description' => $this->input->post('description'),
                'custom_text' => $this->input->post('hidden_custom_text'),
                'file_name' => $this->input->post('actual_policy_filename'),
                'policy_file_path' => $this->input->post('policy_file_path'),
                'is_singture' => $this->input->post('is_singture'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
            );

            $res = $this->Common_model->update_data('main_company_policies', $data, array('id' => $this->input->post('companypolicies_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_companypolicies() {
        $id = $this->uri->segment(3);
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('policy_id', $id);
        $this->db->where('isactive', 1);
        $query = $this->db->get('main_ob_company_policies');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This Company Policies is already in use. If you want to delete, you have to free the Company Policies first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_company_policies", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function download_policy_file_com($id)
    {
        $downloadFileName = "test_company_policy.pdf";
        $query = $this->db->get_where('main_company_policies', array('id' => $id));
        if ($query) {
            foreach ($query->result() as $row) {
                $filename = $row->policy_file_path;
                $downloadFileName = $row->file_name ? : $filename;
            }
        }

        if ($filename != "") {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/com_policy/' . $filename));
            $url = Get_File_Directory('/uploads/com_policy/' . $filename);
            $data = file_get_contents($url);
            force_download($downloadFileName, $data);
        }
    }

    //==========================================================================
    //==========================================================================

    public function save_eeoc() {

        $this->form_validation->set_rules('eeoc_categories', 'EEOC Categories', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('eeoc_categories', $this->input->post('eeoc_categories'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_eeoc_categories');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This EEOC already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'eeoc_categories' => $this->input->post('eeoc_categories'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_eeoc_categories', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_eeoc() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_eeoc_categories', $id);
        echo json_encode($data);
    }

    public function update_eeoc() {

        $this->form_validation->set_rules('eeoc_categories', 'EEOC Categories', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('id_eeoc'));
            $this->db->where('eeoc_categories', $this->input->post('eeoc_categories'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_eeoc_categories');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This EEOC already exist.', 2);
                exit();
            }
            
            $data = array('company_id' => $this->company_settings_id,
                'eeoc_categories' => $this->input->post('eeoc_categories'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_eeoc_categories', $data, array('id' => $this->input->post('id_eeoc')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_eeoc() {
        $id = $this->uri->segment(3);
        
        $this->db->where('company_id', $this->company_settings_id);
        $this->db->where('policy_id', $id);
        $this->db->where('isactive', 1);
        $query = $this->db->get('main_ob_eeo_policies');
        if ($query->num_rows() > 0) {
            echo $this->Common_model->show_validation_massege('This EEOC Categories is already in use. If you want to delete, you have to free the EEOC Categories first.', 2);
            exit();
        }
        
        $res = $this->Common_model->delete_by_id("main_eeoc_categories", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_assetstype() {

        $this->form_validation->set_rules('asset_type', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('asset_type', $this->input->post('asset_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_assets_type');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This asset type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'asset_type' => $this->input->post('asset_type'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_assets_type', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_assetstype() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_assets_type', $id);
        echo json_encode($data);
    }

    public function update_assetstype() {

        $this->form_validation->set_rules('asset_type', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('assetstype_id'));
            $this->db->where('asset_type', $this->input->post('asset_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_assets_type');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This assets type already exist.', 2);
                exit();
            }
            
            $data = array('company_id' => $this->company_settings_id,
                'asset_type' => $this->input->post('asset_type'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_assets_type', $data, array('id' => $this->input->post('assetstype_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_assetstype() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_assets_type", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function save_assetscategory() {

        $this->form_validation->set_rules('asset_type_iddd', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category', 'Asset Category', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('asset_type_id', $this->input->post('asset_type_iddd'));
            $this->db->where('asset_category', $this->input->post('asset_category'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_assets_category');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This assets category already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('asset_type_iddd'),
                'asset_category' => $this->input->post('asset_category'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_assets_category', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_assetscategory() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_assets_category', $id);
        echo json_encode($data);
    }

    public function update_assetscategory() {

        $this->form_validation->set_rules('asset_type_iddd', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category', 'Asset Category', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('assetscategory_id'));
            $this->db->where('asset_type_id', $this->input->post('asset_type_iddd'));
            $this->db->where('asset_category', $this->input->post('asset_category'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_assets_category');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This assets category already exist.', 2);
                exit();
            }
            
            $data = array('company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('asset_type_iddd'),
                'asset_category' => $this->input->post('asset_category'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_assets_category', $data, array('id' => $this->input->post('assetscategory_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_assetscategory() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_assets_category", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

    public function asset_category_filter($id) {
        $query = $this->db->get_where('main_assets_category', array('asset_type_id' => $id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_category . "</option>";
            }
        } else {
            echo"<option> No Plan Added </option>";
        }
    }

    public function save_assetsname() {
        $this->form_validation->set_rules('asset_type_idd', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category_idd', 'Asset Category', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_name', 'Asset Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('asset_type_idd'),
                'asset_category_id' => $this->input->post('asset_category_idd'),
                'asset_name' => $this->input->post('asset_name'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_assets_name', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_assetsname() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_assets_name', $id);
        echo json_encode($data);
    }

    public function update_assetsname() {

        $this->form_validation->set_rules('asset_type_idd', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category_idd', 'Asset Category', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_name', 'Asset Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('asset_type_idd'),
                'asset_category_id' => $this->input->post('asset_category_idd'),
                'asset_name' => $this->input->post('asset_name'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_assets_name', $data, array('id' => $this->input->post('assetsname_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_assetsname() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_assets_name", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //============================Asset Register==============================================

    public function load_asset_category() {

        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_category', array('asset_type_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_category . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function load_asset_name() {

        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_name', array('asset_category_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function asset_name_find($id) {
        $asset_name = $this->Common_model->get_name($this, $id, ' main_assets_name', 'asset_name');
        if ($asset_name) {
            echo $asset_name;
        } else {
            echo'No Name Found';
        }
    }

    public function save_AssetsInformation() {

        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category_id', 'asset category id', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_name_id', 'Asset Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('quantity', 'Quantity', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $date = date("Y-m");
            $asset_name_id = $date . '-' . $this->input->post('asset_type_id') . '-' . $this->input->post('asset_category_id') . '-' . $this->input->post('asset_name_id');

            $model_name = $this->input->post('model_name');
            $serial_no = $this->input->post('serial_no');
            $value = $this->input->post('value');
            $description = $this->input->post('description');

            $query = $this->db->get_where('main_asset_master', array('asset_name_id' => $this->input->post('asset_name_id')))->row();

            if ($query) {
                $quantity = $query->quantity;
                $id = $query->id;
                $mdata = array(
                    'company_id' => $this->company_settings_id,
                    'asset_type_id' => $this->input->post('asset_type_id'),
                    'asset_category_id' => $this->input->post('asset_category_id'),
                    'asset_name_id' => $this->input->post('asset_name_id'),
                    'quantity' => $quantity + $this->input->post('quantity'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $this->Common_model->update_data('main_asset_master', $mdata, array('id' => $id));
                $mid = $id;
            } else {
                $pdata = array(
                    'company_id' => $this->company_settings_id,
                    'asset_type_id' => $this->input->post('asset_type_id'),
                    'asset_category_id' => $this->input->post('asset_category_id'),
                    'asset_name_id' => $this->input->post('asset_name_id'),
                    'quantity' => $this->input->post('quantity'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $this->Common_model->insert_data('main_asset_master', $pdata);
                $mid = $this->db->insert_id();
            }
            $data = array();
            for ($i = 0; $i < count($model_name); $i++) {
                $data[$i] = array(
                    'mid' => $mid,
                    'asset_id' => $asset_name_id . '-' . $serial_no[$i],
                    'model_name' => $model_name[$i],
                    'serial_no' => $serial_no[$i],
                    'value' => $value[$i],
                    'description' => $description[$i],
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
            }
            $res = $this->db->insert_batch('main_assets_detail', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_AssetsInformation() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_asset_master', $id);
        echo json_encode($data);
    }

    public function ajax_edit_Assets_Unique_Information() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_asset_master', $id);
        echo json_encode($data);
    }

    public function load_asset_unique_dtls() {
        $dtlid = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_assets_detail', $dtlid);
        echo json_encode($data);
    }

    public function load_asset_dtls() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_detail', array('mid' => $id));

        if ($query->num_rows() > 0) {
            $sr = 0;
            foreach ($query->result() as $val) {
                $sr++;
                print"<tr>"
                        . "<td>" . $sr . "<input type='hidden' value='" . $val->id . "' name='dtls_id[]' id='dtls_id_" . $sr . "'/></td>"
                        . "<td><input class='form-control input-sm' type='text' readonly name='asset_name[]' id='asset_name_" . $sr . "' value='" . $val->asset_id . "' placeholder='Asset Name' /></td>"
                        . "<td><input class='form-control input-sm' type='text' name='model_name[]' id='model_name_" . $sr . "' value='" . $val->model_name . "' placeholder='Model name' /></td>"
                        . "<td><input class='form-control input-sm' readonly type='text' name='serial_no[]' id='serial_no_" . $sr . "' value='" . $val->serial_no . "' placeholder='Serial no' /></td>"
                        . "<td><input class='form-control input-sm' type='text' name='value[]' id='value_" . $sr . "' value='" . $val->value . "' placeholder='Value' /></td>"
                        . "<td><input class='form-control input-sm' type='text' name='description[]' id='description_" . $sr . "' value='" . $val->description . "' placeholder='Description' /></td>"
                        . "<td style='width: 12%; '><a class='btn btn-sm btn-u disabled' id='add_" . $sr . "' title='Add' onclick=''><i class='glyphicon glyphicon-plus' ></i></a>&nbsp;<a class='btn btn-sm btn-danger disabled' id='remove_" . $sr . "' title='Delete'  onclick=''><i class='glyphicon glyphicon-minus' ></i></a></td>"
                        . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 8 class="text-info">No Plan added.</td></tr>';
        }
    }

    public function update_AssetsInformation() {

        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category_id', 'asset category id', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_name_id', 'Asset Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('quantity', 'Quantity', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $pdata = array(
                'company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('asset_type_id'),
                'asset_category_id' => $this->input->post('asset_category_id'),
                'asset_name_id' => $this->input->post('asset_name_id'),
                'quantity' => $this->input->post('quantity'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $pres = $this->Common_model->update_data('main_asset_master', $pdata, array('id' => $this->input->post('asset_mst_id')));

            $asset_id = $this->input->post('asset_name');
            $model_name = $this->input->post('model_name');
            $serial_no = $this->input->post('serial_no');
            $value = $this->input->post('value');
            $description = $this->input->post('description');
            $dtlid = $this->input->post('dtls_id');

            $ddata = array();
            for ($i = 0; $i < count($model_name); $i++) {
                $ddata[$i] = array(
                    'id' => $dtlid[$i],
                    'asset_id' => $asset_id[$i],
                    'model_name' => $model_name[$i],
                    'serial_no' => $serial_no[$i],
                    'value' => $value[$i],
                    'description' => $description[$i],
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
            }

            $dres = $this->db->update_batch('main_assets_detail', $ddata, 'id');

            if ($pres && $dres) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function update_Assets_Unique_Information() {

        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_category_id', 'asset category id', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_name_id', 'Asset Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('quantity', 'Quantity', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $pdata = array(
                'company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('asset_type_id'),
                'asset_category_id' => $this->input->post('asset_category_id'),
                'asset_name_id' => $this->input->post('asset_name_id'),
                'quantity' => $this->input->post('quantity'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $pres = $this->Common_model->update_data('main_asset_master', $pdata, array('id' => $this->input->post('asset_mst_id')));

            $asset_id = $this->input->post('asset_name');
            $model_name = $this->input->post('model_name');
            $serial_no = $this->input->post('serial_no');
            $value = $this->input->post('value');
            $description = $this->input->post('description');
            $dtlid = $this->input->post('dtls_id');

            $ddata = array();
            for ($i = 0; $i < count($model_name); $i++) {
                $ddata[$i] = array(
                    'id' => $dtlid[$i],
                    'asset_id' => $asset_id[$i],
                    'model_name' => $model_name[$i],
                    'serial_no' => $serial_no[$i],
                    'value' => $value[$i],
                    'description' => $description[$i],
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
            }

            $dres = $this->db->update_batch('main_assets_detail', $ddata, 'id');

            if ($pres && $dres) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function save_aassetsname() {

        $this->form_validation->set_rules('aasset_type', 'Asset Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('aasset_category', 'Asset Category', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_name', 'Asset Name', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'asset_type_id' => $this->input->post('aasset_type'),
                'asset_category_id' => $this->input->post('aasset_category'),
                'asset_name' => $this->input->post('asset_name'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_assets_name', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    //==========================================================================

    public function save_alertpolicy() {
        
        $this->form_validation->set_rules('alert_item', 'Alert Item', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];
            
            $this->db->where('alert_item', $this->input->post('alert_item'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_alert_policy');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This alert type already exist.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'alert_item' => $this->input->post('alert_item'),
                'alert_status' => $this->input->post('alert_status'),
                'alert_after_days' => $this->input->post('alert_after_days'),
                'alert_message_template' => $this->input->post('alert_message_template'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
           
            $res = $this->Common_model->insert_data('main_alert_policy', $data);
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_alertpolicy() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_alert_policy', $id);
        echo json_encode($data);
    }

    public function update_alertpolicy() {

        $this->form_validation->set_rules('alert_item', 'Alert Item', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('alertpolicy_id'));
            $this->db->where('alert_item', $this->input->post('alert_item'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_alert_policy');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This alert type already exist.', 2);
                exit();
            }
            
            $data = array('company_id' => $this->company_settings_id,
                'alert_item' => $this->input->post('alert_item'),
                'alert_status' => $this->input->post('alert_status'),
                'alert_after_days' => $this->input->post('alert_after_days'),
                'alert_message_template' => $this->input->post('alert_message_template'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_alert_policy', $data, array('id' => $this->input->post('alertpolicy_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_alertpolicy() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_alert_policy", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //==========================================================================

    public function save_leavepolicy() {

        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_type', 'Employee Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_year', 'Leave Year', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applicable', 'Applicable', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('max_limit', 'Max Limit', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $this->db->where('leave_type', $this->input->post('leave_type'));
            $this->db->where('leave_year', $this->input->post('leave_year'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_leave_policy');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave type already exist in this year.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'max_limit' => $this->input->post('max_limit'),
                'leave_type' => $this->input->post('leave_type'),
                'applicable' => $this->input->post('applicable'),
                'employee_type' => $this->input->post('employee_type'),
                'off_day_leave_count' => $this->input->post('off_day_leave_count'),
                'fractional_leave' => $this->input->post('fractional_leave'),
                'leave_year' => $this->input->post('leave_year'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => $this->input->post('leave_status'),
            );

            $res = $this->Common_model->insert_data('main_leave_policy', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_leavepolicy() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_leave_policy', $id);
        echo json_encode($data);
    }

    public function edit_leavepolicy() {

        $this->form_validation->set_rules('leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_type', 'Employee Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('leave_year', 'Leave Year', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('applicable', 'Applicable', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('max_limit', 'Max Limit', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('leavepolicy_id'));
            $this->db->where('leave_type', $this->input->post('leave_type'));
            $this->db->where('leave_year', $this->input->post('leave_year'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_leave_policy');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave type already exist in this year.', 2);
                exit();
            }

            $data = array('company_id' => $this->company_settings_id,
                'max_limit' => $this->input->post('max_limit'),
                'leave_type' => $this->input->post('leave_type'),
                'applicable' => $this->input->post('applicable'),
                'employee_type' => $this->input->post('employee_type'),
                'off_day_leave_count' => $this->input->post('off_day_leave_count'),
                'fractional_leave' => $this->input->post('fractional_leave'),
                'leave_year' => $this->input->post('leave_year'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => $this->input->post('leave_status'),
            );

            $res = $this->Common_model->update_data('main_leave_policy', $data, array('id' => $this->input->post('leavepolicy_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

//    public function delete_alertpolicy() {
//        $id = $this->uri->segment(3);
//        $res = $this->Common_model->delete_by_id("main_alert_policy", $id);
//        if ($res) {
//            echo $this->Common_model->show_massege(4, 1);
//        } else {
//            echo $this->Common_model->show_massege(5, 2);
//        }
//    }
    //==========================================================================

    public function save_pto_policy() {

//        pr($this->input->post('hidden_hourly_allowance'));
//        pr($this->input->post(), 1);

        $this->form_validation->set_rules('paid_leave_type', 'Leave Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('paid_description', 'Paid Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('report_description', 'Report Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('method', 'PTO Method', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('paid_leave_type', $this->input->post('paid_leave_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_pto_settings');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave type already exist.', 2);
                exit();
            }

            if ($this->input->post('ot_hour')) {
                $ot_hour = $this->input->post('ot_hour');
            } else {
                $ot_hour = "";
            }

            if ($this->input->post('dt_hour')) {
                $dt_hour = $this->input->post('dt_hour');
            } else {
                $dt_hour = "";
            }

            if ($this->input->post('accruable_benefit_hour')) {
                $accruable_benefit_hour = $this->input->post('accruable_benefit_hour');
            } else {
                $accruable_benefit_hour = "";
            }

            if ($this->input->post('reset_beginning_balance')) {
                $reset_beginning_balance = $this->input->post('reset_beginning_balance');
            } else {
                $reset_beginning_balance = "";
            }

            if ($this->input->post('pay_period_spans')) {
                $pay_period_spans = $this->input->post('pay_period_spans');
            } else {
                $pay_period_spans = "";
            }

            if ($this->input->post('hidden_graduated_form') != '') {
                $hidden_graduated_form_val = explode(",", $this->input->post('hidden_graduated_form'));
                $hidden_graduated_to_val = explode(",", $this->input->post('hidden_graduated_to'));
                $hidden_hourly_allowance_val = explode(",", $this->input->post('hidden_hourly_allowance'));
                $hidden_available_limit_val = explode(",", $this->input->post('hidden_available_limit'));
                //$hidden_check_limit_val = explode(",", $this->input->post('hidden_check_limit'));
                //$hidden_month_limit_val = explode(",", $this->input->post('hidden_month_limit'));
                $hidden_annual_limit_val = explode(",", $this->input->post('hidden_annual_limit'));
                $hidden_carryover_maximum_val = explode(",", $this->input->post('hidden_carryover_maximum'));
            }

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array(
                'company_id' => $this->company_settings_id,
                'paid_leave_type' => $this->input->post('paid_leave_type'),
                'paid_description' => $this->input->post('paid_description'),
                //'report_description' => $this->input->post('report_description'),
                'method' => $this->input->post('method'),
                'hourly_allowance_option' => $this->input->post('hourly_allowance_option'),
                'fixed_amount' => $this->input->post('fixed_amount'),
                'ot_hour' => $ot_hour,
                'dt_hour' => $dt_hour,
                'accruable_benefit_hour' => $accruable_benefit_hour,
                'benefit_accrual_until' => $this->input->post('benefit_accrual_until'),
                //'hire_date_leave' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date_leave')),
                'accrual_hours_availability_until' => $this->input->post('accrual_hours_availability_until'),
                //'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                'available_limit' => $this->input->post('available_limit'),
                //'per_check_limit' => $this->input->post('per_check_limit'),
                'annual_limit' => $this->input->post('annual_limit'),
                //'per_month_limit' => $this->input->post('per_month_limit'),
                'balanced_method' => $this->input->post('balanced_method'),
                'reset_beginning_balance' => $reset_beginning_balance,
                'balanced_date' => $this->Common_model->convert_to_mysql_date($this->input->post('balanced_date')),
                'carryover_maximum' => $this->input->post('carryover_maximum'),
                'pay_period_spans' => $pay_period_spans,
                /* 'workers_compensation' => $this->input->post('workers_compensation'), */
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $pto_settings_mst_id = 0;
            $check_exist = $this->db->get_where('main_pto_settings', array('paid_leave_type' => $data['paid_leave_type'], 'company_id' => $this->company_settings_id))->row();
            if (empty($check_exist)) {
                $res = $this->Common_model->insert_data('main_pto_settings', $data);
                $pto_settings_mst_id = $this->db->insert_id();
            } else {
                $this->db->where('company_id', $this->company_settings_id);
                $this->db->where('paid_leave_type', $data['paid_leave_type']);
                $res = $this->db->update('main_pto_settings', $data);

                $pto_settings_mst_id = $check_exist->id;
            }

            if ($this->input->post('hidden_graduated_form') != '') {
                $tdata = array();
                for ($i = 0; $i < count($hidden_graduated_form_val); $i++) {
                    $tdata[$i] = array(
                        'mst_id' => $pto_settings_mst_id,
                        'company_id' => $this->company_settings_id,
                        'hourly_allowance_option' => $this->input->post('hidden_hourly_allowance_option'),
                        'graduated_form' => $hidden_graduated_form_val[$i],
                        'graduated_to' => $hidden_graduated_to_val[$i],
                        'hourly_allowance' => $hidden_hourly_allowance_val[$i],
                        'available_limit' => $hidden_available_limit_val[$i],
                        //'check_limit' => $hidden_check_limit_val[$i],
                        //'month_limit' => $hidden_month_limit_val[$i],
                        'annual_limit' => $hidden_annual_limit_val[$i],
                        'carryover_maximum' => $hidden_carryover_maximum_val[$i]
                    );
                }
            }

            if ($this->input->post('hidden_graduated_form') != '') {
                if ($this->input->post('hourly_allowance_option') == 2) {
                    $this->db->where('mst_id', $pto_settings_mst_id);
                    $this->db->delete('main_pto_settings_details');

                    /* Inserting New MST settings */
                    $tres = $this->db->insert_batch('main_pto_settings_details', $tdata);
                }
            }

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_ptopolicy() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_pto_settings', $id);
        echo json_encode($data);
    }

    public function ajax_edit_ptopolicy_dtls() {
        $id = $this->uri->segment(3);
        //$query = $this->Common_model->get_row_by_field('mst_id','main_pto_settings_details', $id);
        $query = $this->db->get_where('main_pto_settings_details', array('mst_id' => $id));
        //$num_rows = $query->num_rows();

        $tid = "";
        $hourly_allowance_option = "";
        $graduated_form = "";
        $graduated_to = "";
        $hourly_allowance = "";
        $available_limit = "";
        //$check_limit = "";
        //$month_limit = "";
        $annual_limit = "";
        $carryover_maximum = "";

        if ($query) {
            foreach ($query->result() as $row) {
                $hourly_allowance_option = $row->hourly_allowance_option;
                if ($tid == "") {
                    $tid = $row->id;
                    $graduated_form = $row->graduated_form;
                    $graduated_to = $row->graduated_to;
                    $hourly_allowance = $row->hourly_allowance;
                    $available_limit = $row->available_limit;
                    //$check_limit = $row->check_limit;
                    //$month_limit = $row->month_limit;
                    $annual_limit = $row->annual_limit;
                    $carryover_maximum = $row->carryover_maximum;
                } else {
                    $tid = $tid . "," . $row->id;
                    $graduated_form = $graduated_form . "," . $row->graduated_form;
                    $graduated_to = $graduated_to . "," . $row->graduated_to;
                    $hourly_allowance = $hourly_allowance . "," . $row->hourly_allowance;
                    $available_limit = $available_limit . "," . $row->available_limit;
                    //$check_limit = $check_limit . "," . $row->check_limit;
                    //$month_limit = $month_limit . "," . $row->month_limit;
                    $annual_limit = $annual_limit . "," . $row->annual_limit;
                    $carryover_maximum = $carryover_maximum . "," . $row->carryover_maximum;
                }
            }
        }

        echo json_encode(array("id" => $tid,
            "hourly_allowance_option" => $hourly_allowance_option,
            "graduated_form" => $graduated_form,
            "graduated_to" => $graduated_to,
            "hourly_allowance" => $hourly_allowance,
            "available_limit" => $available_limit,
            //"check_limit" => $check_limit,
            //"month_limit" => $month_limit,
            "annual_limit" => $annual_limit,
            "carryover_maximum" => $carryover_maximum));

        //echo json_encode(array("status" => 'check_pg',"booking_no"=>$booking_no));
        //echo json_encode($data);
    }

    public function update_pto_policy() {

        $this->form_validation->set_rules('paid_leave_type', 'Leave Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('paid_description', 'Paid Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        //$this->form_validation->set_rules('report_description', 'Report Description', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('method', 'PTO Method', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $this->db->where('id !=', $this->input->post('com_pto_settings_id'));
            $this->db->where('paid_leave_type', $this->input->post('paid_leave_type'));
            $this->db->where('company_id', $this->company_settings_id);
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_pto_settings');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This Leave type already exist.', 2);
                exit();
            }

            if ($this->input->post('ot_hour')) {
                $ot_hour = $this->input->post('ot_hour');
            } else {
                $ot_hour = "";
            }

            if ($this->input->post('dt_hour')) {
                $dt_hour = $this->input->post('dt_hour');
            } else {
                $dt_hour = "";
            }

            if ($this->input->post('accruable_benefit_hour')) {
                $accruable_benefit_hour = $this->input->post('accruable_benefit_hour');
            } else {
                $accruable_benefit_hour = "";
            }

            if ($this->input->post('reset_beginning_balance')) {
                $reset_beginning_balance = $this->input->post('reset_beginning_balance');
            } else {
                $reset_beginning_balance = "";
            }

            if ($this->input->post('pay_period_spans')) {
                $pay_period_spans = $this->input->post('pay_period_spans');
            } else {
                $pay_period_spans = "";
            }

            if ($this->input->post('hidden_graduated_form') != '') {
                $hidden_graduated_form_val = explode(",", $this->input->post('hidden_graduated_form'));
                $hidden_graduated_to_val = explode(",", $this->input->post('hidden_graduated_to'));
                $hidden_hourly_allowance_val = explode(",", $this->input->post('hidden_hourly_allowance'));
                $hidden_available_limit_val = explode(",", $this->input->post('hidden_available_limit'));
                //$hidden_check_limit_val = explode(",", $this->input->post('hidden_check_limit'));
                //$hidden_month_limit_val = explode(",", $this->input->post('hidden_month_limit'));
                $hidden_annual_limit_val = explode(",", $this->input->post('hidden_annual_limit'));
                $hidden_carryover_maximum_val = explode(",", $this->input->post('hidden_carryover_maximum'));
            }

            $data = array('company_id' => $this->company_settings_id,
                'paid_leave_type' => $this->input->post('paid_leave_type'),
                'paid_description' => $this->input->post('paid_description'),
                //'report_description' => $this->input->post('report_description'),
                'method' => $this->input->post('method'),
                'hourly_allowance_option' => $this->input->post('hourly_allowance_option'),
                'fixed_amount' => $this->input->post('fixed_amount'),
                'ot_hour' => $ot_hour,
                'dt_hour' => $dt_hour,
                'accruable_benefit_hour' => $accruable_benefit_hour,
                'benefit_accrual_until' => $this->input->post('benefit_accrual_until'),
                'hire_date_leave' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date_leave')),
                'accrual_hours_availability_until' => $this->input->post('accrual_hours_availability_until'),
                'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                'available_limit' => $this->input->post('available_limit'),
                //'per_check_limit' => $this->input->post('per_check_limit'),
                'annual_limit' => $this->input->post('annual_limit'),
                //'per_month_limit' => $this->input->post('per_month_limit'),
                'balanced_method' => $this->input->post('balanced_method'),
                'reset_beginning_balance' => $reset_beginning_balance,
                'balanced_date' => $this->Common_model->convert_to_mysql_date($this->input->post('balanced_date')),
                'carryover_maximum' => $this->input->post('carryover_maximum'),
                'pay_period_spans' => $pay_period_spans,
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_pto_settings', $data, array('id' => $this->input->post('com_pto_settings_id')));

            if ($this->input->post('hourly_allowance_option') == 2) {

                $this->db->where('mst_id', $this->input->post('com_pto_settings_id'));
                $this->db->delete('main_pto_settings_details');

                if ($this->input->post('hidden_graduated_form') != '') {
                    $tdata = array();
                    for ($i = 0; $i < count($hidden_graduated_form_val); $i++) {
                        $tdata[$i] = array(
                            'mst_id' => $this->input->post('com_pto_settings_id'),
                            'company_id' => $this->company_settings_id,
                            'hourly_allowance_option' => $this->input->post('hidden_hourly_allowance_option'),
                            'graduated_form' => $hidden_graduated_form_val[$i],
                            'graduated_to' => $hidden_graduated_to_val[$i],
                            'hourly_allowance' => $hidden_hourly_allowance_val[$i],
                            'available_limit' => $hidden_available_limit_val[$i],
                            //'check_limit' => $hidden_check_limit_val[$i],
                            //'month_limit' => $hidden_month_limit_val[$i],
                            'annual_limit' => $hidden_annual_limit_val[$i],
                            'carryover_maximum' => $hidden_carryover_maximum_val[$i]
                        );
                    }
                }

                if ($this->input->post('hidden_graduated_form') != '') {
                    $tres = $this->db->insert_batch('main_pto_settings_details', $tdata);
                }
            } else {
                $this->db->where('mst_id', $this->input->post('com_pto_settings_id'));
                $this->db->delete('main_pto_settings_details');
            }

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function download_company_info() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $company_id = $this->uri->segment(3);

        $param = array();
        $param['company_settings_id'] = $company_id;

        $param['company_basic'] = $this->db->get_where('main_company', array('id' => $company_id))->row_array();
        //echo $this->db->last_query();

        //$this->load->view('hr/reports/company_info_pdf', $param);

        $this->pdf->load_view('hr/reports/company_info_pdf', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Company_Settings_Report.pdf");
        
    }

    //==========================================================================

    public function load_county_name() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_county', array('state_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->county_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    //==========================================================================
    //==========================================================================

    public function get_gl_code() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_positions', array('positionname' => $id))->row();
        if (!empty($query)) {
            echo $glcode = $query->gl_code;
        } else {
            echo $glcode = "";
        }
    }

    public function check_po_Wage() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_wage_compensation', array('position' => $id))->row();
        if (!empty($query)) {
            echo $exist = 1;
        } else {
            echo $exist = 0;
        }
    }

    public function save_WageCompensation() {

        $this->form_validation->set_rules('wage_position', 'Position', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('wage_type', 'Wage Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'position' => $this->input->post('wage_position'),
                'gl_code' => $this->input->post('wage_gl_code'),
                'wage_type' => $this->input->post('wage_type'),
                'hourly_rate' => $this->input->post('hourly_rate'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_wage_compensation', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_WageCompensation() {
        $id = $this->uri->segment(3);
        //$data = $this->Common_model->get_by_id_row('main_wage_compensation', $id);
        $data = $this->db->get_where('main_wage_compensation', array('position' => $id))->row();
        echo json_encode($data);
    }

    public function update_WageCompensation() {

        $this->form_validation->set_rules('wage_position', 'Position', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('wage_type', 'Wage Type', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_settings_id,
                'position' => $this->input->post('wage_position'),
                'gl_code' => $this->input->post('wage_gl_code'),
                'wage_type' => $this->input->post('wage_type'),
                'hourly_rate' => $this->input->post('hourly_rate'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_wage_compensation', $data, array('id' => $this->input->post('wage_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_WageCompensation() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_wage_compensation", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    
    //==============================API Setting=================================
    
    public function save_apisetting() {

        $this->form_validation->set_rules('secret_type', 'API SECRET TYPE', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('accountant', 'ACCOUNTANT', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('site', 'SITE', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('api_secret', 'API SECRET', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'api_secret_type' => $this->input->post('secret_type'),
                'accountant' => $this->input->post('accountant'),
                'site' => $this->input->post('site'),
                'api_secret' => $this->input->post('api_secret'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_apisetting', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_apisetting() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_apisetting', $id);
        //$data = $this->db->get_where('main_wage_compensation', array('position' => $id))->row();
        echo json_encode($data);
    }

    public function update_apisetting() {

        $this->form_validation->set_rules('secret_type', 'API SECRET TYPE', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('accountant', 'ACCOUNTANT', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('site', 'SITE', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('api_secret', 'API SECRET', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_settings_id,
                'api_secret_type' => $this->input->post('secret_type'),
                'accountant' => $this->input->post('accountant'),
                'site' => $this->input->post('site'),
                'api_secret' => $this->input->post('api_secret'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_apisetting', $data, array('id' => $this->input->post('apisetting_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_apisetting() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_apisetting", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================



     //==============================Job Posting API Setting=================================
    
     public function save_jobposting() {

        $this->form_validation->set_rules('job_title', 'job title', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('job_type', 'job type', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('location', 'location', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('posted', 'posted', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $company_data = $this->session->userdata('company');
            $this->company_settings_id = $company_data['company_settings_id'];

            $data = array('company_id' => $this->company_settings_id,
                'job_title' => $this->input->post('job_title'),
                'job_type' => $this->input->post('job_type'),
                'location' => $this->input->post('location'),
                'posted' => $this->input->post('posted'),
                'description' => $this->input->post('description'),
                'opening_date' => $this->input->post('opening_date'),
                'deadline' => $this->input->post('deadline'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_job_posting', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_jobposting() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_job_posting', $id);
        //$data = $this->db->get_where('main_wage_compensation', array('position' => $id))->row();
        echo json_encode($data);
    }

    public function update_jobposting() {

        $this->form_validation->set_rules('secret_type', 'API SECRET TYPE', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('accountant', 'ACCOUNTANT', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('site', 'SITE', 'required', array('required' => "Please enter the required field, for more Info : %s."));
        $this->form_validation->set_rules('api_secret', 'API SECRET', 'required', array('required' => "Please enter the required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_settings_id,
                'api_secret_type' => $this->input->post('secret_type'),
                'accountant' => $this->input->post('accountant'),
                'site' => $this->input->post('site'),
                'api_secret' => $this->input->post('api_secret'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_apisetting', $data, array('id' => $this->input->post('apisetting_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_jobposting() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_apisetting", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================

     /* public function companyuser_createPassword( $passwordResetHash = NULL ) {
         print_r("Test");exit;
        if ($this->session->userdata('hr_logged_in')) {
            print_r("user already logged in");exit;
            redirect('Con_dashbord/', 'refresh');
        } else {
            print_r("user already logged in");exit;
            $user = $this->db->get_where('main_users', array('password_reset_hash' => $passwordResetHash))->row();

            if (!empty($user)) {
                $param['passwordResetHash'] = $passwordResetHash;
            } else {
                $param['passwordResetHash'] = "000";
            }

            $param['topheader'] = 'uni_template/login_header.php';
            $param['title'] = 'HRM';
            $param['content'] = 'uni_template/companyuser_createpassword.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';

            $this->load->view('admin/home', $param);
        }
    } */

    public function showLocation()
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
            0=>'main_location.id',
            1=>'main_location.location_name',
            2=>'main_location.contact_person',
            3=>'main_location.contact_number',
            4=>'main_location.email',
            5=>'main_location.started_on',

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
        
       $company_data = $this->session->userdata('company');
        $this->company_settings_id = $company_data['company_settings_id'];
        //echo "<script>alert('$this->company_settings_id');</script>";
        $this->db->limit($length, $start);
        $this->db->select('main_location.id, main_location.location_name, main_location.contact_person, main_location.contact_number, main_location.email, main_location.started_on');
        $this->db->from('main_location');
        //$this->db->where('main_opening_position.company_id', $this->company_id);
        $this->db->where('main_location.isactive', 1);

        //if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('company_id', $this->company_settings_id);
       // }
        $location_list = $this->db->get()->result();
        // echo "<pre>". print_r($employees) ."</pre>";exit;
      
        $data = array();
        $i = 0;
        foreach ($location_list as $row) {
            $i++;
            //print_r($requisition_list); exit;
            $data[] = array(
                $row->id,
                $i,
                ucwords($row->location_name),
                ucwords($row->contact_person),
                $row->contact_number,
                ucwords($row->email),
                $this->Common_model->show_date_formate($row->started_on),
                '<div class="action-buttons "><a href="javascript:void()" onclick="edit_location(' . $row->id . ')"  ><i class="fa fa-pencil-square-o">&nbsp;&nbsp;</i></a><a href="javascript:void(0)" onclick="delete_location(' . $row->id . ')"><i class="fa fa-trash-o"></i></a></div>'
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }
        //echo "<script>alert('$this->company_settings_id');</script>";
        $total_new_location = $this->totalNewLocations();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_new_location,
            "recordsFiltered" => $total_new_location,
            "data" => $data
        );

        echo json_encode($output);
        exit();
        echo "<pre>". print_r($this->company_settings_id) ."</pre>";exit;
    }

    public function totalNewLocations()
    {
        //$departmentId = $this->input->get("department_id");
        $company_data = $this->session->userdata('company');
        $this->company_settings_id = $company_data['company_settings_id'];

        $this->db->select("COUNT(*) as num");
        //$this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        //if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
           $this->db->where('company_id', $this->company_settings_id);
        //}
        //$this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_location");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }
}
