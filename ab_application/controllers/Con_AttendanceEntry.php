<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_AttendanceEntry extends CI_Controller {

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
        $param['page_header'] = "Attendence Entry";
        $param['module_id'] = $this->module_id;

        if (($this->user_group == 11) || ($this->user_group == 12)) {
            $param['department'] = $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['department'] = $this->Common_model->listItem('main_department');
        }
//        echo $this->db->last_query();
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'attendance/view_AattendanceEntry.php';
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

    public function employee_attendance() {

        $id = $this->uri->segment(3);

        $this->db->select('ma.*, ew.*, ma.id as att_id');
        $this->db->from('main_emp_workrelated as ew');
        $this->db->join('main_attendance as ma', 'ew.employee_id = ma.employee_id');
        $this->db->where('ew.department', $id);
        $query = $this->db->get();


//        $query = $this->db->get_where('main_emp_workrelated', array('department' => $id));
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

    public function emp_attendance_by_date() {

        $this->form_validation->set_rules('attendance_date', 'Attendance Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $department_id = $this->input->post('department_id');
            $attendance_date = $this->Common_model->convert_to_mysql_date($this->input->post('attendance_date'));

            $this->db->select('main_employees.employee_id AS employee_id, main_employees.company_id, main_emp_workrelated.id AS ew_id');
            $this->db->from('main_employees');
            $this->db->join('main_emp_workrelated', 'main_emp_workrelated.employee_id = main_employees.employee_id', 'LEFT');
            $this->db->where('main_employees.company_id', $this->company_id);
            $this->db->where('main_emp_workrelated.department', $department_id);

            $query = $this->db->get();
            //echo $this->db->last_query();exit();
            if ($query->num_rows() > 0) {
                $sr = 0;
                foreach ($query->result() as $row) {
                    $sr = $sr + 1;
                    $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'position');
                    $res = $this->db->get_where('main_attendance', array('employee_id' => $row->employee_id, 'attendance_date' => $attendance_date))->row_array();

                    if (empty($res)) {
                        $res = array(
                            'attendance_date' => $attendance_date,
                            'in_time' => '',
                            'out_time' => '',
                            'duration' => ''
                        );
                    }

                    $row = (array) $row;
                    $row = array_merge($row, $res);
                    $row = (object) $row;

                    $InTime = ($row->in_time == "00:00:00") ? "" : $row->in_time;
                    $OutTime = ($row->out_time == "00:00:00") ? "" : $row->out_time;

                    print "<tr>"
                            . "<td>" . $sr . "</td>"
                            . "<input type='hidden' name='employee_id[]' id='employee_id_$sr'  value='$row->employee_id' />"
                            . "<td><input class='form-control input-sm' type='text' name='' id='' readonly value='" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') . "' placeholder='' /> </td>"
                            . "<td><input class='form-control input-sm' type='text' name='' id='' readonly value='" . $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname') . "' placeholder='' /></td>"
                            . "<td><input class='form-control dt_pick'  type='text' name='attendance_date[]' id='attendance_date_$sr' readonly value='" . $this->Common_model->show_date_formate($row->attendance_date) . "' placeholder='' /> </td>"
                            . "<td><input class='form-control input-sm' type='text' onchange='time_calculation($sr);' name='in_time[]' id='in_time_$sr' value='$InTime' placeholder='' />  </td>"
                            . "<td><input class='form-control input-sm' type='text' onchange='time_calculation($sr);' name='out_time[]' id='out_time_$sr' value='$OutTime' placeholder='' /> </td>"
                            . "<td><input class='form-control input-sm' type='text' name='duration[]' id='duration_$sr' readonly value='$row->duration' placeholder='' /></td>"
                            . "</tr>";
                }
            } else {
                echo'<tr><td colspan = 8 class="text-info">No Plan added.</td></tr>';
            }
        }
    }

    public function save_empAttendance() {

        //pr($this->input->post(), 1);
//        $this->form_validation->set_rules('employee_id', 'Employee Id', 'required', array('required' => "Please the enter required field, for more Info : %s."));
//        $this->form_validation->set_rules('attendance_date', 'Attendance Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
//        $this->form_validation->set_rules('in_time', 'In Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
//        $this->form_validation->set_rules('out_time', 'Out Time', 'required', array('required' => "Please the enter required field, for more Info : %s."));
//        if ($this->form_validation->run() == FALSE) {
//            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
//        } else {
//            $duration=8;



        $employee_id = $this->input->post('employee_id');
        $attendance_date = $this->input->post('attendance_date');

        $in_time = $this->input->post('in_time');
        $out_time = $this->input->post('out_time');
        $duration = $this->input->post('duration');

        $data = array();
        $udata = array();
        for ($i = 0; $i < count($employee_id); $i++) {
            $chk_att = $this->db->get_where('main_attendance', array('employee_id' => $employee_id[$i], 'attendance_date' => $this->Common_model->convert_to_mysql_date($attendance_date[$i])))->row();

            if ($in_time[$i] == '') {
                $IN_TIME = '';
            } else {
                $IN_TIME = date("H:i:s", strtotime($in_time[$i]));
            }

            if ($out_time[$i] == '') {
                $OUT_TIME = '';
            } else {
                $OUT_TIME = date("H:i:s", strtotime($out_time[$i]));
            }


            if (!empty($chk_att)) {
                // Update
                $Aid = $this->db->get_where('main_attendance', array('employee_id' => $employee_id[$i], 'attendance_date' => $this->Common_model->convert_to_mysql_date($attendance_date[$i])))->row();
                $udata[$i] = array(
                    'id' => $Aid->id,
                    'company_id' => $this->company_id,
                    'employee_id' => $employee_id[$i],
                    'attendance_date' => $this->Common_model->convert_to_mysql_date($attendance_date[$i]),
                    'in_time' => $IN_TIME,
                    'out_time' => $OUT_TIME,
                    'duration' => $duration[$i],
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
            } else {
                //nsert
                if ($duration[$i] == "") {
                    $duration[$i] = 0;
                }
                $data[$i] = array('company_id' => $this->company_id,
                    'employee_id' => $employee_id[$i],
                    'attendance_date' => $this->Common_model->convert_to_mysql_date($attendance_date[$i]),
                    'in_time' => $IN_TIME,
                    'out_time' => $OUT_TIME,
                    'duration' => $duration[$i],
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
            }
        }

        //pr($data);
        //echo "======================";
        //pr($udata); die();

        $flg = 0;
        if (!empty($udata)) {
            $res1 = $this->db->update_batch('main_attendance', $udata, 'id');
            $flg = 1;
        }

        if (!empty($data)) {
            $res2 = $this->db->insert_batch('main_attendance', $data);
            $flg = 1;
        }

        if ($flg == 1) {
            echo $this->Common_model->show_massege(0, 1);
        } else {
            echo $this->Common_model->show_massege(1, 2);
        }
//        }
    }

}
