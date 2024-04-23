<?php
    /* $empImagesBasePath = FCPATH . "uploads/emp_image/43";
    // $empImagesBasePath = FCPATH . "uploads/emp_image/blank.png";
    $fileExists = "Not found";
    if (file_exists($empImagesBasePath)) {
        $fileExists = "Found";
    }
    print_r($fileExists);exit; */
?>

<style>
    .obrevtbl > thead > tr {
        background-color: #dff0d8;
        color: #3c763d;
    }
    .panel-body-img {
        margin-right: 19px;
        margin-top: 6px;
        padding: inherit;
    }
    .emp-name{
        color: #2c87f0;
        font-size: 1.20em;
        font-weight: bold;
    }
    .layout-loggedin-username-report {
        font-size: 1.20em;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        /* color: rgb(20, 20, 20); */
        text-align: right;
        margin-left: 0px;
        padding-left: 7px;
    }
    .image-caption {
        text-align: center;
    }
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
           <!--  <ol class="breadcrumb">
                <li><?php //echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php //echo $page_header; ?></li>
            </ol> -->
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 15px;"> <!-- container well div -->
            <!-- data table -->
            
            <div class="col-md-12 col-centered">
                <div id="employee_review_div">  
                <?php
                    $employee_id = $this->uri->segment(3);
                    $query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                    if ($query) {
                        foreach ($query->result() as $prow) { 
                ?>
            <div class="pull-right">
            <a class="btn btn-default" style="margin-bottom: 5px;" title="Download PDF Form" href="<?php echo base_url() . "Con_ComprehensiveReport/comprehensive_report/" . $prow->employee_id; ?>" ><i class="fa fa-download"></i> Download</a>
               <!-- <a class="btn btn-default" style="margin-right: 7px; margin-bottom: 5px;"title="Download PDF Form" href="<?php //echo base_url() . "Con_ComprehensiveReport/comprehensive_report/" . $prow->employee_id; ?>" ><i class="fa fa-download"></i> Download</a> -->
            </div>
            <?php
                     }
                } 
             ?>    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-u">
                
                <div class="panel-heading">
                   <h2 style="color:#fff;"> Employee Information </h2>
                </div>
                   <?php
                       /* $employee_id = $this->uri->segment(3);
                        $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                        if ($personal_info_query) {
                            foreach ($personal_info_query->result() as $row) { */

                               
                                if ($prow->image_name == "") {
                                    $img_location = base_url() . "uploads/emp_image/blank.png";
                                } else {
                                    //$img_location = base_url() . "uploads/emp_image/blank.png";
                                    $img_location = base_url() . "uploads/emp_image/" . $prow->image_name;
                                }
                            $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','last_name');    
                    ?>
                    <div class="panel-body-img panel-body">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <div class="row image-caption">
                                 <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                            </div>
                            <div class="row image-caption">
                                <span class="layout-loggedin-username-report emp-name" style="margin-top: 3px;"><?php echo  $employee_name; ?></span>
                            </div>
                        </div>
                    </div>    
                     <?php  /* }
                        } */
                    ?>
                <div class="panel-body">
                    <div class="table-responsive overflow-x">
                        <h3> Personal Information:</h3>
                        <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                            <thead>
                                <tr>
                                    <th>S.No </th>
                                    <th>Employee Name</th>
                                    <th>SSN</th>
                                    <th>Email</th>
                                    <th>Hire Date</th>
                                    <th>Birth Date</th>
                                    <th>Position</th>
                                    <th>Mobile Phone</th>
                                    <th>Marital Status</th>
                                    <th>Address</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Zip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                                    if ($personal_info_query) {
                                        $i = 0;
                                        foreach ($personal_info_query->result() as $row) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td> <?php echo $i ?> </td>
                                                <?php $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','last_name');?>
                                                <td><?php echo $employee_name;?></td>
                                                <td><?php echo $number = "XXX-XX-" . substr($this->Common_model->decrypt($prow->ssn_code), -4); ?></td>
                                                <td><?php echo $prow->email; ?></td>
                                                <td><?php echo $this->Common_model->show_date_formate($prow->hire_date); ?></td>
                                                <td><?php echo $this->Common_model->show_date_formate($prow->birthdate); ?></td>
                                                <td><?php echo $this->Common_model->get_name($this, $prow->position, 'main_jobtitles', 'job_title'); ?></td>
                                                <td><?php echo $prow->mobile_phone; ?></td>
                                                <td><?php echo ($prow->marital_status == 1) ? "Married" : "Unmarried"; ?> <?php // echo ucwords($prow->last_name);       ?></td>
                                                <td><?php echo  $prow->first_address; ?></td>
                                                <td><?php echo $this->Common_model->get_name($this, $prow->state, 'main_state', 'state_name'); ?></td>
                                                <td><?php echo  $prow->city; ?></td>
                                                    <td><?php echo $prow->zipcode; ?></td>
                                            </tr>         
                                        <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive overflow-x">
                        <h3>Work Related Information:</h3>
                        <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                            <thead>
                                <tr>
                                    <th>S.No </th>
                                    <th>Department</th>
                                    <th>Location</th>
                                    <th>Reporting Manager</th>
                                    <th>Wages</th>
                                    <th>Salary Type</th>
                                    <th>Employee Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $wquery = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id, 'isactive' => 1));
                                    if ($wquery->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($wquery->result() as $wrow) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td> <?php echo $i ?> </td>
                                                <td><?php echo $this->Common_model->get_name($this, $wrow->department, 'main_department', 'department_name'); ?></td>
                                                <td><?php echo $this->Common_model->get_name($this, $wrow->location, 'main_location', 'location_name'); ?></td>
                                                <td><?php echo $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'last_name'); ?></td>
                                                <td><?php echo $this->Common_model->get_name($this, $wrow->wages, 'main_payfrequency', 'freqtype'); ?></td>
                                                <td><?php echo ($wrow->salary_type == 1) ? "Hourly" : "Salary"; ?> </td>
                                                <td><?php echo $this->Common_model->get_name($this, $wrow->employee_type, 'tbl_employmentstatus', 'employemnt_status')  ?></td>
                                            </tr>         
                                <?php
                                        }
                                    } else {
                                    
                                ?>
                                             <tr>
                                                <td><?php echo "-"; ?> </td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "-"; ?></td>
                                            </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
                        $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','position');
                        
                        $wage_type_query=$this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id,'isactive' => 1));
                        
                        $wage_type_array = $this->Common_model->get_array('wage_type');
                        $status_array = $this->Common_model->get_array('status');
                        $waquery = $this->db->get_where('main_emp_wage_compensation', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($wquery->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                    <h3> Wage & Compensation:</h3>
                             <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No </th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                        <th>Wage Type</th>
                                        <th>Position</th>
                                        <th>Pay Schedule</th>
                                        <th>Hours Per Pay Period</th>
                                        <th>Per Hour Rate</th>
                                        <th>Per Pay Period Salary</th>
                                        <th>Yearly Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       if ($waquery) {
                                            $i = 0;
                                            foreach ($waquery->result() as $row) {
                                                $i++;
                                                
                                                $per_hour_rate=" $". $row->per_hour_rate;
                                                $per_pay_period_salary=" $". round($row->per_pay_period_salary,2);
                                                ?>
                                                <tr>
                                                    <td> <?php echo $i ?> </td>
                                                    <td><?php echo $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name'); ?></td>
                                                    <td><?php echo $this->Common_model->show_date_formate($row->wage_date) ?></td>
                                                    <td> <?php echo $wage_type_array[$row->wage_salary_type]; ?></td>
                                                    <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title'); ?></td>
                                                    <!-- td><?php //echo $this->Common_model->get_selected_value($this,'positionname',$row->position,'main_positions','gl_code'); ?></td> -->
                                                    <td><?php echo $this->Common_model->get_name($this, $row->pay_schedule,'main_payfrequency_type', 'freqcode'); ?></td>
                                                    <td><?php echo $row->hours_per_pay_period ?></td>
                                                    <td><?php echo $per_hour_rate; ?></td>
                                                    <td><?php echo $per_pay_period_salary; ?></td>
                                                    <td><?php echo $row->yearly_salary; ?></td>
                                                </tr>         
                                            <?php
                                        }
                                            }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else{
                        ?>
                     <div class="table-responsive overflow-x">
                          <h3> Wage & Compensation:</h3>
                            <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No </th>
                                        <th>Company Name </th>
                                        <th>Date</th>
                                        <th>Wage Type</th>
                                        <th>Position</th>
                                        <th>Pay Schedule</th>
                                        <th>Hours Per Pay Period</th>
                                        <th>Per Hour Rate</th>
                                        <th>Per Pay Period Salary</th>
                                        <th>Yearly Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                        <td><?php echo "-"; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    <?php
                    }
                    //,'IsAssigned' => 1
                    $query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                          <h3>  Asset Information: </h3>
                            <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No </th>
                                        <th> Company Name</th>
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
                                            <td> <?php echo $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name'); ?></td>;
                                            <td ><?php echo $this->Common_model->show_date_formate($row->issued_date)?></td>
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
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Asset Information:</h3>
                            <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No </th>
                                        <th>Company Name</th>
                                        <th>Issued Date</th>
                                        <th>Returned Date</th>
                                        <th>Asset Id</th>
                                        <th>Asset</th>
                                        <th>Quantity</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?></td>
                                        <td > <?php echo "-"; ?></td>
                                        <td ><?php echo "-"; ?> </td>
                                        <td ><?php echo "-"; ?></td>
                                        <td> <?php echo "-"; ?></td>
                                        <td> <?php echo "-"; ?></td>
                                        <td> <?php echo "-"; ?></td>
                                    </tr>
                            </tbody>
                            </table>
                        </div>

                    <?php
                    }
                    $query = $this->db->get_where('main_emp_education', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                            <h3>Education Information:</h3>
                            <table id="dataTables-example-edu" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Education Level</th>
                                        <th>Institution Name</th>
                                        <th>No of Years</th>
                                        <th>Certification or Degree</th>  
                                        <th>Remarks</th>                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $this->db->get_where('main_emp_education', array('employee_id' => $employee_id, 'isactive' => 1));
                                    if ($query) {
                                        $i = 0;
                                        foreach ($query->result() as $row) {
                                            $i++;
                                            $pdt = $row->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($row->institution_name) . "-"; "</td>";
                                            print"<td id='catE" . $pdt . "'>" . $row->no_of_years . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($row->certification_degree)  . "</td>";
                                            print"<td id='catE" . $pdt . "'>" . ucwords($row->edu_remarks) . "</td>";
                                            print"</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else{
                        ?>
                         <div class="table-responsive overflow-x">
                    <h3> Education Information: </h3>
                            <table id="dataTables-example-edu" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Education Level</th>
                                        <th>Institution Name</th>
                                        <th>No of Years</th>
                                        <th>Certification or Degree</th>
                                        <th>Remarks</th>                    
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td><?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $yes_no_query = $this->Common_model->get_array('yes_no');
                    $query = $this->db->get_where('main_emp_experience', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                            <h3>Experience Information:</h3>
                            <table id="dataTables-example-experience" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Position</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Reason for Leaving</th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $row->emp_position . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                                        print"<td id='catF" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                                        print"<td id='catF" . $pdt . "'>" . $row->reason_for_leaving . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $contact_employee . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else{
                        ?>
                         <div class="table-responsive overflow-x">
                            <h3>Experience Information:</h3>
                            <table id="dataTables-example-experience" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Position</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Reason for Leaving</th>
                                        <th>Contact Previous Employer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $query = $this->db->get_where('main_emp_skills', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>

                        <div class="table-responsive overflow-x">
                           <h3> Skills Information:</h3>
                            <table id="dataTables-example-skills" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
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
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Skills Information:</h3>
                            <table id="dataTables-example-skills" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Skill Name</th>
                                        <th>Years of Experience</th>
                                        <th>Competency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $languages_skill_array = $this->Common_model->get_array('languages_skill');
                    $query = $this->db->get_where('main_emp_languages', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                    <h3> Language Information:</h3>
                            <table id="dataTables-example-languages" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name </th>
                                        <th>Languages Name</th>
                                        <th>Languages Skill</th>
                                        <th>Competency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                        $i++;
                                        $languages_skill = "";
                                        if ($row->languages_skill) {
                                            $skill_arr = explode(',', $row->languages_skill);

                                            foreach ($skill_arr as $key) {
                                                if ($languages_skill == "") {
                                                    $languages_skill = $languages_skill_array[$key];
                                                } else {
                                                    $languages_skill = $languages_skill . " , " . $languages_skill_array[$key];
                                                }
                                            }
                                        }
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
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
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Language Information:</h3>
                            <table id="dataTables-example-languages" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Languages Name</th>
                                        <th>Languages Skill</th>
                                        <th>Competency Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    <?php
                    }
                    $query = $this->db->get_where('main_emp_certification', array('employee_id' => $employee_id, 'isactive' => 1));
                    //$training_type_array = $this->Common_model->get_array('training_type');
                    $training_type_array = $this->Common_model->get_array('training_type');
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Training Certification Information:</h3>
                            <table id="dataTables-example-certification" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Course Name</th>
                                        <th>Course Level</th>
                                        <th>Certification Name</th>
                                        <th>Description</th>
                                        <th>Issued Date</th>
                                        <th>Training Type </th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->course_name) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . ucwords($row->course_level) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->certification_name) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->description) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $training_type_array[$row->training_type]. "</td>";
                                       // echo ($wrow->salary_type == 1) ? "Hourly" : "Salary";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else{
                        ?>
                         <div class="table-responsive overflow-x">
                           <h3> Training Certification Information:</h3>
                            <table id="dataTables-example-certification" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Course Name</th>
                                        <th>Course Level</th>
                                        <th>Certification Name</th>
                                        <th>Description</th>
                                        <th>Issued Date</th>
                                        <th>Training Type </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td><?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $yes_no_array = $this->Common_model->get_array('yes_no');
                    $query = $this->db->get_where('main_emp_license', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                            <h3>License Information:</h3>
                            <table id="dataTables-example-license" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>License Type</th>
                                        <th>State Issued</th>
                                        <th>Issued Date</th>
                                        <th>Expiration Date</th>
                                        <th>Unspecific Date</th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->license_type) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $yes_no_array[$row->state_issued] . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->expiration_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->unspecific_date) . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> License Information:</h3>
                            <table id="dataTables-example-license" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>License Type</th>
                                        <th>State Issued</th>
                                        <th>Issued Date</th>
                                        <th>Expiration Date</th>
                                        <th>Unspecific Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $absent_type_array = $this->Common_model->get_array('absent_type');
                    $yes_no_array = $this->Common_model->get_array('yes_no');
                    $leave_type_query = $this->Common_model->listItem('main_employeeleavetypes');

                    $query = $this->db->get_where('main_emp_absencetracking', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Absence Tracking Information:</h3>
                            <table id="dataTables-example-absencetracking" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Absent Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Total Days</th>
                                        <th>Details Reason</th>
                                        <th>Leave Type</th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $absent_type_array[$row->absent_type] . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->total_days . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($row->details_reason) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td>";
                                        
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> 
                        <?php
                    }
                    else{
                        ?>
                         <div class="table-responsive overflow-x">
                           <h3> Absence Tracking Information:</h3>
                            <table id="dataTables-example-absencetracking" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Absent Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Total Days</th>
                                        <th>Details Reason</th>
                                        <th>Leave Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                        </div> 
                    <?php
                    }
                    $query = $this->db->get_where('main_emp_emergencycontact', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                          <h3>  Emergency Contact Information:</h3>
                            <table id="dataTables-example-emergencycontact" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Occupation</th>
                                        <th>Relationship</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Mobile</th>
                                        <th>State</th>
                                        <th>Zip</th>
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
                                        $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','last_name');
                                        print"<td id='catB" . $pdt . "'>" . ucwords($employee_name) . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . ucwords($row->occupation) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->relationship, 'main_relationship_status', 'relationship_status') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($row->first_address) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->city) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->mobile . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_name') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" .$row->zipcode . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }else{
                        ?>
                        <div class="table-responsive overflow-x">
                          <h3>  Emergency Contact Information:</h3>
                            <table id="dataTables-example-emergencycontact" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Occupation</th>
                                        <th>Relationship</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Mobile</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    <?php
                    }
                    $query = $this->db->get_where('main_emp_actions', array('employee_id' => $employee_id, 'isactive' => 1));
                    $incident_category = array(0=> "", 1 => "Customer Related", 2 => "Employee Related");
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Action:</h3>
                            <table id="dataTables-example-actions" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Action Date</th>
                                        <th>Actions Type</th>
                                       <!--  <th>Description</th> -->
                                        <th>Discipline Type</th>
                                        <th>Incident Category</th>
                                        <th>Incident Type</th>
                                        <th>Location</th>
                                        <th>Supervisor Report Date</th>
                                        <th>Discipline Type</th>
                                        <th>Description</th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->action_date) . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $action_type . "</td>";
                                        /* print"<td id='catD" . $pdt . "'>" . ucwords($row->report_description) . "</td>"; */
                                        print"<td id='catE" . $pdt . "'>";
                                        if ($row->discipline_type != 0) {
                                            print $this->Common_model->get_name($this, $row->discipline_type, 'main_disciplinetype', 'discipline_type') . "</td>";
                                        } else {
                                            print" - </td>";
                                        }
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->tncident_type, 'main_incidenttype', 'incident_type') . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $incident_category[$row->incident_category] . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . ucwords($row->accident_location) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $row->supervisor_report_date . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $row->report_description . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $row->discipline_type . "</td>";
                                        
                                        
                                         
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else{
                        ?>
                         <div class="table-responsive overflow-x">
                          <h3>  Action:</h3>
                            <table id="dataTables-example-actions" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                       <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Action Date</th>
                                        <th>Actions Type</th>
                                        <!-- <th>Description</th> -->
                                        <th>Discipline Type</th>
                                        <th>Incident Category</th>
                                        <th>Incident Type</th>
                                        <th>Location</th>
                                        <th>Supervisor Report Date</th>
                                        <th>Discipline Type</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td> <?php echo "-"; ?> </td>
                                       <!--  <td> <?php //echo "-"; ?> </td> -->
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $enrolling_query = $this->db->get_where('main_emp_enrolling', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($enrolling_query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Enrolling:</h3>
                            <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Relationship</th>
                                        <th>Gender</th>                            
                                        <th>Date Of Birth</th> 
                                        <th>SSN</th> 
                                        <th>Collage Student</th>
                                        <th>Tobacco User</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $gender_array = $this->Common_model->get_array('gender');
                                    $items = array(0 => 'No', 1 => 'Yes');
                                    foreach ($enrolling_query->result() as $rowen) {
                                        $i++;
                                        $pdt = $rowen->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $rowen->fast_name . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $rowen->last_name . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $rowen->relationship_id, 'main_relationship_status', 'relationship_status') . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $gender_array[$rowen->gender] . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($rowen->birthdate) . "</td>";
                                        print"<td id='catD" . $pdt . "'>" .   $rowen->ssn_code . "</td>";
                                        print"<td id='catD" . $pdt . "'>" .  $items[$rowen->iscollage_student] . "</td>";
                                        print"<td id='catD" . $pdt . "'>" .  $items[$rowen->istobacco_user] . "</td>";
                                        
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                            <h3>Enrolling:</h3>
                            <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Relationship</th>
                                        <th>Gender</th>                            
                                        <th>Date Of Birth</th>
                                        <th>SSN</th> 
                                        <th>Collage Student</th>
                                        <th>Tobacco User</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    $percent_dollars_array = $this->Common_model->get_array('percent_dollars');
                    $query = $this->db->get_where('main_emp_benefit', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Benefits Tracking:</h3>
                            <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Enrolling</th>
                                        <th>Provider</th>
                                        <th>Benefit Type</th>
                                        <th>Eligible Date</th>
                                        <th>Enrolled Date</th>
                                        <th>Percent Dollars</th>
                                        <th>Employee Portion</th>
                                        <th>Employer Portion</th>
                                        <th>Description</th>
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
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->enrolling, 'main_emp_enrolling', 'fast_name') . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $row->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->eligible_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->enrolled_date) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->percent_dollars . "</td>";
                                         print"<td id='catE" . $pdt . "'>" .$row->employee_portion . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->employer_portion . "</td>"; 
                                        print"<td id='catE" . $pdt . "'>" . $row->description . "</td>";
                                        print"</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                     <?php
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Benefits Tracking:</h3>
                            <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Enrolling</th>
                                        <th>Provider</th>
                                        <th>Benefit Type</th>
                                        <th>Eligible Date</th>
                                        <th>Enrolled Date</th>
                                        <th>Percent Dollars</th>
                                        <th>Employee Portion</th>
                                        <th>Employer Portion</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                   <?php }
                    if ($this->user_group == 12 || $this->user_group == 11) {
                        $query = $this->db->get_where('main_pto_policy', array('company_id' => $this->company_id, 'isactive' => 1));
                    } else {
                        $query = $this->db->get('main_pto_policy', array('isactive' => 1));
                    }
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> PTO:</h3>
                            <div style="overflow-y:scroll">
                                <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>S.No </th>
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
                                            print"<td id='catD" . $pdt . "'>" . $accural_period . "</td>"; //$accrual_period_array[$row->accrual_period] substr
                                            print"<td id='catE" . $pdt . "'>" . $start_date_hire . "</td>"; //$this->Common_model->add_date($hire_date, $row->start_days_after_hire)
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
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> PTO:</h3>
                            <div style="overflow-y:scroll">
                                <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
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
                                        <tr>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                    
                   <?php
                    }
                    $query = $this->db->get_where('main_emp_company_policies', array('employee_id' => $employee_id, 'isactive' => 1));
                    $status_array = array(0 => "Disagree",1 => "Agree");
                    if ($query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive overflow-x">
                           <h3> Policy Review:</h3>
                            <div style="overflow-y:scroll">
                                <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Company Name </th>
                                            <th>Policy Name</th>
                                            <th>Policy </th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($query->result() as $row) {
                                            $i++;
                                            $pdt = $row->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                                            print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $row->policy_id, 'main_company_policies', 'policy_name') . "</td>";
                                            print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->policy_id, 'main_company_policies', 'custom_text') . "</td>"; //$accrual_period_array[$row->accrual_period] substr
                                            print"<td id='catE" . $pdt . "'>" . $status_array[$row->is_aggree] . "</td>"; //$this->Common_model->add_date($hire_date, $row->start_days_after_hire)
                                            print"</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                    
                       <?php
                    } else{
                        ?>
                        <div class="table-responsive overflow-x">
                          <h3> Policy Review:</h3>
                            <div style="overflow-y:scroll">
                                <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Company Name </th>
                                            <th>Policy Name</th>
                                            <th>Policy </th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                            <td> <?php echo "-"; ?> </td>
                                        </tr>
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
                        <div class="table-responsive overflow-x">
                            <h3>Appraisal Review:</h3>
                            <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Employee Name</th>
                                        <th>Reviewer Name</th>
                                        <th>Review Date</th>
                                        <th>Issue Date</th>
                                       <!--  <th>Action</th> -->
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
                                        /* print '<td><a title="Preview" href="' . base_url() . 'Con_PerformanceReviewBuilder/appraisal_completed/' . $employee_id . '/' . $row->temp_app_id . '" target="_blank"><i class="fa fa-eye"></i></a></td>'; */
                                        print "</tr>";
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>                    
                        <?php
                    } else{
                        ?>
                         <div class="table-responsive overflow-x">
                           <h3> Appraisal Review:</h3>
                            <table id="dataTables-example-pto" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Employee Name</th>
                                        <th>Reviewer Name</th>
                                        <th>Review Date</th>
                                        <th>Issue Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
                                        <td> <?php echo "-"; ?> </td>
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
</div>
           <!--  <a class="btn btn-default" title="Download PDF Form" href="<?php //echo base_url() . "Con_ComprehensiveReport/comprehensive_report/" . $prow->employee_id; ?>" ><i class="fa fa-download"></i>Download</a> -->
            <!-- <button class="btn btn-default"><i class="fa fa-download"></i> Download</button> -->
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>
</div><!--/row-->
</div><!--/container-->
<!--=== End Content ===-->