<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ChangeCompany extends CI_Controller {
    
    public $umenu_id;
    public $mod_id;
    public $opration_id;

    public $user_data = array();
    public $user_id = null;
    public $username = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $parent_user = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    
    public $module_data = array();
    public $module_id = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->username =$this->user_data['username'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group =$this->user_data['user_group'];
        $this->parent_user =$this->user_data['parent_user'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header']="Switch Company";
        $param['module_id']=$this->module_id;
        
        $parent='0';
        if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {
            $parent = $this->Common_model->get_name($this,$this->user_id, 'main_users','parent_user');
            $this->db->where("(parent_user=$this->user_id OR parent_user='$parent')");
            $uquery = $this->db->get_where('main_users', array('user_group' => 12, 'company_id !=' => 0 ,'company_id' => $this->company_id));
        } else {
            $uquery = $this->db->get_where('main_users', array('parent_user' => $this->parent_user, 'user_group' => $this->user_group, 'company_id !=' => 0));
        }
    
        $ids = array();
        foreach ($uquery->result_array() as $id) {
            $ids[] = $id['company_id'];
        }

        if (!empty($ids)) {
            $this->db->where_in('id', $ids);
            $param['query']=$this->db->get_where('main_company', array('isactive' => '1'));
        } else {
            $param['query'] = $this->db->get_where('main_company', array('user_id' => $this->user_id));
            if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {
                $param['query']=$this->db->get_where('main_company', array('isactive' => '1'));
            }
        }
        //echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_ChangeCompany.php';
        $this->load->view('admin/home', $param);
    }
    
    public function change_Company()
    {
        $this->form_validation->set_rules('change_to', 'Change TO', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            // $password = $this->input->post("password");
            $company_id = $this->input->post("change_to");

            $switchToUserGroup = 12;
            $switchToUserType = 3;
    
            /* $this->db->select();
            $this->db->from('main_users');
            $this->db->where('company_id', $company_id);
            $this->db->where('isactive', 1);
            $this->db->limit(1);
            $query = $this->db->get(); */
            
            //echo $this->db->last_query();exit();
            // echo "<pre>".print_r($this->session->userdata('hr_logged_in'),1)."</pre>";exit;
        
            // if ($query->num_rows() == 1) {
                // $result = $query->result();

                $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('user_group_id' => $switchToUserGroup, 'company_id' => 0));
                if ($result_menu) {
                    foreach ($result_menu->result() as $key) {
                        $this->umenu_id=$key->menu_id;
                        $this->opration_id=$key->opration_id;
                        $this->mod_id=$key->module_id;
                    }
                }

                $session_array = array();
                /*$session_array = array(
                    'id' => $result[0]->id,
                    'company_id' => $result[0]->company_id,
                    'username' => $result[0]->email,
                    'name' => $result[0]->name,
                    'usertype' => $result[0]->user_type,
                    'user_group' => $result[0]->user_group,
                    'user_image' => $result[0]->user_image,
                    'parent_user' => $result[0]->parent_user,
                    'user_menu' => $this->umenu_id,
                    'user_module' => $this->mod_id,
                    'user_opration' => $this->opration_id,
                    'admin_login' => 1,
                    'admin_user_id' => $this->user_id,
                    "company_view" => 1 
                ); */

                // get parent user group starts
                $this->db->from('main_usergroup');
                $this->db->where('id', $switchToUserGroup);
                $query = $this->db->get();
                $userGroupRecord = $query->result();
                $userGroupParentId = 0;
                if ($userGroupRecord) {
                    $userGroupParentId = $userGroupRecord[0]->parent_id;
                }
                // get parent user group ends

                $session_array = array(
                    'id' => $this->session->userdata('hr_logged_in')["id"],
                    'company_id' => $company_id,
                    'username' => $this->session->userdata('hr_logged_in')["username"],
                    'name' => $this->session->userdata('hr_logged_in')["name"],
                    // 'usertype' => $this->session->userdata('hr_logged_in')["usertype"],
                    // 'user_group' => $this->session->userdata('hr_logged_in')["user_group"],
                    'usertype' => $switchToUserType,
                    // 'user_group' => $switchToUserGroup,
                    'user_group' => $userGroupParentId,
                    'user_image' => $this->session->userdata('hr_logged_in')["user_image"],
                    'parent_user' => $this->session->userdata('hr_logged_in')["parent_user"],
                    // 'user_menu' => $this->session->userdata('hr_logged_in')["user_menu"],
                    // 'user_module' => $this->session->userdata('hr_logged_in')["user_module"],
                    // 'user_opration' => $this->session->userdata('hr_logged_in')["user_opration"],
                    'user_menu' => $this->umenu_id,
                    'user_module' => $this->mod_id,
                    'user_opration' => $this->opration_id,
                    'admin_login' => 1,
                    'admin_user_id' => $this->user_id,
                    "company_view" => 1
                );
                //print_r($session_array); exit;
                
                $this->session->set_userdata('hr_logged_in', $session_array);

                $res = TRUE;
            /* } else {
                $session_array = array();
                $session_array = array(
                    'log_status' => '1',
                );
                $this->session->set_userdata('hr_logged_st', $session_array);
                
                $res = FALSE;
            } */

            if ($res) {
                //redirect();
                echo $this->Common_model->show_validation_massege('Change Successful.', 1);
            } else {
                echo $this->Common_model->show_validation_massege('Change Not Successful', 2);
            }
        }
    }

    public function change_Companybyadmin()
    {
        /* $this->form_validation->set_rules('change_to', 'Change TO', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean',array('required'=> "Please the enter required field, for more Info : %s."));
       
        if ($this->form_validation->run() == FALSE) {
           echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

        $password = $this->input->post("password");
        $company_id = $this->input->post("change_to"); */
        /* command new code starts */
        $company_id = $this->uri->segment(3);

        // our new code starts
        /* $this->db->select();
        $this->db->from('main_users');
        $this->db->where('company_id', $company_id);
        $this->db->where('isactive', 1);
        $this->db->where('user_group', 12);
        $this->db->limit(1);
        $query = $this->db->get(); */

        $switchToUserGroup = 12;
        $switchToUserType = 3;

        // if ($query->num_rows() == 1) {
            // $result = $query->result();

            $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('user_group_id' => $switchToUserGroup, 'company_id' => 0));
            if($result_menu) {
                foreach ($result_menu->result() as $key) {
                    $this->umenu_id=$key->menu_id;
                    $this->opration_id=$key->opration_id;
                    $this->mod_id=$key->module_id;
                }
            }

            // get parent user group starts
            $this->db->from('main_usergroup');
            $this->db->where('id', $switchToUserGroup);
            $query = $this->db->get();
            $userGroupRecord = $query->result();
            $userGroupParentId = 0;
            if ($userGroupRecord) {
                $userGroupParentId = $userGroupRecord[0]->parent_id;
            }
            // get parent user group ends

            $session_array = array();
            $session_array = array(
                'id' => $this->session->userdata('hr_logged_in')["id"],
                'company_id' => $company_id,
                'username' => $this->session->userdata('hr_logged_in')["username"],
                'name' => $this->session->userdata('hr_logged_in')["name"],
                'usertype' => $switchToUserType,
                // 'user_group' => $switchToUserGroup,
                'user_group' => $userGroupParentId,
                'user_image' => $this->session->userdata('hr_logged_in')["user_image"],
                'parent_user' => $this->session->userdata('hr_logged_in')["parent_user"],
                'user_menu' => $this->umenu_id,
                'user_module' => $this->mod_id,
                'user_opration' => $this->opration_id,
                'admin_login' => 1,
                'admin_user_id' => $this->user_id,
                "company_view" => 1
            );

            $this->session->set_userdata('hr_logged_in', $session_array);
            //echo "<pre>".print_r($this->session->userdata('hr_logged_in'),1)."</pre>";exit;

            $res = TRUE;
            // redirect('Chome', 'refresh');
            redirect('Con_EmployeesPerDepartment', 'refresh');
        // }
        // our new code ends

        /* $this->db->select();
        $this->db->from('main_users');
        $this->db->where('company_id', $company_id);
        $this->db->where('isactive', 1);
        //$this->db->where('password', $this->Common_model->encrypt($password));
        $this->db->limit(1);
        $query = $this->db->get(); */

        // echo $this->db->last_query();exit();

        /* if ($query->num_rows() == 1) {
            $result=$query->result();

            $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('user_group_id' => $result[0]->user_group));
            if($result_menu) {
                foreach ($result_menu->result() as $key) {
                    $this->umenu_id=$key->menu_id;
                    $this->opration_id=$key->opration_id;
                    $this->mod_id=$key->module_id;
                }
            }

            $session_array = array();
            $session_array = array(
                'id' => $result[0]->id,
                'company_id' => $result[0]->company_id,
                'username' => $result[0]->email,
                'name' => $result[0]->name,
                'usertype' => $result[0]->user_type,
                'user_group' => $result[0]->user_group,
                'user_image' => $result[0]->user_image,
                'parent_user' => $result[0]->parent_user,
                'user_menu' => $this->umenu_id,
                'user_module' => $this->mod_id,
                'user_opration' => $this->opration_id,
                'admin_login' => '1',
                'admin_user_id' => $this->user_id,
                "company_view" => 0
            );

            $this->session->set_userdata('hr_logged_in', $session_array);

            $res=TRUE;
            redirect('Chome', 'refresh');
        } else {
            $session_array = array();
            $session_array = array(
                'log_status' => '1',
            );
            $this->session->set_userdata('hr_logged_st', $session_array);
            
            $res = FALSE;
        } */

        /* if ($res) {
               echo $this->Common_model->show_validation_massege('Change Successful.', 1);
           } else {
               echo $this->Common_model->show_validation_massege('Change Not Successful', 2);
           }
        } */
    }
    
    public function change_AdminbyCompany(){
        
//        $this->form_validation->set_rules('change_to', 'Change TO', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
//        //$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean',array('required'=> "Please the enter required field, for more Info : %s."));
//        
//        if ($this->form_validation->run() == FALSE) {
//            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
//        } else {
            
            //$password = $this->input->post("password");
//            $company_id = $this->input->post("change_to");
            $admin_user_id = $this->uri->segment(3);
            
            //$parent=$this->Common_model->get_name($this,$user_id,'main_users','parent_user');

            $this->db->select(); 	
            $this->db->from('main_users');
            $this->db->where('id', $admin_user_id);
            //$this->db->where('password', $this->Common_model->encrypt($password));
            $this->db->limit(1);
            $query = $this->db->get();
            
            //echo $this->db->last_query();exit();
        
            if ($query->num_rows() == 1) {

                $result=$query->result();

                $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('user_group_id' => $result[0]->user_group));
                if($result_menu)
                {
                    foreach ($result_menu->result() as $key) {
                        $this->umenu_id=$key->menu_id;
                        $this->opration_id=$key->opration_id;
                        $this->mod_id=$key->module_id;
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

                $session_array = array();
                $session_array = array(
                    'id' => $result[0]->id,
                    'company_id' => $result[0]->company_id,
                    'username' => $result[0]->email,
                    'name' => $result[0]->name,
                    'usertype' => $result[0]->user_type,
                    // 'user_group' => $result[0]->user_group,
                    'user_group' => $userGroupParentId,
                    'user_image' => $result[0]->user_image,
                    'parent_user' => $result[0]->parent_user,
                    'user_menu' => $this->umenu_id,
                    'user_module' => $this->mod_id,
                    'user_opration' => $this->opration_id,
                    'admin_login' => '0',
                    'admin_user_id' => '0',
                    "company_view" => 0
                );

                $this->session->set_userdata('hr_logged_in', $session_array);

                $res=TRUE;
                redirect('Chome', 'refresh');
            }
            else {
                
                $session_array = array();
                $session_array = array(
                    'log_status' => '1',
                );
                $this->session->set_userdata('hr_logged_st', $session_array);
                
                $res=FALSE;
            }
        
            
//            if ($res) {
//                echo $this->Common_model->show_validation_massege('Change Successful.', 1);
//            } else {
//                echo $this->Common_model->show_validation_massege('Change Not Successful', 2);
//            }
        //}
        
    }
    
    
//     public function change_company() {
//        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
//        
//        echo "Under Construction"; exit();
//        
//        $param['type'] = "1";
//        $param['page_header']="Company";
//        $param['module_id']=$this->module_id;
//        
//        $param['state_query']=$this->Common_model->listItem('main_state');
//        $param['billing_cycle_array']=$this->Common_model->get_array('billing_cycle');
//        $param['status_array']= $this->Common_model->get_array('status');
//        $param['main_usergroup_query']=$this->db->get_where('main_usergroup', array('user_id' => $this->user_id));
//        
//        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
//        $param['content'] = 'hr/view_addCompany.php';
//        $this->load->view('admin/home', $param);
//    }
    

//    public function add_Company() {
//        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
//        
//        $param['type'] = "1";
//        $param['page_header']="Company";
//        $param['module_id']=$this->module_id;
//        
//        $param['state_query']=$this->Common_model->listItem('main_state');
//        $param['billing_cycle_array']=$this->Common_model->get_array('billing_cycle');
//        $param['status_array']= $this->Common_model->get_array('status');
//        $param['main_usergroup_query']=$this->db->get_where('main_usergroup', array('user_id' => $this->user_id));
//        
//        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
//        $param['content'] = 'hr/view_addCompany.php';
//        $this->load->view('admin/home', $param);
//    }

//    public function save_Company() 
//    {
//        $this->form_validation->set_rules('company_full_name', 'Company Full Name', 'required');
//        $this->form_validation->set_rules('address_1', 'Address 1', 'required');
//        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
//        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required');
//        $this->form_validation->set_rules('billing_cycle', 'Billing Cycle', 'required');
//        $this->form_validation->set_rules('user_group', 'User Group', 'required');
//        
//        if ($this->form_validation->run() == FALSE) {
//            echo $this->Common_model->show_massege(validation_errors(),2);
//        } 
//        else 
//        {
//            $data = array('company_full_name' => $this->input->post('company_full_name'),
//                'company_short_name' => $this->input->post('company_short_name'),
//                'address_1' => $this->input->post('address_1'),
//                'address_2' => $this->input->post('address_2'),
//                'state' => $this->input->post('state'),
//                'phone_1' => $this->input->post('phone_1'),
//                'phone_2' => $this->input->post('phone_2'),
//                'fax_no' => $this->input->post('fax_no'),
//                'email' => $this->input->post('email'),
//                'mobile_phone' => $this->input->post('mobile_phone'),
//                'billing_cycle' => $this->input->post('billing_cycle'),
//                'user_group' => $this->input->post('user_group'),
//                'createdby' => $this->user_id,
//                'createddate' => $this->date_time,
//                'isactive' => $this->input->post('status'),
//            );
//            
//            $udata = array('company_id' => $this->Common_model->return_next_id('id','main_company'),
//                'name' => $this->input->post('company_full_name'),
//                'email' => $this->input->post('email'),
//                'parent_user' => $this->user_id,
//                'user_group' => $this->input->post('user_group'),
//                'password' => $this->Common_model->encrypt($this->input->post('mobile_phone')),
//                'user_type' => '2',
//                'createdby' => $this->user_id,
//                'createddate' => $this->date_time,
//                'isactive' => '1',
//            );
//            
//            
//            $res=$this->Common_model->insert_data('main_company',$data);
//            
//            $ures = $this->Common_model->insert_data('main_users', $udata);
//            
//            if ($res && $ures) {
//                echo $this->Common_model->show_massege('Data Insert Successful.',1);
//            } else {
//                echo $this->Common_model->show_massege('Data Insert Not Successful.',2);
//            }
//        }
//         
//    }
    
//    function edit_entry() {
//        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
//        $id = $this->uri->segment(3);
//        $param['first_name'] = str_replace("%20", " ", $this->uri->segment(4));
//        
//        $param['type']="2";
//        $param['page_header']="Company";	
//        $param['module_id']=4;
//        
//        $param['query'] = $this->db->get_where('main_company', array('id' => $id));
//        $param['state_query']=$this->Common_model->listItem('main_state');
//        $param['billing_cycle_array']=$this->Common_model->get_array('billing_cycle');
//        $param['status_array']= $this->Common_model->get_array('status');
//        $param['main_usergroup_query']=$this->db->get_where('main_usergroup', array('user_id' => $this->user_id));
//        
//	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
//        $param['content'] = 'hr/view_addCompany.php';
//        $this->load->view('admin/home', $param); 
//    }
    
//    public function edit_Company() 
//    {
//        $this->form_validation->set_rules('company_full_name', 'Company Full Name', 'required');
//        $this->form_validation->set_rules('address_1', 'Address 1', 'required');
//        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
//        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required');
//        $this->form_validation->set_rules('billing_cycle', 'Billing Cycle', 'required');
//        $this->form_validation->set_rules('user_group', 'User Group', 'required');
//        
//        if ($this->form_validation->run() == FALSE) {
//            echo $this->Common_model->show_massege(validation_errors(),2);
//        } 
//        else 
//        {
//            $data = array('company_full_name' => $this->input->post('company_full_name'),
//                'company_short_name' => $this->input->post('company_short_name'),
//                'address_1' => $this->input->post('address_1'),
//                'address_2' => $this->input->post('address_2'),
//                'state' => $this->input->post('state'),
//                'phone_1' => $this->input->post('phone_1'),
//                'phone_2' => $this->input->post('phone_2'),
//                'fax_no' => $this->input->post('fax_no'),
//                'email' => $this->input->post('email'),
//                'mobile_phone' => $this->input->post('mobile_phone'),
//                'billing_cycle' => $this->input->post('billing_cycle'),
//                'user_group' => $this->input->post('user_group'),
//                'modifiedby' => $this->user_id,
//                'modifieddate' => $this->date_time,
//                'isactive' => $this->input->post('status'),
//            );
//            
//            $udata = array('name' => $this->input->post('company_full_name'),
//                'email' => $this->input->post('email'),
//                'parent_user' => $this->user_id,
//                'user_group' => $this->input->post('user_group'),
//                'password' => $this->Common_model->encrypt($this->input->post('mobile_phone')),
//                'user_type' => '2',
//                'createdby' => $this->user_id,
//                'createddate' => $this->date_time,
//                'isactive' => '1',
//            );
//            
//            $res=$this->Common_model->update_data('main_company',$data,array('id' => $this->input->post('id')));
//            
//            $ures=$this->Common_model->update_data('main_users',$udata,array('company_id' => $this->input->post('id')));
//            
//             if ($res && $ures) {
//                echo $this->Common_model->show_massege('This Post Edited Successfully',1);
//            } else {
//                echo $this->Common_model->show_massege('No Change found to update entry!',2);
//            }
//        }
//         
//    }
    
//    public function delete_entry() {
//        $id = $this->uri->segment(3);
//        $this->Common_model->delete_by_id("main_company", $id);
//        redirect('Con_Company/');
//        exit;
//    }

}
