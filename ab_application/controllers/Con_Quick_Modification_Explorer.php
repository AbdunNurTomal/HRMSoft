<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Quick_Modification_Explorer extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $company_id = null;
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

        //echo "=====".$this->Common_model->generate_hrm_password();

        $this->session->unset_userdata('employee');

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employee Details";
        $param['module_id'] = $this->module_id;

        $param['status_array'] = $this->Common_model->get_array('status');
        $param['marital_status_array'] = $this->Common_model->get_array('marital_status');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Quick_Modification_Explorer.php';
        $this->load->view('admin/home', $param);
    }

     public function Quick_get_employee() {
        
        $empCheck = $this->input->post("empCheck");
        if(!empty($empCheck))
        {
            $data="";
            for ($i = 0; $i < count($empCheck); $i++) {
                if($data=="") $data=$empCheck[$i]; else $data=$data.",".$empCheck[$i];
            } 
            echo $data;
        }
        
    }
    
    public function save_Quick_Modification_Explorer() {
        
        $this->form_validation->set_rules('employee_id', 'employee', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $flag=0;
            $common_data = array('modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
            );
            
            $employee_id = explode(",", $this->input->post("employee_id"));
            
            //==================================================================
            $basic_data=array();
            $emp_basic_data=array();
            $Position="";
            
            //==================================================================
            
            $data_arr=array();
            $work_data=array();
            $wages="";
            $PayType="";
            
            //==================================================================
            
            for ($i = 0; $i < count($employee_id); $i++) {
                
                if($this->input->post('quickPosition')!="")
                {
                    $basic_data[$i]['employee_id'] = $employee_id[$i];
                    $basic_data[$i]['position'] = $this->input->post('quickPosition');
                    $Position=$this->input->post('quickPosition');
                    if(!empty($basic_data))
                    {
                        $emp_basic_data[$i] = array_merge($basic_data[$i], $common_data);
                    }
                }
                
                $data_arr[$i]['employee_id'] = $employee_id[$i];
                
                if($this->input->post('quickDepartment')!="")
                {
                    $data_arr[$i]['department'] = $this->input->post('quickDepartment');
                }
                if($this->input->post('quickPayType')!="")
                {
                    $data_arr[$i]['salary_type'] = $this->input->post('quickPayType');
                    $PayType=$this->input->post('quickPayType');
                }
                if($this->input->post('quickPaySchedule')!="")
                {
                    $data_arr[$i]['wages'] = $this->input->post('quickPaySchedule');
                    $wages=$this->input->post('quickPaySchedule');
                }
                if($this->input->post('rate')!="")
                {
                    $data_arr[$i]['per_hour_rate'] = $this->input->post('rate');
                    $per_hour_rate=$this->input->post('rate');
                }
                if($this->input->post('salary')!="")
                {
                    $data_arr[$i]['per_pay_period_salary'] = $this->input->post('salary');
                    $per_pay_period_salary=$this->input->post('salary');
                }
                
                if(!empty($data_arr))
                {
                    $work_data[$i] = array_merge($data_arr[$i], $common_data);
                }
                
                $rate=0;
                $salary=0;
                //==============================================================
                if($this->input->post('rate')!="" || $this->input->post('salary')!="")
                {
                    $rate=$this->input->post('rate');
                    $salary=$this->input->post('salary');
                    
                    if ($Position != "") {
                        $Position = $Position;
                    } else {
                        $Position = $this->Common_model->get_selected_value($this, 'employee_id', $employee_id[$i], 'main_employees', 'position');
                    }

                    if ($wages != "") {
                        $wages = $wages;
                    } else {
                        $wages = $this->Common_model->get_selected_value($this, 'employee_id', $employee_id[$i], 'main_emp_workrelated', 'wages');
                    }

                    $wage_houre = $this->Common_model->get_name($this, $wages, 'main_payfrequency_type', 'wage_houre');

                    if ($PayType != "") {
                        $PayType = $PayType;
                    } else {
                        $PayType = $this->Common_model->get_selected_value($this, 'employee_id', $employee_id[$i], 'main_emp_workrelated', 'salary_type');
                    }
                    
                    $this->Common_model->employee_wage_compensation($this,$employee_id[$i], $Position, $wages, $wage_houre,$PayType,$rate,$salary);
                    
                }
                
                //==============================================================
                
               
            } 
           // pr($work_data,1);
            
            if (!empty($emp_basic_data)) {
                $res = $this->db->update_batch('main_employees', $emp_basic_data, 'employee_id');
                if ($res) {
                    $flag = 1;
                }
            }
            if (!empty($work_data)) {
                $wres = $this->db->update_batch('main_emp_workrelated', $work_data, 'employee_id');
                if ($wres) {
                    $flag = 1;
                }
            }

            if ($flag==1) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
            
        }
    }

    

}
