<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Rpt_Action_Observation extends CI_Controller {

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
        $param['page_header'] = "Action Observation";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Rpt_Action_Observation.php';
        $this->load->view('admin/home', $param);
    }

    public function action_filter() {
        $leave_status = $this->Common_model->get_array('approver_status');

        $employee = $this->input->post('employee_id');
        $action = $this->input->post('action_type');
        $datee = $this->Common_model->convert_to_mysql_date($this->input->post('observation_date'));

        if ($this->user_group == 12) {

            $this->db->select("*");
            $this->db->from("main_observation_action");
            $this->db->order_by("action_id", "asc");
            $this->db->where('company_id', $this->company_id);
            if ($employee != "") {
                $this->db->where('employee_id', $employee);
            }if ($action) {
                $this->db->where('action_type', $action);
            }if ($datee) {
                $this->db->where('observation_date', $datee);
            }
            $query = $this->db->get();
//            echo $this->db->last_query($query);exit();
        } else {
            $this->db->select("*");
//            $this->db->select("count(*) as fdfd");
            $this->db->from("main_observation_action");
            $this->db->order_by("action_id", "asc");
            if ($employee != "") {
                $this->db->where('employee_id', $employee);
            }if ($action) {
                $this->db->where('action_type', $action);
            }if ($datee) {
                $this->db->where('observation_date', $datee);
            }
            $query = $this->db->get();
        }

//        echo $this->db->last_query();exit();       

        if ($query) {
            $i = 0;
            $row_val = $this->db->query("SELECT `action_id`,count(`action_id`) as number_row FROM `main_observation_action` group by `action_id`")->result_array();
            $row_span = array();
//            pr($row_val,1);
            foreach ($row_val as $row_num) {
                $row_span[$row_num['action_id']] = $row_num['number_row'];
            }
            $same = '';

            if ($query->num_rows() > 0) {
                $sr = 0;
                foreach ($query->result() as $row) {
                    $sr++;

                    print"<tr><td>" . $sr . "</td>";
                    if ($row->action_id != $same) {
                        $same = $row->action_id;
                        print "<td rowspan=" . $row_span[$row->action_id] . "><a href='#' onclick='view_action_falloup(" . $row->action_id . ")'>" . $this->Common_model->show_date_formate($this->Common_model->get_name($this, $row->action_id, 'main_emp_actions', 'action_date')) . "</a></td>";
                    }
                    print "<td>" . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') . "</td><td>" . $this->Common_model->show_date_formate($row->observation_date) . "</td><td>" . $row->start_time . "</td><td>" . $row->end_time . "</td><td>" . $row->action . "</td><td >" . $row->description . "</td><td>" . $this->Common_model->show_date_formate($row->next_follow_date) . "</td></tr>"; //class='td-cw'
                }//
            } else {
                echo'<tr><td colspan = 9 class="text-info">No Plan added.</td></tr>';
            }
        }
    }

    public function get_acobservation_data() {
        $acoutput = '';
        $action_id = $this->input->post('action_id');

        $acquery = $this->db->get_where('main_emp_actions', array('id' => $action_id));
        $action_type_array = array(1 => 'Incident', 2 => 'Accident');
        $incident_category_array = $this->Common_model->get_array('incident_category');

        if ($acquery && ($acquery->num_rows() > 0)) {
            $i = 0;
            foreach ($acquery->result() as $keyy => $vall) {//Incident
                if ($vall->action_type == 1) {
                    $acoutput .= '<tr>
                                  <td colspan="4" class="center-align"><h4><b>' . $action_type_array[$vall->action_type] . '</b></h4></td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Action Date</td>
                                <td>' . $this->Common_model->show_date_formate($vall->action_date) . '</td>
                                <td>Action Time</td>                                
                                <td>' . $vall->accident_time . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>
                                 <td>Incident Type</td>
                                <td>' . $this->Common_model->get_name($this, $vall->tncident_type, 'main_incidenttype', 'incident_type') . '</td>
                                <td>Category</td>
                                <td>' . ($vall->incident_category == 0 ? 'Not Define' : $incident_category_array[$vall->incident_category]) . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Location</td>
                                <td>' . $vall->accident_location . '</td>
                                <td>Employee Comments</td>
                                <td>' . $vall->employee_comments . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Description</td>
                                <td>' . $vall->report_description . '</td>
                                <td>Witness Name</td>
                                <td>' . ($vall->accident_witness != '' ? $vall->accident_witness : 'No Witness Name') . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Witness Phone</td>
                                <td>' . ($vall->accident_witness_phone != '' ? $vall->accident_witness_phone : 'No Witness Phone Number') . '</td>
                                <td>Witness Address</td>
                                <td>' . ($vall->accident_witness_address != '' ? $vall->accident_witness_address : 'No Witness Address') . '</td>';
                    $acoutput .= '</tr>';
                } else if ($vall->action_type == 2) {//Accident
                    $acoutput .= '<tr>';
                    $acoutput .= '<td colspan="4" class="center-align"><h4><b>' . $action_type_array[$vall->action_type] . '</b></h4></td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Accident Date</td>
                                <td>' . $this->Common_model->show_date_formate($vall->action_date) . '</td>
                                <td>Accident Time</td>
                                <td>' . $vall->accident_time . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Location</td>
                                <td>' . $vall->accident_location . '</td>
                                <td>Description</td>
                                <td>' . $vall->report_description . '</td>';
                    $acoutput .= '</tr>';
                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Employee Comments</td>
                                <td>' . $vall->employee_comments . '</td>
                                <td>Nature and extent of injuries</td>
                                <td>' . $vall->nature_of_injury . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Description</td>
                                <td>' . $vall->report_description . '</td>
                                <td>Witness Name</td>
                                <td>' . ($vall->accident_witness != '' ? $vall->accident_witness : 'No Witness Name') . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Witness Phone</td>
                                <td>' . ($vall->accident_witness_phone != '' ? $vall->accident_witness_phone : 'No Witness Phone Number') . '</td>
                                <td>Witness Address</td>
                                <td>' . ($vall->accident_witness_address != '' ? $vall->accident_witness_address : 'No Witness Address') . '</td>';
                    $acoutput .= '</tr>';
                }
            }
        }




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

        echo $output . "##" . $acoutput;
        exit();
    }
    
    
    //-------------------------csv creat------------------------
    
    //                $headding = array(array('SL', 'Action Date', 'Employee Name', 'Follow-up Date', 'Start Time', 'End Time', 'Action'));
//                $headding = array(
//                    array(
//                        'id' => 'SL',
//                        'company_id' => 'company id',
//                        'employee_id' => '10',
//                        'action_id' => '1',
//                        'action_type' => '2',
//                        'observation_date' => '2017-03-10',
//                        'start_time' => '8:10 PM',
//                        'end_time' => '8:35 PM',
//                        'action' => 'Motorbike and truck collision',
//                        'description' => 'Biker seriously injured',
//                        'next_follow_date' => '2017-04-25',
//                        'createdby' => '133',
//                        'modifiedby' => '0',
//                        'createddate' => '2017-04-02 15:39:41',
//                        'modifieddate' => '0000-00-00 00:00:00',
//                        'isactive' => '1',
//                    )
//                );
//                $new_array = array_merge($headding, $query->result_array());
//
//                pr($new_array, 1);
//
//                $fp = fopen('uploads/action_ob_rpt1.csv', 'w'); //
//                foreach ($query->result_array() as $row) {
//
//                    fputcsv($fp, $row); //
//                }
//                fclose($fp); //

}
