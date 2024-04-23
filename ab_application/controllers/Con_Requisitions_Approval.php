<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Requisitions_Approval extends CI_Controller {

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
        $param['page_header'] = "Requisitions Approval";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
//            $reqs=array('0','2','4');
//            //$reqs_arr = explode(",", $reqs);
//            $reqst_arr = array_map('intval', $reqs);
//            $this->db->where_in('req_status',$reqst_arr);
            $this->db->where("req_status !=",1);
            $this->db->where("is_close",0);
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id));
            //echo $this->db->last_query();
        } else {
            $this->db->where("req_status !=",1);
            $this->db->where("is_close",0);
            $param['query'] = $this->db->get_where('main_opening_position', array());
            
            //$param['query'] =  $this->db->query("SELECT * FROM main_opening_position  WHERE req_status IN ('0') ");           
        }
        
        //echo $this->db->last_query();
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Requisitions_Approval.php';
        $this->load->view('admin/home', $param);
    }

     public function update_req_Status() {
         
        $this->form_validation->set_rules('req_status', 'Approver', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id', 'Action Button', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $this->db->trans_begin();
            
            $approver_id = $this->input->post("approver_id");
                $approver = (explode(",",$approver_id));
            foreach ($approver as $approve_status) {
              
                $data[] = array('id' => $approve_status,
                    'req_status' => $this->input->post('req_status'),                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );  
                //print_r($data); exit; 
            }            
                $res = $this->db->update_batch('main_opening_position', $data, 'id');
         
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function view_requisition() {
        
        $req_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Job Requisition Detail";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$req_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $req_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobRequisitionDetail.php';
        $this->load->view('admin/home', $param);
    }
    
    
    
    public function update_sing_req_Status() {

        $this->form_validation->set_rules('sing_req_status', 'Status', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $this->db->trans_begin();
        
            $data = array('req_status' => $this->input->post('sing_req_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_opening_position', $data, array('id' => $this->input->post('requisition_id')));

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function showRequisitionApproval()
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
            0=>'main_opening_position.id',
            1=>'main_opening_position.requisition_code',
            2=>'main_opening_position.location_id',
            3=>'main_opening_position.department_id',
            4=>'main_opening_position.requisitions_date',
            5=>'main_opening_position.due_date',
            6=>'main_opening_position.position_id',
            7=>'main_opening_position.no_of_positions',
            8=>'main_opening_position.req_status',

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
        $this->db->select('main_opening_position.id, main_opening_position.requisition_code, main_opening_position.location_id, main_opening_position.department_id, main_opening_position.requisitions_date, main_opening_position.requisitions_date, main_opening_position.due_date, main_opening_position.position_id, main_opening_position.no_of_positions, main_opening_position.req_status');
        $this->db->from('main_opening_position');
        $this->db->where("main_opening_position.req_status !=",1);
        $this->db->where("main_opening_position.is_close",0);
        //$this->db->where('main_opening_position.company_id', $this->company_id);
        $this->db->where('main_opening_position.isactive', 1);

        if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('main_opening_position.company_id', $this->company_id);
        }
        $requisition_list = $this->db->get()->result();
        // echo "<pre>". print_r($employees) ."</pre>";exit;
      
        $data = array();
        $approver_status = $this->Common_model->get_array('approver_status');
        foreach ($requisition_list as $row) {
            //print_r($requisition_list); exit;
         if($row->req_status==0){
            $status = $approver_status[$row->req_status];
        }  else {
            $status=$approver_status[$row->req_status];
        }  
            $data[] = array(
                $row->id,
                $row->requisition_code,
                $this->Common_model->get_name($this, $row->location_id,'main_location','location_name'),
                $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name'),
                $this->Common_model->show_date_formate($row->requisitions_date),
                $this->Common_model->show_date_formate($row->due_date),
                $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title'),
                $row->no_of_positions,
                $status,
               '<a title="Preview" href="' . base_url() . 'Con_Requisitions_Approval/view_requisition/' . $row->id . '/" target="_blank" ><i class="fa fa-lg fa-eye"></i></a>' 
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $total_requisitions = $this->totalRequisitionList();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_requisitions,
            "recordsFiltered" => $total_requisitions,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalRequisitionList()
    {
        //$departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        //$this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $this->db->where("main_opening_position.req_status !=",1);
        $this->db->where("main_opening_position.is_close",0);
        if (($this->user_group == 1 && $this->user_data["company_view"] == 0)||$this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) { } else {
            $this->db->where('main_opening_position.company_id', $this->company_id);
        }
        //$this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_opening_position");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }

    

}
