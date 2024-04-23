<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Array
(
    [1] => Birthdays Alert
    [2] => Certification
    [3] => Evaluation
    [4] => Driver’s License
    [5] => Work Permit
    [6] => Medical Leave
    [7] => Vacation
    [8] => Leave
    [9] => Benefit Enrollment
    [10] => Benefits Eligibility
    [11] => 401K
    [12] => Probation
    [13] => Deduction
    [14] => Garnishments
    [15] => Training
    [16] => Leave Request
    [17] => Employee Actions
    [18] => Worker’s Compensation
    [19] => Work Anniversary
) */

class Cron extends CI_Controller 
{
    public $alertsArr = array();

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

        $this->alertsArr = $this->Common_model->get_array('alert_type');

        // $this->load->model('Common_model');
    }
    
    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function sendTextMsg()
    {
        // echo date("Y-m-d H:i:s") . "\n\n";

        // is_cli_request() is provided by default input library of codeigniter
        // if ($this->input->is_cli_request()) {
            // check cron already executed today starts
            $this->db->from('main_cron_log');
            $this->db->where('MONTH(run_at)', date("m"));
            $this->db->where('DAY(run_at)', date("d"));
            $this->db->where('YEAR(run_at)', date("Y"));
            $query = $this->db->get();
            $smsCronLog = $query->result();
            if ($smsCronLog) {
                echo "SMS Alerts - CRON - already completed for today".PHP_EOL;
                exit;
            }
            // check cron already executed today ends

            // getting each companies alerts starts
            $this->db->from('main_alert_policy');
            $this->db->where('alert_status',1);
            $this->db->where('isactive',1);
            $query = $this->db->get();
            $companyAlerts = $query->result();

            foreach ($companyAlerts as $companyAlert) {
                $companyId = $companyAlert->company_id;
                $alertId = $companyAlert->alert_item;
                // $alertName = $this->alertsArr[$alertId];
                $alertBeforeDays = $companyAlert->alert_after_days;
                $alertMessageTemplate = $companyAlert->alert_message_template;

                $alertsToSendArr = array();
                if ($alertId == 1) { // birthday alert
                    $alertsToSendArr = $this->sendBirthdayLikeAlert($companyId, $alertBeforeDays, $alertMessageTemplate, $alertId);

                } else if ($alertId == 4) { // driver's license expiry
                    $alertsToSendArr = $this->sendDrivingLicenseExpiryAlert($companyId, $alertBeforeDays, $alertMessageTemplate);

                } else if ($alertId == 19) { // work anniversary
                    $alertsToSendArr = $this->sendBirthdayLikeAlert($companyId, $alertBeforeDays, $alertMessageTemplate, $alertId);
                }

                $result = $this->KurunthamModel->sendSMS($alertsToSendArr, "automated", $alertId);
            }
            // getting each companies alerts ends

            // log to main_cron_log table starts
            $data = array(
                'run_at' => date("Y-m-d H:i:s"),
                'status' => "completed"
            );
            $this->Common_model->insert_data('main_cron_log', $data);
            // log to main_cron_log table ends

            echo "SMS Alerts - CRON - completed".PHP_EOL;

            /*} else {
            echo "You dont have access".PHP_EOL;
        }*/
    }

    protected function sendBirthdayLikeAlert($companyId, $alertBeforeDays, $alertMessageTemplate, $alertId)
    {
        $currentDate = date('Y-m-d');
        $birthdayWishDate = date('Y-m-d', strtotime($currentDate. ' +'.$alertBeforeDays.' days'));
        $dayOnly = date("d", strtotime($birthdayWishDate));
        $monthOnly = date("m", strtotime($birthdayWishDate));

        $this->db->from('main_employees');
        $this->db->where('company_id', $companyId);

        if ($alertId == 1) { // Birthdays Alert
            $this->db->where('MONTH(birthdate)', $monthOnly);
            $this->db->where('DAY(birthdate)', $dayOnly);

        } else if ($alertId == 19) { // Work Anniversary
            $this->db->where('MONTH(hire_date)', $monthOnly);
            $this->db->where('DAY(hire_date)', $dayOnly);
        }

        $this->db->where('contact_via_text',1);
        $query = $this->db->get();
        $employees = $query->result();

        $employeesArrToSendAlerts = array();
        foreach ($employees as $employee) {
            $employeeName = $employee->first_name;

            $companyName = $this->getCompanyName($employee->company_id);

            $params = array();
            $params["Employee Name"] = $employeeName;
            $params["Company Name"] = $companyName;
            $messageToSend = $this->getParsedMessage($alertMessageTemplate, $params);

            $employeesArrToSendAlerts[] = array(
                                        "employee_id" => $employee->id,
                                        "employee_name" => $employeeName,
                                        "company_id" => $employee->company_id,
                                        "phone_number" => $employee->mobile_phone,
                                        "message" => $messageToSend
                                    );
        }

        return $employeesArrToSendAlerts;
    }

    protected function sendDrivingLicenseExpiryAlert($companyId, $alertBeforeDays, $alertMessageTemplate)
    {
        $currentDate = date('Y-m-d');
        $licenseDueDate = date('Y-m-d', strtotime($currentDate. ' +'.$alertBeforeDays.' days'));

        $licenseExpiryRemainderMsg = null;

        $this->db->select('main_employees.id as employee_id, main_employees.first_name, main_employees.company_id, main_employees.mobile_phone');
        $this->db->from('main_employees');
        $this->db->where('main_employees.company_id', $companyId);
        $this->db->join('main_emp_license', 'main_employees.id = main_emp_license.employee_id');
        $this->db->where('main_emp_license.expiration_date', $licenseDueDate);
        $this->db->where('main_employees.contact_via_text', 1);
        $query = $this->db->get();
        $licenseExpiredEmployees = $query->result();

        $employeesArrToSendAlerts = array();
        foreach ($licenseExpiredEmployees as $employee) {
            $employeeName = $employee->first_name;

            $companyName = $this->getCompanyName($employee->company_id);

            $params = array();
            $params["Employee Name"] = $employeeName;
            $params["Company Name"] = $companyName;
            $licenseDueDateInFormat = date("m/d/Y", strtotime($licenseDueDate));
            $params["MM/DD/YYYY"] = $licenseDueDateInFormat;
            $messageToSend = $this->getParsedMessage($alertMessageTemplate, $params);

            $employeesArrToSendAlerts[] = array(
                                        "employee_id" => $employee->employee_id,
                                        "employee_name" => $employeeName,
                                        "company_id" => $employee->company_id,
                                        "phone_number" => $employee->mobile_phone,
                                        "message" => $messageToSend
                                    );
        }

        return $employeesArrToSendAlerts;
    }

    protected function getMessageTemplate($alertType, $companyId)
    {
        $this->db->from('main_sms_template');
        $this->db->where('company_id', $companyId);
        $this->db->where('alert_type', $alertType);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $birthdayMsgTemplate = $query->result();

        $birthdayWishesMsg = "";
        if ($birthdayMsgTemplate) {
            $birthdayWishesMsg = $birthdayMsgTemplate[0]->message;
        }

        return $birthdayWishesMsg;
    }

    protected function getCompanyName($companyId)
    {
        $this->db->from('main_company');
        $this->db->where('id', $companyId);
        $this->db->where('isactive', 1);
        $query = $this->db->get();
        $company = $query->result();

        $companyName = "HRC Team";
        if ($company) {
            $companyName = $company[0]->company_short_name;
        }

        return $companyName;
    }

    protected function getParsedMessage($message, $paramsArr)
    {
        foreach ($paramsArr as $key => $value) {
            $searchString = "[".$key."]";
            $message = str_replace($searchString, $value, $message);
        }

        return $message;
    }

}
