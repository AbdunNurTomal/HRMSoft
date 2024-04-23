<?php

class Common_model extends CI_Model {

    public $ipaddress;
    public $operation_msg = array();

    public function __construct() {
        parent::__construct();

        $this->operation_msg[0] = "Record is Saved Successfully";
        $this->operation_msg[1] = "Record was Not Saved Successfully";

        $this->operation_msg[2] = "Record is Updated Successfully";
        $this->operation_msg[3] = "Record was Not Updated Successfully";

        $this->operation_msg[4] = "Record is Deleted Successfully";
        $this->operation_msg[5] = "Record was Not Deleted Successfully";

        $this->operation_msg[6] = "Your Application is recorded Successfully. Please waiting for approval/Review";
        $this->operation_msg[7] = "Your Application was recorded Not Successfully";

        $this->operation_msg[8] = "Record Hired Successfully";
        $this->operation_msg[9] = "Record Not Hired Successfully";

        $this->operation_msg[10] = "Record Rejected Successfully";
        $this->operation_msg[11] = "Record Not Rejected Successfully";

        $this->operation_msg[12] = "Application Approved Successfully";
        $this->operation_msg[13] = "Application was Not Approved Successfully";

        $this->operation_msg[14] = "Privileges Set Successfully";
        $this->operation_msg[15] = "Privileges was Not Set Successfully";

        //$this->operation_msg[8]="Please the enter required field, for more Info : ";
        $this->operation_msg[16] = "Cannot Delete! Atleast 1 Competency should exist under a Category.";

        $this->operation_msg[17] = "Mail Send Successfully";
        $this->operation_msg[18] = "Mail Send Not Successfully";

        $this->operation_msg[19] = "Sample Data Imported Successfully";
        $this->operation_msg[20] = "Sorry! Sample Data was not Imported";

        $this->operation_msg[21] = "Record is Saved Successfully. Warning: You already have a pending leave request!";

        $this->operation_msg[22] = "Process Done Successfully";

    }

