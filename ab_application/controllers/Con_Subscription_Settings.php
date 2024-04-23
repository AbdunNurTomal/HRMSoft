<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Subscription_Settings extends CI_Controller {

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
        $param['page_header'] = "Subscription Settings";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $this->db->select('com.id as com_id,usr.id as usr_id,com.email as company_email,com.*, usr.*');
            $this->db->from('main_company as com');
            $this->db->join('main_users as usr', 'com.company_user_id = usr.id');
            $this->db->where('com.id', $this->company_id);
            //$this->db->where('ew.department', $id);
            $param['query'] = $this->db->get();
            //echo $this->db->last_query();
        } else if($this->company_id==0){
            $this->db->select('com.id as com_id,usr.id as usr_id,com.email as company_email,com.*, usr.*');
            $this->db->from('main_company as com');
            $this->db->join('main_users as usr', 'com.company_user_id = usr.id');
            //$this->db->where('com.id', $this->company_id);
            //$this->db->where('ew.department', $id);
            $param['query'] = $this->db->get();
            //echo $this->db->last_query();

        }else{
            $this->db->select('com.id as com_id,usr.id as usr_id,com.email as company_email,com.*, usr.*');
            $this->db->from('main_company as com');
            $this->db->join('main_users as usr', 'com.company_user_id = usr.id');
            $this->db->where('com.id', $this->company_id);
            //$this->db->where('ew.department', $id);
            $param['query'] = $this->db->get();
            //echo $this->db->last_query();
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Subscription_Settings.php';
        $this->load->view('admin/home', $param);
    }    

     function edit_Subscription_Settings() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $com_id = $this->uri->segment(3);
        $usr_id = $this->uri->segment(4);

        $param['type'] = "2";
        $param['page_header'] = "Subscription Settings";
        $param['module_id'] = $this->module_id;

        $param['com_query'] = $this->db->get_where('main_company', array('id' => $com_id));
        $param['users_query'] = $this->db->get_where('main_users', array('id' => $usr_id));
        $param['subs_query'] = $this->db->get_where('main_subscription_settings', array('company_id' => $com_id));

        $ignore = array(12);
        $this->db->where_in('id', $ignore);
        $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array());
          // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            //print_r($this->uri->segment(3)); exit;
            $this->KurunthamModel->checkPageAccess("users", $usr_id, $this->company_id);
        }
        // check permission to view the employee ends
            
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addSubscription_Settings.php';
        $this->load->view('admin/home', $param);
    }
    
    public function edit_Subscription_data() {
        $this->form_validation->set_rules('name', 'User Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
       // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]',array('required'=> "Password Not matches, for more Info : %s."));
        $this->form_validation->set_rules('company_name', 'Company Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('company_email', 'Company Email', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('password', 'User Password', 'callback_validate_change_password');
        if (!empty($this->input->post('password'))) {
           
        // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]',array('required'=> "Password Not matches, for more Info : %s."));
       $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        } else{
            // print_r("hfdefll"); exit;
             $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if (!empty($this->input->post('password'))) {
                $user_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    // 'password' => $this->Common_model->encrypt($this->input->post('password')),
                    'password' => md5($this->input->post('password')),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => $this->input->post('status'),
                );
            } else {
                $user_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => $this->input->post('status'),
                );
            }

            $ures = $this->Common_model->update_data('main_users', $user_data, array('id' => $this->input->post('id')));
            
            $company_data = array('company_full_name' => $this->input->post('company_name'),
                'email' => $this->input->post('company_email'),
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('company_state'),
                'zip_code' => $this->input->post('zip_code'),
                'mobile_phone' => $this->input->post('mobile_phone'),
                'billing_type' => $this->input->post('billing_type'),
                'rate' => $this->input->post('rate'),
                'pricing_setup' => $this->input->post('pricing_setup'),
                'payable_type' => $this->input->post('payable_type'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                //'isactive' => '1',
                'isactive' => $this->input->post('status'),
            );
            $cres = $this->Common_model->update_data('main_company', $company_data, array('id' => $this->input->post('com_id')));
            /*User Password Update */
            if ($cres) {
                $data = array(
                    'user_id' => $this->input->post('com_id'),
                    'password' => md5($this->input->post('password')),
                    'created_by' => $this->input->post('com_id'),
                    'created_at' => date("Y-m-d H:i:s")
                );
                $result1 = $this->Common_model->insert_data('user_password', $data);
            }

            $com_query = $this->db->get_where('main_subscription_settings', array('company_id' => $this->input->post('com_id')));
            if ($com_query->num_rows() > 0) {//update
                if ($this->input->post('welcome_email')) {
                    $welcome_email = $this->input->post('welcome_email');
                } else {
                    $welcome_email = 0;
                }
                if ($this->input->post('newslatter')) {
                    $newslatter = $this->input->post('newslatter');
                } else {
                    $newslatter = 0;
                }
                if ($this->input->post('library_promo')) {
                    $library_promo = $this->input->post('library_promo');
                } else {
                    $library_promo = 0;
                }
                if ($this->input->post('alerts')) {
                    $alerts = $this->input->post('alerts');
                } else {
                    $alerts = 0;
                }
                if ($this->input->post('ebooks')) {
                    $ebooks = $this->input->post('ebooks');
                } else {
                    $ebooks = 0;
                }
                $subscription_data = array('company_id' => $this->input->post('com_id'),
                    'welcome_email' => $welcome_email,
                    'newslatter' => $newslatter,
                    'library_promo' => $library_promo,
                    'alerts' => $alerts,
                    'ebooks' => $ebooks,
                    'start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('start_date')),
                    'end_date' => $this->Common_model->convert_to_mysql_date($this->input->post('end_date')),
                    'user_group' => $this->input->post('user_group'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
                $subres = $this->Common_model->update_data('main_subscription_settings', $subscription_data, array('company_id' => $this->input->post('com_id')));
            } else {//Insert
                
                if ($this->input->post('welcome_email')) {
                    $welcome_email = $this->input->post('welcome_email');
                } else {
                    $welcome_email = 0;
                }
                if ($this->input->post('newslatter')) {
                    $newslatter = $this->input->post('newslatter');
                } else {
                    $newslatter = 0;
                }
                if ($this->input->post('library_promo')) {
                    $library_promo = $this->input->post('library_promo');
                } else {
                    $library_promo = 0;
                }
                if ($this->input->post('alerts')) {
                    $alerts = $this->input->post('alerts');
                } else {
                    $alerts = 0;
                }
                if ($this->input->post('ebooks')) {
                    $ebooks = $this->input->post('ebooks');
                } else {
                    $ebooks = 0;
                }

                $subscription_insert_data = array('company_id' => $this->input->post('com_id'),
                    'welcome_email' => $welcome_email,
                    'newslatter' => $newslatter,
                    'library_promo' => $library_promo,
                    'alerts' => $alerts,
                    'ebooks' => $ebooks,
                    'start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('start_date')),
                    'end_date' => $this->Common_model->convert_to_mysql_date($this->input->post('end_date')),
                    'user_group' => $this->input->post('user_group'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
                $subres = $this->Common_model->insert_data('main_subscription_settings', $subscription_insert_data);
            }

            if ($ures && $cres && $subres) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
   

    public function validate_change_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        $errorMessage = 'The {field} field must contain, at least one lowercase letter, one uppercase letter, one number, one special character (' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'). ') and minimum 8 characters in length.';
        if (!empty($password))
        {
            if (preg_match_all($regex_lowercase, $password) < 1)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must be at least one lowercase letter.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (preg_match_all($regex_uppercase, $password) < 1)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must be at least one uppercase letter.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (preg_match_all($regex_number, $password) < 1)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must have at least one number.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (preg_match_all($regex_special, $password) < 1)
            {        
                /* $rules = array(
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'callback_validate_change_password',
                    )
                ); */
        
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (strlen($password) < 8)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must be at least 8 characters in length.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (strlen($password) > 32)
            {
                $this->form_validation->set_message('validate_change_password', 'The {field} field cannot exceed 32 characters in length.');
                return FALSE;
            }

       
        }
         // last 3 password check validation starts
        if (!empty($password)) {
            $user_id = 0;
            $user = $this->db->get_where('main_users', array('id' => $this->input->post('com_id')))->row();
            if ($user) {
                $user_id = $user->id;
            }
    
            // $encryptedPassword = $this->Common_model->encrypt($password);
            $encryptedPassword = md5($password);

            $this->db->select();
            $this->db->from('user_password');
            $this->db->where(array('user_id' => $user_id));
            $this->db->order_by('id', 'DESC');
            $this->db->limit(3);
            $query = $this->db->get();

            $last3Passwords = $query->result();

            $foundInLastThreePassword = false;
            foreach ($last3Passwords as $userOldPassowrd) {
                if ($userOldPassowrd->password == $encryptedPassword) {
                    $foundInLastThreePassword = true;
                }
            }

            print_r($encryptedPassword);exit;
    
            if ($foundInLastThreePassword) {
                $this->form_validation->set_message('validate_change_password', 'Your new password must not match any of your previous three passwords.');
                return FALSE;  
            }
        }   
        
        // last 3 password check validation ends

        return TRUE;
    }

}
