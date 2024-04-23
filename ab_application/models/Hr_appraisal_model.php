<?php

class Hr_appraisal_model extends CI_Model {

    public $user_data = array();
    public $user_id = null;
    public $user_name = null;
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
        $this->user_name = $this->user_data['name'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function get_all_employees($limit = NULL) {
        
        $this->db->select();
        $this->db->from("main_employees");
        $this->db->join('main_state', 'main_state.id = main_employees.state');
        $this->db->where("isactive", 1);
        if ($this->company_id != 0) {
            $this->db->where("company_id", $this->company_id);
        }
        if ($limit != NULL) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_single_employees($employeeId) {
        $this->db->where("isactive", 1);
        if ($this->company_id != 0) {
            $this->db->where("company_id", $this->company_id);
        }
        $this->db->where('employee_id', $employeeId);
        $query = $this->db->get('main_employees');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_eval_category_byId($ids) {
        $this->db->where_in('cat_id', explode(',', $ids));
        $this->db->where("isactive", 1);
        if ($this->company_id != 0) {
            $this->db->where("company_id", $this->company_id);
        }
        $query = $this->db->get('main_review_eval_cat');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_competencies_by_reviewCategory($com_id) {
        $this->db->where_in('com_id', explode(',', $com_id));
        $this->db->where("isactive", 1);
        $query = $this->db->get('main_review_competencies');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_reviewCategories($cat_ids) {
        $cat_ids_arr = explode(',', $cat_ids);

        $this->db->where_in('cat_id', $cat_ids_arr);
        $this->db->where("isactive", 1);
        if ($this->company_id != 0) {
            $this->db->where("company_id", $this->company_id);
        }
        return $this->db->get('main_review_eval_cat')->result();
    }

    public function get_eval_catgory_by_comId($com_id) {
        $this->db->like('competencies', $com_id);
        $this->db->where("isactive", 1);
        if ($this->company_id != 0) {
            $this->db->where("company_id", $this->company_id);
        }
        return $this->db->get('main_review_eval_cat')->row('cat_name');
    }

    public function get_avg_rating($temp_app_id, $cat_id) {
        $this->db->select("AVG(`rating`) AS avg_rating");
        return $this->db->get_where('tbl_appraisal_rating', array('temp_app_id' => $temp_app_id, 'cat_id' => $cat_id))->row('avg_rating');
    }

    public function get_overall_review($final_rating) {
        $col_name = 'rating_';
        $col_name .= (string) (round($final_rating));

        $this->db->select($col_name . ' as remTxt');
        return $this->db->get_where('main_overall_remarks', array('rem_id' => 1))->row('remTxt');
    }

    public function clear_temp_appraisal_data($tbl_arr, $temp_app_id) {
        foreach ($tbl_arr as $tbl) {
            $this->db->where('temp_app_id', $temp_app_id);
            $this->db->delete($tbl);
        }
    }

}
