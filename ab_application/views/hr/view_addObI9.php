<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ObI9/save_ObI9" enctype="multipart/form-data" role="form">

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="testimonial-info"style="margin-top: 7px">
                                    <img class="rounded-x" src="<?php echo base_url() . "assets/img/i-9.jpg"; ?>" alt="No Image" height="100" width="95">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h3>
                                    Employment Eligibility Verification
                                </h3>
                                <h4>
                                    Department of Homeland Security
                                </h4>
                                <h5>
                                    U.S. Citizenship and Immigration Services
                                </h5>
                            </div>
                            <div class="col-sm-4 pull-right">
                                <h3 class="pull-right">
                                    USCIS Form I-9
                                </h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>
                                    PSTART HERE. Read instructions carefully before completing this form. The instructions must be available during completion of this form
                                    ANTI-DISCRIMINATION NOTICE: lt is illegal to discriminate against work-authorized individuals. Employers CANNOT specify which
                                    documentls) they will accept from an employee. The refusal to hire an individual because the documentation presented has a future
                                    expiration date may also constitute illegal discrimination.
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="form-group no-margin">
                                <label class="col-sm-2 control-label">Select Type <span class="req"></span> :</label>
                                <div class="col-sm-4 no-padding">
                                    <select name="ob_eeo_type" id="ob_eeo_type" onchange="set_ob_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $ob_eeo_type = array(1 => 'Onboard', 2 => 'Employee');
                                        foreach ($ob_eeo_type as $key => $val) {
                                            print"<option value='" . $key . "'>" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>    
                                <label class="col-sm-2 control-label">Select Candidate</label>
                                <div class="col-sm-4">
                                    <select name="onboarding_employee" id="onboarding_employee" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
//                                        $ob_candidate = $this->db->get_where('main_ob_personal_information', array('company_id' => $this->company_id));
//                                        if ($ob_candidate && ($ob_candidate->num_rows() > 0)) {
//                                            foreach ($ob_candidate->result() as $key => $row) {
//                                                print"<option value='" . $row->onboarding_employee_id . "'>" . $row->onboarding_firstname . ' ' . $row->onboarding_middlename . ' ' . $row->onboarding_lastname . "</option>";
//                                            }
//                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="table-responsive">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="8"> 
                                            <h5>
                                                Section1. Employee Information and Attestation
                                            </h5>
                                            <i>
                                                (Employees must complete and sign Section 1 of Form t‘-9 no tater than the ﬁrst day of employment, but not before accepting a job offer.)
                                            </i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Last Name(Family Name)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name(Family Name)">
                                                </div>
                                            </div>
                                        </td>                                   
                                        <td colspan="2"> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Fast Name(Given Name)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="fast_name" id="fast_name" class="form-control input-sm" placeholder="Fast Name(Given Name)" >
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Middle Initial</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="middle_initial" id="middle_initial" class="form-control input-sm" placeholder="Middle Initial">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Other Name used(If any)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="other_name" id="other_name" class="form-control input-sm" placeholder="Other Name used(If any)">
                                                </div>
                                            </div>
                                        </td>                                    
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Address (Street Number and Name) </label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address (Street Number and Name)" >
                                                </div>
                                            </div>
                                        </td>                                   
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Apt. Number</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="apt_number" id="apt_number" class="form-control input-sm" placeholder="Apt. Number">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">City or Town</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="city_town" id="city_town" class="form-control input-sm" placeholder="City or Town">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">State</label><br/>
                                                <div class="col-sm-12">
                                                    <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                        <option></option>
                                                        <?php
                                                        $state_query = $this->Common_model->listItem('main_state');
                                                        foreach ($state_query->result() as $keyy):
                                                            ?>
                                                            <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Zip code</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="zip_code" id="zip_code" class="form-control input-sm" placeholder="Zip code">
                                                </div>
                                            </div>
                                        </td>                                    
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Date of Birth (mm/do‘/yyyy)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="date_of_birth" id="date_of_birth" class="form-control dt_pick input-sm" placeholder="Date of Birth (mm/do‘/yyyy)" >
                                                </div>
                                            </div>
                                        </td>                                   
                                        <td colspan="2"> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12"> U.S. Social Security Number</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="us_ssn" id="us_ssn" class="form-control input-sm" placeholder="U.S. Social Security Number">
                                                </div>
                                            </div>
                                        </td>  
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">E-mail Address</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="email" name="email_address" id="email_address" class="form-control input-sm" placeholder="E-mail Address" >
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="2">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Telephone Number</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="telephone_number" id="telephone_number" class="form-control input-sm" placeholder="Telephone Number" >
                                                </div>
                                            </div>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5>
                            I am aware that federal law provides for imprisonment and/or fines for false statements or use of false documents in connection with the completion of this form.
                        </h5>
                        <h5>
                            I attest, under penalty of perjury, that I am (check one of the following):                    
                        </h5>

                        <h5>
                            <div class="col-sm-12">
                                <input type="checkbox" id="under_penalty_of_perjury1" name="under_penalty_of_perjury1" value="1">
                                A citizen of the United States   
                            </div>
                        </h5>
                        <h5>
                            <div class="col-sm-12">
                                <input type="checkbox" id="under_penalty_of_perjury2" name="under_penalty_of_perjury2" value="1">
                                A noncitizen national of the United States (See instructions)    
                            </div>
                        </h5>
                        <h5>
                            <div class="col-sm-8">
                                <input type="checkbox" id="under_penalty_of_perjury3" name="under_penalty_of_perjury3" value="1">
                                A lawful permanent resident (Alien Registration Number/USCIS Number): 
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control input-sm" id="lawful_permanent_resident" name="lawful_permanent_resident">
                            </div>
                        </h5>
                        <h5 style="margin-top: 5px;">
                            <div class="col-sm-8" style="margin-top: 5px;">
                                <input type="checkbox" id="under_penalty_of_perjury5" name="under_penalty_of_perjury5" value="1">
                                An alien authorized to work until (expiration date, if applicable, mm/dd/yyyy)
                            </div>
                            <div class="col-sm-4" style="margin-top: 5px;">
                                <input type="text" class="form-control dt_pick input-sm" id="expiration_date" name="expiration_date">
                            </div> . Some aliens may write "N/A" in this field. (See instructions)
                        </h5>

                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                For aliens authorized to work, provide your Alien Registration Number/USCIS Number OR Form I-94 Admission Number:
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="col-sm-8">
                                    1. Alien Registration Number/USCIS Number: 
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" id="alien_registration_number" name="alien_registration_number">
                                </div>
                                <div class="col-sm-12">
                                    OR
                                </div>
                                <div class="col-sm-8">
                                    2. Form I-94 Admission Number:  
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" id="admission_number" name="admission_number">
                                </div>
                                <div class="col-sm-12">
                                    If you obtained your admission number from CBP in connection with your arrival in the United States, include the following:
                                </div>
                                <div class="col-sm-6" style="margin-top: 5px;">
                                    Foreign Passport Number:    
                                </div>
                                <div class="col-sm-4" style="margin-top: 5px;">
                                    <input type="text" class="form-control input-sm" id="foreign_passport_number" name="foreign_passport_number">
                                </div>
                                <div class="col-sm-6" style="margin-top: 5px;">
                                    Country of Issuance:      
                                </div>
                                <div class="col-sm-4" style="margin-top: 5px;">
                                    <input type="text" class="form-control input-sm" id="country_of_issuance" name="country_of_issuance">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control input-sm" id="barcode" name="barcode" placeholder="3-D Barcode">
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                Some aliens may write "N/A" on the Foreign Passport Number and Country of Issuance fields. (See instructions)
                            </div>
                        </div>

                        <br>
                        <div class="table-responsive"> 
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">Signature of Employee:</div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-4">Date(mm/dd/yyyy):</div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control dt_pick input-sm" id="signature_date" name="signature_date" value="<?php echo $this->Common_model->show_date_formate(date("Y-m-d")); ?>" placeholder="Date">
                                            </div>
                                        </td>
                                    </tr>                        
                                </tbody>
                            </table>
                        </div>


                        <div class="table-responsive">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="8"> 
                                            <h5>
                                                Preparer and/or Translator Certification (To be completed and signed if Section 1 is prepared by a person other than the employee.)  
                                            </h5>
                                            <i>
                                                I attest, under penalty of perjury, that I have assisted in the completion of this form and that to the best of my knowledge the information is true and correct.                                                                
                                            </i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Signature of Preparer or Translator:</label><br/>
                                                <div class="col-sm-12">

                                                </div>
                                            </div>
                                        </td>                                   

                                        <td colspan="3"> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Date</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="con_signature_date" id="con_signature_date" class="form-control input-sm dt_pick" placeholder="Date">
                                                </div>
                                            </div>
                                        </td>                                    

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Last Name (Family Name) </label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="con_last_name" id="con_last_name" class="form-control input-sm" placeholder="Last Name (Family Name)">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td colspan="4">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">First Name (Given Name)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="con_first_name" id="con_first_name" class="form-control input-sm" placeholder="First Name (Given Name)">
                                                </div>
                                            </div>
                                        </td>                                    
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Address </label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="con_address" id="con_address" class="form-control input-sm" placeholder="Address">
                                                </div>
                                            </div>
                                        </td>                                   
                                        <td colspan="2">  
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">City or Town</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="con_city" id="con_city" class="form-control input-sm" placeholder="City or Town">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="1">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">State</label><br/>
                                                <div class="col-sm-12">
                                                    <select name="con_state" id="con_state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                        <option></option>
                                                        <?php
                                                        $state_query = $this->Common_model->listItem('main_state');
                                                        foreach ($state_query->result() as $keyy):
                                                            ?>
                                                            <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="1">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Zip Code</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="con_zip_code" id="con_zip_code" class="form-control input-sm" placeholder="Zip Code">
                                                </div>
                                            </div>
                                        </td>                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <div class="row col-md-offset-0" style="border: 1px solid; width: 99.8%" >
                            <div class="col-sm-12">
                                <h4><b>Section 2. Employer or Authorized Representative Review and Verification</b></h4>
                            </div>
                            <div class="col-sm-12">
                                <p>
                                    (Emptoyers or their autnonzed representative must comptete and sign Section 2 within 3 business days of the empioyee's first day of empioyment. You
                                    must pnysicatiy examine one document from List A OR examine a combination of one document from List B and one document from Li'st C as iisted on
                                    the "Lists of Acceptabte Documents" on the next f h’
                                    page o t is form. For eacn document you review, record the foiiowing information: document titie,
                                    issuing autnonty, document number, and expiration date, if any.)
                                </p>
                            </div>
                        </div>
                        <br/>
                        <div class="row col-md-offset-0" style="border: 1px solid; width: 99.8%">
                            <div style="margin: 5px 5px 5px 5px; margin-bottom: 40px" >  
                                <div class="col-sm-6" style="margin-top: 7px">
                                    <b>Employee Last Name, Fast Name, and Middle Initial From Section 1:</b>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="employer_name" id="employer_name" class="form-control input-sm" placeholder="Employee Last Name, Fast Name, and Middle Initial">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">List A <br/> Identity and Employment Authorization </th>
                                        <th style="text-align: center">List B <br/> Identity </th>
                                        <th style="text-align: center">List C <br/> Employment Authorization  </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Title:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_title_a" id="employer_document_title_a" class="form-control input-sm" placeholder="Document Title">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Title:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_title_b" id="employer_document_title_b" class="form-control input-sm" placeholder="Document Title">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Title:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_title_c" id="employer_document_title_c" class="form-control input-sm" placeholder="Document Title">
                                                </div>
                                            </div>
                                        </td>                                    

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Issuing Authority:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_issuing_authority_a" id="employer_issuing_authority_a" class="form-control input-sm" placeholder="Issuing Authority">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Issuing Authority:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_issuing_authority_b" id="employer_issuing_authority_b" class="form-control input-sm" placeholder="Issuing Authority">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Issuing Authority:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_issuing_authority_c" id="employer_issuing_authority_c" class="form-control input-sm" placeholder="Issuing Authority">
                                                </div>
                                            </div>
                                        </td>                                    

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Number:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_number_a" id="employer_document_number_a" class="form-control input-sm" placeholder="Document Number">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Number:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_number_b" id="employer_document_number_b" class="form-control input-sm" placeholder="Document Number">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Number:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_number_c" id="employer_document_number_c" class="form-control input-sm" placeholder="Document Number">
                                                </div>
                                            </div>
                                        </td>                                    

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_expiration_date_a" id="employer_expiration_date_a" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_expiration_date_b" id="employer_expiration_date_b" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_expiration_date_c" id="employer_expiration_date_c" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Title:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_title_a1" id="employer_document_title_a1" class="form-control input-sm" placeholder="Document Title">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td colspan="2" rowspan="8">

                                            <div class="col-md-offset-7" style="height: 200px; width: 250px; border: 1px solid">
                                                <b >3-D Barcode</b><br/>
                                                <p>Do Not Write This Space</p>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Issuing Authority:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_issuing_authority_a1" id="employer_issuing_authority_a1" class="form-control input-sm" placeholder="Issuing Authority">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Number:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_number_a1" id="employer_document_number_a1" class="form-control input-sm" placeholder="Document Number">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_expiration_date_a1" id="employer_expiration_date_a1" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Title:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_title_a2" id="employer_document_title_a2" class="form-control input-sm" placeholder="Document Title">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Issuing Authority:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_issuing_authority_a2" id="employer_issuing_authority_a2" class="form-control input-sm" placeholder="Issuing Authority">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Number:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_document_number_a2" id="employer_document_number_a2" class="form-control input-sm" placeholder="Document Number">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_expiration_date_a2" id="employer_expiration_date_a2" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div> 
                    <div class="row col-md-offset-0">
                        <div class="col-md-12">
                            <h4><b>Certiﬁcation</b></h4><br>
                            <label>I attest, under penalty of perjury, that [1] I have examined the documentie) presented by the ebotre-named employee. [2] tlle
                                above-listed documentiel appear to be genuine and to relate to the employee named. end [3] to tlle beet of my knowledge tlle
                                employee is euthorixed to work in the United States.</label>
                        </div><br/>
                        <div class="col-md-12">
                            <label class="col-sm-6">The employee's first day of employment (mm/dd/yyyy):</label>
                            <div class="col-sm-3"><input type="text" name="employer_certification_date" id="employer_certification_date" class="form-control input-sm dt_pick" placeholder="first day of employment"></div>
                            <label class="col-sm-3">(See instruction for exemptions.)</label>
                        </div>
                    </div>
                    <div class="table-responsive">          
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="5">
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Signature of Preparer or Translator:</label><br/>
                                            <div class="col-sm-12">

                                            </div>
                                        </div>
                                    </td>                                   

                                    <td colspan="3"> 
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Date</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="employer_signature_date" id="employer_signature_date" class="form-control input-sm dt_pick" placeholder="Date">
                                            </div>
                                        </div>
                                    </td>                                    

                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Last Name (Family Name) </label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="employer_last_name" id="employer_last_name" class="form-control input-sm" placeholder="Last Name (Family Name)">
                                            </div>
                                        </div>
                                    </td>                                   

                                    <td colspan="4">
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">First Name (Given Name)</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="employer_first_name" id="employer_first_name" class="form-control input-sm" placeholder="First Name (Given Name)">
                                            </div>
                                        </div>
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Address </label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="employer_address" id="employer_address" class="form-control input-sm" placeholder="Address">
                                            </div>
                                        </div>
                                    </td>                                   
                                    <td colspan="2">  
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">City or Town</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="employer_city" id="employer_city" class="form-control input-sm" placeholder="City or Town">
                                            </div>
                                        </div>
                                    </td>                                    
                                    <td colspan="1">
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">State</label><br/>
                                            <div class="col-sm-12">
                                                <select name="employer_state" id="employer_state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                    <option></option>
                                                    <?php
                                                    $state_query = $this->Common_model->listItem('main_state');
                                                    foreach ($state_query->result() as $keyy):
                                                        ?>
                                                        <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>                                    
                                    <td colspan="1">
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Zip Code</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="employer_zip_code" id="employer_zip_code" class="form-control input-sm" placeholder="Zip Code">
                                            </div>
                                        </div>
                                    </td>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3"> 
                                        <h5>
                                            <b>Section 3. Reverification and Rehires </b> (To be completed and signed by employer or authorized representative)
                                        </h5>                                
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="col-md-12">
                                            <div class="col-md-5">
                                                <label class="col-sm-12">A. New Name(if applicable)Last Name (Family Name):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_last_name" id="rehire_last_name" class="form-control input-sm" placeholder="Family Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-sm-12">First Name (Given name):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_first_name" id="rehire_first_name" class="form-control input-sm" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-sm-12">Middle Initial:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_middle_initial" id="rehire_middle_initial" class="form-control input-sm" placeholder="Middle Initial">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12"> B. Date of Rehire(mm/dd/yyyy)</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="rehire_date" id="rehire_date" class="form-control input-sm dt_pick" placeholder="Date">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3"> 
                                        <h5>
                                            C. If employees previous grant of employment authorization has expired, provide the information for the document from List A or List C the employee
                                            presented the establish current employment authorization in the spade provided below.
                                        </h5>                                
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Document Title:</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="rehire_document_title" id="rehire_document_title" class="form-control input-sm" placeholder="Document Title">
                                            </div>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Document Number:</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="rehire_document_number" id="rehire_document_number" class="form-control input-sm" placeholder="Document Number">
                                            </div>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="rehire_expiration_date" id="rehire_expiration_date" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5>
                        <b>I attest, under penalty of perjury, that to the best of my knowledge, this employee is authorized to work in the United States, and if
                            the employee presented document(s), the document(s) I have examined appear to be genuine and to relate to the individual.</b>
                    </h5>

                    <div class="table-responsive">          
                        <table class="table">

                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Signature of Employer or Authorized Representative:</label><br/>
                                            <div class="col-sm-12">
    <!--                                                <input type="text" name="other_name" id="other_name" class="form-control input-sm" placeholder="Signature">-->
                                            </div>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Date(mm/dd/yyyy):</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="rehire_signature_date" id="rehire_signature_date" class="form-control input-sm dt_pick" placeholder="Date">
                                            </div>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-group no-margin">
                                            <label class="col-sm-12">Print Name of Employer or Authorized Representative:</label><br/>
                                            <div class="col-sm-12">
                                                <input type="text" name="rehire_authorized_representative" id="rehire_authorized_representative" class="form-control input-sm" placeholder="Authorized Representative">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12">
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u"> Prepare I-9 </button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_ObI9" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>

                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ObI9/edit_ObI9" enctype="multipart/form-data" role="form" >
                    <?php
                    foreach ($query->result() as $row):

                        ?>
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>

                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="testimonial-info">
                                        <img class="rounded-x" src="<?php echo base_url() . "assets/img/i-9.jpg"; ?>" alt="No Image" height="100" width="95">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h3>
                                        Employment Eligibility Verification
                                    </h3>
                                    <h4>
                                        Department of Homeland Security
                                    </h4>
                                    <h5>
                                        U.S. Citizenship and Immigration Services
                                    </h5>
                                </div>
                                <div class="col-sm-4 pull-right">
                                    <h3 class="pull-right">
                                        USCIS Form I-9
                                    </h3>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        PSTART HERE. Read instructions carefully before completing this form. The instructions must be available during completion of this form
                                        ANTI-DISCRIMINATION NOTICE: lt is illegal to discriminate against work-authorized individuals. Employers CANNOT specify which
                                        documentls) they will accept from an employee. The refusal to hire an individual because the documentation presented has a future
                                        expiration date may also constitute illegal discrimination.
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group no-margin">
                                    <label class="col-sm-2 control-label">Select Type <span class="req"></span> :</label>
                                    <div class="col-sm-4 no-padding">
                                        <select name="ob_eeo_type" id="ob_eeo_type" onchange="set_ob_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled >
                                            <option></option>
                                            <?php
                                            $ob_eeo_type = array(1 => 'Onboard', 2 => 'Employee');
                                            foreach ($ob_eeo_type as $key => $val) {
                                                $slct = ($row->ob_eeo_type == $key) ? 'selected' : '';
                                                print"<option value='" . $key . "'" . $slct . ">" . $val . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                    <label class="col-sm-2 control-label"> Select Candidate </label>
                                    <div class="col-sm-4">
                                        <select name="onboarding_employee" id="onboarding_employee" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled >
                                            <option></option>
                                            <?php
                                                if($row->ob_eeo_type==1)
                                                {
                                                    $query = $this->db->get_where('main_ob_personal_information', array('company_id' => $this->company_id));
                                                    if ($query->num_rows() > 0) {
                                                        print"<option></option>";
                                                        foreach ($query->result() as $roww) {
                                                            $slct = ($row->onboarding_employee_id == $roww->onboarding_employee_id) ? 'selected' : '';
                                                            print"<option value='" . $roww->onboarding_employee_id . "' " . $slct . ">" . $roww->onboarding_firstname . ' ' . $roww->onboarding_middlename . ' ' . $roww->onboarding_lastname . "</option>";
                                                        }
                                                    } else {
                                                        echo"<option> No Onboard added </option>";
                                                    }
                                                }
                                                else if($row->ob_eeo_type==2)
                                                {
                                                    $query = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
                                                    if ($query->num_rows() > 0) {
                                                        print"<option></option>";
                                                        foreach ($query->result() as $rowss) {
                                                            $slct = ($row->onboarding_employee_id == $rowss->employee_id) ? 'selected' : '';
                                                            print"<option value='" . $rowss->employee_id . "' " . $slct . ">" . $rowss->first_name . ' ' . $rowss->middle_name . ' ' . $rowss->last_name . "</option>";
                                                        }
                                                    } else {
                                                        echo"<option> No Employee added </option>";
                                                    }
                                                }
                                                
//                                            $ob_candidate = $this->db->get_where('main_ob_personal_information', array('company_id' => $this->company_id));
//                                            if ($ob_candidate && ($ob_candidate->num_rows() > 0)) {
//                                                foreach ($ob_candidate->result() as $key => $row) {
//                                                    print"<option value='" . $row->onboarding_employee_id . "'>" . $row->onboarding_firstname . ' ' . $row->onboarding_middlename . ' ' . $row->onboarding_lastname . "</option>";
//                                                }
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="8"> 
                                                <h5>
                                                    Section1. Employee Information and Attestation
                                                </h5>
                                                <i>
                                                    (Employees must complete and sign Section 1 of Form t‘-9 no tater than the ﬁrst day of employment, but not before accepting a job offer.)
                                                </i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Last Name(Family Name)</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="last_name" id="last_name" value="<?php echo $row->last_name; ?>" class="form-control input-sm" placeholder="Last Name(Family Name)">
                                                    </div>
                                                </div>
                                            </td>                                   
                                            <td colspan="2"> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Fast Name(Given Name)</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="fast_name" id="fast_name" value="<?php echo $row->fast_name; ?>" class="form-control input-sm" placeholder="Fast Name(Given Name)" >
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Middle Initial</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="middle_initial" id="middle_initial" value="<?php echo $row->middle_initial; ?>" class="form-control input-sm" placeholder="Middle Initial">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Other Name used(If any)</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="other_name" id="other_name" value="<?php echo $row->other_name; ?>" class="form-control input-sm" placeholder="Other Name used(If any)">
                                                    </div>
                                                </div>
                                            </td>                                    
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Address (Street Number and Name) </label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="address" id="address" value="<?php echo $row->address; ?>" class="form-control input-sm" placeholder="Address (Street Number and Name)" >
                                                    </div>
                                                </div>
                                            </td>                                   
                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Apt. Number</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="apt_number" id="apt_number" value="<?php echo $row->apt_number; ?>" class="form-control input-sm" placeholder="Apt. Number">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">City or Town</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="city_town"  id="city_town" value="<?php echo $row->city_town; ?>" class="form-control input-sm" placeholder="City or Town">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">State</label><br/>
                                                    <div class="col-sm-12">
                                                        <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                            <option></option>
                                                            <?php
                                                            $state_query = $this->Common_model->listItem('main_state');
                                                            foreach ($state_query->result() as $keyy):
                                                                ?>
                                                                <option value="<?php echo $keyy->id ?>"<?php echo ($row->state == $keyy->id ? 'selected' : ''); ?>><?php echo $keyy->state_abbr ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Zip code</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="zip_code" id="zip_code" value="<?php echo $row->zip_code; ?>" class="form-control input-sm" placeholder="Zip code">
                                                    </div>
                                                </div>
                                            </td>                                    
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Date of Birth (mm/do‘/yyyy)</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="date_of_birth" id="date_of_birth" value="<?php echo $this->Common_model->show_date_formate($row->date_of_birth); ?>" class="form-control dt_pick input-sm" placeholder="Date of Birth (mm/do‘/yyyy)" >
                                                    </div>
                                                </div>
                                            </td>                                   
                                            <td colspan="2"> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12"> U.S. Social Security Number</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="us_ssn" id="us_ssn" value="<?php echo $row->us_ssn; ?>" class="form-control input-sm" placeholder="U.S. Social Security Number">
                                                    </div>
                                                </div>
                                            </td>  
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">E-mail Address</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="email" name="email_address" id="email_address" value="<?php echo $row->email_address; ?>" class="form-control input-sm" placeholder="E-mail Address" >
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td colspan="2">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Telephone Number</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="telephone_number" id="telephone_number" value="<?php echo $row->telephone_number; ?>" class="form-control input-sm" placeholder="Telephone Number" >
                                                    </div>
                                                </div>
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h5>
                                I am aware that federal law provides for imprisonment and/or fines for false statements or use of false documents in connection with the completion of this form.
                            </h5>
                            <h5>
                                I attest, under penalty of perjury, that I am (check one of the following):                    
                            </h5>

                            <h5>
                                <div class="col-sm-12">
                                    <input type="checkbox" id="under_penalty_of_perjury1" name="under_penalty_of_perjury1" value="1"<?php echo ($row->under_penalty_of_perjury1 == 1 ? 'checked' : ''); ?>>
                                    A citizen of the United States   
                                </div>
                            </h5>
                            <h5>
                                <div class="col-sm-12">
                                    <input type="checkbox" id="under_penalty_of_perjury2" name="under_penalty_of_perjury2" value="1"<?php echo ($row->under_penalty_of_perjury2 == 1 ? 'checked' : ''); ?>>
                                    A noncitizen national of the United States (See instructions)    
                                </div>
                            </h5>
                            <h5>
                                <div class="col-sm-8">
                                    <input type="checkbox" id="under_penalty_of_perjury3" name="under_penalty_of_perjury3" value="1"<?php echo ($row->under_penalty_of_perjury3 == 1 ? 'checked' : ''); ?>>
                                    A lawful permanent resident (Alien Registration Number/USCIS Number): 
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" id="lawful_permanent_resident" value="<?php echo $row->lawful_permanent_resident; ?>" name="lawful_permanent_resident">
                                </div>
                            </h5>
                            <h5 style="margin-top: 5px;">
                                <div class="col-sm-8" style="margin-top: 5px;">
                                    <input type="checkbox" id="under_penalty_of_perjury5" value="1"<?php echo ($row->under_penalty_of_perjury5 == 1 ? 'checked' : ''); ?> name="under_penalty_of_perjury5" value="1">
                                    An alien authorized to work until (expiration date, if applicable, mm/dd/yyyy)
                                </div>
                                <div class="col-sm-4" style="margin-top: 5px;">
                                    <input type="text" class="form-control dt_pick input-sm" id="expiration_date" name="expiration_date" value="<?php echo $this->Common_model->show_date_formate($row->expiration_date); ?>">
                                </div> . Some aliens may write "N/A" in this field. (See instructions)
                            </h5>

                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    For aliens authorized to work, provide your Alien Registration Number/USCIS Number OR Form I-94 Admission Number:
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="col-sm-8">
                                        1. Alien Registration Number/USCIS Number: 
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" id="alien_registration_number" value="<?php echo $row->alien_registration_number; ?>" name="alien_registration_number">
                                    </div>
                                    <div class="col-sm-12">
                                        OR
                                    </div>
                                    <div class="col-sm-8">
                                        2. Form I-94 Admission Number:  
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" id="admission_number" name="admission_number" value="<?php echo $row->admission_number; ?>">
                                    </div>
                                    <div class="col-sm-12">
                                        If you obtained your admission number from CBP in connection with your arrival in the United States, include the following:
                                    </div>
                                    <div class="col-sm-6" style="margin-top: 5px;">
                                        Foreign Passport Number:    
                                    </div>
                                    <div class="col-sm-4" style="margin-top: 5px;">
                                        <input type="text" class="form-control input-sm" id="foreign_passport_number" name="foreign_passport_number" value="<?php echo $row->foreign_passport_number; ?>">
                                    </div>
                                    <div class="col-sm-6" style="margin-top: 5px;">
                                        Country of Issuance:      
                                    </div>
                                    <div class="col-sm-4" style="margin-top: 5px;">
                                        <input type="text" class="form-control input-sm" id="country_of_issuance" name="country_of_issuance" value="<?php echo $row->country_of_issuance; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" id="barcode" name="barcode" placeholder="3-D Barcode" value="<?php echo $row->barcode; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    Some aliens may write "N/A" on the Foreign Passport Number and Country of Issuance fields. (See instructions)
                                </div>
                            </div>

                            <br>
                            <div class="table-responsive"> 
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-6">Signature of Employee:</div>
                                                    <div class="col-sm-4"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-4">Date(mm/dd/yyyy):</div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control dt_pick input-sm" id="signature_date" name="signature_date" value="<?php echo $this->Common_model->show_date_formate(date("Y-m-d")); ?>" placeholder="Date">
                                                </div>
                                            </td>
                                        </tr>                        
                                    </tbody>
                                </table>
                            </div>


                            <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="8"> 
                                                <h5>
                                                    Preparer and/or Translator Certification (To be completed and signed if Section 1 is prepared by a person other than the employee.)  
                                                </h5>
                                                <i>
                                                    I attest, under penalty of perjury, that I have assisted in the completion of this form and that to the best of my knowledge the information is true and correct.                                                                
                                                </i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Signature of Preparer or Translator:</label><br/>
                                                    <div class="col-sm-12">

                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td colspan="3"> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Date</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="con_signature_date" id="con_signature_date" value="<?php echo $this->Common_model->show_date_formate($row->con_signature_date); ?>" class="form-control input-sm dt_pick" placeholder="Date">
                                                    </div>
                                                </div>
                                            </td>                                    

                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Last Name (Family Name) </label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="con_last_name" id="con_last_name" value="<?php echo $row->con_last_name; ?>" class="form-control input-sm" placeholder="Last Name (Family Name)">
                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td colspan="4">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">First Name (Given Name)</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="con_first_name" id="con_first_name" value="<?php echo $row->con_first_name; ?>" class="form-control input-sm" placeholder="First Name (Given Name)">
                                                    </div>
                                                </div>
                                            </td>                                    
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Address </label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="con_address" id="con_address" value="<?php echo $row->con_address; ?>" class="form-control input-sm" placeholder="Address">
                                                    </div>
                                                </div>
                                            </td>                                   
                                            <td colspan="2">  
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">City or Town</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="con_city" id="con_city" value="<?php echo $row->con_city; ?>" class="form-control input-sm" placeholder="City or Town">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td colspan="1">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">State</label><br/>
                                                    <div class="col-sm-12">
                                                        <select name="con_state" id="con_state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                            <option></option>
                                                            <?php
                                                            $state_query = $this->Common_model->listItem('main_state');
                                                            foreach ($state_query->result() as $keyy):
                                                                ?>
                                                                <option value="<?php echo $keyy->id ?>"<?php if ($row->con_state == $keyy->id) echo 'selected' ?>><?php echo $keyy->state_abbr ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td colspan="1">
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Zip Code</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="con_zip_code" id="con_zip_code" value="<?php echo $row->con_zip_code; ?>" class="form-control input-sm" placeholder="Zip Code">
                                                    </div>
                                                </div>
                                            </td>                                    
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <div class="row col-md-offset-0" style="border: 1px solid; width: 99.8%" >
                                <div class="col-sm-12">
                                    <h4><b>Section 2. Employer or Authorized Representative Review and Verification</b></h4>
                                </div>
                                <div class="col-sm-12">
                                    <p>
                                        (Emptoyers or their autnonzed representative must comptete and sign Section 2 within 3 business days of the empioyee's first day of empioyment. You
                                        must pnysicatiy examine one document from List A OR examine a combination of one document from List B and one document from Li'st C as iisted on
                                        the "Lists of Acceptabte Documents" on the next f h’
                                        page o t is form. For eacn document you review, record the foiiowing information: document titie,
                                        issuing autnonty, document number, and expiration date, if any.)
                                    </p>
                                </div>
                            </div>
                            <br/>
                            <div class="row col-md-offset-0" style="border: 1px solid; width: 99.8%">
                                <div style="margin: 5px 5px 5px 5px; margin-bottom: 40px" >  
                                    <div class="col-sm-6" style="margin-top: 7px">
                                        <b>Employee Last Name, Fast Name, and Middle Initial From Section 1:</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="employer_name" id="employer_name" value="<?php echo $row->employer_name; ?>" class="form-control input-sm" placeholder="Employee Last Name, Fast Name, and Middle Initial">
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">List A <br/> Identity and Employment Authorization </th>
                                            <th style="text-align: center">List B <br/> Identity </th>
                                            <th style="text-align: center">List C <br/> Employment Authorization  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Title:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_title_a" id="employer_document_title_a" value="<?php echo $row->employer_document_title_a; ?>" class="form-control input-sm" placeholder="Document Title">
                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Title:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_title_b" id="employer_document_title_b" value="<?php echo $row->employer_document_title_b; ?>" class="form-control input-sm" placeholder="Document Title">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Title:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_title_c" id="employer_document_title_c" value="<?php echo $row->employer_document_title_c; ?>" class="form-control input-sm" placeholder="Document Title">
                                                    </div>
                                                </div>
                                            </td>                                    

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Issuing Authority:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_issuing_authority_a" id="employer_issuing_authority_a" value="<?php echo $row->employer_issuing_authority_a; ?>" class="form-control input-sm" placeholder="Issuing Authority">
                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Issuing Authority:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_issuing_authority_b" id="employer_issuing_authority_b" value="<?php echo $row->employer_issuing_authority_b; ?>" class="form-control input-sm" placeholder="Issuing Authority">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Issuing Authority:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_issuing_authority_c" id="employer_issuing_authority_c" value="<?php echo $row->employer_issuing_authority_c; ?>" class="form-control input-sm" placeholder="Issuing Authority">
                                                    </div>
                                                </div>
                                            </td>                                    

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Number:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_number_a" id="employer_document_number_a" value="<?php echo $row->employer_document_number_a; ?>" class="form-control input-sm" placeholder="Document Number">
                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Number:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_number_b" id="employer_document_number_b" value="<?php echo $row->employer_document_number_b; ?>" class="form-control input-sm" placeholder="Document Number">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Number:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_number_c" id="employer_document_number_c" value="<?php echo $row->employer_document_number_c; ?>" class="form-control input-sm" placeholder="Document Number">
                                                    </div>
                                                </div>
                                            </td>                                    

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_expiration_date_a" id="employer_expiration_date_a" value="<?php echo $this->Common_model->show_date_formate($row->employer_expiration_date_a); ?>" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_expiration_date_b" id="employer_expiration_date_b" value="<?php echo $this->Common_model->show_date_formate($row->employer_expiration_date_b); ?>" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                    </div>
                                                </div>
                                            </td>                                    
                                            <td> 
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_expiration_date_c" id="employer_expiration_date_c" value="<?php echo $this->Common_model->show_date_formate($row->employer_expiration_date_c); ?>" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Title:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_title_a1" id="employer_document_title_a1" value="<?php echo $row->employer_document_title_a1; ?>" class="form-control input-sm" placeholder="Document Title">
                                                    </div>
                                                </div>
                                            </td>                                   

                                            <td colspan="2" rowspan="8">

                                                <div class="col-md-offset-7" style="height: 200px; width: 250px; border: 1px solid">
                                                    <b >3-D Barcode</b><br/>
                                                    <p>Do Not Write This Space</p>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Issuing Authority:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_issuing_authority_a1" id="employer_issuing_authority_a1" value="<?php echo $row->employer_issuing_authority_a1; ?>" class="form-control input-sm" placeholder="Issuing Authority">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Number:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_number_a1" id="employer_document_number_a1" value="<?php echo $row->employer_document_number_a1; ?>" class="form-control input-sm" placeholder="Document Number">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_expiration_date_a1" id="employer_expiration_date_a1" value="<?php echo $this->Common_model->show_date_formate($row->employer_expiration_date_a1); ?>" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Title:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_title_a2" id="employer_document_title_a2" value="<?php echo $row->employer_document_title_a2; ?>" class="form-control input-sm" placeholder="Document Title">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Issuing Authority:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_issuing_authority_a2" id="employer_issuing_authority_a2" value="<?php echo $row->employer_issuing_authority_a2; ?>" class="form-control input-sm" placeholder="Issuing Authority">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Document Number:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_document_number_a2" id="employer_document_number_a2" value="<?php echo $row->employer_document_number_a2; ?>" class="form-control input-sm" placeholder="Document Number">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group no-margin">
                                                    <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="employer_expiration_date_a2" id="employer_expiration_date_a2" value="<?php echo $this->Common_model->show_date_formate($row->employer_expiration_date_a2); ?>" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div> 
                        <div class="row col-md-offset-0">
                            <div class="col-md-12">
                                <h4><b>Certiﬁcation</b></h4><br>
                                <label>I attest, under penalty of perjury, that [1] I have examined the documentie) presented by the ebotre-named employee. [2] tlle
                                    above-listed documentiel appear to be genuine and to relate to the employee named. end [3] to tlle beet of my knowledge tlle
                                    employee is euthorixed to work in the United States.</label>
                            </div><br/>
                            <div class="col-md-12">
                                <label class="col-sm-6">The employee's first day of employment (mm/dd/yyyy):</label>
                                <div class="col-sm-3"><input type="text" name="employer_certification_date" id="employer_certification_date" value="<?php echo $this->Common_model->show_date_formate($row->employer_certification_date); ?>" class="form-control input-sm dt_pick" placeholder="first day of employment"></div>
                                <label class="col-sm-3">(See instruction for exemptions.)</label>
                            </div>
                        </div>
                        <div class="table-responsive">          
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Signature of Preparer or Translator:</label><br/>
                                                <div class="col-sm-12">

                                                </div>
                                            </div>
                                        </td>                                   

                                        <td colspan="3"> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Date</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_signature_date" id="employer_signature_date" value="<?php echo $this->Common_model->show_date_formate($row->employer_signature_date); ?>" class="form-control input-sm dt_pick" placeholder="Date">
                                                </div>
                                            </div>
                                        </td>                                    

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Last Name (Family Name) </label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_last_name" id="employer_last_name" value="<?php echo $row->employer_last_name; ?>" class="form-control input-sm" placeholder="Last Name (Family Name)">
                                                </div>
                                            </div>
                                        </td>                                   

                                        <td colspan="4">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">First Name (Given Name)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_first_name" id="employer_first_name" value="<?php echo $row->employer_first_name; ?>" class="form-control input-sm" placeholder="First Name (Given Name)">
                                                </div>
                                            </div>
                                        </td>                                    
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Address </label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_address" id="employer_address" value="<?php echo $row->employer_address; ?>" class="form-control input-sm" placeholder="Address">
                                                </div>
                                            </div>
                                        </td>                                   
                                        <td colspan="2">  
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">City or Town</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_city" id="employer_city" value="<?php echo $row->employer_city; ?>" class="form-control input-sm" placeholder="City or Town">
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="1">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">State</label><br/>
                                                <div class="col-sm-12">
                                                    <select name="employer_state" id="employer_state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                        <option></option>
                                                        <?php
                                                        $state_query = $this->Common_model->listItem('main_state');
                                                        foreach ($state_query->result() as $keyy):
                                                            ?>
                                                            <option value="<?php echo $keyy->id ?>"<?php if ($row->employer_state == $keyy->id) echo 'selected' ?>><?php echo $keyy->state_abbr ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>                                    
                                        <td colspan="1">
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Zip Code</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employer_zip_code" id="employer_zip_code" value="<?php echo $row->employer_zip_code; ?>" class="form-control input-sm" placeholder="Zip Code">
                                                </div>
                                            </div>
                                        </td>                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3"> 
                                            <h5>
                                                <b>Section 3. Reverification and Rehires </b> (To be completed and signed by employer or authorized representative)
                                            </h5>                                
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-md-12">
                                                <div class="col-md-5">
                                                    <label class="col-sm-12">A. New Name(if applicable)Last Name (Family Name):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="rehire_last_name" id="rehire_last_name" value="<?php echo $row->rehire_last_name; ?>" class="form-control input-sm" placeholder="Family Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-sm-12">First Name (Given name):</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="rehire_first_name" id="rehire_first_name" class="form-control input-sm" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="col-sm-12">Middle Initial:</label><br/>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="rehire_middle_initial" id="rehire_middle_initial" value="<?php echo $row->rehire_middle_initial; ?>" class="form-control input-sm" placeholder="Middle Initial">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12"> B. Date of Rehire(mm/dd/yyyy)</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_date" id="rehire_date" value="<?php echo $this->Common_model->show_date_formate($row->rehire_date); ?>" class="form-control input-sm dt_pick" placeholder="Date">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3"> 
                                            <h5>
                                                C. If employees previous grant of employment authorization has expired, provide the information for the document from List A or List C the employee
                                                presented the establish current employment authorization in the spade provided below.
                                            </h5>                                
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Title:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_document_title" id="rehire_document_title" value="<?php echo $row->rehire_document_title; ?>" class="form-control input-sm" placeholder="Document Title">
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Document Number:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_document_number" id="rehire_document_number" value="<?php echo $row->rehire_document_number; ?>" class="form-control input-sm" placeholder="Document Number">
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Expiration Date(If any)(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_expiration_date" id="rehire_expiration_date" value="<?php echo $this->Common_model->show_date_formate($row->rehire_expiration_date); ?>" class="form-control input-sm dt_pick" placeholder="Expiration Date">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>
                            <b>I attest, under penalty of perjury, that to the best of my knowledge, this employee is authorized to work in the United States, and if
                                the employee presented document(s), the document(s) I have examined appear to be genuine and to relate to the individual.</b>
                        </h5>

                        <div class="table-responsive">          
                            <table class="table">

                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Signature of Employer or Authorized Representative:</label><br/>
                                                <div class="col-sm-12">
        <!--                                                <input type="text" name="other_name" id="other_name" class="form-control input-sm" placeholder="Signature">-->
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Date(mm/dd/yyyy):</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_signature_date" id="rehire_signature_date" value="<?php echo $this->Common_model->show_date_formate($row->rehire_signature_date); ?>" class="form-control input-sm dt_pick" placeholder="Date">
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <div class="form-group no-margin">
                                                <label class="col-sm-12">Print Name of Employer or Authorized Representative:</label><br/>
                                                <div class="col-sm-12">
                                                    <input type="text" name="rehire_authorized_representative" id="rehire_authorized_representative" value="<?php echo $row->rehire_authorized_representative; ?>" class="form-control input-sm" placeholder="Authorized Representative">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div> 

                        <div class="col-sm-12">
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-u"> Prepare I-9 </button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_ObI9" ?>">Close</a>
                            </div>
                        </div>                   
                    <?php endforeach; ?>
                </form>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>
    
    function set_ob_emp(id){
        
        $.ajax({
            url: "<?php echo site_url('Con_ObI9/set_ob_emp/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                $('#onboarding_employee').html('');
                $('#onboarding_employee').empty();
                
                $('#onboarding_employee').html(data);
                
                $("#onboarding_employee").select2({
                    placeholder: "Select Candidate",
                    allowClear: true,
                });
            }
        });
    }

    $(function () {

        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                alert(data);
                var url = '<?php echo base_url() ?>Con_ObI9';
                view_message(data, url, '', 'sky-form11');
            });
            event.preventDefault();
        });
    });

    $("#ob_eeo_type").select2({
        placeholder: "Select Type",
        allowClear: true,
    });
    
    $("#onboarding_employee").select2({
        placeholder: "Select Candidate",
        allowClear: true,
    });

    $("#state").select2({
        placeholder: "Select state",
        allowClear: true,
    });
    $("#con_state").select2({
        placeholder: "Select state",
        allowClear: true,
    });
    $("#employer_state").select2({
        placeholder: "Select state",
        allowClear: true,
    });

    $(function () {
        $("#zip_code").mask("99999");
        $("#con_zip_code").mask("99999");
        $("#employer_zip_code").mask("99999");
        $("#us_ssn").mask("999-99-9999");
        $("#telephone_number").mask("(999) 999-9999");
    });

</script>
<!--=== End Script ===-->

