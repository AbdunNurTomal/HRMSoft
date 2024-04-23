<?php

class Sendmail_model extends CI_Model
{
    public $fromEmail = "info@hrcsoft.com";
    public $emailFromName = "HRC Service";
    public $devEnvironment = "development";
    public $prodEnvironment = "production";
    
    public function __construct()
    {
        parent::__construct();

        $this->load->config('email');
        $this->load->library('email');
    }
    
    public function company_creation_mail($name, $to_email, $password)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */

        // Load email library
        /* $this->load->library('email');
        $this->email->initialize($config); */

        // $from_email = "info@hrcsoft.com";

        // $this->email->from($from_email, 'Sohel');
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Company User Information.');
        $this->load->helper('url');

        $companyUserCreatePasswordUrl = base_url() . "Con_User/create_password/" . md5($password);

        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        // $info['msg'] = " <br> <h3>New Company from HRM</h3> <br> <br>  Hi ". $name ." , <br> You Create New HRM Company <br> <br> USER ID :  ". $to_email ." <br> PASSWORD : ". $password ."  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
        $info['msg'] = " <br>  Hi ". $name .", <br><br> An account has been created for you in HRM. Please use the following link to create your password.<br><br>"
        . " Click here to create password: <br>"
        . "<a href='". $companyUserCreatePasswordUrl ."' target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; 
            text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; 
            border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; 
            display: inline-block;'>CREATE PASSWORD</a> <br><br>"
        . " Best Regards, <br> The HRM Development team. <br><br> ";
        // print_r($info['msg']);exit;
        $body = $this->load->view('sadmin/compose.php', $info, TRUE);

        $this->email->message($body);

        // Send mail
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

