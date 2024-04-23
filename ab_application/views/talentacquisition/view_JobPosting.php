<!-- CSS Page Style -->    
<!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/pages/page_job_inner2.css">-->

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <div class="col-md-12" style="margin-top: 10px">
                <div class="panel panel-u margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-tasks"></i> Job Positing </h3>
                    </div>
                    <div class="panel-body">
                        
                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                            <tbody>
                                <?php
                                foreach ($query->result() as $row) {
                                    ?>
                                <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->id ?>">
                                <tr>
                                    <th style=" width: 400px; ">Requisition Id : </th>
                                    <td><?php echo $row->requisition_code ?></td>
                                </tr>
                                <tr>
                                    <th>Requisitions Date : </th>
                                    <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> </td>
                                </tr>
                                <tr>
                                    <th>Due Date : </th>
                                    <td><?php echo $this->Common_model->show_date_formate($row->due_date) ?></td>
                                </tr>
                                <tr>
                                    <th>Location : </th>
                                    <td><?php echo $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name'); ?></td>
                                </tr>
                                <tr>
                                    <th>Department : </th>
                                    <td><?php echo $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name'); ?></td>
                                </tr>
                                <tr>    
                                    <th>Position : </th>
                                    <td><?php echo $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') ?></td>
                                </tr>
                                <tr>    
                                    <th>No. of Positions : </th>
                                    <td><?php echo $row->no_of_positions ?></td>
                                </tr>
                                <tr>
                                    <th>Reporting Manager : </th>
                                    <td>
                                        <?php
//                                                            $manager_id = $this->Common_model->get_name($this, $row->reporting_manager_id, 'main_employees', 'employee_id');
//                                                            echo $this->Common_model->employee_name($manager_id);
                                        echo $this->Common_model->get_selected_value($this, 'employee_id', $row->reporting_manager_id, 'main_employees', 'first_name');
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Employee Category : </th>
                                    <td>
                                        <?php
                                        $employee_type_array = $this->Common_model->get_array('employee_type');
                                        echo ($row->employee_category == 0 ? 'Not Define' : $employee_type_array[$row->employee_category]);
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Wages : </th>
                                    <td>
                                        <?php
                                        $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                        echo ($row->employee_category == 0 ? 'Not Define' : $wages_array[$row->wages]);
                                        ?>
                                    </td>                                                    </tr>
                                <tr>
                                    <th>Salary Range : </th>
                                    <td><?php echo $row->salary_range ?></td>
                                </tr>
                                <tr>    
                                    <th>Posting : </th>
                                    <td>
                                        <?php
                                        $posting_array = array(1 => 'Internal', 2 => 'Internal & External');
                                        echo ($row->posting == 0 ? 'Not Define' : $employee_type_array[$row->posting]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hire Reason : </th>
                                    <td>
                                        <?php
                                        $hire_reason_array = array(1 => 'New', 2 => 'Replacing');
                                        echo ($row->hire_reason == 0 ? 'Not Define' : $hire_reason_array[$row->hire_reason]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Employment Status : </th>
                                    <td><?php echo $this->Common_model->get_name($this, $row->employment_status_id, 'main_employmentstatus', 'description') ?></td>
                                </tr>
                                <tr>    
                                    <th>Priority: </th>
                                    <td>
                                        <?php
                                        if ($row->priority != 0) {
                                            echo $priority_array[$row->priority];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Qualification : </th>
                                    <td><?php 
                                    $required_qualification_arr = explode(",", $row->required_qualification);
                                            
                                    $required_qualification = '';
                                    foreach ($required_qualification_arr as $intr) {
                                        if ($required_qualification == '') {
                                            $required_qualification = $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                        } else {
                                            $required_qualification = $required_qualification . " , " . $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                        }
                                    }

                                    echo $required_qualification;
                                    //echo $row->required_qualification 
                                    ?></td>
                                </tr>
                                <tr>    
                                    <th>Experience Range : </th>
                                    <td><?php echo $row->experience_range ?></td>
                                </tr>
                                <tr>    
                                    <th>Required Skills</th>
                                    <td><?php 
                                    $required_skills_arr = explode(",", $row->required_skills);

                                    $required_skills = '';
                                    foreach ($required_skills_arr as $intr) {
                                        if ($required_skills == '') {
                                            $required_skills = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                        } else {
                                            $required_skills = $required_skills . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                        }
                                    }

                                    echo $required_skills; ?></td>
                                </tr>
                                <tr>
                                    <th>Position Description : </th>
                                    <td><?php echo $row->position_description; ?></td>                                        
                                </tr>
                                <?php
                            }
                            ?>     
                            </tbody>
                        </table>
                    </div>
<!--                    <ul class="social-icons social-icons-color pull-right">
                        <li><a class="social_facebook" data-original-title="Facebook" href="#"></a></li>
                        <li><a class="social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                        <li><a class="social_tumblr" data-original-title="Tumblr" href="#"></a></li>
                        <li><a class="social_twitter" data-original-title="Twitter" href="#"></a></li>
                    </ul>-->
                </div>
                <div class="panel panel-u margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-tasks"></i> Job Description </h3> 
                    </div>
                    <div class="panel-body">
                        <?php
                        foreach ($query->result() as $row) {
                            ?>
                           <?php echo $row->job_posting_text; ?>                                       
                            <?php
                        }
                        ?>     
                    </div>
<!--                    <ul class="social-icons social-icons-color pull-right padding-15">
                        <li><a class="social_facebook" data-original-title="Facebook" href="#"></a></li>
                        <li><a class="social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                        <li><a class="social_tumblr" data-original-title="Tumblr" href="#"></a></li>
                        <li><a class="social_twitter" data-original-title="Twitter" href="#"></a></li>
                    </ul>-->
                </div>
                
                <div class="modal-footer"> 
                        <!--<a class="btn btn-danger" href="<?php // echo base_url() . "Con_OpeningsPositions" ?>">Close</a>-->
                    <a class="btn btn-u" target="_blank" href="<?php echo base_url() . "Con_OpeningsPositions/add_job_posting_link/".$req_id ?>">Facebook</a>
                    <a class="btn btn-u" target="_blank" href="<?php echo base_url() . "Con_OpeningsPositions/add_job_posting_link/".$req_id ?>">Linkedin</a>
                </div>

            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>


</script>
<!--=== End Script ===-->

