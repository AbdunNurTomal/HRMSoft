<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Announcements extends CI_Controller {

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
        $param['page_header'] = "Announcements";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_announcements', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_announcements', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'dashboard/view_announcements.php';
        $this->load->view('admin/home', $param);
    }

    public function add_announcements() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Announcements";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['location_query'] = $this->db->get_where('main_location', array('company_id' => $this->company_id));
            $param['department'] = $this->db->get_where('main_department', array('company_id' => $this->company_id));
        } else {
            $param['location_query'] = $this->Common_model->listItem('main_location');
            $param['department'] = $this->Common_model->listItem('main_department');
        }


        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'dashboard/view_addAnnouncements.php';
        $this->load->view('admin/home', $param);
    }

    public function save_announcements() {
        // echo "<pre>". print_r($this->input->post(), 1) ."</pre>";exit;
        $this->form_validation->set_rules('title', 'Title','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department_id', 'Departments','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('location_id', 'Location','required',array('required'=> "Please the enter required field, for more Info : %s."));


        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_id,
                'title' => $this->input->post('title'),
                'location_id' => $this->input->post('location_id'),
                'department_id' => $this->input->post('department_id'),
                'val_date' => $this->Common_model->convert_to_mysql_date($this->input->post('val_date')),
                'description' => $this->input->post('hidden_description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_announcements', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }
    
    public function dep_emp() {
        echo $id = $this->uri->segment(3);
        exit();
        $dpt_id = explode(",", $id);
        $con_dpt_id = array_map('intval', $dpt_id);
        echo "tttttt";
        exit();
        $this->db->where_in('department', $con_dpt_id);
        $query = $this->db->get('main_emp_workrelated');
        echo $this->db->last_query();
        
        exit();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->employee_id . ">" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') . "</option>";
            }
        } else {
            echo"<option> No Plan Added </option>";
        }
    }

    function edit_announcements() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Announcements";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['location_query'] = $this->db->get_where('main_location', array('company_id' => $this->company_id));
            $param['department'] = $this->db->get_where('main_department', array('company_id' => $this->company_id));
        } else {
            $param['location_query'] = $this->Common_model->listItem('main_location');
            $param['department'] = $this->Common_model->listItem('main_department');
        }

        $param['query'] = $this->db->get_where('main_announcements', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'dashboard/view_addAnnouncements.php';
        $this->load->view('admin/home', $param);
    }

    public function update_announcements() {
        // echo "<pre>". print_r($this->input->post(), 1) ."</pre>";exit;
        $this->form_validation->set_rules('title', 'Title','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department_id', 'Departments','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('location_id', 'Location','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'title' => $this->input->post('title'),
                'location_id' => $this->input->post('location_id'),
                'department_id' => $this->input->post('department_id'),
                'val_date' => $this->Common_model->convert_to_mysql_date($this->input->post('val_date')),
                'description' => $this->input->post('hidden_description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_announcements', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_announcements() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_announcements", $id);
        redirect('con_Announcements/');
        exit;
    }

}
