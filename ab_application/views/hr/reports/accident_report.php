<!DOCTYPE html>
<html><body>
        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:48%;text-align:right"><img width="50" src="<?php echo Get_File_Directory('uploads/companylogo/' . $company_logo) ?>" alt="Company Logo" /></td>
                <td style="font-style:normal;text-align:left;font-size:20px">
                    <?php
                    $show = $this->Common_model->get_name($this, $this->company_id, 'main_company', 'show_in_header');
                    if ($show == 0) {
                        $company_name = $this->Common_model->get_name($this, $this->company_id, 'main_company', 'company_full_name');
                    } elseif ($show == 1) {
                        $company_name = $this->Common_model->get_name($this, $this->company_id, 'main_company', 'company_short_name');
                    } else {
                        $company_name = '';
                    }
                    echo $company_name;
                    ?>
                </td>
            </tr>
        </table>
        <h2 style='margin-top:0;text-align:center;'>EMPLOYEE ACCIDENT REPORT FORM</h2>
        <table style="width:100%;">
            <tr>
                <td style="font-weight:bold">TO BE COMPLETED BY MANAGER</td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Employee Name:</td>
                <td style="border-bottom:1px solid #000"><?php echo $action_info->first_name . ' ' . $action_info->middle_name . ' ' . $action_info->last_name; ?></td>
                <td style="width:1%;white-space:nowrap">Social Security #:</td>
                <td style="border-bottom:1px solid #000;width:1%;white-space:nowrap"><?php echo $action_info->ssn_code; ?></td>
                <td style="width:1%;white-space:nowrap">Hire Date:</td>
                <td style="border-bottom:1px solid #000;width:1%;white-space:nowrap"><?php echo $this->Common_model->show_date_formate($action_info->hire_date); ?></td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Marital Status:</td>
                <td style="border-bottom:1px solid #000"><?php echo (($action_info->marital_status == 1) ? 'Married' : 'Unmarried'); ?></td>
                <td style="width:1%;white-space:nowrap">Dependents:</td>
                <td style="border-bottom:1px solid #000;width:45%">
                    <?php
                    $this->db->select('fast_name, middle_name, last_name');
                    $dependents = $this->db->get_where('main_emp_enrolling', array('employee_id' => $action_info->employee_id))->result();

                    $Arr = array();
                    if (!empty($dependents)) {
                        foreach ($dependents as $key => $row) {
                            $Arr[] = $row->fast_name . ' ' . $row->middle_name . ' ' . $row->last_name;
                        }
                    }
                    echo implode(', ', $Arr);
                    ?>
                </td>
                <td style="width:1%;white-space:nowrap">Wage:</td>
                <td style="border-bottom:1px solid #000">- N/A -</td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Address:</td>
                <td style="border-bottom:1px solid #000;width:30%"><?php echo $action_info->first_address; ?></td>
                <td style="width:1%;white-space:nowrap">City:</td>
                <td style="border-bottom:1px solid #000"><?php echo $action_info->city; ?></td>
                <td style="width:1%;white-space:nowrap">State:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->get_name($this, $action_info->state, 'main_state', 'state_name'); ?></td>
                <td style="width:1%;white-space:nowrap">Zip Code:</td>
                <td style="border-bottom:1px solid #000"><?php echo $action_info->zipcode; ?></td>
                <td style="width:1%;white-space:nowrap">Telephone No.:</td>
                <td style="border-bottom:1px solid #000;width:20%"><?php echo $action_info->mobile_phone; ?></td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Date of Birth:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->show_date_formate($action_info->birthdate); ?></td>
                <td style="width:1%;white-space:nowrap">Sex: &nbsp;&nbsp; M</td>
                <td style="border-bottom:1px solid #000;width:5%"> <i class="fa fa-lg fa-<?php echo ($action_info->gender == 1) ? 'check' : ''; ?>"></i> </td>
                <td style="width:1%;white-space:nowrap">F</td>
                <td style="border-bottom:1px solid #000;width:5%"><i class="fa fa-lg fa-<?php echo ($action_info->gender == 2) ? 'check' : ''; ?>"></i></td>
                <td style="width:1%;white-space:nowrap">Job Title:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->get_name($this, $action_info->position, 'main_jobtitles', 'job_title'); ?></td>
                <td style="width:1%;white-space:nowrap">Department:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->get_name($this, $action_info->department, 'main_department', 'department_name'); ?></td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Immediate Supervisor:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->employee_name($action_info->reporting_manager); ?></td>
                <td style="width:1%;white-space:nowrap">Title</td>
                <td style="border-bottom:1px solid #000">
                    <?php
                    $position_id = $this->Common_model->get_name($this, $action_info->report_supervisor, 'main_employees', 'position');
                    echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                    ?>
                </td>
                <td style="width:1%;white-space:nowrap">Date Reported to Supervisor:</td>
                <td style="border-bottom:1px solid #000;width:15%"><?php echo $this->Common_model->show_date_formate($action_info->supervisor_report_date); ?></td>
                <td style="width:1%;white-space:nowrap">Time:</td>
                <td style="border-bottom:1px solid #000;width:10%"></td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Date when accident was reported</td>
                <td style="border-bottom:1px solid #000"></td>
                <td style="width:1%;white-space:nowrap">Time</td>
                <td style="border-bottom:1px solid #000"></td>
                <td style="width:1%;white-space:nowrap">(AM/PM) &nbsp;&nbsp; Time workday began</td>
                <td style="border-bottom:1px solid #000;width:15%"></td>
                <td style="width:1%;white-space:nowrap">(AM/PM)</td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Date of Accident</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->show_date_formate($action_info->action_date); ?></td>
                <td style="width:1%;white-space:nowrap">Time</td>
                <td style="border-bottom:1px solid #000"><?php echo $action_info->accident_time; ?></td>
                <td style="width:1%;white-space:nowrap">(AM/PM) &nbsp;&nbsp; Paid full wages on the day of injury: &nbsp;&nbsp; Yes </td>
                <td style="border-bottom:1px solid #000;width:10%"></td>
                <td style="width:1%;white-space:nowrap">No </td>
                <td style="border-bottom:1px solid #000;width:10%"></td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Time lost after the accident</td>
                <td style="border-bottom:1px solid #000;width:20%"></td>
                <td style="width:1%;white-space:nowrap">( If yes, please provide dates )</td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>                
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Specify work area where the accident occurred</td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>                        
        <table style="width:100%;margin-top:30px">
            <tr>
                <td style="">Describe injury or illness, parts of body affected and object/substance that directly injured or made person ill.</td>
            </tr>
            <tr>
                <td style="text-decoration:underline;font-style:italic">&nbsp;</td>
            </tr>
        </table>


        <!---------------------------------->
        <div>
            <table style="width:100%;margin-top:30px;border-collapse:collapse;border:1px solid #000">
                <tr>
                    <th style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</th>
                    <th style="border-bottom:1px solid #000;border-right:1px solid #000">YES</th>
                    <th style="border-bottom:1px solid #000;border-right:1px solid #000">NO</th>
                    <th rowspan="3">BODY PART INJURED<br>(Please Circle)</th>
                    <th rowspan="10"><img src="<?php echo Get_File_Directory('assets/img/human-diagnose.jpg'); ?>" /></th>                
                    <th rowspan="3">TYPE OF INJURED<br>(Please Circle)</th>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">Disabling Injury</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">Sent to Hospital</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td rowspan="7" style="font-style:normal">
                        <?php
                        $body_parts = $this->Common_model->get_array('bodypart_injurylist');
                        foreach ($body_parts as $key => $value) {
                            echo '<p style="margin-bottom:0;margin-top:5px">' . $value . '</p>';
                        }
                        ?>
                    </td>
                    <td rowspan="7" style="text-align:center">                        
                        <?php
                        $type_of_injury = $this->Common_model->get_array('type_of_injury');
                        foreach ($type_of_injury as $key => $value) {
                            echo '<p style="margin-bottom:0;margin-top:10px">' . $value . '</p>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">Send to Company Hospital</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">Return to Regular Job</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">Return to Light Duty Job</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">First Aid Administered</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">If employee refused medical attention, have them complete the MEDICAL ATTENTION REFUSAL form.</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                    <td style="border-bottom:1px solid #000;border-right:1px solid #000">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom:1px solid #000;border-right:1px solid #000">If Hospitalized, Name & Address of Hospital</td>
                </tr>            
            </table>
        </div>
<!--        <table style="float:right;width:60%;height:300px;border:1px solid #000">
        <table>
            <tr>
                <th>BODY PART INJURED<br>( Please Circle )</th>
                <th rowspan="2"><img src="<?php // echo Get_File_Directory('assets/img/human-diagnose.jpg');                                                             ?>" /></th>
                <th>TYPE OF INJURED<br>( Please Circle )</th>
            </tr>
            <tr>
                <td>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/></td>
                <td>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/>Head<br/></td>
            </tr>     
        </table>-->
    </body>

    <link rel="stylesheet" href="<?php echo site_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">

    <style type="text/css">
        tr td:nth-child(even){font-style:italic;text-align:center}
        div table{font-size:11px !important}
    </style>

</html>