    //This function use all common array (Create by sohel)Marital Status
    public function get_array($arr_name) {
        $data = array();
        $data['yes_no'] = array(1 => 'Yes', 2 => 'No');
        $data['status'] = array(0 => 'Inactive', 1 => 'Active');
        $data['marital_status'] = array(1 => 'Single', 2 => 'Married', 3 => 'Divorced', 4 => 'Civil Union', 5 => 'Legally separated', 6 => 'Widow');
        $data['gender'] = array(1 => 'Male', 2 => 'Female',3 => 'Transgender', 4 => 'Gender Neutral', 5 => 'Non-Binary');
        $data['languages_skill'] = array(1 => 'Fluent', 2 => 'Speak', 3 => 'Read', 4 => 'Write');
        $data['absent_type'] = array(1 => 'Sick', 2 => 'Personal', 3 => 'Vacation', 4 => 'No call/ No show');
        $data['incident_category'] = array(1 => 'Customer Related', 2 => 'Employee Related');
        $data['incident_action_type'] = array(1 => 'Incident Report', 2 => 'Discipline Action');
        $data['accident_action_type'] = array(1 => 'Accident Report', 2 => 'Discipline Action');
        $data['employee_type'] = array(1 => 'Exempt', 2 => 'Non-Exempt');
        //$data['billing_cycle'] = array(1 => 'Weekly', 2 => 'Bi-Weekly', 3 => 'Semi-Monthly', 4 => 'Monthly', 5 => 'Quarterly');
        $data['billing_type'] = array(1 => 'Per Employee', 2 => 'Flat Fees', 3 => 'Demo');
        $data['pricing_setup'] = array(1 => 'Rate', 2 => 'Discount', 3 => 'Promo');
        $data['payable_type'] = array(1 => 'No of Employee', 2 => 'Per Month');
        $data['percent_dollars'] = array(1 => 'Percent', 2 => 'Dollars');
        $data['priority'] = array(1 => 'High', 2 => 'Medium' , 3 => 'Low' );
        $data['accrual_period'] = array(1 => 'Per Hour', 2 => 'Per Pay Period', 3 => 'Per Month', 4 => 'Per Year');
        $data['method'] = array(1 => 'Per calender year', 2 => 'Per Hour worked', 3 => 'Per Month', 4 => 'Per pay check');
        $data['Workers_compensation'] = array(1 => 'Wage replacement', 2 => 'Medical benefits', 3 => 'House allowance');
        $data['type_of_school'] = array(1 => 'High School', 2 => 'College', 3 => 'Vocational School', 4 => 'GED', 5 => 'Non-Graduate', 6 => 'University');
        $data['offense_type'] = array(1 => 'Personal Crimes', 2 => 'Property Crimes', 3 => 'Inchoate Crimes', 4 => 'Statutory Crimes', 5 => 'Financial and Other Crimes', 6 => 'Felony', 7 => 'Misdemeanor');
        $data['applicable'] = array(1 => 'Contract', 2 => 'Permament', 3 => 'Provisional', 4 => 'Ahoc');
        $data['approver_status'] = array(0 => 'Pending', 1 => 'Approved', 2 => 'Cancelled', 3 => 'Pending For Approval', 4 => 'Rejected', 5 => 'Closed');
        $data['amount_type'] = array(1 => 'Percentage ', 2 => 'Fixed');
        $data['alert_type'] = array(1 => 'Birthdays Alert', 2 => 'Certification', 3 => 'Evaluation', 4 => 'Driver’s License', 5 => 'Work Permit', 6 => 'Medical Leave', 7 => 'Vacation', 8 => 'Leave', 9 => 'Benefit Enrollment', 10 => 'Benefits Eligibility', 11 => '401K', 12 => 'Probation', 13 => 'Deduction', 14 => 'Garnishments', 15 => 'Training', 16 => 'Leave Request', 17 => 'Employee Actions', 18 => 'Worker’s Compensation', 19 => 'Work Anniversary');
        $data['candidate_status'] = array(0 => 'Not Scheduled', 1 => 'Scheduled', 2 => 'Shortlisted', 3 => 'Selected', 4 => 'Rejected', 5 => 'Disqualified', 6 => 'On Hold');
        $data['interview_status'] = array(0 => 'In process', 1 => 'Pending', 2 => 'Closed', 3 => 'Complete', 4 => 'On Hold');
        $data['interview_type'] = array(0 => 'In Person', 1 => 'Phone', 2 => 'Video Conference');
        //$data['leavetype'] = array(0 => 'Paid', 1 => 'Unpaid');
        $data['leavetype'] = array(0 => 'Accrual', 1 => 'Non Accrual');
        $data['opening_status'] = array(0 => 'Pending', 1 => 'Open Position');
        $data['termination_type'] = array(0 => 'Voluntary', 1 => 'Involuntary');
        $data['corporation_type'] = array(0 => 'Incorporated "INC"', 1 => 'S Corporation', 2 => 'Limited Liability Company (LLC)', 3 => 'Sole Proprietor', 4 => 'Partnership General/Limited', 5 => 'Publicly Held', 6 => 'Non-Profit');
        $data['degree'] = array(0 => 'High School Graduate', 1 => 'GED', 2 => 'Associate Degree ( AA or AS)', 3 => 'Bachelor Degree (BA or BS)', 4 => 'Master Degree');
        $data['bodypart_injurylist'] = array(0 => 'Eye', 1 => 'Head', 2 => 'Chest', 3 => 'Back', 4 => 'Abdomen', 5 => 'Arm', 6 => 'Hand', 7 => 'Finger', 8 => 'Leg', 9 => 'Foot', 10 => 'Toe', 11 => 'Respriratory System', 12 => 'Other');
        $data['type_of_injury'] = array(0 => 'Laceration', 1 => 'Abrasion', 2 => 'Puncture', 3 => 'Burn', 4 => 'Strain-Sprain', 5 => 'Amputation', 6 => 'Foreign Body', 7 => 'Contusion', 8 => 'Other');
        $data['relationship_array'] = array(0 => 'Mother', 1 => 'Father', 2 => 'Sibling', 3 => 'Spouse', 4 => 'Friend', 5 => 'Partner', 6 => 'Other');
        // $data['training_type'] = array(0 => 'Voluntary', 1 => 'Involuntary');
        $data['training_type'] = array(0 => 'Optional', 1 => 'Mandatory');
        $data['requisition_by'] = array(0 => 'HR', 1 => 'Department', 2 => 'Employee');
        $data['training_status'] = array(0 => 'In process', 1 => 'Pending', 2 => 'Closed', 3 => 'Complete', 4 => 'On Hold');
        $data['wage_type'] = array(0 => 'Salary', 1 => 'Hourly');
        $data['employee_status'] = array(0 => 'Part-Time', 1 => 'Full-time', 2 => 'All');
        $data['resume_type'] = array(0 => 'Requsiiton', 1 => 'Employee Referral', 2 => 'Other Referral');
        $data['api_secret_type'] = array(0 => 'Partner (accountant)', 1 => 'Client (site)');
        
        $data['rating_array'] = array(1 => 'Rating 1', 2 => 'Rating 2', 3 => 'Rating 3',4 => 'Rating 4',5 => 'Rating 5');
        $data['star_array'] = array(1 => '1 star', 2 => '2 star', 3 => '3 star',4 => '4 star',5 => '5 star');
        $data['experience_array'] = array(0 => '0', 1 => '1',2 => '2', 3 => '3',4 => '4',5 => '5',6 => '6',7 => '7',8 => '8',9 => '9',10 => '10',11 => '11',12 => '12',13 => '13',14 => '14',15 => '15');
        
        $data['hourly_allowance_array'] = array(1 => 'Fixed ', 2 => 'Graduated');

        if (array_key_exists($arr_name, $data)) {
            return $data[$arr_name];
        } else {
            return $data[$arr_name] = array();
        }
    }

