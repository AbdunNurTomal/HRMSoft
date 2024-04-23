<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con_dashbord extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_name = null;
    public $user_email = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
    public $parent_user = null;
    public $module_id = null;
    public $date_time = null;
    public $companyView = false;
    
    public function __construct() {
        parent::__construct();
        
        //$session_id = $this->session->userdata('hr_logged_in');
        //print_r($session_id);
        //echo $_SERVER['REMOTE_ADDR']."==";
        //echo $this->Common_model->get_client_ip();
        //echo "====>>>>>".$this->db->database;
                
        if( !$this->session->userdata('hr_logged_in') ) {
            redirect('Chome/logout', 'refresh');
        }
        
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_name =$this->user_data['name'];
        $this->user_email =$this->user_data['username'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->parent_user =$this->user_data['parent_user'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
        
        //header("Access-Control-Allow-Origin: *");
    }

    public function index($menu_id=0, $show_result = FALSE, $search_ids = array(), $search_criteria = array('company_idd' => '','is_active' => 1)) {
        if (!$this->user_id) {
            //if (!$this->hr_login->is_logged_in()) {
            redirect('chome/logout', 'refresh');
        } else {
            
            $param['show_result'] = $show_result;
            $param['search_ids'] = $search_ids;
            $param['search_criteria'] = $search_criteria;
            
            $this->module_id = $this->uri->segment(3);
            if (!$this->uri->segment(3)) {
               $user_module= explode(',',$this->user_module);
               $param['module_id'] = $user_module[0];
            } else {
                $param['module_id'] = $this->uri->segment(3);
            }

            // check module access starts
            $currentModuleId = 1; // Dashboard
            if ($this->user_group <= 3) {
            } else if ($this->user_group == 12 && $this->companyView) {
            } else {
                // print_r($this->user_group);exit;
                $moduleAccess = $this->KurunthamModel->checkModuleAccess($this->user_group, $currentModuleId, $this->user_module);
            }
            /* if (!$moduleAccess) {
                redirect('Con_Alert');
            } */
            // check module access ends

            $module_session_array = array();
            $module_session_array = array('module_id' => $param['module_id']);
            $this->session->set_userdata('active_module_id', $module_session_array);

            $param['user_group'] = $this->user_group;
            $param['user_id'] = $this->user_id;
            $param['user_name'] = $this->user_name;
            $param['user_email'] = $this->user_email;
            
            $param['user_group'] = $this->user_group;
            $param['page_header'] = "Dashboard";
            
            $parent='0';
            if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {
                $parent = $this->Common_model->get_name($this,$this->user_id, 'main_users','parent_user');
                $this->db->where("(parent_user=$this->user_id OR parent_user='$parent')");
                $uquery = $this->db->get_where('main_users', array('user_group' => 12, 'company_id !=' => 0));
            } else {
                $uquery = $this->db->get_where('main_users', array('parent_user' => $this->parent_user, 'user_group' => $this->user_group, 'company_id !=' => 0));
            }
        
            $ids = array();
            foreach ($uquery->result_array() as $id) {
                $ids[] = $id['company_id'];
            }

            if (!empty($ids)) {
                $this->db->where_in('id', $ids);
                $param['com_query']=$this->db->get_where('main_company', array());
            } else {
                $param['com_query'] = $this->db->get_where('main_company', array('user_id' => $this->user_id));
                if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {
                    $param['com_query']=$this->db->get_where('main_company', array());
                }
            }

            $param['corporation_type']=$this->Common_model->get_array('corporation_type');
            
            $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
            
            // echo "<pre>". print_r($this->user_menu, 1) ."</pre>";exit;
            $isCompanyView = 0;
            if ($this->session->userdata("hr_logged_in")) {
                $isCompanyView = $this->session->userdata("hr_logged_in")["company_view"];
            }

            if ($this->user_menu) {
                if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {
                //if (!$isCompanyView) {
                    $param['content'] = 'sadmin/view_admin_dashbord.php';
                } else {
                    $this->db->from('main_company');
                    $this->db->where('id', $this->company_id);
                    $this->db->where('isactive', 1);
                    $query = $this->db->get();
                    $company = $query->result();
            
                    $param['companyName'] = "HRC";
                    if ($company) {
                        $param['companyName'] = $company[0]->company_full_name;
                    }
                    $param['content'] = 'sadmin/view_dashbord.php';
                }
            } else {
                redirect('Con_Alert');
            }

            $this->load->view('admin/home', $param);
        }
    }

    public function search_company() {
        
        $ids = $search_criteria = array();

        $search_criteria['company_idd'] = $company_idd = $this->input->post('company_idd');
        $search_criteria['is_active'] = $is_active = $this->input->post('is_active');

        if (($company_idd != '' || $is_active != '')) {
     
            $this->db->select('id as com_id');
            $this->db->from('main_company');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('id', $this->company_id);
            } else {
                //$this->db->where('user_id', $this->user_id);
            }

            /* ----Conditions---- */
            if ($company_idd != '') {
                $this->db->where('id', $company_idd);
            }
            if ($is_active != '') {
                $this->db->where('isactive', $is_active);
            }
           
            $ids = $this->db->get()->result_array();
            
        }

        $ids = array_column($ids, 'com_id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
        
    }

    public function error()
    {
        if (!$this->module_id) {
            $param['module_id'] = 0;
        } else {
            $param['module_id'] = $this->module_id;
        }

        $param['user_id'] = $this->user_id;
        $param['user_group'] = $this->user_group;
        $param['page_header'] = "Error";

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'sadmin/view_warning_msg.php';
        $this->load->view('admin/home', $param);
    }

}
