<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class Chome extends CI_Controller {

    public $menu_id;
    public $mod_id;
    public $opration_id;
    public $user_data = array();
    public $user_id = null;
    public $user_type = null;
    public $user_module = null;
    public $date_time = null;
    public $company_id = null;
    public $module_id = null;
    public $two_factor_authentication_enabled = false;
    public $two_factor_authentication_otp_send_method = "";
    public $two_factor_otp_check_completed = false;
    public $twilioId = null;
    public $twilioToken = null;
    public $twilioFromNo = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        $this->company_id = $this->user_data['company_id'];

        $this->load->model('Sendmail_model');

        // Your Account SID and Auth Token from twilio.com/console
        $this->twilioId = "AC040212fbccb4154a3d2a40ecfef6e851";
        $this->twilioToken = "ad544bea3d08d5e3bc901b09c9a49173";
        // $this->twilioFromNo = "+14435696536";
        $this->twilioFromNo = "+16613063060";

        //header("Access-Control-Allow-Origin: *");
    }

    public function index() {
        //echo $this->user_id;
        //print_r($_COOKIE);
        //echo $this->Hr_login->logout();
        //echo CI_VERSION;
        //echo md5("Sohel123!@#");
        //echo CI_VERSION;
        //if ($this->user_id) {
        //if ($this->hr_login->is_logged_in()) {
        if ($this->session->userdata('hr_logged_in')) {
            if ($this->user_type == 3) {
                //redirect('Con_Admin_Dashbord/', 'refresh');
                redirect('Con_dashbord/', 'refresh');
            } else {
                redirect('Con_dashbord/', 'refresh');
            }
        } else {
            //echo "===>>>";
            //echo $this->Common_model->decrypt('mZ2jwsjOrJo=');
            //echo "===>>>";
            
            //echo $this->Common_model->encrypt('Reza123!@#');

            $param['topheader'] = 'uni_template/login_header.php';
            $param['title'] = 'HRM';
            $param['content'] = 'uni_template/main_content.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';
            $this->load->view('admin/home', $param);
        }
    }

    public function two_factor_auth()
    {
        $param['topheader'] = 'uni_template/login_header.php';
        $param['title'] = 'HRM';
        $param['content'] = 'uni_template/two_factor_authentication.php';
        $param['lastfooter'] = 'uni_template/login_footer.php';
        $this->load->view('admin/home', $param);
    }

    public function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post("password");
		//echo "username - ".$username." password - ".$password;
        $user = $this->Hr_login->get_user($username, $password);
		//echo $this->db->last_query();
		//print_r($user);exit;
        $userId = 0;
        if ($user) {
            $userId = $user[0]->id;
        }

        $this->two_factor_authentication_enabled = false;
        $userSettings = $this->db->get_where('two_factor_authentication', array('user_id' => $userId));
        if ($userSettings->result()) {
            $this->two_factor_authentication_enabled = $userSettings->result()[0]->enable_two_factor_authentication;
            $this->two_factor_authentication_otp_send_method = $userSettings->result()[0]->otp_send_method;
            // echo "<pre>". print_r($two_factor_authentication_otp_send_method, 1) ."</pre>";exit;
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');

        // check for old device starts
        $useragent = $_SERVER["HTTP_USER_AGENT"] ? : "-";

        $isNewDevice = false;
        if ($this->two_factor_authentication_enabled) {
            $condition = array("user_id" => $userId, "logged_in_device" => $useragent);
            $result = $this->Common_model->get_selected_row('user_logged_in_devices', $condition);
            if (!$result) {
                $isNewDevice = true;
            }
        }
        // check for old device ends

        if ($this->two_factor_authentication_enabled && !$this->two_factor_otp_check_completed && $isNewDevice) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_authentication');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        }

        if ($this->form_validation->run() === FALSE) {
            $this -> form_validation -> set_message('username', validation_errors());
            $this -> form_validation -> set_message('password', validation_errors());
            $this -> index();
        } else {
            if ($this->two_factor_authentication_enabled && $isNewDevice) {
                $this->send_otp();

                // log the device details into user_logged_in_devices table starts
                if ($useragent) {
                    $data = array('user_id' => $userId,
                        'logged_in_device' => $useragent,
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    $result1 = $this->Common_model->insert_data('user_logged_in_devices', $data);
                }
                // log the device details into user_logged_in_devices table ends

                redirect('Chome/two_factor_auth');
            }

            $user_data = $this->session->userdata('hr_logged_in');
            $user_type = $user_data ['usertype'];
            $user_module = $user_data ['user_module'];
            $user_group = $user_data ['user_group'];

            if ($user_type == 1 || $user_type == 2 || $user_type == 3 || $user_type == 4) {

                //if ($user_type == 3) {
                // $module_link = "Con_Admin_Dashbord";
                //} else {
                $user_module = explode(',', $user_module);
                $module_link = $this->Common_model->get_selected_value($this, 'id', $user_module[0], 'main_module', 'module_link');
                //}

                //echo "1" . "__" . $module_link;
                //echo $user_group;exit();
                if($user_module[0]==3){
                    $user_group_res = $this->db->get_where('main_usergroup', array('id' => $user_group, 'parent_id' => 9,'isactive' => 1))->result();     
                    if($user_group_res[0]->id){
                        $module_link="Con_Onboarding";
                    }
                }
                

                redirect($module_link.'/');

                //echo $user_module;
                /* if ($user_type == 1) {//1 for user
                  $param['content'] = 'sadmin/ticket.php';
                  $this->load->view('admin/home', $param);
                  } elseif ($user_type == 2) {//2 for bus owner
                  $param['content'] = 'sadmin/ticket.php';
                  $this->load->view('admin/home', $param);
                  } elseif ($user_type == 3) {//3 for sadmin
                  //$param['content'] = 'sadmin/home.php';
                  $param['left_menu_content'] = "Dashbord Page Left Menu Content";
                  $param['left_menu'] = 'sadmin/dashbord_leftmenu.php';
                  $param['content'] = 'sadmin/hrm_dashbord.php';
                  $this->load->view('admin/home', $param);
                  } */
            } else {
                //echo "2" . "__" . $this->Common_model->show_massege('Please Check Username or Password', 1);
                $this -> form_validation -> set_message('login_massege', 'Please Check Username or Password.');
                $this -> index();
            }
        }
    }

    public function check_otp() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean|callback_validate_otp');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() === FALSE) {
            $this->session->unset_userdata('hr_logged_in');
            $this->form_validation->set_message('username', validation_errors());
            $this->form_validation->set_message('password', validation_errors());
            $this->form_validation->set_message('otp', validation_errors());
            $this->two_factor_auth();
        } else {
            $user_data = $this->session->userdata('hr_logged_in');
            $user_type = $user_data ['usertype'];
            $user_module = $user_data ['user_module'];
            $user_group = $user_data ['user_group'];

            if ($user_type == 1 || $user_type == 2 || $user_type == 3 || $user_type == 4) {

                //if ($user_type == 3) {
                // $module_link = "Con_Admin_Dashbord";
                //} else {
                $user_module = explode(',', $user_module);
                $module_link = $this->Common_model->get_selected_value($this, 'id', $user_module[0], 'main_module', 'module_link');
                //}

                //echo "1" . "__" . $module_link;

                redirect($module_link.'/');

                //echo $user_module;
                /* if ($user_type == 1) {//1 for user
                  $param['content'] = 'sadmin/ticket.php';
                  $this->load->view('admin/home', $param);
                  } elseif ($user_type == 2) {//2 for bus owner
                  $param['content'] = 'sadmin/ticket.php';
                  $this->load->view('admin/home', $param);
                  } elseif ($user_type == 3) {//3 for sadmin
                  //$param['content'] = 'sadmin/home.php';
                  $param['left_menu_content'] = "Dashbord Page Left Menu Content";
                  $param['left_menu'] = 'sadmin/dashbord_leftmenu.php';
                  $param['content'] = 'sadmin/hrm_dashbord.php';
                  $this->load->view('admin/home', $param);
                  } */
            } else {
                //echo "2" . "__" . $this->Common_model->show_massege('Please Check Username or Password', 1);
                $this -> form_validation -> set_message('login_massege', 'Please Check Username or Password.');
                $this -> index();
            }
        }
    }

    function check_authentication($password) {
        $username = $this->input->post('username');
        $password = $this->input->post("password");
        $result = $this->Hr_login->get_user($username, $password);

        if ($result) {
            return TRUE;
        }
    }

    function validate_otp(){
        $sent_otp = $this->session->userdata("login_details")["otp"];
        $otp = trim($this->input->post('otp'));

        if ($sent_otp != $otp) {
            $this->form_validation->set_message('validate_otp', 'Please enter the valid OTP.');
            return FALSE;
        }

        return TRUE;
    }

    function send_otp()
    {
        // echo "<pre>". print_r($this->input->post(), 1) ."</pre>";exit;
        $this->load->helper('string');
        $otp = random_string('nozero', 6);

        // for developer testing purpose
        $username = $this->input->post('username');
        $password = $this->input->post("password");
        $ajaxCall = $this->input->post("ajaxCall") ? : 0;

        $user = $this->Hr_login->get_user($username, $password);
        // echo "<pre>". print_r($user, 1) ."</pre>";exit;
        $username = "";
        $email = "";
        $phoneNo = "";
        if ($user) {
            $username = $user[0]->name;
            $email = $user[0]->email;
            $phoneNo = $user[0]->phone_no;
        }

        /* $userArr['password_reset_hash'] = $otp;
        $this->Common_model->update_data('main_users', $userArr, array('id' => $user[0]->id)); */

        $session_array = array(
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
            "otp" => $otp
        );
        $this->session->set_userdata('login_details', $session_array);
        
        if ($this->two_factor_authentication_otp_send_method == "both") {
            $otpSent = $this->KurunthamModel->send_otp_mail($username, $email, $otp);
            $otpSent = $this->KurunthamModel->send_otp_sms($phoneNo, $otp);

        } else if ($this->two_factor_authentication_otp_send_method == "email") {
            $otpSent = $this->KurunthamModel->send_otp_mail($username, $email, $otp);

        } else {
            $otpSent = $this->KurunthamModel->send_otp_sms($phoneNo, $otp);
        }

        if ($ajaxCall)
            echo $otpSent;
    }

    function check_database($password) {
        // Field validation succeeded.  Validate against database
        // echo "<pre>". print_r($this->input->post(), 1) ."</pre>";exit;
        $username = $this->input->post('username');
        $password = $this->input->post("password");
        $result = $this->Hr_login->get_user($username, $password);

        if ($result) {
            //echo $result[0]->user_group;
            $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('company_id' => $result[0]->company_id, 'user_group_id' => $result[0]->user_group));
            if ($result[0]->user_group == 1) {
                $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('user_group_id' => $result[0]->user_group));
            }

            //print_r($result_menu->result());exit();
            if ($result_menu) {
                foreach ($result_menu->result() as $key) {
                    $this->menu_id = $key->menu_id;
                    $this->opration_id = $key->opration_id;
                    $this->mod_id = $key->module_id;
                }
            }

            // get parent user group starts
            $this->db->from('main_usergroup');
            $this->db->where('id', $result[0]->user_group);
            $query = $this->db->get();
            $userGroupRecord = $query->result();
            $userGroupParentId = 0;
            if ($userGroupRecord) {
                $userGroupParentId = $userGroupRecord[0]->parent_id;
            }
            // get parent user group ends

            $session_array = array(
                'id' => $result[0]->id,
                'company_id' => $result[0]->company_id,
                'username' => $result[0]->email,
                'name' => $result[0]->name,
                'usertype' => $result[0]->user_type,
                'user_group' => $result[0]->user_group,
                'user_group_ParentId' => $userGroupParentId,
                'user_image' => $result[0]->user_image,
                'parent_user' => $result[0]->parent_user,
                'candidate_id' => $result[0]->candidate_id,
                'user_menu' => $this->menu_id,
                'user_module' => $this->mod_id,
                'user_opration' => $this->opration_id,
                'admin_login' => '0',
                'admin_user_id' => '0',
                "company_view" => 0
            );

            //print_r($session_array);exit();

            $this->session->set_userdata('hr_logged_in', $session_array);

            //$this->session->mark_as_temp('hr_logged_in', 300);
