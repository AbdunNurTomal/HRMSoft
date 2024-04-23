<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Organization_Setup extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
    public $module_id = null;
    public $date_time = null;
    public $insert_company_id = null;
    public $insert_company_user_id = null;
    public $company_settings_id = null;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('hr_logged_in')) {
            redirect('Chome/logout', 'refresh');
        }

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

        $param['module_id'] = $this->module_id;
        $param['user_group'] = $this->user_group;
        $param['user_id'] = $this->user_id;
        $param['page_header'] = "Organization Setup";
        
        if ($this->user_group !=1 || $this->user_group !=2 || $this->user_group !=3) {
            $this->db->order_by('sequence', 'ASC');
            $result = $this->db->get_where('main_organization_settings', array('company_id' => $this->company_id, 'isactive' => 1))->result();
            //echo $this->db->last_query();
        } else {
            $this->db->order_by('sequence', 'ASC');
            $result = $this->db->get_where('main_organization_settings', array('isactive' => 1))->result();
            //echo $this->db->last_query();
        }
        
         $org = array();
        if (!empty($result)) {
            $i = 0;
            foreach ($result as $row) {
                $this->db->join('main_positions', 'main_positions.id = main_employees.position', 'LEFT');
                $record = $this->db->get_where('main_employees', array('employee_id' => $row->employee_id))->row();

                $org[$i]['node'] = $record ? $record->first_name : "-";
                $org[$i]['position'] = $record ? $record->positionname : "-";

                if ($row->hierarchy > 0) {
                    $employee = $this->Common_model->get_row_by_field('employee_id', 'main_employees', $row->hierarchy);
                    $org[$i]['parent'] = $employee ? $employee->first_name : "-";
                } else {
                    $org[$i]['parent'] = '';
                }
                $i++;
            }
        }
        $param['organogram'] = $org;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'company_settings/view_add_organization.php';
        $this->load->view('admin/home', $param);
    }

    public function load_emp_position() {

        $emp_id = $this->uri->segment(3);
        $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $emp_id, 'main_employees', 'position');
        $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $emp_id, 'main_employees', 'image_name');
        $position_name = $this->Common_model->get_name($this, $emp_position, 'main_jobtitles', 'job_title');

        $query = $this->db->get_where('main_organization_settings', array('employee_id' => $emp_id));
        $hierarchy = "";
        $sequence = "";
        if ($query) {
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $hierarchy = $row->hierarchy;
                    $sequence = $row->sequence;
                }
            }
        }

        echo $position_name . "_" . $emp_image . "_" . $hierarchy . "_" . $sequence;
    }

    public function save_organization_settings() {

        $this->form_validation->set_rules('employee_id', 'Employee', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $query = $this->db->get_where('main_organization_settings', array('employee_id' => $this->input->post('employee_id')));
            if ($query) {
                if ($query->num_rows() > 0) {

                    $udata = array(
                        'company_id' => $this->company_id,
                        'employee_id ' => $this->input->post('employee_id'),
                        'hierarchy' => $this->input->post('hierarchy'),
                        'sequence' => $this->input->post('sequence'),
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => '1',
                    );

                    $ures = $this->Common_model->update_data('main_organization_settings', $udata, array('employee_id' => $this->input->post('employee_id')));

                    if ($ures) {
                        echo $this->Common_model->show_massege(2, 1);
                    } else {
                        echo $this->Common_model->show_massege(3, 2);
                    }
                } else {

                    $data = array(
                        'company_id' => $this->company_id,
                        'employee_id ' => $this->input->post('employee_id'),
                        'hierarchy' => $this->input->post('hierarchy'),
                        'sequence' => $this->input->post('sequence'),
                        'createdby' => $this->user_id,
                        'createddate' => $this->date_time,
                        'isactive' => '1',
                    );

                    $res = $this->Common_model->insert_data('main_organization_settings', $data);

                    if ($res) {
                        echo $this->Common_model->show_massege(0, 1);
                    } else {
                        echo $this->Common_model->show_massege(1, 2);
                    }
                }
            } else {

                $data = array(
                    'company_id' => $this->company_id,
                    'employee_id ' => $this->input->post('employee_id'),
                    'hierarchy' => $this->input->post('hierarchy'),
                    'sequence' => $this->input->post('sequence'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->insert_data('main_organization_settings', $data);

                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
            }
        }
    }

    
}
