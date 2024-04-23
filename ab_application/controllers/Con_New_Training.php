<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_New_Training extends CI_Controller {

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
        $param['page_header'] = "New Training";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_new_training', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_new_training', array('isactive' => 1));
        }
        $this->db->order_by('id', 'ASC');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_New_Training.php';
        $this->load->view('admin/home', $param);
    }

    public function add_New_Training() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "New Training";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4 || $this->user_group == 1) { //Hr Manager //Company User //Admin //HR
            $param['eligible_query'] = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['eligible_query'] = $this->db->get_where('main_employmentstatus', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addNew_Training.php';
        $this->load->view('admin/home', $param);
    }
    
    public function upload_training_documents() {
        $status = "";
        $msg = "";
        $file_element_name = 'training_documents_file';

        if ($status != "error") {
            $config['upload_path'] = './uploads/training_documents/';
            $config['allowed_types'] = 'doc|docx|txt|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;
            
            /* $newFileName = $_FILES[$file_element_name]['name'];
            $fileExt = explode(".", $newFileName);
            $filename = time().".".$fileExt[1];
            $config['file_name'] = $filename; */
            $uploadedFileName = @pathinfo($_FILES[$file_element_name]['name'])["filename"];
            $uploadedFileNameOrg = $uploadedFileName;
            $uploadedFileExtension = @pathinfo($_FILES[$file_element_name]['name'])["extension"];
            $newFileName = str_replace(" ", "_", $uploadedFileName);
            $newFileName = str_replace(".", "_", $newFileName) . "." . $uploadedFileExtension;
            // $fileExt = explode(".", $newFileName);
            $filename = time() . "." . $uploadedFileExtension;
            $config['file_name'] = $filename;

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
            // echo $this->Common_model->show_validation_massege($msg, 1) . "__" . $file_name;
            echo $this->Common_model->show_validation_massege($msg, 1) . "__" . $file_name . "__" . ($uploadedFileNameOrg . "." . $uploadedFileExtension);
        } else {
            echo $this->Common_model->show_validation_massege($msg, 2);
        }
    }
        

    public function save_New_Training() {
        
        $this->form_validation->set_rules('training_name', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('training_type', 'Training Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_level', 'Training Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            
             $eligible = '';
            $elig = $this->input->post('eligible');
            if ($elig) {
                foreach ($elig as $elg) {
                    if ($eligible == '') {
                        $eligible = $elg;
                    } else {
                        $eligible = $eligible . "," . $elg;
                        
                    }
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
                //'basic_information' => $this->input->post('basic_information'),
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

    function edit_New_Training() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Job Requisition";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4 || $this->user_group == 1) {//Hr Manager //Company User //Admin //HR
            $param['eligible_query'] = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['eligible_query'] = $this->db->get_where('main_employmentstatus', array('isactive' => 1));
        }

        $param['query'] = $this->db->get_where('main_new_training', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_addNew_Training.php';
        $this->load->view('admin/home', $param);
    }

    public function update_New_Training() {
        
        $this->form_validation->set_rules('training_name', 'Training Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        // $this->form_validation->set_rules('training_type', 'Training Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('training_level', 'Training Level', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            // echo "<pre>". print_r($this->input->post(),1) ."</pre>";exit;
            $eligible = '';
            $elig = $this->input->post('eligible');
            if ($elig) {
                foreach ($elig as $elg) {
                    if ($eligible == '') {
                        $eligible = $elg;
                    } else {
                        $eligible = $eligible . "," . $elg;
                    }
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
                //'basic_information' => $this->input->post('basic_information'),
                'course_information' => $this->input->post('course_information'),
                'training_documents_name' => $this->input->post('training_documents_name'),
                'training_documents' => $this->input->post('training_documents'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => $this->input->post('status'),
            );

            $res = $this->Common_model->update_data('main_new_training', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_New_Training() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_new_training", $id);
        redirect('Con_New_Training/');
        exit;
    }
    
    public function download_training_documents() {
        $documents_path = $this->uri->segment(3);
        if($documents_path!="")
        {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/training_documents/' . $documents_path));
            $url = Get_File_Directory('/uploads/training_documents/' . $documents_path);
            $data = file_get_contents($url);
            force_download($documents_path, $data);
        }
    }

}
