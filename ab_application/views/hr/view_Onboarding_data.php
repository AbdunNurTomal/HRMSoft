<style>
    .obrevtbl > thead > tr {
        background-color: #dff0d8;
        color: #3c763d;
    }
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 90%; padding-bottom: 15px; padding-top: 15px; padding-left: 15px; padding-right: 15px;"> <!-- container well div -->

            <div id="review_div">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-u" id="print_review">
                            <div class="panel-heading">
                                Onboarding Information
                            </div>
                            <div class="panel-body">
                                <?php
                                $personal_info_query = $this->db->get_where('main_ob_personal_information', array('onboarding_employee_id' => $ob_emp_id));
                                $gender_array = $this->Common_model->get_array('gender');
                                $marit_array = $this->Common_model->get_array('marital_status');
                                foreach ($personal_info_query->result() as $prow) {
                                    ?>
                                    <input type="hidden" value="<?php echo $prow->onboarding_employee_id ?>" name="ob_revieu_emp_id" id="ob_revieu_emp_id"/>

                                    <div class="table-responsive">
                                        Personal Information:<br>
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
                                                    <td><?php echo ucwords($prow->gender); ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>                                

                                    <?php
                                }$contact_information_query = $this->db->get_where('main_ob_contact_information', array('onboarding_employee_id' => $ob_emp_id));
                                foreach ($contact_information_query->result() as $conkey) {
                                    ?> 
                                    <div class="table-responsive">
                                        Contact Information:<br>
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
                                    <div class="table-responsive">
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
                                                    <td><?php echo $this->Common_model->get_name($this, $emkey->relationship_with_employee, 'main_relationship_status', 'relationship_status'); ?></td>
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
                                $cpe= $this->Common_model->get_array('yes_no');    
                                if ($employmenthistory_query) {
                                    ?>        
                                    <div class="table-responsive">
                                        Employment History:
                                        <table id="employmenthistory" class="table table-striped table-bordered dt-responsive nowrap obrevtbl">
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
                                                $sla=0;
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
                                                    print"<td id='catE" . $pdt . "'>" . (($hrow->reason_for_leaving==0)?'Not Define':$cpe[$hrow->reason_for_leaving]) . "</td>";
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
                                    <div class="table-responsive">
                                        Reference:
                                        <table id="reference" class="table table-striped table-bordered dt-responsive nowrap obrevtbl">
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
                                                $slb=0;
                                                foreach ($reference_query->result() as $refrow) {
                                                    $slb++;
                                                    $pdt = $refrow->id;
                                                    print"<tr>";
                                                    print"<td id='catA" . $pdt . "'>" . $slb . "</td>";
                                                    print"<td id='catE" . $pdt . "'>" . ucwords($refrow->name) . "</td>";
                                                    print"<td id='catE" . $pdt . "'>" . (($refrow->relationship == 0) ? 'Not Define' : $relationship_array[$refrow->relationship]) . "</td>";
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
                                $Grad_arrey= $this->Common_model->get_array('yes_no');
                                if ($education_query) {
                                    ?>      
                                    <div class="table-responsive">
                                        Education:
                                        <table id="education" class="table table-striped table-bordered dt-responsive nowrap obrevtbl">
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
                                                $slc=0;
                                                foreach ($education_query->result() as $edurow) {
                                                    $slc++;
                                                    $pdt = $edurow->id;
                                                    print"<tr>";
                                                    print"<td id='catA" . $pdt . "'>" . $slc . "</td>";
                                                    print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $edurow->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                                    print"<td id='catE" . $pdt . "'>" . ucwords($edurow->institution_name) . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $edurow->no_of_years . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . (($edurow->graduated==0)?'Not Define':$Grad_arrey[$edurow->graduated]) . "</td>";
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
                                    <div class="table-responsive">
                                        Criminal History:
                                        <table id="criminalhistory" class="table table-striped table-bordered dt-responsive nowrap obrevtbl">
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
                                                $sld=0;
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
                                $paid_arrey= $this->Common_model->get_array('yes_no');
                                $directdeposit_query = $this->db->get_where('main_ob_direct_deposit', array('onboarding_employee_id' => $ob_emp_id));
                                if ($directdeposit_query) {
                                    ?>
                                    <div class="table-responsive">
                                        Direct Deposit:
                                        <table id="directdeposit" class="table table-striped table-bordered dt-responsive nowrap obrevtbl">
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
                                                $sle=0;
                                                foreach ($directdeposit_query->result() as $dirrow) {
                                                    $sle++;
                                                    $pdt = $dirrow->id;
                                                    print"<tr>";
                                                    print"<td id='catA" . $pdt . "'>" . $sle . "</td>";
                                                    print"<td id='catE" . $pdt . "'>" . ucwords($dirrow->bank_name) . "</td>";
                                                    print"<td id='catE" . $pdt . "'>" . $dirrow->account_number . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $dirrow->routing_number . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $dirrow->account_type, 'main_bank_account_types', 'bank_account_type') . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . (($dirrow->amount_type==0)?'Not Define':$amount_type_array[$dirrow->amount_type]) . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $dirrow->acc_value . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . (($dirrow->paid_check==0)?'Not Define':$paid_arrey[$dirrow->paid_check]) . "</td>";
                                                    print"</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> 
                                    <?php
                                }
                                ?>      
                                <div class="table-responsive">
                                    Company Policy:
                                    <table id="dataTables-example-companypolicies" class="table table-striped table-bordered dt-responsive nowrap obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Policy Name</th>
                                                <th style="width: 40%; " >Policy</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $po_query = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id));
                                            if ($po_query) {
                                                foreach ($po_query->result() as $comrow) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $this->Common_model->get_name($this, $comrow->policy_id, 'main_company_policies', 'policy_name'); ?> </td>
                                                        <td class="td-cw"><?php echo $this->Common_model->get_name($this, $comrow->policy_id, 'main_company_policies', 'custom_text');  ?> </td>
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
                                    <div class="table-responsive">
                                        Enrolling:
                                        <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
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
                                $amount_type_array = $this->Common_model->get_array('amount_type');
                                $query_benefit = $this->db->get_where('main_ob_benefit', array('onboarding_employee_id' => $ob_emp_id));
                                if ($query_benefit) {
                                    ?>
                                    <div class="table-responsive">
                                        Benefit:
                                        <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Enrolling</th>
                                                    <th>Provider</th>
                                                    <th>Benefit Type</th>
                                                    <th>Eligible Date</th>
                                                    <th>Enrolled Date</th>
<!--                                                    <th>Amount Type</th>-->
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
//                                                    print"<td id='catE" . $pdt . "'>" . (($rowfn->amount_type==0)?'Not Define':$amount_type_array[$rowfn->amount_type]) . "</td>";
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
                                    <div class="table-responsive">
                                        <div class = "page-header no-margin">
                                            <h1>
                                                <small>Self Identification (eeoc) : </small>
                                            </h1>
                                        </div>
                                        <table id="" class="table table-striped dt-responsive nowrap">
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
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Onboarding_Information" ?>">Close</a>
                    </div>
                    <?php 
                    $status=$this->Common_model->get_selected_value($this,'onboarding_employee_id',$ob_emp_id,'main_ob_send_mail','status');
                    ?>
                    <div class="col-md-6 col-sm-6 find_mar" style="text-align: right;"> 
                        <button id="hbutt_<?php  echo $status; ?>" class="btn btn-u" onclick="hired_ob_employee(<?php echo $ob_emp_id; ?>)" <?php  if( $status==2 || $status==3 ) { echo "disabled"; } ?> > Hire </button>
                        <button id="rbutt_<?php  echo $status; ?>" class="btn btn-danger" onclick="reject_ob_employee(<?php echo $ob_emp_id; ?>)" ​​​​​ <?php  if( $status==2 || $status==3 ) { echo "disabled"; } ?> > Reject </button>
                        <input class="btn btn-default" type='button' id='btn' value='Print' onclick='printDiv();'>
                    </div>
                </div>
            </div> 
        </div><!-- end container well div -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="hired_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Hired Employee</h4>
            </div>
            <form id="hired_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="hired_emp_id" id="hired_emp_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date of Joining<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="date_of_joining" id="date_of_joining" class="form-control dt_pick" placeholder="Date of Joining" data-toggle="tooltip" data-placement="bottom" title="Date of Joining" autocomplete="off">
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="reject_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Reject Reason</h4>
            </div>
            <form id="reject_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="reject_emp_id" id="reject_emp_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Reject Reason<span class="req"/></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="2" id="reject_reason" name="reject_reason"></textarea>
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</div><!--/row-->
</div><!--/container-->

<script>
    
    var save_method; //for save method string
    var table;
    function hired_ob_employee(onboarding_employee_id)
    {
        save_method = 'add';
        $('#hired_form')[0].reset(); // reset form on modals
        
         $('#hired_emp_id').val(onboarding_employee_id);
         
        $('#hired_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Hired Employee'); // Set Title to Bootstrap modal title
    }
    
     $(function(){
        $("#hired_form" ).submit(function( event ) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Onboarding_Information/save_hired_ob_employee') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_Onboarding_Information/save_hired_ob_employee') ?>";
            }
            
            $.ajax({
            url: url,
            data: $("#hired_form").serialize(),
            type: $(this).attr('method')
            }).done(function(data) {

                  var url='<?php echo base_url() ?>Con_Onboarding_Information';
                  view_message(data,url,'hired_Modal','hired_form');

            });
            event.preventDefault();
        });
    });
    
      
    function reject_ob_employee(onboarding_employee_id)
    {
        save_method = 'add';
        $('#reject_form')[0].reset(); // reset form on modals
        
         $('#reject_emp_id').val(onboarding_employee_id);
         
        $('#reject_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Reject Reason'); // Set Title to Bootstrap modal title
    }
    
    $(function(){
        $("#reject_form" ).submit(function( event ) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Onboarding_Information/reject_od_employee') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_Onboarding_Information/reject_od_employee') ?>";
            }
            $.ajax({
            url: url,
            data: $("#reject_form").serialize(),
            type: $(this).attr('method')
            }).done(function(data) {

                  var url='<?php echo base_url() ?>Con_Onboarding_Information';
                  view_message(data,url,'reject_Modal','reject_form');

            });
            event.preventDefault();
        });
    });
    

    function printDiv()  {
        $.print("#print_review");
    };

</script>


