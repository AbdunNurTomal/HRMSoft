<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Job_Requistion_Reporting/search_Job_Requistion_Reporting/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> From: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_from']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">To: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_to']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Requisition  </label>
                                <div class="col-sm-8">
                                    <select name="requisition_id" id="requisition_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($opening_position_query->result() as $key) {
                                            $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                            $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');

                                            $slct = ($search_criteria['requisition_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Department  </label>
                                <div class="col-sm-8">
                                    <select name="department_id" id="department_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($department_query->result() as $key) {
                                            $slct = ($search_criteria['department_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->department_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Position  </label>
                                <div class="col-sm-8">
                                    <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($positions_query->result() as $key):
                                            $slct = ($search_criteria['position_id'] == $key->positionname) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key->positionname ?>"<?php echo $slct; ?>><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Requisition Status  </label>
                                <div class="col-sm-8">
                                    <select name="requisition_status" id="requisition_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($approver_status as $key=>$val):
                                            $slct = ($search_criteria['requisition_status'] == $key) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key ?>"<?php echo $slct; ?>><?php echo $val; ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                    <button class="btn-u center-align" type='button' id='btn' onclick='printDiv();'> <i class="fa fa-print" aria-hidden="true"></i> PDF </button>
                                    <a href="#" class="btn-u center-align" onClick ="$('#print_to_Div').tableExport({type: 'excel', escape: 'false'});"><i class="fa fa-file-excel-o" aria-hidden="true"></i> XLS </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="overflow-x" style=" margin-bottom: 12px; max-height: 500px;">
                <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Job Requistion Listing Reporting </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Wages</th>
                            <th>Salary Range</th>
                            <th>Posting</th>
                            <th>No of Positions</th>
                            <th>Hire Reason</th>
                            <th>Employment Status</th>
                            <th>Priority</th>
                            <th>Qualification</th>
                            <th>Experience Range</th>
                            <th>Required Skills</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $wages_array = array(0 =>'',1 => 'Salary', 2 => 'Hourly');
                        $posting_array = array(0 =>'',1 => 'Internal', 2 => 'Internal & External');
                        $hire_reason_array = array(0 =>'',1 => 'New', 2 => 'Replacing');
                        $priority = array(0 =>'',1 => 'High', 2 => 'Medium' , 3 => 'Low' );
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                
                                $required_qualification_arr = explode(",", $row->required_qualification);
                                $required_qualification = '';
                                foreach ($required_qualification_arr as $intr) {
                                    if ($required_qualification == '') {
                                        $required_qualification = $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                    } else {
                                        $required_qualification = $required_qualification . " , " . $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                    }
                                }
                                
                                $required_skills_arr = explode(",", $row->required_skills);

                                        $required_skills = '';
                                        foreach ($required_skills_arr as $intr) {
                                            if ($required_skills == '') {
                                                $required_skills = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                            } else {
                                                $required_skills = $required_skills . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                            }
                                        }
                                            
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $wages_array[$row->wages] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->salary_range ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $posting_array[$row->posting] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->no_of_positions ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $hire_reason_array[$row->hire_reason] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->employment_status_id, 'main_employmentstatus', 'description') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $priority[$row->priority] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $required_qualification ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->experience_range ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $required_skills ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $approver_status[$row->req_status] ."</td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                </div>
                </div>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    $("#requisition_id").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    
    $("#department_id").select2({
        placeholder: "Select department",
        allowClear: true
    });
    $("#position_id").select2({
        placeholder: "Select position",
        allowClear: true
    });
    $("#requisition_status").select2({
        placeholder: "Select requisition status",
        allowClear: true
    });

    function printDiv() {
        $.print("#print_to_Div");
    }
   
</script>
<!--=== End Content ===-->

