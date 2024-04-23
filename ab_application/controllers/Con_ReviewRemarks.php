<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ReviewRemarks extends CI_Controller {

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
        $param['page_header'] = "Review Remarks List";
        $param['module_id'] = $this->module_id;


        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['query'] = $this->db->get('main_review_competencies');


        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_reviewRemarksList.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_reviewRemarks($com_id = '') {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Edit Review Remark";
        $param['module_id'] = $this->module_id;
        $param['com_id'] = $com_id;
        $param['singleCompetency'] = $this->db->get_where('main_review_competencies', array('com_id' => $com_id))->row();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_editReviewRemarks.php';
        $this->load->view('admin/home', $param);
    }

    public function update_reviewRemarks($menuId = '') {

        $this->form_validation->set_rules('com_name', 'Competency Name', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_1', 'Rating 1', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_2', 'Rating 2', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_3', 'Rating 3', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_4', 'Rating 4', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_5', 'Rating 5', 'required', array('required' => "Please Enter the Required Field, *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $com_id = $this->input->post('com_id');
            $form_data = array(
                'com_name' => $this->input->post('com_name'),
                'rating_remarks_5' => $this->input->post('rating_remarks_5'),
                'rating_remarks_4' => $this->input->post('rating_remarks_4'),
                'rating_remarks_3' => $this->input->post('rating_remarks_3'),
                'rating_remarks_2' => $this->input->post('rating_remarks_2'),
                'rating_remarks_1' => $this->input->post('rating_remarks_1'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1
            );

            $this->db->where('com_id', $com_id);
            $res = $this->db->update('main_review_competencies', $form_data);

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function edit_overallReviewRemarks($menu_id = '') {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $param['menu_id'] = $this->menu_id = $menu_id;
        $param['page_header'] = "Edit Overall Review Remark";
        $param['module_id'] = $this->module_id;
        $param['overallRemarks'] = $this->db->get_where('main_overall_remarks', array('company_id' => $this->company_id, 'user_id' => $this->user_id))->row();

        if (empty($param['overallRemarks'])) {
            $param['overallRemarks'] = (object) array(
                        'company_id' => $this->company_id,
                        'user_id' => $this->user_id,
                        'rating_1' => '',
                        'rating_2' => '',
                        'rating_3' => '',
                        'rating_4' => '',
                        'rating_5' => '',
            );
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_overallReviewRemarks.php';
        $this->load->view('admin/home', $param);
    }

    public function update_overallReviewRemarks($menu_id = '') {
        $this->form_validation->set_rules('rating_remarks_1', 'Rating 1', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_2', 'Rating 2', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_3', 'Rating 3', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_4', 'Rating 4', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $this->form_validation->set_rules('rating_remarks_5', 'Rating 5', 'required', array('required' => "Please Enter the Required Field, *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $form_data = array(
                'rating_5' => $this->input->post('rating_remarks_5'),
                'rating_4' => $this->input->post('rating_remarks_4'),
                'rating_3' => $this->input->post('rating_remarks_3'),
                'rating_2' => $this->input->post('rating_remarks_2'),
                'rating_1' => $this->input->post('rating_remarks_1')
            );

            $overallRemarks = $this->db->get_where('main_overall_remarks', array('company_id' => $this->company_id, 'user_id' => $this->user_id))->row();

            if (empty($overallRemarks)) {
                $form_data['company_id'] = $this->company_id;
                $form_data['user_id'] = $this->user_id;
                $res = $this->db->insert('main_overall_remarks', $form_data);
            } else {
                $this->db->where('user_id', $this->user_id);
                $this->db->where('company_id', $this->company_id);
                $res = $this->db->update('main_overall_remarks', $form_data);
            }

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

}
