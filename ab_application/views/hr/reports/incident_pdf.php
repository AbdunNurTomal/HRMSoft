<!DOCTYPE html>
<html><body>

         <?php
        if ($Emp_Data['company_id'] == 0) {
            $company_name="";
        } else {
            $show_in_header = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'show_in_header');

            if ($show_in_header == 0) {
                $company_name = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_full_name');
            } else {
                $company_name = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_short_name');
            }

            $company_logo = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_logo');
        }
//
//        $first_name = $this->Common_model->get_selected_value($this, 'employee_id', $Emp_Data['employee_id'], 'main_employees', 'first_name');
//        $middle_name = $this->Common_model->get_selected_value($this, 'employee_id', $Emp_Data['employee_id'], 'main_employees', 'middle_name');
//        $emp_name = $first_name . " " . $middle_name;
        ?>
        
        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:48%;text-align:right"><img width="50" src="<?php echo Get_File_Directory('uploads/companylogo/' . $company_logo) ?>" alt="Company Logo" /></td>
                <td style="font-style:normal; font-size:20px; text-align:left;"><?php echo $company_name; ?></td>
            </tr>
        </table>
        
        <h2 style='margin-top:0;text-align:center'>Incident Report Form</h2>
        
        <table style="width:100%;margin-bottom:20px">
            <tr>
                <td><b><u>Instructions</u></b>: Employees should use this form to report all work-related incidents, 
                    including, but not limited to, instances of alcohol or drug use, discrimination, 
                    harassment, theft, and violence. This helps us to identify and correct workplace problems. 
                    This form should be completed and returned to a supervisor as soon as possible.
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap"> Nature of incident being reported (ex: drug use, harassment, theft, etc.):</td>
                <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->get_name($this, $Emp_Data['tncident_type'], 'main_incidenttype', 'incident_type'); ?></td>
            </tr>
        </table> 
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Your name:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->employee_name($Emp_Data['employee_id']); ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Job title:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Job_Title; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Supervisor:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Supervisor_Name; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Have you told your supervisor about this incident? </td>
                <td style="border-bottom:1px solid #000;"><?php echo ($Emp_Data['report_supervisor'] == 1) ? 'Yes' : 'No'; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Date of Incident:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Data['action_date']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Time of incident:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Data['accident_time']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Names of witnesses (if any)</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Data['accident_witness']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Where, exactly, did the incident happen?</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Data['accident_location']; ?></td>
            </tr>
        </table>
        
        <table style="width:100%;margin-top:20px">
            <tr>
                <td>Describe the incident in detail (continue on the back if necessary). Identify 
                    who, what, when, where, and how: Who committed the alleged incident? What exactly
                    occurred or what was said? When did it occur, and is it still ongoing? Where did 
                    it occur? How often did it occur? How did it affect you? </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Data['report_description']; ?></td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;">&nbsp;</td>
            </tr>
        </table>        
        <table style="width:100%;margin-top:50px">
            <tr>
                <td style="width:1%;white-space:nowrap">Your signature:</td>
                <td style="border-bottom:1px solid #000;"></td>
                <td style="width:1%;white-space:nowrap">Date:</td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>
    </body>
    
    <?php if ($Emp_Data['discipline_type'] != 0) { ?>
        <!----------- Next Page Starts From Here ----------->

        <head></head>
        <body>
            <h2 style='margin-top:0;text-align:center'>Confidential Supervisor's Memorandum of Disciplinary Action</h2>

            <table style="width:100%;margin-top:20px">
                <tr>
                    <td style="width:1%;white-space:nowrap">Date: </td>
                    <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->show_date_formate($Emp_Data['action_date']); ?></td>
                </tr>
            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Employee Name: </td>
                    <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->employee_name($Emp_Data['employee_id']); ?></td>
                </tr>
            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Department: </td>
                    <td style="border-bottom:1px solid #000"><?php echo $Work_Data['department_name']; ?></td>
                </tr>
            </table>                
            <table style="width:100%;">
                <tr>
                    <td style="white-space:nowrap">Details of Problem/Incident: </td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;font-style:italic;text-align:center">
                        <?php echo $Emp_Data['subject']; ?>
                        <?php echo ', ', $Emp_Data['description']; ?>
                    </td>
                </tr>
            </table>                
            <table style="width:100%;">
                <tr>
                    <td style="white-space:nowrap">Date/Time and Location of Incident (if applicable): </td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;font-style:italic;text-align:center">
                        <?php echo $this->Common_model->show_date_formate($Emp_Data['action_date']); ?>
                        <?php echo ', ' . $Emp_Data['accident_time']; ?>
                        <?php echo ' - ' . $Emp_Data['accident_location']; ?>
                    </td>
                </tr>
            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Reported By:</td>
                    <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['supervisor_reported_by']; ?></td>
                </tr>
            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Witnesses:</td>
                    <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['accident_witness']; ?></td>
                </tr>
            </table> 
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Comments:</td>
                    <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['employee_comments']; ?></td>
                </tr>
            </table>   
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Corrective Action to be Taken:</td>
                    <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['improvement_plan']; ?></td>
                </tr>
            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Recommendations:</td>
                    <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['further_actions']; ?></td>
                </tr>
            </table>
            <table style="width:100%;margin-top:20px">
                <tr>
                    <td colspan="2" style="font-style:italic">Notice: The above infractions have / have not been noted and recorded in the employee's personnel file.</td>
                </tr>
            </table>        
            <table style="border:4px solid red;margin-top:20px">
                <tr>
                    <td style="border:2px solid red">
                        <p style="text-align:justify;padding:10px">
                            EMPLOYER NOTES:<br/><br/>

                            This report should be kept in the supervisor's file to memorialize the details of the incident. 
                            In general, when the record of discipline goes into the employee's personnel file, there is no 
                            need for the supervisor to keep a separate record of the incident, unless there are unusual 
                            circumstances or information the supervisor wishes to memorialize. Anyone reviewing the employee's 
                            personnel file should be able to review a comprehensive record of discipline, including any notes 
                            from the supervisor.<br/><br/>

                            Many progressive discipline policies, however, provide for a first step, e.g., counseling or a 
                            verbal warning, which does not go into the employee's personnel file. Such a first step is 
                            intended to be informative not punitive. If your company provides for such a non-punitive first 
                            step, the supervisor should nevertheless maintain a written record of the counseling or verbal 
                            warning in order to prove the use of the first step of progressive discipline if the problem continues.
                        </p>
                    </td>
                </tr>
            </table>
        </body>

    <?php } ?>

    <style type="text/css">
        tr td:nth-child(even){font-style:italic !important;text-align:center}
    </style>

</html>