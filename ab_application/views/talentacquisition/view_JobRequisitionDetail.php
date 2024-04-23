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
                <form id="sing_req_form" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Requisitions_Approval/update_sing_req_Status" enctype="multipart/form-data" role="form" >

                    <div id="employee_review_div">   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Requisition Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
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

                                                            echo $required_skills;
                                                            ?></td>
                                                    </tr>

                                                    <?php
                                                }
                                                ?>     
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                                </div>
                            </div>        
                        </div>
                    </div> 

                    <div class="modal-footer">                        
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Job_Requisition" ?>"> Close </a>
                        <button type="submit" id="RejectForm" name="RejectForm" onclick="reject_form_submit(4)" value="4" class="btn btn-u"> <i class="fa fa-ban" aria-hidden="true"></i> Reject </button>
                        <button type="submit" id="ApproveForm" name="ApproveForm" onclick="approved_form_submit(1)" value="1" class="btn btn-u"> <i class="fa fa-check" aria-hidden="true"></i> Approve </button>
                        <input type="hidden" name="sing_req_status" id="sing_req_status">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    function approved_form_submit(id)
    {
        $("#sing_req_status").val('');
        $("#sing_req_status").val(id);

        $("#sing_req_form").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sing_req_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Requisitions_Approval';
                view_message(data, url, '', 'sing_req_form');

            });
            event.preventDefault();
        });

    }
    function reject_form_submit(id)
    {
        $("#sing_req_status").val('');
        $("#sing_req_status").val(id);

        $("#sing_req_form").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sing_req_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Requisitions_Approval';
                view_message(data, url, '', 'sing_req_form');

            });
            event.preventDefault();
        });

    }


</script>
<!--=== End Script ===-->

