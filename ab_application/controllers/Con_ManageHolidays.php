<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Manageholidays extends CI_Controller {

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
        $this->module_id =$this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Manage Holyday";
        $param['module_id'] = $this->module_id;

        if ($this->user_group !=1 || $this->user_group !=2 || $this->user_group !=3) {
            $param['query'] = $this->db->get_where('main_holiday', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_holiday', array('isactive' => 1));
        }
        
        //echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_ManageHolidays.php';
        $this->load->view('admin/home', $param);
    }

    public function add_holiday() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Manage Holyday";
        $param['module_id'] = $this->module_id;
        
        $param['holiday_group_query']=$this->Common_model->listItem('main_holiday_group');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addHolidays.php';
        $this->load->view('admin/home', $param);
    }

    public function save_holiday() {
        $this->form_validation->set_rules('holiday', 'Holiday', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('group_id', 'Group Id', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'holiday' => $this->input->post('holiday'),
                'group_id' => $this->input->post('group_id'),
                'holiday_date' => $this->Common_model->convert_to_mysql_date($this->input->post('holiday_date')),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_holiday', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_holidays() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param['group_id'] = str_replace("%20", " ", $this->uri->segment(4));

        $param['type'] = "2";
        $param['page_header'] = "Manage Holyday";
        $param['module_id'] = $this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("leave_holiday", $id, $this->company_id);
        }
        // check permission to view the employee ends

        $param['holiday_group_query']=$this->Common_model->listItem('main_holiday_group');
        $param['query'] = $this->db->get_where('main_holiday', array('id' => $id));        

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addHolidays.php';
        $this->load->view('admin/home', $param);
    }

    public function update_holidays() {
         $this->form_validation->set_rules('holiday', 'Holiday', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('group_id', 'Group Id', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'holiday' => $this->input->post('holiday'),
                'group_id' => $this->input->post('group_id'),
                'holiday_date' => $this->Common_model->convert_to_mysql_date($this->input->post('holiday_date')),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            //print_r($data);exit();
  
            $res = $this->Common_model->update_data('main_holiday', $data, array('id' => $this->input->post('id')));
          
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_holidays() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_holiday", $id);
        redirect('Con_Manageholidays/');
        exit;
    }

}
