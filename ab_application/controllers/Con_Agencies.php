<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Agencies extends CI_Controller {

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
        $this->user_group = $this->user_data['user_group'];
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
        $param['page_header'] = "Agencies";
        $param['module_id'] = $this->module_id;

        if ($this->user_type == 2) {
            $param['query'] = $this->db->get_where('main_agencies', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_agencies', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_Agencies.php';
        $this->load->view('admin/home', $param);
    }

    public function add_agencies() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Agencies";
        $param['module_id'] = $this->module_id;

        $param['screening_types_query'] = $this->Common_model->listItem('main_screening_types');
        $param['agency_county'] = $this->Common_model->listItem('main_county');
        $param['agency_state'] = $this->Common_model->listItem('main_state');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_addAgencies.php';
        $this->load->view('admin/home', $param);
    }

    public function save_agencies() {
        $this->form_validation->set_rules('agency_name', 'Agency Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('primary_phone', 'Primary Phone', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('address', 'Address', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            $data = array('company_id' => $this->company_id,
                'agency_name' => $this->input->post('agency_name'),
                'website_url' => $this->input->post('website_url'),
                'primary_phone' => $this->input->post('primary_phone'),
                'secondary_phone' => $this->input->post('secondary_phone'),
                'screening_id' => $this->input->post('screening_id'),
                'address' => $this->input->post('address'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_agencies', $data);

            if ($res) {
                $data = array('company_id' => $this->company_id,
                    'agency_id' => $this->db->insert_id(),
                    'agency_fast_name' => $this->input->post('agency_fast_name'),
                    'agency_last_name' => $this->input->post('agency_last_name'),
                    'agency_phone' => $this->input->post('agency_phone'),
                    'agency_email' => $this->input->post('agency_email'),
                    'agency_location' => $this->input->post('agency_location'),
                    'agency_county_id' => $this->input->post('agency_county_id'),
                    'agency_state_id' => $this->input->post('agency_state_id'),
                    'agency_city' => $this->input->post('agency_city'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
                $res = $this->Common_model->insert_data('main_agencies_detail', $data);


                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
            }
        }
    }

    function edit_agencies() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Agencies";
        $param['module_id'] = $this->module_id;

        $param['screening_types_query'] = $this->Common_model->listItem('main_screening_types');
        $param['agency_county'] = $this->Common_model->listItem('main_county');
        $param['agency_state'] = $this->Common_model->listItem('main_state');
        //$param['query'] = $this->db->get_where('main_agencies', array('id' => $id));        
        $param['query'] = $this->Common_model->get_agencies($id);

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'background_check/view_addAgencies.php';
        $this->load->view('admin/home', $param);
    }

    public function update_agencies() {
         $this->form_validation->set_rules('agency_name', 'Agency Name', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('primary_phone', 'Primary Phone', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('address', 'Address', 'required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            $data = array('company_id' => $this->company_id,
                'agency_name' => $this->input->post('agency_name'),
                'website_url' => $this->input->post('website_url'),
                'primary_phone' => $this->input->post('primary_phone'),
                'secondary_phone' => $this->input->post('secondary_phone'),
                'screening_id' => $this->input->post('screening_id'),
                'address' => $this->input->post('address'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_agencies', $data, array('id' => $this->input->post('id')));
            if ($res) {
                $data = array('company_id' => $this->company_id,
                    'agency_id' => $this->input->post('id'),
                    'agency_fast_name' => $this->input->post('agency_fast_name'),
                    'agency_last_name' => $this->input->post('agency_last_name'),
                    'agency_phone' => $this->input->post('agency_phone'),
                    'agency_email' => $this->input->post('agency_email'),
                    'agency_location' => $this->input->post('agency_location'),
                    'agency_county_id' => $this->input->post('agency_county_id'),
                    'agency_state_id' => $this->input->post('agency_state_id'),
                    'agency_city' => $this->input->post('agency_city'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
                $res = $this->Common_model->update_data('main_agencies_detail', $data, array('agency_id' => $this->input->post('id')));


                if ($res) {
                    echo $this->Common_model->show_massege(2, 1);
                } else {
                    echo $this->Common_model->show_massege(3, 2);
                }
            }
        }
    }

    public function delete_agencies() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_agencies", $id);
        redirect('Con_Agencies/');
        exit;
    }
    public function load_county_name() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_county', array('state_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->county_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

}
