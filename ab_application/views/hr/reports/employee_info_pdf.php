<!DOCTYPE html>
<html><body>
        <h2 style='margin-top:0;text-align:center'>Basic Employment Information Sheet</h2>

        <h3>Employee Information</h3>

        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Full Name:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Emp_Name; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Address:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emp_data['first_address']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Home Phone:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emp_data['home_phone']; ?></td>
                <td style="width:1%;white-space:nowrap">Cell Phone:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emp_data['mobile_phone']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Email Address:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emp_data['email']; ?></td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Social Security Number or Government ID:</td>
                <td style="border-bottom:1px solid #000"><?php //echo $emp_data['ssn_code']; 
                  $ssn_code = $this->Common_model->decrypt($emp_data['ssn_code']); 
                  echo "XXX-XX-". substr($ssn_code, -4);?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Birth Date:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emp_data['birthdate']; ?></td>
                <td style="width:1%;white-space:nowrap">Marital Status:</td>
                <td style="border-bottom:1px solid #000"><?php echo ($emp_data['marital_status'] == 1) ? "Married" : "Unmarried"; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Spouse’s Name:</td>
                <td style="border-bottom:1px solid #000"></td>
            </tr>
        </table>
        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:1%;white-space:nowrap">Spouse’s Employer:</td>
                <td style="border-bottom:1px solid #000;width:35%"></td>
                <td style="width:1%;white-space:nowrap">Spouse’s Work Phone:</td>
                <td style="border-bottom:1px solid #000">&nbsp;</td>
            </tr>
        </table>        

        <!-----------Employee Information (ENDS)------------->

        <h3>Job Information</h3>

        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Title:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emp_data['positionname']; ?></td>
                <td style="width:1%;white-space:nowrap">Supervisor:</td>
                <td style="border-bottom:1px solid #000"><?php echo $Supervisor_Name; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Work Location:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Work_Location; ?></td>
                <td style="width:1%;white-space:nowrap">E-mail Address:</td>
                <td style="border-bottom:1px solid #000"><?php echo $Work_Email; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Work Phone:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $Work_Contact; ?></td>
                <td style="width:1%;white-space:nowrap">Cell Phone:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emp_data['mobile_phone']; ?></td>
            </tr>
        </table>
        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:1%;white-space:nowrap;">Start Date:</td>
                <td style="border-bottom:1px solid #000;width:20%"><?php echo $Started_On; ?></td>
                <td style="width:1%;white-space:nowrap">Salary:</td>
                <td style="border-bottom:1px solid #000">&nbsp;</td>
            </tr>
        </table>

        <!-------------Job Information (ENDS)------------->        

        <h3>Emergency Contact Information</h3>

        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Full Name:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emergency['first_name'] . ' ' . $emergency['last_name']; ?></td>
            </tr>
        </table>        
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Address:</td>
                <td style="border-bottom:1px solid #000"><?php echo $emergency['first_address']; ?></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:1%;white-space:nowrap">Primary Phone:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emergency['phone']; ?></td>
                <td style="width:1%;white-space:nowrap">Cell Phone:</td>
                <td style="border-bottom:1px solid #000;"><?php echo $emergency['mobile']; ?></td>
            </tr>
        </table>        
        <table style="width:100%;margin-bottom:30px">
            <tr>
                <td style="width:1%;white-space:nowrap">Relationship:</td>
                <td style="border-bottom:1px solid #000"><?php echo $this->Common_model->get_name($this, $emergency['relationship'], 'main_relationship_status', 'relationship_status'); ?></td>
            </tr>
        </table>

        <!---------Emergency Contact Information (ENDS)--------->        

        <h3>Dependent Information (For insurance purposes only)</h3>        

        <table style="width:100%;">
            <tr>
                <td style="width:35%;white-space:nowrap;padding-bottom:10px;">Name(s) of Dependent(s):</td>
                <td>&nbsp;</td>
                <td style="width:35%;white-space:nowrap">Relationship to Employee:</td>
                <td>&nbsp;</td>
            </tr>
            <?php
            for ($index = 0; $index < 3; $index++) {
                $dependent_name = $rltn_name = "&nbsp;";
                if (array_key_exists($index, $dependent)) {
                    $dependent_name = $dependent[$index]['fast_name'] . ' ' . $dependent[$index]['middle_name'] . ' ' . $dependent[$index]['last_name'];
                    $rltn_name = $dependent[$index]['relationship_status'];
                }
                ?>
                <tr>
                    <td style="border-bottom:1px solid #000;padding-top:10px"><?php echo $dependent_name; ?></td>
                    <td>&nbsp;</td>
                    <td style="border-bottom:1px solid #000;padding-top:10px"><?php echo $rltn_name; ?></td>
                    <td>&nbsp;</td>
                </tr>
            <?php } ?>
        </table>
        <table style="width:100%;">
            <tr>
                <td colspan="4">
                    <p style="text-align:justify;">A number of jurisdictions now allow domestic partners to register and they are 
                        then entitled to many of the benefits of spouses. If your jurisdiction permits 
                        such domestic partnerships, you may modify the form to read "Spouse/Domestic 
                        Partner." Given the proliferation of domestic partnerships, your company should 
                        carefully evaluate its policy with regard to such couples, both opposite-sex and same-sex.
                    </p>
                </td>
            </tr>
        </table>

        <!---------Dependent Information (For insurance purposes only)(ENDS)--------->
    </body>

    <style type="text/css">
        tr td:nth-child(even){font-style:italic !important;text-align:center !important}
    </style>

</html>