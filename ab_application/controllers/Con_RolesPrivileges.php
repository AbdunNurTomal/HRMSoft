<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_RolesPrivileges extends CI_Controller {

    private $opration = "";
    private $menuid = null;
    private $modid = null;
    private $user_privilege_id;
    private $user_group_id;
    private $user_menu_id;
    private $user_mod_id;
    private $user_opration_id;
    private $module_menu_id;
    private $change_menu_id;
    private $sub_menu_id;
    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
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
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
    }

    public function index()
    {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Roles and Access";
        $param['query'] = '';
        $param['module_id'] = $this->module_id;

        if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN && $this->companyView) {
            /* $user_groupp = '4,8,9,10,11';
            $user_groups = explode(",", $user_groupp);
            $user_groupss = array_map('intval', $user_groups);
            $this->db->where_in('id', $user_groupss); */
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));

        } else if ($this->user_group == $this->KurunthamModel->ROLE_COMPANY_ADMIN) {
            $ignore = array($this->KurunthamModel->ROLE_SUPER_ADMIN, $this->KurunthamModel->ROLE_PARTNER, $this->KurunthamModel->ROLE_GROUP, $this->KurunthamModel->ROLE_COMPANY_ADMIN);
            $this->db->where_not_in('id', $ignore);
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));

        } else {
            $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('company_id' => $this->company_id, 'isactive' => 1));
        }

        // $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array('user_id' => $this->user_id));
        $param['module_query'] = $this->Common_model->listItem('main_module');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_RolesPrivileges.php';
        $this->load->view('admin/home', $param);
    }

    public function save_RolesPrivileges()
    {
        $this->form_validation->set_rules('user_group', 'User Group', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            if ($this->input->post("opration")) {
                $k = 0;
                foreach ($this->input->post("opration") as $val) {
                    if ($k == 0) {
                        $this->opration = $val;
                    } else {
                        $this->opration = $this->opration . "," . $val;
                    }
                    $k++;
                }
            }

            if ($this->input->post("module_id")) {
                $m = 0;
                foreach ($this->input->post("module_id") as $mod) {
                    if ($m == 0) {
                        $this->modid = $mod;
                    } else {
                        $this->modid = $this->modid . "," . $mod;
                    }
                    $m++;
                }
            }

            if ($this->input->post("menuid")) {
                $k = 0;
                foreach ($this->input->post("menuid") as $key) {
                    if ($k == 0) {
                        $this->menuid = $key;
                    } else {
                        $this->menuid = $this->menuid . "," . $key;
                    }
                    $k++;
                }
            }

            if ($this->input->post("id") != "") {

                $data = array('company_id' => $this->company_id,
                    'user_group_id' => $this->input->post('user_group'),
                    'opration_id' => $this->opration,
                    'module_id' => $this->modid,
                    'menu_id' => $this->menuid,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $return_id = $this->input->post('id');
                $res = $this->Common_model->update_data('main_roles_privileges', $data, array('id' => $this->input->post('id')));

                if ($res) {
                    echo $this->Common_model->show_massege(14, 1) . "_" . $return_id;
                } else {
                    echo $this->Common_model->show_massege(15, 2) . "_" . $return_id;
                }
            } else {

                $data = array('company_id' => $this->company_id,
                    'user_group_id' => $this->input->post('user_group'),
                    'opration_id' => $this->opration,
                    'module_id' => $this->modid,
                    'menu_id' => $this->menuid,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->insert_data('main_roles_privileges', $data);
                $return_id = $this->db->insert_id();

                if ($res) {
                    echo $this->Common_model->show_massege(14, 1) . "_" . $return_id;
                } else {
                    echo $this->Common_model->show_massege(15, 2) . "_" . $return_id;
                }
            }
        }
    }

    function set_value() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_roles_privileges', array('user_group_id' => $id, 'company_id' => $this->company_id));

        if ($query) {
            foreach ($query->result() as $row):
                $this->user_privilege_id = $row->id;
                $this->user_group_id = $row->user_group_id;
                $this->user_menu_id = $row->menu_id;
                $this->user_mod_id = $row->module_id;
                $this->user_opration_id = $row->opration_id;
            endforeach;

            echo $this->user_group_id . "_" . $this->user_menu_id . "_" . $this->user_opration_id . "_" . $this->user_privilege_id . "_" . $this->user_mod_id;
        }
        else {
            echo "";
        }
    }

    function set_mod_change() {
        $id = $this->uri->segment(3);
        $this->db->order_by("module_id", "asc");
        $query = $this->db->get_where('main_menu', array('module_id' => $id, 'isactive' => 1));

        if ($query) {
            foreach ($query->result() as $row):

                if ($this->module_menu_id == "") {
                    $this->module_menu_id = $row->id;
                } else {
                    $this->module_menu_id = $this->module_menu_id . "_" . $row->id;
                }

            endforeach;

            echo $this->module_menu_id;
        } else {
            echo "";
        }
    }

     function set_menu_change(){
        $id = $this->uri->segment(3);
        $this->db->order_by("root_menu", "asc");
        $query = $this->db->get_where('main_menu', array('root_menu' => $id, 'isactive' => 1));

        if ($query) {
           foreach ($query->result() as $row):
            if ($this->change_menu_id == "") {
                    $this->change_menu_id = $row->id;
                } else {
                    $this->change_menu_id = $this->change_menu_id . "_" . $row->id;
                }

            endforeach;

            echo $this->change_menu_id;
        } else {
            echo "";
        }
    }
     
    function set_submenu_change(){
        $id = $this->uri->segment(3);
        $this->db->order_by("sub_root_menu", "asc");
        $query = $this->db->get_where('main_menu', array('sub_root_menu' => $id, 'isactive' => 1));

        if ($query) {
           foreach ($query->result() as $row):
            if ($this->sub_menu_id == "") {
                    $this->sub_menu_id = $row->id;
                } else {
                    $this->sub_menu_id = $this->sub_menu_id . "_" . $row->id;
                }

            endforeach;

            echo $this->sub_menu_id;
        } else {
            echo "";
        }
    }

}
