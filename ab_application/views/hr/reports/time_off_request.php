<!DOCTYPE html>
<html><body>
        <h2 style='margin-top:0;text-align:center'><?php echo $page_header; ?></h2>

        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Name Employee:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Name; ?></td>
                <td style="width:1%;white-space:nowrap">Department:</td>
                <td style="border-bottom:1px solid #000;width:25%"><?php echo $emp_data['dept_name']; ?></td>
            </tr>
        </table> 
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Phone Number and Email Address:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emp_data['mobile_phone'] . ', &nbsp;' . $emp_data['email']; ?></td>
            </tr>
        </table> 
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Employee’s Supervisor:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Supervisor_Name; ?></td>
            </tr>
        </table>       
        <table style="width:100%;">
            <tr>
                <td style="padding-bottom:10px;padding-top:20px">Please Check One of the following:</td>
            </tr>
            <tr>
                <td style="width:1%;white-space:nowrap">
                    <?php
                    if (!empty($unpaid_leave_types)) {
                        foreach ($unpaid_leave_types as $row) {
                            $isChecked = ($row->id == $emp_data['leave_type']) ? 'checked' : '';
                            echo '<input type="checkbox" ' . $isChecked . '/> ' . $row->leave_code . ' <br/>';
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:10%;white-space:nowrap"><input type="checkbox"/> Other:</td>
                <td style="border-bottom:1px solid #000;"></td>
            </tr>
        </table>
        <table style="width:100%;margin-top:30px;">
            <tr>
                <td style="width:1%;white-space:nowrap">Total Number of Days Requested:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emp_data['number_of_days'] . ' (' . ucfirst(number_to_words($emp_data['number_of_days'])) . ')'; ?></td>
                <td style="width:1%;white-space:nowrap">Date Submitted:</td>
                <td style="border-bottom:1px solid #000;"><?php echo date_from_timestamp($emp_data['createddate'], 'm-d-Y'); ?></td>
                <!--$date = date('d-m-Y', $timestamp);
                $time = date('Gi.s', $timestamp);-->
            </tr>
        </table> 
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">First Day of Time-off Date:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->show_date_formate($emp_data['from_date']); ?></td>
                <td style="width:1%;white-space:nowrap">Return to Work Date:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $this->Common_model->show_date_formate($emp_data['to_date']); ?></td>
            </tr>
        </table>
        <table style="width:100%;margin-top:80px;">
            <tr>
                <td style="width:60%;white-space:nowrap;border-top:1px solid #000;">Employee Signature</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:30%;white-space:nowrap;border-top:1px solid #000;">Date</td>
            </tr>
        </table>
        <table style="width:100%;margin-top:50px;">
            <tr>
                <td style="width:60%;white-space:nowrap;border-top:1px solid #000;">Supervisor Signature</td>
                <td style="width:10%">&nbsp;</td>
                <td style="width:30%;white-space:nowrap;border-top:1px solid #000;">Date</td>
            </tr>
        </table>
    </body>

    <style type="text/css">
        tr td:nth-child(even){font-style:italic !important;text-align:center}
    </style>

</html>