<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Quick_upload extends CI_Controller {

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

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Quick Upload";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_quick_upload.php';
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
                $filename = "emp_file" . "." . $fileExt[1];
                $config['file_name'] = $filename;

                $files = glob('uploads/employee_file/*'); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
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

    public function Import_employee() {

        $this->form_validation->set_rules('upload_file_type', 'File Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('emp_file_name', 'Upload File', 'required', array('required' => "Please Upload File, For more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $common_data = array('company_id' => $this->company_id,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
            );

            if ($this->input->post('upload_file_type') == 1) {//CSV
                $this->load->model('Csv_model');
                $this->load->library('Csvimport');

                //==============================================================
                
                $tmp_file_path = './uploads/csv_temeplete.csv';
                if ($this->csvimport->get_array($tmp_file_path)) {
                    $tmp_csv_array = $this->csvimport->get_array($tmp_file_path);
                    if(!empty($tmp_csv_array))
                    {
                        foreach ($tmp_csv_array as $tmp_key => $tmp_row) {

                        }
                    }
                }
                
                //==============================================================
                
                $file_path = './uploads/employee_file/' . $this->input->post('emp_file_name');
                
                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);
                   
                    $k = 0;
                    $employee_id="";
                    foreach ($csv_array as $key => $row) {
                        
                        foreach ($tmp_row as $kkkk => $roww) {
                            if (!array_key_exists($kkkk, $row)) {
                                echo $this->Common_model->show_validation_massege("Template Do Not Match. ". $kkkk . " Column Does Not Exist. " , 2);
                                exit();
                            }
                        }
                        
                        $row_array[$k] = array_values($row);
                    //==========================================================   
                        if ($employee_id == "") {
                            $employee_id = $this->Common_model->return_next_id('id', 'main_employees');
                        } else {
                            $employee_id = $employee_id + 1;
                        }

                        if ($this->Common_model->get_selected_value($this, 'state_abbr', $row['State'], 'main_state', 'id')) {
                            $state = $this->Common_model->get_selected_value($this, 'state_abbr', $row['State'], 'main_state', 'id');
                        } else {
                            $state = 0;
                        }

                        if ($this->Common_model->get_selected_value($this, 'county_name', $row['County'], 'main_county', 'id')) {
                            $county = $this->Common_model->get_selected_value($this, 'county_name', $row['County'], 'main_county', 'id');
                        } else {
                            $county = 0;
                        }
                        
                        if ($row['Gender'] == 'M') {
                            $gender = 1;
                        } else if ($row['Gender'] == 'F') {
                            $gender = 2;
                        } else {
                            $gender = 0;
                        }


                        $data[$k] = array(
                            'employee_id' => $employee_id,
                            'import_employee_id' => $row['Employee #'],
                            'ssn_code' =>$this->Common_model->encrypt($row['SSN']),
                            'first_name' => $row['First Name'],
                            'middle_name' => $row['Middle Initial'],
                            'last_name' => $row['Last Name'],
                            'first_address' => $row['Address 1'],
                            'second_address' => $row['Address 2'],
                            'city' => $row['City'],
                            'state' => $state,
                            'zipcode' => $row['Zip'],
                            'county' => $county,
                            'gender' => $gender,
                            'birthdate' => $this->Common_model->csv_to_mysql_date($row['Date of Birth']),
                            'email' => $row['E-Mail'],
                            'hire_date' => $this->Common_model->csv_to_mysql_date($row['Hire Date']),
                            'isactive' => 1,
                        );
                        
                        $emp_basic_data[$k]=  array_merge($data[$k],$common_data);
                        
                        //======================================================
                        
                        if ($this->Common_model->get_selected_value($this, 'department_name', $row['Dept Code'], 'main_department', 'id')) {
                            $department = $this->Common_model->get_selected_value($this, 'department_name', $row['Dept Code'], 'main_department', 'id');
                        } else {
                            $department = 0;
                        }
                        
                        if ($this->Common_model->get_selected_value($this, 'freqcode', $row['Pay Schedule'], 'main_payfrequency_type', 'id')) {
                            $wages = $this->Common_model->get_selected_value($this, 'freqcode', $row['Pay Schedule'], 'main_payfrequency_type', 'id');
                        } else {
                            $wages = 0;
                        }
                        
                        $wdata[$k] = array(
                            'employee_id' => $employee_id,
                            'department' => $department,
                            'wages' => $wages,
                        );
                        
                        $emp_workrelated_data[$k]=  array_merge($wdata[$k],$common_data);
                        
                        $k++;
                    }
                    
                    $res = $this->db->insert_batch('main_employees', $emp_basic_data);
                    $wres = $this->db->insert_batch('main_emp_workrelated', $emp_workrelated_data);
                    
                    if ($res) {
                        //echo $this->Common_model->show_massege(0, 1);
                        echo $this->Common_model->show_validation_massege("Data Import Succesfully. You Have Imported ". $k ." Employee.", 1);
                    } else {
                        //echo $this->Common_model->show_massege(1, 2);
                        echo $this->Common_model->show_validation_massege("Data Import Not Succesfully", 2);
                    }
                    
                    //print_r($row_array);
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
    
    
    public function download_temeplete() {
        $filename="csv_temeplete.csv";
        if ($filename != "") {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/' . $filename));
            $url = Get_File_Directory('/uploads/' . $filename);
            $data = file_get_contents($url);
            force_download($filename, $data);
        }
    }
    
    
}
