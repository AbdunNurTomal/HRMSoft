<?php

//pr($i9_data);

function img_root($PATH = '') {
//echo site_url($PATH);
    return Get_File_Directory($PATH);
}
?>
<!DOCTYPE html>
<html><body>
        <table style="width:100%;border-bottom:10px solid #000">
            <td style="width:20%">
                <img style="width:90px;height:90px" src="<?php echo img_root('uploads/us-i9-logo.png'); ?>" alt="Logo"/>
            </td>
            <td style="text-align:center">
                <h1 style="margin-top:0;margin-bottom:10px">Employment Eligibility Verification</h1>
                <span style="font-size:18px"><b>Department of Homeland Security</b><br/>
                    U.S. Citizenship and Immigration Services</span>
            </td>
            <td style="width:20%;text-align:center">
                <h2 style="margin:0">USCIS<br/>Form I-9</h2>                
                <span style="font-size:18px">OMB No. 1615-0047<br/>
                    Expires 03/31/2016</span>
            </td>
        </table>

        <table style="width:100%;margin-top:3px;border-top:1px solid #000">
            <tr>
                <td>
                    ►START HERE. Read instructions carefully before completing this form. The instructions must be available during 
                    completion of this form. ANTI-DISCRIMINATION NOTICE: It is illegal to discriminate against work-authorized 
                    individuals. Employers CANNOT specify which document(s) they will accept from an employee. The refusal to 
                    hire an individual because the documentation presented has a future expiration date may also constitute illegal discrimination.
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:3px;border:1px solid #000;background:lightgrey">
            <tr>
                <td>
                    <span style="font-size:16px"><b>Section 1. Employee Information and Attestation</b></span> (Employees must complete and sign Section 1 of Form I-9 no later than the first day of employment, but not before accepting a job offer.)
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td>
                    Last Name <i>(Family Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['last_name']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td>
                    First Name <i>(Given Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['fast_name']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:15%;border-right:1px solid #000">
                    Middle Initial
                    <br/><input type="text" value="<?php echo $i9_data['middle_initial']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td>
                    Other Names Used <i>(if any)</i>
                    <br/><input type="text" value="<?php echo $i9_data['other_name']; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td style="border-right:1px solid #000">
                    Address <i>(Street Number and Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['address']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:15%;border-right:1px solid #000">
                    Apt. Number
                    <br/><input type="text" value="<?php echo $i9_data['apt_number']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:25%;border-right:1px solid #000">
                    City or Town
                    <br/><input type="text" value="<?php echo $i9_data['city_town']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:10%;border-right:1px solid #000">
                    State
                    <br/><input type="text" value="<?php echo $this->Common_model->get_name($this, $i9_data['state'], 'main_state', 'state_abbr'); ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:15%">
                    Zip Code
                    <br/><input type="text" value="<?php echo $i9_data['zip_code']; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td style="width:20%;border-right:1px solid #000">
                    Date of Birth <i>(mm/dd/yyyy)</i>
                    <br/><input type="text" value="<?php echo $i9_data['date_of_birth']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:20%;border-right:1px solid #000">
                    U.S. Social Security Number
                    <br/><input type="text" value="<?php echo $i9_data['us_ssn']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="border-right:1px solid #000">
                    E-mail Address
                    <br/><input type="text" value="<?php echo $i9_data['email_address']; ?>" style="width:90%;border:none;padding:5px" />    
                </td>
                <td style="width:20%">
                    Telephone Number
                    <br/><input type="text" value="<?php echo $i9_data['telephone_number']; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="font-weight:bold">
                    I am aware that federal law provides for imprisonment and/or fines for false statements or use 
                    of false documents in connection with the completion of this form.
                    <br/><br/>I attest, under penalty of perjury, that I am (check one of the following):
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury1'] == 1) ? 'checked' : ''; ?> /> &nbsp; A citizen of the United States
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury2'] == 1) ? 'checked' : ''; ?> /> &nbsp; A noncitizen national of the United States <i>(See instructions)</i>
                </td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury3'] == 1) ? 'checked' : ''; ?> /> &nbsp; A lawful permanent resident 
                    (Alien Registration Number/USCIS Number):
                </td>
                <td style="width:25%;border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['lawful_permanent_resident']; ?></td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td style="width:1%;white-space:nowrap">
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury5'] == 1) ? 'checked' : ''; ?> /> &nbsp; An alien authorized to work 
                    until (expiration date, if applicable, mm/dd/yyyy) 
                </td>
                <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['expiration_date']; ?></td>
                <td style="width:1%;white-space:nowrap">. Some aliens may write "N/A" in this field. <i>(See instructions)</i></td>
            </tr>
            <tr>
                <td colspan="3">
                    <br/><i>For aliens authorized to work, provide your Alien Registration Number/USCIS Number OR Form I-94 Admission Number:</i>
                </td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td>
                    <table style="width:100%">
                        <tr>
                            <td style="width:1%;white-space:nowrap"><b>1.</b> Alien Registration Number/USCIS Number: </td>
                            <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['alien_registration_number']; ?></td>
                            <td style="width:25%">&nbsp;</td>
                        </tr>
                    </table>
                    <table style="width:100%">
                        <tr>
                            <td style="width:25%"></td>
                            <td style="font-size:22px;font-weight:bold">OR</td>
                        </tr>
                    </table>
                    <table style="width:100%">
                        <tr>
                            <td style="width:1%;white-space:nowrap"><b>2.</b> Form I-94 Admission Number: </td>
                            <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['admission_number']; ?></td>
                            <td style="width:25%">&nbsp;</td>
                        </tr>
                    </table>
                    <table style="width:100%">
                        <tr>
                            <td colspan="2">
                                If you obtained your admission number from CBP in connection with your arrival in the United States, include the following:
                            </td>
                        </tr>
                        <tr>
                            <td style="width:1%;white-space:nowrap">Foreign Passport Number: </td>
                            <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['foreign_passport_number']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:1%;white-space:nowrap">Country of Issuance:</td>
                            <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['country_of_issuance']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Some aliens may write "N/A" on the Foreign Passport Number and Country of Issuance fields. <i>(See instructions)</i>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="width:3%">  &nbsp; </td>

                <td style="width:22%;text-align:right">
                    <table style="width:100%;height:120px;padding-top:10px;border:1px solid #000">
                        <tr>
                            <td style="text-align:center;font-weight:bold;vertical-align:top">
                                3-D Barcode<br/>
                                Do Not Write in This Space<br/><br/>
                                <?php $SRV_PATH = img_root('assets/barcode/' . $BarcodeName); ?>
                                <img src="<?php echo $SRV_PATH; ?>" alt="Barcode"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000">
            <tr>
                <td style="width:1%;white-space:nowrap">Signature of Employee:</td>
                <td> &nbsp; </td>
                <td style="width:1%;white-space:nowrap;border-left:1px solid #000;padding:10px;">Date (mm/dd/yyyy):</td>
                <td style="width:20%"><input type="text" value="<?php echo ''; ?>" style="width:85%;border:none;padding:5px"/></td>
            </tr>
        </table> 

        <table style="width:100%;margin-top:15px;border:1px solid #000;background:lightgrey">
            <tr>
                <td>
                    <span style="font-size:16px"><b>Preparer and/or Translator Certification</b> (To be completed and signed if Section 1 is prepared by a person other than the employee.)</span>
                </td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="font-weight:bold">
                    I attest, under penalty of perjury, that I have assisted in the completion of this form and that to the best of my knowledge the information is true and correct.
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000">
            <tr>
                <td>
                    Signature of Preparer or Translator:
                    <br/><input type="text" value="<?php echo ''; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:20%;border-left:1px solid #000">
                    Date <i>(mm/dd/yyyy):</i>
                    <br/><input type="text" value="<?php echo ''; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td>
                    Last Name <i>(Family Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['con_last_name']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:40%">
                    Last Name <i>(Family Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['con_first_name']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td>
                    Address <i>(Street Number and Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['con_address']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:30%;border-left:1px solid #000">
                    City or Town
                    <br/><input type="text" value="<?php echo $i9_data['con_city']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:10%;border-left:1px solid #000">
                    State
                    <br/><input type="text" value="<?php echo $this->Common_model->get_name($this, $i9_data['con_state'], 'main_state', 'state_name'); ?>" style="width:90%;border:none;padding:5px" />
                </td>
                <td style="width:20%;border-left:1px solid #000">
                    Zip Code
                    <br/><input type="text" value="<?php echo $i9_data['con_zip_code']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:15px;margin-bottom:10px">
            <td style="text-align:right">
                <img style="width:40px;height:40px" src="<?php echo img_root('uploads/stop-sign.png'); ?>" alt="Stop Sign"/>
            </td>
            <td style="width:1%;white-space:nowrap;padding:5px 20px;background:lightgrey;font-size:22px;font-style:italic">
                Employer Completes Next Page
            </td>
            <td>
                <img style="width:40px;height:40px" src="<?php echo img_root('uploads/stop-sign.png'); ?>" alt="Stop Sign"/>
            </td>
        </table>

        <table style="width:100%;border-top:3px solid #000">
            <tr>
                <td>Form I-9 &nbsp; 03/08/13 N</td>    
                <td style="width:50%;text-align:right;padding-top:10px">Page 1</td>    
            </tr>
        </table>
    </body>

    <head></head>
    <body>
        <table style="width:100%">
            <tr>
                <td style="border-top:10px solid #000;padding:2px 0;border-bottom:2px solid #000"></td>
            </tr>
            <tr>
                <td style="border:1px solid #000;background:lightgrey">
                    <h3 style="margin:0">Section 2. Employer or Authorized Representative Review and Verification</h3>
                    <i>(Employers or their authorized representative must complete and sign Section 2 
                        within 3 business days of the employee's first day of employment. You must physically 
                        examine one document from List A OR examine a combination of one document from List 
                        B and one document from List C as listed on the "Lists of Acceptable Documents" on 
                        the next page of this form. For each document you review, record the following 
                        information: document title, issuing authority, document number, and expiration date, if any.)</i>
                </td>
            </tr>
        </table>

        <table style="width:100%;padding:5px;border:1px solid #000;margin-top:10px">
            <tr>
                <td style="width:1%;white-space:nowrap;font-weight:bold">Employee Last Name, First Name and Middle Initial from Section 1:</td>
                <td><?php echo $i9_data['employer_name']; ?></td>
            </tr>
        </table>

        <table style="width:100%;font-weight:bold">
            <tr>
                <td style="width:33%;text-align:center">List A<br/>Identity and Employment Authorization</td>
                <td style="width:1%;white-space:nowrap">OR</td>
                <td style="width:32%;text-align:center">List B<br/>Identity</td>
                <td style="width:1%;white-space:nowrap">AND</td>
                <td style="width:32%;text-align:center">List C<br/>Employment Authorization</td>
            </tr>
        </table>

        <table style="width:100%;font-weight:bold">
            <tr>
                <td style="width:33%;">
                    <table style="width:100%;border:1px solid #000;border-bottom:none !important">
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Title:<br/><input type="text" value="<?php echo $i9_data['employer_document_title_a']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr> 
                        <tr>
                            <td style="border-bottom:1px solid #000;">Issuing Authority:<br/><input type="text" value="<?php echo $i9_data['employer_issuing_authority_a']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Number:<br/><input type="text" value="<?php echo $i9_data['employer_document_number_a']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td>Expiration Date (if any)(mm/dd/yyyy):<br/><input type="text" value="<?php echo $i9_data['employer_expiration_date_a']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>
                    </table>
                </td>
                <td style="width:1%;padding:0;background:lightgray">&nbsp;</td>
                <td style="width:32%">
                    <table style="width:100%;border:1px solid #000;border-right:none !important">
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Title:<br/><input type="text" value="<?php echo $i9_data['employer_document_title_b']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr> 
                        <tr>
                            <td style="border-bottom:1px solid #000;">Issuing Authority:<br/><input type="text" value="<?php echo $i9_data['employer_issuing_authority_b']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Number:<br/><input type="text" value="<?php echo $i9_data['employer_document_number_b']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td>Expiration Date (if any)(mm/dd/yyyy):<br/><input type="text" value="<?php echo $i9_data['employer_expiration_date_b']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>
                    </table>
                </td>
                <td style="width:1%">&nbsp;</td>
                <td style="width:32%">
                    <table style="width:100%;border:1px solid #000;border-left:none !important">
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Title:<br/><input type="text" value="<?php echo $i9_data['employer_document_title_c']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr> 
                        <tr>
                            <td style="border-bottom:1px solid #000;">Issuing Authority:<br/><input type="text" value="<?php echo $i9_data['employer_issuing_authority_c']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Number:<br/><input type="text" value="<?php echo $i9_data['employer_document_number_c']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td>Expiration Date (if any)(mm/dd/yyyy):<br/><input type="text" value="<?php echo $i9_data['employer_expiration_date_c']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="width:33%;">
                    <table style="width:100%;border:1px solid #000;border-top:3px solid #000 !important;border-bottom:none !important">
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Title:<br/><input type="text" value="<?php echo $i9_data['employer_document_title_a1']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr> 
                        <tr>
                            <td style="border-bottom:1px solid #000;">Issuing Authority:<br/><input type="text" value="<?php echo $i9_data['employer_issuing_authority_a1']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Number:<br/><input type="text" value="<?php echo $i9_data['employer_document_number_a1']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td>Expiration Date (if any)(mm/dd/yyyy):<br/><input type="text" value="<?php echo $i9_data['employer_expiration_date_a1']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>
                    </table>
                </td>
                <td style="width:1%;padding:0;background:lightgray">&nbsp;</td>
                <td style="width:32%;text-align:center">
                    &nbsp;
                </td>
                <td style="width:1%">&nbsp;</td>
                <td rowspan="2" style="width:32%;text-align:right">
                    <!-----------------Barcode (in Second Page)------------------>
                    <table style="width:90%;height:120px;margin-left:9%;padding-top:10px;border:1px solid #000">
                        <tr>
                            <td style="text-align:center;font-weight:bold;vertical-align:top">
                                3-D Barcode<br/>
                                Do Not Write in This Space<br/><br/>
                                <?php $SRV_PATH = img_root('assets/barcode/' . $BarcodeName); ?>
                                <img src="<?php echo $SRV_PATH; ?>" alt="Barcode"/>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td style="width:33%;">
                    <table style="width:100%;border:1px solid #000;border-top:3px solid #000 !important">
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Title:<br/><input type="text" value="<?php echo $i9_data['employer_document_title_a2']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr> 
                        <tr>
                            <td style="border-bottom:1px solid #000;">Issuing Authority:<br/><input type="text" value="<?php echo $i9_data['employer_issuing_authority_a2']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td style="border-bottom:1px solid #000;">Document Number:<br/><input type="text" value="<?php echo $i9_data['employer_document_number_a2']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>    
                        <tr>
                            <td>Expiration Date (if any)(mm/dd/yyyy):<br/><input type="text" value="<?php echo $i9_data['employer_expiration_date_a2']; ?>" style="width:85%;border:none;padding:5px" /></td>
                        </tr>
                    </table>
                </td>
                <td style="width:1%;padding:0;background:lightgray">&nbsp;</td>
                <td style="width:32%;text-align:center">
                    &nbsp;
                </td>
                <td style="width:1%">&nbsp;</td>
            </tr>
        </table>

        <table style="width:100%;font-weight:bold;font-size:16px">
            <tr>
                <td>
                    <span style="font-size:1.3em">Certification</span><br/>
                    I attest, under penalty of perjury, that (1) I have examined the document(s) presented by the above-named employee, (2) the above-listed document(s) appear to be genuine and to relate to the employee named, and (3) to the best of my knowledge the employee is authorized to work in the United States.
                </td>
            </tr>
        </table>

        <table style="width:100%;font-weight:bold;font-size:18px">
            <tr>
                <td style="width:1%;white-space:nowrap">The employee's first day of employment <i>(mm/dd/yyyy)</i>:</td>
                <td style="width:15%;border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['employer_certification_date']; ?></td>                
                <td><i>(See instructions for exemptions.)</i></td>                
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;margin-top:10px">
            <tr>
                <td>
                    Signature of Employer or Authorized Representative
                    <br/><input type="text" value="<?php echo ''; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:15%;border-left:1px solid #000">
                    Date <i>(mm/dd/yyyy)</i>
                    <br/><input type="text" value="<?php echo $i9_data['employer_certification_date']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:40%;border-left:1px solid #000">
                    Title of Employer or Authorized Representative
                    <br/><input type="text" value="<?php echo ''; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td style="width:35%;">
                    Last Name <i>(Family Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['employer_last_name']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:15%;border-left:1px solid #000">
                    First Name <i>(Given Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['employer_first_name']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:40%;border-left:1px solid #000">
                    Employer's Business or Organization Name
                    <br/><input type="text" value="<?php echo $i9_data['middle_initial']; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;border-top:none !important">
            <tr>
                <td style="border-right:1px solid #000">
                    Employer's Business or Organization Address <i>(Street Number and Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['employer_address']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:25%;border-right:1px solid #000">
                    City or Town
                    <br/><input type="text" value="<?php echo $i9_data['employer_city']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:10%;border-right:1px solid #000">
                    State
                    <br/><input type="text" value="<?php echo $this->Common_model->get_name($this, $i9_data['employer_state'], 'main_state', 'state_abbr'); ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:15%">
                    Zip Code
                    <br/><input type="text" value="<?php echo $i9_data['employer_zip_code']; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;margin-top:10px">
            <tr>
                <td colspan="4" style="font-weight:bold;font-size:18px;border-bottom:1px solid #000;background:lightgray"><span style="font-size:22px">Section 3. Reverification and Rehires</span> (To be completed and signed by employer or authorized representative.)</td>
            </tr>
            <tr>
                <td style="border-right:1px solid #000">
                    A. New Name <i>(if applicable)</i> Last Name <i>(Family Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['rehire_last_name']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:25%;border-right:1px solid #000">
                    First Name <i>(Given Name)</i>
                    <br/><input type="text" value="<?php echo $i9_data['rehire_first_name']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:10%;border-right:1px solid #000">
                    Middle Initial
                    <br/><input type="text" value="<?php echo $i9_data['rehire_middle_initial']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
                <td style="width:1%;white-space:nowrap">
                    B. Date of Rehire <i>(if applicable) (mm/dd/yyyy)</i>:
                    <br/><input type="text" value="<?php echo $i9_data['rehire_date']; ?>" style="width:85%;border:none;padding:5px" /> 
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;margin-top:10px">
            <tr>
                <td colspan="3" style="border-bottom:1px solid #000;">
                    C. If employee's previous grant of employment authorization has expired, provide the information for the document from List A or List C the employee presented that establishes current employment authorization in the space provided below.
                </td>
            </tr>
            <tr>
                <td style="border-right:1px solid #000">
                    Document Title:
                    <br/><input type="text" value="<?php echo $i9_data['rehire_document_title']; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:35%;border-right:1px solid #000">
                    Document Number:
                    <br/><input type="text" value="<?php echo $i9_data['rehire_document_number']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:30%;border-right:1px solid #000">
                    Expiration Date <i>(if any)(mm/dd/yyyy)</i>:
                    <br/><input type="text" value="<?php echo $i9_data['rehire_expiration_date']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
            </tr>
        </table>

        <table style="width:100%;border:1px solid #000;margin-top:10px">
            <tr>
                <td colspan="3" style="border-bottom:1px solid #000;">
                    I attest, under penalty of perjury, that to the best of my knowledge, this employee is authorized to work in the United States, and if the employee presented document(s), the document(s) I have examined appear to be genuine and to relate to the individual.
                </td>
            </tr>
            <tr>
                <td style="border-right:1px solid #000">
                    Signature of Employer or Authorized Representative:
                    <br/><input type="text" value="<?php echo ''; ?>" style="width:85%;border:none;padding:5px" />
                </td>
                <td style="width:20%;border-right:1px solid #000">
                    Date <i>(mm/dd/yyyy)</i>:
                    <br/><input type="text" value="<?php echo $i9_data['rehire_signature_date']; ?>" style="width:85%;border:none;padding:5px" />                    
                </td>
                <td style="width:40%;border-right:1px solid #000">
                    Print Name of Employer or Authorized Representative:
                    <br/><input type="text" value="<?php echo $i9_data['rehire_authorized_representative']; ?>" style="width:85%;border:none;padding:5px" />    
                </td>
            </tr>
        </table>        

        <table style="width:100%;border-top:3px solid #000;margin-top:10px">
            <tr>
                <td>Form I-9 &nbsp; 03/08/13 N</td>    
                <td style="width:50%;text-align:right;padding-top:10px">Page 2</td>    
            </tr>
        </table>
    </body>

    <style type="text/css">
        body{margin:0; font-size:13.5px}
        /* div table tr td:nth-child(even){font-style:italic !important;text-align:center}
        td span b{display:block;margin-left:3px !important}*/
    </style>

</html>