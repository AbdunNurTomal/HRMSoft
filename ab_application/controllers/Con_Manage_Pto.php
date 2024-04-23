<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Manage_Pto extends CI_Controller {

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
        $param['page_header'] = "Manage PTO";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_pto_request', array('company_id' => $this->company_id, 'status' => 0));
        } else {
            $param['query'] = $this->db->query("SELECT * FROM main_pto_request WHERE status=0");
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_PtoManage.php';
        $this->load->view('admin/home', $param);
    }

    public function view_pto_request() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $id = $this->uri->segment(3);
        $param['emp_id'] = $this->Common_model->get_name($this,$id,'main_pto_request','employee_id');
        
        $employee_id=$this->Common_model->get_name($this,$id,'main_pto_request','employee_id');
        $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','state');
                
        $param['type'] = "2";
        $param['page_header'] = "PTO Request";
        $param['module_id'] = $this->module_id;
        $param['query'] = $this->db->get_where('main_pto_request', array('id' => $id));
        //echo $this->db->last_query();
        
        if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            
            $this->db->select('paid_leave_type, main_pto_settings.id AS mstID, main_employeeleavetypes.state');
            $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            $this->db->where('main_pto_settings.company_id', $this->company_id);
            $this->db->order_by('main_pto_settings.id', 'DESC');
            $param['leave_type_query'] = $this->db->get('main_pto_settings');
            
        } else {
            $this->db->select('paid_leave_type, main_pto_settings.id AS mstID, main_employeeleavetypes.state');
            $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
            $this->db->where('main_employeeleavetypes.state', $emp_state);
            //$this->db->where('main_pto_settings.company_id', $this->company_id);
            $this->db->order_by('main_pto_settings.id', 'DESC');
            $param['leave_type_query'] = $this->db->get('main_pto_settings');
        }

//        $this->db->select('*');
//        $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.id = main_pto_settings.paid_leave_type');
//        if ($this->user_group == 11 || $this->user_group == 12) {
//            $this->db->where('main_pto_settings.company_id', $this->company_id);
//        }
//        $param['policy'] = $this->db->get('main_pto_settings');

        //pr($param['policy']->result());
        //pr($param['query']->result());

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_emp_Pto.php';
        $this->load->view('admin/home', $param);
    }

    public function update_emp_pto() {

        $this->form_validation->set_rules('applied_hours', 'Applied Hour', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('description', 'Description', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $pto_req_id = $this->input->post('pto_req_id');
            $EMP_ID = $this->input->post('EMP_ID');

            $data = array(
                'approved_hours' => $this->input->post('applied_hours'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
            );
            //pr($data);
            
            $res = $this->Common_model->update_data('main_pto_request', $data, array('id' => $pto_req_id, 'employee_id' => $EMP_ID));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function ajax_edit_pto() {
        $id = $this->uri->segment(3);
        $query = $this->Common_model->get_by_id_row('main_pto_request', $id);
        echo json_encode($query);
        exit();
    }

    public function approve_pto() {

        $pto_req_id = $this->uri->segment(3);
        
        $this->db->where('id',$pto_req_id);
        $pto_rqst_data = $this->db->get('main_pto_request')->row();
        
        //pr($pto_rqst_data, 1);

        $data = array(
            'company_id' => $this->company_id,
            'pto_rqst_id' => $pto_rqst_data->id,
            'employee_id' => $pto_rqst_data->employee_id,
            'leave_type' => $pto_rqst_data->leave_type,
            'available_balance' => $pto_rqst_data->available_balance,
            'applied_hours' => $pto_rqst_data->applied_hours,
            'approved_hours' => $pto_rqst_data->approved_hours,
            'description' => $pto_rqst_data->description,
            'createdby' => $this->user_id,
            'createddate' => $this->date_time,
            'isactive' => 1
        );

        $res = $this->db->insert('main_pto_transaction', $data);

        $udata = array('status' => 1);
        $ures = $this->Common_model->update_data('main_pto_request', $udata, array('id' => $pto_req_id));

        if ($res && $ures) {
            echo $this->Common_model->show_massege(12, 1);
        } else {
            echo $this->Common_model->show_massege(13, 2);
        }
    }

    /*


      public function ajax_edit_leave(){
      $id = $this->uri->segment(3);
      $query = $this->Common_model->get_by_id_row('main_leave_request', $id);
      echo json_encode($query);
      }


      public function reject_leave() {
      $id = $this->uri->segment(3);
      $this->db->set('leave_status', 4);
      $this->db->where('id', $id);
      $this->db->update('main_leave_request');
      redirect('Con_EmployeeLeavesSummary/');
      exit;
      }

     */
}
