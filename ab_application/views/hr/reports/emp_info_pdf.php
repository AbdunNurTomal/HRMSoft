<!DOCTYPE html>
<html><body>
    <h2 style='margin-top:0;text-align:center'>Employee Information</h2> 
    <?php
        $employee_id = $this->uri->segment(3);
        $query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
        if ($query) {
            foreach ($query->result() as $row) {
                $employeeImage = "blank.png";
                if ($row->image_name) {
                    $employeeImage = $row->image_name;
                    $empImagesBasePath = FCPATH . "uploads/emp_image/" . $employeeImage;
                    if (!file_exists($empImagesBasePath)) {
                        $employeeImage = "blank.png";
                    }
                }
            }
            $employee_name = $this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');
        };
    ?>
    <div style="padding-left: 0%; padding-right: 0%;" >
        <div class="row image-caption" style="margin-left: 80% !important;">
            <img class="rounded-x" src="<?php echo Get_File_Directory('uploads/emp_image/' . $employeeImage) ?>" alt="" height="100" width="95">
        </div>
        <div class="row" style="margin-right: 90% !important;">
            <label style="font-size: 1.20em; font-weight: bold;">Employee Name:<label>
            <span class="layout-loggedin-username-report emp-name" style="margin-top: 3px;"><?= $employee_name; ?></span> 
        </div>
    </div>

    <!-- Personal information table starts -->
    <p>Personal Information:-</p>
    <table  style="width:100%; border-collapse: collapse;">
        <tbody>
            <?php
                //$employee_id = $this->uri->segment(3);
                $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                if ($personal_info_query->num_rows() > 0) :
                    $i = 0;
                    foreach ($personal_info_query->result() as $prow) :
                        $i++;
            ?>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Employee Name :</th>
                    <?php $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','last_name');?>
                    <td><?php echo $employee_name;?></td>
                    <th style="width:1%; white-space:nowrap;">Marital Status:</th>
                    <td><?php echo ($prow->marital_status == 1) ? "Married" : "Unmarried"; ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">SSN :</th>
                    <?php  $number = "XXX-XX-" . substr($this->Common_model->decrypt($prow->ssn_code), -4); ?>
                        <td><?php echo $number; ?></td>
                    <th style="width:1%; white-space:nowrap;">Email : </th>
                        <td><?php echo $prow->email; ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Hire Date :</th>
                        <td><?php echo $this->Common_model->show_date_formate($prow->hire_date); ?></td>
                    <th style="width:1%; white-space:nowrap;">Birth Date :</th>
                        <td><?php echo $this->Common_model->show_date_formate($prow->birthdate); ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%; ">Position :</th>
                        <td><?php echo $this->Common_model->get_name($this, $prow->position, 'main_jobtitles', 'job_title'); ?></td>
                    <th style="width:1%; white-space:nowrap;">Mobile Phone :</th>
                        <td><?php echo $prow->mobile_phone; ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%; ">Address :</th>
                        <td><?php echo  $prow->first_address; ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%; ">State :</th>
                        <td><?php echo $this->Common_model->get_name($this, $prow->state, 'main_state', 'state_name'); ?></td>
                </tr>  
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%; ">City :</th>
                        <td><?php echo  $prow->city; ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Zip</th>
                        <td><?php echo $prow->zipcode; ?></td>
                </tr>
        <?php 
                endforeach;
            else :
        ?>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Employee Name :</th>
                    <?php //$employee_name=$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$prow->employee_id,'main_employees','last_name');?>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <th style="width:1%; white-space:nowrap;">Marital Status:</th>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">SSN :</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                    <th style="width:1%; white-space:nowrap;">Email : </th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Hire Date :</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                    <th style="width:1%; white-space:nowrap;">Birth Date :</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%; ">Position :</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                    <th style="width:1%; white-space:nowrap;">Mobile Phone :</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
                    <!-- <tr>
                    <th style="width:1%; white-space:nowrap; height:2%; ">Address :</th>
                        <td><?php // echo $prow->first_address; ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%; ">State</th>
                        <td><?php // echo $this->Common_model->get_name($this, $prow->state, 'main_state', 'state_name'); ?></td>
                </tr> -->
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%; ">City :</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Zip</th>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Personal information table ends -->

    <!-- Work Related Information starts-->
    <p>Work Related Information:-</h3>
    <table  style="width:100%; border-collapse: collapse;">
        <tbody>
        <?php
            $wquery = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id, 'isactive' => 1));
            if ($wquery->num_rows() > 0) :
                $i = 0;
                foreach ($wquery->result() as $wrow) :
                    $i++;
        ?>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Location : </th>
                    <td><?php echo $this->Common_model->get_name($this, $wrow->location, 'main_location', 'location_name'); ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Department : </th>
                    <td><?php echo $this->Common_model->get_name($this, $wrow->department, 'main_department', 'department_name'); ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Reporting Manager : </th>
                    <td><?php echo $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'last_name'); ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Wages : </th>
                    <td><?php echo $this->Common_model->get_name($this, $wrow->wages, 'main_payfrequency', 'freqtype'); ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Salary Type : </th>
                    <td><?php echo ($wrow->salary_type == 1) ? "Hourly" : "Salary"; ?> </td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Employee Type : </th>
                    <td><?php echo $this->Common_model->get_name($this, $wrow->employee_type, 'tbl_employmentstatus', 'employemnt_status')  ?></td>
                </tr>
            <?php endforeach;
                else : ?>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Location : </th>
                    <td><?php echo "-"; ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Department : </th>
                    <td><?php echo "-"; ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Reporting Manager : </th>
                    <td><?php echo "-"; ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Wages : </th>
                    <td><?php echo "-"; ?></td>
                </tr>
                <tr>
                    <th style="width:1%; white-space:nowrap; height:2%;">Salary Type : </th>
                    <td><?php echo "-"; ?></td>
                    <th style="width:1%; white-space:nowrap; height:2%;">Employee Type : </th>
                    <td><?php echo "-"; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Work Related Information ends-->

    <!-- Wage & Compensation starts-->
    <p>Wage & Compensation:-</p>
    <table style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="20%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th >Company Name</th>
            <th >Date</th>
            <th >Wage Type</th>
            <th>Position</th>
            <th >Pay Schedule</th>
            <th >Yearly Salary</th>
        </tr>
        <tbody>
            <?php
                $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
                $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','position');
                
                $wage_type_query=$this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id,'isactive' => 1));
                
                $wage_type_array = $this->Common_model->get_array('wage_type');
                $status_array = $this->Common_model->get_array('status');
                $waquery = $this->db->get_where('main_emp_wage_compensation', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($wquery->num_rows() > 0) :
                    if ($waquery) :
                        $i = 0;
                        foreach ($waquery->result() as $row) :
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
                    <td><?php echo $this->Common_model->get_name($this, $row->pay_schedule,'main_payfrequency_type', 'freqcode'); ?></td>
                    <td><?php echo $row->yearly_salary; ?></td>
                </tr>
            <?php endforeach;
                endif;
            else :
            ?>
                <tr>
                    <td class="table-text"><?php echo "-"; ?></td>
                    <td class="table-text"><?php echo "-"; ?></td>
                    <td class="table-text"><?php echo "-"; ?></td>
                    <td class="table-text"><?php echo "-"; ?></td>
                    <td class="table-text"><?php echo "-"; ?></td>
                    <td class="table-text"><?php echo "-"; ?></td>
                    <td class="table-text"><?php echo "-"; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Wage & Compensation ends-->

    <!-- Asset Information starts-->
    <p> Asset Information:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="20%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No </th>
            <th > Company Name</th>
            <th >Issued Date</th>
            <th >Returned Date</th>
            <th >Asset Id</th>
            <th >Asset</th>
            <th >Quantity</th>
            <th >Value</th>
        </tr>
        <tbody>
        <?php
            $query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id, 'isactive' => 1));
            if ($query->num_rows() > 0) :
                $i = 0;
                foreach ($query->result() as $row) :
                    $i++;
        ?>
            <tr>
                <td> <?php echo $i ?> </td>
                <td> <?php echo $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name'); ?></td>
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
            endforeach;
        else : ?>
            <tr>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?></td>
                <td class="table-text"> <?php echo "-"; ?></td>
                <td class="table-text"><?php echo "-"; ?> </td>
                <td class="table-text"><?php echo "-"; ?></td>
                <td class="table-text"> <?php echo "-"; ?></td>
                <td class="table-text"> <?php echo "-"; ?></td>
                <td class="table-text"> <?php echo "-"; ?></td>
            </tr>
         <?php endif; ?>
            </tbody>
        </table>
    <!-- Asset Information ends-->

    <!-- Education Information starts-->
     <p>Education Information:-</p>
    <table  style="width:100% !important; border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="20%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No </th>
            <th >Company Name</th>
            <th >Education Level</th>
            <th >Institution Name</th>
            <th >No of Years</th>
            <th >Certification or Degree</th>  
            <th >Remarks</th>
        </tr>
        <tbody>
            <?php
                $query = $this->db->get_where('main_emp_education', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query->num_rows() > 0) :
                    if ($query) :
                        $i = 0;
                        foreach ($query->result() as $row) :
                            $i++;
                            $pdt = $row->id;
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
                        endforeach;
                    endif;
                else :
            ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"><?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table> 
    <!-- Education Information ends-->

    <!--Experience Information starts-->
     <p>Experience Information:-</p>
    <table   style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="20%">
            <col width="15%">
            <col width="15%">
            <col width="25%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th >Company Name</th>
            <th >Position</th>
            <th >From Date</th>
            <th >To Date</th>
            <th >Reason for Leaving</th>
        </tr>
        <tbody>
            <?php
                $yes_no_query = $this->Common_model->get_array('yes_no');
                $query = $this->db->get_where('main_emp_experience', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query->num_rows() > 0) :
                    $i = 0;
                    foreach ($query->result() as $row) :
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
                        print"</tr>";
                    endforeach;
                else :
            ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
        <?php endif; ?> 
        </tbody>
    </table>
    <!--Experience Information ends-->

    <!--Skills Information Starts-->
    <p> Skills Information:-</p>
    <table  style="width:100%;border-collapse: collapse;">
            <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="30%">
            <col width="20%">
            <col width="25%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th >Company Name</th>
            <th >Skill Name</th>
            <th >Years of Experience</th>
            <th >Competency Level</th>
        </tr>
        <tbody>
            <?php
                $query = $this->db->get_where('main_emp_skills', array('employee_id' => $employee_id, 'isactive' => 1));
                    if ($query->num_rows() > 0) :
                    $i = 0;
                    foreach ($query->result() as $row) :
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->company_id, 'main_company', 'company_full_name') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->skillname) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->yearsofexp . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->competencylevelid, 'main_competencylevels', 'competencylevels') . "</td>";
                        print"</tr>";
                    endforeach;
                else: 
            ?>
            <tr>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <!--Skills Information ends-->

    <!--Language Information starts-->
    <p> Language Information:-</p>
    <table  style="width:100%;border-collapse: collapse;">
            <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="30%">
            <col width="20%">
            <col width="25%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No </th>
            <th >Company Name </th>
            <th >Languages Name</th>
            <th >Languages Skill</th>
            <th >Competency Level</th>
        </tr>
        <tbody>
            <?php
                $languages_skill_array = $this->Common_model->get_array('languages_skill');
                $query = $this->db->get_where('main_emp_languages', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query->num_rows() > 0) {
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
                } else{
            ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!--Language Information ends-->

    <!--Training Certification Information starts-->
    <p> Training Certification Information:-</p>
    <table   style="width:100% !important;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="20%">
            <col width="10%">
            <col width="10%"> 
            <col width="15%">
            <col width="5%">
            <col width="5%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No </th>
            <th>Company Name</th>
            <th>Course Name</th>
            <th>Course Level</th>
            <th>Certification Name</th>
            <th>Description</th>
            <th>Issued Date</th>
            <th>Training Type </th>
        </tr>
        <tbody>
            <?php
                $query = $this->db->get_where('main_emp_certification', array('employee_id' => $employee_id, 'isactive' => 1));
                $training_type_array = $this->Common_model->get_array('training_type');
                if ($query->num_rows() > 0) {
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
                        print"</tr>";
                    }
                } else {
            ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"><?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
    <!--Training Certification Information ends-->

    <!--License Information starts-->
    <p> License Information:-</p>
    <table  style="width:100% !important; border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="25%">
            <col width="22%">
            <col width="11%">
            <col width="11%"> 
            <col width="15%">
            <col width="11%">
            <col width="11%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No </th>
            <th>Company Name</th>
            <th>License Type</th>
            <th>State Issued</th>
            <th>Issued Date</th>
            <th>Expiration Date</th>
            <th>Unspecific Date</th>
        </tr>
        <tbody>
            <?php
                $yes_no_array = $this->Common_model->get_array('yes_no');
                $query = $this->db->get_where('main_emp_license', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query->num_rows() > 0) :
                    $i = 0;
                    foreach ($query->result() as $row) :
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
                    endforeach;
                else :
            ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!--License Information ends-->

    <!--Absence Tracking Information starts-->
    <p> Absence Tracking Information:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="25%">
            <col width="22%">
            <col width="11%">
            <col width="11%"> 
            <col width="10%">
            <col width="16%">
            <col width="11%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No </th>
            <th>Company Name</th>
            <th>Absent Type</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Total Days</th>
            <th>Details Reason</th>
            <th>Leave Type</th>
        </tr>
        <tbody>
            <?php
                $absent_type_array = $this->Common_model->get_array('absent_type');
                $yes_no_array = $this->Common_model->get_array('yes_no');
                $leave_type_query = $this->Common_model->listItem('main_employeeleavetypes');

                $query = $this->db->get_where('main_emp_absencetracking', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query->num_rows() > 0) {
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
                } else {
            ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
    <!--Absence Tracking Information ends-->


    <!--Emergency Contact Information starts-->
    <p>Emergency Contact Information:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <col width="10%"> 
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
            <tr>
            <th style="width:25px;">S.No</th>
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
        <tbody>  
            <?php
                $query = $this->db->get_where('main_emp_emergencycontact', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query->num_rows() > 0) {
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
                }else{
            ?>
                    <tr>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                        <td class="table-text"> <?php echo "-"; ?> </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <!--Emergency Contact Information ends-->

    <!--Action starts-->
    <p> Action:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <col width="10%"> 
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th>Company Name</th>
            <th>Action Date</th>
            <th>Actions Type</th>
            <!-- <th style="white-space:nowrap; height:2%;">Description</th> -->
            <th>Discipline Type</th>
            <th>Incident Category</th>
            <th>Incident Type</th>
            <th >Location</th>
            <th>Supervisor Report Date</th>
            <th>Discipline Type</th>
            <th>Description</th>
        </tr>
        <tbody>
    <?php
        $query = $this->db->get_where('main_emp_actions', array('employee_id' => $employee_id, 'isactive' => 1));
        $incident_category = array(0=> "", 1 => "Customer Related", 2 => "Employee Related");
        if ($query->num_rows() > 0) {
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
            /*  print"<td id='catD" . $pdt . "'>" . ucwords($row->report_description) . "</td>"; */
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
        } else{
    ?>
            <tr>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <!-- <td class="table-text"> <?php //echo "-"; ?> </td> -->
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
            </tr>
    <?php
        }
    ?>
        </tbody>
    </table>
    <!-- Action ends -->

    <!-- Enrolling starts -->
    <p> Enrolling:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <col width="10%"> 
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
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
        <tbody>
        <?php
            $enrolling_query = $this->db->get_where('main_emp_enrolling', array('employee_id' => $employee_id, 'isactive' => 1));
        if ($enrolling_query->num_rows() > 0) {
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
        } else{
        ?>
            <tr>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
            </tr>
    <?php
        }
    ?>
        </tbody>
    </table>
    <!-- Enrolling ends -->

    <!-- Benefits Tracking starts -->
    <p> Benefits Tracking:-</p>
        <table  style="width:100%;border-collapse: collapse;">
            <colgroup>
                <col width="5%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%"> 
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <tr>
                <th style="width:25px;">S.No</th>
                <th>Company Name</th>
                <th>Enrolling</th>
                <th >Provider</th>
                <th >Benefit Type</th>
                <th >Eligible Date</th>
                <th >Enrolled Date</th>
                <th >Percent Dollars</th>
                <th >Employee Portion</th>
                <th >Employer Portion</th>
                <th >Description</th>
            </tr>
            <tbody>
        <?php
            $percent_dollars_array = $this->Common_model->get_array('percent_dollars');
            $query = $this->db->get_where('main_emp_benefit', array('employee_id' => $employee_id, 'isactive' => 1));
            if ($query->num_rows() > 0) {
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
            } else{
                
        ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
            <?php
            }
        ?>
            </tbody>
        </table>
    <!--Benefits Tracking ends-->

    <!-- PTO starts -->
    <p> PTO:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="25%">
            <col width="12%">
            <col width="12%">
            <col width="12%"> 
            <col width="12%">
            <col width="11%">
            <col width="11%">
            <!-- <col width="10%">
            <col width="10%">
            <col width="10%"> -->
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th>Leave Type </th>
            <th>Accrual Amt(hours)</th>
            <th >Accrual period  </th>
            <th>Start Date</th>
            <th>Max Accrual</th>
            <th>Max Available</th>
            <th>Max Carryover</th>
        </tr>
        <tbody>
                    
    <?php
        if ($this->user_group == 12 || $this->user_group == 11) {
            $query = $this->db->get_where('main_pto_policy', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $query = $this->db->get('main_pto_policy', array('isactive' => 1));
        }
        if ($query->num_rows() > 0) {
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
                /* print"<td id='catE" . $pdt . "'>" . "" . "</td>";
                print"<td id='catB" . $pdt . "'>" . "" . "</td>";
                print"<td id='catC" . $pdt . "'>" . "" . "</td>";
                print"<td id='catD" . $pdt . "'>" . "" . "</td>"; */
                print"</tr>";
            }
        } else{
        ?>
            <tr>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <!-- <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text">  <?php echo "-"; ?> </td> -->
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <!-- PTO ends -->

    <!-- Policy Review starts -->
    <p> Policy Review:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="30%">
            <col width="20%">
            <col width="25%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th>Company Name </th>
            <th>Policy Name</th>
            <th>Policy </th>
            <th>Status</th>
        </tr>
        <tbody>
        <?php
            $query = $this->db->get_where('main_emp_company_policies', array('employee_id' => $employee_id, 'isactive' => 1));
            $status_array = array(0 => "Disagree",1 => "Agree");
            if ($query->num_rows() > 0) {
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
                } else{
        ?>
                <tr>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                    <td class="table-text"> <?php echo "-"; ?> </td>
                </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <!--Policy Review ends-->

    <!--Appraisal Review starts-->
    <p>Appraisal Review:-</p>
    <table  style="width:100%;border-collapse: collapse;">
        <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="30%">
            <col width="20%">
            <col width="25%">
        </colgroup>
        <tr>
            <th style="width:25px;">S.No</th>
            <th>Employee Name</th>
            <th>Reviewer Name</th>
            <th>Review Date</th>
            <th>Issue Date</th>
        </tr>
        <tbody>
    
    <?php
        $query = $this->db->select('temp_app_id, employee_id, user_id, employee_name, review_start_date, review_end_date, review_date')->get_where('main_appraisal_records', array('employee_id' => $employee_id));
        if ($query->num_rows() > 0) {
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
        } else{
    ?>
            <tr>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
                <td class="table-text"> <?php echo "-"; ?> </td>
            </tr>
    <?php
        }
    ?>
        </tbody>
    </table>
    <!--Appraisal Review ends-->

    <style type="text/css">
         td, th{ border:1px solid #000; font-size:10px; }
        table{margin-top:5px}
        p{margin:0;padding-top:15px;}
       /* .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-striped > tbody > tr:nth-of-type(2n+0) {
            background-color: #E7E7E7;
        }
         .table {
            float: left;
            width: 100%;
            clear: both;
            margin: 0 0 10px 0;
            padding: 0;
            border: 1px solid #BBBBBB;
            position: relative;
        } 

        .table-bordered {
            border: 1px solid #ddd;
        }  
        .obrevtbl > thead > tr {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .table > thead > tr {
            background-color: #534f74;
            color: #fff;
        }*/
        .table-text {
            text-align: center;
        }

        .layout-loggedin-username-report {
            font-size: 1.20em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: right;
            margin-left: 0px;
            padding-left: 7px;
        }
        .image-caption {
            text-align: center;
        }
        .emp-name{
            color: #2c87f0;
            font-size: 1.20em;
            font-weight: bold;
        }
        .rounded-x {
            border-radius: 50% !important;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
    </style>

   </html>