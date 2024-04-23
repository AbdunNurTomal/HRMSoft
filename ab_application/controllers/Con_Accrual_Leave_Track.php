<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Accrual_Leave_Track extends CI_Controller {
    
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
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Accrual Leave Track";
        $param['module_id']=$this->module_id;
        
        $param['leave_track_by']=$this->Common_model->get_name($this,$this->company_id,'main_company','leave_track_by');
        //0=HRM,1=Payroll,2=Time & Attendance
        if($param['leave_track_by']==0)
        {
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                $param['query'] = $this->db->get_where('main_accrual_leave_track', array('company_id' => $this->company_id,'isactive' => 1,'leave_track_by' => 0));
            } else {
                $param['query'] = $this->db->get_where('main_accrual_leave_track', array('isactive' => 1,'leave_track_by' => 0));
            }
        }
        else {
            
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                $this->db-> where('leave_track_by!=',0);
                $param['query'] = $this->db->get_where('main_accrual_leave_track', array('company_id' => $this->company_id,'isactive' => 1));
            } else {
                $this->db-> where('leave_track_by!=',0);
                $param['query'] = $this->db->get_where('main_accrual_leave_track', array('isactive' => 1));
            }
            
        }
        //echo $this->db->last_query();
                        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Accrual_Leave_Track.php';
        $this->load->view('admin/home', $param);
    }

    public function add_Leave_Track() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type'] = "1";
        $param['page_header'] = "Accrual Leave Track";
        $param['module_id']=$this->module_id;
        
        $param['leave_track_by']=$this->Common_model->get_name($this,$this->company_id,'main_company','leave_track_by');
        //0=HRM,1=Payroll,2=Time & Attendance
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAccrual_Leave_Track.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_process_Accrual_Leave_Track() {
        
        $result_data=$this->save_Accrual_Leave_Track(1);
        //$res=TRUE;
        if ($result_data) {
            //echo "I am";
            
            $employee_id=$this->input->post('employee_id');
            $pay_schedule=$this->input->post('pay_schedule');
            $leave_type=$this->input->post('leave_type');
            $working_hours= $this->input->post('working_hours');

            $count = count($employee_id);
            
            for ($i = 0; $i < $count; $i++) {
                
                $res=$this->get_employee_pto($employee_id[$i],$working_hours[$i],$leave_type[$i]);
            }
            //echo $res;exit();
            
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        } 
    }

    public function save_Accrual_Leave_Track($flag=0) {
        
        $this->form_validation->set_rules('pay_period_from', 'Pay Period From', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('pay_period_to', 'Pay Period TO', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('working_hours[]', 'Working Hours', 'required|numeric|xss_clean',array('required'=> "Please the enter required field, for more Info : %s.")); 
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
        
            $employee_id=$this->input->post('employee_id');
            $pay_schedule=$this->input->post('pay_schedule');
            $leave_type=$this->input->post('leave_type');
            $working_hours= $this->input->post('working_hours');
            
            $count = count($employee_id);
            
            for ($i = 0; $i < $count; $i++) {
                
                $this->db->where('employee_id', $employee_id[$i]);
                $this->db->where('leave_type', $leave_type[$i]);
                $this->db->where('leave_track_by', 0);
                $check_emp = $this->db->get('main_accrual_leave_track');
                
                if ($check_emp->num_rows() > 0) {
                    
                    $udata[$i] = array('employee_id' => $employee_id[$i],
                        'company_id' => $this->company_id,
                        'leave_track_by' => $this->input->post('leave_track_by'),
                        'pay_period_from' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_from')),
                        'pay_period_to' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_to')),
                        'pay_schedule' => $pay_schedule[$i],
                        'leave_type' => $leave_type[$i],
                        'working_hours' => $working_hours[$i],
                        'modifiedby' => $this->user_id,
                        'modifieddate' => $this->date_time,
                        'isactive' => '1',
                    );
                    
                } else {
                    
                    $data[$i] = array('company_id' => $this->company_id,
                        'leave_track_by' => $this->input->post('leave_track_by'),
                        'pay_period_from' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_from')),
                        'pay_period_to' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_to')),
                        'employee_id' => $employee_id[$i],
                        'pay_schedule' => $pay_schedule[$i],
                        'leave_type' => $leave_type[$i],
                        'working_hours' => $working_hours[$i],
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => '1',
                    );
                    
                }        
            }
      
            if(!empty($data))
            {
                $res = $this->db->insert_batch('main_accrual_leave_track', $data);
            }
            if(!empty($udata))
            {
                $res = $this->db->update_batch('main_accrual_leave_track', $udata, 'employee_id');
            }
            
            if($flag==0)
            {
                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
            }
            else {
                return TRUE;
            }
        
        }
    }

    public function edit_entry() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        
        $param['type']="2";
        $param['page_header']="Accrual Leave Track";	
        $param['module_id']=$this->module_id;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("emp_leave_track", $id, $this->company_id);
        }
        // check permission to view the employee ends

        $param['leave_track_by']=$this->Common_model->get_name($this,$this->company_id,'main_company','leave_track_by');
        $param['query'] = $this->db->get_where('main_accrual_leave_track', array('id' => $id))->row();
        
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAccrual_Leave_Track.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function edit_process_Accrual_Leave_Track(){
        
        $result_data=$this->edit_Accrual_Leave_Track(1);
        //$res=TRUE;
        if ($result_data) {
            //echo "I am";
            
            $employee_id=$this->input->post('employee_id');
            $pay_schedule=$this->input->post('pay_schedule');
            $working_hours= $this->input->post('working_hours');

            $count = count($employee_id);
            
            for ($i = 0; $i < $count; $i++) {
                
                $res=$this->get_employee_pto($employee_id[$i],$working_hours[$i]);
            }
            
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        } 
    }
    
    public function edit_Accrual_Leave_Track($flag=0) {
        
        $this->form_validation->set_rules('pay_period_from', 'Pay Period From', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('pay_period_to', 'Pay Period TO', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('working_hours[]', 'Working Hours', 'required|numeric|xss_clean',array('required'=> "Please the enter required field, for more Info : %s.")); 
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            
            $employee_id=$this->input->post('employee_id');
            $pay_schedule=$this->input->post('pay_schedule');
            $leave_type=$this->input->post('leave_type');
            $working_hours= $this->input->post('working_hours');

            $count = count($employee_id);
            
            for ($i = 0; $i < $count; $i++) {
                
                $udata[$i] = array('id' => $this->input->post('update_id'),
                    'company_id' => $this->company_id,
                    //'employee_id' => $employee_id[$i],
                    'leave_track_by' => $this->input->post('leave_track_by'),
                    'pay_period_from' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_from')),
                    'pay_period_to' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_to')),
                    //'pay_schedule' => $pay_schedule[$i],
                    'leave_type' => $leave_type[$i],
                    'working_hours' => $working_hours[$i],
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
              
            }
            
            if(!empty($udata))
            {
                $res = $this->db->update_batch('main_accrual_leave_track', $udata, 'id');
            }

            if($flag==0)
            {
                if ($res) {
                    echo $this->Common_model->show_massege(2,1);
                } else {
                    echo $this->Common_model->show_massege(3,2);
                }
            }
            else
            {
                return TRUE;
            }
        }
    }
    
    
    public function save_Accrual_Leave_Track_Payroll($flag=0) {
        
        $this->form_validation->set_rules('pay_period_from', 'Pay Period From', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('pay_period_to', 'Pay Period TO', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('working_hours[]', 'Working Hours', 'required|numeric|xss_clean',array('required'=> "Please the enter required field, for more Info : %s.")); 
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
        
            $employee_id=$this->input->post('employee_id');
            $pay_schedule=$this->input->post('pay_schedule');
            $hour_limit= $this->input->post('hour_limit');
            $working_hours= $this->input->post('working_hours');
            $hourly_allowance= $this->input->post('hourly_allowance');
            $available_hour= $this->input->post('available_hour');
            
            $count = count($employee_id);
            
            for ($i = 0; $i < $count; $i++) {
                
                $this->db->where('employee_id', $employee_id[$i]);
                $this->db->where("(leave_track_by=1 OR leave_track_by=2)");
                $check_emp = $this->db->get('main_accrual_leave_track')->row();
                
                if (!empty($check_emp)) {
                    
                    $udata[$i] = array('id' => $check_emp->id,
                        'employee_id' => $employee_id[$i],
                        'company_id' => $this->company_id,
                        'leave_track_by' => $this->input->post('leave_track_by'),
                        'pay_period_from' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_from')),
                        'pay_period_to' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_to')),
                        'pay_schedule' => $pay_schedule[$i],
                        'hour_limit' => $hour_limit[$i],
                        'working_hours' => $working_hours[$i],
                        'hourly_allowance' => $hourly_allowance[$i],
                        'available_hour' => $available_hour[$i],
                        'modifiedby' => $this->user_id,
                        'modifieddate' => $this->date_time,
                        'isactive' => '1',
                    );
                    
                } else {
                    
                    $data[$i] = array('company_id' => $this->company_id,
                        'leave_track_by' => $this->input->post('leave_track_by'),
                        'pay_period_from' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_from')),
                        'pay_period_to' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_to')),
                        'employee_id' => $employee_id[$i],
                        'pay_schedule' => $pay_schedule[$i],
                        'hour_limit' => $hour_limit[$i],
                        'working_hours' => $working_hours[$i],
                        'hourly_allowance' => $hourly_allowance[$i],
                        'available_hour' => $available_hour[$i],
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => '1',
                    );
                    
                }        
            }
      
            if(!empty($data))
            {
                $res = $this->db->insert_batch('main_accrual_leave_track', $data);
            }
            if(!empty($udata))
            {
                $res = $this->db->update_batch('main_accrual_leave_track', $udata, 'id');
            }
            
            if($flag==0)
            {
                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
            }
            else {
                return TRUE;
            }
        
        }
    }
    
    public function edit_Accrual_Leave_Track_Payroll($flag=0) {
        
        $this->form_validation->set_rules('pay_period_from', 'Pay Period From', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('pay_period_to', 'Pay Period TO', 'required',array('required'=> "Please the enter required field, for more Info : %s.")); 
        $this->form_validation->set_rules('working_hours[]', 'Working Hours', 'required|numeric|xss_clean',array('required'=> "Please the enter required field, for more Info : %s.")); 
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } else {
            
            $employee_id=$this->input->post('employee_id');
            $pay_schedule=$this->input->post('pay_schedule');
            $hour_limit= $this->input->post('hour_limit');
            $working_hours= $this->input->post('working_hours');
            $hourly_allowance= $this->input->post('hourly_allowance');
            $available_hour= $this->input->post('available_hour');

            $count = count($employee_id);
            
            for ($i = 0; $i < $count; $i++) {
                
                $udata[$i] = array('id' => $this->input->post('update_id'),
                    'company_id' => $this->company_id,
                    //'employee_id' => $employee_id[$i],
                    'leave_track_by' => $this->input->post('leave_track_by'),
                    'pay_period_from' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_from')),
                    'pay_period_to' => $this->Common_model->convert_to_mysql_date($this->input->post('pay_period_to')),
                    //'pay_schedule' => $pay_schedule[$i],
                    'hour_limit' => $hour_limit[$i],
                    'working_hours' => $working_hours[$i],
                    'hourly_allowance' => $hourly_allowance[$i],
                    'available_hour' => $available_hour[$i],
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
              
            }
            
            if(!empty($udata))
            {
                $res = $this->db->update_batch('main_accrual_leave_track', $udata, 'id');
            }

            if($flag==0)
            {
                if ($res) {
                    echo $this->Common_model->show_massege(2,1);
                } else {
                    echo $this->Common_model->show_massege(3,2);
                }
            }
            else
            {
                return TRUE;
            }
        }
    }
    
    public function get_employee_pto($employee_id, $working_hours, $leave_type) {
        if ($employee_id != '') {
            if ($this->user_group == 12) {
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('leave_code, paid_leave_type, available_limit, main_pto_settings.id AS mstID');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_pto_settings.company_id', $this->company_id);
                $this->db->where('main_pto_settings.paid_leave_type', $leave_type);
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            } else {
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('leave_code, paid_leave_type, available_limit, main_pto_settings.id AS mstID');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_pto_settings.paid_leave_type', $leave_type);
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            }

            //return $this->db->last_query();
            //exit();

            $i = 0;
            //$Allowance = 80; // Temporary
            $Allowance = $working_hours;

            $output = '';

            foreach ($pto_leave_data as $row) {
                $availableLIMIT = $Earned = "";

                $SingleRow = $this->db->query("SELECT ( {$Allowance} * `hourly_allowance` ) AS Earned, available_limit AS availableLIMIT FROM main_pto_settings_details WHERE {$Working_Years} >= `graduated_form` AND {$Working_Years} <= `graduated_to` AND `mst_id`={$row->mstID}")->row();
                if (!empty($SingleRow)) {
                    $availableLIMIT = $SingleRow->availableLIMIT;
                    $Earned = $SingleRow->Earned;
                    //pr($SingleRow);
                }
                //echo $this->db->last_query();

                $Enjoyed_Hour = $this->db->query("SELECT SUM(`approved_hours`) AS `Enjoyed_Hour` FROM main_pto_transaction WHERE `employee_id`={$employee_id} AND `leave_type`={$row->paid_leave_type}")->row('Enjoyed_Hour');
                if ($Enjoyed_Hour == '' || $Enjoyed_Hour == NULL) {
                    $Enjoyed_Hour = 0;
                }

                if ($availableLIMIT == "")
                    $availableLIMIT = 0;
                $output .= '<tr>';
                $output .= '<td>' . ++$i . '</td>';
                $output .= '<td>' . $row->leave_code . '</td>';
                $output .= '<td>' . $availableLIMIT . '</td>';
                $output .= '<td>' . round($Earned, 2) . '</td>';

                if (($Earned) > ($availableLIMIT)) {
                    $Available_Hour = round($availableLIMIT, 2);
                } else {
                    $Available_Hour = round($Earned, 2);
                }

                $output .= '<td>' . $Available_Hour . '</td>';
                $output .= '<td>' . $Enjoyed_Hour . '</td>';
                $output .= '<td><span class="paid_leave_type_' . $row->paid_leave_type . '">' . round(($Available_Hour - $Enjoyed_Hour), 2) . '</span></td>';
                $output .= '</tr>';

                $data[$i] = array('company_id' => $this->company_id,
                    'employee_id' => $employee_id,
                    'leave_track_by' => $this->input->post('leave_track_by'),
                    'leave_type' => $row->paid_leave_type,
                    //'leave_code' => $row->leave_code,
                    'working_hour' => $working_hours,
                    'available_limit' => $availableLIMIT,
                    'earned_houre' => round($Earned, 2),
                    'available_hour' => $Available_Hour,
                    'used_hour' => $Enjoyed_Hour,
                    'balance' => round(($Available_Hour - $Enjoyed_Hour), 2),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
            }
            // pr($data);
            //$res=FALSE;

            if (!empty($data)) {
                $this->db->update('main_emp_accrual_leave', array('isactive' => 0), array('employee_id' => $employee_id, 'leave_type' => $leave_type));

                $res = $this->db->insert_batch('main_emp_accrual_leave', $data);
            }

            if ($res) {
                return TRUE;
            } else {
                return FALSE;
            }

            //print_r($data);
            //return $output;
            //return $output;
        }
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
       // $this->Common_model->delete_by_id("main_employeeleavetypes", $id);
        //redirect('Con_LeaveTypes/');
        exit;
    }

    function get_pay_schedule(){
        
        $employee_id=$this->uri->segment(3);
        $query = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id))->row();
        if(!empty($query))
        {
            echo $query->wages;
        }
    }
    
}