//            $login_data = array('user_id' => $result[0]->id,
//                'user_name' => $result[0]->email,
//                'lan_ip' => $this->Common_model->get_client_ip(),
//                'lan_mac' => '',
//                'wan_ip' => '',
//                'login_time' => date("H:i:s"),
//                'login_date' => date("Y-m-d"),
//                'logout_time' => '',
//                'logout_date' => '',
//                'login_status' => '1',
//            );
//            $login_history_res = $this->Common_model->insert_data('login_history', $login_data);

            return TRUE;
        } else {
            $session_array = array(
                'log_status' => '1',
            );
            $this->session->set_userdata('hr_logged_st', $session_array);
            //$this->form_validation->set_message('check_database', 'Invalid username or password');
            $this -> form_validation -> set_message('check_database', 'Invalid username or password.');
            //$this -> index();
            return false;
        }
    }

    public function logout() {
        $this->Hr_login->logout();
    }

    public function Clear_DB() {
        //password : DBdestroy2017
        // isset($this->input->post('security_code'))
        if ($this->input->post('security_code')) {
            Clear_Database($this, $this->input->post('security_code'));
        } else {
            echo '<form method="post" action="' . base_url() . 'Chome/Clear_DB">
                    <input type="password" name="security_code" autocomplete="off" />&nbsp;
                    <input type="submit" value="GO" onsubmit="return confirm("Are you Sure??")"/>
                </form>';
        }
    }

    public function is_logged_in() {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $user_data = $this->session->userdata('hr_logged_in');
        $user_id = $user_data ['id'];

        if (!isset($user_id) || $user_id !== TRUE || $user_id == "") {
            //echo "sssssssdddddd";exit();
            redirect('Chome/');
        } else {
            $this->dashbord();
        }
    }

    public function change_password() {

        // $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]|alpha_numeric', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('user_password', 'User Password', 'callback_validate_change_password');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[user_password]');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            // $myNewPassword = $this->Common_model->encrypt($this->input->post('user_password'));
            $myNewPassword = md5($this->input->post('user_password'));

            $data = array(
                'password' => $myNewPassword,
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_users', $data, array('id' => $this->user_id));

            if ($res) {
                $data = array('user_id' => $this->user_id,
                    'password' => $myNewPassword,
                    'created_by' => $this->user_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                $result1 = $this->Common_model->insert_data('user_password', $data);

                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function mail_settings() {

        if ($this->input->post('company_id') == "") {

            $this->form_validation->set_rules('useremail', 'User Name', 'required|valid_email|is_unique[main_mail_settings.useremail]', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('smtp_server', 'SMTP Server', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('port', 'Port', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {

                $data = array('company_id' => $this->company_id,
                    'useremail' => $this->input->post('useremail'),
                    //'password' => $this->Common_model->encrypt($this->input->post('password')),
                    'password' => $this->input->post('password'),
                    'smtp_server' => $this->input->post('smtp_server'),
                    'secure_transport_layer' => $this->input->post('secure_transport_layer'),
                    'port' => $this->input->post('port'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->insert_data('main_mail_settings', $data);

                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
            }
        } else {

            $this->form_validation->set_rules('useremail', 'User Name', 'required|valid_email', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('smtp_server', 'SMTP Server', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('port', 'Port', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {

                $data = array(
                    'useremail' => $this->input->post('useremail'),
                    //'password' => $this->Common_model->encrypt($this->input->post('password')),
                    'password' => $this->input->post('password'),
                    'smtp_server' => $this->input->post('smtp_server'),
                    'secure_transport_layer' => $this->input->post('secure_transport_layer'),
                    'port' => $this->input->post('port'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->update_data('main_mail_settings', $data, array('company_id' => $this->input->post('company_id')));

                if ($res) {
                    echo $this->Common_model->show_massege(2, 1);
                } else {
                    echo $this->Common_model->show_massege(3, 2);
                }
            }
        }
    }

    public function ajax_edit_mail_settings() {
        $this->db->from('main_mail_settings');
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        $data = $query->row();
        echo json_encode($data);
    }

    public function forgot_password() {

        if ($this->session->userdata('hr_logged_in')) {
            redirect('Con_dashbord/', 'refresh');
        } else {
            //echo $this->Common_model->decrypt('Z5qlk5qY');
            //echo $this->Common_model->encrypt('123456');

            $param['topheader'] = 'uni_template/login_header.php';
            $param['title'] = 'HRM';
            $param['content'] = 'uni_template/forgot_password.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';
            $this->load->view('admin/home', $param);
        }
    }

    public function generate_forgot_password() {

        $this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $query = $this->db->get_where('main_users', array('email' => $this->input->post('useremail')))->row();

            if (!empty($query)) {
                $password = $this->Common_model->decrypt($query->password);

                // update password_reset_hash to the requested user starts
                $passwordResetHash = md5($query->id);
                $query->password_reset_hash = $passwordResetHash;
                $this->Common_model->update_data('main_users', $query, array('id' => $query->id));
                // update password_reset_hash to the requested user ends

                $res = $this->Sendmail_model->forgot_password_mail($query->name, $this->input->post('useremail'), $password, $passwordResetHash);

                if ($res) {
                    echo $this->Common_model->show_validation_massege('Please check your email.', 1);
                } else {
                    echo $this->Common_model->show_validation_massege('Email not send.', 2);
                }
            } else {
                echo $this->Common_model->show_validation_massege('This email is not user.', 2);
            }
        }
    }

    public function reset_password( $passwordResetHash = NULL ) {
        if ($this->session->userdata('hr_logged_in')) {
            redirect('Con_dashbord/', 'refresh');
        } else {
            $user = $this->db->get_where('main_users', array('password_reset_hash' => $passwordResetHash))->row();

            if (!empty($user)) {
                $param['passwordResetHash'] = $passwordResetHash;
            } else {
                $param['passwordResetHash'] = "000";
            }

            $param['topheader'] = 'uni_template/login_header.php';
            $param['title'] = 'HRM';
            $param['content'] = 'uni_template/reset_password.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';

            $this->load->view('admin/home', $param);
        }
    }

    public function update_new_password()
    {
        // echo "<pre>". print_r($this->input->post('password'), 1) ."</pre>";exit;
        $this->form_validation->set_rules('password', 'Password', 'callback_valid_password');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $user = $this->db->get_where('main_users', array('password_reset_hash' => $this->input->post('passwordRestHash')))->row();

            if (!empty($user)) {
                // $user->password = $this->Common_model->encrypt($this->input->post('password'));
                $user->password = md5($this->input->post('password'));
                $user->password_reset_hash = "";
                $result = $this->Common_model->update_data('main_users', $user, array('id' => $user->id));

                if ($result) {
                    $data = array('user_id' => $user->id,
                        'password' => $user->password,
                        'created_by' => $user->id,
                        'created_at' => date("Y-m-d H:i:s")
                    );
                
                    $result1 = $this->Common_model->insert_data('user_password', $data);

                    echo $this->Common_model->show_validation_massege('Your password has been reset.', 1);
                } else {
                    echo $this->Common_model->show_validation_massege('Unable to update the password. Please contact administrator.', 2);
                }
            } else {
                echo $this->Common_model->show_validation_massege('This email is not user.', 2);
            }
        }
    }

    /**
     * Validate the password
     *
     * @param string $password
     *
     * @return bool
     */
    public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        $errorMessage = 'The {field} field must contain, <br> (1) at least one lowercase letter, <br> (2) one uppercase letter, <br> (3) one number, <br> (4) one special character (' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'). ') and <br> (5) minimum 8 characters in length.';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            // $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            $this->form_validation->set_message('valid_password', $errorMessage);
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            // $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            $this->form_validation->set_message('valid_password', $errorMessage);
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            // $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            $this->form_validation->set_message('valid_password', $errorMessage);
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {        
            /* $rules = array(
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'callback_valid_password',
                )
            ); */
    
            // $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            $this->form_validation->set_message('valid_password', $errorMessage);
            return FALSE;
        }
        if (strlen($password) < 8)
        {
            // $this->form_validation->set_message('valid_password', 'The {field} field must be at least 8 characters in length.');
            $this->form_validation->set_message('valid_password', $errorMessage);
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }

        // last 3 password check validation starts
        if (!empty($password)) {
            $user_id = 0;
            $user = $this->db->get_where('main_users', array('password_reset_hash' => $this->input->post('passwordRestHash')))->row();
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

            //print_r($encryptedPassword);exit;
    
            if ($foundInLastThreePassword) {
                $this->form_validation->set_message('valid_password', 'Your new password must not match any of your previous three passwords.');
                return FALSE;  
            }
        }
        // last 3 password check validation ends

        return TRUE;
    }

    public function validate_change_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        $errorMessage = 'The {field} field must contain, at least one lowercase letter, one uppercase letter, one number, one special character (' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'). ') and minimum 8 characters in length.';
        if (empty($password))
        {
            $this->form_validation->set_message('validate_change_password', 'The {field} field is required.');
            return FALSE;
        }
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

        // last 3 password check validation starts
        if (!empty($password)) {
            $user_id = 0;
            $user = $this->db->get_where('main_users', array('id' => $this->user_id))->row();
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

            //print_r($encryptedPassword);exit;
    
            if ($foundInLastThreePassword) {
                $this->form_validation->set_message('validate_change_password', 'Your new password must not match any of your previous three passwords.');
                return FALSE;  
            }
        }
        // last 3 password check validation ends

        return TRUE;
    }

    // save new password starts
    public function save_new_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'callback_valid_password');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            // echo "<pre>". print_r($this->input->post(), 1) ."</pre>";exit;
            $user = $this->db->get_where('main_users', array('password_reset_hash' => $this->input->post('passwordRestHash')))->row();

            if (!empty($user)) {
                // $user->password = $this->Common_model->encrypt($this->input->post('password'));
                $user->password = md5($this->input->post('password'));
                $user->password_reset_hash = "";
                $result = $this->Common_model->update_data('main_users', $user, array('id' => $user->id));

                if ($result) {
                    $data = array('user_id' => $user->id,
                        'password' => $user->password,
                        'created_by' => $user->id,
                        'created_at' => date("Y-m-d H:i:s")
                    );

                    $result1 = $this->Common_model->insert_data('user_password', $data);

                    echo $this->Common_model->show_validation_massege('Your new password has been saved.', 1);
                } else {
                    echo $this->Common_model->show_validation_massege('Unable to save the password. Please contact administrator.', 2);
                }
            } else {
                echo $this->Common_model->show_validation_massege('This email is not user.', 2);
            }
        }
    }
    // save new password ends

    /* public function updateMD5Password() {
        $this->db->select();
        $this->db->from('main_users');
        $query = $this->db->get();

        $allUsers = $query->result();

        $foundInLastThreePassword = false;
        foreach ($allUsers as $user) {
            $actualPassword = $this->Common_model->decrypt($user->password);

            $data = array('password' => md5($actualPassword));

            $this->Common_model->update_data('main_users', $data, array('id' => $user->id));
        }
        print_r("Process completed");exit;
    } */

    public function clearCompanyData()
    {
        $this->db->truncate('mytable');

        print_r("Process completed");exit;
    }

    public function updateMenuSlug()
    {
        $this->db->select();
        $this->db->from('main_menu');
        $query = $this->db->get();

        $allMenus = $query->result();

        foreach ($allMenus as $menu) {
            $menuSlug = str_replace(" ", "_", trim($menu->menu_name));
            $data = array(
                        'menu_name' => trim($menu->menu_name),
                        'menu_icon' => $menu->id . "_" . strtolower($menuSlug)
                    );

            $this->Common_model->update_data('main_menu', $data, array('id' => $menu->id));
        }
        print_r("Process completed");exit;
    }

    function sendEmail()
    {
        // $result = $this->Sendmail_model->sendGridMail("Selvam", "selvam@kuruntham.com", "Test@123");
        $result = $this->Sendmail_model->employee_creation_mail("Selvam", "selvam@kuruntham.com", "Test@123");
        if ($result) {
            echo "Mail sent";
        } else {
            echo "Unable to send the mail";
        }
    }

}