    public function insert_data($table, $data) {
        $this->db->insert($table, $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_data($table, $update_data, $condition) {
        $this->db->update($table, $update_data, $condition);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all_row($table, $limit = NULL) {
        $this->db->select();
        $this->db->from($table);
        if ($limit)
            $this->db->limit($limit);
        $query = $this->db->get();
        // $result = $query->result();			 
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_selected_row($table, $condition, $special = false) {
        //print_r($condition);
        $this->db->select();
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        //$result = $query->result();
        if ($special || $this->db->affected_rows() > 0) {
            return $query;
        } else {
            if ($this->db->affected_rows() <= 0) {
                return false;
            }
            return $query->result();
        }
//        if ($this->db->affected_rows() > 0) {
//            return $query;
//        } else {
//            return FALSE;
//        }
    }

    public function get_by_id($table, $id) {

        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query;
        //return $query->result_array();
    }

    public function get_by_id_row($table, $id) {
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_row_by_field($field, $table, $value) {
        return $this->db->get_where($table, array($field => $value))->row();
    }

    public function delete_by_id($table, $id) {

        //$this->db->where('id', $id);
        //$this->db->delete($table);

        $data = array('isactive' => 0);
        $condition = array('id' => $id);

        $this->db->update($table, $data, $condition);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

//    public function delete_by_id($table, $id) {
//
//        $this->db->where('id', $id);
//        $this->db->delete($table);
//
//        if ($this->db->affected_rows() > 0) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
//    }

    public function delete_by_pk($pk, $table, $id) {

        $this->db->where($pk, $id);
        $this->db->delete($table);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_menu_check($table, $id) {

        $this->db->from($table);
        $this->db->where('root_menu', $id);
        $query = $this->db->get();

        if ($this->db->affected_rows() > 0) {
            return FALSE;
        } else {

            $this->db->from($table);
            $this->db->where('sub_root_menu', $id);
            $queryy = $this->db->get();

            if ($this->db->affected_rows() > 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    function reload_table() {
        table . ajax . reload(null, false); //reload datatable ajax 
    }

    public function combo_box($table, $valfield, $datafield, $condition = NULL) {
        $this->db->select($valfield);
        $this->db->select($datafield);
        $this->db->from($table);

        if ($condition != NULL) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        $result = $query->result();

        if ($this->db->affected_rows() > 0) {
            //	$combo_array = array();
            $combo_array[''] = 'Select';
            foreach ($result as $arr) {

                $combo_array[$arr->$valfield] = $arr->$datafield;
            }
            return $combo_array;
        } else {
            return FALSE;
        }
    }

    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    public function php2java($java) {
        echo '<script type="text/javascript">' . $java . '</script>';
    }

    public function maxid($table) {
        $this->db->select('MAX(id) as maxid');
        $this->db->from($table);
        $query = $this->db->get();
        $row = $query->row();
        return $row->maxid;
    }

    public function listItem($table_name) {
        $this->db->order_by("id");
        $query = $this->db->get($table_name);
        return $query;
    }

    //This function use table next id (use for employee id) 
    public function return_next_id($id_field, $table_name) {
        $this->db->select_max($id_field);
        $result = $this->db->get($table_name)->row();
        $next_id = $result->id + 1;
        return $next_id;
    }

    //This function use table next id (use for Talent Acquisition ->requisition_code ) 
    public function return_requisition_code($id_field, $table_name, $position_name) {
        $this->db->select_max($id_field);
        $result = $this->db->get($table_name)->row();
        $next_id = $result->id + 1;

        $pos = substr($position_name, 0, 3);
        //return $pos . "-" . sprintf("%07d", $next_id);
        return sprintf("%07d", $next_id);
    }

    public function get_data_array($table, $valfield, $datafield, $condition = NULL) {
        $this->db->select($valfield);
        $this->db->select($datafield);
        $this->db->from($table);
        if ($condition != NULL) {
            $this->db->where($condition);
        }
        $query = $this->db->get();
        $result = $query->result();

        if ($this->db->affected_rows() > 0) {
            $data_array[''] = '';
            foreach ($result as $arr) {
                $data_array[$arr->$valfield] = $arr->$datafield;
            }
            return $data_array;
        } else {
            return FALSE;
        }
    }

    public function get_data_menu($table, $valfield, $datafield, $condition = NULL) {
        $this->db->select($valfield);
        $this->db->select($datafield);
        $this->db->from($table);
        $this->db->order_by("sequence", "asc");
        if ($condition != NULL) {
            $this->db->where($condition);
        }
        $query = $this->db->get();
        $result = $query->result();

        if ($this->db->affected_rows() > 0) {
            $data_array[''] = '';
            foreach ($result as $arr) {
                $data_array[$arr->$valfield] = $arr->$datafield;
            }
            return $data_array;
        } else {
            return FALSE;
        }
    }

    public function encrypt($string) {
        $key = "hr_ebit_2018";
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }

    public function decrypt($string) {
        $key = "hr_ebit_2018";
        $result = '';
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

//    public function generate_hrm_password($length = 8) {
//        $str = "";
//        $characters = array_merge(range('A', 'Z'), range('a', 'z'));
//        $max = count($characters) - 1;
//        for ($i = 0; $i < $length; $i++) {
//            $rand = mt_rand(0, $max);
//            $str .= $characters[$rand];
//        }
//        return $str;
//    }
    
    
    public function generate_rand_password($length = 8) {
        
        $str = "";
        $sarray = array('&','@','!','#','$');
        $characters = array_merge(range('A', 'Z'),range(1,9),$sarray, range('a', 'z'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
        
    }
    
    public function show_validation_massege($massege, $type) {

        if ($massege) {

            if ($type == 1) {
                $class = "alert-success";
            } else {
                $class = "alert-danger";
            }
            $massege=$this->remove_tags($massege,'<p>','');
//            $data = '<div class="alert alert-dismissable ' . $class . '">'
//                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
//                    . '<small> ' . $massege . ' </small>'
//                    . '</div>' . "##" . $type;
            
            $data = $massege."##".$type;

            return $data;
        }
        exit();
    }

    public function show_massege($massege, $type) {

        if ($type == 1) {
            $class = "alert-success";
        } else {
            $class = "alert-danger";
        }
//        $data = '<div class="alert alert-dismissable ' . $class . '">'
//                . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
//                . '<small> ' . $this->operation_msg[$massege] . ' </small>'
//                . '</div>' . "##" . $type;
        
        $data = $this->operation_msg[$massege]."##".$type;

        return $data;

        exit();
    }
    
    
    public function show_validation_massege_normal($massege, $type) {

        if ($massege) {

            if ($type == 1) {
                $class = "alert-success";
            } else {
                $class = "alert-danger";
            }
            
            $data = '<div class="alert alert-dismissable ' . $class . '">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    . '<small> ' . $massege . ' </small>'
                    . '</div>' . "##" . $type;
            

            return $data;
        }
        exit();
    }
    
    public function show_massege_normal($massege, $type) {

        if ($type == 1) {
            $class = "alert-success";
        } else {
            $class = "alert-danger";
        }
        
        $data = '<div class="alert alert-dismissable ' . $class . '">'
                . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                . '<small> ' . $this->operation_msg[$massege] . ' </small>'
                . '</div>' . "##" . $type;
        
        return $data;

        exit();
    }
    
    public function remove_tags($s, $r = '', $p = '') {
        if (!$r)
            return strip_tags($s, $p);

        $r = str_replace('<', '', $r);
        $t = explode('>', $r);

        foreach ($t as $tg) {
            if ($tg)
                $s = preg_replace("#<$tg.*?>|</$tg>#i", "", $s);
        }

        return $s;
    }

    public function get_name($the, $id, $table, $field)
    {
        $the->db->select($field);
        $query = $the->db->get_where($table, array('id' => $id), 1);

        $output = "";
        if ($query->row($field)) {
            $output = $query->row($field);
        }

        return $output;
    }

    public function employee_name($employee_id) {
        if($employee_id)
        {
            $this->db->select('first_name, middle_name, last_name');
            $res = $this->db->get_where('main_employees', array('employee_id' => $employee_id), 1)->row();
            //return $this->db->last_query();
            if(!empty($res))
            {
                //return $res->last_name . ' ' . $res->middle_name . ' ' . $res->first_name;
                
                return $res->last_name . ' , ' . $res->first_name;
            }
        }
        else {
                   return "";
        }
    }

    public function get_multiple_names($the, $id, $table, $field) {
        $the->db->select($field);
        $query = $the->db->get_where($table, array('id' => $id), 1);
        return $query->row();
    }

    public function get_selected_value($the, $id_field, $value_field, $table, $select_field) {
        $the->db->select($select_field);
        $query = $the->db->get_where($table, array($id_field => $value_field), 1);
        return $query->row($select_field);
    }

    public function is_user_valid($user_id, $menu_id, $user_menu) {
        if (!$user_id) {
            redirect('chome/logout', 'refresh');
        }
        $user_menu_arr = explode(",", $user_menu);
        if ($menu_id) {
            if (in_array($menu_id, $user_menu_arr)) {
                return TRUE;
            } else {
                //return FALSE;
                redirect('Con_dashbord/', 'refresh');
            }
        } else {
            $this->db->select('id');
            $query = $this->db->get_where('main_menu', array('menu_link' => $this->uri->segment(1)));
            $menu_id = $query->row('id');
            if (in_array($menu_id, $user_menu_arr)) {
                return TRUE;
            } else {
                //return FALSE;
                redirect('Con_dashbord/', 'refresh');
            }
        }
    }

    public function get_agencies($aid) {
        $sql = "SELECT ag.*,ad.* FROM main_agencies ag LEFT JOIN main_agencies_detail ad ON ag.id=ad.agency_id where ag.id=" . $aid;
        $query_result = $this->db->query($sql);
        //$result=$query_result->row();
        return $query_result;
    }

    public function add_date($orgDate, $days) {
        $cd = strtotime($orgDate);
        $retDAY = date('Y-m-d', mktime(0, 0, 0, date('m', $cd), date('d', $cd) + $days, date('Y', $cd)));
        return $retDAY;
    }

    public function unique_check($field, $value, $table) {
        $this->db->where($field, $value);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showphpinfo() {
        return phpinfo();
    }

    public function convert_to_mysql_date($date_field) {
        //11-29-2016
        //DD-YYYY-MM
        if ($date_field != '') {
            $dates = explode("-", $date_field);
            return $dates[2] . "-" . $dates[0] . "-" . $dates[1];
        } else
            return $date_field;
    }
    
    public function csv_to_mysql_date($csv_date) {
        //11-29-2016
        //DD-YYYY-MM
        if ($csv_date != '') {
            //$dates = explode("/", $csv_date);
            //return $dates[0] . "-" . $dates[1] . "-" . $dates[2];
            
            $originalDate = $csv_date;
            return $newDate = date("Y-m-d", strtotime($originalDate));

        } else
            return $csv_date;
    }

    public function show_date_formate($date_field) {
        //01-24-2017
        //MM-DD-YYYY
        if ($date_field != '') {
            $dates = explode("-", $date_field);
            return $dates[1] . "-" . $dates[2] . "-" . $dates[0];
        } else
            return $date_field;
    }

    public function add_month($orgDate, $mon) {
        $cd = strtotime($orgDate);
        $retDAY = date('Y-m-d', mktime(0, 0, 0, date('m', $cd) + $mon, 1, date('Y', $cd)));
        return $retDAY;
    }

    public function get_client_ip() {
        $this->ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $this->ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $this->ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $this->ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $this->ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $this->ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $this->ipaddress = getenv('REMOTE_ADDR');
        else
            $this->ipaddress = 'UNKNOWN';

        return $this->ipaddress;

    }
    
    public function employee_pto_info($employee_id) {
        if ($employee_id != '') {
            $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','state');
            //if ($this->user_group == 12) {
            if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Self user //Hr Manager //Company User //Admin //HR   
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('paid_leave_type, available_limit, main_pto_settings.id AS mstID,main_pto_settings.hourly_allowance_option,main_pto_settings.fixed_amount,main_pto_settings.annual_limit, main_employeeleavetypes.state');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_employeeleavetypes.state', $emp_state);
                $this->db->where('main_pto_settings.company_id', $this->company_id);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            } else {
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('paid_leave_type, available_limit, main_pto_settings.id AS mstID,main_pto_settings.hourly_allowance_option,main_pto_settings.fixed_amount,main_pto_settings.annual_limit, main_employeeleavetypes.state');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_employeeleavetypes.state', $emp_state);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            }
            //return $this->db->last_query();
            
            $i = 0;
            //$Allowance = 80; // Temporary
            $Allowance = ""; 
            $output = '';
            $availableLIMIT = $Earned = "";
            $OpenningEarnedPTO=0;
            $CurrentYearPTO=0;
            foreach ($pto_leave_data as $row) {

                $row->hourly_allowance_option;

                $working_hours_query = $this->db->get_where('main_accrual_leave_track', array('employee_id' => $employee_id , 'leave_type' => $row->paid_leave_type ))->row();
                if($working_hours_query == TRUE){ 
                    $Allowance=$working_hours_query->working_hours;
                }
                else {
                    $Allowance=80;
                }
                
                $availableLIMIT = $Earned = "";

                if($row->hourly_allowance_option==1){ //Hourly Allowance:Fixed
                    $availableLIMIT = $row->annual_limit;
                    $CurrentYearPTO = $Allowance*$row->fixed_amount;
                }else{

                    $SingleRow = $this->db->query("SELECT ( {$Allowance} * `hourly_allowance` ) AS Earned, available_limit AS availableLIMIT FROM main_pto_settings_details WHERE {$Working_Years} >= `graduated_form` AND {$Working_Years} <= `graduated_to` AND `mst_id`={$row->mstID}")->row();
                    if (!empty($SingleRow)) {
                        $availableLIMIT = $SingleRow->availableLIMIT;
                        $CurrentYearPTO = $SingleRow->Earned;
                        //pr($SingleRow);
                    }
                    //return $this->db->last_query();
                }

                $cyear=date("Y");
                $pyear=$cyear-1;

                $OpenningEarnedPTO = $this->db->query("SELECT carry_balance FROM main_yearend_process WHERE `employee_id`={$employee_id} AND `leave_type`={$row->paid_leave_type} AND `year`={$pyear} ")->row('carry_balance');
                if ($OpenningEarnedPTO == '' || $OpenningEarnedPTO == NULL) {
                    $OpenningEarnedPTO = 0;
                }
               
                $Earned=$OpenningEarnedPTO+$CurrentYearPTO;

                $Enjoyed_Hour = $this->db->query("SELECT SUM(`approved_hours`) AS `Enjoyed_Hour` FROM main_pto_transaction WHERE `employee_id`={$employee_id} AND `leave_type`={$row->paid_leave_type}")->row('Enjoyed_Hour');
                if ($Enjoyed_Hour == '' || $Enjoyed_Hour == NULL) {
                    $Enjoyed_Hour = 0;
                }

                $output .= '<tr>';
                $output .= '<td>' . ++$i . '</td>';
                $output .= '<td>' . $this->Common_model->get_name($this, $row->paid_leave_type, 'main_leave_types', 'leave_code') ." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . '</td>';
                $output .= '<td>' . $availableLIMIT . '</td>';
                $output .= '<td>' . round($OpenningEarnedPTO, 2) . '</td>';
                $output .= '<td>' . round($CurrentYearPTO, 2) . '</td>';
                $output .= '<td>' . round($Earned, 2) . '</td>';

                if (($Earned) > ($availableLIMIT)) {
                    $Available_Hour = round($availableLIMIT, 2);
                } else {
                    $Available_Hour = round($Earned, 2);
                }

                $output .= '<td>' . $Available_Hour . '</td>';
                $output .= '<td>' . $Enjoyed_Hour . '</td>';
                $output .= '<td><span class="paid_leave_type_' . $row->paid_leave_type . '">' . round(($Available_Hour - $Enjoyed_Hour), 2) . '</span></td>';
                $output .= '</tr>';
            }

            return $output;
        }
    }

    public function employee_pto_info_details($employee_id) {
        if ($employee_id != '') {
            $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','state');
            //if ($this->user_group == 12) {
            if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Self user //Hr Manager //Company User //Admin //HR   
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('paid_leave_type, available_limit, main_pto_settings.id AS mstID,main_pto_settings.hourly_allowance_option,main_pto_settings.fixed_amount,main_pto_settings.annual_limit, main_employeeleavetypes.state');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_employeeleavetypes.state', $emp_state);
                $this->db->where('main_pto_settings.company_id', $this->company_id);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            } else {
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('paid_leave_type, available_limit, main_pto_settings.id AS mstID,main_pto_settings.hourly_allowance_option,main_pto_settings.fixed_amount,main_pto_settings.annual_limit, main_employeeleavetypes.state');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_employeeleavetypes.state', $emp_state);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            }
            //return $this->db->last_query();
            
            $i = 0;
            //$Allowance = 80; // Temporary
            $Allowance = ""; 
            $output = '';
            $availableLIMIT = $Earned = "";
            $OpenningEarnedPTO=0;
            $CurrentYearPTO=0;
            foreach ($pto_leave_data as $row) {

                $row->hourly_allowance_option;

                $working_hours_query = $this->db->get_where('main_accrual_leave_track', array('employee_id' => $employee_id , 'leave_type' => $row->paid_leave_type ))->row();
                if($working_hours_query == TRUE){ 
                    $Allowance=$working_hours_query->working_hours;
                }
                else {
                    $Allowance=80;
                }
                
                $availableLIMIT = $Earned = "";

                if($row->hourly_allowance_option==1){ //Hourly Allowance:Fixed
                    $availableLIMIT = $row->annual_limit;
                    $CurrentYearPTO = $Allowance*$row->fixed_amount;
                }else{

                    $SingleRow = $this->db->query("SELECT ( {$Allowance} * `hourly_allowance` ) AS Earned, available_limit AS availableLIMIT FROM main_pto_settings_details WHERE {$Working_Years} >= `graduated_form` AND {$Working_Years} <= `graduated_to` AND `mst_id`={$row->mstID}")->row();
                    if (!empty($SingleRow)) {
                        $availableLIMIT = $SingleRow->availableLIMIT;
                        $CurrentYearPTO = $SingleRow->Earned;
                        //pr($SingleRow);
                    }
                    //return $this->db->last_query();
                }

                $cyear=date("Y");
                $pyear=$cyear-1;

                $OpenningEarnedPTO = $this->db->query("SELECT carry_balance FROM main_yearend_process WHERE `employee_id`={$employee_id} AND `leave_type`={$row->paid_leave_type} AND `year`={$pyear} ")->row('carry_balance');
                if ($OpenningEarnedPTO == '' || $OpenningEarnedPTO == NULL) {
                    $OpenningEarnedPTO = 0;
                }
                $Earned=$OpenningEarnedPTO+$CurrentYearPTO;

                $Enjoyed_Hour = $this->db->query("SELECT SUM(`approved_hours`) AS `Enjoyed_Hour` FROM main_pto_transaction WHERE `employee_id`={$employee_id} AND `leave_type`={$row->paid_leave_type}")->row('Enjoyed_Hour');
                if ($Enjoyed_Hour == '' || $Enjoyed_Hour == NULL) {
                    $Enjoyed_Hour = 0;
                }

                $output .= '<tr>';
                $output .= '<td>' . ++$i . '</td>';
                $output .= '<td>' . $this->Common_model->get_name($this, $employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $employee_id, 'main_employees', 'last_name') . '</td>';
                $output .= '<td>' . $this->Common_model->get_name($this, $row->paid_leave_type, 'main_leave_types', 'leave_code') ." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . '</td>';
                $output .= '<td>' . $availableLIMIT . '</td>';
                $output .= '<td>' . round($OpenningEarnedPTO, 2) . '</td>';
                $output .= '<td>' . round($CurrentYearPTO, 2) . '</td>';
                $output .= '<td>' . round($Earned, 2) . '</td>';

                if (($Earned) > ($availableLIMIT)) {
                    $Available_Hour = round($availableLIMIT, 2);
                } else {
                    $Available_Hour = round($Earned, 2);
                }

                $output .= '<td>' . $Available_Hour . '</td>';
                $output .= '<td>' . $Enjoyed_Hour . '</td>';
                $output .= '<td><span class="paid_leave_type_' . $row->paid_leave_type . '">' . round(($Available_Hour - $Enjoyed_Hour), 2) . '</span></td>';
                $output .= '</tr>';
            }

            return $output;
        }
    }

    public function employee_pto_yearend_process($employee_id, $closing_date) {
        //return $employee_id.",";
        if ($employee_id != '') {
            $emp_state=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','state');
            //if ($this->user_group == 12) {
            if ($this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Self user //Hr Manager //Company User //Admin //HR   
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('paid_leave_type, available_limit, main_pto_settings.id AS mstID,main_pto_settings.hourly_allowance_option,main_pto_settings.fixed_amount,main_pto_settings.annual_limit, main_pto_settings.carryover_maximum, main_employeeleavetypes.state');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_employeeleavetypes.state', $emp_state);
                $this->db->where('main_pto_settings.company_id', $this->company_id);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            } else {
                $Working_Days = $this->db->query("SELECT DATEDIFF( CURDATE(), `hire_date` ) AS DAYS FROM `main_employees` WHERE `employee_id`={$employee_id}")->row('DAYS');
                $Working_Years = (float) round(($Working_Days / 365), 2);

                $this->db->select('paid_leave_type, available_limit, main_pto_settings.id AS mstID,main_pto_settings.hourly_allowance_option,main_pto_settings.fixed_amount,main_pto_settings.annual_limit, main_pto_settings.carryover_maximum, main_employeeleavetypes.state');
                $this->db->join('main_employeeleavetypes', 'main_employeeleavetypes.leave_code = main_pto_settings.paid_leave_type');
                $this->db->where('main_employeeleavetypes.state', $emp_state);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $pto_leave_data = $this->db->get('main_pto_settings')->result();
            }
            //return $this->db->last_query();
            
            $i = 0;
            //$Allowance = 80; // Temporary
            $Allowance = ""; 
            $output = '';
            $availableLIMIT = $Earned = "";
            $OpenningEarnedPTO=0;
            $CurrentYearPTO=0;
            foreach ($pto_leave_data as $row) {

                $row->hourly_allowance_option;

                $working_hours_query = $this->db->get_where('main_accrual_leave_track', array('employee_id' => $employee_id , 'leave_type' => $row->paid_leave_type ))->row();
                if($working_hours_query == TRUE){ 
                    $Allowance=$working_hours_query->working_hours;
                }
                else {
                    $Allowance=80;
                }
                
                $availableLIMIT = $Earned = "";

                if($row->hourly_allowance_option==1){ //Hourly Allowance:Fixed
                    $availableLIMIT = $row->annual_limit;
                    $CurrentYearPTO = $Allowance*$row->fixed_amount;
                    $carryover_maximum = $row->annual_limit;
                }else{

                    $SingleRow = $this->db->query("SELECT ( {$Allowance} * `hourly_allowance` ) AS Earned, available_limit AS availableLIMIT, carryover_maximum FROM main_pto_settings_details WHERE {$Working_Years} >= `graduated_form` AND {$Working_Years} <= `graduated_to` AND `mst_id`={$row->mstID}")->row();
                    if (!empty($SingleRow)) {
                        $availableLIMIT = $SingleRow->availableLIMIT;
                        $CurrentYearPTO = $SingleRow->Earned;
                        $carryover_maximum = $SingleRow->carryover_maximum;
                        //pr($SingleRow);
                    }
                    //return $this->db->last_query();
                }
               
                $Earned=$OpenningEarnedPTO+$CurrentYearPTO;

                $Enjoyed_Hour = $this->db->query("SELECT SUM(`approved_hours`) AS `Enjoyed_Hour` FROM main_pto_transaction WHERE `employee_id`={$employee_id} AND `leave_type`={$row->paid_leave_type}")->row('Enjoyed_Hour');
                if ($Enjoyed_Hour == '' || $Enjoyed_Hour == NULL) {
                    $Enjoyed_Hour = 0;
                }

                $output .= '<tr>';
                $output .= '<td>' . ++$i . '</td>';
                $output .= '<td>' . $this->Common_model->get_name($this, $employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $employee_id, 'main_employees', 'last_name') . '</td>';
                $output .= '<td>' . $this->Common_model->get_name($this, $row->paid_leave_type, 'main_leave_types', 'leave_code') ." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . '</td>';
                $output .= '<td>' . $availableLIMIT . '</td>';
                $output .= '<td>' . round($OpenningEarnedPTO, 2) . '</td>';
                $output .= '<td>' . round($CurrentYearPTO, 2) . '</td>';
                $output .= '<td>' . round($Earned, 2) . '</td>';

                if (($Earned) > ($availableLIMIT)) {
                    $Available_Hour = round($availableLIMIT, 2);
                } else {
                    $Available_Hour = round($Earned, 2);
                }

                $output .= '<td>' . $Available_Hour . '</td>';
                $output .= '<td>' . $Enjoyed_Hour . '</td>';
                $output .= '<td><span class="paid_leave_type_' . $row->paid_leave_type . '">' . round(($Available_Hour - $Enjoyed_Hour), 2) . '</span></td>';
                $output .= '</tr>';

                $carry_balance=round(($Available_Hour - $Enjoyed_Hour), 2);
                if($carry_balance > $carryover_maximum){
                    $carry_balance=$carryover_maximum;
                }else{
                    $carry_balance=$carry_balance;
                }

                $dates = explode("-", $closing_date);
                $yr= $dates[2];

                $data = array(
                    'employee_id' => $employee_id,
                    'company_id' => $this->company_id,
                    'year' => $yr,
                    'closing_date' => $this->convert_to_mysql_date($closing_date),
                    'leave_type' => $row->paid_leave_type,
                    'hourly_allowance_option' => $row->hourly_allowance_option,
                    'carryover_maximum' => $carryover_maximum,
                    'carry_balance' => $carry_balance,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => 1
                );
                
                //print_r($data);exit();
                $res = $this->Common_model->insert_data('main_yearend_process', $data);

            }
            return TRUE;
            //return $data;
        }
    }


    public function get_sample_table_fields_and_data($replica_tbl = '') {

        if ($replica_tbl != "") {
            $DB_NAME = $this->db->database;

            /* ---------Common Table fields to Exclude---------             
              NC: **DO NOT CHANGE THE VALUE SEQUENCE OF `$Excluded` ARRAY. */
            //$Excluded = array('company_id', 'id', 'createdby', 'modifiedby', 'createddate', 'modifieddate');
            $Excluded = array('company_id', 'createdby', 'modifiedby', 'createddate', 'modifieddate');

            $this->db->trans_start();
            $this->db->query("SET @TABLE_FIELDS := (SELECT GROUP_CONCAT( COLUMN_NAME ) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='{$replica_tbl}' AND TABLE_SCHEMA='{$DB_NAME}')");

            foreach ($Excluded as $Excluded_Column) {
                $this->db->query("SET @TABLE_FIELDS := REPLACE(@TABLE_FIELDS, '{$Excluded_Column},', '')");
            }

            $this->db->query("SET @TABLE_FIELDS := REPLACE(@TABLE_FIELDS, ',isactive', '')");
            $this->db->query("SET @SQL = CONCAT( 'SELECT ', @TABLE_FIELDS, ' FROM {$replica_tbl}')");
            $this->db->query("PREPARE Result FROM @SQL");
            $TBL_DATA = $this->db->query("EXECUTE Result");
            $this->db->trans_complete();

            $DBresult = array(
                'Sample_Data' => $TBL_DATA->result_array(),
                'Sample_Data_Fields' => $TBL_DATA->list_fields()
            );

            return $DBresult;
        }
    }

    public function getRows_pagination($params = array()) {
        $this->db->select('*');
        $this->db->from('main_menu');
        $this->db->order_by('id', 'desc');

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }

        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query : FALSE;
    }

    public function generate_search_fields($County = 1, $State = 1, $Position = 1, $Status_Active = 1, $Location = 1, $Department = 1, $Show_Advance_Serach_Btn = 1, $License_State_Issued = 1, $GRID = 4) {
        $user_data = $this->session->userdata('hr_logged_in');
        $company_id = $user_data['company_id'];
        $result = '';


        /* SELECT Option for `Status_Active` */
        if ($Status_Active == 1) {
            $emp_status = '<div class="no-padding-left col-sm-12" style="padding-top:7px">'
                    . '<label class="col-sm-2 control-label no-padding-right">Employee Status<span class="req"></span> :</label>'
                    . '<div class="col-sm-5 padding-top-7">'
                    . '<input type="radio" class="emp_status" name="emp_status" value="1"/> Active Only'
                    . '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'
                    . '<input type="radio" class="emp_status" name="emp_status" value="0" /> In-active Only'
                    . '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'
                    . '<input type="radio" class="emp_status" name="emp_status" value="2"/> All'
                    . '</div></div><hr/>';
            $result .= $emp_status;
        }
        /* SELECT Option for `State` */
        if ($State == 1) {
            $res = $this->db->get('main_state')->result();
            $result .= $this->generate_select2_field('state_id', 'Select State', 'id', 'state_name', $res, $GRID);
        }
        /* `County` dropdown, first select `Company` */
        if ($County == 1) {
            $res = $this->db->get('main_county')->result();
            $result .= $this->generate_select2_field('county_id', 'Select County', 'id', 'county_name', $res, $GRID);
        }
        /* SELECT Option for `Position` according to `Company` */
        if ($Position == 1) {
            $this->db->join('main_jobtitles', 'main_jobtitles.id = main_positions.positionname');
            $res = $this->db->get_where('main_positions', array('company_id' => $company_id))->result();
            $result .= $this->generate_select2_field('positions_id', 'Select Position', 'positionname', 'job_title', $res, $GRID);
        }
        /* SELECT Option for `Location` according to `Company` */
        if ($Location == 1) {
            $res = $this->db->get_where('main_location', array('company_id' => $company_id))->result();
            $result .= $this->generate_select2_field('location_id', 'Select Location', 'id', 'location_name', $res, $GRID);
        }
        /* SELECT Option for `Department` according to `Company` */
        if ($Department == 1) {
            $res = $this->db->get_where('main_department', array('company_id' => $company_id))->result();
            $result .= $this->generate_select2_field('department_id', 'Select Department', 'id', 'department_name', $res, $GRID);
        }
        /* Shows button for Advance Search */
        if ($Show_Advance_Serach_Btn == 1) {
            $result .= '<div class="no-padding-left padding-top-7 col-sm-3"> <a href="javascript:void()" class="more_search_btn"><i class="fa"></i> More Options</a> </div>';
        }

        return $result;
    }

    public function generate_select2_field($name, $placeholder, $value_field, $display_field, $data_array, $GRID) {

        $output = '<div class="no-padding-left col-sm-' . $GRID . '">'
                . '<select name="' . $name . '" id="' . $name . '" class="col-xs-12 myselect2 input-sm">'
                . '<option></option>';

        foreach ($data_array as $key => $row) {
            $output .= '<option value = "' . (($value_field != '') ? $row->$value_field : $key) . '">' . (($display_field != '') ? $row->$display_field : $row) . '</option>';
        }

        $output .= '</select>'
                . '<script type="text/javascript">
                    $("select#' . $name . '").select2({
                        placeholder: "' . $placeholder . '",
                        allowClear: true
                    });
                    </script>'
                . '</div>';

        return $output;
    }
    
     public function get_header_module_name($the, $module_id) {

        if ($module_id) {
            $data = '<a href="' . base_url() . $the->Common_model->get_name($the, $module_id, "main_module", "module_link") . '">' . $the->Common_model->get_name($the, $module_id, "main_module", "module_name") . '</a>';
            return $data;
        } else {
            return FALSE;
        }
        exit();
    }

    public function employee_wage_compensation($the,$employee_id, $Position, $wages, $wage_houre=0, $PayType, $rate, $salary ) {

        if ($employee_id != "") {
            
            $this->db->where('employee_id', $employee_id);
            $this->db->where('pay_schedule', $wages);
            //$this->db->where('company_id', $this->company_settings_id);
            $query = $this->db->get('main_emp_wage_compensation');
            if ($query->num_rows() > 0) {
                
                if ($PayType == 0) {
                    $per_pay_period_salary = $salary;
                } else {
                    $per_pay_period_salary = ($wage_houre * $rate);
                }
                
                $data = array('company_id' => $the->company_id,
                    'wage_date' => date("Y-m-d"),
                    'position' => $Position,
                    'pay_schedule' => $wages,
                    'wage_salary_type' => $PayType,
                    'hours_per_pay_period' => $wage_houre,
                    'per_hour_rate' => $rate,
                    'per_pay_period_salary' => $per_pay_period_salary,
                    'yearly_salary' => ($per_pay_period_salary*12),
                    'status' => 1,
                    'modifiedby' => $the->user_id,
                    'modifieddate' => $the->date_time,
                    'isactive' => '1',
                );

                $res = $the->Common_model->update_data('main_emp_wage_compensation', $data, array('employee_id' => $employee_id, 'pay_schedule' => $wages));
            } 
            else {
                
                if ($PayType == 0) {
                    $per_pay_period_salary = $salary;
                } else {
                    $per_pay_period_salary=($wage_houre*$rate);
                }
                $data = array('employee_id' => $employee_id,
                    'company_id' => $the->company_id,
                    'wage_date' => date("Y-m-d"),
                    'position' => $Position,
                    'pay_schedule' => $wages,
                    'wage_salary_type' => $PayType,
                    'hours_per_pay_period' => $wage_houre,
                    'per_hour_rate' => $rate,
                    'per_pay_period_salary' => $per_pay_period_salary,
                    'yearly_salary' => ($per_pay_period_salary*12),
                    'status' => 1,
                    'createdby' => $the->user_id,
                    'createddate' => $the->date_time,
                    'isactive' => '1',
                );

                $res = $the->Common_model->insert_data('main_emp_wage_compensation', $data);
            }
            
            return $res;
            
        }
    }
    
    public function set_login_history($the,$operation_id=0,$transaction_id=0) {
        
        if (!$this->menu_id || $this->menu_id == "") {
            $this->menu_id = $this->get_selected_value($the, 'menu_link', $this->uri->segment(1), 'main_menu', 'id');
        }

        $login_data = array('company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'user_name' => $this->get_name($the, $this->user_id, 'main_users', 'name'),
            'lan_ip' => $this->get_client_ip(),
            'lan_mac' => '',
            'wan_ip' => '',
            'login_time' => date("H:i:s"),
            'login_date' => date("Y-m-d"),
            'module_id' => $this->module_id,
            'menu_id' => $this->menu_id,
            'operation_id' => $operation_id,
            'transaction_id' => $transaction_id,
            'logout_time' => '',
            'logout_date' => '',
            'login_status' => '0',
        );
        
        $res = $this->insert_data('login_history', $login_data);
        return TRUE;
    }
    
    public function set_batch_login_history($the,$operation_id=0,$transaction_id=0) {
        
        if (!$this->menu_id || $this->menu_id == "") {
            $this->menu_id = $this->get_selected_value($the, 'menu_link', $this->uri->segment(1), 'main_menu', 'id');
        }

        $login_data = array('company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'user_name' => $this->get_name($the, $this->user_id, 'main_users', 'name'),
            'lan_ip' => $this->get_client_ip(),
            'lan_mac' => '',
            'wan_ip' => '',
            'login_time' => date("H:i:s"),
            'login_date' => date("Y-m-d"),
            'module_id' => $this->module_id,
            'menu_id' => $this->menu_id,
            'operation_id' => $operation_id,
            'transaction_id' => $transaction_id,
            'logout_time' => '',
            'logout_date' => '',
            'login_status' => '0',
        );
        
        $res = $this->insert_data('login_history', $login_data);
        return TRUE;
    }

    public function get_table_field_value($that, $table, $compareField, $input, $outputField)
    {
        $that->db->select($outputField);
        $query = $that->db->get_where($table, array($compareField => $input), 1);

        $output = "";
        if ($query->row($outputField)) {
            $output = $query->row($outputField);
        }

        return $output;
    }

}
