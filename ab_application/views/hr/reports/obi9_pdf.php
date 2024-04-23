<?php

//pr($i9_data);

function img_root($PATH = '') {
//echo site_url($PATH);
    return Get_File_Directory($PATH);
}
?>
<!DOCTYPE html>
<html>
    <body>
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
                    Expires 08/31/2019</span>
            </td>
        </table>

        <table style="width:100%;margin-top:3px;border-top:1px solid #000">
            <tr>
                <td>
                    <strong>►START HERE:</strong> Read instructions carefully before completing this form. 
                    The instructions must be available, either in paper or electronically, during completion of this form. 
                    Employers are liable for errors in the completion of this form.<br>
                    
                    <strong>ANTI-DISCRIMINATION NOTICE:</strong> It is illegal to discriminate against work-authorized individuals. 
                    Employers <strong>CANNOT</strong> specify which document(s) an employee may present to establish employment authorization and identity. 
                    The refusal to hire or continue to employ an individual because the documentation presented has a future expiration 
                    date may also constitute illegal discrimination. <br>
                   
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
                    I am aware that federal law provides for imprisonment and/or fines for false statements or use of false documents in 
                    connection with the completion of this form.<br/><br/>
                    I attest, under penalty of perjury, that I am (check one of the following boxes):
                </td>
            </tr>
        </table>
        
        <table style="width:100%">
            <tr>
                <td style="border:1px solid #000">
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury1'] == 1) ? 'checked' : ''; ?> /> &nbsp; 1. &nbsp; A citizen of the United States
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000">
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury2'] == 1) ? 'checked' : ''; ?> /> &nbsp; 2. &nbsp; A noncitizen national of the United States <i>(See instructions)</i>
                </td>
            </tr>
        </table>
        <table style="width:100%">
            <tr >
                <td style="width:1%;white-space:nowrap; border:1px solid #000">
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury3'] == 1) ? 'checked' : ''; ?> /> &nbsp; 3. &nbsp; A lawful permanent resident 
                    (Alien Registration Number/USCIS Number):
                </td>
                <td style="width:25%;border:1px solid #000;text-align:center"><?php echo $i9_data['lawful_permanent_resident']; ?></td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="width:100%; border:1px solid #000">
            <tr>
                <td style="width:1%;white-space:nowrap">
                    <input type="checkbox" <?php echo ($i9_data['under_penalty_of_perjury5'] == 1) ? 'checked' : ''; ?> /> &nbsp; 4. &nbsp; An alien authorized to work 
                    until (expiration date, if applicable, mm/dd/yyyy) 
                </td>
                <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['expiration_date']; ?></td>
                <td style="width:1%;white-space:nowrap">. Some aliens may write "N/A" in this field. <i>(See instructions)</i></td>
            </tr>
            <tr>
                <td colspan="3">
                    <br/><i>Aliens authorized to work must provide only one of the following document numbers to complete Form I-9:  
                        An Alien Registration Number/USCIS Number OR Form I-94 Admission Number OR Foreign Passport Number.</i>
                </td>
            </tr>
        </table>

        <table style="width:100%">
            <tr>
                <td style="border:1px solid #000">
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
                            <td style="font-size:18px;font-weight:bold">OR</td>
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
                            <td style="width:25%"></td>
                            <td style="font-size:18px;font-weight:bold">OR</td>
                        </tr>
                    </table>
                    <table style="width:100%">
<!--                        <tr>
                            <td colspan="2">
                                If you obtained your admission number from CBP in connection with your arrival in the United States, include the following:
                            </td>
                        </tr>-->
                        <tr>
                            <td style="width:1%;white-space:nowrap"><b>3.</b>Foreign Passport Number: </td>
                            <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['foreign_passport_number']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="width:1%;white-space:nowrap">Country of Issuance:</td>
                            <td style="border-bottom:1px solid #000;text-align:center"><?php echo $i9_data['country_of_issuance']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                &nbsp;
                            </td>
                        </tr>
                        
