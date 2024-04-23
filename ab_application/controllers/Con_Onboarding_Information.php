<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Onboarding_Information extends CI_Controller {

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
    
    public $employee_id;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];
        
        $this->load->model('Sendmail_model');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header']="Onboarding Information";
        $param['module_id']=$this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Onboarding_Information.php';
        $this->load->view('admin/home', $param);
    }

    public function save_hired_ob_employee(){
        $this->form_validation->set_rules('date_of_joining', 'Date of Joining', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $ob_emp_id = $this->input->post('hired_emp_id');
            if ($this->Common_model->unique_check("onboarding_id", $ob_emp_id, "main_employees") == true) {
                echo $this->Common_model->show_validation_massege('The onboarding id field must contain a unique value.', 2);
                exit();
            }

            $this->employee_id = $this->Common_model->return_next_id('id', 'main_employees');
            if ($this->Common_model->unique_check("employee_id", $this->employee_id, "main_employees") == true) {
                echo $this->Common_model->show_validation_massege('The Employee ID field must contain a unique value.', 2);
                exit();
            }

            $date_of_joining=$this->input->post('date_of_joining');
            $data = array('onboarding_employee_id' => $ob_emp_id,
                'status' => 2,
                'date_of_joining' => $this->Common_model->convert_to_mysql_date($date_of_joining),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );
            $res1 = $this->Common_model->update_data('main_ob_send_mail', $data, array('onboarding_employee_id' => $ob_emp_id));
        
            $res3=$this->ob_data_transfer($this->employee_id,$ob_emp_id,$date_of_joining);
            
            if($res3)
            {
                //==================================================================
                $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_lastname,a.onboarding_socialsecuritynumber,b.email_address
                    FROM main_ob_personal_information as a JOIN main_ob_contact_information as b ON 
                    a.onboarding_employee_id = b.onboarding_employee_id 
                    WHERE a.onboarding_employee_id=" . $ob_emp_id . " group by a.onboarding_employee_id";
                $prquery = $this->db->query($sql);
                //echo $this->db->last_query();exit();
                $firstname = "";
                $socialsecuritynumber = "";
                $email_address = "";
                if ($prquery) {
                    foreach ($prquery->result() as $prrow) {
                        $firstname = $prrow->onboarding_firstname;
                        $socialsecuritynumber = $prrow->onboarding_socialsecuritynumber;
                        $email_address = $prrow->email_address;
                    }
                }

                $res2 = $this->Sendmail_model->ob_hired_send_mail($firstname, $socialsecuritynumber, $email_address, $date_of_joining);

                //==================================================================
            }
            
            
            if ($res1 && $res3) {
                echo $this->Common_model->show_massege(8, 1);
            } else {
                echo $this->Common_model->show_massege(9, 2);
            }
            
        }
         
    }
    
    public function ob_data_transfer($employee_id, $ob_emp_id, $date_of_joining) {

        $this->employee_id=$employee_id;
        
        if ($this->employee_id && $ob_emp_id) {
            
            $this->db->where('onboarding_employee_id', $ob_emp_id);
            $row = $this->db->get('main_ob_personal_information')->row();
            $this->db->insert('main_employees', array('employee_id' => $this->employee_id, 'onboarding_id' => $row->onboarding_employee_id, 'company_id' => $row->company_id, 'first_name' => $row->onboarding_firstname, 'middle_name' => $row->onboarding_middlename, 'last_name' => $row->onboarding_lastname, 'birthdate' => $row->onboarding_dateofbirth, 'ssn_code' => $row->onboarding_socialsecuritynumber, 'suffix' => $row->onboarding_suffix, 'gender' => $row->gender, 'marital_status' => $row->marital_status, 'hire_date' => $this->Common_model->convert_to_mysql_date($date_of_joining),'emp_user_id' => $row->createdby ));

            $this->db->where('onboarding_employee_id', $ob_emp_id);
            $row1 = $this->db->get('main_ob_contact_information')->row();
            $this->db->update('main_employees', array('email' => $row1->email_address, 'home_phone' => $row1->home_phone, 'mobile_phone' => $row1->mobile_phone,'work_phone' => $row1->work_phone,'first_address' => $row1->street_address1, 'second_address' => $row1->street_address2, 'county' => $row1->county, 'city' => $row1->city, 'state' => $row1->state, 'zipcode' => $row1->zipcode),array('employee_id' => $this->employee_id));

            $this->db->where('onboarding_employee_id', $ob_emp_id);
            $row2 = $this->db->get('main_ob_emergencycontact')->row();
            $this->db->insert('main_emp_emergencycontact', array('employee_id' => $this->employee_id, 'onboarding_id' => $row2->onboarding_employee_id, 'company_id' => $row2->company_id, 'first_name' => $row2->first_name, 'last_name' => $row2->last_name, 'relationship' => $row2->relationship_with_employee, 'phone' => $row2->primary_phone, 'mobile' => $row2->secondary_phone, 'first_address' => $row2->address));

            //==================================================================
            
            $this->db->where('onboarding_employee_id', $ob_emp_id);
            $row3 = $this->db->get('main_ob_employmenthistory');

            if ($row3) {
                $i = 0;
                foreach ($row3->result() as $hrow) {
                    $data[$i] = array(
                        'company_id' => $this->company_id,
                        'employee_id' => $this->employee_id,
                        'onboarding_id' => $hrow->onboarding_employee_id,
                        'comp_name' => $hrow->employer,
                        'emp_position' => $hrow->position,
                        'from_date' => $hrow->start_date,
                        'to_date' => $hrow->end_date,
                        'reason_for_leaving' => $hrow->reason_for_leaving,
                        'contact_employee' => $hrow->contact_employee
                    );
                    $i++;
                }

                $tres = $this->db->insert_batch('main_emp_experience', $data);
            }
            
            //==================================================================
            
            $this->db->where('onboarding_employee_id', $ob_emp_id);
            $row4 = $this->db->get('main_ob_education');

            if ($row4) {
                $i = 0;
                foreach ($row4->result() as $erow) {
                    $edata[$i] = array(
                        'company_id' => $this->company_id,
                        'employee_id' => $this->employee_id,
                        'onboarding_id' => $erow->onboarding_employee_id,
                        'educationlevel' => $erow->educationlevel,
                        'institution_name' => $erow->institution_name,
                        'no_of_years' => $erow->no_of_years,
                        'edu_remarks' => $erow->edu_remarks
                    );
                    $i++;
                }

                $eres = $this->db->insert_batch('main_emp_education', $edata);
            }
            
            //==================================================================
            
             //==================================================================
            
            $this->db->where('onboarding_employee_id', $ob_emp_id);
            $row5 = $this->db->get('main_ob_company_policies');

            if ($row5) {
                $i = 0;
                foreach ($row5->result() as $prow) {
                    $pdata[$i] = array(
                        'company_id' => $this->company_id,
                        'employee_id' => $this->employee_id,
                        'onboarding_id' => $prow->onboarding_employee_id,
                        'policy_id' => $prow->policy_id,
                        'is_aggree' => $prow->is_aggree
                    );
                    $i++;
                }

                $pres = $this->db->insert_batch('main_emp_company_policies', $pdata);
            }
            
            //==================================================================
            
            //==================================================================
            
            $udata = array('company_id' => $this->company_id,
                'email' => $row1->email_address,
                'name' => $row->onboarding_firstname,
                // 'password' => $this->Common_model->encrypt('123456'),
                'password' => md5('123456'),
                'phone_no' => $row1->mobile_phone,
                'user_group' => '10',
                'user_type' => '1',
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1,
            );

            $ures = $this->Common_model->insert_data('main_users', $udata);
            $emp_user_id = $this->db->insert_id();

            $upres = $this->Common_model->update_data('main_employees', array('emp_user_id' => $emp_user_id), array('employee_id' => $this->employee_id));

            //==================================================================
            
            return TRUE;
            
        } else {
            return FALSE;
        }
    }

    public function view_od_data($ob_id) {
       
        $param['menu_id']=$this->menu_id;
        $param['page_header']="View Onboarding Information";
        $param['module_id']=$this->module_id;
        $param['ob_emp_id']=$ob_id;
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Onboarding_data.php';
        $this->load->view('admin/home', $param);
    }
    
    public function reject_od_employee() {
        
        $this->form_validation->set_rules('reject_reason', 'Reject Reason', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else {
               $data = array('reject_reson' => $this->input->post('reject_reason'),
                   'status' => 3,
                   'createdby' => $this->user_id,
                   'createddate' => $this->date_time,
                   'isactive' => 1,
               );
               $res = $this->Common_model->update_data('main_ob_send_mail', $data, array('onboarding_employee_id' => $this->input->post('reject_emp_id')));

               if ($res) {
                   echo $this->Common_model->show_massege(10, 1);
               } else {
                   echo $this->Common_model->show_massege(11, 2);
               }
     
        }
       
        
    }
    

}
