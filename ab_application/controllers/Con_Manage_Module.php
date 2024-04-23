<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Manage_Module extends CI_Controller {

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

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Manage Module";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_module', array('isactive' => 1));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'sadmin/view_module_dashbord.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_module() {
        
        if ($this->input->post("moduleid")) {
            
            $query = $this->db->get_where('main_module', array('isactive' => 1));
            $data = array();
            foreach ($query->result() as $row) {
                $data[] = array(
                    'id' => $row->id,
                    'status' => 0,
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
            }
            $dres = $this->db->update_batch('main_module', $data, 'id');
            
            if($dres)
            {
                $ddata = array();
                foreach ($this->input->post("moduleid") as $key) {
                    $ddata[] = array(
                        'id' => $key,
                        'status' => 1,
                        'modifiedby' => $this->user_id,
                        'modifieddate' => $this->date_time,
                        'isactive' => '1',
                    );
                }
                
                $res = $this->db->update_batch('main_module', $ddata, 'id');  
            }
   
        }

        if ($res) {
            echo $this->Common_model->show_massege(2, 1);
        } else {
            echo $this->Common_model->show_massege(3, 2);
        }
    }

}
