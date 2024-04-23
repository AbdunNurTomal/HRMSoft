<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ReviewForm extends CI_Controller {

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
        $param['page_header'] = "Review Form List";
        $param['module_id'] = $this->module_id;


        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['query'] = $this->db->get('main_review_form');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_reviewFormList.php';
        $this->load->view('admin/home', $param);
    }

    public function add_reviewForm() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Add Review Form";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['evalCategory'] = $this->db->get('main_review_eval_cat');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_addReviewForm.php';
        $this->load->view('admin/home', $param);
    }

    public function save_reviewForm() {

        $form_name = $this->input->post('review_form');
        $eval_cat = $this->input->post('eval_cat');

        $this->form_validation->set_rules('review_form', 'Form Name', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('eval_cat[0]', 'Evaluation Category', 'required', array('required' => "Please Check atleast One *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $form_data = array(
                'form_name' => $form_name,
                'cat_id' => implode(',', $eval_cat),
                'company_id' => $this->company_id,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
            );

            $res = $this->db->insert('main_review_form', $form_data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function edit_reviewForm($form_id = '') {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);


        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['evalCategory'] = $this->db->get('main_review_eval_cat');


        $param['singleForm'] = $this->db->get_where('main_review_form', array('form_id' => $form_id))->row();
        $param['page_header'] = "Edit Review Form";
        $param['module_id'] = $this->module_id;
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_editReviewForm.php';
        $this->load->view('admin/home', $param);
    }

    public function update_reviewForm($form_id = '') {

        $form_name = $this->input->post('review_form');
        $eval_cat = $this->input->post('eval_cat');

        $this->form_validation->set_rules('review_form', 'Form Name', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('eval_cat[0]', 'Evaluation Category', 'required', array('required' => "Please Check atleast One *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $form_data = array(
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1
            );

            $form_data['cat_id'] = implode(',', $eval_cat);
            $form_data['form_name'] = $form_name;

            $this->db->where('form_id', $form_id);
            $res = $this->db->update('main_review_form', $form_data);

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_ReviewForm() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_pk("form_id", "main_review_form", $id);

        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
        exit;
    }

}
