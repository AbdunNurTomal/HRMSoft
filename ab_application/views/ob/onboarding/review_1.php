<?php
if ($type == 1) {

    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
    ?>
    <form id="save_onboarding_submition_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/submit_onboarding_data" enctype="multipart/form-data" role="form">

        <div id="review_div_save_id">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Personal Information
                        </div>
                        <?php
                        $personal_info_query = $this->db->get_where('main_ob_personal_information', array('onboarding_employee_id' => $ob_emp_id));
                        foreach ($personal_info_query->result() as $prow) {
                            ?>
                            <input type="hidden" value="<?php echo $prow->onboarding_employee_id ?>" name="ob_revieu_emp_id" id="ob_revieu_emp_id"/>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">First Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_firstname); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Middle Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_middlename); ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Last Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_lastname); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Date of Birth : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;" > <?php echo $this->Common_model->show_date_formate($prow->onboarding_dateofbirth); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-sm-2 control-label">Social Security Number : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $prow->onboarding_socialsecuritynumber; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Maiden Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_maidenname); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-sm-2 control-label" >Suffix : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_suffix); ?></label>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>                        
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Contact Information
                        </div>
                        <?php
                        $contact_information_query = $this->db->get_where('main_ob_contact_information', array('onboarding_employee_id' => $ob_emp_id));
                        foreach ($contact_information_query->result() as $conkey) {
                            ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Email Address : </b></label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->email_address; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Primary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->primary_phone; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Secondary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->secondary_phone; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Street Address 1 : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->street_address1); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">

                                    <label class="col-sm-2 control-label">Street Address 2 : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->street_address2); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label" >City : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->city); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">                            
                                    <label class="col-sm-2 control-label" >State : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->state); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label" >Zip Code : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->zipcode; ?></label>
                                    </div>
                                </div>
                            </div>                         
                            <?php
                        }
                        ?>                        
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Emergency contact
                        </div>
                        <?php
                        $emergency_contact = $this->db->get_where(' main_ob_emergencycontact', array('onboarding_employee_id' => $ob_emp_id));
                        foreach ($emergency_contact->result() as $emkey) {
                            ?>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>First Name : </b></label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->first_name); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Last Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->last_name); ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Relationship With Employee : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $emkey->relationship_with_employee; ?></label>
                                    </div> 
                                    <label class="col-sm-2 control-label">Primary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $emkey->primary_phone; ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">                            
                                    <label class="col-sm-2 control-label">Secondary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $emkey->secondary_phone; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label" >Address : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->address); ?></label>
                                    </div>   
                                </div>
                            </div>  
                            <?php
                        }
                        ?>                        
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary"> 
                        <div class="panel-heading">
                            Employment History
                        </div>
                        <?php
                        $employmenthistory_query = $this->db->get_where('main_ob_employmenthistory', array('onboarding_employee_id' => $ob_emp_id));
                        if ($employmenthistory_query) {
                            ?>
                            <div class="panel-body">
                                <table id="employmenthistory" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Employer</th>
                                            <th>Position</th>
                                            <th>Duties</th>
                                            <th>Supervisor Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($employmenthistory_query->result() as $hrow) {
                                            $pdt = $hrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $hrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($hrow->employer) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $hrow->position, 'main_positions', 'positionname') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . ucwords($hrow->duties) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($hrow->supervisor_name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->start_date) . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->end_date) . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                    </div>        
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Reference
                        </div>
                        <?php
                        $reference_query = $this->db->get_where('main_ob_reference', array('onboarding_employee_id' => $ob_emp_id));
                        if ($reference_query) {
                            ?>
                            <div class="panel-body">
                                <table id="reference" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Name</th>
                                            <th>Relationship</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($reference_query->result() as $refrow) {
                                            $pdt = $refrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $refrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($refrow->name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $refrow->relationship, 'main_relationship_status', 'relationship_status') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $refrow->reference_email . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $refrow->phone_number . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table> 
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Education
                        </div>
                        <?php
                        $education_query = $this->db->get_where('main_ob_education', array('onboarding_employee_id' => $ob_emp_id));
                        if ($education_query) {
                            ?>
                            <div class="panel-body">
                                <table id="education" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Education Level</th>
                                            <th>Institution Name</th>
                                            <th>From Date</th>
                                            <th>TO Date</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($education_query->result() as $edurow) {
                                            $pdt = $edurow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $edurow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $edurow->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($edurow->institution_name) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($edurow->from_date) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($edurow->to_date) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . ucwords($edurow->result) . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?PHP
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Criminal History
                        </div>
                        <?php
                        $offense_type_array = $this->Common_model->get_array('offense_type');
                        $criminalhistory_query = $this->db->get_where('main_ob_criminalhistory', array('onboarding_employee_id' => $ob_emp_id));
                        if ($criminalhistory_query) {
                            ?>
                            <div class="panel-body">
                                <table id="criminalhistory" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Offense Type</th>
                                            <th>Offense</th>
                                            <th>Date</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>State</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($criminalhistory_query->result() as $crrow) {
                                            $pdt = $crrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $crrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $offense_type_array[$crrow->offense_type] . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($crrow->offense) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($crrow->offense_date) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($crrow->city) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->country, 'main_countries', 'country_name') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->offense_state, 'main_state', 'state_name') . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Direct Deposit 
                        </div>
                        <?php
                        $amount_type_array = $this->Common_model->get_array('amount_type');
                        $directdeposit_query = $this->db->get_where('main_ob_direct_deposit', array('onboarding_employee_id' => $ob_emp_id));
                        if ($directdeposit_query) {
                            ?>
                            <div class="panel-body">
                                <table id="directdeposit" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Bank Name</th>
                                            <th>Account Number</th>
                                            <th>Routing Number</th>
                                            <th>Account Type</th>
                                            <th>Amount Type</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($directdeposit_query->result() as $dirrow) {
                                            $pdt = $dirrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $dirrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($dirrow->bank_name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $dirrow->account_number . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $dirrow->routing_number . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $dirrow->account_type, 'main_bank_account_types', 'bank_account_type') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . ucwords($dirrow->amount_type) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $dirrow->acc_value . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Company Policy
                        </div>
                        <?php
                        $company_policies_query = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id))->row();
                        if ($company_policies_query) {
                            $pieces = explode(",", $company_policies_query->policy_id);
                            $policy = array_map('intval', $pieces);

                            $this->db->where_in('id', $policy);
                            $main_company_policies_query = $this->db->get('main_company_policies');
                            ?>
                            <div class="panel-body">
                                <table id="companypolicies" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Policy Name</th>
                                            <th>Description</th>
                                            <th style="width: 40%; " >Policy</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($main_company_policies_query) {
                                            foreach ($main_company_policies_query->result() as $comrow) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo ucwords($comrow->policy_name) ?> </td>
                                                    <td><?php echo ucwords($comrow->description) ?> </td>
                                                    <td><?php echo ucwords($comrow->custom_text) ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>        
            </div>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Benefit
                        </div> 
                        <?php 
                         $query_benefit = $this->db->get_where('main_ob_benefit', array('onboarding_employee_id' => $ob_emp_id));
                         if ($query_benefit) {
                        ?>
                        <div class="panel-body">
                            <table id="benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Enrolling</th>
                                        <th>Provider</th>
                                        <th>Benefit Type</th>
                                        <th>Eligible Date</th>
                                        <th>Enrolled Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        foreach ($query_benefit->result() as $rowbn) {
                                            $i++;
                                            $pdt = $rowbn->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $rowbn->enrolling, 'main_depandent_information', 'fast_name') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowbn->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowbn->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($rowbn->eligible_date) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($rowbn->enrolled_date) . "</td>";
                                            print"</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        }
                        ?>                        
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            EEO
                        </div>
                        <?php
                        $eeo_query = $this->db->get_where('main_ob_eeo_policies', array('onboarding_employee_id' => $ob_emp_id))->row();
                        if ($eeo_query) {
                            ?>
                            <div class="panel-body">

                                <div class = "page-header no-margin">
                                    <h1>
                                        <small>Self Identification (eeoc)</small>
                                    </h1>
                                </div>
                                <table id="eeo" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Race/Ethnicity :</td> 
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

            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u">Submit</button>
                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Onboarding" ?>">Cancel</a>
            </div>

        </div> 

    </form>

    <?php
} 
else if ($type == 2) {
    ?>

    <form id="onboarding_submition_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/submit_onboarding_data" enctype="multipart/form-data" role="form">

        <div id="review_div">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Personal Information
                        </div>
                        <?php
                        $personal_info_query = $this->db->get_where('main_ob_personal_information', array('onboarding_employee_id' => $ob_emp_id));
                        foreach ($personal_info_query->result() as $prow) {
                            ?>
                            <input type="hidden" value="<?php echo $prow->onboarding_employee_id ?>" name="ob_revieu_emp_id" id="ob_revieu_emp_id"/>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">First Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_firstname); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Middle Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_middlename); ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Last Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_lastname); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Date of Birth : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;" > <?php echo $this->Common_model->show_date_formate($prow->onboarding_dateofbirth); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-sm-2 control-label">Social Security Number : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $prow->onboarding_socialsecuritynumber; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Maiden Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_maidenname); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-sm-2 control-label" >Suffix : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($prow->onboarding_suffix); ?></label>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>                        
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Contact Information
                        </div>
                        <?php
                        $contact_information_query = $this->db->get_where('main_ob_contact_information', array('onboarding_employee_id' => $ob_emp_id));
                        foreach ($contact_information_query->result() as $conkey) {
                            ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Email Address : </b></label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->email_address; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Primary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->primary_phone; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Secondary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->secondary_phone; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Street Address 1 : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->street_address1); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">

                                    <label class="col-sm-2 control-label">Street Address 2 : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->street_address2); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label" >City : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($conkey->city); ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">                            
                                    <label class="col-sm-2 control-label" >State : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->state; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label" >Zip Code : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $conkey->zipcode; ?></label>
                                    </div>
                                </div>
                            </div>                         
                            <?php
                        }
                        ?>                        
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Emergency contact
                        </div>
                        <?php
                        $emergency_contact = $this->db->get_where(' main_ob_emergencycontact', array('onboarding_employee_id' => $ob_emp_id));
                        foreach ($emergency_contact->result() as $emkey) {
                            ?>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>First Name : </b></label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->first_name); ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Last Name : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->last_name); ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Relationship With Employee : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->relationship_with_employee); ?></label>
                                    </div> 
                                    <label class="col-sm-2 control-label">Primary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $emkey->primary_phone; ?></label>
                                    </div>
                                </div>
                                <div class="form-group no-margin">                            
                                    <label class="col-sm-2 control-label">Secondary Phone : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo $emkey->secondary_phone; ?></label>
                                    </div>
                                    <label class="col-sm-2 control-label" >Address : </label>
                                    <div class="col-sm-4">
                                        <label class="col-sm-12 control-label" style="text-align: left;"><?php echo ucwords($emkey->address); ?></label>
                                    </div>   
                                </div>
                            </div>  
                            <?php
                        }
                        ?>                        
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary"> 
                        <div class="panel-heading">
                            Employment History
                        </div>
                        <?php
                        $employmenthistory_query = $this->db->get_where('main_ob_employmenthistory', array('onboarding_employee_id' => $ob_emp_id));
                        if ($employmenthistory_query) {
                            ?>
                            <div class="panel-body">
                                <table id="employmenthistory" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Employer</th>
                                            <th>Position</th>
                                            <th>Duties</th>
                                            <th>Supervisor Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($employmenthistory_query->result() as $hrow) {
                                            $pdt = $hrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $hrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($hrow->employer) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $hrow->position, 'main_positions', 'positionname') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . ucwords($hrow->duties) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($hrow->supervisor_name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->start_date) . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($hrow->end_date) . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                    </div>        
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Reference
                        </div>
                        <?php
                        $reference_query = $this->db->get_where('main_ob_reference', array('onboarding_employee_id' => $ob_emp_id));
                        if ($reference_query) {
                            ?>
                            <div class="panel-body">
                                <table id="reference" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Name</th>
                                            <th>Relationship</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($reference_query->result() as $refrow) {
                                            $pdt = $refrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $refrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($refrow->name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $refrow->relationship, 'main_relationship_status', 'relationship_status') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $refrow->reference_email . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $refrow->phone_number . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table> 
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Education
                        </div>
                        <?php
                        $education_query = $this->db->get_where('main_ob_education', array('onboarding_employee_id' => $ob_emp_id));
                        if ($education_query) {
                            ?>
                            <div class="panel-body">
                                <table id="education" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Education Level</th>
                                            <th>Institution Name</th>
                                            <th>From Date</th>
                                            <th>TO Date</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($education_query->result() as $edurow) {
                                            $pdt = $edurow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $edurow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $edurow->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($edurow->institution_name) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($edurow->from_date) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($edurow->to_date) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . ucwords($edurow->result) . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?PHP
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Criminal History
                        </div>
                        <?php
                        $offense_type_array = $this->Common_model->get_array('offense_type');
                        $criminalhistory_query = $this->db->get_where('main_ob_criminalhistory', array('onboarding_employee_id' => $ob_emp_id));
                        if ($criminalhistory_query ) {
                            ?>
                            <div class="panel-body">
                                <table id="criminalhistory" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Offense Type</th>
                                            <th>Offense</th>
                                            <th>Date</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>State</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($criminalhistory_query->result() as $crrow) {
                                            $pdt = $crrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $crrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $offense_type_array[$crrow->offense_type] . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($crrow->offense) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($crrow->offense_date) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($crrow->city) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->country, 'main_countries', 'country_name') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $crrow->offense_state, 'main_state', 'state_name') . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>        
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Direct Deposit 
                        </div>
                        <?php
                        $amount_type_array = $this->Common_model->get_array('amount_type');
                        $directdeposit_query = $this->db->get_where('main_ob_direct_deposit', array('onboarding_employee_id' => $ob_emp_id));
                        if ($directdeposit_query) {
                            ?>
                            <div class="panel-body">
                                <table id="directdeposit" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Bank Name</th>
                                            <th>Account Number</th>
                                            <th>Routing Number</th>
                                            <th>Account Type</th>
                                            <th>Amount Type</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($directdeposit_query->result() as $dirrow) {
                                            $pdt = $dirrow->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $dirrow->id . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($dirrow->bank_name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $dirrow->account_number . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $dirrow->routing_number . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $dirrow->account_type, 'main_bank_account_types', 'bank_account_type') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . ucwords($dirrow->amount_type) . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $dirrow->acc_value . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>        
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Company Policy
                        </div>
                        <?php
                        $company_policies_query = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id))->row();
                        if ($company_policies_query) {
                            $pieces = explode(",", $company_policies_query->policy_id);
                            $policy = array_map('intval', $pieces);

                            $this->db->where_in('id', $policy);
                            $main_company_policies_query = $this->db->get('main_company_policies');
                            ?>
                            <div class="panel-body">
                                <table id="companypolicies" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Policy Name</th>
                                            <th>Description</th>
                                            <th style="width: 40%; " >Policy</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($main_company_policies_query) {
                                            foreach ($main_company_policies_query->result() as $comrow) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo ucwords($comrow->policy_name) ?> </td>
                                                    <td><?php echo ucwords($comrow->description) ?> </td>
                                                    <td><?php echo ucwords($comrow->custom_text) ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>        
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            Benefit
                        </div>
                        <?php 
                        $query_benefit = $this->db->get_where('main_ob_benefit', array('onboarding_employee_id' => $ob_emp_id));
                        if ($query_benefit) {
                        ?>
                        <div class="panel-body">
                            <table id="benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Enrolling</th>
                                        <th>Provider</th>
                                        <th>Benefit Type</th>
                                        <th>Eligible Date</th>
                                        <th>Enrolled Date</th>
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
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->enrolling, 'main_depandent_information', 'fast_name') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $rowfn->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($rowfn->eligible_date) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($rowfn->enrolled_date) . "</td>";
                                            print"</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>        
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">                
                        <div class="panel-heading">
                            EEO
                        </div>
                        <?php
                        $eeo_query = $this->db->get_where('main_ob_eeo_policies', array('onboarding_employee_id' => $ob_emp_id))->row();
                        if ($eeo_query) {
                            ?>
                            <div class="panel-body">

                                <div class = "page-header no-margin">
                                    <h1>
                                        <small>Self Identification (eeoc)</small>
                                    </h1>
                                </div>
                                <table id="eeo" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Race/Ethnicity :</td> 
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

            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u">Submit</button>
                <a class="btn btn-danger" href="<?php echo base_url() . "Con_onboarding_list" ?>">Cancel</a>
            </div>

        </div>

    </form>

    <?php
}
?>


<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-u btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(is_employee)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>

