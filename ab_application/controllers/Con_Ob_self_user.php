<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Ob_self_user extends CI_Controller {

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
        $this->load->model('Sendmail_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Online Onboarding";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'ob/view_Ob_self_user.php';
        $this->load->view('admin/home', $param);
    }

    public function save_self_user() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[main_users.email]', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('firstname', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('passwd', 'Password', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'email' => $this->input->post('email'),
                'name' => $this->input->post('firstname'),
                // 'password' => $this->Common_model->encrypt($this->input->post('passwd')),
                'password' => md5($this->input->post('passwd')),
                'phone_no' => $this->input->post('phone_no'),
                'user_group' => '9',
                'user_type' => '1',
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
                'password_reset_hash' => md5($this->input->post('passwd'))
            );

            $res = $this->Common_model->insert_data('main_users', $data);

            if ($this->input->post('email')!="") {
                $res = $this->Sendmail_model->selfuser_send_mail($this->input->post('firstname'), $this->input->post('email'), $this->input->post('passwd'));
            }

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

}
