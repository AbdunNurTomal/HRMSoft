<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Benefitsprovider extends CI_Controller {

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
        $param['page_header'] = "Benefits Provider";
        $param['module_id'] = $this->module_id;

        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_benefits_provider', array('company_id' => $this->company_id));
        } else {
            $param['query'] = $this->db->get('main_benefits_provider');
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_BenefitsProvider.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Benefits_provider() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Benefits Provider";
        $param['module_id'] = $this->module_id;
        $param['states'] = $this->Common_model->listItem('main_state');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addBenefitsProvider.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Benefits_provider() {
        $this->form_validation->set_rules('service_provider_name', 'Service Provider Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('city', 'City', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_name', 'Contact Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'service_provider_name' => $this->input->post('service_provider_name'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'states' => $this->input->post('states'),
                'zipcode' => $this->input->post('zipcode'),
                'contact_name' => $this->input->post('contact_name'),
                'phone_no' => $this->input->post('phone_no'),
                'ext' => $this->input->post('ext'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_benefits_provider', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Benefits_provider() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Benefits Provider";
        $param['module_id'] = $this->module_id;
        $param['state_id'] = str_replace("%20", " ", $this->uri->segment(4));

        $param['query'] = $this->db->get_where('main_benefits_provider', array('id' => $id));
        $param['states'] = $this->Common_model->listItem('main_state');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addBenefitsProvider.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Benefits_provider() {
        $this->form_validation->set_rules('service_provider_name', 'Service Provider Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('city', 'City', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_name', 'Contact Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('phone_no', 'Phone No', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'service_provider_name' => $this->input->post('service_provider_name'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'states' => $this->input->post('states'),
                'zipcode' => $this->input->post('zipcode'),
                'contact_name' => $this->input->post('contact_name'),
                'phone_no' => $this->input->post('phone_no'),
                'ext' => $this->input->post('ext'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_benefits_provider', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_Benefits_provider() {
        echo $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_benefits_provider", $id);
        redirect('Con_BenefitsProvider/');
        exit;
    }

}
