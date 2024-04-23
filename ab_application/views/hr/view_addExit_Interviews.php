<?php

function drop_down_selected($num = '') {

    $out = '<option></option>';
    for ($ind = 1; $ind <= 10; $ind++) {
        $slct = ($num == $ind) ? 'selected' : '';
        $out .= '<option value="' . $ind . '" ' . $slct . '>' . $ind . '</option>';
    }

//    echo $out;
//    die("sdajfhsjkdhfkjsdhfkj");
    return $out;
}
?>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top:0px; width:96%; padding-bottom:15px;">
            <?php
            if ($type == 1) {//entry
                if ($this->user_group !=1 || $this->user_group !=2 || $this->user_group !=3) {                   
                    $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                } else {                   
                    $employees_query = $this->db->get_where('main_employees', array('isactive' => 1));
                }
                //echo $this->db->last_query();
                //pr($employees_query->result());

                $termination_type_array = $this->Common_model->get_array('termination_type');
                ?>
                <form id="sky-form11" name="sky-form11" class="form-horizontal termination-form" method="post" action="#" enctype="multipart/form-data" role="form" >
                    <div class="col-md-12" style="margin-top:10px">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Employee <span class="req"/> </label>
                                <div class="col-sm-4">
                                    <select name="employee_id" id="employee_id" onchange="set_emp_value(this.value);" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($employees_query->result() as $row) {
                                            print"<option value='" . $row->employee_id . "'>" . $row->first_name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <label class="col-sm-2 control-label">Termination type <span class="req"/> </label>
                                <div class="col-sm-4">
                                    <select name="termination_type" id="termination_type" class="col-xs-12 myselect2 input-sm">
                                        <option></option> 
                                        <?php
                                        foreach ($termination_type_array as $row => $val) {
                                            print"<option value='" . $row . "'>" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!---------------------------------------------- Voluntary Termination --------------------------------------------->
                        <div id="voluntary" class="hide">

                            <div class="col-md-12" style="margin-top:40px">
                                <div class="form-group">                        
                                    <label class="col-sm-2 control-label">Name (optional):</label> 
                                    <div class="col-sm-4">
                                        <input type="text" name="name_optional" id="name_optional" class="form-control input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                    </div>                                                    
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-2 control-label">Resignation Date:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="resign_date" id="resign_date" class="form-control dt_pick input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                    </div>
                                    <label class="col-sm-2 control-label">Hire Date:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="hire_date" id="hire_date" class="form-control dt_pick input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-2 control-label">Job Title:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="job_title" id="job_title" class="form-control input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                    </div>
                                    <label class="col-sm-2 control-label">Location:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="location" id="location" class="form-control input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                    </div>                        
                                </div>
                            </div>

                            <div class="col-sm-12" style="margin-top:50px">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">REASON(S) FOR LEAVING :<br/>( <i style="font-weight:normal">Mark as many as Applicable</i> )</label>
                                    <div class="col-sm-1">&nbsp;</div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[1]" value="Obtained a new job">Obtained a new job</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[2]" value="Dissatisfied with pay">Dissatisfied with pay</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[3]" value="Moving from area">Moving from area</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[4]" value="Family circumstances">Family circumstances</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[5]" value="Health reasons">Health reasons</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[6]" value="Dissatisfied with type of work">Dissatisfied with type of work</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[7]" value="Dissatisfied with supervisor">Dissatisfied with supervisor</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_leaving[0]" value="Other" class="other_explain">Other (please explain):</label>
                                            <textarea type="text" name="reason_for_leaving[other_leaving_reason]" id="" class="form-control" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12"><h5 style="margin-top:50px;font-weight:bolder;font-size:20px;font-style:italic">
                                            Please rate the following from 1 to 10 - with 10 being the best:</h5>
                                    </div>
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Training for Employees:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[training_for_employees][rating]" id="training_for_employees" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[training_for_employees][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Employee Benefits:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[employee_benefits][rating]" id="employee_benefits" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[employee_benefits][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Career Advancement Opportunities:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[career_advancement][rating]" id="career_advancement" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[career_advancement][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Management and Supervision:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[management_and_supervision][rating]" id="management_and_supervision" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[management_and_supervision][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">General Working Conditions:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[general_working][rating]" id="general_working" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[general_working][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Compensation:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[compensation][rating]" id="compensation" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[compensation][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Nature and Type of Your Work:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[nature_and_type_of_work][rating]" id="nature_and_type_of_work" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[nature_and_type_of_work][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Job Met Your Expectations:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[job_met_expectations][rating]" id="job_met_expectations" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[job_met_expectations][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Quality of Company's Service to Customers or Clients:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[quality_of_company][rating]" id="quality_of_company" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[quality_of_company][comments]" id="quality_of_company" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Company's Commitment to Its Employees and Their Welfare:</label>
                                    <div class="col-sm-3">
                                        <select name="voluntary_rate[company_commitment][rating]" id="company_commitment" class="col-xs-12 myselect2 input-sm">
                                            <!---------SELECT OPTIONS HERE-------->
                                            <?php echo drop_down_selected(); ?>
                                            <!------------------------------------>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Comment:</label>
                                    <div class="col-sm-4">
                                        <textarea name="voluntary_rate[company_commitment][comments]" id="company_commitment" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"></textarea>
                                    </div>                        
                                </div>
                                <div class="form-group" style="margin-top:50px">                        
                                    <label class="col-sm-4 control-label">Please provide any additional information you feel could make a difference in our policies and practices:</label>
                                    <div class="col-sm-8">
                                        <textarea name="additional_info" id="additional_info" rows="4" class="form-control"data-toggle="tooltip" data-placement="bottom" autocomplete="off"></textarea>
                                    </div>                                                      
                                </div>
                            </div>

                            <div class="col-md-12">                          
                                <div class="form-group pull-right">
                                    <div class="col-sm-12">
                                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Exit_Interview" ?>">Close</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-------------------------------------------- In-voluntary Termination -------------------------------------------->


                        <div class="col-md-12 hide" id="involuntary" style="margin-top:40px">
                            <div class="form-group">                        
                                <label class="col-sm-3 control-label">Position and Department:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="position_and_dept" id="position_and_dept" class="form-control input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" autocomplete="off">
                                </div>                                                    
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Reason(s) for Termination :<br/>( <i style="font-weight:normal">Mark as many as Applicable</i> )</label>
                                <div class="col-sm-1">&nbsp;</div>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[1]" value="Layoff">Layoff</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[2]" value="Substandard performance">Substandard performance</label>
                                    </div>                           
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[3]" value="Continued poor attendance">Continued poor attendance</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[4]" value="Insubordination">Insubordination</label>
                                    </div>                                    
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[6]" value="Position eliminated">Position eliminated</label>
                                    </div>                           
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[7]" value="Temporary or seasonal position">Temporary or seasonal position</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">         
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="reason_for_termination[5]" value="Violation of policy" class="violation_policy">Violation of policy</label>
                                        <textarea type="text" name="reason_for_termination[violation_of_policy]" id="" class="form-control" disabled></textarea>
                                    </div>                 
                                    <div class="checkbox">
                                        <label><input type="checkbox"  name="reason_for_termination[0]" value="Other" class="other_explain">Other (please explain):</label>
                                        <textarea type="text" name="reason_for_termination[other_termination_reason]" id="" class="form-control" disabled></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top:50px">
                                <label class="col-sm-3 control-label">Recommendation for Discharge:</label>
                                <div class="col-sm-9">                                    
                                    <div class="col-sm-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="recomm_for_discharge[1]" value="All normal steps of progressive discipline have been completed, and there is no realistic hope for improvement">All normal steps of progressive discipline have been completed, and there is no realistic hope for improvement.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="recomm_for_discharge[2]" value="Employee has been repeatedly counseled and assisted regarding performance deficiencies, but there is no realistic hope for improvement">Employee has been repeatedly counseled and assisted regarding performance deficiencies, but there is no realistic hope for improvement.</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="recomm_for_discharge[3]" value="All alternatives such as transfer and retraining have been considered">All alternatives such as transfer and retraining have been considered.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="recomm_for_discharge[4]" value="The employee’s infractions and all above steps have been fully documented and records included with the recommendation for discharge">The employee’s infractions and all above steps have been fully documented and records included with the recommendation for discharge.</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="recomm_for_discharge[5]" value="Recommendation for discharge and all supporting documents have been placed in the employee’s personnel file">Recommendation for discharge and all supporting documents have been placed in the employee’s personnel file.</label>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top:50px">
                                <label class="col-sm-3 control-label">Interview Procedure:</label>
                                <div class="col-sm-9">
                                    <div class="col-sm-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[1]" value="Recap the application of progressive discipline">Recap the application of progressive discipline.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[2]" value="If the employee requests a witness or support person, you may have to allow it. Consult with a knowledgeable employment law attorney to determine the requirements under current law, as the law in this area has shifted several times in recent years">If the employee requests a witness or support person, you may have to allow it. Consult with a knowledgeable employment law attorney to determine the requirements under current law, as the law in this area has shifted several times in recent years.</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[3]" value="State the specific reasons for the discharge">State the specific reasons for the discharge.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[4]" value="If the employee raises a question about finality, emphasize that the decision is final unless company policy and procedure provides for some appeal">If the employee raises a question about finality, emphasize that the decision is final unless company policy and procedure provides for some appeal.</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[5]" value="If the tenor of the interview allows it, solicit employee feedback on issues of interest to the employer">If the tenor of the interview allows it, solicit employee feedback on issues of interest to the employer.</label>
                                        </div> 
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[6]" value="Arrange to obtain company property in the possession of the employee">Arrange to obtain company property in the possession of the employee.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[7]" value="Provide the employee his or her final paycheck if required by state law, or explain when he or she will receive the last paycheck. Also advise whether the employee will receive accrued vacation pay, and details of any other compensation or benefits that he or she will receive">Provide the employee his or her final paycheck if required by state law, or explain when he or she will receive the last paycheck. Also advise whether the employee will receive accrued vacation pay, and details of any other compensation or benefits that he or she will receive.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[8]" value="Advise the employee of COBRA or other options for continuing health coverage">Advise the employee of COBRA or other options for continuing health coverage.</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="interview_procedure[9]" value="Conclude the interview as quickly as possible">Conclude the interview as quickly as possible.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group pull-right">
                                <div class="col-sm-12">
                                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Exit_Interview" ?>">Close</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                if ($this->user_group !=1 || $this->user_group !=2 || $this->user_group !=3) {                    
                    $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                } else {//                    
                    $employees_query = $this->db->get_where('main_employees', array('isactive' => 1));
                }
                $termination_type_array = $this->Common_model->get_array('termination_type');
                ?>

                <form id="sky-form11" name="sky-form11" class="form-horizontal termination-form" method="post" action="<?php echo base_url() . 'Con_Exit_Interview/update_exit_interview/' . $id . '/' . $termination_type; ?>" enctype="multipart/form-data" role="form" >
                    <div class="col-md-12" style="margin-top:10px">

                        <input type="hidden" value="<?php echo $termination_data['employee_id']; ?>" name="term_employee_id"/>
                        <input type="hidden" value="<?php echo $termination_type; ?>" name="termination_type"/>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Employee<span class="req"/></label>
                                <div class="col-sm-4">
                                    <select name="employee_id" id="employee_id" onchange="emp_info(this.value);" disabled class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($employees_query->result() as $row) {
                                            $slct = ($row->employee_id == $termination_data['employee_id']) ? 'selected' : '';
                                            print"<option value='" . $row->employee_id . "' " . $slct . ">" . $row->first_name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-sm-2 control-label">Termination type<span class="req"/></label>
                                <div class="col-sm-4">
                                    <select name="termination_type" id="termination_type" disabled class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($termination_type_array as $row => $val) {
                                            $slct = ($row == $termination_type) ? 'selected' : '';
                                            print"<option value='" . $row . "' " . $slct . ">" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!---------------------------------------------- Voluntary Termination --------------------------------------------->
                        <?php
                        if ($termination_type == 0):

                            $reason_for_leaving = json_decode($termination_data['reason_for_leaving'], true);
                            $voluntary_rate = json_decode($termination_data['voluntary_rate'], true);
                            ?>

                            <div id="voluntary">

                                <div class="col-md-12" style="margin-top:40px">
                                    <div class="form-group">                        
                                        <label class="col-sm-2 control-label">Name (optional):</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="name_optional" value="<?php echo $termination_data['name_optional']; ?>" id="name_optional" class="form-control input-sm" placeholder="Name (optional)" autocomplete="off">
                                        </div>                                                    
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-2 control-label">Resignation Date:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="resign_date" value="<?php echo $this->Common_model->show_date_formate($termination_data['resign_date']); ?>" value="<?php echo $termination_data['name_optional']; ?>" id="resign_date" class="form-control dt_pick input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                        </div>
                                        <label class="col-sm-2 control-label">Hire Date:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="hire_date" value="<?php echo $this->Common_model->show_date_formate($termination_data['hire_date']); ?>" id="hire_date" class="form-control dt_pick input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-2 control-label">Job Title:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="job_title" value="<?php echo $termination_data['job_title']; ?>" id="job_title" class="form-control input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                        </div>
                                        <label class="col-sm-2 control-label">Location:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="location" value="<?php echo $termination_data['location']; ?>" id="location" class="form-control input-sm" placeholder="" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                                        </div>                        
                                    </div>
                                </div>

                                <div class="col-sm-12" style="margin-top:50px">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">REASON(S) FOR LEAVING :<br/>( <i style="font-weight:normal">Mark as many as Applicable</i> )</label>
                                        <div class="col-sm-1">&nbsp;</div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[1]" <?php echo (array_key_exists(1, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Obtained a new job">Obtained a new job</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[2]" <?php echo (array_key_exists(2, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Dissatisfied with pay">Dissatisfied with pay</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[3]" <?php echo (array_key_exists(3, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Moving from area">Moving from area</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[4]" <?php echo (array_key_exists(4, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Family circumstances">Family circumstances</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[5]" <?php echo (array_key_exists(5, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Health reasons">Health reasons</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[6]" <?php echo (array_key_exists(6, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Dissatisfied with type of work">Dissatisfied with type of work</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[7]" <?php echo (array_key_exists(7, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Dissatisfied with supervisor">Dissatisfied with supervisor</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="reason_for_leaving[0]" <?php echo (array_key_exists(0, (array) $reason_for_leaving)) ? 'checked' : '' ?> value="Other" class="other_explain">Other (please explain):</label>
                                                <textarea type="text" name="reason_for_leaving[other_leaving_reason]" id="" class="form-control" <?php echo (array_key_exists('other_leaving_reason', (array) $reason_for_leaving)) ? '' : 'disabled' ?>><?php echo (array_key_exists('other_leaving_reason', (array) $reason_for_leaving)) ? $reason_for_leaving['other_leaving_reason'] : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12"><h5 style="margin-top:50px;font-weight:bolder;font-size:20px;font-style:italic">
                                                Please rate the following from 1 to 10 - with 10 being the best:</h5>
                                        </div>
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Training for Employees:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[training_for_employees][rating]" id="training_for_employees" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['training_for_employees'])) {
                                                    $VAL = $voluntary_rate['training_for_employees']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[training_for_employees][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['training_for_employees']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Employee Benefits:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[employee_benefits][rating]" id="employee_benefits" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['employee_benefits'])) {
                                                    $VAL = $voluntary_rate['employee_benefits']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[employee_benefits][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['employee_benefits']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Career Advancement Opportunities:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[career_advancement][rating]" id="career_advancement" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['career_advancement'])) {
                                                    $VAL = $voluntary_rate['career_advancement']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[career_advancement][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['career_advancement']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Management and Supervision:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[management_and_supervision][rating]" id="management_and_supervision" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['management_and_supervision'])) {
                                                    $VAL = $voluntary_rate['management_and_supervision']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[management_and_supervision][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['management_and_supervision']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">General Working Conditions:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[general_working][rating]" id="general_working" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['general_working'])) {
                                                    $VAL = $voluntary_rate['general_working']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[general_working][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['general_working']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Compensation:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[compensation][rating]" id="compensation" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['compensation'])) {
                                                    $VAL = $voluntary_rate['compensation']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[compensation][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['compensation']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Nature and Type of Your Work:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[nature_and_type_of_work][rating]" id="nature_and_type_of_work" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['nature_and_type_of_work'])) {
                                                    $VAL = $voluntary_rate['nature_and_type_of_work']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[nature_and_type_of_work][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['nature_and_type_of_work']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Job Met Your Expectations:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[job_met_expectations][rating]" id="job_met_expectations" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['job_met_expectations'])) {
                                                    $VAL = $voluntary_rate['job_met_expectations']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[job_met_expectations][comments]" id="" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['job_met_expectations']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Quality of Company's Service to Customers or Clients:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[quality_of_company][rating]" id="quality_of_company" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['quality_of_company'])) {
                                                    $VAL = $voluntary_rate['quality_of_company']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[quality_of_company][comments]" id="quality_of_company" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['quality_of_company']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group">                        
                                        <label class="col-sm-3 control-label">Company's Commitment to Its Employees and Their Welfare:</label>
                                        <div class="col-sm-3">
                                            <select name="voluntary_rate[company_commitment][rating]" id="company_commitment" class="col-xs-12 myselect2 input-sm">
                                                <!---------SELECT OPTIONS HERE-------->
                                                <?php
                                                $VAL = '';
                                                if (array_key_exists('rating', $voluntary_rate['company_commitment'])) {
                                                    $VAL = $voluntary_rate['company_commitment']['rating'];
                                                }
                                                echo drop_down_selected($VAL);
                                                ?>
                                                <!------------------------------------>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Comment:</label>
                                        <div class="col-sm-4">
                                            <textarea name="voluntary_rate[company_commitment][comments]" id="company_commitment" class="form-control" data-toggle="tooltip" data-placement="bottom"autocomplete="off"><?php echo $voluntary_rate['company_commitment']['comments']; ?></textarea>
                                        </div>                        
                                    </div>
                                    <div class="form-group" style="margin-top:50px">                        
                                        <label class="col-sm-4 control-label">Please provide any additional information you feel could make a difference in our policies and practices:</label>
                                        <div class="col-sm-8">
                                            <textarea name="additional_info" id="additional_info" rows="4" class="form-control"data-toggle="tooltip" data-placement="bottom" autocomplete="off"><?php echo $termination_data['additional_info']; ?></textarea>
                                        </div>                                                      
                                    </div>
                                </div>

                                <div class="col-md-12">                          
                                    <div class="form-group pull-right">
                                        <div class="col-sm-12">
                                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Exit_Interview" ?>">Close</a>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-------------------------------------------- In-voluntary Termination -------------------------------------------->
                        <?php elseif ($termination_type == 1):

                            $reason_for_termination = json_decode($termination_data['reason_for_termination'], true);
                            $recomm_for_discharge = json_decode($termination_data['recomm_for_discharge'], true);
                            $interview_procedure = json_decode($termination_data['interview_procedure'], true);
                            ?>

                            <div class="col-md-12" id="involuntary" style="margin-top:40px">
                                <div class="form-group">                        
                                    <label class="col-sm-3 control-label">Position and Department:</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="position_and_dept" value="<?php echo $termination_data['position_and_dept'] ?>" id="position_and_dept" class="form-control input-sm" placeholder="Position and Department" autocomplete="off">
                                    </div>                                                    
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Reason(s) for Termination :<br/>( <i style="font-weight:normal">Mark as many as Applicable</i> )</label>
                                    <div class="col-sm-1">&nbsp;</div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[1]" <?php echo (array_key_exists(1, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Layoff">Layoff</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[2]" <?php echo (array_key_exists(2, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Substandard performance">Substandard performance</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[3]" <?php echo (array_key_exists(3, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Continued poor attendance">Continued poor attendance</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[4]" <?php echo (array_key_exists(4, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Insubordination">Insubordination</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[6]" <?php echo (array_key_exists(6, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Position eliminated">Position eliminated</label>
                                        </div>                           
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[7]" <?php echo (array_key_exists(7, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Temporary or seasonal position">Temporary or seasonal position</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="reason_for_termination[5]" <?php echo (array_key_exists(5, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Violation of policy" class="violation_policy">Violation of policy</label>
                                            <textarea type="text" name="reason_for_termination[violation_of_policy]" id="" class="form-control" <?php echo (array_key_exists('violation_of_policy', $reason_for_termination)) ? '' : 'disabled' ?>><?php echo (array_key_exists('violation_of_policy', $reason_for_termination)) ? $reason_for_termination['violation_of_policy'] : '' ?></textarea>
                                        </div>              
                                        <div class="checkbox">
                                            <label><input type="checkbox"  name="reason_for_termination[0]" <?php echo (array_key_exists(0, (array) $reason_for_termination)) ? 'checked' : '' ?> value="Other" class="other_explain">Other (please explain):</label>
                                            <textarea type="text" name="reason_for_termination[other_termination_reason]" id="" class="form-control" <?php echo (array_key_exists('other_termination_reason', $reason_for_termination)) ? '' : 'disabled' ?>><?php echo (array_key_exists('other_termination_reason', $reason_for_termination)) ? $reason_for_termination['other_termination_reason'] : '' ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top:50px">
                                    <label class="col-sm-3 control-label">Recommendation for Discharge:</label>
                                    <div class="col-sm-9">                                    
                                        <div class="col-sm-12">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="recomm_for_discharge[1]" <?php echo (array_key_exists(1, (array) $recomm_for_discharge)) ? 'checked' : '' ?> value="All normal steps of progressive discipline have been completed, and there is no realistic hope for improvement">All normal steps of progressive discipline have been completed, and there is no realistic hope for improvement.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="recomm_for_discharge[2]" <?php echo (array_key_exists(2, (array) $recomm_for_discharge)) ? 'checked' : '' ?> value="Employee has been repeatedly counseled and assisted regarding performance deficiencies, but there is no realistic hope for improvement">Employee has been repeatedly counseled and assisted regarding performance deficiencies, but there is no realistic hope for improvement.</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="recomm_for_discharge[3]" <?php echo (array_key_exists(3, (array) $recomm_for_discharge)) ? 'checked' : '' ?> value="All alternatives such as transfer and retraining have been considered">All alternatives such as transfer and retraining have been considered.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="recomm_for_discharge[4]" <?php echo (array_key_exists(4, (array) $recomm_for_discharge)) ? 'checked' : '' ?> value="The employee’s infractions and all above steps have been fully documented and records included with the recommendation for discharge">The employee’s infractions and all above steps have been fully documented and records included with the recommendation for discharge.</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="recomm_for_discharge[5]" <?php echo (array_key_exists(5, (array) $recomm_for_discharge)) ? 'checked' : '' ?> value="Recommendation for discharge and all supporting documents have been placed in the employee’s personnel file">Recommendation for discharge and all supporting documents have been placed in the employee’s personnel file.</label>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top:50px">
                                    <label class="col-sm-3 control-label">Interview Procedure:</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-12">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[1]" <?php echo (array_key_exists(1, (array) $interview_procedure)) ? 'checked' : '' ?> value="Recap the application of progressive discipline">Recap the application of progressive discipline.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[2]" <?php echo (array_key_exists(2, (array) $interview_procedure)) ? 'checked' : '' ?> value="If the employee requests a witness or support person, you may have to allow it. Consult with a knowledgeable employment law attorney to determine the requirements under current law, as the law in this area has shifted several times in recent years">If the employee requests a witness or support person, you may have to allow it. Consult with a knowledgeable employment law attorney to determine the requirements under current law, as the law in this area has shifted several times in recent years.</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[3]" <?php echo (array_key_exists(3, (array) $interview_procedure)) ? 'checked' : '' ?> value="State the specific reasons for the discharge">State the specific reasons for the discharge.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[4]" <?php echo (array_key_exists(4, (array) $interview_procedure)) ? 'checked' : '' ?> value="If the employee raises a question about finality, emphasize that the decision is final unless company policy and procedure provides for some appeal">If the employee raises a question about finality, emphasize that the decision is final unless company policy and procedure provides for some appeal.</label>
                                            </div>                           
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[5]" <?php echo (array_key_exists(5, (array) $interview_procedure)) ? 'checked' : '' ?> value="If the tenor of the interview allows it, solicit employee feedback on issues of interest to the employer">If the tenor of the interview allows it, solicit employee feedback on issues of interest to the employer.</label>
                                            </div> 
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[6]" <?php echo (array_key_exists(6, (array) $interview_procedure)) ? 'checked' : '' ?> value="Arrange to obtain company property in the possession of the employee">Arrange to obtain company property in the possession of the employee.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[7]" <?php echo (array_key_exists(7, (array) $interview_procedure)) ? 'checked' : '' ?> value="Provide the employee his or her final paycheck if required by state law, or explain when he or she will receive the last paycheck. Also advise whether the employee will receive accrued vacation pay, and details of any other compensation or benefits that he or she will receive">Provide the employee his or her final paycheck if required by state law, or explain when he or she will receive the last paycheck. Also advise whether the employee will receive accrued vacation pay, and details of any other compensation or benefits that he or she will receive.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[8]" <?php echo (array_key_exists(8, (array) $interview_procedure)) ? 'checked' : '' ?> value="Advise the employee of COBRA or other options for continuing health coverage">Advise the employee of COBRA or other options for continuing health coverage.</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="interview_procedure[9]" <?php echo (array_key_exists(9, (array) $interview_procedure)) ? 'checked' : '' ?> value="Conclude the interview as quickly as possible">Conclude the interview as quickly as possible.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="form-group pull-right">
                                    <div class="col-sm-12">
                                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Exit_Interview" ?>">Close</a>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </form>

            <?php } ?>
        </div>
    </div>
</div>

</div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        var BASE_URL = '<?php echo base_url(); ?>';

        $('select#termination_type').on('change', function () {
            
            if($("#employee_id").val()=="")
            {
                alert ('Please Select At Least One Employee');
                return;
            }
            
            var TYPE = $(this).val();
            var ActionLink = "#";
            if (TYPE == 0) { /* Voluntary */
                $("#involuntary").addClass('hide');
                $("#voluntary").removeClass('hide');
                
                var employee_id=$("#employee_id").val();
                
                if(employee_id!="")
                {
                    set_emp_value(employee_id);
                }
                else
                {
                    $("#name_optional").val('');
                    $("#hire_date").val('');
                    $("#job_title").val('');
                    $("#location").val('');
                }
                
            } else if (TYPE == 1) { /* In-Voluntary */
                $("#voluntary").addClass('hide');
                $("#involuntary").removeClass('hide');
            }

            ActionLink = BASE_URL + 'Con_Exit_Interview/insert_termination/' + TYPE;
            $("form.termination-form").attr('action', ActionLink);
        });

        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //$('#sky-form11')[0].reset();

                var url = '<?php echo base_url() ?>Con_Exit_Interview';
                view_message(data, url,'','sky-form11');
            });
            event.preventDefault();
        });

        $(".other_explain").on('click', function () {
            if ($(this).prop("checked")) {
                $(this).parent().siblings('textarea').removeAttr('disabled').val('');
            } else {
                $(this).parent().siblings('textarea').attr('disabled', '').val('');
            }
        });

        $(".violation_policy").on('click', function () {
            if ($(this).prop("checked")) {
                $(this).parent().siblings('textarea').removeAttr('disabled').val('');
            } else {
                $(this).parent().siblings('textarea').attr('disabled', '').val('');
            }
        });
    });

    function emp_info(EMP_ID) {

    }
    
    function set_emp_value(employee_id) {
        $("#name_optional").val('');
        $("#hire_date").val('');
        $("#job_title").val('');
        $("#location").val('');
        $.ajax({ //Ajax Load data from ajax
            url: "<?php echo site_url('Con_Exit_Interview/ajax_set/') ?>/" + employee_id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="name_optional"]').val(data.first_name);
                $('[name="hire_date"]').val(show_date_formate_js(data.hire_date));
                get_position(data.position);
                get_location(employee_id);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function get_position(position_id) {
        $.ajax({
            url: "<?php echo site_url('Con_Exit_Interview/get_ajax_position/') ?>/" + position_id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="job_title"]').val(data.position_name);
            }
//            ,
//            error: function (jqXHR, textStatus, errorThrown)
//            {
//                alert('Error get data from ajax');
//            }
        });
    }
   
    function get_location(employee_id) {
        $.ajax({
            url: "<?php echo site_url('Con_Exit_Interview/get_ajax_location/') ?>/" + employee_id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="location"]').val(data.location);
            }
//            ,
//            error: function (jqXHR, textStatus, errorThrown)
//            {
//                alert('Error get data from ajax');
//            }
        });
    }
   

    $("#employee_id").select2({
        placeholder: "Select Employee",
        allowClear: true
    });

    $("#termination_type").select2({
        placeholder: "Select Termination Type",
        allowClear: true
    });
    $("#isactive").select2({
        placeholder: "Status",
        allowClear: true
    });
    $("#training_for_employees").select2({
        placeholder: "Select Employee Training Rate",
        allowClear: true
    });
    $("#employee_benefits").select2({
        placeholder: "Select Employee Benefits Rate",
        allowClear: true
    });
    $("#career_advancement").select2({
        placeholder: "Select Career Advancement Opportunities Rate",
        allowClear: true
    });
    $("#management_and_supervision").select2({
        placeholder: "Select Management and Supervision Rate",
        allowClear: true
    });
    $("#general_working").select2({
        placeholder: "Select General Working Conditions Rate",
        allowClear: true
    });
    $("#compensation").select2({
        placeholder: "Select Compensation Rate",
        allowClear: true
    });
    $("#nature_and_type_of_work").select2({
        placeholder: "Select Nature and Type of Work Rate",
        allowClear: true
    });
    $("#job_met_expectations").select2({
        placeholder: "Select Job Met Expectations Rate",
        allowClear: true
    });
    $("#quality_of_company").select2({
        placeholder: "Select Quality of Company's Service Rate",
        allowClear: true
    });
    $("#company_commitment").select2({
        placeholder: "Select Company's Commitment Rate",
        allowClear: true
    });
</script>
<!--=== End Script ===-->
