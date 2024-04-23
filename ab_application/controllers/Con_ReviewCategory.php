<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ReviewCategory extends CI_Controller {

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
        $param['page_header'] = "Review Category List";
        $param['module_id'] = $this->module_id;


        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['query'] = $this->db->get('main_review_eval_cat');


        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_reviewCategoryList.php';
        $this->load->view('admin/home', $param);
    }

    public function add_reviewCategory() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Add Review Category";
        $param['module_id'] = $this->module_id;

        $param['evalCategory'] = $this->db->get('main_review_eval_cat');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_addReviewCategory.php';
        $this->load->view('admin/home', $param);
    }

    public function save_reviewCategory() {
        $com = $this->input->post('competencies');
        $this->form_validation->set_rules('review_catName', 'Review Category Name', 'required', array('required' => "Please Enter the Required Field, *%s."));

        if (!empty($com)) {
            $k = 0;
            foreach ($com as $key => $value) {
                $k++;
                $this->form_validation->set_rules('competencies[' . $key . ']', 'Review Competency', 'required', array('required' => "Please Enter the Required Field, *" . addOrdinalNumberSuffix($k) . " %s."));
            }
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $com_ids = array();
            foreach ($this->input->post('competencies') as $val) {
                $this->db->insert('main_review_competencies', array('com_name' => $val, 'company_id' => $this->company_id));
                $com_ids[] = $this->db->insert_id();
            }

            $competencies = implode(',', $com_ids);
            $insert_data = array(
                'cat_name' => $this->input->post('review_catName'),
                'company_id' => $this->company_id,
                'competencies' => $competencies,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
            );
            $res = $this->db->insert('main_review_eval_cat', $insert_data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function edit_reviewCategory($cat_id = '') {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;

        $param['page_header'] = "Edit Review Category";
        $param['module_id'] = $this->module_id;

        $param['singleCat'] = $this->db->get_where('main_review_eval_cat', array('cat_id' => $cat_id))->row();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_editReviewCategory.php';
        $this->load->view('admin/home', $param);
    }

    public function update_reviewCategory($cat_id = '') {
        $this->form_validation->set_rules('review_catName', 'Review Category Name', 'required', array('required' => "Please Enter the Required Field, *%s."));
        $com = $this->input->post('competencies');
        if (!empty($com)) {
            $k = 0;
            foreach ($com as $key => $value) {
                $k++;
                $this->form_validation->set_rules('competencies[' . $key . ']', 'Review Competency', 'required', array('required' => "Please Enter the Required Field, *" . addOrdinalNumberSuffix($k) . " %s."));
            }
        }
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $com_ids = array();
            $removeComp = $preComp = explode(',', $this->input->post('previous_competencies'));
            $newComp = $this->input->post('competencies');

            foreach ($newComp as $key => $value) {
                if (in_array($key, $preComp)) {
                    $this->db->where('com_id', $key);
                    $this->db->update('main_review_competencies', array('com_name' => $value));
                    $com_ids[] = $key;
                    $removeComp = array_diff($removeComp, array($key));
                } elseif (strpos($key, 'new') !== FALSE) {
                    $this->db->insert('main_review_competencies', array('com_name' => $value));
                    $com_ids[] = $this->db->insert_id();
                }
            }

            // Delete Unused Competencies
            if (!empty($removeComp)) {
                $this->db->where_in('com_id', $removeComp);
                $this->db->delete('main_review_competencies');
            }

            // Update Review Category
            $competencies = implode(',', $com_ids);
            $update_data = array(
                'cat_name' => $this->input->post('review_catName'),
                'competencies' => $competencies,
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1
            );

            $this->db->where('cat_id', $cat_id);
            $res = $this->db->update('main_review_eval_cat', $update_data);

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_ReviewCategory() {
        $id = $this->uri->segment(3);
        $competencies = $this->db->get_where('main_review_eval_cat', array('cat_id' => $id))->row('competencies');
        $query = $this->db->query('DELETE FROM main_review_competencies WHERE com_id IN (' . $competencies . ')');

        if ($query) {
            $res = $this->Common_model->delete_by_pk("cat_id", "main_review_eval_cat", $id);
            if ($res) {

                echo $this->Common_model->show_massege(4, 1);
            } else {
                echo $this->Common_model->show_massege(5, 2);
            }
        }
        exit;
    }

}
