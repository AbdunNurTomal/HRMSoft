<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Separation_Information extends CI_Controller {

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
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Separation Information";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_separation_information', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_separation_information', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Separation_Information.php';
        $this->load->view('admin/home', $param);
    }

    public function add_separation_information() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Add Separation Information";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addSeparationInformation.php';
        $this->load->view('admin/home', $param);
    }

    public function save_Separation_Information() {

        $this->form_validation->set_rules('employee', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('termination_type', 'Termination Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('last_paycheck_date', 'Last Paycheck Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('separation_date', 'Separation Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee'),
                'termination_type' => $this->input->post('termination_type'),
                'exit_interview_id' => $this->input->post('exit_interview_id'),
                'description' => $this->input->post('description'),
                'last_paycheck_date' => $this->Common_model->convert_to_mysql_date($this->input->post('last_paycheck_date')),
                'separation_date' => $this->Common_model->convert_to_mysql_date($this->input->post('separation_date')),
                'documents' => $this->input->post('separation_documents'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_separation_information', $data);

            $udata = array('isactive' => '0');
            $ures = $this->Common_model->update_data('main_employees', $udata, array('employee_id' => $this->input->post('employee')));

            if ($res && $ures) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_separation_information() {
        //$this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "2";
        $param['page_header'] = "Edit Separation Information";
        $param['module_id'] = $this->module_id;
         // check permission to view the employee starts
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            //print_r($this->uri->segment(3)); exit;
            $this->KurunthamModel->checkPageAccess("emp_separation", $this->uri->segment(3), $this->company_id);
        }
        // check permission to view the employee ends


        $param['query'] = $this->db->get_where('main_separation_information', array('employee_id' => $this->uri->segment(3)));
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addSeparationInformation.php';
        $this->load->view('admin/home', $param);
    }

    public function update_Separation_Information() {

        $this->form_validation->set_rules('employee', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('termination_type', 'Termination Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('last_paycheck_date', 'Last Paycheck Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('separation_date', 'Separation Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee'),
                'termination_type' => $this->input->post('termination_type'),
                'description' => $this->input->post('description'),
                'exit_interview_id' => $this->input->post('exit_interview_id'),
                'last_paycheck_date' => $this->Common_model->convert_to_mysql_date($this->input->post('last_paycheck_date')),
                'separation_date' => $this->Common_model->convert_to_mysql_date($this->input->post('separation_date')),
                'documents' => $this->input->post('separation_documents'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_separation_information', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function download_exit_pdf() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $id = $this->uri->segment(3);
        $termination_type = $this->uri->segment(4);
        $this->db->from('main_separation_information');
        $this->db->where('id',$id);
        $this->db->select('employee_id');
        $sepration_info = $this->db->get()->row_array();
        $sepration_emp = array_values($sepration_info);

        $param = array();
        if ($termination_type == 0) { 
            // Voluntary
            $param['page_header'] = "Voluntary Termination";
            $param['Exit_Data'] = $this->db->get_where('main_voluntary_info', array('employee_id' => $sepration_emp[0]))->row_array();
            
            $file_path = 'hr/reports/voluntary_pdf';
            $download_name = "Voluntary Report";
        } elseif ($termination_type == 1) {
            //In-Voluntary
            
            //print_r($sepration_emp[0]); exit;
            $param['page_header'] = "Involuntary Termination";
            $param['Exit_Data'] = $this->db->get_where('main_involuntary_info', array('employee_id' => $sepration_emp[0]))->row_array();
            
            $file_path = 'hr/reports/involuntary_pdf';
            $download_name = "Involuntary Report";
        }

//        $this->load->view($file_path, $param);

        $this->load->library('Pdf');
        $this->pdf->load_view($file_path, $param);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream($download_name . ".pdf");
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_separation_information", $id);
        redirect('Con_Separation_Information/');
        exit;
    }

    public function upload_documents_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'separation_documents_file';

        if ($status != "error") {
            $config['upload_path'] = './uploads/separation_documents/';
            $config['allowed_types'] = 'doc|docx|txt|pdf';
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

    public function download_documents() {
        $documents_path = $this->uri->segment(3);
        if ($documents_path != "") {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/separation_documents/' . $documents_path));
            $url = Get_File_Directory('/uploads/separation_documents/' . $documents_path);
            $data = file_get_contents($url);
            force_download($documents_path, $data);
        }
    }

    public function get_ajax_exit_interview_info($emp_id) {
        $vol_info = $this->db->get_where('main_voluntary_info', array('employee_id' => $emp_id, 'company_id' => $this->company_id))->row();
        $Invol_info = $this->db->get_where('main_involuntary_info', array('employee_id' => $emp_id, 'company_id' => $this->company_id))->row();

        if (!empty($vol_info)) {
            $output = array('exit_id' => $vol_info->id, 'employee_id' => $vol_info->employee_id, 'termination_type' => $vol_info->termination_type); /* `exit_type` 0 for Voluntary; 1 for Involuntary */
        } elseif (!empty($Invol_info)) {
            $output = array('exit_id' => $Invol_info->id, 'employee_id' => $Invol_info->employee_id, 'termination_type' => $Invol_info->termination_type);
        } else {
            $output = array('exit_id' => '', 'employee_id' => '');
        }

        echo json_encode($output);
        exit();
    }

    public function get_ajax_separation_info($infoType, $emp_id) {

        $output = $output2 = $output3 = '';

        $employee_id = $emp_id;

        if ($infoType == 'pI') {

            $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
            foreach ($personal_info_query->result() as $prow) {
                $output .= '<tr>
                            <th>First Name : </th>
                            <td>' . ucwords($prow->first_name) . '</td>
                            <th>Middle Name : </th>
                            <td>' . ucwords($prow->middle_name) . '</td>
                        </tr>
                        <tr>
                            <th>SSN : </th>
                            <td>XXX-XX-' . substr($prow->ssn_code, -4) . '</td>
                            <th>Email : </th>
                            <td>' . $prow->email . '</td>
                        </tr>
                        <tr>
                            <th>Hire Date : </th>
                            <td>' . $this->Common_model->show_date_formate($prow->hire_date) . '</td>
                            <th>Birth Date : </th>
                            <td>' . $this->Common_model->show_date_formate($prow->birthdate) . '</td>
                        </tr>
                        <tr>
                            <th>Position : </th>
                            <td>' . $this->Common_model->get_name($this, $prow->position, "main_jobtitles", "job_title") . '</td>
                            <th>Mobile Phone</th>
                            <td>' . $prow->mobile_phone . '</td>
                        </tr>';
            }
            echo json_encode(array('result' => $output));
        } elseif ($infoType == 'wR') {

            $work_info_query = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id));

            if ($work_info_query->num_rows() > 0) {
                $output2 .= '<div class="table-responsive">
                            Work Related Information:
                            <table id="WorkRelated" class="table table-responsive table-striped table-bordered table-hover">
                                <tbody>';
                $i = 0;
                foreach ($work_info_query->result() as $wrow) {
                    $i++;
                    $output2 .= '<tr>
                        <th>Location : </th>
                        <td>' . $this->Common_model->get_name($this, $wrow->location, 'main_location', 'location_name') . '</td>
                        <th>Department : </th>
                        <td>' . $this->Common_model->get_name($this, $wrow->department, 'main_department', 'department_name') . '</td>
                    </tr>
                    <tr>
                        <th>Reporting Manager : </th>
                        <td>' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'last_name') . '</td>
                        <th>Wages : </th>
                        <td>' . $this->Common_model->get_name($this, $wrow->wages, 'main_payfrequency_type', 'freqcode') . '</td>
                    </tr>';
                }
                $output2 .= '</tbody>
                            </table>
                    </div>';
            }
            echo json_encode(array('result2' => $output2));
        } elseif ($infoType == 'aI') {

            $asser_query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id));

            foreach ($asser_query->result() as $asrow) {
                $output3 .= '<tr>
                                <th>
                                    <div class="container" style="text-align: left; margin-left: 20px;">
                                        <div class="row">Asset Type :' . $this->Common_model->get_name($this, $asrow->asset_type_id, 'main_assets_type', 'asset_type') . '</div>
                                        <div class="row">Asset Category :' . $this->Common_model->get_name($this, $asrow->asset_category_id, ' main_assets_category', 'asset_category') . '</div>
                                        <div class="row">Asset Name :' . $this->Common_model->get_name($this, $asrow->asset_id, 'main_assets_name', 'asset_name') . '</div>
                                    </div>
                                </th>
                                <th>
                                    <div class="container" style="text-align: left; margin-left: 20px;">
                                        <div class="row">Asset Model :' . $this->Common_model->get_name($this, $asrow->asset_model_id, 'main_assets_detail', 'asset_id') . '</div>
                                        <div class="row">Issued Date :' . $asrow->issued_date . '</div>
                                        <div class="row" style=" color: #72c02c;">Status :';
                if ($asrow->IsAssigned == 1) {
                    $output3 .= "Assigned";
                } else if ($asrow->IsAssigned == 2) {
                    $output3 .= "Return";
                }
                $output3 .= '</div>
                                    </div>
                                </th>
                                <th>
                                    <div class="container" style="text-align: left; margin-left: 20px;">
                                        <div class="row">Quantity :' . $asrow->quantity . '</div>
                                        <div class="row">value :' . $asrow->value . '</div>
                                        <div class="row">Total value :' . $asrow->total_value . '</div>
                                    </div>
                                </th>
                            </tr>';
            }

            echo json_encode(array('result3' => $output3));
        }
        exit();
    }

}
