<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ActionPlan extends CI_Controller {

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

        if ($this->user_type == 2) {
            $this->company_id = $this->company_id;
        } else {
            $this->company_id = "";
        }

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
        $this->load->model('hr_appraisal_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Review Action Plan";
        $param['module_id'] = $this->module_id;


        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $this->db->where("company_id", $this->company_id);
        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
            $this->db->where_in("createdby", explode(',', get_sub_users($this->user_id)));
        } else {
            $this->db->where("createdby", $this->user_id);
        }
        $this->db->where("isactive", 1);
        $param['query'] = $this->db->get('main_action_plan');


        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_actionPlanList.php';
        $this->load->view('admin/home', $param);
    }

    public function add_actionPlan($menu_id = NULL) {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['menu_id'] = $this->menu_id = $menu_id;
        $param['page_header'] = "Add Review Action Plan";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_addActionPlan.php';
        $this->load->view('admin/home', $param);
    }

    public function save_actionPlan() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $this->form_validation->set_rules('action_plan_name', 'Action Plan', 'required', array('required' => "Please Enter the Required Field, *%s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array(
                'plan_name' => $this->input->post('action_plan_name'),
                'company_id' => $this->company_id,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
            );
            $res = $this->Common_model->insert_data('main_action_plan', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_actionPlan() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Edit Review Action Plan";
        $param['module_id'] = $this->module_id;

        $param['action_plan_query'] = $this->db->get_where('main_action_plan', array('plan_id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'appraisal/view_addActionPlan.php';
        $this->load->view('admin/home', $param);
    }

    public function update_actionPlan() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $this->form_validation->set_rules('action_plan_name', 'Action Plan', 'required', array('required' => "Please Enter the Required Field, *%s."));
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array(
                'plan_name' => $this->input->post('action_plan_name'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1
            );
            $res = $this->Common_model->update_data('main_action_plan', $data, array('plan_id' => $this->input->post('plan_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_ActionPlan() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_pk("plan_id", "main_action_plan", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
        exit;
    }

}
