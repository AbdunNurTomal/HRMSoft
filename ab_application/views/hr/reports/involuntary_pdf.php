<?php
$reason_for_termination = json_decode($Exit_Data['reason_for_termination'], TRUE);
$recomm_for_discharge = json_decode($Exit_Data['recomm_for_discharge'], TRUE);
$interview_procedure = json_decode($Exit_Data['interview_procedure'], TRUE);
?>
<!DOCTYPE html>
<html><body>
        <h2 style='margin-top:0;text-align:center'><?php echo 'Exit Interview Checklist -' . $page_header; ?></h2>
        
        
        <div>
            <table style="width:100%;margin-top:30px">
                <tr>
                    <td style="width:1%;white-space:nowrap">Employee Name:</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->employee_name($Exit_Data['employee_id']); ?></td>
                </tr>
            </table>       
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Position and Department:</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $Exit_Data['position_and_dept'] ?> Year(s)</td>
                </tr>
            </table>
        </div>

        
        <table style="width:100%;margin-top:30px">
            <tr>
                <td colspan="2"><b>Reason(s) for Termination:</b></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:95%;white-space:nowrap;text-align:left !important">
                    <p><input type="checkbox" <?php echo (array_key_exists(1, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Layoff</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(2, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Substandard performance</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(3, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Continued poor attendance</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(4, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Insubordination</p>
                    <p>
                        <input type="checkbox" <?php echo (array_key_exists(5, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Violation of policy:
                        <i style="display:inline-block;border-bottom:1px solid #000;padding-left:25px;padding-right:25px"><?php echo empty($reason_for_termination['violation_of_policy']) ? " " : $reason_for_termination['violation_of_policy']; ?></i>
                    </p>
                    <p><input type="checkbox" <?php echo (array_key_exists(6, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Position eliminated</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(7, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Temporary or seasonal position</p>
                    <p>
                        <input type="checkbox" <?php echo (array_key_exists(0, $reason_for_termination)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Other (please explain):
                        <i style="display:inline-block;border-bottom:1px solid #000;padding-left:25px;padding-right:25px"><?php echo empty($reason_for_termination['other_termination_reason']) ? " " : $reason_for_termination['other_termination_reason']; ?></i>
                    </p>
                </td>
            </tr>
        </table>

        
        <table style="width:100%;margin-top:30px;page-break-after:always;">
            <tr>
                <td colspan="2"><b>Recommendation for Discharge</b></td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(1, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>All normal steps of progressive discipline have been completed, and there is no realistic hope for improvement.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(2, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Employee has been repeatedly counseled and assisted regarding performance deficiencies, but there is no realistic hope for improvement.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(3, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>All alternatives such as transfer and retraining have been considered.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(4, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>The employee’s infractions and all above steps have been fully documented and records included with the recommendation for discharge.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(5, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Recommendation for discharge and all supporting documents have been placed in the employee’s personnel file.</p>
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px;">
            <tr>
                <td colspan="2"><b>Interview Procedure</b></td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(1, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Recap the application of progressive discipline.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(2, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>If the employee requests a witness or support person, you may have to allow it. Consult with a knowledgeable employment law attorney to determine the requirements under current law, as the law in this area has shifted several times in recent years.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(3, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>State the specific reasons for the discharge.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(4, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>If the employee raises a question about finality, emphasize that the decision is final unless company policy and procedure provides for some appeal.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(5, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>If the tenor of the interview allows it, solicit employee feedback on issues of interest to the employer.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(6, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Arrange to obtain company property in the possession of the employee.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(7, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Provide the employee his or her final paycheck if required by state law, or explain when he or she will receive the last paycheck. Also advise whether the employee will receive accrued vacation pay, and details of any other compensation or benefits that he or she will receive.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(8, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Advise the employee of COBRA or other options for continuing health coverage.</p>
                </td>
            </tr>
            <tr>
                <td style="width:3%;white-space:nowrap;"><input type="checkbox" <?php echo (array_key_exists(9, $reason_for_termination)) ? 'checked' : ''; ?>/></td>
                <td style="width:97%; text-align:justify !important">
                    <p>Conclude the interview as quickly as possible.</p>
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td colspan="3">
                    <p><b>Approval</b></p>
                    <p>I certify that all requirements of Company policy have been met, and that all necessary documents are on file.</p>
                </td>
            </tr>
            <tr>
                <td style="width:60%;border-bottom:1px solid #000"><br/><br/><br/>&nbsp;</td>
                <td style="width:5%;">&nbsp;</td>
                <td style="width:35%;border-bottom:1px solid #000"><br/><br/><br/>&nbsp;</td>
            </tr>
            <tr>
                <td style="width:60%">Director of Human Resources</td>
                <td style="width:5%">&nbsp;</td>
                <td style="width:35%">Date</td>
            </tr>
        </table>

    </body>

    <style type="text/css">
        div table tr td:nth-child(even){font-style:italic !important;text-align:center}
        td span b{display:block;margin-left:3px !important}
    </style>
    <?php //print_r("Called"); exit; ?>
</html>