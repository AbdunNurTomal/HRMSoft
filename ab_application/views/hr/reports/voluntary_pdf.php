<?php

function get_rating($topic, $rating, $comment) {
    $output = '<table style="width:100%;margin-top:20px">
                <tr>
                    <td colspan="2" style="width:50%;">' . $topic . '</td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 1 </b><input type="checkbox" ' . (($rating == 1) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 2 </b><input type="checkbox" ' . (($rating == 2) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 3 </b><input type="checkbox" ' . (($rating == 3) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 4 </b><input type="checkbox" ' . (($rating == 4) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 5 </b><input type="checkbox" ' . (($rating == 5) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 6 </b><input type="checkbox" ' . (($rating == 6) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 7 </b><input type="checkbox" ' . (($rating == 7) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 8 </b><input type="checkbox" ' . (($rating == 8) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 9 </b><input type="checkbox" ' . (($rating == 9) ? "checked" : "") . '/></span>
                    </td>
                    <td style="width:5%;white-space:nowrap">
                        <span><b> 10 </b><input type="checkbox" ' . (($rating == 10) ? "checked" : "") . '/></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:10%;">
                        Comments:
                    </td>
                    <td colspan="11" style="width:90%;border-bottom:1px solid #000;font-style:italic;">' . $comment . '</td>
                </tr>
            </table>';

    return $output;
}

$reason_for_leaving = json_decode($Exit_Data['reason_for_leaving'], TRUE);
$voluntary_rate = json_decode($Exit_Data['voluntary_rate'], TRUE);

if ($Exit_Data['company_id'] == 0) {
    $company_name = "Company";
} else {
    $company_name = $this->Common_model->get_name($this, $Exit_Data['company_id'], 'main_company', 'company_full_name');
}
?>
<!DOCTYPE html>
<html><body>
        <h2 style='margin-top:0;text-align:center'><?php echo 'Exit Interview Checklist -' . $page_header; ?></h2>

        <div>
            <table style="width:100%;">
                <tr>
                    <td><p>"<?php echo $company_name ?>" would greatly appreciate your assistance in completing this questionnaire. 
                            This information is most helpful as we continually review our employment policies and procedures.</p>

                        <p>Your answers to this questionnaire will not be included in your permanent personnel record file, 
                            nor will they affect your re-employment possibilities with <?php echo $company_name ?>, should you desire to 
                            seek re-employment.</p>
                    </td>
                </tr>
            </table>       
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Name (optional):</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->employee_name($Exit_Data['employee_id']); ?></td>
                </tr>
            </table>       
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Resignation Date:</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->show_date_formate($Exit_Data['resign_date']); ?></td>
                    <td style="width:1%;white-space:nowrap">Hire Date:</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->show_date_formate($Exit_Data['hire_date']); ?></td>
                </tr>
            </table>       
            <table style="width:100%;">
                <tr>
                    <td style="width:1%;white-space:nowrap">Job Title:</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $Exit_Data['job_title'] ?> Year(s)</td>
                    <td style="width:1%;white-space:nowrap">Location:</td>
                    <td style="border-bottom:1px solid #000;"><?php echo $Exit_Data['location']; ?></td>
                </tr>
            </table>
        </div>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td colspan="2"><i>REASON(S) FOR LEAVING (mark as many as apply):</i></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:95%;white-space:nowrap;text-align:left !important">
                    <p><input type="checkbox" <?php echo (array_key_exists(1, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Obtained a new job</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(2, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Dissatisfied with pay</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(3, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Moving from area</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(4, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Family circumstances</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(5, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Health reasons</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(6, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Dissatisfied with type of work</p>
                    <p><input type="checkbox" <?php echo (array_key_exists(7, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Dissatisfied with supervisor</p>
                    <p>
                        <input type="checkbox" <?php echo (array_key_exists(0, $reason_for_leaving)) ? 'checked' : ''; ?>/>&nbsp;&nbsp; Other (please explain):
                        <i style="display:inline-block;border-bottom:1px solid #000;padding-left:25px;padding-right:25px"><?php echo empty($reason_for_leaving['other_leaving_reason']) ? " " : $reason_for_leaving['other_leaving_reason']; ?></i>
                    </p>
                </td>
            </tr>
        </table>

        <?php
        echo get_rating('Training for Employees', $voluntary_rate['training_for_employees']['rating'], $voluntary_rate['training_for_employees']['comments']);

        echo get_rating('Employee Benefits', $voluntary_rate['employee_benefits']['rating'], $voluntary_rate['employee_benefits']['comments']);

        echo get_rating('Career Advancement Opportunities', $voluntary_rate['career_advancement']['rating'], $voluntary_rate['career_advancement']['comments']);

        echo get_rating('Management and Supervision', $voluntary_rate['management_and_supervision']['rating'], $voluntary_rate['management_and_supervision']['comments']);

        echo get_rating('General Working Condition’s', $voluntary_rate['general_working']['rating'], $voluntary_rate['general_working']['comments']);

        echo get_rating('Compensation', $voluntary_rate['compensation']['rating'], $voluntary_rate['compensation']['comments']);

        echo get_rating('Nature and Type of Your Work', $voluntary_rate['nature_and_type_of_work']['rating'], $voluntary_rate['nature_and_type_of_work']['comments']);

        echo get_rating('Job Met Your Expectations', $voluntary_rate['job_met_expectations']['rating'], $voluntary_rate['job_met_expectations']['comments']);

        echo get_rating('Quality of Company\'s Service to Customers or Clients', $voluntary_rate['quality_of_company']['rating'], $voluntary_rate['quality_of_company']['comments']);

        echo get_rating('Company\'s Commitment to Its Employees and Their Welfare', $voluntary_rate['company_commitment']['rating'], $voluntary_rate['company_commitment']['comments']);
        ?>        

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap">Please provide any additional information you feel could make a difference in our policies and practices: </td>
            </tr>
            <tr>
                <td><span style="text-align:justify;font-style:italic;display:inline-block;border-bottom:1px solid #000;padding-left:25px;padding-right:25px"><?php echo $Exit_Data['additional_info']; ?></span></td>
            </tr>
        </table>  

    </body>

    <style type="text/css">
        div table tr td:nth-child(even){font-style:italic !important;text-align:center}
        td span b{display:block;margin-left:3px !important}
    </style>
    </html>