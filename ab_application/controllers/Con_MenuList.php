<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_MenuList extends CI_Controller {

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
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
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
        $param['page_header']="Menu List";
        $param['module_id']=$this->module_id;
        
        $param['status_array']=$this->Common_model->get_array('status');
        
        
        if($this->user_group==11 || $this->user_group==12)
        {
            $user_menu = explode(",", $this->user_menu);
            $user_menu = array_map('intval', $user_menu);
            //$this->db->where('isactive', 1);
            $this->db->where_in('id', $user_menu);
            $param['query'] = $this->db->get('main_menu');
        }
        else {
            $param['query']= $this->db->get_where('main_menu', array());//'isactive' => 1
        }
        //echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_menulist.php';
        $this->load->view('admin/home', $param);
    }
    
     public function add_menulist() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type']="1"; 
	$param['page_header']="Menu List";	
        $param['module_id']=$this->module_id;
        
        $param['status_array']=$this->Common_model->get_array('status');
        $param['main_module_query']=$this->Common_model->listItem('main_module');
        $param['main_menu_query']=$this->Common_model->get_selected_row('main_menu', array('root_menu' => 0));
     
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addmenulist.php';
        $this->load->view('admin/home', $param); 
    }
    
    
     public function save_menulist() {
        $this->form_validation->set_rules('menu_name','Menu Name','required|is_unique[main_menu.menu_name]',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('module_id', 'Module Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
                   $menu_icon="default";
            $data = array('company_id' => $this->company_id,
                'menu_name' => $this->input->post('menu_name'),
                'menu_link' => trim($this->input->post('menu_link')),
                'module_id' => $this->input->post('module_id'),
                'root_menu' => $this->input->post('root_menu'),
                'sub_root_menu' => $this->input->post('sub_root_menu'),
                'menu_icon' =>  $menu_icon,
                'sequence' => $this->input->post('sequence'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => $this->input->post('isactive'),
            );
            $res = $this->Common_model->insert_data('main_menu', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
    }
    
    function edit_entry() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        $param['menu_name'] = str_replace("%20", " ", $this->uri->segment(4));
        
        $param['type']="2";
        $param['page_header']="Menu List";	
        $param['module_id']=$this->module_id;
        
        $param['query'] = $this->db->get_where('main_menu', array('id' => $id));
        $param['status_array']=$this->Common_model->get_array('status');
        $param['main_module_query']=$this->Common_model->listItem('main_module');
       
	    $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addmenulist.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function edit_MenuList() {
         $this->form_validation->set_rules('menu_name', 'Menu Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
         $this->form_validation->set_rules('module_id', 'Module Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
         
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
             $data = array('company_id' => $this->company_id,
                'menu_name' => $this->input->post('menu_name'),
                'menu_link' => trim($this->input->post('menu_link')),
                'module_id' => $this->input->post('module_id'),
                'root_menu' => $this->input->post('root_menu'),
                'sub_root_menu' => $this->input->post('sub_root_menu'),
                'sequence' => $this->input->post('sequence'),
                'menu_icon' => $this->input->post('menu_icon'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => $this->input->post('isactive'),
            );
            $res = $this->Common_model->update_data('main_menu', $data, array('id' => $this->input->post('id')));
            
            if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
    }

     public function delete_entry() {
        $id = $this->uri->segment(3);
        
        $chk=$this->Common_model->delete_menu_check("main_menu",$id);
        
        if($chk==TRUE)
        {
            $res=$this->Common_model->delete_by_id("main_menu", $id);
            if ($res) {
                echo $this->Common_model->show_massege(4, 1);
            } else {
                echo $this->Common_model->show_massege(5, 2);
            }
        }
        else if($chk==FALSE) {
            echo $this->Common_model->show_validation_massege('This menu not deleted... Because its contains another Menu', 2);
        }
        else {
            echo $this->Common_model->show_validation_massege('This Post problem occurred.', 2);
        }
        
        
    }

    public function set_root_dropdown() {
        $id = $this->uri->segment(3);

        if ($this->user_type == 2) {
            $query = $this->db->get_where('main_menu', array('root_menu' => 0, 'module_id' => $id, 'company_id' => $this->company_id));
        } else {
            $query = $this->db->get_where('main_menu', array('root_menu' => 0, 'module_id' => $id));
        }

        print"<option></option>";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->menu_name . "</option>";
            }
        } else {
            echo"<option> No Menu Added </option>";
        }
    }
    
    public function set_sub_root_dropdown() {
        $id = $this->uri->segment(3);

        if ($this->user_type == 2) {
            $query = $this->db->get_where('main_menu', array('root_menu' => $id, 'sub_root_menu' => 0, 'company_id' => $this->company_id));
        } else {
            $query = $this->db->get_where('main_menu', array('root_menu' => $id, 'sub_root_menu' => 0));
        }
        
        print"<option></option>";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->menu_name . "</option>";
            }
        } else {
            echo"<option> No Menu Added </option>";
        }
        
    }

}
