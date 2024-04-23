<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employee_Import extends CI_Controller {

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
        
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Advance Upload";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Employee_Import.php';
        $this->load->view('admin/home', $param);
    }

    public function emp_file_Upload() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        if ($status != "error") {
            $config['upload_path'] = './uploads/employee_file/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;

            $newFileName = $_FILES[$file_element_name]['name'];
            if ($newFileName) {
                $fileExt = explode(".", $newFileName);
                //$filename = time() . "." . $fileExt[1];
                $filename = $this->company_id."_emp_file" . "." . $fileExt[1];
                $config['file_name'] = $filename;

                $files = glob('uploads/employee_file/'.$filename); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
                        //unlink($_FILES[$filename]); // delete file
                }
            }

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $file_path = $data['file_path'];
                $file_name = $data['file_name'];
                if (file_exists($file_path)) {
                    $status = "success";
                    $msg = "File Successfully uploaded";
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }

        if ($status == "success") {
            echo $this->Common_model->show_validation_massege($msg, 1) . "__" . $file_name;
        } else {
            echo $this->Common_model->show_validation_massege($msg, 2);
        }
    }

    public function view_uploaded_employee_data() {

        $this->form_validation->set_rules('upload_file_type', 'File Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('emp_file_name', 'Upload File', 'required', array('required' => "Please Upload File, For more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $common_data = array('company_id' => $this->company_id,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
            );

            if ($this->input->post('upload_file_type') == 1) { //CSV
                $this->load->model('Csv_model');
                $this->load->library('Csvimport');

                $file_path = './uploads/employee_file/' . $this->input->post('emp_file_name');
                if ($this->csvimport->get_array($file_path)) {
                    $param['csv_array'] = $this->csvimport->get_array($file_path);
                    //$column_headers = $this->csvimport->get_array($column_headers);
                    
                    //pr($this->csvimport->get_array($file_path));
                    
                    $param['emp_file_name'] = $this->input->post('emp_file_name');
                    $param['upload_file_type'] = $this->input->post('upload_file_type');
                    $param['table_colum_array'] = array('import_employee_id' => 'Employee ID','ssn_code' => 'SSN', 'first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name', 'first_address' => 'Address 1', 'second_address' => 'Address 2','city' => 'City', 'state'=> 'State', 'zipcode' => 'Zip Code', 'gender' => 'Gender','marital_status' => 'Marital Status','position' => 'Position', 'birthdate' => 'Date of Birth','hire_date' => 'Hire Date','review_date' => 'Review Date','termination_date' => 'Termination Date','w_4_date' => 'W-4 Date','i_9_date' => 'I-9 Date','email' => 'Email','isactive' => 'Status','wages' => 'Pay Schedule','salary_type' => 'Salary Type/Pay Type','salary' => 'Salary','per_hour_rate' => 'Rate','ot_hour' => 'OT Hours','ot_rate' => 'OT Rate','dt_hour' => 'DT Hour','dt_rate' => 'DT Rate','location' => 'Location','department' => 'Department','employee_type' => 'Employee Type','exempt' => 'Exempt','officer' => 'Officer','seasonal' => 'Seasonal','statutory' => 'Statutory','pension_plan' => 'Pension Plan');

                    $this->menu_id = $this->uri->segment(3);
                    $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

                    $param['menu_id'] = $this->menu_id;
                    $param['page_header'] = "Advance Upload";
                    $param['module_id'] = $this->module_id;

                    $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
                    $param['content'] = 'hr/view_uploaded_employee_data.php';
                    $this->load->view('admin/home', $param);
                } else {
                    echo $this->Common_model->show_validation_massege('Error occured.', 2);
                }
            }
        }
    }

    public function Import_employee() {

        $this->form_validation->set_rules('upload_file_type', 'File Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('emp_file_name', 'Upload File', 'required', array('required' => "Please Upload File, For more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            

            if ($this->input->post('upload_file_type') == 1) {//CSV
                $this->load->model('Csv_model');
                $this->load->library('Csvimport');

                $file_path = './uploads/employee_file/' . $this->input->post('emp_file_name');
                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);

                    $k = 0;
                    $employee_id = "";

                    $data_arr=array();
                    $data_arr2=array();
                    
                    $basic_data=array();
                    $work_data=array();
                    
                    $position=0;
                    $wages=0;
                    $salary_type=0;
                    $per_hour_rate="";
                    $employee_type=0;
                    $location_id=0;
                    $department_id=0;
                    
                    $officer = 0;
                    $seasonal = 0;
                    $statutory = 0;
                    $pension_plan = 0;
                    
                    $this->db->trans_begin();
                    
                    foreach ($csv_array as $key => $row) {

                        $row_array[$k] = array_values($row);
                        
                        if ($employee_id == "") {
                            $employee_id = $this->Common_model->return_next_id('id', 'main_employees');
                        } else {
                            $employee_id = $employee_id + 1;
                        }
                        
                        $common_data = array('company_id' => $this->company_id,
                            'employee_id' => $employee_id,
                            'createdby' => $this->user_id,
                            'createddate' => $this->date_time,
                        );
                        
                        foreach ($row_array as $key) { 
                            foreach ($key as $kk=>$vv) {
                                
                                $input_feald[$kk]=$this->input->post('dropdown_'.$kk);
                                
                                if($this->input->post('dropdown_'.$kk)!="")
                                {
                                    
                                    if($this->input->post('dropdown_'.$kk)=='per_hour_rate')
                                    {
                                        $per_hour_rate=preg_replace('/[^a-zA-Z0-9.]/', '', $vv);
                                    }         
                                    else if($this->input->post('dropdown_'.$kk)=='employee_type')
                                    {
                                        if ($this->Common_model->get_selected_value($this, 'employemnt_status', $vv, 'tbl_employmentstatus', 'id')) {
                                            $employee_type = $this->Common_model->get_selected_value($this, 'employemnt_status', $vv, 'tbl_employmentstatus', 'id');
                                        } else {
                                            $employee_type = 0;
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$employee_type;
                                    }         
                                    else if($this->input->post('dropdown_'.$kk)=='exempt') 
                                    {
                                        $exempt_array = $this->Common_model->get_array('employee_type');
                                        $exempt = array_search($vv, $exempt_array);
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$exempt;
                                    }         
                                    else if($this->input->post('dropdown_'.$kk)=='officer') 
                                    {
                                        if (($vv == 'Yes') || ($vv == 'yes')) {
                                            $officer = 1;
                                        } else {
                                            $officer = 0;
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$officer;
                                    }
                                    else if($this->input->post('dropdown_'.$kk)=='seasonal') 
                                    {
                                        if (($vv == 'Yes') || ($vv == 'yes')) {
                                            $seasonal = 1;
                                        } else {
                                            $seasonal = 0;
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$seasonal;
                                    }     
                                    else if($this->input->post('dropdown_'.$kk)=='statutory') 
                                    {
                                        if (($vv == 'Yes') || ($vv == 'yes')) {
                                            $statutory = 1;
                                        } else {
                                            $statutory = 0;
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$statutory;
                                    }     
                                    else if($this->input->post('dropdown_'.$kk)=='pension_plan') 
                                    {
                                        if (($vv == 'Yes') || ($vv == 'yes')) {
                                            $pension_plan = 1;
                                        } else {
                                            $pension_plan = 0;
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$pension_plan;
                                    }     
                                    else if($this->input->post('dropdown_'.$kk)=='location')
                                    {
                                        if ($this->Common_model->get_selected_value($this, 'location_name', $vv, 'main_location', 'id')) {
                                            $location_id = $this->Common_model->get_selected_value($this, 'location_name', $vv, 'main_location', 'id');
                                        } else {
                                            $location_id = 0;
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$location_id;
                                    }         
                                    else if($this->input->post('dropdown_'.$kk)=='department')
                                    {
                                        $this->db->select('id,department_name');
                                        $this->db->from('main_department');
                                        $this->db->like('department_name', $vv);
                                        $dquery = $this->db->get()->row();
                                        
                                        if(!empty($dquery))
                                        {
                                            if ($dquery->id!="") {
                                                $department_id = $dquery->id;
                                            } else {
                                                $department_id = 0;
                                            }
                                        }
                                        $data_arr2[$k][$this->input->post('dropdown_'.$kk)]=$department_id;
                                    }         
                                    else if($this->input->post('dropdown_' . $kk) == 'salary_type' || $this->input->post('dropdown_' . $kk) == 'wages') {
                                        if ($this->input->post('dropdown_' . $kk) == 'wages') {
                                            if ($this->Common_model->get_selected_value($this, 'freqcode', $vv, 'main_payfrequency_type', 'id')) {
                                                $wages = $this->Common_model->get_selected_value($this, 'freqcode', $vv, 'main_payfrequency_type', 'id');
                                            } else {
                                                $wages = 0;
                                            }
                                            $data_arr2[$k][$this->input->post('dropdown_' . $kk)] = $wages;
                                        } else if ($this->input->post('dropdown_' . $kk) == 'salary_type') {
                                            if (($vv == 'H') || ($vv == 'h')) {
                                                $salary_type = 1;
                                            } else {
                                                $salary_type = 0;
                                            }
                                            $data_arr2[$k][$this->input->post('dropdown_' . $kk)] = $salary_type;
                                        } else {
                                            $data_arr2[$k][$this->input->post('dropdown_' . $kk)] = $vv;
                                        }
                                    } else {
                                        if ($this->input->post('dropdown_' . $kk) == 'position') {
                                            if ($this->Common_model->get_selected_value($this, 'job_title', $vv, 'main_jobtitles', 'id')) {
                                                $position = $this->Common_model->get_selected_value($this, 'job_title', $vv, 'main_jobtitles', 'id');
                                            } else {
                                                $position = 0;
                                            }
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $position;
                                        } else if ($this->input->post('dropdown_' . $kk) == 'state') {
                                            if ($this->Common_model->get_selected_value($this, 'state_abbr', $vv, 'main_state', 'id')) {
                                                $state = $this->Common_model->get_selected_value($this, 'state_abbr', $vv, 'main_state', 'id');
                                            } else {
                                                $state = 0;
                                            }
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $state;
                                        } else if ($this->input->post('dropdown_' . $kk) == 'ssn_code') {
                                            $ssn_code = $this->Common_model->encrypt($vv);
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $ssn_code;
                                        } else if ($this->input->post('dropdown_' . $kk) == 'county') {
                                            if ($this->Common_model->get_selected_value($this, 'county_name', $vv, 'main_county', 'id')) {
                                                $county = $this->Common_model->get_selected_value($this, 'county_name', $vv, 'main_county', 'id');
                                            } else {
                                                $county = 0;
                                            }
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $county;
                                        } else if ($this->input->post('dropdown_' . $kk) == 'gender') {
                                            if ($vv == 'M') {
                                                $gender = 1;
                                            } else if ($vv == 'F') {
                                                $gender = 2;
                                            } else {
                                                $gender = 0;
                                            }
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $gender;
                                        }else if ($this->input->post('dropdown_' . $kk) == 'marital_status') {
                                            $marital_status_array = $this->Common_model->get_array('marital_status');
                                            $marital_status = array_search($vv, $marital_status_array);
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $marital_status;
                                        } else if ($this->input->post('dropdown_' . $kk) == 'birthdate') {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $this->Common_model->csv_to_mysql_date($vv);
                                        } else if ($this->input->post('dropdown_' . $kk) == 'hire_date') {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $this->Common_model->csv_to_mysql_date($vv);
                                        } else if ($this->input->post('dropdown_' . $kk) == 'review_date') {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $this->Common_model->csv_to_mysql_date($vv);
                                        } else if ($this->input->post('dropdown_' . $kk) == 'termination_date') {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $this->Common_model->csv_to_mysql_date($vv);
                                        } else if ($this->input->post('dropdown_' . $kk) == 'w_4_date') {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $this->Common_model->csv_to_mysql_date($vv);
                                        } else if ($this->input->post('dropdown_' . $kk) == 'i_9_date') {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $this->Common_model->csv_to_mysql_date($vv);
                                        } else if ($this->input->post('dropdown_' . $kk) == 'isactive') {
                                            if ($vv == 'Yes' || $vv == 'YES' || $vv == 'Active') {
                                                $status = 1;
                                            } else {
                                                $status = 0;
                                            }
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $status;
                                        } else {
                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
                                        }
                                        
//                                        else if ($this->input->post('dropdown_' . $kk) == 'email') {
//                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
//                                        } else if ($this->input->post('dropdown_' . $kk) == 'ot_hour') {
//                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
//                                        } else if ($this->input->post('dropdown_' . $kk) == 'ot_rate') {
//                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
//                                        } else if ($this->input->post('dropdown_' . $kk) == 'dt_hour') {
//                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
//                                        } else if ($this->input->post('dropdown_' . $kk) == 'dt_rate') {
//                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
//                                        } else if ($this->input->post('dropdown_' . $kk) == 'salary') {
//                                            $data_arr[$k][$this->input->post('dropdown_' . $kk)] = $vv;
//                                        }
                                        
                                        
                                    }
                                }
                                
                            }
                        }
                        
                        //pr($data_arr,1);
                        
                        if ($per_hour_rate != "") {
                            $wage_houre = $this->Common_model->get_name($this, $wages, 'main_payfrequency_type', 'wage_houre');
                            $this->Common_model->employee_wage_compensation($this, $employee_id, $position, $wages, $wage_houre, $salary_type, $per_hour_rate);
                        }

                        if (!empty($data_arr)) {
                            $basic_data[$k] = array_merge($data_arr[$k], $common_data);
                        }

                        if (!empty($data_arr2)) {
                            $work_data[$k] = array_merge($data_arr2[$k], $common_data);
                        }

                        $k++;
                    }

                    //pr($wage_com_data,1);
                    //pr($basic_data,1);
                    //pr($work_data,1);
                    //pr($input_feald,1);
                    
                    $flag=0;
                    if(!empty($basic_data))
                    {
                        $res = $this->db->insert_batch('main_employees', $basic_data);
                    }
                    else {
                        $res=0;
                    }
                    
                    if($res>0)
                    {
                        $flag=1;
                        if(!empty($work_data))
                        {
                            //pr($work_data);
                            $wres = $this->db->insert_batch('main_emp_workrelated', $work_data);
                        }
                    }
                    
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $flag = 0;
                    } else {
                        $this->db->trans_commit();
                        $flag = 1;
                    }
                    
                    if ($flag) {
                        //echo $this->Common_model->show_massege(0, 1);
                        echo $this->Common_model->show_validation_massege("Data Import Succesfully. You Have Imported " . $k . " Employee.", 1);
                    } else {
                        //echo $this->Common_model->show_massege(1, 2);
                        echo $this->Common_model->show_validation_massege("Data Import Not Succesfully", 2);
                    }

                    // print_r($row_array);
                    // echo $this->Common_model->show_validation_massege('Attendence Imported Succesfully.', 1);
                } else {
                    echo $this->Common_model->show_validation_massege('Error occured.', 2);
                }
            } else if ($this->input->post('upload_file_type') == 2) {//Excel
                $this->load->library('PHPExcel');
                $file_path = './uploads/attendence_file/' . $this->input->post('attendance_file_name');

                $objPHPExcel = PHPExcel_IOFactory::load($file_path);
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    echo $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                    //header will/should be in row 1 only. 
                    if ($row == 1) {
                        $header[$row][$column] = $data_value;
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }
                    echo "<br><br>";
                    echo "\n";
                }
                //var_dump($arr_data);

                echo $this->Common_model->show_validation_massege('Attendence Imported Succesfully.', 1);
            } else if ($this->input->post('upload_file_type') == 3) {//text
                echo $this->Common_model->show_validation_massege('Attendence Imported Succesfully.', 1);
            }
        }
    }

    //==========================================================================
    
    public function get_csv_data($row_array,$input_feald){
        
    }
}
