<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Skill_Setup extends CI_Controller {

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
        $param['page_header'] = "Skill Setup";
        $param['module_id'] = $this->module_id;

//        if ($this->user_type == 2) {
//            $param['query'] = $this->db->get_where('main_county', array('company_id' => $this->company_id, 'isactive' => 1));
//        } else {
        $param['query'] = $this->db->get_where('main_county', array('isactive' => 1));
        //}

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Skill_Setup.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Skill_Setup() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Skill Setup";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addSkill_Setup.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Skill_Setup() {
        $this->form_validation->set_rules('skill_name', 'Skill Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'skill_name' => $this->input->post('skill_name'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_skill_setup', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_skill() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Skill Setup";
        $param['module_id'] = $this->module_id;

        $param['query'] = $this->db->get_where('main_skill_setup', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addSkill_Setup.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_Skill_Setup() {
        $this->form_validation->set_rules('skill_name', 'Skill Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'skill_name' => $this->input->post('skill_name'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_skill_setup', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_county() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_skill_setup", $id);
        redirect('Con_Skill_Setup/');
        exit;
    }

    public function skill_paginate() {

        // DB table to use
        $table = 'main_skill_setup';

        // Table's primary key
        $primaryKey = 'id';

        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'skill_name', 'dt' => 1),
            array('db' => 'description', 'dt' => 2),
            /*array('db' => 'last_name', 'dt' => 2),
            array('db' => 'first_address', 'dt' => 3),
                 array(
                  'db' => 'start_date',
                  'dt' => 4,
                  'formatter' => function( $d, $row ) {
                  return date('jS M y', strtotime($d));
                  }
                  ),
                  array(
                  'db' => 'salary',
                  'dt' => 5,
                  'formatter' => function( $d, $row ) {
                  return '$' . number_format($d);
                  }
                  ) */
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );

        $this->load->library('Ssp');        
        
        //pr(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns),1);

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
        exit;
    }

}
