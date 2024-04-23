<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training_Requisition extends CI_Controller {

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
   // public $ids;

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
        $this->ids = $this->uri->segment(3);
        
        $this->load->model('Sendmail_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Training Requisition";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_training_requisition', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_Training_Requisition.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Training_Requisition() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Training Requisition";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
            //$param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.company_id' => $this->company_id,'main_employees.isactive' => 1));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 

        } else {
            $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
            //$param['employees_query'] = $this->db->get_where('main_employees', array('isactive' => 1));
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.isactive' => 1));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 
        }
        //echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Requisition.php';
        $this->load->view('admin/home', $param);
    }
    

    public function save_Training_Requisition() {
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('proposed_date', 'Proposed Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));  
        // $this->form_validation->set_rules('training_objective', 'Training Objective', 'required', array('required' => "Please the enter required field, for more Info : %s."));
         $this->form_validation->set_rules('employee_id', 'Select at least one employee', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
          
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {   
            // print_r($this->input->post());exit;
            $employees = '';
            if($this->input->post("employee_id"))
            {
                /* foreach ($this->input->post("employee_id") as $emp) {
                    if ($employees == '') {
                        $employees = $emp;
                    } else {
                        $employees = $employees . "," . $emp;
                    }
                } */
                $employees = $this->input->post("employee_id");
            }
            
            $data = array('company_id' => $this->company_id,
                'proposed_date' => $this->Common_model->convert_to_mysql_date($this->input->post('proposed_date')),
                'training_id' => $this->input->post('training_id'),
                'employee' => $employees,
                'training_objective' => $this->input->post('training_objective'),
                //'training_output' => $this->input->post('training_output'),
                //'training_outcome' => $this->input->post('training_outcome'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            $res = $this->Common_model->insert_data('main_training_requisition', $data);
            
            if($this->input->post("employee_id"))
            {
                $employeesIds = explode(",", $this->input->post("employee_id"));
                $proposed_date=$this->Common_model->convert_to_mysql_date($this->input->post('proposed_date'));
                $eres = $this->Sendmail_model->training_send_mail($employeesIds,$proposed_date);
            }
            
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_Training_Requisition() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param['type'] = "2";
        $param['page_header'] = "Training Requisition";
        $param['module_id'] = $this->module_id;
         // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_training_requisition", $id, $this->company_id);
        }
        // check permission to view the employee ends
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['training_query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
            //$param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.company_id' => $this->company_id,'main_employees.isactive' => 1));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 
        } else {
            $param['training_query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
            //$param['employees_query'] = $this->db->get_where('main_employees', array('isactive' => 1));
            
            $this->db->select('main_employees.employee_id as employee_idd,main_employees.*,main_emp_workrelated.*');
            $this->db->from('main_employees');
            $this->db->where(array('main_employees.isactive' => 1));
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'left');
            $param['employees_query'] = $this->db->get(); 
        }

        $param['query'] = $this->db->get_where('main_training_requisition', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addTraining_Requisition.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Training_Requisition() {
         
        $this->form_validation->set_rules('training_id', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('proposed_date', 'Proposed Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('training_objective', 'Training Objective', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('employee_id', 'Select at least one employee', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            //print_r( $this->ids); exit;
           /*  $employees = '';
            foreach ($this->input->post('employee_id') as $emp) {
                if ($employees == '') {
                    $employees = $emp;
                } else {
                    $employees = $employees . "," . $emp;
                }
            } */
            $employees = '';
            if($this->input->post("employee_id"))
            {
                /* foreach ($this->input->post("employee_id") as $emp) {
                    if ($employees == '') {
                        $employees = $emp;
                    } else {
                        $employees = $employees . "," . $emp;
                    }
                } */
                $employees = $this->input->post("employee_id");
            }
            
            $data = array('company_id' => $this->company_id,
                'proposed_date' => $this->Common_model->convert_to_mysql_date($this->input->post('proposed_date')),
                'training_id' => $this->input->post('training_id'),
                'employee' => $employees,
                'training_objective' => $this->input->post('training_objective'),
                //'training_output' => $this->input->post('training_output'),
                //'training_outcome' => $this->input->post('training_outcome'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res = $this->Common_model->update_data('main_training_requisition', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_Training_Requisition() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_training_requisition", $id);
        redirect('Con_Training_Requisition/');
        exit;
    }
    

    public function save_New_Training() {
        
        $this->form_validation->set_rules('training_name', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_type', 'Training Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $eligible = '';
            foreach ($this->input->post('eligible') as $elg) {
                if ($eligible == '') {
                    $eligible = $elg;
                } else {
                    $eligible = $eligible . "," . $elg;
                }
            }
            
            $data = array('company_id' => $this->company_id,
                'training_name' => $this->input->post('training_name'),
                'training_level' => $this->input->post('training_level'),
                'training_type' => $this->input->post('training_type'),
                'duration' => $this->input->post('duration'),
                'plan_date' => $this->Common_model->convert_to_mysql_date($this->input->post('plan_date')),
                'company_cost' => $this->input->post('company_cost'),
                'employee_cost' => $this->input->post('employee_cost'),
                'estimation_costing' => $this->input->post('estimation_costing'),
                'eligible' => $eligible,
                'basic_information' => $this->input->post('basic_information'),
                'course_information' => $this->input->post('course_information'),
                'training_documents' => $this->input->post('training_documents'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => $this->input->post('status'),
            );

            $res = $this->Common_model->insert_data('main_new_training', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function showTrainingRequisition()
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
            0=>'main_employees.id',
            1=>'main_employees.id',
            3=>'main_employees.position',
            4=>'main_employees.hire_date'
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
        $this->db->select('main_employees.id as employee_idd, main_employees.first_name, main_employees.last_name, main_employees.position, main_employees.hire_date, main_emp_workrelated.location, main_emp_workrelated.department');
        $this->db->from('main_employees');

        $this->db->join('main_emp_workrelated', 'main_employees.id = main_emp_workrelated.employee_id', 'left');
        $this->db->where('main_employees.contact_via_text', 1);
        $this->db->where('main_employees.isactive', 1);

        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) { } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        $employees = $this->db->get()->result();
        // echo "<pre>". print_r($employees) ."</pre>";exit;

        $data = array();
        foreach ($employees as $rrow) {
            $data[] = array(
                $rrow->employee_idd,
                sprintf("%07d", $rrow->employee_idd),
                $this->Common_model->employee_name($rrow->employee_idd),
                $this->Common_model->get_name($this, $rrow->position, 'main_jobtitles', 'job_title'),
                $this->Common_model->show_date_formate($rrow->hire_date),
                $this->Common_model->get_name($this, $rrow->location, 'main_location', 'location_name'),
                $this->Common_model->get_name($this, $rrow->department, 'main_department', 'department_name'),
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $total_employees = $this->totalTrainingEmployees();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalTrainingEmployees()
    {
        //$departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $this->db->where('main_employees.contact_via_text', 1);
        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) { } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        //$this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_employees");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }


    public function showUpdateTrainingRequisition()
    {
        $recordId = $_REQUEST['recordId'];

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
            0=>'main_employees.id',
            1=>'main_employees.id',
            3=>'main_employees.position',
            4=>'main_employees.hire_date'
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
        $this->db->select('main_employees.id as employee_idd, main_employees.first_name, main_employees.last_name, main_employees.position, main_employees.hire_date, main_emp_workrelated.location, main_emp_workrelated.department');
        $this->db->from('main_employees');

        $this->db->join('main_emp_workrelated', 'main_employees.id = main_emp_workrelated.employee_id', 'left');
        $this->db->where('main_employees.contact_via_text', 1);
        $this->db->where('main_employees.isactive', 1);

        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) { } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        $employees_list = $this->db->get()->result();
        $this->db->select('main_training_requisition.employee');
        $this->db->from('main_training_requisition');
        $this->db->where('main_training_requisition.company_id',$this->company_id);
        // $this->db->where('main_training_requisition.id',$id);
        $this->db->where('main_training_requisition.id', $recordId);
        
        $employee_query = $this->db->get()->result();
       // print_r($employee_query);
       if(!empty($employee_query[0]->employee)){
        $alreadySavedEmployees = $employee_query[0]->employee;
       } else{
           $alreadySavedEmployees ="";
       }
        $alreadySavedEmployeesArr = explode(",", $alreadySavedEmployees);

        $val ="";
        $data = array();
        foreach ($employees_list as $employee) {
            $employeeId = $employee->employee_idd;

            $isSelected = '';
            if (in_array($employeeId, $alreadySavedEmployeesArr)) {
                $isSelected = 'checked';
            }
            $val = array("id"=> $employee->employee_idd, "check" => $isSelected);

            $data[] = array(
                $val,
                sprintf("%07d", $employee->employee_idd),
                $this->Common_model->employee_name($employee->employee_idd),
                $this->Common_model->get_name($this, $employee->position, 'main_jobtitles', 'job_title'),
                $this->Common_model->show_date_formate($employee->hire_date),
                $this->Common_model->get_name($this, $employee->location, 'main_location', 'location_name'),
                $this->Common_model->get_name($this, $employee->department, 'main_department', 'department_name'),
            );
        }

        $total_update_employees = $this->totalUpdateTrainingEmployees();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_update_employees,
            "recordsFiltered" => $total_update_employees,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalUpdateTrainingEmployees()
    {
        //$departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $this->db->where('main_employees.contact_via_text', 1);
        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) { } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        //$this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_employees");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }
    
}
