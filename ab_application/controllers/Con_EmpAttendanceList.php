<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_EmpAttendanceList extends CI_Controller {

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
        $param['page_header'] = "Employee Attendence List";
        $param['module_id'] = $this->module_id;

        if (($this->user_group == 11) || ($this->user_group == 12)) {
            $param['department'] = $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['department'] = $this->Common_model->listItem('main_department');
        }

        //echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'attendance/view_EmpAattendanceList.php';
        $this->load->view('admin/home', $param);
    }

    public function dep_emp() {

        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_emp_workrelated', array('department' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->employee_id . ">" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') . "</option>";
            }
        } else {
            echo"<option> No Plan Added </option>";
        }
    }

    public function emp_attendance() {
        $department_id = $this->input->post('department_id');
        $employee_id = $this->input->post('employee_id');
        $start_date = $this->Common_model->convert_to_mysql_date($this->input->post('start_date'));
        $end_date = $this->Common_model->convert_to_mysql_date($this->input->post('end_date'));
        $this->db->select('ma.*, ma.id as att_id');
        $this->db->from('main_attendance as ma');
        $this->db->join('main_emp_workrelated as ew', 'ew.employee_id = ma.employee_id');
        if ($department_id)
            $this->db->where('ew.department', $department_id);
        if ($employee_id)
            $this->db->where('ma.employee_id', $employee_id);
        if ($start_date)
            $this->db->where('ma.attendance_date >=', $start_date);
        if ($end_date)
            $this->db->where('ma.attendance_date <=', $end_date);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        exit();
//        

        if ($query->num_rows() > 0) {
            $sr = 0;
            foreach ($query->result() as $row) {
                $sr = $sr + 1;
                $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'position');
//                $position_name = $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                print
                        "<tr>"
                        . "<td>" . $sr . "</td>"
                        . "<td>" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') . "</td>"
                        . "<td>" . $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname') . "</td>"
                        . "<td>" . $row->attendance_date . "</td>"
                        . "<td>" . $row->in_time . "</td>"
                        . "<td>" . $row->out_time . "</td>"
                        . "<td>" . $row->duration . "</td>"
                        . "<td class='mycol' id='action_td' style='width: 12%;'><a class='btn btn-sm btn-u' href='#' onclick='edit_emp_attendance($row->att_id);'> Edit </a>&nbsp;</td>"
                        . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 8 class="text-info">No Plan added.</td></tr>';
        }
    }

    public function ajax_edit_attendance() {
        $id = $this->uri->segment(3);
        $data = $this->Common_model->get_by_id_row('main_attendance', $id);
        echo json_encode($data);
    }

    public function update_emp_attendance() {
        $this->form_validation->set_rules('employee_id2', 'Employee Id', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('attendance_date', 'Attendance Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('in_time', 'In Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('out_time', 'Out Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $duration = 8;
            $data = array('company_id' => $this->company_id,
                'employee_id' => $this->input->post('employee_id2'),
                'attendance_date' => $this->Common_model->convert_to_mysql_date($this->input->post('attendance_date')),
                'in_time' => $this->input->post('in_time'),
                'out_time' => $this->input->post('out_time'),
                'duration' => $duration,
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
                'id' => $this->input->post('id_attendance'),
            );
//            echo '<pre>';
//            print_r($data);
//            exit();


            $res = $this->Common_model->update_data('main_attendance', $data, array('id' => $this->input->post('id_attendance')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

}
