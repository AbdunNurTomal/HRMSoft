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
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Opening Position Information </h3>
                                </div>
                                <div class="panel-body">
                                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                            <tbody>
                                                <?php
                                                foreach ($query->result() as $row) {
                                                    ?>
                                                    <tr>
                                                        <th>Requisition Id : </th>
                                                        <td><?php echo $row->requisition_code ?></td>
                                                        <th>Requisitions Date : </th>
                                                        <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> <?php // echo ucwords($prow->last_name);            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Due Date : </th>
                                                        <td><?php echo $this->Common_model->show_date_formate($row->due_date) ?></td>
                                                        <th>Location : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Department : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name'); ?></td>
                                                        <th>Position : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Reporting Manager : </th>
                                                        <td>
                                                            <?php
//                                                                $manager_id = $this->Common_model->get_name($this, $row->reporting_manager_id, 'main_employees', 'employee_id');
//                                                                echo $this->Common_model->employee_name($manager_id);
                                                            echo $this->Common_model->get_selected_value($this, 'employee_id', $row->reporting_manager_id, 'main_employees', 'first_name');
                                                            ?>
                                                        </td>
                                                        <th>No. of Positions : </th>
                                                        <td><?php echo $row->no_of_positions ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Employee Category : </th>
                                                        <td>
                                                            <?php
                                                            $employee_type_array = $this->Common_model->get_array('employee_type');
                                                            echo ($row->employee_category == 0 ? 'Not Define' : $employee_type_array[$row->employee_category]);
                                                            ?>
                                                        </td>
                                                        <th>Wages : </th>
                                                        <td>
                                                            <?php
                                                            $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                                            echo ($row->employee_category == 0 ? 'Not Define' : $wages_array[$row->wages]);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Salary Range : </th>
                                                        <td><?php echo $row->salary_range ?></td>
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
                                                        <th>Employee Name : </th>
                                                        <td>
                                                            <?php
                                                            echo $this->Common_model->get_selected_value($this, 'employee_id', $row->replacing_emp, 'main_employees', 'first_name');
                                                            ?>
                                                        </td>                                                        
                                                    </tr>                                                    
                                                    <tr>
                                                        <th>Qualification : </th>
                                                        <td><?php echo $row->required_qualification ?></td>
                                                        <th>Experience Range : </th>
                                                        <td><?php echo $row->experience_range ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Employment Status : </th>
                                                        <td><?php echo $this->Common_model->get_name($this, $row->employment_status_id, 'main_employmentstatus', 'description') ?></td>
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
                                                        <th>Job Description : </th>
                                                        <td><?php echo $row->job_description; ?></td>
                                                        <th>Required Skills</th>
                                                        <td><?php echo $row->required_skills; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Position Description: </th>
                                                        <td><?php echo $row->position_description; ?></td>                                        
                                                    </tr>
                                                    <?php
                                                }
                                                ?>     
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                       
                <div class="modal-footer">                        
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_OpeningsPositions" ?>">Close</a>
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
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Job_acquisition';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#location_id").select2({
        placeholder: "Select Location",
        allowClear: true,
    });

    $("#department_id").select2({
        placeholder: "Select Department",
        allowClear: true,
    });

    $("#position_id").select2({
        placeholder: "Select Position",
        allowClear: true,
    });
    
    $("#reporting_manager_id").select2({
        placeholder: "Select Reporting Manager",
        allowClear: true,
    });
    
    $("#employment_status_id").select2({
        placeholder: "Select Employment Status",
        allowClear: true,
    });
    
    $("#priority").select2({
        placeholder: "Select Priority",
        allowClear: true,
    });
    
    $("#approver_id").select2({
        placeholder: "Select Approver",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

