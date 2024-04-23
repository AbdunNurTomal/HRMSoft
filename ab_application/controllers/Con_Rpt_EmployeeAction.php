<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Rpt_EmployeeAction extends CI_Controller {

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

    public function index($menu_id, $show_result = FALSE, $search_ids = array(), $search_criteria = array('emp_id' => '', 'action_type' => '' , 'action_from' => '', 'action_to' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $extra_sql = "";
        if ($this->user_group == 11 || $this->user_group == 12) {
            $extra_sql = "AND company_id={$this->company_id}";
        }
        $inc_sql = "SELECT employee_id, first_name, middle_name, last_name FROM main_employees WHERE employee_id IN (SELECT DISTINCT(`employee_id`) FROM main_emp_actions WHERE `action_type`=1 {$extra_sql}) ORDER BY `employee_id` DESC";
        $param['emp_list'] = $this->db->query($inc_sql);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Action Report";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'report/view_Rpt_Employee_Action.php';
        $this->load->view('admin/home', $param);
    }
    
    public function get_action_report_data() {

        $ids = $search_criteria = array();

        $search_criteria['emp_id'] = $emp_id = $this->input->post('emp_name');
        $search_criteria['action_type'] = $action_type = $this->input->post('action_type');
        $search_criteria['action_from'] = $action_from = $this->input->post('action_from');
        $search_criteria['action_to'] = $action_to = $this->input->post('action_to');

        if (($emp_id != '') || ($action_type != '') || ($action_from != '') || ($action_to != '')) {

            $this->db->select('id');
            /* ----Conditions---- */
            if ($emp_id != '') {
                $this->db->where('employee_id', $emp_id);
            }
            if ($action_type != '') {
                $this->db->where('action_type', $action_type);
            }
            if ($action_from != '') {
                $this->db->where('action_date >=', $this->Common_model->convert_to_mysql_date($action_from));
            }
            if ($action_to != '') {
                $this->db->where('action_date <=', $this->Common_model->convert_to_mysql_date($action_to));
            }

            //$this->db->where('action_type', 1);
            $ids = $this->db->get('main_emp_actions')->result_array();
        }

        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
    }

    public function get_action_data() {
        $acoutput = '';
        $dsoutput = '';
        $action_id = $this->input->post('action_id');

        $acquery = $this->db->get_where('main_emp_actions', array('id' => $action_id));
        $dcquery = $this->db->get_where('main_emp_actions', array('id' => $action_id));
        $action_type_array = array(1 => 'Incident', 2 => 'Accident');
        $incident_category_array = $this->Common_model->get_array('incident_category');
        $injury_type = $this->Common_model->get_array('type_of_injury');
        $injured_body_parts = $this->Common_model->get_array('bodypart_injurylist');

        //-------- Action Detail --------
        if ($acquery && ($acquery->num_rows() > 0)) {
            $i = 0;
            foreach ($acquery->result() as $keyy => $vall) {//Incident
                if ($vall->action_type == 1) {
                    $acoutput .= '<tr>';
                    $acoutput .= '<td colspan="4" class="center-align"><h4><b>' . $action_type_array[$vall->action_type] . ' Detail ' . '</b></h4></td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Action Date</td>
                                <td>' . $this->Common_model->show_date_formate($vall->action_date) . '</td>
                                <td>Action Time</td>                                
                                <td>' . $vall->accident_time . '</td>';
                    $acoutput .= '</tr>';

                    $acoutput .= '<tr>';
                    $acoutput .= '<td>Incident Type</td>
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
                                <td>' . $vall->report_description . '</td>';
                    $acoutput .= '</tr>';



                    if ($vall->any_witness == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Witness</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Witness Name</td>
                                    <td>' . ($vall->accident_witness != '' ? $vall->accident_witness : 'No Witness Name') . '</td>';
                        $acoutput .= '<td>Witness Phone</td>
                                     <td>' . ($vall->accident_witness_phone != '' ? $vall->accident_witness_phone : 'No Witness Phone Number') . '</td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Witness Address</td>
                                     <td>' . ($vall->accident_witness_address != '' ? $vall->accident_witness_address : 'No Witness Address') . '</td>';
                        $acoutput .= '</tr>';
                    }
                    if ($vall->report_hr == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Reported to HR</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Date</td>
                                    <td>' . $this->Common_model->show_date_formate($vall->hr_report_date) . '</td>';
                        $acoutput .= '<td>Reported By</td>
                                     <td>' . $vall->hr_reported_by . '</td>';
                        $acoutput .= '</tr>';                        
                    }
                    if ($vall->report_supervisor == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Reported to Supervisor</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Date</td>
                                    <td>' . $this->Common_model->show_date_formate($vall->supervisor_report_date) . '</td>';
                        $acoutput .= '<td>Reported By</td>
                                     <td>' . $vall->supervisor_reported_by . '</td>';
                        $acoutput .= '</tr>';
                    }
                } else if ($vall->action_type == 2) {//Accident
                    $acoutput .= '<tr>';
                    $acoutput .= '<td colspan="4" class="center-align"><h4><b>' . $action_type_array[$vall->action_type] . ' Detail ' . '</b></h4></td>';
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
                    $acoutput .= '<td>njury Type</td>';

                    $ing_type = "";
                    if ($vall->injury_type != "") {
                        $inj_type = explode(",", $vall->injury_type);
                        if (!empty($inj_type)) {

                            foreach ($inj_type as $key) {

                                if ($ing_type == "") {
                                    $ing_type = $injury_type[$key];
                                } else {
                                    $ing_type = $ing_type . " , " . $injury_type[$key];
                                }
                            }
                        } else {
                            $acoutput .= '<td>' . '' . '</td>';
                        }
                    }
                    $acoutput .= '<td>' . $ing_type . '</td>';
                    $acoutput .='<td>Injured Body Parts</td>';


                    $ing_body_parts = "";
                    if ($vall->injury_type != "") {
                        $inj_body_parts = explode(",", $vall->injured_body_parts);
                        if (!empty($inj_body_parts)) {

                            foreach ($inj_body_parts as $val) {

                                if ($ing_body_parts == "") {
                                    $ing_body_parts = $injured_body_parts[$val];
                                } else {
                                    $ing_body_parts = $ing_body_parts . " , " . $injured_body_parts[$val];
                                }
                            }
                        } else {
                            $acoutput .= '<td>' . '' . '</td>';
                        }
                    }

                    $acoutput .='<td>' . $ing_body_parts . '</td>';
                    $acoutput .= '</tr>';
                    
                    if ($vall->any_witness == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Witness</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Witness Name</td>
                                    <td>' . ($vall->accident_witness != '' ? $vall->accident_witness : 'No Witness Name') . '</td>';
                        $acoutput .= '<td>Witness Phone</td>
                                     <td>' . ($vall->accident_witness_phone != '' ? $vall->accident_witness_phone : 'No Witness Phone Number') . '</td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Witness Address</td>
                                     <td>' . ($vall->accident_witness_address != '' ? $vall->accident_witness_address : 'No Witness Address') . '</td>';
                        $acoutput .= '</tr>';
                    }
                    if ($vall->report_hr == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Reported to HR</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Date</td>
                                    <td>' . $this->Common_model->show_date_formate($vall->hr_report_date) . '</td>';
                        $acoutput .= '<td>Reported By</td>
                                     <td>' . $vall->hr_reported_by . '</td>';
                        $acoutput .= '</tr>';
                        
                    }
                    if ($vall->report_supervisor == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Reported to Supervisor</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Date</td>
                                    <td>' . $this->Common_model->show_date_formate($vall->supervisor_report_date) . '</td>';
                        $acoutput .= '<td>Reported By</td>
                                     <td>' . $vall->supervisor_reported_by . '</td>';
                        $acoutput .= '</tr>';
                    }
                    if ($vall->first_aid_given == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>First Aid given</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>By whom</td>
                                    <td>' . $vall->firstAid_by_whom . '</td>';
                        $acoutput .= '<td>Explain about First Aid given</td>
                                     <td>' . $vall->explain_first_aid . '</td>';
                        $acoutput .= '</tr>';
                    }
                    if ($vall->requires_hospitalization == 1) {
                        $acoutput .= '<tr>';
                        $acoutput .= '<td colspan="4" class= "text-center"><b>Medical Treatment</b></td>';
                        $acoutput .= '</tr>';

                        $acoutput .= '<tr>';
                        $acoutput .='<td>Clinic Name</td>
                                    <td>' . $vall->clinic_name . '</td>';
                        $acoutput .= '<td>Physician</td>
                                     <td>' . $vall->physician_name . '</td>';
                        $acoutput .= '</tr>';
                    }
                }
            }
        }


        //-------- Discipline Action Detail -------->

        if ($dcquery && ($dcquery->num_rows() > 0)) {
            $i = 0;

            foreach ($dcquery->result() as $keyyy => $valll) {//Incident
                if ($valll->discipline_type != 0) {
                    if ($valll->action_type == 1) {
                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Discipline Type</td>
                                <td>' . $this->Common_model->get_name($this, $valll->discipline_type, 'main_disciplinetype', 'discipline_type') . '</td>
                                <td>Verbal Warning By</td>                                
                                <td>' . $valll->verbal_warning_by . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Written Warning By</td>
                                <td>' . $valll->written_warning_by . '</td>
                                <td>Counseled By</td>
                                <td>' . $valll->counseled_by . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Suspended From</td>
                                <td>' . $this->Common_model->show_date_formate($valll->suspended_from) . '</td>
                                <td>Suspended To</td>
                                <td>' . $this->Common_model->show_date_formate($valll->suspended_to) . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Subject</td>
                                <td>' . $valll->subject . '</td>
                                <td>Description</td>
                                <td>' . $valll->description . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Improvement Plan</td>
                                <td>' . $valll->improvement_plan . '</td>
                                <td>Further Actions</td>
                                <td>' . $valll->further_actions . '</td>';
                        $dsoutput .= '</tr>';
                    } else if ($valll->action_type == 2) {//Accident
                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Discipline Type</td>
                                <td>' . $this->Common_model->get_name($this, $valll->discipline_type, 'main_disciplinetype', 'discipline_type') . '</td>
                                <td>Verbal Warning By</td>
                                <td>' . $valll->verbal_warning_by . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Written Warning By</td>
                                <td>' . $valll->written_warning_by . '</td>
                                <td>Counseled By</td>
                                <td>' . $valll->counseled_by . '</td>';
                        $dsoutput .= '</tr>';
                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Suspended From</td>
                                <td>' . $valll->suspended_from . '</td>
                                <td>Suspended To</td>
                                <td>' . $vall->suspended_to . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Subject</td>
                                <td>' . $valll->subject . '</td>
                                <td>Description</td>
                                <td>' . $valll->description . '</td>';
                        $dsoutput .= '</tr>';

                        $dsoutput .= '<tr>';
                        $dsoutput .= '<td>Improvement Plan</td>
                                <td>' . $valll->improvement_plan . '</td>
                                <td>Further Actions</td>
                                <td>' . $valll->further_actions . '</td>';
                        $dsoutput .= '</tr>';
                    }
                } else {
                    $dsoutput .= '<tr><td colspan="7" class="center-align"><i>- No Data Found -</i></td></tr>';
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

        echo $output . "##" . $acoutput . "##" . $dsoutput;
        exit();
    }

}
