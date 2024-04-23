<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Attendence_Upload extends CI_Controller {

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
        $param['page_header'] = "Attendence Upload";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'attendance/view_attendance_upload.php';
        $this->load->view('admin/home', $param);
    }

    public function Attendence_file_Upload() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        if ($status != "error") {
            $config['upload_path'] = './uploads/attendence_file/';
            $config['allowed_types'] = 'csv|xlsx|xls|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;

            $newFileName = $_FILES[$file_element_name]['name'];
            if ($newFileName) {
                $fileExt = explode(".", $newFileName);
                //$filename = time() . "." . $fileExt[1];
                $filename = "att_file" . "." . $fileExt[1];
                $config['file_name'] = $filename;

                $files = glob('uploads/attendence_file/*'); // get all file names
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

    public function save_Attendence_Upload() {

        $this->form_validation->set_rules('upload_file_type', 'File Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('attendance_file_name', 'Upload File', 'required', array('required' => "Please Upload File, For more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $common_data = array('company_id' => $this->company_id,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
            );
            
            if ($this->input->post('upload_file_type') == 1) {//CSV
                
                $this->load->model('Csv_model');
                $this->load->library('csvimport');
        
                $file_path = './uploads/attendence_file/' . $this->input->post('attendance_file_name');
                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);
                    
                    $emp_basic_data=array();
                    $k=0;
                    foreach ($csv_array as $row) {

                        $data[$k] = array(
                            'employee_id' => $row['employee_id'],
                            'attendance_date' => $this->Common_model->csv_to_mysql_date($row['attendance_date']),
                            'in_time' => $row['in_time'],
                            'out_time' => $row['out_time'],
                            'duration' => $row['duration'],
                            'isactive' => 1,
                        );
                        
                        $emp_basic_data[$k]=  array_merge($data[$k],$common_data);
                        
                        $k++;
                    }
                   // pr($emp_basic_data,1);
                    $flag=0;
                    if(!empty($emp_basic_data))
                    {
                        $res = $this->db->insert_batch('main_attendance', $emp_basic_data);
                        if($res)
                        {
                            $flag=1;
                        }
                        else
                        {
                            $flag=0;
                        }
                    }
                    
                    //pr($row,1);
                    
                    if ($flag == 1) {
                        echo $this->Common_model->show_validation_massege('Attendence Imported Succesfully.', 1);
                    } else {
                        echo $this->Common_model->show_validation_massege("Data Import Not Succesfully", 2);
                    }
                    
                } else {
                    echo $this->Common_model->show_validation_massege('Error occured.', 2);
                }
            }
            else if ($this->input->post('upload_file_type') == 2) {//Excel
                
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
                
            }
            else if ($this->input->post('upload_file_type') == 3) {//text
                
                echo $this->Common_model->show_validation_massege('Attendence Imported Succesfully.', 1);
            }
        }
    }

    //==========================================================================
    
    public function download_temeplete() {
        $filename="attendance_temeplete.csv";
        if ($filename != "") {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/' . $filename));
            $url = Get_File_Directory('/uploads/' . $filename);
            $data = file_get_contents($url);
            force_download($filename, $data);
        }
    }
    
    //==========================================================================
    
}