<!--                        <tr>
                            <td colspan="2">
                                Some aliens may write "N/A" on the Foreign Passport Number and Country of Issuance fields. <i>(See instructions)</i>
                            </td>
                        </tr>-->
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
                    First Name <i>(Given Name)</i>
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
                <td>Form I-9 &nbsp; 07/17/17 N</td>    
                <td style="width:50%;text-align:right;padding-top:10px"> Page 1 of 3 </td>    
            </tr>
        </table>
    </body>

    <body>
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
                    Expires 08/31/2019</span>
            </td>
        </table>
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

        <table style="width:100%;font-weight:bold; ">
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
                    
                    <table style="width:90%;height:120px;margin-left:0%;padding-top:10px;border:1px solid #000">
                        <tr>
                            <td style="text-align:center;font-weight:bold;">
                                Additional Information 
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:1%">&nbsp;</td>
                <td style="width:32%;text-align:right">
                    <!-----------------Barcode (in Second Page)------------------>
                    <table style="width:90%;height:120px;margin-left:0%;padding-top:10px;border:1px solid #000">
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
                <td>Form I-9 &nbsp; 07/17/17 N</td>   
                <td style="width:50%;text-align:right;padding-top:10px">Page 2 of 3</td>    
            </tr>
        </table>
    </body>

    <body>
        <table style="width:100%;border-top:10px solid #000">
            <td style="width:20%">
                &nbsp;
            </td>
            <td style="text-align:center">
                <h2 style="margin-top:0;margin-bottom:10px">LISTS OF ACCEPTABLE DOCUMENTS </h2>
                <span style="font-size:18px"><b>All documents must be UNEXPIRED</b><br/>
                    Employees may present one selection from List A  
                    or a combination of one selection from List B and one selection from List C.
                </span>
            </td>
            <td style="width:20%;text-align:center">
                &nbsp;
            </td>
        </table>
        
        <table style="width:100%;">
            <tr>
                <td style="width:32%; border:1px solid #000; text-align: center">
                    LIST A<br>
                    Documents that Establish Both Identity and Employment Authorization

                </td>
                <td style="width:32%; border:1px solid #000; text-align: center">
                    LIST B<br>
                    Documents that Establish  Identity 

                </td>
                <td style="width:32%; border:1px solid #000; text-align: center">
                    LIST C<br>
                    Documents that Establish  Employment Authorization

                </td>
            </tr>
            <tr>
                <td style="width:32%; border:1px solid #000; ">
                    1.   U.S. Passport or U.S. Passport Card
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    1.   Driver's license or ID card issued by a State or outlying possession of the United States provided it 
                    contains a photograph or information such as name, date of birth, gender, height, eye color, and address
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    1.   A Social Security Account Number card, unless the card includes one of the following restrictions:<br>
                        
                    (1)  NOT VALID FOR EMPLOYMENT<br>
                    (2)  VALID FOR WORK ONLY WITH INS AUTHORIZATION <br>
                    (3)  VALID FOR WORK ONLY WITH DHS AUTHORIZATION <br>
                </td>
            </tr>
            <tr>
                <td style="width:32%; border:1px solid #000; ">
                    2.   Permanent Resident Card or Alien Registration Receipt Card (Form I-551)
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    2.   ID card issued by federal, state or local government agencies or entities, provided it contains 
                    a photograph or information such as name, date of birth, gender, height, eye color, and address
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    2.   Certification of report of birth issued by the Department of State (Forms DS-1350, FS-545, FS-240) 
                </td>
            </tr>
            <tr>
                <td style="width:32%; border:1px solid #000; ">
                    3.   Foreign passport that contains a temporary I-551 stamp or temporary I-551 printed notation on a machinereadable immigrant visa 
                </td>
                <td style="width:32%; border:1px solid #000; ">
                   3.   School ID card with a photograph<br>
                   4.   Voter's registration card <br>
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    3.   Original or certified copy of birth certificate issued by a State, county, municipal authority, 
                    or territory of the United States bearing an official seal 
                </td>
            </tr>
            <tr>
                <td style="width:32%; border:1px solid #000; ">
                    4.   Employment Authorization Document that contains a photograph (Form I-766) 
                </td>
                <td style="width:32%; border:1px solid #000; ">
                   5.   U.S. Military card or draft record<br>
                   6.   Military dependent's ID card <br>
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    4.   Native American tribal document
                </td>
            </tr>
            <tr>
                <td style="width:32%; border:1px solid #000; ">
                    5. For a nonimmigrant alien authorized  to work for a specific employer because of his or her status:
                        a. Foreign passport; and<br>
                        b. Form I-94 or Form I-94A that has  the following: <br>

                        (1) The same name as the passport; and <br>
                        (2) An endorsement of the alien's nonimmigrant status as long as that period of endorsement 
                        has not yet expired and the proposed employment is not in conflict with any restrictions 
                        or limitations identified on the form.
                </td>
                <td style="width:32%; border:1px solid #000; ">
                   7.   U.S. Coast Guard Merchant Mariner Card<br>
                   8.   Native American tribal document<br>
                   9.   Driver's license issued by a Canadian government authority<br>
                   <b>For persons under age 18 who are unable to present a document listed above:</b>
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    5.   U.S. Citizen ID Card (Form I-197)<br>
                    6.   Identification Card for Use of Resident Citizen in the United States (Form I-179)
                </td>
            </tr>
            <tr>
                <td style="width:32%; border:1px solid #000; ">
                    6.   Passport from the Federated States of Micronesia (FSM) or the Republic of the 
                    Marshall Islands (RMI) with Form I-94 or Form I-94A indicating nonimmigrant admission 
                    under the Compact of Free Association Between the United States and the FSM or RMI
                </td>
                <td style="width:32%; border:1px solid #000; ">
                   10.   School record or report card <br>
                   11.   Clinic, doctor, or hospital record <br>
                   12.   Day-care or nursery school record <br>
                </td>
                <td style="width:32%; border:1px solid #000; ">
                    7.   Employment authorization document issued by the Department of Homeland Security
                </td>
            </tr>
            
        </table>
        
        <table style="width:100%; padding-top: 10px;">
            <td style="text-align:center">
                <span style="font-size:18px">Examples of many of these documents appear in Part 13 of the Handbook for Employers (M-274). </span>
            </td>
        </table>
        <table style="width:100%; padding-top: 20px;">
            <td style="text-align:center">
                <span style="font-size:18px">Refer to the instructions for more information about acceptable receipts.</span>
            </td>
        </table>
        
        <table style="width:100%;border-top:3px solid #000;margin-top:10px">
            <tr>
                <td>Form I-9 &nbsp; 07/17/17 N</td>     
                <td style="width:50%;text-align:right;padding-top:10px">Page 3 of 3</td>    
            </tr>
        </table>
        
    </body>

    <style type="text/css">
        body{margin:0; font-size:13.5px}
        /* div table tr td:nth-child(even){font-style:italic !important;text-align:center}
        td span b{display:block;margin-left:3px !important}*/
    </style>

</html>