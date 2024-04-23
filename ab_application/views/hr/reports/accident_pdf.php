<!DOCTYPE html>
<html><body>
        <h2 style='margin-top:0;text-align:center'>Accident/Injury Accident Report</h2>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">Name:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->employee_name($Emp_Data['employee_id']); ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Employee Number:</td>
                <td style="border-bottom:1px solid #000"><?php echo sprintf('%08d', $Emp_Data['employee_id']); ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Date of Accident:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->show_date_formate($Emp_Data['action_date']); ?></td>
                <td style="width:1%;white-space:nowrap">Department Number:</td>
                <td style="border-bottom:1px solid #000"><?php echo $Work_Data['department_name']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Location of Accident:</td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['accident_location']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Time of Accident:</td>
                <td style="border-bottom:1px solid #000;width:25%"><?php echo $Emp_Data['accident_time']; ?></td>
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
                <td style="width:1%;white-space:nowrap">First Aid given? &nbsp;</td>
                <td style="width:25%;white-space:nowrap;text-align:left">
                    <input type="checkbox" <?php echo ($Emp_Data['first_aid_given'] == 1) ? 'checked' : ''; ?>/> Yes
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" <?php echo ($Emp_Data['first_aid_given'] == 0) ? 'checked' : ''; ?>/> No
                </td>
                <td style="width:1%;white-space:nowrap">By whom? &nbsp;</td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['firstAid_by_whom']; ?></td>
            </tr>
        </table>     
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Hospitalized? &nbsp;</td>
                <td style="width:25%;white-space:nowrap;text-align:left">
                    <input type="checkbox" <?php echo ($Emp_Data['requires_hospitalization'] == 1) ? 'checked' : ''; ?>/> Yes
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" <?php echo ($Emp_Data['requires_hospitalization'] == 0) ? 'checked' : ''; ?>/> No
                </td>
                <td style="width:1%;white-space:nowrap">Physician:</td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['physician_name']; ?></td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Nature and extent of injuries: </td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['nature_of_injury']; ?></td>
            </tr>
        </table>          
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">How did the accident occur? </td>
                <td style="border-bottom:1px solid #000"><?php echo $Emp_Data['how_accident_occured']; ?></td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="white-space:nowrap">What job or activity was being engaged in at time of injury? </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;font-style:italic;text-align:center"><?php echo $Emp_Data['activity_during_injury']; ?></td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Describe any conditions, methods or practices related to the accident: </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000;font-style:italic;text-align:center"><?php echo $Emp_Data['report_description']; ?></td>
            </tr>
        </table>
        <table style="width:100%;margin-top:80px;">
            <tr>
                <td style="width:50%;white-space:nowrap;border-top:1px solid #000;">Employee Signature</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:40%;white-space:nowrap;border-top:1px solid #000;">Date</td>
            </tr>
        </table>
        <table style="width:100%;margin-top:50px;">
            <tr>
                <td style="width:50%;white-space:nowrap;border-top:1px solid #000;">Supervisor Signature</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:40%;white-space:nowrap;border-top:1px solid #000;">Date</td>
            </tr>
        </table>
        <table style="width:100%;margin-top:50px;">
            <tr>
                <td style="width:50%;white-space:nowrap;border-top:1px solid #000;">Department</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:40%;white-space:nowrap;border-top:1px solid #000;">Location</td>
            </tr>
            <tr>
                <td colspan="3">
                    <p style="text-align:justify;font-style:italic">
                        Notice: Manager must complete report and return to the Human Resources Department within 24 hours of the accident.
                    </p>
                </td>
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
                    <td style="white-space:nowrap">Details of Problem/Accident: </td>
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
                    <td style="white-space:nowrap">Date/Time and Location of Accident (if applicable): </td>
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

                            This report should be kept in the supervisor's file to memorialize the details of the accident. 
                            In general, when the record of discipline goes into the employee's personnel file, there is no 
                            need for the supervisor to keep a separate record of the accident, unless there are unusual 
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
        tr td:nth-child(even){font-style:italic;text-align:center}
    </style>

</html>