<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Training extends CI_Controller {
    
    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $module_id = null;
    public $date_time = null;
    public $companyView = false;
      
    public $module_data = array();
    
    public function __construct() {
        parent::__construct();
        
        if( !$this->session->userdata('hr_logged_in') ) {
           redirect('Chome/logout', 'refresh');
        }
        
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];

        $this->companyView = $this->user_data['company_view'];

    }

    public function index() {
        if (!$this->user_id) {
            redirect('chome/logout', 'refresh');
        }
        
        if($this->uri->segment(3))
        {
            $this->module_id = $this->uri->segment(3);
        }
        
        if(!$this->module_id){ $param['module_id']=11;} else { $param['module_id']=$this->module_id; }

        // check module access starts
        $currentModuleId = 11; // Training
        if ($this->user_group <= 3) {
        } else if ($this->user_group == 12 && $this->companyView) {
        } else {
            $this->KurunthamModel->checkModuleAccess($this->user_group, $currentModuleId, $this->user_module);
        }
        // check module access ends

        $module_session_array = array();
        $module_session_array = array('module_id' => $param['module_id']);
        $this->session->set_userdata('active_module_id', $module_session_array);
        
        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Training";
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'sadmin/view_Training_dashbord.php';
        $this->load->view('admin/home', $param);
    }

    public function ajax_training_Modal()
    {
        $tdate = $this->uri->segment(3);
        $tdate = $this->Common_model->convert_to_mysql_date($tdate);

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $query = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1,'req_status' => 1,'proposed_date' => $tdate));
        } else {
            $query = $this->db->get_where('main_training_requisition', array('isactive' => 1,'req_status' => 1,'proposed_date' => $tdate));
        }
        
        $training_status_array = $this->Common_model->get_array('training_status');
        if ($query->num_rows() > 0) {
            $sr = 0;
            foreach ($query->result() as $row) {
                $sr++;

                $employees = explode(",", $row->employee);
                $employeeStr = '';
                foreach ($employees as $employeeId) {
                    if ($employeeStr == '') {
                        $employeeStr = $this->Common_model->get_selected_value($this,'employee_id',$employeeId,'main_employees','first_name');
                    } else {
                        $employeeStr = $employeeStr . "," . $this->Common_model->get_selected_value($this,'employee_id',$employeeId,'main_employees','first_name');
                    }
                }
                // echo "<pre>". print_r($employeeStr, 1) ."</pre>";exit;

                print"<tr><td>" . $sr . "</td><td>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td><td>" . $this->Common_model->show_date_formate($row->proposed_date) . "</td><td>" . $employeeStr . "</td><td>" . $row->training_objective . "</td><td>" . $training_status_array[$row->training_status] . "</td></tr>";
            }
        }
        else {
            echo'<tr><td colspan = 6 class="text-info">No Training added.</td></tr>';
        }
        //$data = $this->Common_model->get_by_id_row('main_emp_assets', $id);
        //echo json_encode($data);
    }
    

}
