<!DOCTYPE html>
<html><body>
        <?php
        if ($Emp_Data['company_id'] == 0) {
            echo "";
        } else {
            $show_in_header = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'show_in_header');

            if ($show_in_header == 0) {
                $company_name = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_full_name');
            } else {
                $company_name = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_short_name');
            }

            $company_logo = $this->Common_model->get_name($this, $Emp_Data['company_id'], 'main_company', 'company_logo');
        }

        $first_name = $this->Common_model->get_selected_value($this, 'employee_id', $Emp_Data['employee_id'], 'main_employees', 'first_name');
        $middle_name = $this->Common_model->get_selected_value($this, 'employee_id', $Emp_Data['employee_id'], 'main_employees', 'middle_name');
        $emp_name = $first_name . " " . $middle_name;
        ?>

        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:48%;text-align:right"><img width="50" src="<?php echo Get_File_Directory('uploads/companylogo/' . $company_logo) ?>" alt="Company Logo" /></td>
                <td style="font-style:normal; font-size:20px; text-align:left;"><?php echo $company_name; ?></td>
            </tr>
        </table>

        <h2 style='margin-top:0;text-align:center'>Medical Attention Refusal</h2>

        <?php
        $bodypart_injurylist = $this->Common_model->get_array('bodypart_injurylist');
        foreach (explode(',', $Emp_Data['injured_body_parts']) as $value) {
            $body_part_arr[] = $bodypart_injurylist[$value];
        }
        $body_parts = implode(', ', $body_part_arr)
        ?>

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:100%">I <u>&nbsp;&nbsp;&nbsp;<?php echo $emp_name; ?>&nbsp;&nbsp;&nbsp;</u> sustained an injury to the following body part/s, <u>&nbsp;&nbsp;&nbsp;<?php echo $body_parts; ?>&nbsp;&nbsp;&nbsp;</u></td>
            </tr>
            <tr>
                <td style="width:100%">on <u>&nbsp;&nbsp;&nbsp;<?php echo $this->Common_model->show_date_formate($Emp_Data['action_date']); ?>&nbsp;&nbsp;&nbsp;</u> . I was offered medical care, but I have refused.</td>
            </tr>
        </table>  

        <table style="width:100%;margin-top:20px">
            <tr>
                <td style="width:1%;white-space:nowrap;text-align:justify"><p style="text-align:justify;margin:0">My signature below documents my refusal of medical attention and acknowledge that I was provided a form</p></td>
            </tr>
            <tr>
                <td style="width:1%;white-space:nowrap;text-align:justify"><p style="text-align:justify;margin:0">DWCI (workers Compensation Claim Form and Notice of Potential Eligibility) by my employer on the date</p></td>
            </tr>
            <tr>
                <td style="width:1%;white-space:nowrap;text-align:justify"><p style="text-align:justify;margin:0">noted.</p></td>
            </tr>
        </table>

        <table style="width:100%;margin-top:25px">
            <tr>
                <td style="width:1%;white-space:nowrap;text-align:justify">Should I need medical attention at a later date I will notify my employer immediately.</td>
            </tr>
            <tr>
                <td><span style="text-align:justify;border-bottom:1px solid #000;padding-bottom:2px;font-style:italic"><?php /* echo $Emp_Data['explain_first_aid']; */ ?></span></td>
            </tr>
        </table>

        <table style="width:100%;margin-top:80px;margin-bottom:50px">
            <tr>
                <td style="width:50%;white-space:nowrap;border-top:1px solid #000;">Printed name</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:40%;white-space:nowrap;border-top:1px solid #000;">Date</td>
            </tr>
        </table>        
        <table style="width:100%;margin-top:80px;margin-bottom:50px">
            <tr>
                <td style="width:50%;white-space:nowrap;border-top:1px solid #000;">Signature</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:40%;white-space:nowrap;"></td>
            </tr>
        </table>
    </body>

    <style type="text/css">
        /*tr td:nth-child(even){font-style:italic !important;text-align:center}*/
    </style>

</html>