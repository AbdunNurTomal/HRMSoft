<!DOCTYPE html>
<html><body>
        <h2 style='margin-top:0;text-align:center'>Accident Investigation Report (Confidential)</h2>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">Injured Employee:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->employee_name($Emp_Data['employee_id']); ?></td>
                <td style="width:1%;white-space:nowrap">Date of Report:</td>
                <td style="border-bottom:1px solid #000;">
                    <?php
                    if ($Emp_Data['supervisor_report_date'] != '') {
                        $report_date = $Emp_Data['supervisor_report_date'];
                    } else if ($Emp_Data['hr_report_date'] != '') {
                        $report_date = $Emp_Data['hr_report_date'];
                    } else {
                        $report_date = $Emp_Data['action_date'];
                    }
                    echo $this->Common_model->show_date_formate($report_date);
                    ?>
                </td>
            </tr>
        </table>       
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Job Title:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emp_data['positionname']; ?></td>
                <td style="width:1%;white-space:nowrap">Dept.:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Work_Data['department_name']; ?></td>
                <td style="width:1%;white-space:nowrap">Age:</td>
                <td style="border-bottom:1px solid #000;"><?php echo date_diff_calculate($emp_data['birthdate'])->y ?> Year(s)</td>
                <td style="width:1%;white-space:nowrap">Sex:</td>
                <td style="border-bottom:1px solid #000;"><?php echo ($emp_data['gender'] == 1) ? 'Male' : 'Female'; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Length of Employment:</td>
                <td style="border-bottom:1px solid #000;">
                    <?php
                    $employment = date_diff_calculate($emp_data['hire_date']);
                    echo $employment->y . ' year(s) ' . $employment->m . ' month(s)'
                    ?>
                </td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Date and Time of Accident:</td>
                <td style="border-bottom:1px solid #000;">
                    <?php echo $this->Common_model->show_date_formate($Emp_Data['action_date']); ?>
                    <?php echo ', ' . $Emp_Data['accident_time']; ?>
                </td>
                <td style="width:1%;white-space:nowrap">Location:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Data['accident_location']; ?></td>
            </tr>
        </table>               
        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:100%">Describe what employee was doing; what tools, equipment, structures, or fixtures were involved; and which witnesses saw it and what they reported:</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php echo $Emp_Data['detail_description']; ?></span></td>
            </tr>
        </table>                 
        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">Extent of Injuries:</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php echo $Emp_Data['nature_of_injury']; ?></span></td>
            </tr>
        </table>
        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">Was first aid given immediately? &nbsp;</td>
                <td style="white-space:nowrap;text-align:left !important">
                    <input type="checkbox" <?php echo ($Emp_Data['first_aid_given'] == 1) ? 'checked' : ''; ?>/> Yes
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" <?php echo ($Emp_Data['first_aid_given'] == 0) ? 'checked' : ''; ?>/> No
                </td>
            </tr>
        </table>                         
        <table style="width:100%;margin-top:5px">
            <tr>
                <td style="width:1%;white-space:nowrap">Explain:</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php echo $Emp_Data['explain_first_aid']; ?></span></td>
            </tr>
        </table>                 
        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">Explain accident causes, especially if there were past problems:</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php echo $Emp_Data['explain_accident_causes']; ?></span></td>
            </tr>
        </table>                 
        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">What should be done, and by whom, to prevent recurrence of this type of accident in the future?</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php echo $Emp_Data['measures_in_future']; ?></span></td>
            </tr>
        </table> 
        <table style="width:100%;margin-top:80px;margin-bottom:50px">
            <tr>
                <td style="width:50%;white-space:nowrap;border-top:1px solid #000;">Supervisor’s Signature</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:40%;white-space:nowrap;border-top:1px solid #000;">Date</td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Comments by Department and/or Safety Manager:</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php echo $Emp_Data['comments_by_dept']; ?></span></td>
            </tr>
        </table>

    </body>

    <style type="text/css">
        tr td:nth-child(even){font-style:italic !important;text-align:center}
    </style>

</html>