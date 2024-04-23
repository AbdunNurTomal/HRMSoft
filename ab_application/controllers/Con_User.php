<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_User extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    public $parent_user = null;
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
        
        $this->load->model('Sendmail_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "User";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 1) {
            // echo "<pre>".print_r($this->session->userdata('hr_logged_in'),1)."</pre>";exit;
            $companyId = $this->session->userdata('hr_logged_in') ? $this->session->userdata('hr_logged_in')["company_id"] : 0;

            $param['query'] = $this->db->get_where('main_users', array('isactive' => 1));
            if ($companyId) {
                $param['query'] = $this->db->get_where('main_users', array('isactive' => 1, "company_id"=>$companyId));
            }
        } else if ($this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_users', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_users', array('parent_user' => $this->user_id, 'isactive' => 1));
        }
        //echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_user.php';
        $this->load->view('admin/home', $param);
    }

    public function add_User()
    {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "User";
        $param['module_id'] = $this->module_id;

        $param['main_users_query'] = $this->db->get_where('main_users', array('id' => $this->user_id));

        if ($this->user_group == $this->KurunthamModel->ROLE_SUPER_ADMIN) {
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, "isactive"=>1));   //$this->user_id
        } else if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN && $this->companyView) {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP, $this->KurunthamModel->ROLE_COMPANY_ADMIN);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, "isactive"=>1));
        } else if ($this->user_group == $this->KurunthamModel->ROLE_PARTNER || $this->user_group == $this->KurunthamModel->ROLE_GROUP) {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP, $this->KurunthamModel->ROLE_COMPANY_ADMIN);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, "isactive"=>1));
        } else {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP, $this->KurunthamModel->ROLE_COMPANY_ADMIN);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, "isactive"=>1));
        }

        // echo $this->db->last_query();
        // echo "===".$this->user_group;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_adduser.php';
        $this->load->view('admin/home', $param);
    }

    public function save_user()
    {
        require_once( 'assets/slimimage/server/slim.php');
        $images = Slim::getImages('slim');

        // $this->form_validation->set_rules('name', 'User Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('name', 'User Name', 'required');
        // $this->form_validation->set_rules('email', 'User email', 'trim|required|valid_email',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'User email', 'trim|required|valid_email');
        //$this->form_validation->set_rules('email', 'User email', 'trim|required|valid_email|is_unique[main_users.email]', array('required' => "Please the enter required field, for more Info : %s.", 'is_unique' => 'This User already exists, For more Info : %s.'));
        // $this->form_validation->set_rules('user_group', 'User Group', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('user_group', 'User Group', 'required');
        
        $this->form_validation->set_rules('password', 'User Password', 'callback_is_password_strong');
        // $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]|alpha_numeric', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_users');
            if ($query->num_rows() > 0) {
                $data1=$this->input->post('email');
                echo $this->Common_model->show_validation_massege("An user already exists with the username.($data1)",2);
                exit();
            }

            $data = array('company_id' => $this->company_id,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'parent_user' => $this->input->post('parent_user'),
                'user_group' => $this->input->post('user_group'),
                // 'password' => $this->Common_model->encrypt($this->input->post('password')),
                'password' => md5($this->input->post('password')),
                'user_type' => '3',
                //'user_image' => $this->input->post('user_image'),
                'expiration_date' => $this->Common_model->convert_to_mysql_date($this->input->post('expiration_date')),
                'api_login_id' => $this->input->post('api_login_id'),
                'phone_no' => $this->input->post('phone_no'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
                'password_reset_hash' => md5($this->input->post('password'))
            );
            
            $res = $this->Common_model->insert_data('main_users', $data);
           
            if($res)
            {
                if ($images) {
                    foreach ($images as $image) {
                        $fileExt = explode(".", $image['input']['name']);
                        $imgfilename = $this->db->insert_id() . "." . $fileExt[1];
                        @unlink($_FILES[$imgfilename]);
                        $file = Slim::saveFile($image['output']['data'], $imgfilename, 'uploads/user_image', false);
                    }

                    $ldata = array('user_image' => $imgfilename);
                    $logores = $this->Common_model->update_data('main_users', $ldata, array('id' => $this->db->insert_id()));
                }
            }

            if ($this->input->post('email')!="") {
                $this->Sendmail_model->user_creation_mail($this->input->post('name'), $this->input->post('email'), $this->input->post('password'));
            }

            /* if (!empty($query)) {
                $password = $this->Common_model->decrypt($query->password);

                // update password_reset_hash to the requested user starts
                $passwordResetHash = md5($query->id);
                $query->password_reset_hash = $passwordResetHash;
                $this->Common_model->update_data('main_users', $query, array('id' => $query->id));
            } */
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
        $param['page_header'] = "User";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_users', array('id' => $id));
        $param['main_users_query'] = $this->db->get_where('main_users', array('id' => $this->user_id));

        if ($this->user_group == $this->KurunthamModel->ROLE_SUPER_ADMIN) {
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));

        } else if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN && $this->companyView) {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));

        } else if ($this->user_group == $this->KurunthamModel->ROLE_PARTNER || $this->user_group == $this->KurunthamModel->ROLE_GROUP) {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP, $this->KurunthamModel->ROLE_COMPANY_ADMIN);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));

        } else {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));
        }

        // check permission to view the employee starts
        if ($this->user_group <= $this->KurunthamModel->ROLE_GROUP) {
        } else if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("usergroup", $this->uri->segment(3), $this->company_id);
        }

        // check permission to view the employee ends
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_adduser.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_User()
    {
        require_once( 'assets/slimimage/server/slim.php');
        $images = Slim::getImages('slim');
        
        $this->form_validation->set_rules('name', 'User Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'User email', 'trim|required|valid_email', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('user_group', 'User Group', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        $this->form_validation->set_rules('password', 'User Password', 'callback_validate_change_password');
        //$this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]|alpha_numeric', array('required' => "Please the enter required field, for more Info : %s."));
        if (!empty($this->input->post('password'))) {
              $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', array('required' => "Please the enter required field, for more Info : %s."));
        } else{
             $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
        }
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $this->db->where('id !=',$this->input->post('id'));
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('user_group', $this->input->post('user_group'));
            $this->db->where('isactive', 1);
            $query = $this->db->get('main_users');
            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This User already exists, For more Info : User email. ', 2);
                exit();
            } 
            
            $edit_user_id = $this->input->post('id');
            $existing_image_name = $this->Common_model->get_selected_value($this, 'id', $edit_user_id, 'main_users', 'user_image');
           if (!empty($this->input->post('password'))) {
                $data = array('name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    //'parent_user' => $this->input->post('parent_user'),
                    'user_group' => $this->input->post('user_group'),
                    // 'password' => $this->Common_model->encrypt($this->input->post('password')),
                    'password' => md5($this->input->post('password')),
                    //'user_type' => '3',
                    //'user_image' => $this->input->post('user_image'),
                    'expiration_date' => $this->Common_model->convert_to_mysql_date($this->input->post('expiration_date')),
                    'api_login_id' => $this->input->post('api_login_id'),
                    'phone_no' => $this->input->post('phone_no'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
           } else {
                $data = array('name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    //'parent_user' => $this->input->post('parent_user'),
                    'user_group' => $this->input->post('user_group'),
                    // 'password' => $this->Common_model->encrypt($this->input->post('password')),
                    //'password' => md5($this->input->post('password')),
                    //'user_type' => '3',
                    //'user_image' => $this->input->post('user_image'),
                    'expiration_date' => $this->Common_model->convert_to_mysql_date($this->input->post('expiration_date')),
                    'api_login_id' => $this->input->post('api_login_id'),
                    'phone_no' => $this->input->post('phone_no'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
           }

            $res = $this->Common_model->update_data('main_users', $data, array('id' => $edit_user_id));

            if ($res) {
                $data = array(
                    'user_id' => $edit_user_id,
                    'password' => md5($this->input->post('password')),
                    'created_by' => $edit_user_id,
                    'created_at' => date("Y-m-d H:i:s")
                );

                $result1 = $this->Common_model->insert_data('user_password', $data);

                if ($images) {
                    foreach ($images as $image) {
                        $fileExt = explode(".", $image['input']['name']);
                        $imgfilename = $edit_user_id . "." . $fileExt[1];
                        @unlink($_FILES[$imgfilename]);
                        $file = Slim::saveFile($image['output']['data'], $imgfilename, 'uploads/user_image', false);
                    }
                    
                    $ldata = array('user_image' => $imgfilename);
                    $logores = $this->Common_model->update_data('main_users', $ldata, array('id' => $edit_user_id));
                    if($logores)
                    {
                        //$session_data = array('uid' => 'test user', 'logged_in' => TRUE);
                        //$this->session->set_userdata($session_data);
                        
                        //$session_array = array('user_image' => $imgfilename);
                        //$this->session->set_userdata('hr_logged_in', $session_array);
                    }
                }
            }

            if($this->input->post('email')!="")
            {
                // $this->Sendmail_model->user_update_mail($this->input->post('name'),$this->input->post('email'), $this->input->post('password'));
            }

//            if ($existing_image_name != $this->input->post('user_image')) {
//                $File_Dir_path = Get_File_Directory('uploads/user_image/' . $existing_image_name);
//                if (file_exists($File_Dir_path)) {
//                    unlink($File_Dir_path);
//                }
//            }

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_users", $id);
        redirect('con_User/');
        exit;
    }
    
    public function view_user_data() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "3";
        $param['page_header'] = "User";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_users', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_adduser.php';
        $this->load->view('admin/home', $param);
    }

   /* public function upload_user_image() {
       $status = "";
       $msg = "";
       $file_element_name = 'user_image_file';

       if ($status != "error") {
           $config['upload_path'] = './uploads/user_image/';
           $config['allowed_types'] = 'gif|jpg|png';
           $config['max_size'] = 1024 * 8;
           $config['encrypt_name'] = FALSE;

           $newFileName = $_FILES[$file_element_name]['name'];
           $fileExt = explode(".", $newFileName);
           $filename = time() . "." . $fileExt[1];
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
   } */
   
    function welcome_email() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        
        $query = $this->db->get_where('main_users', array('id' => $id));
        foreach ($query->result() as $row):
            $name=$row->name;
            $email=$row->email;
        endforeach;
        
        $res2 = $this->Sendmail_model->user_welcome_mail($name, $email);
      
        if ($res2) {
            echo $this->Common_model->show_massege(17, 1);
        } else {
            echo $this->Common_model->show_massege(18, 2);
        }
            
    }

    public function is_password_strong($password) {
        
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        $errorMessage = 'The {field} field must contain, at least one lowercase letter, one uppercase letter, one number, one special character (' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'). ') and minimum 8 characters in length.';
        if (empty($password)) {
            $this->form_validation->set_message('is_password_strong', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match($regex_lowercase, $password) < 1) {
            // $this->form_validation->set_message('is_password_strong', 'The {field} field must be at least one lowercase letter.');
            $this->form_validation->set_message('is_password_strong', $errorMessage);
            return FALSE;
        }
        if (preg_match($regex_uppercase, $password) < 1) {
            // $this->form_validation->set_message('is_password_strong', 'The {field} field must be at least one uppercase letter.');
            $this->form_validation->set_message('is_password_strong', $errorMessage);
            return FALSE;
        }
        if (preg_match($regex_number, $password) < 1) {
            // $this->form_validation->set_message('is_password_strong', 'The {field} field must have at least one number.');
            $this->form_validation->set_message('is_password_strong', $errorMessage);
            return FALSE;
        }
        if (preg_match($regex_special, $password) < 1) {
            // $this->form_validation->set_message('is_password_strong', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            $this->form_validation->set_message('is_password_strong', $errorMessage);
            return FALSE;
        }
        if (strlen($password) < 8) {
            // $this->form_validation->set_message('is_password_strong', 'The {field} field must be at least 5 characters in length.');
            $this->form_validation->set_message('is_password_strong', $errorMessage);
            return FALSE;
        }
        if (strlen($password) > 32) {
            $this->form_validation->set_message('is_password_strong', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }

        // last 3 password check validation starts
        if (!empty($password)) {
            $user_id = 0;
            $user = $this->db->get_where('main_users', array('id' => $this->input->post('id')))->row();
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
                $this->form_validation->set_message('is_password_strong', 'Your new password must not match any of your previous three passwords.');
                return FALSE;  
            }
        }
        // last 3 password check validation ends

        return TRUE;
    }

   public function create_password( $passwordResetHash = NULL ) {
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
            $param['content'] = 'uni_template/create_password.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';

            $this->load->view('admin/home', $param);
        }
    }
    
    public function settings()
    {
        // echo "<pre>". print_r($this->session->userdata('hr_logged_in'), 1) ."</pre>";exit;
        if (empty($this->session->userdata('hr_logged_in'))) {
            redirect('Chome/');
        }
        // $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "3";
        $param['page_header'] = "User";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_users', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'uni_template/view_two_factor_authentication.php';
        $this->load->view('admin/home', $param);
    }

    public function save_user_settings()
    {
        $userId = $this->user_id;
        
        $enableTwoFactorAuthentication = $this->input->post('enableTwoFactorAuthentication') == "on" ? 1 : 0;
        $otpSendingMethod = $this->input->post('otpSendingMethod');

        // echo "<pre>". print_r($enableTwoFactorAuthentication, 1) ."</pre>";exit;
        $userSettings = $this->db->get_where('two_factor_authentication', array('user_id' => $userId));
        // echo "<pre>". print_r($userSettings, 1) ."</pre>";exit;
        if ($userSettings->num_rows()) {
            // echo "<pre>". print_r($userSettings->result()[0]->id, 1) ."</pre>";exit;
            $data['enable_two_factor_authentication'] = $enableTwoFactorAuthentication;
            $data['otp_send_method'] = $otpSendingMethod;
            $result = $this->Common_model->update_data('two_factor_authentication', $data, array('id' => $userSettings->result()[0]->id));
        } else {
            $data = array();
            $data['user_id'] = $userId;
            $data['enable_two_factor_authentication'] = $enableTwoFactorAuthentication;
            $data['otp_send_method'] = $otpSendingMethod;
            $data['created_by'] = $userId;
            $data['created_at'] = date('Y-m-d H:i:s');
            $result = $this->Common_model->insert_data('two_factor_authentication', $data);
        }

        echo $this->Common_model->show_validation_massege('Your settings has been saved.', 1);
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
            $user = $this->db->get_where('main_users', array('id' => $this->input->post('id')))->row();
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
}
