<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training_Requisition_Approval extends CI_Controller {

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
    public $companyView = false;

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
        $this->companyView = $this->user_data['company_view'];
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Training Requisition Approval";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_training_requisition', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Requisition_Approval.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Training_Requisition_Approval_Status() {
        
        $this->form_validation->set_rules('req_status', 'Approver', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id', 'Select at least one training', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $approver_id = $this->input->post("approver_id");
            $approver = (explode(",",$approver_id));
            foreach ($approver as $approve_status) {

                $data[] = array('id' => $approve_status,
                    'req_status' => $this->input->post('req_status'),                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );                
                
            } 
            
            $res = $this->db->update_batch('main_training_requisition', $data, 'id');
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function view_Training_Requisition() {
        
        $req_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Training Requisition Detail";
        $param['module_id'] = $this->module_id;
         // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_training_requisition", $req_id, $this->company_id);
        }
        // check permission to view the employee ends
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_requisition', array('id' => $req_id,'company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_training_requisition', array('id' => $req_id,'isactive' => 1));
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Requisition_Detail.php';
        $this->load->view('admin/home', $param);
    }
    
    
    public function update_sing_Training_Requisition() {

        $this->form_validation->set_rules('req_status', 'Status', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $data = array('req_status' => $this->input->post('req_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_training_requisition', $data, array('id' => $this->input->post('requisition_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function showTrainingRequisitionApproval()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order");
        $search = $this->input->get("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'main_training_requisition.id',
            1=>'main_training_requisition.training_id',
            2=>'main_training_requisition.proposed_date',
            3=>'main_training_requisition.employee',
            4=>'main_training_requisition.training_objective',
            5=>'main_training_requisition.req_status',
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }

        $this->db->limit($length, $start);
        $this->db->select('main_training_requisition.id, main_training_requisition.training_id, main_training_requisition.proposed_date, main_training_requisition.employee, main_training_requisition.training_objective, main_training_requisition.req_status');
        $this->db->from('main_training_requisition');
        //$this->db->where('main_opening_position.company_id', $this->company_id);
        $this->db->where('main_training_requisition.isactive', 1);

        if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('main_training_requisition.company_id', $this->company_id);
        }
        $training_requisition_approval = $this->db->get()->result();
        // echo "<pre>". print_r($employees) ."</pre>";exit;
      
        $data = array();
        $approver_status = $this->Common_model->get_array('approver_status');
        foreach ($training_requisition_approval as $row) {

            $employee = explode(",", $row->employee);
            $employees = '';
            foreach ($employee as $emp) {
                if ($employees == '') {
                    $employees = $this->Common_model->employee_name($emp);
                } else {
                    $employees = $employees . "," . $this->Common_model->employee_name($emp);
                }
            }
            $data[] = array(
                $row->id,
                $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name'),
                $this->Common_model->show_date_formate($row->proposed_date),
                $employees,
                $row->training_objective,
                $approver_status[$row->req_status],
                '<a title="Preview" href="' . base_url() . 'Con_Training_Requisition_Approval/view_Training_Requisition/' . $row->id . '/" ><i class="fa fa-lg fa-eye"></i></a>' 
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $requisition_approval = $this->totalTrainingRequisitionApproval();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $requisition_approval,
            "recordsFiltered" => $requisition_approval,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalTrainingRequisitionApproval()
    {
        //$departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        //$this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $this->db->where('main_training_requisition.isactive', 1);
        if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('main_training_requisition.company_id', $this->company_id);
        }
        //$this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_training_requisition");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }
    
    
}
