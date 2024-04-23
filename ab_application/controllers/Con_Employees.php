<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Employees extends CI_Controller {

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
    public $companyView = false;

    public function __construct()
    {
        parent::__construct();
        
        $noteSize = $this->session->userdata( 'note_size' );
        
        if( is_null( $noteSize ) )
        {
        	// 			echo "<script>console.error('noteSize is: null' );</script>";
        	
        	$sql		= "SELECT COLUMN_NAME,DATA_TYPE,MAX(CHARACTER_MAXIMUM_LENGTH) AS MAX_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE DATA_TYPE='varchar' AND TABLE_NAME='main_notes' AND COLUMN_NAME='note' AND TABLE_SCHEMA='hrcsoftc_us_hrm'";
        	$query		= $this->db->query( $sql );
        	$row		= $query->result()[0];
        	$noteSize	= $row->MAX_LENGTH;
        	
        	$this->session->set_userdata( 'note_size', $noteSize );
        	
        	// 			echo "<script>console.error('notes :', '". json_encode( $row, true ) ."' );</script>";
        }
        
        // 		echo "<script>console.error('noteSize is:', $noteSize );</script>";
        
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

        $this->load->model('Sendmail_model');
    }

    public function index($show_result = FALSE, $search_ids="", $search_criteria = array('isactive' => '')) {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        //echo "=====".$this->Common_model->generate_hrm_password();
        $this->session->unset_userdata('employee');
        $noteSize = $this->session->userdata( 'note_size' );
        
        $this->initPage		( $param );
        
        $param['note_size'] = $noteSize;

//         $param['menu_id'] = $this->menu_id;
//         $param['page_header'] = "Employee Details";
//         $param['module_id'] = $this->module_id;
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;

        $param['status_array'] = $this->Common_model->get_array('status');
        $param['marital_status_array'] = $this->Common_model->get_array('marital_status');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_employees.php';
        $this->load->view('admin/home', $param);
    }
    
    public function get_search_employee() {
        $isactive = $this->uri->segment(3);
        $ids = $search_criteria = array();
        $search_criteria['isactive'] = $isactive = $isactive;
        $ids = $isactive;
        $this->index(TRUE, $ids, $search_criteria);
    }

    public function add_employees() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $emp_sess_array = array('employee_id' => "");
        $this->session->set_userdata('employee', $emp_sess_array);
        
        $this->initPage		( $param );
        
//         $param['menu_id'] = $this->menu_id;
//         $param['page_header'] = "Employee Details";
//         $param['module_id'] = $this->module_id;
        $param['type'] = "1";
        $param['page_id'] = 'add_employees';

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addEmployees.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Employees() {
        
        require_once( 'assets/slimimage/server/slim.php');
        $images = Slim::getImages('slim');
        //$signature = Slim::getImages('signature');

        $this->form_validation->set_rules('first_name', 'First name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('last_name', 'Last name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('address1', 'Primary Address', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('ssn_code', 'SSN', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('hire_date', 'Hire Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[main_employees.email]', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('email', 'Email', 'is_unique[main_users.email]', array('required' => "Please the enter required field, for more Info : %s."));

        //if ($this->form_validation->run() == FALSE) {
        //    echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        //} else {
            $return_name = ucwords($this->input->post('first_name')) . " " . ucwords($this->input->post('middle_name')) . " " . ucwords($this->input->post('last_name'));
            
            if ($this->input->post('employee_id') == "") {
                
                $this->db->trans_begin();

                $employee_id = $this->Common_model->return_next_id('id', 'main_employees');
                
                if ($images) {
                    $emp_image = $employee_id;
                } else {
                    $emp_image = "";
                }


                $data = array('employee_id' => $employee_id,
                    'company_id' => $this->company_id,
                    'salutation' => $this->input->post('salutation'),
                    'position' => $this->input->post('position'),
                    'home_phone' => $this->input->post('home_phone'),
                    'first_name' => $this->input->post('first_name'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    'middle_name' => $this->input->post('middle_name'),
                    'work_phone' => $this->input->post('work_phone'),
                    'card_no' => $this->input->post('card_no'),
                    'last_name' => $this->input->post('last_name'),
                    'ext' => $this->input->post('ext'),
                    'suffix' => $this->input->post('suffix'),
                    'email' => $this->input->post('email'),
                    'county' => $this->input->post('county'),
                    'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                    'first_address' => $this->input->post('address1'),
                    'probation_start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('probation_start')),
                    'second_address' => $this->input->post('address2'),
                    'probation_days' => $this->input->post('probation_days'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode'),
                    'ssn_code' => $this->Common_model->encrypt($this->input->post('ssn_code')),
                    'marital_status' => $this->input->post('marital_status'),
                    'gender' => $this->input->post('gender'),
                    'birthdate' => $this->Common_model->convert_to_mysql_date($this->input->post('birthdate')),
                    'review_date' => $this->Common_model->convert_to_mysql_date($this->input->post('review_date')),
                    'termination_date' => $this->Common_model->convert_to_mysql_date($this->input->post('termination_date')),
                    'transportation' => $this->input->post('transportation'),
                    'contact_via_email' => $this->input->post('contact_via_email'),
                    'contact_via_text' => $this->input->post('contact_via_text'),
                    'image_name' => $emp_image,
                    'emp_signature' => $this->input->post('scanvasData'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => $this->input->post('status'),
                );
                
                //pr($data,1);

                $res = $this->Common_model->insert_data('main_employees', $data);
                
                $apidata = array('EmployeeCode' => sprintf("%07d", $employee_id),
                    'FirstName' => $this->input->post('first_name'),
                    'MiddleName' => $this->input->post('middle_name'),
                    'LastName' => $this->input->post('last_name'),
                    'Designation' => $this->Common_model->get_name($this,$this->input->post('position'), 'main_jobtitles', 'job_title'),
                    'Phone' => $this->input->post('mobile_phone'),
                    'Email' => $this->input->post('email'),
                    'StartDate' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                    //'EndDate' => date('YYYY-MM-DD',strtotime($this->input->post('termination_date'))),
                    //'Identifiers' =>  array('Id' => sprintf("%07d", $employee_id)),
                    //'InitialPassword' => '12341234Hrms',
                    );
                
                //pr($apidata);
                
                $apidata = json_encode($apidata);
                
                if ($images) {
                    foreach ($images as $image) {
                        //$fileExt = explode(".", $image['input']['name']);
                        //$imgfilename = $employee_id.".".$fileExt[1];
                        //@unlink($_FILES[$employee_id]);
                        $file = Slim::saveFile($image['output']['data'], $employee_id, 'uploads/emp_image', false);
                    }
                }
                
                //echo $sdata=$this->input->post('scanvasData');
                
                //list($type, $sdata) = explode(';', $sdata);
                //list(, $sdata)      = explode(',', $sdata);
                //$sdata = base64_decode($sdata);
                //file_put_contents(base_url().'uploads/emp_signature/image.png', $sdata);
                

//                if ($signature) {
//                    foreach ($signature as $sign) {
//                        $signaturefileExt = explode(".", $sign['input']['name']);
//                        $signatureimgfilename = $employee_id . "." . $signaturefileExt[1];
//                        @unlink($_FILES[$signatureimgfilename]);
//                        $file = Slim::saveFile($sign['output']['data'], $signatureimgfilename, 'uploads/emp_signature', false);
//                    }
//
//                    $signres = $this->Common_model->update_data('main_employees', array('signature' => $signatureimgfilename), array('employee_id' => $employee_id));
//                }
                
                $gpass=$this->Common_model->generate_rand_password();
                // $cpass=$this->Common_model->encrypt($gpass);
                $cpass = md5($gpass);

                $udata = array('company_id' => $this->company_id,
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('first_name'),
                    'password' => $cpass,
                    'phone_no' => $this->input->post('mobile_phone'),
                    'user_group' => '10',
                    'user_type' => '1',
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1,
                    'password_reset_hash' => $cpass
                );

                $ures = $this->Common_model->insert_data('main_users', $udata);
                $emp_user_id = $this->db->insert_id();

                $upres = $this->Common_model->update_data('main_employees', array('emp_user_id' => $emp_user_id), array('employee_id' => $employee_id));

                if($this->input->post('email')!="")
                {
                    $this->Sendmail_model->employee_creation_mail($this->input->post('first_name'),$this->input->post('email'), $gpass);
                }
                    
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $flag = 0;
                } else {
                    $this->db->trans_commit();
                    $flag = 1;
                }
                    
                if ($flag){
                    $emp_sess_array = array();
                    $emp_sess_array = array('employee_id' => $employee_id);
                    $this->session->set_userdata('employee', $emp_sess_array);
                    echo $this->Common_model->show_massege(0, 1) . "_" . sprintf("%07d", $employee_id) . "_" . $return_name. "_" . $employee_id. "_" . $apidata. "_" . 1;
                } else {
                    echo $this->Common_model->show_massege(1, 2) . "_" . sprintf("%07d", $employee_id) . "_" . $return_name. "_" . $employee_id. "_" . $apidata. "_" . 1;
                }
                
            } else {

                $this->db->trans_begin();
                
                $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('employee_id'),'main_employees','position');
                $isactive=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('employee_id'),'main_employees','isactive');
                
                $employee_id = $this->input->post('employee_id');
                
                if ($images) {
                    $emp_image = $employee_id;
                } else {
                    $emp_image = "";
                }
                
                $data = array('employee_id' => $this->input->post('employee_id'),
                    'company_id' => $this->company_id,
                    'salutation' => $this->input->post('salutation'),
                    'position' => $this->input->post('position'),
                    'home_phone' => $this->input->post('home_phone'),
                    'first_name' => $this->input->post('first_name'),
                    'mobile_phone' => $this->input->post('mobile_phone'),
                    'middle_name' => $this->input->post('middle_name'),
                    'work_phone' => $this->input->post('work_phone'),
                    'card_no' => $this->input->post('card_no'),
                    'last_name' => $this->input->post('last_name'),
                    'ext' => $this->input->post('ext'),
                    'suffix' => $this->input->post('suffix'),
                    'email' => $this->input->post('email'),
                    'county' => $this->input->post('county'),
                    'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                    'first_address' => $this->input->post('address1'),
                    'probation_start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('probation_start')),
                    'second_address' => $this->input->post('address2'),
                    'probation_days' => $this->input->post('probation_days'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode'),
                    'ssn_code' => $this->Common_model->encrypt($this->input->post('ssn_code')),
                    'marital_status' => $this->input->post('marital_status'),
                    'gender' => $this->input->post('gender'),
                    'birthdate' => $this->Common_model->convert_to_mysql_date($this->input->post('birthdate')),
                    'review_date' => $this->Common_model->convert_to_mysql_date($this->input->post('review_date')),
                    'termination_date' => $this->Common_model->convert_to_mysql_date($this->input->post('termination_date')),
                    'transportation' => $this->input->post('transportation'),
                    'contact_via_email' => $this->input->post('contact_via_email'),
                    'contact_via_text' => $this->input->post('contact_via_text'),
                    'image_name' => $emp_image,
                    'emp_signature' => $this->input->post('scanvasData'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => $this->input->post('status'),
                );

                if($isactive==0)
                {
                    $data['rehire_date']=$this->Common_model->convert_to_mysql_date($this->input->post('rehire_date'));
                }
                //pr($data,1);
                
                $res = $this->Common_model->update_data('main_employees', $data, array('employee_id' => $this->input->post('employee_id')));

                //$this->change_wage($employee_id,$employee_position,$this->input->post('position'));
            
                if ($images) {
                    foreach ($images as $image) {
                        //$fileExt = explode(".", $image['input']['name']);
                        //$imgfilename = $employee_id.".".$fileExt[1];
                        //@unlink($_FILES[$employee_id]);
                        $file = Slim::saveFile($image['output']['data'], $employee_id, 'uploads/emp_image', false);
                    }
                }

//                if ($signature) {
//                    foreach ($signature as $sign) {
//                        $signaturefileExt = explode(".", $sign['input']['name']);
//                        $signatureimgfilename = $employee_id . "." . $signaturefileExt[1];
//                        @unlink($_FILES[$signatureimgfilename]);
//                        $file = Slim::saveFile($sign['output']['data'], $signatureimgfilename, 'uploads/emp_signature', false);
//                    }
//
//                    $signres = $this->Common_model->update_data('main_employees', array('signature' => $signatureimgfilename), array('employee_id' => $employee_id));
//                }
                
                $emp_user_id=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','emp_user_id');
                if ($emp_user_id == 0)
                {
//                    $this->db->where('email', $this->input->post('email'));
//                    $query = $this->db->get('main_users');
//                    if ($query->num_rows() > 0) {
//                        echo $this->Common_model->show_validation_massege('This Email already Exist in User.', 2);
//                        exit();
//
//                    }
                    
                    $udata = array('company_id' => $this->company_id,
                        'email' => $this->input->post('email'),
                        'name' => $this->input->post('first_name'),
                        // 'password' => $this->Common_model->encrypt('123456'),
                        'password' => md5('123456'),
                        'phone_no' => $this->input->post('mobile_phone'),
                        'user_group' => '10',
                        'user_type' => '1',
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                    //echo "======";
                    //pr($udata);

                    $ures = $this->Common_model->insert_data('main_users', $udata);
                    $emp_user_id = $this->db->insert_id();

                    $upres = $this->Common_model->update_data('main_employees', array('emp_user_id' => $emp_user_id), array('employee_id' => $employee_id));
                }
            
            
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $flag = 0;
                } else {
                    $this->db->trans_commit();
                    $flag = 1;
                }
            
                if ($flag) {

                    $emp_sess_array = array();
                    $emp_sess_array = array('employee_id' => $employee_id);
                    $this->session->set_userdata('employee', $emp_sess_array);

                    echo $this->Common_model->show_massege(0, 1) . "_" . sprintf("%07d", $employee_id) . "_" . $return_name. "_" . $employee_id;
                } else {
                    echo $this->Common_model->show_massege(1, 2) . "_" . $employee_id;
                }
            }
        //}
    }

    public function upload_profile_pic() {
        $status = "";
        $msg = "";
        $file_element_name = 'emp_profile_pic';

        if ($status != "error") {
            $config['upload_path'] = './uploads/emp_image/';
            $config['allowed_types'] = 'gif|jpg|png|doc|docx|txt|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;

            $newFileName = $_FILES[$file_element_name]['name'];
            $fileExt = explode(".", $newFileName);
            $filename = time() . "." . $fileExt[1];
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $image_path = $data['file_path'];
                $file_name = $data['file_name'];
                if (file_exists($image_path)) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }

        if ($status == "success") {
            echo $image_path . "__" . $file_name;
        } else {
            echo "";
        }

        //echo json_encode(array('status' => $status, 'msg' => $msg));
        //echo $this->Common_model->show_massege($msg,2);
    }

    
    function edit_entry() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $employee_id = $this->uri->segment(3);
        $noteSize = $this->session->userdata( 'note_size' );
        
        $param['employee_id'] = $employee_id;
        $param['page_id'] = 'edit_entry';
        $param['note_size'] = $noteSize;

        // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkPageAccess("employee", $employee_id, $this->company_id);
        }
        // check permission to view the employee ends

        $param['query'] = $this->db->get_where('main_employees', array('employee_id' => $employee_id));

        if ($param['query']) {

            $emp_sess_array = array('employee_id' => $param['employee_id']);
            $this->session->set_userdata('employee', $emp_sess_array);

            $this->initPage		( $param );
            
//             $param['page_header'] = "Employee Details";
//             $param['module_id'] = $this->module_id;
            $param['type'] = "2";

            foreach ($param['query']->result() as $roww) {
                $param['return_name'] = ucwords($roww->first_name) . " " . ucwords($roww->middle_name) . " " . ucwords($roww->last_name);
                $param['emp_pic'] = $roww->image_name;
            }

            $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
            $param['content'] = 'hr/view_addEmployees.php';
            $this->load->view('admin/home', $param);
        }
    }
    
    private function hasCompanySelected()
    {
    	return !is_null( $this->company_id ) && $this->company_id != 0;
    }
    
    private function initPage( &$param )
    {
    	$param['menu_id'				] = $this->menu_id;
    	$param['module_id'				] = $this->module_id;
    	$param['company_id'				] = $this->company_id;
    	$param['has_company_selected'	] = $this->hasCompanySelected();
    	$param['page_header'			] = 'Employee Details';
    }
    
    public function edit_Employees() {

        require_once('assets/slimimage/server/slim.php');
        $images = Slim::getImages('slim');
        //$signature = Slim::getImages('signature');

        $this->form_validation->set_rules('first_name', 'First name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('hire_date', 'Hire Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => "Please the enter required field, for more Info : %s."));
        
        //$this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2). "_" . sprintf("%07d", $this->input->post('id')) . "_" . "" . "_" . $this->input->post('id');
        } else {
            
            $this->db->trans_begin();
            
            $return_name = ucwords($this->input->post('first_name')) . " " . ucwords($this->input->post('middle_name')) . " " . ucwords($this->input->post('last_name'));
            
            $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('id'),'main_employees','position');
            $isactive=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('employee_id'),'main_employees','isactive');

            $employee_id = $this->input->post('id');
            
            if ($images) {
                $emp_image = $employee_id;
            } else {
                $emp_image = "";
            }
            
          
            $data = array('employee_id' => $this->input->post('id'),
                'company_id' => $this->company_id,
                'salutation' => $this->input->post('salutation'),
                'position' => $this->input->post('position'),
                'home_phone' => $this->input->post('home_phone'),
                'first_name' => $this->input->post('first_name'),
                'mobile_phone' => $this->input->post('mobile_phone'),
                'middle_name' => $this->input->post('middle_name'),
                'work_phone' => $this->input->post('work_phone'),
                'card_no' => $this->input->post('card_no'),
                'last_name' => $this->input->post('last_name'),
                'ext' => $this->input->post('ext'),
                'suffix' => $this->input->post('suffix'),
                'email' => $this->input->post('email'),
                'county' => $this->input->post('county'),
                'hire_date' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                'first_address' => $this->input->post('address1'),
                'probation_start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('probation_start')),
                'second_address' => $this->input->post('address2'),
                'probation_days' => $this->input->post('probation_days'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zipcode' => $this->input->post('zipcode'),
                //'ssn_code' => $this->Common_model->encrypt($this->input->post('ssn_code')),
                'marital_status' => $this->input->post('marital_status'),
                'gender' => $this->input->post('gender'),
                'birthdate' => $this->Common_model->convert_to_mysql_date($this->input->post('birthdate')),
                'review_date' => $this->Common_model->convert_to_mysql_date($this->input->post('review_date')),
                'termination_date' => $this->Common_model->convert_to_mysql_date($this->input->post('termination_date')),
                'transportation' => $this->input->post('transportation'),
                'contact_via_email' => $this->input->post('contact_via_email'),
                'contact_via_text' => $this->input->post('contact_via_text'),
                'image_name' => $emp_image,
                'emp_signature' => $this->input->post('scanvasData'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => $this->input->post('status'),
            );

            if($isactive==0)
            {
                $data['rehire_date']=$this->Common_model->convert_to_mysql_date($this->input->post('rehire_date'));
            }
            //print_r($data);
                
                
            $res = $this->Common_model->update_data('main_employees', $data, array('employee_id' => $this->input->post('id')));
            
            $apidata = array(
                'FirstName' => $this->input->post('first_name'),
                'MiddleName' => $this->input->post('middle_name'),
                'LastName' => $this->input->post('last_name'),
                'Designation' => $this->Common_model->get_name($this,$this->input->post('position'), 'main_jobtitles', 'job_title'),
                'Phone' => $this->input->post('mobile_phone'),
                'Email' => $this->input->post('email'),
                //'StartDate' => $this->Common_model->convert_to_mysql_date($this->input->post('hire_date')),
                //'EndDate' => $this->Common_model->convert_to_mysql_date($this->input->post('termination_date')),
                );

            $apidata = json_encode($apidata);

            //$this->change_wage($employee_id,$employee_position,$this->input->post('position'));
     
            if ($images) {
                foreach ($images as $image) {
                    //$fileExt = explode(".", $image['input']['name']);
                    //$imgfilename = $employee_id.".".$fileExt[1];
                    //@unlink($_FILES[$employee_id]);
                    $file = Slim::saveFile($image['output']['data'], $employee_id, 'uploads/emp_image', false);
                }
            }


//            if ($signature) {
//                foreach ($signature as $sign) {
//                    $signaturefileExt = explode(".", $sign['input']['name']);
//                    $signatureimgfilename = $employee_id . "." . $signaturefileExt[1];
//                    @unlink($_FILES[$signatureimgfilename]);
//                    $file = Slim::saveFile($sign['output']['data'], $signatureimgfilename, 'uploads/emp_signature', false);
//                }
//
//                $signres = $this->Common_model->update_data('main_employees', array('signature' => $signatureimgfilename), array('employee_id' => $employee_id));
//            }
            
//            $udata = array('company_id' => $this->company_id,
//                'email' => $this->input->post('email'),
//                'name' => $this->input->post('first_name'),
//                'password' => $this->Common_model->encrypt('123456'),
//                'phone_no' => $this->input->post('mobile_phone'),
//                'user_group' => '10',
//                'user_type' => '1',
//                'modifiedby' => $this->user_id,
//                'modifieddate' => $this->date_time,
//                'isactive' => 1,
//            );
            //$ures = $this->Common_model->update_data('main_users', $udata, array('id' => $this->input->post('user_id')));

            
                $emp_user_id=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','emp_user_id');
                if ($emp_user_id == 0)
                {
//                    $this->db->where('email', $this->input->post('email'));
//                    $query = $this->db->get('main_users');
//                    if ($query->num_rows() > 0) {
//                        echo $this->Common_model->show_validation_massege('This Email already Exist in User.', 2);
//                        exit();
//
//                    }
                    
                    $udata = array('company_id' => $this->company_id,
                        'email' => $this->input->post('email'),
                        'name' => $this->input->post('first_name'),
                        // 'password' => $this->Common_model->encrypt('123456'),
                        'password' => md5('123456'),
                        'phone_no' => $this->input->post('mobile_phone'),
                        'user_group' => '10',
                        'user_type' => '1',
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => 1,
                    );
                    //echo "======";
                    //pr($udata);

                    $ures = $this->Common_model->insert_data('main_users', $udata);
                    $emp_user_id = $this->db->insert_id();

                    $upres = $this->Common_model->update_data('main_employees', array('emp_user_id' => $emp_user_id), array('employee_id' => $employee_id));
                }
                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $flag = 0;
                } else {
                    $this->db->trans_commit();
                    $flag = 1;
                }
                
                
            if ($flag) {
                echo $this->Common_model->show_massege(2, 1) . "_" . sprintf("%07d", $employee_id) . "_" . $return_name . "_" . $employee_id. "_" . $apidata. "_" . 2;
            } else {
                echo $this->Common_model->show_massege(3, 2) . "_" . sprintf("%07d", $employee_id) . "_" . $return_name . "_" . $employee_id. "_" . $apidata. "_" . 2;
            }
            
            
        }
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_employees", $id);
        redirect('Con_Employees/', 'refresh');
        exit;
    }
    
    public function save_emp_password(){
        $this->form_validation->set_rules('emp_password', 'User Password', 'callback_validate_change_password');
        $this->form_validation->set_rules('emp_confirm_password', 'Confirm Password', 'required|matches[emp_password]', array('required' => "Please the enter required field, for more Info : %s."));
       // $this->form_validation->set_rules('emp_confirm_password', 'Confirm Password', 'matches[emp_password]', array('required' => "Please the enter required field, for more Info : %s."));
        
        //$this->form_validation->set_rules('emp_password', 'User Password', 'required|max_length[15]|min_length[5]|alpha_numeric', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('emp_confirm_password', 'Confirm Password', 'required|matches[emp_password]', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            //$emp_user_id=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('emp_id'),'main_employees','emp_user_id');
            
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data['employee_id'];
            
            
            if($this->input->post('emp_user_id')!="")
            { 
                $data = array(
                      
                        // 'password' => $this->Common_model->encrypt($this->input->post('emp_password')),
                        'password' => md5($this->input->post('emp_password')),
                        'modifiedby' => $this->user_id,
                        'modifieddate' => $this->date_time,
                        'isactive' => '1',
                    );
                $res = $this->Common_model->update_data('main_users', $data, array('id' => $this->input->post('emp_user_id')));
                if ($res) {
                    $data = array('user_id' => $this->input->post('emp_user_id'),
                        'password' => md5($this->input->post('emp_password')),
                        'created_by' => $this->input->post('emp_user_id'),
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    //print_r($data1); exit;
                    $result1 = $this->Common_model->insert_data('user_password', $data);
                    //print_r($result1); exit;
                    if ($res) {
                        echo $this->Common_model->show_massege(2, 1);
                    } else {
                        echo $this->Common_model->show_massege(3, 2);
                    }
                }
            }
            else
            {
                $first_name=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','first_name');
                $email=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','email');
                
                if ($first_name =="") {
                    echo $this->Common_model->show_validation_massege('First Name Required.', 2);
                    exit();
                } 
                
                if ($email =="") {
                    echo $this->Common_model->show_validation_massege('Email field Required.', 2);
                    exit();
                } 
                
                $this->db->where('email', $email);
                $equery = $this->db->get('main_users');
                if ($equery->num_rows() > 0) {
                    echo $this->Common_model->show_validation_massege('This User already exists, For more Info : User email..', 2);
                    exit();
                } 
                
                    $data = array('company_id' => $this->company_id,
                        'name' => $first_name,
                        'email' => $email,
                        //'parent_user' => $this->input->post('parent_user'),
                        'user_group' => 10,
                        // 'password' => $this->Common_model->encrypt($this->input->post('emp_password')),
                        'password' => md5($this->input->post('emp_password')),
                        'user_type' => '1',
                        //'user_image' => $this->input->post('user_image'),
                        //'expiration_date' => $this->Common_model->convert_to_mysql_date($this->input->post('expiration_date')),
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => '1',
                    );
                
                $res = $this->Common_model->insert_data('main_users', $data);
                $emp_user_id = $this->db->insert_id();

                $upres = $this->Common_model->update_data('main_employees', array('emp_user_id' => $emp_user_id), array('employee_id' => $employee_id));
                
                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
                
            }
        }
        
    }
    
    public function change_wage($employee_id,$employee_position,$new_position) {
        
        if($employee_id!="" && $new_position!="")
        {
            if($employee_position!=$new_position)
            {
                $ch_wage = $this->Common_model->update_data('main_emp_wage_compensation', array('status' => 1), array('employee_id' => $employee_id,'position' => $employee_position));
            
                $hourly_rate = $this->Common_model->get_selected_value($this,'position',$new_position,'main_wage_compensation','hourly_rate');
                $pay_schedule = $this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_emp_workrelated','wages');
                $salary_type = $this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_emp_workrelated','salary_type');

                $hours_per_pay_period=$this->Common_model->get_name($this, $pay_schedule,'main_payfrequency_type','wage_houre');

                $data = array('employee_id' => $employee_id,
                    'company_id' => $this->company_id,
                    'wage_date' => $this->date_time,
                    'position' => $new_position,
                    'pay_schedule' => $pay_schedule,
                    'salary_type' => $salary_type,
                    'hours_per_pay_period' => $hours_per_pay_period,
                    'per_hour_rate' => $hourly_rate,
                    'per_pay_period_salary' => ($hours_per_pay_period*$hourly_rate),
                    'yearly_salary' => (280*$hourly_rate),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $wage_res = $this->Common_model->insert_data('main_emp_wage_compensation', $data);
            
            }
            
        }
    }

    //=========================================================================================
    //=========================================================================================

    public function save_work_related() {

        $this->form_validation->set_rules('location', 'Location name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department', 'Department name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('wages', 'Wages', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data['employee_id'];
            
            if($this->Common_model->unique_check("employee_id", $employee_id, "main_emp_workrelated") == true) {
                echo $this->Common_model->show_validation_massege('This Employee already existing. Please Update Your Information.', 2);
                exit();
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'location' => $this->input->post('location'),
                'department' => $this->input->post('department'),
                'reporting_manager' => $this->input->post('reporting_manager'),
                'wages' => $this->input->post('wages'),
                'exempt' => $this->input->post('exempt'),
                'employee_type' => $this->input->post('employee_type'),
                'salary_type' => $this->input->post('salary_type'),
                'sweepclock_id' => $this->input->post('sweepclock_id'),
                'mapping_id' => $this->input->post('mapping_id'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_workrelated', $data);
            
            if($this->input->post('reporting_manager')!="")
            {
                $emp_user_id=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('reporting_manager'),'main_employees','emp_user_id');
                $set_role = $this->Common_model->update_data('main_users', array('user_group' => 11), array('id' => $emp_user_id));
            }
            
            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function edit_work_related() {

        $this->form_validation->set_rules('location', 'Location name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department', 'Department name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('wages', 'Wages', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'location' => $this->input->post('location'),
                'department' => $this->input->post('department'),
                'reporting_manager' => $this->input->post('reporting_manager'),
                'wages' => $this->input->post('wages'),
                'exempt' => $this->input->post('exempt'),
                'employee_type' => $this->input->post('employee_type'),
                'salary_type' => $this->input->post('salary_type'),
                'sweepclock_id' => $this->input->post('sweepclock_id'),
                'mapping_id' => $this->input->post('mapping_id'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_workrelated', $data, array('id' => $this->input->post('id_work_related')));

            if($this->input->post('reporting_manager')!="")
            {
                $emp_user_id=$this->Common_model->get_selected_value($this,'employee_id',$this->input->post('reporting_manager'),'main_employees','emp_user_id');
                $set_role = $this->Common_model->update_data('main_users', array('user_group' => 11), array('id' => $emp_user_id));
            }
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    
    public function load_reporting_manager() {
        /* $id = $this->uri->segment(3);
        
        if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
            $this->db->select('mm.employee_id,mm.first_name, mm.middle_name,mm.last_name');
            $this->db->from('main_employees mm');
            $this->db->join('main_emp_workrelated md', 'mm.employee_id = md.employee_id');
            $this->db->where('md.location', $id);
            $this->db->where('mm.isactive', 1);
            $this->db->where('mm.company_id', $this->company_id);
            $query = $this->db->get();
        
        } else {
            $this->db->select('mm.employee_id,mm.first_name, mm.middle_name,mm.last_name');
            $this->db->from('main_employees mm');
            $this->db->join('main_emp_workrelated md', 'mm.employee_id = md.employee_id');
            $this->db->where('md.location', $id);
            $this->db->where('mm.isactive', 1);
            $query = $this->db->get();
        }

        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->employee_id . ">" . $row->first_name. ' ' .$row->middle_name. ' ' .$row->last_name. "</option>";
            }
        } else {
            echo"<option> No Employee added </option>";
        } */
    }

    //==============================================================================================
    //==============================================================================================
    
    
    public function set_per_hour_rate() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_wage_compensation', array('position' => $id));
        
        $hourly_rate="";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $hourly_rate=$row->hourly_rate;
            }
        }
        
        echo $hourly_rate;
    }
    
     public function save_emp_wage_compensation() {
         
        $this->form_validation->set_rules('emp_wage_position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('pay_schedule', 'Pay Schedule', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('wage_salary_type', 'salary type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('wage_date', 'wage date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('effective_date', 'effective date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'wage_date' => date("Y-m-d"), //$this->Common_model->convert_to_mysql_date($this->input->post('wage_date')),
                'position' => $this->input->post('emp_wage_position'),
                'pay_schedule' => $this->input->post('pay_schedule'),
                'wage_salary_type' => $this->input->post('wage_salary_type'),
                //'hours_per_pay_period' => $this->input->post('hours_per_pay_period'),
                'per_hour_rate' => $this->input->post('per_hour_rate'),
                //'per_pay_period_salary' => $this->input->post('per_pay_period_salary'),
                'yearly_salary' => $this->input->post('yearly_salary'),
                'status' => 1, //$this->input->post('wage_status')
                'effective_date' => $this->Common_model->convert_to_mysql_date($this->input->post('effective_date')),
                'note' => $this->input->post('note'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            //print_r($data);exit();
            
            $res = $this->Common_model->insert_data('main_emp_wage_compensation', $data);

            // $res1 = $this->Common_model->update_data('main_emp_wage_compensation',
            //  array('wage_status' => 0), 
            //  array('employee_id' => $employee_id,'id !=' => $this->db->insert_id()));

             $this->db->where('id !=',$this->db->insert_id()); 
             $this->db->where('employee_id',$employee_id); 
            $this->db->set('status',0);
            $this->db->update('main_emp_wage_compensation');

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_wage_compensation()
    {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_wage_compensation', $id);
        // echo "<pre>". print_r($data, 1) ."</pre>";exit;
        echo json_encode($data);
    }

    public function edit_emp_wage_compensation() {
        
        $this->form_validation->set_rules('emp_wage_position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('pay_schedule', 'Pay Schedule', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('wage_salary_type', 'salary type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('wage_date', 'wage date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('effective_date', 'effective date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                //'wage_date' => $this->Common_model->convert_to_mysql_date($this->input->post('wage_date')),
                'position' => $this->input->post('emp_wage_position'),
                'pay_schedule' => $this->input->post('pay_schedule'),
                'wage_salary_type' => $this->input->post('wage_salary_type'),
                //'hours_per_pay_period' => $this->input->post('hours_per_pay_period'),
                'per_hour_rate' => $this->input->post('per_hour_rate'),
                //'per_pay_period_salary' => $this->input->post('per_pay_period_salary'),
                'yearly_salary' => $this->input->post('yearly_salary'),
                //'status' => $this->input->post('wage_status'),
                'effective_date' => $this->Common_model->convert_to_mysql_date($this->input->post('effective_date')),
                'note' => $this->input->post('note'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_wage_compensation', $data, array('id' => $this->input->post('id_emp_wage')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
            
        }
    }
    
    
    public function delete_entry_wage_compensation() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_wage_compensation", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }
    
    //==============================================================================================
    //==============================================================================================

    public function load_asset_category() {

        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_category', array('asset_type_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_category . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function load_asset_name() {

        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_name', array('asset_category_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function load_model_id() {

        $id = $this->uri->segment(3);
        $model = $this->db->get_where('main_asset_master', array('asset_name_id' => $id))->row();
        $model_id = $model->id;
        $this->db->where_in('IsAssigned', array('0', '2'));
        $query = $this->db->get_where('main_assets_detail', array('mid' => $model_id));

        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_id . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function load_asset_value() {

        $id = $this->uri->segment(3);
        $asset_value = $this->Common_model->get_name($this, $id, 'main_assets_detail', 'value');
        if ($asset_value) {
            echo $asset_value;
        } else {
            echo'No Name Found';
        }
    }

    public function asset_type_filter($id) {
        $query = $this->db->get_where('main_assets', array('asset_type_id' => $id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function save_emp_asset() {
        $this->form_validation->set_rules('issued_date', 'issued date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_model_id', 'Model No', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('quantity', 'Quantity', 'numeric|required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('value', 'Value', 'numeric|required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            $model_id = $this->input->post('asset_model_id');

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                'asset_type_id' => $this->input->post('asset_type_id'),
                'asset_category_id' => $this->input->post('asset_category_id'),
                'asset_id' => $this->input->post('asset_id'),
                'asset_model_id' => $this->input->post('asset_model_id'),
                'quantity' => $this->input->post('quantity'),
                'value' => $this->input->post('value'),
                'IsAssigned' => '1',
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_assets', $data);

            $udata = array('IsAssigned' => '1');
            $ures = $this->Common_model->update_data('main_assets_detail', $udata, array('id' => $model_id));

            $hdata = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                'asset_type_id' => $this->input->post('asset_type_id'),
                'asset_category_id' => $this->input->post('asset_category_id'),
                'asset_id' => $this->input->post('asset_id'),
                'asset_model_id' => $this->input->post('asset_model_id'),
                'quantity' => $this->input->post('quantity'),
                'value' => $this->input->post('value'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $hres = $this->Common_model->insert_data('assets_history', $hdata);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_assets() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_assets', $id);
        echo json_encode($data);
    }

    public function edit_emp_asset() {
        $this->form_validation->set_rules('issued_date', 'issued date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('asset_id', 'Asset ID', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('quantity', 'Quantity', 'numeric|required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('value', 'Value', 'numeric|required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_date')),
                'asset_id' => $this->input->post('asset_id'),
                'asset_type_id' => $this->input->post('asset_type_id'),
                'quantity' => $this->input->post('quantity'),
                'value' => $this->input->post('value'),
                'IsAssigned' => '1',
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_assets', $data, array('id' => $this->input->post('id_emp_asset')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_assets() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_assets", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function get_return_asset() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_assets', $id);
        echo json_encode($data);
    }

    public function return_asset() {
        $this->form_validation->set_rules('retuned_date', 'Retuned date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $model_id = $this->input->post('asset_model_id_r');
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'retuned_date' => $this->Common_model->convert_to_mysql_date($this->input->post('retuned_date')),
                'IsAssigned' => '2',
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_assets', $data, array('id' => $this->input->post('emp_id')));

//            $this->db->set('IsAssigned', '2');
//            $this->db->where('id', $model_id);
//            $this->db->update('main_assets_detail');

            $uppdata = array('IsAssigned' => 2);
            $uppres = $this->Common_model->update_data('main_assets_detail', $uppdata, array('id' => $model_id));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    //========================================================================================
    //========================================================================================

    public function save_emp_education() {

        $this->form_validation->set_rules('educationlevel', 'Education Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('institution_name', 'Institution Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            
            $this->db->where('educationlevel', $this->input->post('educationlevel'));
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_emp_education');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This education already exist.', 2);
                exit();
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'educationlevel' => $this->input->post('educationlevel'),
                'institution_name' => $this->input->post('institution_name'),
                'no_of_years' => $this->input->post('no_of_years'),
                'certification_degree' => $this->input->post('certification_degree'),
                'edu_remarks' => $this->input->post('edu_remarks'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_education', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_education', $id);
        echo json_encode($data);
    }

    public function edit_emp_education() {
        $this->form_validation->set_rules('educationlevel', 'Education Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('institution_name', 'Institution Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $this->db->where('id !=', $this->input->post('id_emp_education'));
            $this->db->where('educationlevel', $this->input->post('educationlevel'));
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_emp_education');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This education already exist.', 2);
                exit();
            }
            
            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'educationlevel' => $this->input->post('educationlevel'),
                'institution_name' => $this->input->post('institution_name'),
                'no_of_years' => $this->input->post('no_of_years'),
                'certification_degree' => $this->input->post('certification_degree'),
                'edu_remarks' => $this->input->post('edu_remarks'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_education', $data, array('id' => $this->input->post('id_emp_education')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_education() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_education", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //======================================================================================
    //======================================================================================

    public function save_emp_experience() {

        $this->form_validation->set_rules('comp_name', 'Company Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('emp_position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('from_datee', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('to_datee', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'comp_name' => $this->input->post('comp_name'),
                'emp_position' => $this->input->post('emp_position'),
                'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_datee')),
                'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_datee')),
                'reason_for_leaving' => $this->input->post('reason_for_leaving'),
                'contact_employee' => $this->input->post('contact_employee'),
                'explain' => $this->input->post('explain'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_experience', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_experience() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_experience', $id);
        echo json_encode($data);
    }

    public function edit_emp_experience() {
        $this->form_validation->set_rules('comp_name', 'Company Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('emp_position', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('from_datee', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('to_datee', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'comp_name' => $this->input->post('comp_name'),
                'emp_position' => $this->input->post('emp_position'),
                'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_datee')),
                'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_datee')),
                'reason_for_leaving' => $this->input->post('reason_for_leaving'),
                'contact_employee' => $this->input->post('contact_employee'),
                'explain' => $this->input->post('explain'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_experience', $data, array('id' => $this->input->post('id_emp_experience')));
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_experience() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_experience", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //=====================================================================================
    //=====================================================================================

    public function save_emp_skills() {

        $this->form_validation->set_rules('skillname', 'Skill Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('yearsofexp', 'Years of Experience', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('competencylevelid', 'Competency Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            
            $this->db->where('skillname', $this->input->post('skillname'));
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_emp_skills');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This skills already exist.', 2);
                exit();
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'skillname' => $this->input->post('skillname'),
                'yearsofexp' => $this->input->post('yearsofexp'),
                'competencylevelid' => $this->input->post('competencylevelid'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_skills', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_skills() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_skills', $id);
        echo json_encode($data);
    }

    public function edit_emp_skills() {
        $this->form_validation->set_rules('skillname', 'Skill Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('yearsofexp', 'Years of Experience', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('competencylevelid', 'Competency Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            
            $this->db->where('id !=', $this->input->post('id_emp_skills'));
            $this->db->where('skillname', $this->input->post('skillname'));
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_emp_skills');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This skills already exist.', 2);
                exit();
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'skillname' => $this->input->post('skillname'),
                'yearsofexp' => $this->input->post('yearsofexp'),
                'competencylevelid' => $this->input->post('competencylevelid'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_skills', $data, array('id' => $this->input->post('id_emp_skills')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_skills() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_skills", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //=======================================================================================
    //=======================================================================================

    public function save_emp_languages() {

        $this->form_validation->set_rules('languagesid', 'Languages Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('languages_skill', 'Languages Skill', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            
            $this->db->where('languagesid', $this->input->post('languagesid'));
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_emp_languages');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This languages already exist.', 2);
                exit();
            }

            $languages_skill = '';
            //if($this->input->post('languages_skill'))
            //{
            foreach ($this->input->post('languages_skill') as $skill) {
                if ($languages_skill == '') {
                    $languages_skill = $skill;
                } else {
                    $languages_skill = $languages_skill . "," . $skill;
                }
            }
            //}

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'languagesid' => $this->input->post('languagesid'),
                'languages_skill' => $languages_skill,
                'competencylevel' => $this->input->post('competencylevel'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_languages', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_languages() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_languages', $id);
        echo json_encode($data);
    }

    public function edit_emp_languages() {
        $this->form_validation->set_rules('languagesid', 'Languages Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('languages_skill', 'Languages Skill', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            
            $this->db->where('id !=', $this->input->post('id_emp_languages'));
            $this->db->where('languagesid', $this->input->post('languagesid'));
            $this->db->where('company_id', $this->company_id);
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get('main_emp_languages');

            if ($query->num_rows() > 0) {
                echo $this->Common_model->show_validation_massege('This languages already exist.', 2);
                exit();
            }

            $languages_skill = '';
            foreach ($this->input->post('languages_skill') as $skill) {
                if ($languages_skill == '') {
                    $languages_skill = $skill;
                } else {
                    $languages_skill = $languages_skill . "," . $skill;
                }
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'languagesid' => $this->input->post('languagesid'),
                'languages_skill' => $languages_skill,
                'competencylevel' => $this->input->post('competencylevel'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_languages', $data, array('id' => $this->input->post('id_emp_languages')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_languages() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_languages", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //========================================================================================
    //========================================================================================

    public function save_emp_certification() {

        $this->form_validation->set_rules('course_name', 'Course Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('course_level', 'Course Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('certification_name', 'Certification Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('issued_datee', 'Issued Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'course_name' => $this->input->post('course_name'),
                'course_level' => $this->input->post('course_level'),
                'certification_name' => $this->input->post('certification_name'),
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_datee')),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_certification', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_certification() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_certification', $id);
        echo json_encode($data);
    }

    public function edit_emp_certification() {
        $this->form_validation->set_rules('course_name', 'Course Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('course_level', 'Course Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('certification_name', 'Certification Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('issued_datee', 'Issued Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'course_name' => $this->input->post('course_name'),
                'course_level' => $this->input->post('course_level'),
                'certification_name' => $this->input->post('certification_name'),
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_datee')),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_certification', $data, array('id' => $this->input->post('id_emp_certification')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_certification() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_certification", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //=========================================================================================
    //========================================================================================

    public function save_emp_license() {

        $this->form_validation->set_rules('license_type', 'License Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('state_issued', 'State Issued', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('issued_dates', 'Issued Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        if($this->input->post('expirable')=="1"){
            $this->form_validation->set_rules('expiration_date', 'Expiration Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }
        //$this->form_validation->set_rules('expiration_date', 'Expiration Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('license_file', 'File', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $expiration_date="";
            if($this->input->post('expirable')=="1"){
                $expiration_date=$this->Common_model->convert_to_mysql_date($this->input->post('expiration_date'));
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'license_type' => $this->input->post('license_type'),
                'state_issued' => $this->input->post('state_issued'),
                'state_name' => $this->input->post('state_name'),
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_dates')),
                'expirable' => $this->input->post('expirable'),
                'expiration_date' => $expiration_date,
                //'unspecific_date' => $this->Common_model->convert_to_mysql_date($this->input->post('unspecific_date')),
                'description' => $this->input->post('description'),
                'license_image' => $this->input->post('license_image_path'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_license', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function upload_action_image_file($upload_type) {
        $status = "";
        $msg = "";
        $file_element_name = 'action_image_file';

        if ($status != "error") {
            if (($upload_type == 'I-D') || ($upload_type == 'A-D')) {
                $config['upload_path'] = './uploads/action_document/';
                $config['allowed_types'] = 'pdf|doc|xml|txt|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                $config['max_size'] = '1000KB';
                $config['encrypt_name'] = FALSE;

                $newFileName = $_FILES[$file_element_name]['name'];
                if ($newFileName) {
                    $fileExt = explode(".", $newFileName);
                    $filename = time() . "." . $fileExt[1];
                    $config['file_name'] = $filename;
                }

            } else if(($upload_type == 'I-P') || ($upload_type == 'A-P')) {
                $config['upload_path'] = './uploads/action_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1024 * 8;
                $config['encrypt_name'] = FALSE;

                $newFileName = $_FILES[$file_element_name]['name'];
                if ($newFileName) {
                    $fileExt = explode(".", $newFileName);
                    $filename = time() . "." . $fileExt[1];
                    $config['file_name'] = $filename;
                }

            } else{
                $config['upload_path'] = './uploads/action_video/';
                $config['allowed_types'] = 'mp4|gif';
                $config['max_size'] = 10240000;
                $config['encrypt_name'] = FALSE;
                $config['overwrite'] = FALSE;
                $config['remove_spaces'] = TRUE;
            }

           
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
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
                    //echo $this->Common_model->show_massege($_POST['employee_id'],2);
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
        //echo json_encode(array('status' => $status, 'msg' => $msg));
        //echo $this->Common_model->show_massege($msg,2);
    }

    public function upload_license_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'license_file';

        if ($status != "error") {
            $config['upload_path'] = './uploads/emp_license/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;

            $newFileName = $_FILES[$file_element_name]['name'];
            if ($newFileName) {
                $fileExt = explode(".", $newFileName);
                $filename = time() . "." . $fileExt[1];
                $config['file_name'] = $filename;
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
                    //echo $this->Common_model->show_massege($_POST['employee_id'],2);
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
        //echo json_encode(array('status' => $status, 'msg' => $msg));
        //echo $this->Common_model->show_massege($msg,2);
    }

    public function ajax_edit_license() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_license', $id);
        echo json_encode($data);
    }

    public function edit_emp_license() {
        $this->form_validation->set_rules('license_type', 'License Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('state_issued', 'State Issued', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('issued_dates', 'Issued Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        if($this->input->post('expirable')=="1"){
            $this->form_validation->set_rules('expiration_date', 'Expiration Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }
        
        //$this->form_validation->set_rules('license_file', 'File', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $expiration_date="";
            if($this->input->post('expirable')=="1"){
                $expiration_date=$this->Common_model->convert_to_mysql_date($this->input->post('expiration_date'));
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'license_type' => $this->input->post('license_type'),
                'state_issued' => $this->input->post('state_issued'),
                'state_name' => $this->input->post('state_name'),
                'issued_date' => $this->Common_model->convert_to_mysql_date($this->input->post('issued_dates')),
                'expirable' => $this->input->post('expirable'),
                'expiration_date' => $expiration_date,
                //'unspecific_date' => $this->Common_model->convert_to_mysql_date($this->input->post('unspecific_date')),
                'description' => $this->input->post('description'),
                'license_image' => $this->input->post('license_image_path'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_license', $data, array('id' => $this->input->post('id_emp_license')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_license() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_license", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function download_license() {
        $license_path = $this->uri->segment(3);
        if ($license_path != "") {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/emp_license/' . $license_path));
            $url = Get_File_Directory('/uploads/emp_license/' . $license_path);
            $data = file_get_contents($url);
            force_download($license_path, $data);
        }
    }

    //==========================================================================================
    //=========================================================================================

    public function save_emp_absencetracking() {

        $this->form_validation->set_rules('from_datea', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('to_datea', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('absent_type', 'Absent Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_datea')),
                'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_datea')),
                'total_days' => $this->input->post('total_days'),
                'absent_type' => $this->input->post('absent_type'),
                'details_reason' => $this->input->post('details_reason'),
                'is_leave' => $this->input->post('is_leave'),
                'leave_type' => $this->input->post('leave_type'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_absencetracking', $data);

            //==================================================================
            $sql = "SELECT first_name,email FROM main_employees WHERE employee_id=" . $employee_id . "";
            $prquery = $this->db->query($sql);
            if ($prquery) {
                foreach ($prquery->result() as $prrow) {
                    $first_name = $prrow->first_name;
                    $email = $prrow->email;
                }
            }
            $absent_type_array = $this->Common_model->get_array('absent_type');
            $absent_type = $absent_type_array[$this->input->post('absent_type')];
            $res2 = $this->Sendmail_model->absence_notification_send_mail($first_name, $email, $this->input->post('from_datea'), $this->input->post('to_datea'), $absent_type);
            //==================================================================

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_absencetracking() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_absencetracking', $id);
        echo json_encode($data);
    }

    public function edit_emp_absencetracking() {

        $this->form_validation->set_rules('from_datea', 'From Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('to_datea', 'To Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('absent_type', 'Absent Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'from_date' => $this->Common_model->convert_to_mysql_date($this->input->post('from_datea')),
                'to_date' => $this->Common_model->convert_to_mysql_date($this->input->post('to_datea')),
                'total_days' => $this->input->post('total_days'),
                'absent_type' => $this->input->post('absent_type'),
                'details_reason' => $this->input->post('details_reason'),
                'is_leave' => $this->input->post('is_leave'),
                'leave_type' => $this->input->post('leave_type'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_absencetracking', $data, array('id' => $this->input->post('id_emp_absencetracking')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_absencetracking() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_absencetracking", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==============================================================================================
    //==============================================================================================

    public function save_emp_emergencycontact() {

        $this->form_validation->set_rules('em_first_name', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('em_relationship', 'Relationship', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('em_mobile', 'Mobile', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('em_first_address', 'Primary Address', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'first_name' => $this->input->post('em_first_name'),
                'last_name' => $this->input->post('em_last_name'),
                'occupation' => $this->input->post('em_occupation'),
                'relationship' => $this->input->post('em_relationship'),
                'first_address' => $this->input->post('em_first_address'),
                'second_address' => $this->input->post('em_second_address'),
                'city' => $this->input->post('em_city'),
                'state' => $this->input->post('em_state'),
                'county' => $this->input->post('em_county'),
                'zipcode' => $this->input->post('em_zipcode'),
                'phone' => $this->input->post('em_phone'),
                'mobile' => $this->input->post('em_mobile'),
                'description' => $this->input->post('em_description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_emergencycontact', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_emergencycontact() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_emergencycontact', $id);
        echo json_encode($data);
    }

    public function edit_emp_emergencycontact() {
        $this->form_validation->set_rules('em_first_name', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('em_relationship', 'Relationship', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('em_mobile', 'Mobile', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('em_first_address', 'Primary Address', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'first_name' => $this->input->post('em_first_name'),
                'last_name' => $this->input->post('em_last_name'),
                'occupation' => $this->input->post('em_occupation'),
                'relationship' => $this->input->post('em_relationship'),
                'first_address' => $this->input->post('em_first_address'),
                'second_address' => $this->input->post('em_second_address'),
                'city' => $this->input->post('em_city'),
                'state' => $this->input->post('em_state'),
                'county' => $this->input->post('em_county'),
                'zipcode' => $this->input->post('em_zipcode'),
                'phone' => $this->input->post('em_phone'),
                'mobile' => $this->input->post('em_mobile'),
                'description' => $this->input->post('em_description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_emergencycontact', $data, array('id' => $this->input->post('id_emp_emergencycontact')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_emergencycontact() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_emergencycontact", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //===============================================================================================
    //===============================================================================================

    public function save_emp_inc_actions() {
        //pr($this->input->post(), 1);

        $accident_report = array();
        if ($this->input->post('inc_action_type') == 1) {
            $this->form_validation->set_rules('inc_action_date', 'Action Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('incident_category', 'Incident Category', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('tncident_type', 'Incident Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('accident_location', 'Incident Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            $accident_report = array(
                'any_witness' => $this->input->post('inc_any_witness'),
                'accident_witness' => $this->input->post('inc_witness_name'),
                'accident_witness_phone' => $this->input->post('inc_witness_phone'),
                'accident_witness_address' => $this->input->post('inc_witness_address'),
                'accident_time' => $this->input->post('accident_time')
            );
        } else if ($this->input->post('inc_action_type') == 2) {
            $this->form_validation->set_rules('inc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            if ($this->input->post('inc_report_supervisor')) {
                $inc_report_supervisor = $this->input->post('inc_report_supervisor');
            } else {
                $inc_report_supervisor = "";
            }

            if ($this->input->post('inc_report_hr')) {
                $inc_report_hr = $this->input->post('inc_report_hr');
            } else {
                $inc_report_hr = "";
            }


            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'action_type' => 1,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'incident_category' => $this->input->post('incident_category'),
                'tncident_type' => $this->input->post('tncident_type'),
                'report_supervisor' => $inc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('inc_supervisor_reported_by'),
                'report_hr' => $inc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_hr_report_date')),
                'hr_reported_by' => $this->input->post('inc_hr_reported_by'),
                'report_description' => $this->input->post('inc_report_description'),
                'employee_comments' => $this->input->post('inc_employee_comments'),
                'discipline_type' => $this->input->post('inc_discipline_type'),
                'verbal_warning_by' => $this->input->post('inc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('inc_written_warning_by'),
                'counseled_by' => $this->input->post('inc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_to')),
                'subject' => $this->input->post('inc_subject'),
                'description' => $this->input->post('inc_description'),
                'improvement_plan' => $this->input->post('inc_improvement_plan'),
                'further_actions' => $this->input->post('inc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                'video_path' => $this->input->post('action_video_path'),
                /* ------------------------------ */
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $data = array_merge($data, $accident_report);

            $res = $this->Common_model->insert_data('main_emp_actions', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function save_emp_disc_actions() {
        //pr($this->input->post(), 1);

        $this->form_validation->set_rules('disc_action_type', 'Discipline Action type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('disc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
           


        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];


            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'action_type' => 3,
                'action_date' => date("Y-m-d"),
                'discipline_type' => $this->input->post('disc_discipline_type'),
                'verbal_warning_by' => $this->input->post('inc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('inc_written_warning_by'),
                'counseled_by' => $this->input->post('inc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_to')),
                'subject' => $this->input->post('inc_subject'),
                'description' => $this->input->post('inc_description'),
                'improvement_plan' => $this->input->post('inc_improvement_plan'),
                'further_actions' => $this->input->post('inc_further_actions'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            //$data = array_merge($data, $accident_report);

            $res = $this->Common_model->insert_data('main_emp_actions', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function save_emp_acc_actions() {

        //pr($this->input->post(), 1);

        $accident_report = array();

        $this->form_validation->set_rules('accident_action_date', 'Accident Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('any_benefit_provider', 'Provider Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        if ($this->input->post('acc_action_type') == 1) {
            $this->form_validation->set_rules('accident_action_date', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('accident_location', 'Accident Location', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            $accident_report = array(
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('accident_action_date')),
                'accident_time' => $this->input->post('accident_time'),
                'physician_name' => $this->input->post('physician_name'),
                'nature_of_injury' => $this->input->post('nature_of_injury'),
                'any_benefit_provider' => $this->input->post('any_benefit_provider'),
                'benefit_provider' => $this->input->post('benefit_provider_id'),
                'injury_type' => (($this->input->post('injury_type') != '') ? implode(',', $this->input->post('injury_type')) : ''),
                'injured_body_parts' => (($this->input->post('injured_body_parts') != '') ? implode(',', $this->input->post('injured_body_parts')) : ''),
                'how_accident_occured' => $this->input->post('how_accident_occured'),
                'activity_during_injury' => $this->input->post('activity_during_injury'),
                'detail_description' => $this->input->post('detail_description'),
                'explain_first_aid' => $this->input->post('explain_first_aid'),
                'explain_accident_causes' => $this->input->post('explain_accident_causes'),
                'measures_in_future' => $this->input->post('measures_in_future'),
                'comments_by_dept' => $this->input->post('comments_by_dept')
            );

            if ($this->input->post('acc_any_witness') == 1) {
                array_merge($accident_report, array(
                    'any_witness' => $this->input->post('acc_any_witness'),
                    'accident_witness' => $this->input->post('acc_witness_name'),
                    'accident_witness_phone' => $this->input->post('acc_witness_phone'),
                    'accident_witness_address' => $this->input->post('acc_witness_address')
                ));
            }
            if ($this->input->post('first_aid_given') == 1) {
                array_merge($accident_report, array(
                    'first_aid_given' => $this->input->post('first_aid_given'),
                    'firstAid_by_whom' => $this->input->post('firstAid_by_whom')
                ));
            }
        } else if ($this->input->post('acc_action_type') == 2) {
            $this->form_validation->set_rules('acc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            if ($this->input->post('acc_report_supervisor')) {
                $acc_report_supervisor = $this->input->post('acc_report_supervisor');
            } else {
                $acc_report_supervisor = "";
            }

            if ($this->input->post('acc_report_hr')) {
                $acc_report_hr = $this->input->post('acc_report_hr');
            } else {
                $acc_report_hr = "";
            }

            if ($this->input->post('requires_hospitalization')) {
                $requires_hospitalization = $this->input->post('requires_hospitalization');
            } else {
                $requires_hospitalization = "";
            }

            $data = array(
                'employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'action_type' => 2,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('accident_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'report_supervisor' => $acc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('acc_supervisor_reported_by'),
                'report_hr' => $acc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_hr_report_date')),
                'hr_reported_by' => $this->input->post('acc_hr_reported_by'),
                'report_description' => $this->input->post('acc_report_description'),
                'employee_comments' => $this->input->post('acc_employee_comments'),
                'requires_hospitalization' => $requires_hospitalization,
                'clinic_name' => $this->input->post('clinic_name'),
                'discipline_type' => $this->input->post('acc_discipline_type'),
                'verbal_warning_by' => $this->input->post('acc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('acc_written_warning_by'),
                'counseled_by' => $this->input->post('acc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_to')),
                'subject' => $this->input->post('acc_subject'),
                'description' => $this->input->post('acc_description'),
                'improvement_plan' => $this->input->post('acc_improvement_plan'),
                'further_actions' => $this->input->post('acc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                'video_path' => $this->input->post('action_video_path'),
                /* ------------------------------ */
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
                    /* --------For Report info, '$accident_report' array will be merged here -------- */
            );

            $data = array_merge($data, $accident_report);

            //pr($data, 1);

            $res = $this->Common_model->insert_data('main_emp_actions', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_actions() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_actions', $id);
        echo json_encode($data);
        exit();
    }

    public function edit_emp_inc_actions() {

        $accident_report = array();
        if ($this->input->post('inc_action_type') == 1) {
            $this->form_validation->set_rules('inc_action_date', 'Action Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('incident_category', 'Incident Category', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('tncident_type', 'Incident Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));


            $accident_report = array(
                'any_witness' => $this->input->post('inc_any_witness'),
                'accident_witness' => $this->input->post('inc_witness_name'),
                'accident_witness_phone' => $this->input->post('inc_witness_phone'),
                'accident_witness_address' => $this->input->post('inc_witness_address'),
                'accident_time' => $this->input->post('accident_time')
            );
        } else if ($this->input->post('inc_action_type') == 2) {
            $this->form_validation->set_rules('inc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            if ($this->input->post('inc_report_supervisor')) {
                $inc_report_supervisor = $this->input->post('inc_report_supervisor');
            } else {
                $inc_report_supervisor = "";
            }

            if ($this->input->post('inc_report_hr')) {
                $inc_report_hr = $this->input->post('inc_report_hr');
            } else {
                $inc_report_hr = "";
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'action_type' => 1,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'incident_category' => $this->input->post('incident_category'),
                'tncident_type' => $this->input->post('tncident_type'),
                'report_supervisor' => $inc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('inc_supervisor_reported_by'),
                'report_hr' => $inc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_hr_report_date')),
                'hr_reported_by' => $this->input->post('inc_hr_reported_by'),
                'report_description' => $this->input->post('inc_report_description'),
                'employee_comments' => $this->input->post('inc_employee_comments'),
                'discipline_type' => $this->input->post('inc_discipline_type'),
                'verbal_warning_by' => $this->input->post('inc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('inc_written_warning_by'),
                'counseled_by' => $this->input->post('inc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_to')),
                'subject' => $this->input->post('inc_subject'),
                'description' => $this->input->post('inc_description'),
                'improvement_plan' => $this->input->post('inc_improvement_plan'),
                'further_actions' => $this->input->post('inc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                'video_path' => $this->input->post('action_video_path'),
                /* ------------------------------ */
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            $data = array_merge($data, $accident_report);

            $res = $this->Common_model->update_data('main_emp_actions', $data, array('id' => $this->input->post('id_emp_inc')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }


    public function edit_emp_disc_actions() {

        $this->form_validation->set_rules('disc_action_type', 'Discipline Action type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('disc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
           
       

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

           
            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                //'action_type' => 1,
                'action_date' => date("Y-m-d"),
                'discipline_type' => $this->input->post('disc_discipline_type'),
                'verbal_warning_by' => $this->input->post('inc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('inc_written_warning_by'),
                'counseled_by' => $this->input->post('inc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('inc_suspended_to')),
                'subject' => $this->input->post('inc_subject'),
                'description' => $this->input->post('inc_description'),
                'improvement_plan' => $this->input->post('inc_improvement_plan'),
                'further_actions' => $this->input->post('inc_further_actions'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
           // $data = array_merge($data, $accident_report);

            $res = $this->Common_model->update_data('main_emp_actions', $data, array('id' => $this->input->post('id_emp_disc')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function edit_emp_acc_actions() {

        //pr($this->input->post(),1);

        if ($this->input->post('acc_action_type') == 1) {
            $this->form_validation->set_rules('accident_action_date', 'Action Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        } else if ($this->input->post('acc_action_type') == 2) {
            $this->form_validation->set_rules('acc_discipline_type', 'Discipline Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        }

        if ($this->form_validation->run() == FALSE) {
            //$this->Common_model->phpAlert("aaaaaaaaaa");
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            if ($this->input->post('acc_report_supervisor')) {
                $acc_report_supervisor = $this->input->post('acc_report_supervisor');
            } else {
                $acc_report_supervisor = "";
            }

            if ($this->input->post('acc_report_hr')) {
                $acc_report_hr = $this->input->post('acc_report_hr');
            } else {
                $acc_report_hr = "";
            }

            if ($this->input->post('requires_hospitalization')) {
                $requires_hospitalization = $this->input->post('requires_hospitalization');
            } else {
                $requires_hospitalization = "";
            }

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'action_type' => 2,
                'action_date' => $this->Common_model->convert_to_mysql_date($this->input->post('accident_action_date')),
                'accident_location' => $this->input->post('accident_location'),
                'report_supervisor' => $acc_report_supervisor,
                'supervisor_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_supervisor_report_date')),
                'supervisor_reported_by' => $this->input->post('acc_supervisor_reported_by'),
                'report_hr' => $acc_report_hr,
                'hr_report_date' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_hr_report_date')),
                'hr_reported_by' => $this->input->post('acc_hr_reported_by'),
                'report_description' => $this->input->post('acc_report_description'),
                'employee_comments' => $this->input->post('acc_employee_comments'),
                'requires_hospitalization' => $requires_hospitalization,
                'clinic_name' => $this->input->post('clinic_name'),
                'discipline_type' => $this->input->post('acc_discipline_type'),
                'verbal_warning_by' => $this->input->post('acc_verbal_warning_by'),
                'written_warning_by' => $this->input->post('acc_written_warning_by'),
                'counseled_by' => $this->input->post('acc_counseled_by'),
                'suspended_from' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_from')),
                'suspended_to' => $this->Common_model->convert_to_mysql_date($this->input->post('acc_suspended_to')),
                'subject' => $this->input->post('acc_subject'),
                'description' => $this->input->post('acc_description'),
                'improvement_plan' => $this->input->post('acc_improvement_plan'),
                'further_actions' => $this->input->post('acc_further_actions'),
                /* ---- For document & image ---- */
                'document_path' => $this->input->post('action_document_path'),
                'image_path' => $this->input->post('action_image_path'),
                'video_path' => $this->input->post('action_video_path'),
                /* ------------------------------ */
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => 1,
                /* ---------------------------------------------------------- */
                'accident_time' => $this->input->post('accident_time'),
                'any_witness' => $this->input->post('acc_any_witness'),
                'accident_witness' => $this->input->post('acc_witness_name'),
                'accident_witness_phone' => $this->input->post('acc_witness_phone'),
                'accident_witness_address' => $this->input->post('acc_witness_address'),
                'first_aid_given' => $this->input->post('first_aid_given'),
                'firstAid_by_whom' => $this->input->post('firstAid_by_whom'),
                'physician_name' => $this->input->post('physician_name'),
                'nature_of_injury' => $this->input->post('nature_of_injury'),
                'any_benefit_provider' => $this->input->post('any_benefit_provider'),
                'benefit_provider' => $this->input->post('benefit_provider_id'),
                'injury_type' => (($this->input->post('injury_type') != '') ? implode(',', $this->input->post('injury_type')) : ''),
                'injured_body_parts' => (($this->input->post('injured_body_parts') != '') ? implode(',', $this->input->post('injured_body_parts')) : ''),
                'how_accident_occured' => $this->input->post('how_accident_occured'),
                'activity_during_injury' => $this->input->post('activity_during_injury'),
                'detail_description' => $this->input->post('detail_description'),
                'explain_first_aid' => $this->input->post('explain_first_aid'),
                'explain_accident_causes' => $this->input->post('explain_accident_causes'),
                'measures_in_future' => $this->input->post('measures_in_future'),
                'comments_by_dept' => $this->input->post('comments_by_dept')
            );

            $res = $this->Common_model->update_data('main_emp_actions', $data, array('id' => $this->input->post('id_emp_accident')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_actions() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_actions", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    public function download_video() {
        $license_path = $this->uri->segment(3);
        if ($license_path != "") {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/emp_license/' . $license_path));
            $url = Get_File_Directory('/uploads/action_video/' . $license_path);
            $data = file_get_contents($url);
            force_download($license_path, $data);
        }
    }

    //========================================================================================================
    //==========================================================================

    public function save_emp_enrolling() {

        $this->form_validation->set_rules('en_fast_name', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_relationship', 'Relationship', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_gender', 'Gender', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_birthdate', 'Date Of Birth', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_ssn', 'SSN', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'fast_name' => $this->input->post('en_fast_name'),
                'middle_name' => $this->input->post('en_middle_name'),
                'last_name' => $this->input->post('en_last_name'),
                'suffix' => $this->input->post('en_suffix'),
                'relationship_id' => $this->input->post('en_relationship'),
                'gender' => $this->input->post('en_gender'),
                'birthdate' => $this->Common_model->convert_to_mysql_date($this->input->post('en_birthdate')),
                'age' => $this->input->post('en_age'),
                'ssn_code' => $this->input->post('en_ssn'),
                'iscollage_student' => $this->input->post('en_iscollage_student'),
                //'istobacco_user' => $this->input->post('en_istobacco_user'),
                'employee_address' => $this->input->post('en_employee_address'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_enrolling', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_enrolling() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_enrolling', $id);
        echo json_encode($data);
    }

    public function edit_emp_enrolling() {
        $this->form_validation->set_rules('en_fast_name', 'First Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_relationship', 'Relationship', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_gender', 'Gender', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('en_birthdate', 'Date Of Birth', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'fast_name' => $this->input->post('en_fast_name'),
                'middle_name' => $this->input->post('en_middle_name'),
                'last_name' => $this->input->post('en_last_name'),
                'suffix' => $this->input->post('en_suffix'),
                'relationship_id' => $this->input->post('en_relationship'),
                'gender' => $this->input->post('en_gender'),
                'birthdate' => $this->Common_model->convert_to_mysql_date($this->input->post('en_birthdate')),
                'age' => $this->input->post('en_age'),
                'ssn_code' => $this->input->post('en_ssn'),
                'iscollage_student' => $this->input->post('en_iscollage_student'),
                //'istobacco_user' => $this->input->post('en_istobacco_user'),
                'employee_address' => $this->input->post('en_employee_address'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_enrolling', $data, array('id' => $this->input->post('id_emp_enrolling')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_enrolling() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_enrolling", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================
    //=========================================================================================================

    public function save_emp_benefit() {

        $this->form_validation->set_rules('ben_enrolling', 'Enrolling', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('provider', 'Provider', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('eligible_date', 'Eligible date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('enrolled_date', 'Enrolled date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'enrolling' => $this->input->post('ben_enrolling'),
                'provider' => $this->input->post('provider'),
                'benefit_type' => $this->input->post('benefit_type'),
                'eligible_date' => $this->Common_model->convert_to_mysql_date($this->input->post('eligible_date')),
                'enrolled_date' => $this->Common_model->convert_to_mysql_date($this->input->post('enrolled_date')),
                'percent_dollars' => $this->input->post('percent_dollars'),
                'employee_portion' => $this->input->post('employee_portion'),
                'employer_portion' => $this->input->post('employer_portion'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_benefit', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_benefit() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_benefit', $id);
        echo json_encode($data);
    }

    public function edit_emp_benefit() {
        $this->form_validation->set_rules('provider', 'Provider', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('eligible_date', 'eligible date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('enrolled_date', 'enrolled date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'enrolling' => $this->input->post('ben_enrolling'),
                'provider' => $this->input->post('provider'),
                'benefit_type' => $this->input->post('benefit_type'),
                'eligible_date' => $this->Common_model->convert_to_mysql_date($this->input->post('eligible_date')),
                'enrolled_date' => $this->Common_model->convert_to_mysql_date($this->input->post('enrolled_date')),
                'percent_dollars' => $this->input->post('percent_dollars'),
                'employee_portion' => $this->input->post('employee_portion'),
                'employer_portion' => $this->input->post('employer_portion'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_benefit', $data, array('id' => $this->input->post('id_emp_benefit')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_benefit() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_benefit", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //===============================================PTO====================================================

    
    public function ajax_accrual_leave() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_accrual_leave', $id);
        echo json_encode($data);
    }
    
     public function update_accrual_leave() {

        $this->form_validation->set_rules('pto_leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
           
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                //'track_time_off' => $track_time_off,
                'leave_type' => $this->input->post('pto_leave_type'),
                'available_limit' => $this->input->post('available_limit'),
                'earned_houre' => $this->input->post('earned_houre'),
                'available_hour' => $this->input->post('available_hour'),
                'used_hour' => $this->input->post('used_hour'),
                'balance' => $this->input->post('balance'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res = $this->Common_model->update_data('main_emp_accrual_leave', $data, array('id' => $this->input->post('id')));
            
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function save_emp_pto() {

        $this->form_validation->set_rules('pto_leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_amt', 'Accrual Amount', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_period', 'Accrual period', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('start_days_after_hire', 'Start Days After Hire', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            if ($this->input->post('track_time_off')) {
                $track_time_off = $this->input->post('track_time_off');
            } else {
                $track_time_off = "";
            }
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'track_time_off' => $track_time_off,
                'rollover_on' => $this->input->post('rollover_on'),
                'leave_type' => $this->input->post('pto_leave_type'),
                'accrual_amt' => $this->input->post('accrual_amt'),
                'accrual_period' => $this->input->post('accrual_period'),
                'start_days_after_hire' => $this->input->post('start_days_after_hire'),
                'max_accrual' => $this->input->post('max_accrual'),
                'max_available' => $this->input->post('max_available'),
                'max_carryover' => $this->input->post('max_carryover'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_emp_pto', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function ajax_edit_pto() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_emp_pto', $id);
        echo json_encode($data);
    }

    public function edit_emp_pto() {

        $this->form_validation->set_rules('pto_leave_type', 'Leave Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_amt', 'Accrual Amount', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('accrual_period', 'Accrual period', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('start_days_after_hire', 'Start Days After Hire', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            if ($this->input->post('track_time_off')) {
                $track_time_off = $this->input->post('track_time_off');
            } else {
                $track_time_off = "";
            }
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'track_time_off' => $track_time_off,
                'rollover_on' => $this->input->post('rollover_on'),
                'leave_type' => $this->input->post('pto_leave_type'),
                'accrual_amt' => $this->input->post('accrual_amt'),
                'accrual_period' => $this->input->post('accrual_period'),
                'start_days_after_hire' => $this->input->post('start_days_after_hire'),
                'max_accrual' => $this->input->post('max_accrual'),
                'max_available' => $this->input->post('max_available'),
                'max_carryover' => $this->input->post('max_carryover'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->update_data('main_emp_pto', $data, array('id' => $this->input->post('id_emp_pto')));
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry_pto() {
        $id = $this->uri->segment(3);
        $res = $this->Common_model->delete_by_id("main_emp_pto", $id);
        if ($res) {
            echo $this->Common_model->show_massege(4, 1);
        } else {
            echo $this->Common_model->show_massege(5, 2);
        }
    }

    //==========================================================================


    public function save_emp_separation() {

        $this->form_validation->set_rules('separation_date', 'Separation Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('last_paycheck_date', 'Last Paycheck Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'separation_date' => $this->Common_model->convert_to_mysql_date($this->input->post('separation_date')),
                'last_paycheck_date' => $this->Common_model->convert_to_mysql_date($this->input->post('last_paycheck_date')),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_emp_separation', $data);

            $udata = array('isactive' => '0');
            $ures = $this->Common_model->update_data('main_employees', $udata, array('id' => $employee_id));

            if ($res && $ures) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function edit_emp_separation() {

        $this->form_validation->set_rules('separation_date', 'Separation Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('last_paycheck_date', 'Last Paycheck Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];

            $data = array('employee_id' => $employee_id,
                'company_id' => $this->company_id,
                'separation_date' => $this->Common_model->convert_to_mysql_date($this->input->post('separation_date')),
                'last_paycheck_date' => $this->Common_model->convert_to_mysql_date($this->input->post('last_paycheck_date')),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_emp_separation', $data, array('id' => $this->input->post('emp_Separation_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function download_employee_form() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $emp_id = $this->uri->segment(3);

        $this->db->join('main_positions', 'main_positions.id = main_employees.position', 'LEFT');
        $param['emp_data'] = $this->db->get_where('main_employees', array('employee_id' => $emp_id))->row_array();
        $param['Emp_Name'] = $Emp_Name = $param['emp_data']['first_name'] . ' ' . $param['emp_data']['middle_name'] . ' ' . $param['emp_data']['last_name'];

        $sql = 'SELECT CONCAT(first_name," ", middle_name," ", last_name) AS Sup_Name FROM main_employees'
                . ' WHERE `employee_id`=(SELECT `reporting_manager` FROM main_emp_workrelated WHERE `employee_id`=' . $emp_id . ')';
        $param['Supervisor_Name'] = $this->db->query($sql)->row("Sup_Name");

        $sql2 = 'SELECT location_name, started_on, contact_number, email AS work_email FROM main_location'
                . ' WHERE `id`=(SELECT `location` FROM main_emp_workrelated WHERE `employee_id`=' . $emp_id . ')';
        $work_data = $this->db->query($sql2)->row();

        if (!empty($work_data)) {
            $param['Work_Location'] = $work_data->location_name;
            $param['Work_Email'] = $work_data->work_email;
            $param['Work_Contact'] = $work_data->contact_number;
            $param['Started_On'] = $work_data->started_on;
        } else {
            $param['Work_Location'] = '';
            $param['Work_Email'] = '';
            $param['Work_Contact'] = '';
            $param['Started_On'] = '';
        }

        $this->db->select('first_name, last_name, relationship, first_address, phone, mobile');
        $param['emergency'] = $this->db->get_where('main_emp_emergencycontact', array('employee_id' => $emp_id))->row_array();
        if (empty($param['emergency'])) {
            $param['emergency'] = array('first_name' => '', 'last_name' => '', 'relationship' => 0, 'first_address' => '', 'phone' => '', 'mobile' => '');
        }

        $this->db->select('fast_name, middle_name, last_name, relationship_status');
        $this->db->join('main_relationship_status', 'main_relationship_status.id = main_emp_enrolling.relationship_id');
        $param['dependent'] = $this->db->get_where('main_emp_enrolling', array('employee_id' => $emp_id))->result_array();

        /* $this->load->view('hr/reports/employee_info_pdf', $param); */
        $this->pdf->load_view('hr/reports/employee_info_pdf', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("employee_info_pdf.pdf");
    }

    //==================================================================

    public function incident_pdf() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param = array();

        $param['Emp_Data'] = $this->db->get_where('main_emp_actions', array('id' => $id, 'isactive' => 1))->row_array();

        $this->db->select('main_positions.positionname AS Job_Title');
        $this->db->join('main_positions', 'main_positions.id = main_employees.position', 'LEFT');
        $param['Job_Title'] = $this->db->get_where('main_employees', array('employee_id' => $param['Emp_Data']['employee_id']))->row('Job_Title');

        $sql = 'SELECT CONCAT(first_name," ", middle_name," ", last_name) AS Sup_Name FROM main_employees'
                . ' WHERE `employee_id`=(SELECT `reporting_manager` FROM main_emp_workrelated WHERE `employee_id`=' . $param['Emp_Data']['employee_id'] . ')';
        $param['Supervisor_Name'] = $this->db->query($sql)->row("Sup_Name");

        $this->db->where('main_emp_workrelated.employee_id', $param['Emp_Data']['employee_id']);
        $this->db->join('main_emp_workrelated', 'main_emp_workrelated.department = main_department.id', 'LEFT');
        $this->db->select('department_name');
        $param['Work_Data'] = $this->db->get('main_department')->row_array();

        if (empty($param['Work_Data'])) {
            $param['Work_Data']['department_name'] = '';
        }

//        pr($param['Emp_Data']);
//        $this->load->view('hr/reports/incident_pdf', $param);

        $this->pdf->load_view('hr/reports/incident_pdf', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Incident_Report.pdf");
    }

    public function accident_pdf() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param = array();

        $param['Emp_Data'] = $this->db->get_where('main_emp_actions', array('id' => $id, 'isactive' => 1))->row_array();

        $this->db->where('main_emp_workrelated.employee_id', $param['Emp_Data']['employee_id']);
        $this->db->join('main_emp_workrelated', 'main_emp_workrelated.department = main_department.id', 'LEFT');
        $this->db->select('department_name');
        $param['Work_Data'] = $this->db->get('main_department')->row_array();

        if (empty($param['Work_Data'])) {
            $param['Work_Data']['department_name'] = '';
        }

//        pr($param['Emp_Data']);
//        $this->load->view('hr/reports/accident_pdf', $param);

        $this->pdf->load_view('hr/reports/accident_pdf', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Accident_Report.pdf");
    }

    public function accident_inv_pdf() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param = array();

        $param['Emp_Data'] = $this->db->get_where('main_emp_actions', array('id' => $id, 'isactive' => 1))->row_array();

        $this->db->join('main_positions', 'main_positions.id = main_employees.position', 'LEFT');
        $param['emp_data'] = $this->db->get_where('main_employees', array('employee_id' => $param['Emp_Data']['employee_id']))->row_array();

        $this->db->where('main_emp_workrelated.employee_id', $param['Emp_Data']['employee_id']);
        $this->db->join('main_emp_workrelated', 'main_emp_workrelated.department = main_department.id', 'LEFT');
        $this->db->select('department_name');
        $param['Work_Data'] = $this->db->get('main_department')->row_array();

        if (empty($param['Work_Data'])) {
            $param['Work_Data']['department_name'] = '';
        }

        /* pr($param['Emp_Data']);
          pr($param['emp_data']);
          pr($param['Work_Data']);
          $this->load->view('hr/reports/accident_inv_pdf', $param); */

        $this->pdf->load_view('hr/reports/accident_inv_pdf', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Accident_Inv_Report.pdf");
    }

    public function accident_report() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param = array();

        $param['company_name'] = $this->Common_model->get_name($this, $this->company_id, 'main_company', 'company_short_name');
        $param['company_logo'] = $this->Common_model->get_name($this, $this->company_id, 'main_company', 'company_logo');

        $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_emp_actions.employee_id');
        $this->db->join('main_employees', 'main_employees.employee_id = main_emp_actions.employee_id');
        $param['action_info'] = $this->db->get_where('main_emp_actions', array('main_emp_actions.id' => $id))->row();

//        pr($param['action_info']);
//        $this->load->view('hr/reports/accident_report', $param);

        $this->pdf->load_view('hr/reports/accident_report', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Accident_Report.pdf");
    }

    public function medical_attention_refusal() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param = array();

        $param['Emp_Data'] = $this->db->get_where('main_emp_actions', array('id' => $id, 'isactive' => 1))->row_array();

        // $this->load->view('hr/reports/medical_attention_refusal', $param);

        $this->pdf->load_view('hr/reports/medical_attention_refusal', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("medical_attention_refusal.pdf");
    }

    public function work_comp_claim() {
        $this->load->library('Pdf');

        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param = array();

        $this->db->join('main_employees', 'main_employees.employee_id = main_emp_actions.employee_id');
        $param['Emp_Data'] = $this->db->get_where('main_emp_actions', array('main_emp_actions.id' => $id, 'main_emp_actions.isactive' => 1))->row_array();

        // $this->load->view('hr/reports/work_comp_claim', $param);

        $this->pdf->load_view('hr/reports/work_comp_claim', $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("work_comp_claim.pdf");
    }

    public function get_county_for_ajax() {
        $county = $this->db->get('main_county')->result();
        return $county;
    }

    public function load_county_name() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_county', array('state_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->county_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function add_observation_action() {

        $this->form_validation->set_rules('Observation_Date', 'Observation Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('Start_Time', 'Start Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('End_Time', 'End Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('Action', 'Action', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('Next_Follow_Date', 'Next Follow Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $employee_data = $this->session->userdata('employee');
            $employee_id = $employee_data ['employee_id'];
            $insert_array = array(
                'company_id' => $this->company_id,
                'employee_id' => $employee_id,
                'action_id' => $this->input->post('obs_action_id'),
                'action_type' => $this->input->post('obs_action_type'),
                'observation_date' => $this->Common_model->convert_to_mysql_date($this->input->post('Observation_Date')),
                'start_time' => $this->input->post('Start_Time'),
                'end_time' => $this->input->post('End_Time'),
                'action' => $this->input->post('Action'),
                'description' => $this->input->post('Description'),
                'next_follow_date' => $this->Common_model->convert_to_mysql_date($this->input->post('Next_Follow_Date')),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => 1
            );

            $res = $this->db->insert('main_observation_action', $insert_array);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    public function get_observation_data() {
        /* pr($this->input->post(), 1); */

        $action_id = $this->input->post('action_id');

        $query = $this->db->get_where('main_observation_action', array('action_id' => $action_id));

        $output = '';
        if ($query && ($query->num_rows() > 0)) {
            $i = 0;
            foreach ($query->result() as $key => $row) {
                $output .= '<tr>';
                $output .= '<td>' . ( ++$i) . '</td>
                            <td>' . $this->Common_model->show_date_formate($row->observation_date) . '</td>
                            <td>' . $row->start_time . '</td>
                            <td>' . $row->end_time . '</td>
                            <td>' . $row->action . '</td>
                            <td>' . $row->description . '</td>
                            <td>' . $this->Common_model->show_date_formate($row->next_follow_date) . '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="7" class="center-align"><i>- No Data Found -</i></td></tr>';
        }

        echo $output;
        exit();
    }

    /* public function upload_acction_img() {
        pr($this->input->post(), 1);
        pr($_FILES);
    } */

    public function update_ssncode()
    {
        $responseArr = array();

        $responseArr['success'] = false;
        $responseArr['msg'] = "SSN Code not provided";
        $responseArr['ssnCode'] = "";

        if (isset($_POST['employee_id']) && (isset($_POST['ssn_code']) && !empty($_POST['ssn_code']))) {
            $employeeId = $_POST['employee_id'];
            $ssnCode = $_POST['ssn_code'];

            $data = array('ssn_code' => $this->Common_model->encrypt($ssnCode));

            $this->Common_model->update_data('main_employees', $data, array('id' => $employeeId));

            $responseArr['success'] = true;
            $responseArr['msg'] = "SSN Code successfully updated";
        }

        echo json_encode($responseArr);
    }
    
   public function validate_change_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        $errorMessage = 'The {field} field must contain, at least one lowercase letter, one uppercase letter, one number, one special character (' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'). ') and minimum 8 characters in length.';
        if (!empty($password))
        {
            if (preg_match_all($regex_lowercase, $password) < 1)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must be at least one lowercase letter.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (preg_match_all($regex_uppercase, $password) < 1)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must be at least one uppercase letter.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (preg_match_all($regex_number, $password) < 1)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must have at least one number.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (preg_match_all($regex_special, $password) < 1)
            {        
                /* $rules = array(
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'callback_validate_change_password',
                    )
                ); */
        
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (strlen($password) < 8)
            {
                // $this->form_validation->set_message('validate_change_password', 'The {field} field must be at least 8 characters in length.');
                $this->form_validation->set_message('validate_change_password', $errorMessage);
                return FALSE;
            }
            if (strlen($password) > 32)
            {
                $this->form_validation->set_message('validate_change_password', 'The {field} field cannot exceed 32 characters in length.');
                return FALSE;
            }

       
        }
         // last 3 password check validation starts
        if (!empty($password)) {
            $user_id = 0;
            $user = $this->db->get_where('main_users', array('id' => $this->input->post('emp_user_id')))->row();
            if ($user) {
                $user_id = $user->id;
            }
    
            // $encryptedPassword = $this->Common_model->encrypt($password);
            $encryptedPassword = md5($password);

            $this->db->select();
            $this->db->from('user_password');
            $this->db->where(array('user_id' => $user_id));
            $this->db->order_by('id', 'DESC');
            $this->db->limit(3);
            $query = $this->db->get();

            $last3Passwords = $query->result();

            $foundInLastThreePassword = false;
            foreach ($last3Passwords as $userOldPassowrd) {
                if ($userOldPassowrd->password == $encryptedPassword) {
                    $foundInLastThreePassword = true;
                }
            }

            //print_r($encryptedPassword);exit;
    
            if ($foundInLastThreePassword) {
                $this->form_validation->set_message('validate_change_password', 'Your new password must not match any of your previous three passwords.');
                return FALSE;  
            }
        }   
        
        // last 3 password check validation ends

        return TRUE;
    }
}