    public function employee_creation_mail($name,$to_email,$password)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */

        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config); */

        // $from_email = "info@hrcsoft.com"; 
        // $to_email = $to_email; 

        // $this->email->from($from_email, 'Sohel'); 
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Employee User Information'); 
        $this->load->helper('url');
        $employeeCreatePasswordUrl = base_url() . "Con_User/create_password/" . md5($password);
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
         //$info['msg'] = " <br> <h3>New Employee from HRM</h3> <br> <br>  Hi ". $name ." , <br> You are New HRM Employee <br> <br> USER ID :  ". $to_email ." <br> PASSWORD : ". $password ."  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
        $info['msg'] = " <br>  Hi ". $name .", <br><br> An account has been created for you in HRM. Please use the following link to create your password.<br><br>"
        . " Click here to create password: <br>"
        . "<a href='". $employeeCreatePasswordUrl ."' target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; 
            text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; 
            border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; 
            display: inline-block;'>CREATE PASSWORD</a> <br><br>"
        . " Best Regards, <br> The HRM Development team. <br><br> ";
        // print_r($info['msg']);exit;
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        //Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
            return TRUE; 
            else 
                return FALSE; 
        }
    }
    
    public function user_creation_mail($name, $to_email, $password)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */

        // Load email library
        /* $this->load->library('email');
        $this->email->initialize($config); */

        /* $from_email = "info@hrcsoft.com";
        $to_email = $to_email; */

        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('User Creation Information');

        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";

        $this->load->helper('url');
        $createPasswordUrl = base_url() . "Con_User/create_password/" . md5($password);

        // $info['msg'] = " <br> <h3>New User from HRM</h3> <br> <br>  Hi ". $name ." , <br> You are New User from HRC Service <br> <br> USER ID :  ". $to_email ." <br> PASSWORD : ". $password ."  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
        $info['msg'] = " <br>  Hi ". $name ." , <br><br> An account has been created for you in HRM. Please use the following link to create your password.<br><br>"
        . " Click here to create password: <br>"
        . "<a href=". $createPasswordUrl ." target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; display: inline-block;'>CREATE PASSWORD</a> <br><br>"
        . " Best Regards, <br> The HRM Development team. <br><br> ";
        // print_r($info['msg']);exit;

        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body);

        //Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
            return TRUE; 
            else 
                return FALSE; 
        }
    }

    public function user_update_mail($name,$to_email,$password)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email; */ 
   
        $this->email->from($this->fromEmail, $this->emailFromName); 
        $this->email->to($to_email);
        $this->email->subject('Update User Information'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> <h3>Update User from HRM</h3> <br> <br>  Hi ". $name ." , <br> You are update user information from HRC Service <br> <br> USER ID :  ". $to_email ." <br> PASSWORD : ". $password ."  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
        
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
            return TRUE; 
            else 
                return FALSE; 
        }
    }

    public function selfuser_send_mail($name,$to_email,$password)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config); */
         
        /* $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
         
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Self User');
        $this->load->helper('url');
        $selfuser_createPasswordUrl = base_url() . "Con_User/create_password/" . md5($password);

        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        //$info['msg'] = " <br> <h3>New sign-in from HRM</h3> <br> <br>  Hi " . $name . " , <br> You Create New HRM Account <br> <br> USER ID :  " . $to_email . " <br> PASSWORD : " . $password . "  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         $info['msg'] = " <br>  Hi ". $name ." , <br><br> An account has been created for you in HRM. Please use the following link to create your password.<br><br>"
        . " Click here to create password: <br>"
        . "<a href='". $selfuser_createPasswordUrl ."' target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; display: inline-block;'>CREATE PASSWORD</a> <br><br>"
        . " Best Regards, <br> The HRM Development team. <br><br> ";
        // print_r($info['msg']);exit;

        $body = $this->load->view('sadmin/compose.php', $info, TRUE);

        $this->email->message($body);

        //Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            //echo $this->fromEmail;die();
            if ($this->email->send())
                return TRUE;
            else
                return FALSE;
        }
    }

    public function selfuser_send_mail_otp($candidate_id,$to_email,$candidate_name)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config); */
         
        /* $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
         
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Self User');
        $this->load->helper('url');
        //$selfuser_createPasswordUrl = base_url() . "Con_User/create_password/" . md5($password);
        $selfuser_createPasswordUrl = "https://hrcsoft.com/onboardingapp/public/".$candidate_id;

        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        //$info['msg'] = " <br> <h3>New sign-in from HRM</h3> <br> <br>  Hi " . $name . " , <br> You Create New HRM Account <br> <br> USER ID :  " . $to_email . " <br> PASSWORD : " . $password . "  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         $info['msg'] = " <br>  Hi ". $candidate_name ." , <br><br> An account has been created for you in HRM. Please use the following link to create your Onboarding.<br><br>"
        . " Click here to create onboarding: <br>"
        . "<a href='". $selfuser_createPasswordUrl ."' target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; display: inline-block;'>CREATE ONBOARDING</a> <br><br>"
        . " Best Regards, <br> The HRM Development team. <br><br> ";
        // print_r($info['msg']);exit;

        $body = $this->load->view('sadmin/compose.php', $info, TRUE);

        $this->email->message($body);

        //Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            //echo $this->fromEmail;die();
            if ($this->email->send())
                return TRUE;
            else
                return FALSE;
        }
    }
      
    public function ob_hired_send_mail($firstname,$socialsecuritynumber,$to_email,$date_of_joining)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Confirmation Email'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> <h3>Welcome</h3> <br> <br>  Hi ". $firstname ." , <br><br> This letter is to confirmation. <br><br><br><br> "
                 . "Your joining Date :  ". $date_of_joining ." <br><br><br><br>  "
                 . " Best, <br> The HRM Development team. <br><br><br><br> ";

        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body);

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }

    public function absence_notification_send_mail($first_name,$to_email,$from_datea,$to_datea,$absent_type)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Confirmation Email'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br>  Hi ". $first_name ." , <br><br> This letter is to absence notification email. <br><br><br>"
                 . "Form Date :  ". $from_datea ." <br>"
                 . "To Date :  ". $to_datea ." <br>"
                 . "Absence Type :  ". $absent_type ." <br><br>"
                 . " Best, <br> The HRM Development team. <br><br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }
      
    public function selected_candidate_send_mail($first_name,$to_email,$password)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName); 
        $this->email->to($to_email);
        $this->email->subject('Confirmation Email'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br>  Hi ". $first_name ." , <br><br> Congratulations , You are Selected . <br><br> Please Add Onboarding Information. <br><br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }
    
    public function alert_send_mail($first_name,$to_email)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName); 
        $this->email->to($to_email);
        $this->email->subject('Confirmation Email');
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br>  Hi ". $first_name ." , <br><br> this is for your kind notification.... <br><br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE;
            else
                return FALSE; 
        }
    }
    
    public function user_welcome_mail($name, $to_email)
    { 
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('User Welcome Email');
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br>  Hi ". $name ." , <br><br> This is for your User Welcome Message.... <br><br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
            return TRUE; 
            else 
                return FALSE; 
        }
    }
    
    public function training_send_mail($employee_id,$proposed_date)
    { 
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config); */
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
         
        $employees_idd = array_map('intval', $employee_id);
        $this->db->order_by("employee_id", "asc");
        $this->db->where_in('employee_id', $employees_idd);
        $employees_query = $this->db->get('main_employees');
        
        if ($employees_query) {
            foreach ($employees_query->result() as $row) {
                if ($row->email!="") {
                    $this->email->from($this->fromEmail, $this->emailFromName);
                    $this->email->to($row->email);
                    $this->email->subject('Training Notification Email');
                    
                    $info['msg'] = " <br>  Hi ". $row->first_name ." , <br><br> This is for your Training Notification Message.... <br><br><br> Proposed Date :  ". $proposed_date ." <br><br><br> "
                        . " Best, <br> The HRM Development team. <br><br> ";
                    $body = $this->load->view('sadmin/compose.php',$info,TRUE);
                    $this->email->message($body); 
                    
                    if (ENVIRONMENT == $this->devEnvironment) {
                        $this->writeMailToCSV($info['msg']);
                        return TRUE;
                    } else {
                        $result = $this->email->send();
                    }
                }
            }
        }

        if ($result) // Send mail 
           return TRUE; 
        else 
            return FALSE; 
    }
    
    public function forgot_password_mail($username,$to_email,$password,$passwordResetHash)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email');
        $this->email->initialize($config);

        $from_email = "info@hrcsoft.com";
        $to_email = $email; */

        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Forgot Password Email');
        
        $this->load->helper('url');
        $passwordResetUrl = base_url() . "Chome/reset_password/" . $passwordResetHash;

        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
         /* $info['msg'] = " <br>  Hi ". $username ." , <br><br> This is for your User Password.... <br><br><br> "
             . " Password : ". $password ."  <br><br> "
             . " Best, <br> The HRM Development team. <br><br> "; */
        $info['msg'] = " <br>  Hi ". $username ." , <br><br> We received a request to reset your password. Please ignore this email if you did not make the request.<br><br>"
            . " Click here to reset: <br>"
            . "<a href=". $passwordResetUrl ." target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; display: inline-block;'>RESET PASSWORD</a> <br><br>"
            . " Best Regards, <br> The HRM Development team. <br><br> ";
        // print_r($info['msg']);exit();
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);

        $this->email->message($body);

        //Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }
    
    public function candidate_mail($name,$to_email)
    {  
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Thanking for Apply this Post.'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> <h3>Thanking for Apply from HRM</h3> <br> <br>  Hi ". $name ." , <br> Thank You for your application  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }
      
    public function CandidateScheduled_mail($candidate_name,$to_email,$interview_date,$interview_time,$requisition_id)
    {  
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email; */
   
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Interview Scheduled Mail.'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> <h3>Thanking for Apply from HRM</h3> <br> <br>  Hi ". $candidate_name ." , <br> Thank You for your application. Your interview Date ". $interview_date ." And Time ". $interview_time ." <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }
      
    public function employeeScheduled_mail($employee_name,$to_email,$interview_date,$interview_time,$requisition_id)
    {
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject('Interview Scheduled Mail.'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> <h3>Thanking from HRM</h3> <br> <br>  Hi ". $employee_name ." , <br>  Your interview Date ". $interview_date ." And Time ". $interview_time ." <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }
      
    public function notify_Reject_mail($candidate_name,$to_email)
    {  
        /* $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html'; */
        
        // Load email library 
        /* $this->load->library('email'); 
        $this->email->initialize($config);
         
        $from_email = "info@hrcsoft.com"; 
        $to_email = $to_email;  */
   
        $this->email->from($this->fromEmail, $this->emailFromName); 
        $this->email->to($to_email);
        $this->email->subject(' Reject Notification Mail.'); 
         
        $info['logo']= "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br> <h3>Thanking from HRM</h3> <br> <br>  Hi ". $candidate_name ." , <br>  This time you are Reject. Call ti you next time. <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         
        $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
        $this->email->message($body); 

        // Send mail 
        if (ENVIRONMENT == $this->devEnvironment) {
            $this->writeMailToCSV($info['msg']);
            return TRUE;
        } else {
            if($this->email->send()) 
                return TRUE; 
            else 
                return FALSE; 
        }
    }

    /* public function send_password_recovery_mail($uid, $tbl)
    {
        // getting user info from database
        $query = $this->db->get_where($tbl,array('id'=>$uid));
        $row = $query->result();

        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "587";
        $config['mailtype']            = 'html';
        $config['charset']             = 'utf-8';
        $config['newline']             = "\r\n";
        $config['wordwrap']            = TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

        $this->email->from('info@easycarrying.com', 'Easy Carrying');
        $this->email->to($row[0]->email);
        //$this->email->cc('another@anotherexample.com');
        //$this->email->bcc('albratorss@gmail.com');
        $this->email->subject('Password Change Notification: Continuous Impression');

        $data['msg'] = "Gretting! Hello ".$row[0]->contact_person_name." Your account password has been successfully change. Bellow is your new password<br><strong>New Password : ".$row[0]->password."</strong>";

        $body = $this->load->view('partial/compose.php',$data,TRUE);
        $this->email->message($body);
        $this->email->send();
    } */

    protected function writeMailToCSV($mailContent)
    {
        $fp = fopen(FCPATH . 'local_mails/'. date('YmdHis') . '.txt', 'w');
        fwrite($fp, $mailContent);
        fclose($fp);
        // echo "Mail contents write to a file at " . FCPATH . "local_mails/";
    }

    public function sendGridMail($name, $to_email, $password)
    {
        $companyUserCreatePasswordUrl = base_url() . "Con_User/create_password/" . md5($password);

        $info['logo'] = "http://hrcsoft.com/assets/img/hrc_logo.png";
        $info['msg'] = " <br>  Hi ". $name .", <br><br> An account has been created for you in HRM. Please use the following link to create your password.<br><br>"
        . " Click here to create password: <br>"
        . "<a href='". $companyUserCreatePasswordUrl ."' target='_blank' style='font-family:Open Sans, Arial, Helvetica Neue, sans-serif; font-size:18px; color: #ffffff; 
            text-decoration: none; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; background-color: #2196f3; 
            border-top: 12px solid #2196f3; border-bottom: 12px solid #2196f3; border-right: 18px solid #2196f3; border-left: 18px solid #2196f3; 
            display: inline-block;'>CREATE PASSWORD</a> <br><br>"
        . " Best Regards, <br> The HRM Development team. <br><br> ";
        $body = $this->load->view('sadmin/compose.php', $info, TRUE);

        $this->email->set_newline("\r\n");
        $this->email->from($this->fromEmail, $this->emailFromName);
        $this->email->to($to_email);
        $this->email->subject("HRCSoft - Test Mail using SendGrid");
        $this->email->message($body);

        // Send mail
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

}
