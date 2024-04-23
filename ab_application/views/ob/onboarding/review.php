<style>
    .obrevtbl > thead > tr {
        background-color: #dff0d8;
        color: #3c763d;
    }
</style>

<?php
$relationship_array = $this->Common_model->get_array('relationship_array');
if ($type == 1) {

    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
    ?>
    <form id="save_onboarding_submition_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/submit_onboarding_data" enctype="multipart/form-data" role="form">

        <div id="review_div_save_id">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-u" id="review_1">
                        <div class="panel-heading">
                            Onboarding Review
                        </div>
                        <div class="panel-body">
                            <?php
                            $personal_info_query = $this->db->get_where('main_ob_personal_information', array('onboarding_employee_id' => $ob_emp_id));
                            $gender_array = $this->Common_model->get_array('gender');
                            $marit_array = $this->Common_model->get_array('marital_status');
                            $Grad_array = $this->Common_model->get_array('yes_no');
                            $paid_arrey = $this->Common_model->get_array('yes_no');
                            foreach ($personal_info_query->result() as $prow) {
                                ?>
                                <input type="hidden" value="<?php echo $prow->onboarding_employee_id ?>" name="ob_revieu_emp_id" id="ob_revieu_emp_id"/>


                                <div class="table-responsive overflow-x">
                                    Personal Information:
                                    <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>First Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_firstname); ?></td>
                                                <th>Middle Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_middlename); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Last Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_lastname); ?></td>
                                                <th>Date of Birth : </th>
                                                <td><?php echo $this->Common_model->show_date_formate($prow->onboarding_dateofbirth); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Social Security Number : </th>
                                                <td><?php echo $number = "XXX-XX-" . substr($prow->onboarding_socialsecuritynumber, -4); ?></td>
                                                <th>Maiden Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_maidenname); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Suffix : </th>
                                                <td><?php echo ucwords($prow->onboarding_suffix); ?></td>
                                                <th>Gender :</th>
                                                <td><?php 
                                                //echo $prow->gender == 0 ? 'Not Define' : $gender_array[$prow->gender];
                                                if($prow->gender==0 || $prow->gender=="" || $prow->gender==null)
                                                {
                                                    echo "Not Define";
                                                }  else {
                                                   echo $gender_array[$prow->gender]; 
                                                }
                                                ?></td>
                                            </tr>
        <!--                                            <tr>
                                                <th>Marital Status : </th>
                                                <td><?php // echo $marit_array[$prow->marital_status];    ?></td>
                                                <th></th>
                                                <td></td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>

                                <?php
                            } $contact_information_query = $this->db->get_where('main_ob_contact_information', array('onboarding_employee_id' => $ob_emp_id));
                            foreach ($contact_information_query->result() as $conkey) {
                                ?>  
                                <div class="table-responsive overflow-x">
                                    Contact Information:
                                    <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Email Address : </th>
                                                <td><?php echo $conkey->email_address; ?></td>
                                                <th>Home Phone : </th>
                                                <td><?php echo $conkey->home_phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Phone : </th>
                                                <td><?php echo $conkey->mobile_phone; ?></td>
                                                <th>Work Phone : </th>
                                                <td><?php echo $conkey->work_phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Street Address 1 : </th>
                                                <td><?php echo ucwords($conkey->street_address1); ?></td>
                                                <th>Street Address 2 : </th>
                                                <td><?php echo ucwords($conkey->street_address2); ?></td>
                                            </tr>
                                            <tr>
                                                <th>City : </th> 
                                                <td><?php echo ucwords($conkey->city); ?></td>
                                                <th>State : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $conkey->state, 'main_state', 'state_name'); ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>County :</th>
                                                <td><?php echo $this->Common_model->get_name($this, $conkey->county, 'main_county', 'county_name'); ?></td>
                                                <th>Zip Code :</th>
                                                <td><?php echo $conkey->zipcode; ?></td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                

                                <?php
                            }$emergency_contact = $this->db->get_where(' main_ob_emergencycontact', array('onboarding_employee_id' => $ob_emp_id));
                            foreach ($emergency_contact->result() as $emkey) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    Emergency contact:
                                    <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>First Name :</th>
                                                <td><?php echo ucwords($emkey->first_name); ?></td>
                                                <th>Last Name :</th>
                                                <td><?php echo ucwords($emkey->last_name); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Relationship With Employee :</th>
                                                <td><?php echo $relationship_array[$emkey->relationship_with_employee] ?></td>
                                                <th>Primary Phone :</th>
                                                <td><?php echo $emkey->primary_phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Secondary Phone :</th>
                                                <td><?php echo $emkey->secondary_phone; ?></td>
                                                <th>Address :</th>
                                                <td><?php echo ucwords($emkey->address); ?></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>                                

                                <?php
                            }$employmenthistory_query = $this->db->get_where('main_ob_employmenthistory', array('onboarding_employee_id' => $ob_emp_id));
                            if ($employmenthistory_query) {
                                ?> 
                                <div class="table-responsive overflow-x">
                                    Employment History:
                                    <table id="employmenthistory" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Employee</th>
                                                <th>Position</th>                                            
                                                <th>Phone No</th>                                            
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Supervisor Name</th>
                                                <th>Starting Compensation</th>
                                                <th>Ending Compensation</th>
                                                <th>Contact Previous Employer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sla = 0;
                                            foreach ($employmenthistory_query->result() as $hrow) {
                                                $sla++;
                                                $pdt = $hrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $sla . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($hrow->employer) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $hrow->position . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $hrow->phone_no . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->start_date) . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->end_date) . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $hrow->supervisor_name . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $hrow->starting_compensation . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $hrow->ending_compensation . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . (($hrow->reason_for_leaving == 0) ? 'Not Define' : $cpe[$hrow->reason_for_leaving]) . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }$reference_query = $this->db->get_where('main_ob_reference', array('onboarding_employee_id' => $ob_emp_id));
                            if ($reference_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    Reference:
                                    <table id="reference" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL </th>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $relationship_array = $this->Common_model->get_array('relationship_array');
                                            $slb = 0;
                                            foreach ($reference_query->result() as $refrow) {
                                                $slb++;
                                                $pdt = $refrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $slb . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($refrow->name) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $relationship_array[$refrow->relationship] . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $refrow->reference_email . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $refrow->phone_number . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $refrow->address . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div> 
                                <?php
                            }$education_query = $this->db->get_where('main_ob_education', array('onboarding_employee_id' => $ob_emp_id));
                            if ($education_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    Education:
                                    <table id="education" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Education Level</th>
                                                <th>Institution Name</th>
                                                <th>No Of Years</th>                                            
                                                <th>Graduated</th>                                            
                                                <th>Remarks</th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $slc = 0;
                                            foreach ($education_query->result() as $edurow) {
                                                $slc++;
                                                $pdt = $edurow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $slc . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $edurow->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($edurow->institution_name) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $edurow->no_of_years . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . (($edurow->graduated == 0) ? 'Not Define' : $Grad_array[$edurow->graduated]) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $edurow->edu_remarks . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?PHP
                            }$offense_type_array = $this->Common_model->get_array('offense_type');
                            $criminalhistory_query = $this->db->get_where('main_ob_criminalhistory', array('onboarding_employee_id' => $ob_emp_id));
                            if ($criminalhistory_query) {
                                ?>    
                                <div class="table-responsive overflow-x">
                                    Criminal History:
                                    <table id="criminalhistory" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Offense Type</th>
                                                <th>Offense</th>
                                                <th>Date</th>
                                                <th>City</th>
                                                <th>County</th>
                                                <th>State</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sld = 0;
                                            foreach ($criminalhistory_query->result() as $crrow) {
                                                $sld++;
                                                $pdt = $crrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $sld . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $offense_type_array[$crrow->offense_type] . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($crrow->offense) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($crrow->offense_date) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($crrow->city) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->county, 'main_county', 'county_name') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->offense_state, 'main_state', 'state_name') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $crrow->description . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }$amount_type_array = $this->Common_model->get_array('amount_type');
                            $directdeposit_query = $this->db->get_where('main_ob_direct_deposit', array('onboarding_employee_id' => $ob_emp_id));
                            if ($directdeposit_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    Direct Deposit:
                                    <table id="directdeposit" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Bank Name</th>
                                                <th>Account Number</th>
                                                <th>Routing Number</th>
                                                <th>Account Type</th>
                                                <th>Amount Type</th>
                                                <th>Value</th>
                                                <th>Paid as Live Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($directdeposit_query->result() as $dirrow) {
                                                if ($dirrow->amount_type == 0) {
                                                    $amount_type = "";
                                                } else {
                                                    $amount_type = $amount_type_array[$dirrow->amount_type];
                                                }
                                                $pdt = $dirrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $dirrow->id . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($dirrow->bank_name) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $dirrow->account_number . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $dirrow->routing_number . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $dirrow->account_type, 'main_bank_account_types', 'bank_account_type') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $amount_type . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $dirrow->acc_value . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . (($dirrow->paid_check == 0) ? 'Not Define' : $paid_arrey[$dirrow->paid_check]) . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> 
                                <?php
                            }
                            ?>    
                            <div class="table-responsive overflow-x">
                                Company Policy:

                                    <?php
                                    if ($this->user_group == 11 || $this->user_group == 12) {
                                        $main_company_policies_query = $this->db->get_where('main_company_policies', array('company_id' => $this->company_id));
                                    } else {
                                        $main_company_policies_query = $this->Common_model->listItem('main_company_policies');
                                    }

                                    if(empty($main_company_policies_query->result())){
                                        echo "Please fill up Company Policy Tab information";
                                    }
                                    ?>
                                <table id="companypolicies" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Policy Name</th>                                            
                                            <th style="width: 40%; " >Policy</th>                                            
                                            <th>Status</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $i = 0;
                                        if ($main_company_policies_query) {
                                            foreach ($main_company_policies_query->result() as $comrow) {
                                                $obquery = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id, 'policy_id' => $comrow->id))->row();
                                                $eg_chk = "";
                                                $deg_chk = "";
                                                if ($obquery) {
                                                    if ($obquery->is_aggree == 1) {
                                                        $eg_chk = "Agree";
                                                    } else if ($obquery->is_aggree == 0) {
                                                        $eg_chk = "DisAgree";
                                                    } else {
                                                        $eg_chk = "Agree";
                                                    }
                                                } else {
                                                    $eg_chk = "Agree";
                                                }
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo ucwords($comrow->policy_name) ?> </td>                                                    
                                                    <td><?php echo ucwords($comrow->custom_text) ?> </td>
                                                    <td><?php echo $eg_chk ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>   
                            <?php
                            $query_enrolling = $this->db->get_where('main_ob_enrolling', array('onboarding_employee_id' => $ob_emp_id));
                            if ($query_enrolling) {
                                ?>
                                <div class="table-responsive overflow-x">
                                    Enrolling:
                                    <?php
                                    if(empty($query_enrolling->result())){
                                        echo "<div style='font-size: 10px; color: red; text_align: right;'>Please fill up Enrolling Tab information</div>";
                                    }
                                    ?>
                                    <table id="benefit" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Relationship</th>
                                                <th>Gender</th>
                                                <th>Date Of Birth</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $gender_array = $this->Common_model->get_array('gender');
                                            foreach ($query_enrolling->result() as $rowen) {
                                                $i++;
                                                $pdt = $rowen->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowen->fast_name . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowen->last_name . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $rowen->relationship, 'main_relationship_status', 'relationship_status') . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $gender_array[$rowen->gender] . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($rowen->date_of_birth) . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            $query_benefit = $this->db->get_where('main_ob_benefit', array('onboarding_employee_id' => $ob_emp_id));
                            if ($query_benefit) {
                                ?>
                                <div class="table-responsive overflow-x">
                                    Benefit:
                                    <?php
                                    if(empty($query_benefit->result())){
                                        echo "<div style='font-size: 10px; color: red; text_align: right;'>Please fill up Benefit Tab information</div>";
                                    }
                                    ?>
                                    <table id="benefit" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Enrolling</th>
                                                <th>Provider</th>
                                                <th>Benefit Type</th>
                                                <th>Eligible Date</th>
                                                <th>Enrolled Date</th>
                                                <!--<th>Amount Type</th>-->
                                                <th>Employee Portion</th>
                                                <th>Employer Portion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($query_benefit->result() as $rowfn) {
                                                $i++;
                                                $pdt = $rowfn->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->enrolling, 'main_ob_enrolling', 'fast_name') . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($rowfn->eligible_date) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($rowfn->enrolled_date) . "</td>";
                                                //print"<td id='catE" . $pdt . "'>" . (($rowfn->amount_type == 0) ? 'Not Define' : $amount_type_array[$rowfn->amount_type]) . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowfn->employee_portion . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowfn->employer_portion . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }$eeo_query = $this->db->get_where('main_ob_eeo_policies', array('onboarding_employee_id' => $ob_emp_id))->row();
                            if ($eeo_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    EEO:
                                    <div class = "page-header no-margin">
                                        <h1>
                                            <small>Self Identification (eeoc)</small>
                                        </h1>
                                    </div>
                                    <table id="eeo" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Race/Ethnicity :</th> 
                                                <td><?php echo $this->Common_model->get_name($this, $eeo_query->policy_id, 'main_eeoc_categories', 'eeoc_categories'); ?></td>
                                            </tr>
                                        </tbody> 
                                    </table>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>        
            </div>        
            <div class="modal-footer">
                <div class="col-md-6 col-sm-6 find_mar" style="text-align: left;">                    
                    <input class="btn btn-default" type='button' id='btn' value='Print' onclick='printDiv1();'>
                </div>
                <div class="col-md-6 col-sm-6 find_mar" style="text-align: right;">
                    <button type="submit" id="submit" class="btn btn-u">Submit</button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Onboarding" ?>">Cancel</a>
                </div>
                
            </div>

        </div> 
    </form>

    <?php
} else if ($type == 2) {
    ?>

    <form id="onboarding_submition_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/submit_onboarding_data" enctype="multipart/form-data" role="form">

        <div id="review_div">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-u" id="review_2">
                        <div class="panel-heading">
                            Onboarding Review
                        </div>
                        <div class="panel-body">
                            <?php
                            $personal_info_query = $this->db->get_where('main_ob_personal_information', array('onboarding_employee_id' => $ob_emp_id));
                            $gender_array = $this->Common_model->get_array('gender');
                            $marit_array = $this->Common_model->get_array('marital_status');
                            $Grad_array = $this->Common_model->get_array('yes_no');
                            $paid_arrey = $this->Common_model->get_array('yes_no');
                            foreach ($personal_info_query->result() as $prow) {
                                ?>
                                <input type="hidden" value="<?php echo $prow->onboarding_employee_id ?>" name="ob_revieu_emp_id" id="ob_revieu_emp_id"/>

                                <div class="table-responsive overflow-x">
                                    Personal Information:
                                    <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>First Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_firstname); ?></td>
                                                <th>Middle Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_middlename); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Last Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_lastname); ?></td>
                                                <th>Date of Birth : </th>
                                                <td><?php echo $this->Common_model->show_date_formate($prow->onboarding_dateofbirth); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Social Security Number : </th>
                                                <td><?php echo $number = "XXX-XX-" . substr($prow->onboarding_socialsecuritynumber, -4); ?></td>
                                                <th>Maiden Name : </th>
                                                <td><?php echo ucwords($prow->onboarding_maidenname); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Suffix : </th>
                                                <td><?php echo ucwords($prow->onboarding_suffix); ?></td>
                                                <th>Gender :</th>
                                                <td><?php echo $prow->gender == 0 ? 'Not Define' : $gender_array[$prow->gender]; ?></td>
                                            </tr>
        <!--                                            <tr>
                                                <th>Marital Status : </th>
                                                <td><?php
//                                                    if ($prow->marital_status == 0)
                                            echo "";
//                                                    else
//                                                        echo $marit_array[$prow->marital_status];
                                            ?></td>
                                                <th></th>
                                                <td></td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>

                                <?php
                            }$contact_information_query = $this->db->get_where('main_ob_contact_information', array('onboarding_employee_id' => $ob_emp_id));
                            foreach ($contact_information_query->result() as $conkey) {
                                ?> 
                                <div class="table-responsive overflow-x">
                                    Contact Information:
                                    <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Email Address : </th>
                                                <td><?php echo $conkey->email_address; ?></td>
                                                <th>Home Phone : </th>
                                                <td><?php echo $conkey->home_phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Phone : </th>
                                                <td><?php echo $conkey->mobile_phone; ?></td>
                                                <th>Work Phone : </th>
                                                <td><?php echo $conkey->work_phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Street Address 1 : </th>
                                                <td><?php echo ucwords($conkey->street_address1); ?></td>
                                                <th>Street Address 2 : </th>
                                                <td><?php echo ucwords($conkey->street_address2); ?></td>
                                            </tr>
                                            <tr>
                                                <th>City : </th> 
                                                <td><?php echo ucwords($conkey->city); ?></td>
                                                <th>State : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $conkey->state, 'main_state', 'state_name'); ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>County :</th>
                                                <td><?php echo $this->Common_model->get_name($this, $conkey->county, 'main_county', 'county_name'); ?></td>
                                                <th>Zip Code :</th>
                                                <td><?php echo $conkey->zipcode; ?></td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                

                                <?php
                            }$emergency_contact = $this->db->get_where(' main_ob_emergencycontact', array('onboarding_employee_id' => $ob_emp_id));
                            foreach ($emergency_contact->result() as $emkey) {
                                ?>    
                                <div class="table-responsive overflow-x">
                                    Emergency contact:
                                    <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>First Name :</th>
                                                <td><?php echo ucwords($emkey->first_name); ?></td>
                                                <th>Last Name :</th>
                                                <td><?php echo ucwords($emkey->last_name); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Relationship With Employee :</th>
                                                <td><?php echo(($emkey->relationship_with_employee) ? 'Not Define' : $relationship_array[$emkey->relationship_with_employee]) ?></td>
                                                <th>Primary Phone :</th>
                                                <td><?php echo $emkey->primary_phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Secondary Phone :</th>
                                                <td><?php echo $emkey->secondary_phone; ?></td>
                                                <th>Address :</th>
                                                <td><?php echo ucwords($emkey->address); ?></td>
                                            </tr>                                          

                                        </tbody>
                                    </table>
                                </div> 

                                <?php
                            }$employmenthistory_query = $this->db->get_where('main_ob_employmenthistory', array('onboarding_employee_id' => $ob_emp_id));
                            if ($employmenthistory_query) {
                                ?>    
                                <div class="table-responsive overflow-x">
                                    Employment History:
                                    <table id="employmenthistory" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Employee</th>
                                                <th>Position</th>                                            
                                                <th>Phone No</th>                                            
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Supervisor Name</th>
                                                <th>Starting Compensation</th>
                                                <th>Ending Compensation</th>
                                                <th>Contact Previous Employer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sla = 0;
                                            foreach ($employmenthistory_query->result() as $hrow) {
                                                $sla++;
                                                $pdt = $hrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $sla . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($hrow->employer) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $hrow->position . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $hrow->phone_no . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->start_date) . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->end_date) . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $hrow->supervisor_name . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $hrow->starting_compensation . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $hrow->ending_compensation . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . (($hrow->reason_for_leaving == 0) ? 'Not Define' : $cpe[$hrow->reason_for_leaving]) . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }$reference_query = $this->db->get_where('main_ob_reference', array('onboarding_employee_id' => $ob_emp_id));
                            if ($reference_query) {
                                ?>    
                                <div class="table-responsive overflow-x">
                                    Reference:
                                    <table id="reference" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL </th>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $relationship_array = $this->Common_model->get_array('relationship_array');
                                            $slb = 0;
                                            foreach ($reference_query->result() as $refrow) {
                                                $slb++;
                                                $pdt = $refrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $slb . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($refrow->name) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $relationship_array[$refrow->relationship] . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $refrow->reference_email . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $refrow->phone_number . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $refrow->address . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div> 
                                <?php
                            }$education_query = $this->db->get_where('main_ob_education', array('onboarding_employee_id' => $ob_emp_id));
                            if ($education_query) {
                                ?>  

                                <div class="table-responsive overflow-x">
                                    Education:
                                    <table id="education" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Education Level</th>
                                                <th>Institution Name</th>
                                                <th>No Of Years</th>                                            
                                                <th>Graduated</th>                                            
                                                <th>Remarks</th>                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $slc = 0;
                                            foreach ($education_query->result() as $edurow) {
                                                $slc++;
                                                $pdt = $edurow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $slc . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $edurow->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($edurow->institution_name) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $edurow->no_of_years . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . (($edurow->graduated == 0) ? 'Not Define' : $Grad_array[$edurow->graduated]) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $edurow->edu_remarks . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?PHP
                            }$offense_type_array = $this->Common_model->get_array('offense_type');
                            $criminalhistory_query = $this->db->get_where('main_ob_criminalhistory', array('onboarding_employee_id' => $ob_emp_id));
                            if ($criminalhistory_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    Criminal History:
                                    <table id="criminalhistory" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Offense Type</th>
                                                <th>Offense</th>
                                                <th>Date</th>
                                                <th>City</th>
                                                <th>County</th>
                                                <th>State</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sld = 0;
                                            foreach ($criminalhistory_query->result() as $crrow) {
                                                $sld++;
                                                $pdt = $crrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $sld . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $offense_type_array[$crrow->offense_type] . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($crrow->offense) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($crrow->offense_date) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($crrow->city) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->county, 'main_county', 'county_name') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->offense_state, 'main_state', 'state_name') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $crrow->description . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }$amount_type_array = $this->Common_model->get_array('amount_type');
                            $directdeposit_query = $this->db->get_where('main_ob_direct_deposit', array('onboarding_employee_id' => $ob_emp_id));
                            if ($directdeposit_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    Direct Deposit:
                                    <table id="directdeposit" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Bank Name</th>
                                                <th>Account Number</th>
                                                <th>Routing Number</th>
                                                <th>Account Type</th>
                                                <th>Amount Type</th>
                                                <th>Value</th>
                                                <th>Paid as Live Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($directdeposit_query->result() as $dirrow) {
                                                if ($dirrow->amount_type == 0) {
                                                    $amount_type = "";
                                                } else {
                                                    $amount_type = $amount_type_array[$dirrow->amount_type];
                                                }
                                                $pdt = $dirrow->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $dirrow->id . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . ucwords($dirrow->bank_name) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $dirrow->account_number . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $dirrow->routing_number . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $dirrow->account_type, 'main_bank_account_types', 'bank_account_type') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $amount_type . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $dirrow->acc_value . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . (($dirrow->paid_check == 0) ? 'Not Define' : $paid_arrey[$dirrow->paid_check]) . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> 
                                <?php
                            }
                            ?>    

                            <div class="table-responsive overflow-x">
                                Company Policy:
                                <table id="companypolicies" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Policy Name</th>                                            
                                            <th style="width: 40%; " >Policy</th>                                            
                                            <th>Status</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($this->user_group == 11 || $this->user_group == 12) {
                                            $main_company_policies_query = $this->db->get_where('main_company_policies', array('company_id' => $this->company_id));
                                        } else {
                                            $main_company_policies_query = $this->Common_model->listItem('main_company_policies');
                                        }
                                        $i = 0;
                                        if ($main_company_policies_query) {
                                            foreach ($main_company_policies_query->result() as $comrow) {
                                                $obquery = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id, 'policy_id' => $comrow->id))->row();
                                                $eg_chk = "";
                                                $deg_chk = "";
                                                if ($obquery) {
                                                    if ($obquery->is_aggree == 1) {
                                                        $eg_chk = "Agree";
                                                    } else if ($obquery->is_aggree == 0) {
                                                        $eg_chk = "DisAgree";
                                                    } else {
                                                        $eg_chk = "Agree";
                                                    }
                                                } else {
                                                    $eg_chk = "Agree";
                                                }
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo ucwords($comrow->policy_name) ?> </td>                                                    
                                                    <td><?php echo ucwords($comrow->custom_text) ?> </td>
                                                    <td><?php echo $eg_chk ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>    

                            <?php
                            $query_enrolling = $this->db->get_where('main_ob_enrolling', array('onboarding_employee_id' => $ob_emp_id));
                            if ($query_enrolling) {
                                ?>
                                <div class="table-responsive overflow-x">
                                    Enrolling:
                                    <table id="benefit" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Relationship</th>
                                                <th>Gender</th>
                                                <th>Date Of Birth</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $gender_array = $this->Common_model->get_array('gender');
                                            foreach ($query_enrolling->result() as $rowen) {
                                                $i++;
                                                $pdt = $rowen->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowen->fast_name . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowen->last_name . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $rowen->relationship, 'main_relationship_status', 'relationship_status') . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $gender_array[$rowen->gender] . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($rowen->date_of_birth) . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            $query_benefit = $this->db->get_where('main_ob_benefit', array('onboarding_employee_id' => $ob_emp_id));
                            if ($query_benefit) {
                                ?>
                                <div class="table-responsive overflow-x">
                                    Benefit:
                                    <table id="benefit" class="table table-responsive table-striped table-bordered table-hover obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Enrolling</th>
                                                <th>Provider</th>
                                                <th>Benefit Type</th>
                                                <th>Eligible Date</th>
                                                <th>Enrolled Date</th>
                                                <!--<th>Amount Type</th>-->
                                                <th>Employee Portion</th>
                                                <th>Employer Portion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $amount_type_array = $this->Common_model->get_array('amount_type');
                                            $i = 0;
                                            foreach ($query_benefit->result() as $rowfn) {
                                                $i++;
                                                $pdt = $rowfn->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->enrolling, 'main_ob_enrolling', 'fast_name') . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($rowfn->eligible_date) . "</td>";
                                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($rowfn->enrolled_date) . "</td>";
                                                //print"<td id='catE" . $pdt . "'>" . (($rowfn->amount_type == 0) ? 'Not Define' : $amount_type_array[$rowfn->amount_type]) . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowfn->employee_portion . "</td>";
                                                print"<td id='catB" . $pdt . "'>" . $rowfn->employer_portion . "</td>";
                                                print"</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            $eeo_query = $this->db->get_where('main_ob_eeo_policies', array('onboarding_employee_id' => $ob_emp_id))->row();
                            if ($eeo_query) {
                                ?>   
                                <div class="table-responsive overflow-x">
                                    EEO:
                                    <div class = "page-header no-margin">
                                        <h1>
                                            <small>Self Identification (eeoc)</small>
                                        </h1>
                                    </div>
                                    <table id="eeo" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Race/Ethnicity :</th> 
                                                <td><?php echo $this->Common_model->get_name($this, $eeo_query->policy_id, 'main_eeoc_categories', 'eeoc_categories'); ?></td>
                                            </tr>
                                        </tbody> 

                                    </table>

                                </div>
                                <?php
                            }
                            ?> 
                        </div>
                    </div>
                </div>        
            </div>

            <div class="modal-footer">
                <div class="col-md-6 col-sm-6 find_mar" style="text-align: left;">                    
                    <input class="btn btn-default" type='button' id='btn' value='Print' onclick='printDiv2();'>
                </div>
                <div class="col-md-6 col-sm-6 find_mar" style="text-align: right;">
                    <button type="submit" id="submit" class="btn btn-u">Submit</button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_onboarding_list" ?>">Cancel</a>
                </div>
                
            </div>

        </div>
    </form>

    <?php
}
?>


<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right disabled" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>

<script>
    function printDiv1() {
        $.print("#review_1");
    }
    ;
    function printDiv2() {
        $.print("#review_2");
    }
    ;

</script>