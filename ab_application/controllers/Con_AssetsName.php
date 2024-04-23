<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_AssetsName extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
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

        if ($this->user_type == 2) {
            $this->company_id = $this->company_id;
        } else {
            $this->company_id = "";
        }

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Assets Name";
        $param['module_id'] = $this->module_id;

        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_assets_name', array('company_id' => $this->company_id));
        } else {
            $param['query'] = $this->db->get_where('main_assets_name');
        }
       
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_AssetsName.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_AssetsName() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $param['type'] = "1";
        $param['page_header'] = "Assets Name";
        $param['module_id'] = $this->module_id;
        $param['asset_type'] = $this->db->get('main_assets_type');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAssetsName.php';
        $this->load->view('admin/home', $param);
    }

    public function save_AssetsName() {

        $this->form_validation->set_rules('asset_name', 'Asset Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Asset Description', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
               
            $data = array('company_id' => $this->company_id,
                'asset_type_id' => $this->input->post('asset_type_id'),
                'asset_category_id' => $this->input->post('asset_category_id'),
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
    
    function edit_AssetsName() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Assets Name";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_assets_name', array('id' => $id));
        $param['asset_type'] = $this->db->get('main_assets_type');
        $param['asset_category'] = $this->db->get('main_assets_category');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAssetsName.php';
        $this->load->view('admin/home', $param);
    }
    
    public function update_AssetsName() {

        $this->form_validation->set_rules('asset_name', 'Asset Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Asset Description', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            if ($this->input->post('track_time_off')) {
                $track_time_off = $this->input->post('track_time_off');
            } else {
                $track_time_off = "";
            }
            
            $data = array('company_id' => $this->company_id,
                'asset_type_id' => $this->input->post('asset_type_id'),
                'asset_category_id' => $this->input->post('asset_category_id'),
                'asset_name' => $this->input->post('asset_name'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res = $this->Common_model->update_data('main_assets_name', $data, array('id' => $this->input->post('id')));
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function asset_category_filter($id){
        $query = $this->db->get_where('main_assets_category', array('asset_type_id' => $id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_category . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }
    
    public function delete_AssetsName() {
        echo $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_assets_name", $id);
        redirect('con_AssetsName/');
        exit;
    }
    
}