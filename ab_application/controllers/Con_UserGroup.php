<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_UserGroup extends CI_Controller {

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
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header']="User Group";
        $param['module_id']=$this->module_id;
       
        if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN && $this->companyView) {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP);
            $this->db->where_not_in('id', $ignore);
            $param['query']= $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>$this->company_id));

        } else if($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN) {
            /* $user_groupp = '4,8,9,10,11';
            $user_groups = explode(",", $user_groupp);
            $user_groupss = array_map('intval', $user_groups);
            $this->db->where_in('id', $user_groupss); */
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP, $this->KurunthamModel->ROLE_COMPANY_ADMIN);
            $this->db->where_not_in('id', $ignore);
            $param['query']= $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>$this->company_id));
            //echo $this->db->last_query();
        } else {
            //'user_id' => $this->user_id,
            $param['query']= $this->db->get_where('main_usergroup', array('isactive' => 1 , 'company_id' =>$this->company_id));
        }
        // echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_usergroup.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_UserGroup()
    {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $ignoreArr = $this->KurunthamModel->getIgnoreUserGroup();

        if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN && $this->companyView) {
            /*  $ignore = array(1, 2, 3);  */
            $this->db->where_not_in('id', $ignoreArr);
            $param['query']= $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>0));

        } else if($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN) {
            /* $user_groupp = '4,8,9,10,11';
            $user_groups = explode(",", $user_groupp);
            $user_groupss = array_map('intval', $user_groups);
            $this->db->where_in('id', $user_groupss); */
           /*  $ignore = array(1, 2, 3, 12); */
            $this->db->where_not_in('id', $ignoreArr);
            $param['query']= $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>0));
            //echo $this->db->last_query();
        } else {
            //'user_id' => $this->user_id,
            $param['query']= $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>0));
        }
        
        $param['type'] = "1";
	    $param['page_header'] = "User Group";
        $param['module_id'] = $this->module_id;

	    $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addusergroup.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function save_userGroup()
    {
        if ($this->KurunthamModel->isSuperAdmin()) {
            $this->form_validation->set_rules('group_name', 'Group Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        } else if ($this->KurunthamModel->isCompanyAdmin()) {
            $this->form_validation->set_rules('group_parent_id', 'Group Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            $userGroupToSave = $this->input->post('group_name');
            $userGroup = $this->Common_model->get_selected_value($this, "id", $this->input->post('group_parent_id'), "main_usergroup", "group_name");
            if ($this->KurunthamModel->isCompanyAdmin()) {
                $userGroupToSave = $userGroup;
            }
            $data = array('company_id' => $this->company_id,
                'user_id' => $this->user_id,
                'group_name' => $userGroupToSave,
                'description' => $this->input->post('description'),
                'parent_id' => $this->input->post('group_parent_id'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_usergroup', $data);

           if ($res) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
    }
    
    function edit_entry()
    {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        $param['group_name'] = str_replace("%20", " ", $this->uri->segment(4));
        
        $param['type']="2";
        $param['page_header']="User Group";	
        $param['module_id']=$this->module_id;
        
        $param['query'] = $this->db->get_where('main_usergroup', array('id' => $id));
        $ignoreArr = $this->KurunthamModel->getIgnoreUserGroup();

        if ($this->KurunthamModel->isSuperAdmin()) {
           /*  $ignore = array(1, 2, 3, 5); */
            $this->db->where_not_in('id', $ignoreArr);
            $param['user_group_query'] = $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>0));
        } else if ($this->KurunthamModel->isCompanyAdmin()) {
           /*  $ignore = array(1, 2, 3, 5, 8, 12); */
            $this->db->where_not_in('id', $ignoreArr);
            $param['user_group_query'] = $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>0));
        } else {
            $param['user_group_query'] = $this->db->get_where('main_usergroup', array('isactive' => 1 ,'company_id' =>0));
        }
        
	    $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addusergroup.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function edit_UserGroup()
    {
        if ($this->KurunthamModel->isSuperAdmin()) {
            $this->form_validation->set_rules('group_name', 'Group Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        } else if ($this->KurunthamModel->isCompanyAdmin()) {
            $this->form_validation->set_rules('group_parent_id', 'Group Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            $userGroupToSave = $this->input->post('group_name');
            $userGroup = $this->Common_model->get_selected_value($this, "id", $this->input->post('group_parent_id'), "main_usergroup", "group_name");
            if ($this->KurunthamModel->isCompanyAdmin()) {
                $userGroupToSave = $userGroup;
            }
            $data = array('company_id' => $this->company_id,
                'user_id' => $this->user_id,
                'group_name' => $userGroupToSave,
                'description' => $this->input->post('description'),
                'parent_id' => $this->input->post('group_parent_id'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->update_data('main_usergroup', $data, array('id' => $this->input->post('id')));
            
            if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
    }

     public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_usergroup", $id);
        redirect('con_UserGroup/');
        exit;
    }

}
