<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_RatingLanguage extends CI_Controller {

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
        $this->load->model('hr_appraisal_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Rating Language List";
        $param['module_id'] = $this->module_id;


        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['query'] = $this->db->get('main_rating_language');


        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_ratingLanguageList.php';
        $this->load->view('admin/home', $param);
    }

    public function add_ratingLanguage() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Add Rating Language";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_addRatingLanguage.php';
        $this->load->view('admin/home', $param);
    }

    public function save_ratingLanguage() {
        $this->form_validation->set_rules('Rating_1', 'Rating 1', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_2', 'Rating 2', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_3', 'Rating 3', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_4', 'Rating 4', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_5', 'Rating 5', 'required', array('required' => "Please Enter the Required Field, *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $form_data = array(
                'rating_5' => $this->input->post('Rating_5'),
                'rating_4' => $this->input->post('Rating_4'),
                'rating_3' => $this->input->post('Rating_3'),
                'rating_2' => $this->input->post('Rating_2'),
                'rating_1' => $this->input->post('Rating_1'),
                'company_id' => $this->company_id,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
            );

            $res = $this->db->insert('main_rating_language', $form_data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function edit_ratingLanguage($rate_id = '') {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $param['menu_id'] = $this->menu_id;

        $param['page_header'] = "Edit Rating Language";
        $param['module_id'] = $this->module_id;
        $param['singleRating'] = $this->db->get_where('main_rating_language', array('rlang_id' => $rate_id))->row();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_editRatingLanguage.php';
        $this->load->view('admin/home', $param);
    }

    public function update_ratingLanguage($rate_id = '') {

        $this->form_validation->set_rules('Rating_1', 'Rating 1', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_2', 'Rating 2', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_3', 'Rating 3', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_4', 'Rating 4', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('Rating_5', 'Rating 5', 'required', array('required' => "Please Enter the Required Field, *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $form_data = array(
                'rating_5' => $this->input->post('Rating_5'),
                'rating_4' => $this->input->post('Rating_4'),
                'rating_3' => $this->input->post('Rating_3'),
                'rating_2' => $this->input->post('Rating_2'),
                'rating_1' => $this->input->post('Rating_1'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1
            );

            $this->db->where('rlang_id', $rate_id);
            $res = $this->db->update('main_rating_language', $form_data);

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_RatingLanguage() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_pk("rlang_id", "main_rating_language", $id);

        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
        exit;
    }

}
