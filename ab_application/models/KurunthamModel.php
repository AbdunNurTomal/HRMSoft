<?php

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class KurunthamModel extends CI_Model
{
    public $ipaddress;
    public $twilioId = null;
    public $twilioToken = null;
    public $twilioFromNo = null;
    public $devEnvironment = "development";
    public $prodEnvironment = "production";
    public $fromEmail = "info@hrcsoft.com";
    public $emailFromName = "HRC Service";

    public $ROLE_SUPER_ADMIN = 1;
    public $ROLE_PARTNER = 2;
    public $ROLE_GROUP = 3;
    public $ROLE_HR = 4;
    public $ROLE_DEVELOPER = 5;
    public $ROLE_ADMIN = 8;
    public $ROLE_ONBOARDING_USER = 9;
    public $ROLE_SELF_USER = 10;
    public $ROLE_HR_MANAGER = 11;
    public $ROLE_COMPANY_ADMIN = 12;
    public $ROLE_HRC_TEAM = 16;
    public $ROLE_CRM = 19;
    public $ROLE_MANAGER = 23;

    public function __construct()
    {
        parent::__construct();

        // Your Account SID and Auth Token from twilio.com/console
        $this->twilioId = "AC040212fbccb4154a3d2a40ecfef6e851";
        $this->twilioToken = "ad544bea3d08d5e3bc901b09c9a49173";
        // $this->twilioFromNo = "+14435696536";
        $this->twilioFromNo = "+16613063060";

        $this->load->config('email');
        $this->load->library('email');
    }

    public function send_otp_mail($userName, $to_email, $otp)
    {
        $this->email->from($this->fromEmail, $this->emailFromName); 
        $this->email->to($to_email);
        $this->email->subject('Two Factor Authentication OTP');

        $info['logo'] = "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> Hi ". $userName .", <br> Your two factor authentication verification code is: <b> {$otp} </><br> <br> Best Regards, <br> The HRM Development team. <br> <br> <br> <br> ";

        $body = $this->load->view('sadmin/compose.php',$info,TRUE);

        $this->email->message($body);

        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if ($this->email->send())
                return TRUE;
            else
                return FALSE;
        }
    }

    protected function writeMailToCSV($mailContent)
    {
        $fp = fopen(FCPATH . 'local_mails/'. date('YmdHis') . '.txt', 'w');
        fwrite($fp, $mailContent);
        fclose($fp);
        // echo "Mail contents write to a file at " . FCPATH . "local_mails/";
    }

    public function send_otp_sms($phoneNo, $OTP)
    {
        $client = new Client($this->twilioId, $this->twilioToken);
        $result = FALSE;
        try {
            if (ENVIRONMENT == $this->prodEnvironment) {
                $client->messages->create(
                    // the number you'd like to send the message to
                    $phoneNo,
                    array(
                        // A Twilio phone number you purchased at twilio.com/console
                        'from' => $this->twilioFromNo, // +15017250604
                        // the body of the text message you'd like to send
                        'body' => "Your two factor authentication verification code is: " . $OTP
                    )
                );
            }

            $result = TRUE;
        } catch (Exception $e) {
            $result = FALSE;
            // echo "<pre>". print_r($e, 1) ."</pre>";exit;
        }

        return $result;
    }

    public function sendSMS($employees, $sendType = "manual", $msgType = 0)
    {
        $client = new Client($this->twilioId, $this->twilioToken);
        $result = array();
        $result["status"] = FALSE;
        $msgSentArr = array();
        $msgNotSentArr = array();

        foreach($employees as $employee) {
            try {
                // echo "<pre>".print_r($employee,1)."</pre>";exit;
                $phoneNo = $employee["phone_number"];
                if ($phoneNo) {
                    // Use the client to do fun stuff like send text messages!
                    if (ENVIRONMENT == $this->prodEnvironment) {
                        $client->messages->create(
                            // the number you'd like to send the message to
                            $phoneNo,
                            array(
                                // A Twilio phone number you purchased at twilio.com/console
                                'from' => $this->twilioFromNo, // +15017250604
                                // the body of the text message you'd like to send
                                'body' => $employee["message"]
                            )
                        );
                    }
        
                    $msgSentArr[] = $phoneNo;
                    $result["status"] = TRUE;
                    $result["msg"] = "SMS sent";

                    $messageId = md5($phoneNo);
                    $this->saveTextMsgLog($employee, $messageId, true, $sendType, $msgType);
                }
            } catch (Exception $e) {
                $msgNotSentArr[] = $phoneNo;
                $result["status"] = FALSE;
                $result["msg"] = "SMS not sent";

                $messageId = NULL;
                $this->saveTextMsgLog($employee, $messageId, false, $sendType, $msgType);
                // echo "<pre>". print_r($e[0]->message, 1) ."</pre>";exit;
            }
        }

        $result["msgSentArr"] = $msgSentArr;
        $result["msgNotSentArr"] = $msgNotSentArr;

        return $result;
    }

    protected function saveTextMsgLog($employee, $messageId, $status, $sendType, $msgType)
    {
        $data = array(
            'employee_id' => $employee["employee_id"],
            'company_id' => $employee["company_id"],
            'phone_number' => $employee["phone_number"],
            'date' => date("Y-m-d"),
            'send_type' => $sendType,
            'type' => $msgType,
            'message' =>  $employee["message"],
            'status' => ($status ? "success" : "failed"),
            'message_id' =>  $messageId,
            'sent_by' => @$this->user_id ?:null,
            'sent_at' => date("Y-m-d H:i:s")
        );

        $this->Common_model->insert_data('main_sms_logs', $data);
    }

    public function checkModuleAccess($userGroupId, $moduleId, $userModule)
    {
        $userModuleArr = explode(',', $userModule);
        if (in_array($moduleId, $userModuleArr)) {
            return TRUE;
        } else {
            // return FALSE;
            redirect('Con_Alert');
        }
    }

    public function checkPageAccess($type, $employeeId, $currentCompanyId)
    {
        $record = array();
        if ($type == "employee") {
            $this->db->from('main_employees');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="onboarding_employee"){
            $this->db->from('main_ob_personal_information');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_actions"){
            $this->db->from('main_emp_actions');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_info_volentary"){
            $this->db->from('main_voluntary_info');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_info_involuntary"){
            $this->db->from('main_involuntary_info');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        }  else if($type =="emp_check"){
            $this->db->from('main_bgcheckdetails');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_screening"){
            $this->db->from('main_screening_types');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_w4"){
            $this->db->from('main_ob_w4');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_i9"){
            $this->db->from('main_ob_i9');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_leave_track"){
            $this->db->from('main_accrual_leave_track');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_leave_policy"){
            $this->db->from('main_leave_policy');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_holiday_group"){
            $this->db->from('main_holiday_group');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_CV"){
            $this->db->from('main_cv_management');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        }  else if($type =="emp_open_position"){
            $this->db->from('main_opening_position');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_schedule"){
            $this->db->from('main_schedule');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_training"){
            $this->db->from('main_training_planning');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_training_requisition"){
            $this->db->from('main_training_requisition');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_training_feedback"){
            $this->db->from('main_training_feedback');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="emp_training_staus"){
            $this->db->from('main_training_status');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="usergroup"){
            $this->db->from('main_users');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="users"){
            $this->db->from('main_users');
            $this->db->where('id', $employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
        } else if($type =="company"){
            $this->db->from('main_company');
            $this->db->where('id',$employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
            //print_r($record); exit;
        } else if($type =="emp_separation"){
            $this->db->from('main_separation_information');
            $this->db->where('id',$employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
            //print_r($record); exit;
        } else if($type =="leave_holiday"){
            $this->db->from('main_holiday');
            $this->db->where('id',$employeeId);
            $this->db->where('isactive', 1);
            $query = $this->db->get();
            $record = $query->result();
            //print_r($record); exit;
        }
          
        // echo "<pre>". print_r($record, 1) ."</pre>";exit;

        if ($record) {
            if ($type == "employee") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "onboarding_employee") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_User_alert');
                }
            } else if ($type == "emp_actions") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_info_volentary") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }  else if ($type == "emp_info_involuntary") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }  else if ($type == "emp_check") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }  else if ($type == "emp_screening") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }  else if ($type == "emp_i9") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }  else if ($type == "emp_leave_track") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }  else if ($type == "emp_leave_policy") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_holiday_group") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_CV") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_open_position") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_schedule") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_training") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_training_requisition") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_training_feedback") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "emp_training_staus") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if ($type == "usergroup") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_User_alert');
                }
            } else if ($type == "users") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_User_alert');
                }
            } else if ($type == "company") {
                if ($currentCompanyId == $record[0]->id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_User_alert');
                }
            } else if ($type == "emp_separation") {
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            } else if($type =="leave_holiday"){
                if ($currentCompanyId == $record[0]->company_id) {
                    return TRUE;
                } else {
                    redirect('Con_Alert/page_access_alert');
                }
            }
        } else {
            redirect('Con_Alert');
        }
    }

    public function checkUserGroupCreateAccess()
    {
        $result = false;
        if ($this->user_group == $this->ROLE_SUPER_ADMIN || $this->user_group == $this->ROLE_COMPANY_ADMIN) {
            $result = true;
        }

        return $result;
    }

    public function checkShowSSNAccess()
    {
        $result = false;
        /* if (isset($this->session->userdata('hr_logged_in')['user_group']) && ($this->session->userdata('hr_logged_in')['usertype'])) {
            if ($this->session->userdata('hr_logged_in')['user_group'] == 11 || ($this->user_group == 1 && $this->session->userdata('hr_logged_in')['usertype'] ==3) || $this->session->userdata('hr_logged_in')["company_view"]=1) { // where 11 is the user group id of "HR Manager"
                $showSSNButton = true;
            }
        } */
        if ($this->user_group == $this->ROLE_SUPER_ADMIN || $this->user_group == $this->ROLE_HR_MANAGER || $this->user_group == $this->ROLE_COMPANY_ADMIN) {
            $result = true;
        }

        return $result;
    }

    public function getCurrentEmployeeId()
    {
        $employeeId = null;
        $this->db->from('main_employees');
        $this->db->where('emp_user_id', $this->user_id);
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        $employee = $query->result();

        if ($employee) {
            $employeeId = $employee[0]->id;
        }

        return $employeeId;
    }

    public function isSuperAdmin()
    {
        $result = false;
        if ($this->user_group == $this->ROLE_SUPER_ADMIN) {
            $result = true;
        } 

        return $result;
    }

    public function isCompanyAdmin()
    {
        $result = false;
        if ($this->user_group == $this->ROLE_COMPANY_ADMIN) {
            $result = true;
        } 

        return $result;
    }

    public function getIgnoreUserGroup()
    {
        $result = array();

        if ($this->user_group == $this->ROLE_SUPER_ADMIN || $this->user_data['company_view']) {
            $result = array($this->ROLE_SUPER_ADMIN, $this->ROLE_PARTNER, $this->ROLE_GROUP);

        } else if($this->user_group == $this->ROLE_COMPANY_ADMIN) {
            $result = array($this->ROLE_SUPER_ADMIN, $this->ROLE_PARTNER, $this->ROLE_GROUP);
        
        }
        
        return $result;
    } 

}
