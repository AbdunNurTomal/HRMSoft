
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
<div id="employee_review_div">   
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-u" id="print_review">
                <div class="panel-heading">
                    <?php
                    echo $this->Common_model->get_selected_value($this,'employee_id',$employee_id, 'main_employees', 'first_name');                    
                    ?>
                    Information
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <label class="control-label">Personal Information:</label>
                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                            <tbody>
                                <?php
                                //$personal_info_query = $this->db->select('e.*,w.*')->from('main_employees e')->join('main_emp_workrelated w', 'e.employee_id = w.employee_id')->where('e.employee_id', $employee_id)->get();
                                $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                                //echo $this->db->last_query();
                                foreach ($personal_info_query->result() as $prow) {
                                    ?>
                                    <tr>
                                        <th>First Name : </th>
                                        <td><?php echo ucwords($prow->first_name); ?></td>
                                        <th>Middle Name : </th>
                                        <td><?php echo ucwords($prow->middle_name); ?> <?php // echo ucwords($prow->last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>SSN : </th>
                                        <td><?php echo $number = "XXX-XX-" . substr($this->Common_model->decrypt($prow->ssn_code), -4); ?></td>
                                        <th>Email : </th>
                                        <td><?php echo $prow->email; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Hire Date : </th>
                                        <td><?php echo $this->Common_model->show_date_formate($prow->hire_date); ?></td>
                                        <th>Birth Date : </th>
                                        <td><?php echo $this->Common_model->show_date_formate($prow->birthdate); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Position : </th>
                                        <td><?php echo $this->Common_model->get_name($this, $prow->position, 'main_positions', 'positionname'); ?></td>
                                        <th>Mobile Phone</th>
                                        <td><?php echo $prow->mobile_phone; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>     
                            </tbody>
                        </table>
                    </div>
                    
                    <?php
                    /* --------------- Employee Work Related Information ---------------- */
                    $wquery = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id));
                    if ($wquery->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Work Related Information:</label>
                            <table id="workrelated" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($wquery->result() as $wrow) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <th>Location : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->location, 'main_location', 'location_name'); ?></td>
                                            <th>Department : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->department, 'main_department', 'department_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Reporting Manager : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'last_name'); ?></td>
                                            <th>Wages : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->wages, 'main_payfrequency', 'freqtype'); ?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Asset Information ---------------- */
                    $query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Asset Information:</label>
                            <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Issued Date</th>
                                        <th>Returned Date</th>
                                        <th>Asset Id</th>
                                        <th>Asset</th>
                                        <th>Quantity</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td> <?php echo $i ?> </td>
                                            <td ><?php echo $this->Common_model->show_date_formate($row->issued_date) ?></td>
                                            <td >
                                                <?php
                                                if ($row->IsAssigned != 2) {
                                                    echo 'Assigned';
                                                } else {
                                                    echo $this->Common_model->show_date_formate($row->retuned_date);
                                                }
                                                ?>
                                            </td>
                                            <td ><?php echo $this->Common_model->get_name($this, $row->asset_model_id, ' main_assets_detail', 'asset_id') ?></td>
                                            <td><?php echo $this->Common_model->get_name($this, $row->asset_id, 'main_assets_name', 'asset_name') ?></td>
                                            <td><?php echo $row->quantity ?></td>
                                            <td><?php echo $row->value ?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Education Information ---------------- */
                    $query = $this->db->get_where('main_emp_education', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Education Information:</label>
                            <table id="dataTables-example-edu" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Education Level</th>
                                        <th>Institution Name</th>
                                        <th>No of Years</th>
                                        <th>Remarks</th>                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $this->db->get_where('main_emp_education', array('employee_id' => $employee_id));
                                    if ($query) {
                                        $i = 0;
                                        foreach ($query->result() as $row) {
                                            $i++;
                                            $pdt = $row->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($row->institution_name) . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $row->no_of_years . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($row->edu_remarks) . "</td>";
                                            print"</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Experience Information ---------------- */
                    $yes_no_query = $this->Common_model->get_array('yes_no');
                    $query = $this->db->get_where('main_emp_experience', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Experience Information:</label>
                            <table id="dataTables-example-experience" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Company Name</th>
                                        <th>Position</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Contact Previous Employer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        if ($row->contact_employee == 0) {
                                            $contact_employee = "";
                                        } else {
                                            $contact_employee = $yes_no_query[$row->contact_employee];
                                        }
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->comp_name) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->emp_position, 'main_positions', 'positionname') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                                        print"<td id='catF" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $contact_employee . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    /* --------------- Employee Skills Information ---------------- */
                    $query = $this->db->get_where('main_emp_skills', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>

                        <div class="table-responsive">
                            <label class="control-label">Skills Information:</label>
                            <table id="dataTables-example-skills" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Skill Name</th>
                                        <th>Years of Experience</th>
                                        <th>Competency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($row->skillname) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->yearsofexp . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->competencylevelid, 'main_competencylevels', 'competencylevels') . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    /* --------------- Employee Language Information ---------------- */
                    $languages_skill_array = $this->Common_model->get_array('languages_skill');
                    $query = $this->db->get_where('main_emp_languages', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Language Information:</label>
                            <table id="dataTables-example-languages" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Languages Name</th>
                                        <th>Languages Skill</th>
                                        <th>Competency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $languages_skill = "";
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $languages_skill = "";
                                        if ($row->languages_skill) {
                                            $skill_arr = explode(',', $row->languages_skill);
                                            foreach ($skill_arr as $key) {
                                                if ($languages_skill == "") {
                                                    $languages_skill = $languages_skill_array[$key];
                                                } else {
                                                    $languages_skill = $languages_skill . ", " . $languages_skill_array[$key];
                                                }
                                            }
                                        }
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->languagesid, 'main_language', 'languagename') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($languages_skill) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->competencylevel, 'main_competencylevels', 'competencylevels') . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Training Certification Information ---------------- */
                    $query = $this->db->get_where('main_emp_certification', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Training Certification Information:</label>
                            <table id="dataTables-example-certification" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Course Name</th>
                                        <th>Course Level</th>
                                        <th>Certification Name</th>
                                        <th>Issued Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->course_name) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . ucwords($row->course_level) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->certification_name) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee License Information ---------------- */
                    $yes_no_array = $this->Common_model->get_array('yes_no');
                    $query = $this->db->get_where('main_emp_license', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">License Information:</label>
                            <table id="dataTables-example-license" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>License Type</th>
                                        <th>State Issued</th>
                                        <th>Issued Date</th>
                                        <th>Expiration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->license_type) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $yes_no_array[$row->state_issued] . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->expiration_date) . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Absence Tracking Information ---------------- */
                    $absent_type_array = $this->Common_model->get_array('absent_type');
                    $yes_no_array = $this->Common_model->get_array('yes_no');
                    $leave_type_query = $this->Common_model->listItem('main_employeeleavetypes');

                    $query = $this->db->get_where('main_emp_absencetracking', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Absence Tracking Information:</label>
                            <table id="dataTables-example-absencetracking" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Absent Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Total Days</th>
                                        <th>Details Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $absent_type_array[$row->absent_type] . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->total_days . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($row->details_reason) . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> 
                        <?php
                    }
                    /* --------------- Employee Emergency Contact Information ---------------- */
                    $query = $this->db->get_where('main_emp_emergencycontact', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Emergency Contact Information:</label>
                            <table id="dataTables-example-emergencycontact" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <th>Name</th>
                                        <th>Occupation</th>
                                        <th>Relationship</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Mobile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->first_name) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . ucwords($row->occupation) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->relationship, 'main_relationship_status', 'relationship_status') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($row->first_address) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->city) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->mobile . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Action ---------------- */
                    $query = $this->db->get_where('main_emp_actions', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Action:</label>
                            <table id="dataTables-example-actions" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Action Date</th>
                                        <th>Actions Type</th>
                                        <th>Description</th>
                                        <th>Discipline Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        if ($row->action_type == 1) {
                                            $action_type = "Incident";
                                        } else {
                                            $action_type = "Accident";
                                        }
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->action_date) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $action_type . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->report_description) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . " " . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee Enrolling ---------------- */
                    $enrolling_query = $this->db->get_where('main_emp_enrolling', array('employee_id' => $employee_id));
                    if ($enrolling_query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            Enrolling:
                            <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
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
                                    foreach ($enrolling_query->result() as $rowen) {
                                        $i++;
                                        $pdt = $rowen->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $rowen->fast_name . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $rowen->last_name . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $rowen->relationship_id, 'main_relationship_status', 'relationship_status') . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $gender_array[$rowen->gender] . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($rowen->birthdate) . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                     /* --------------- Employee Benefits Tracking ---------------- */
                    $percent_dollars_array = $this->Common_model->get_array('percent_dollars');
                    $query = $this->db->get_where('main_emp_benefit', array('employee_id' => $employee_id));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Benefits Tracking:</label>
                            <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>SL </th>
                                        <!--<th>Enrolling</th>-->
                                        <th>Provider</th>
                                        <th>Benefit Type</th>
                                        <th>Eligible Date</th>
                                        <th>Enrolled Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        //print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->enrolling, 'main_depandent_information', 'fast_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $row->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->eligible_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->enrolled_date) . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    /* --------------- Employee PTO List ---------------- */
                    if ($this->user_group == 12 || $this->user_group == 11) {
                        $query = $this->db->get_where('main_pto_policy', array('company_id' => $this->company_id));
                    } else {
                        $query = $this->db->get('main_pto_policy');
                    }
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">PTO:</label>
                            <div style="overflow-y:scroll">
                                <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>SL </th>
                                            <th>Leave Type </th>
                                            <th>Accrual Amt(hours)</th>
                                            <th>Accrual period  </th>
                                            <th>Start Date</th>
                                            <th>Max Accrual</th>
                                            <th>Max Available</th>
                                            <th>Max Carryover</th>
                                            <th>Carryover Hrs</th>
                                            <th>Accrual Hrs</th>
                                            <th>Used Hrs</th>
                                            <th>Used Hrs Adjust</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $accrual_period_array = array(
                                            0 => "",
                                            1 => "Per Hour",
                                            2 => "Per Pay Period",
                                            3 => "Per Month",
                                            4 => "Per Year",
                                        );
                                        foreach ($query->result() as $row) {
                                            $i++;
                                            $pdt = $row->id;

                                            $accural_period ="";
                                            if ($row->accrual_period && $accrual_period_array) { 
                                                if (array_key_exists($row->accrual_period, $accrual_period_array)) {
                                                    $accural_period = $accrual_period_array[$row->accrual_period];
                                                }
                                            }

                                            $hire_date = "";
                                            if (empty($hire_date || $row->start_days_after_hire)) {
                                                $start_date_hire = "";
                                            } else {
                                                $start_date_hire =$this->Common_model->add_date($hire_date, $row->start_days_after_hire);
                                            }

                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_employeeleavetypes', 'leavetype') . "</td>";
                                            print"<td id='catC" . $pdt . "'>" . $row->accrual_amt . "</td>";
                                            print"<td id='catD" . $pdt . "'>" . $accrual_period_array[$row->accrual_period] . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->add_date($hire_date, $row->start_days_after_hire) . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $row->max_accrual . "</td>";
                                            print"<td id='catC" . $pdt . "'>" . $row->max_available . "</td>";
                                            print"<td id='catD" . $pdt . "'>" . $row->max_carryover . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . "" . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . "" . "</td>";
                                            print"<td id='catC" . $pdt . "'>" . "" . "</td>";
                                            print"<td id='catD" . $pdt . "'>" . "" . "</td>";
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                    
                        <?php
                    }

                    /* --------------- Employee Appraisal Review List ---------------- */

//                    if ($this->user_group == 12 || $this->user_group == 11) {
//                        $query = $this->db->get_where('main_pto_policy', array('company_id' => $this->company_id));
//                    }
                    $query = $this->db->select('temp_app_id, employee_id, user_id, employee_name, review_start_date, review_end_date, review_date')->get_where('main_appraisal_records', array('employee_id' => $employee_id));

                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            <label class="control-label">Appraisal Review:</label>
                            <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>Sl no.</th>
                                        <th>Employee Name</th>
                                        <th>Reviewer Name</th>
                                        <th>Review Date</th>
                                        <th>Issue Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $res = $this->Common_model->get_row_by_field('id', 'main_users', $row->user_id);
                                        if (empty($res)) {
                                            $rvw_name = "";
                                        } else {
                                            $rvw_name = $res->name;
                                        }
                                        print "<tr>";
                                        print "<td>" . $i . "</td>";
                                        print "<td>" . $row->employee_name . "</td>";
                                        print "<td>" . $rvw_name . "</td>";
                                        print "<td>" . $this->Common_model->show_date_formate($row->review_start_date) . ' to ';
                                        print $this->Common_model->show_date_formate($row->review_start_date) . "</td>";
                                        print "<td>" . $this->Common_model->show_date_formate($row->review_date) . "</td>";
                                        print '<td><a title="Preview" href="' . base_url() . 'Con_PerformanceReviewBuilder/appraisal_completed/' . $employee_id . '/' . $row->temp_app_id . '" target="_blank"><i class="fa fa-eye"></i></a></td>';
                                        print "</tr>";
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
                <div class="modal-footer">
                    <div class="col-md-6 col-sm-6 find_mar" style="text-align: left;">
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employee_Profile" ?>">Close</a>
                    </div>
                    <div class="col-md-6 col-sm-6 find_mar" style="text-align: right;">                    
                        <input class="btn btn-default" type='button' id='btn' value='Print' onclick='printDiv();'>
                    </div>
                </div>
            </div>
        </div>        
    
</div>
</div>
</div>
		
    </div><!--/row-->
</div><!--/container-->

<script>

function printDiv()  {
    $.print("#print_review");
};

</script>