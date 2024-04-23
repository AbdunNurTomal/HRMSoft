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
                <div id="employee_review_div">   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-u">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> CV Management Information </h3>
                                </div>
                                <div class="panel-body">
                                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ScheduledInterviews/save_ScheduledInterviews" enctype="multipart/form-data" role="form" >
                                        <?php
                                        $candidate_status = $this->Common_model->get_array('candidate_status');
                                        $resume_type = $this->Common_model->get_array('resume_type');
                                        foreach ($query->result() as $row) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th>Resume Type : </th>
                                                            <td><?php echo $resume_type[$row->resume_type] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Requisition Id : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Position : </th>
                                                            <td>
                                                                <?php
                                                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                                                echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                                ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Referrer Name : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') . " " . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'middle_name') . " " . $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'last_name'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Fast Name : </th>
                                                            <td><?php echo $row->candidate_first_name ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Last Name : </th>
                                                            <td><?php echo $row->candidate_last_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email : </th>
                                                            <td><?php echo $row->candidate_email ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact Number : </th>
                                                            <td><?php echo $row->contact_number ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Qualification : </th>
                                                            <td><?php
                                                                $qualification_arr = explode(",", $row->qualification);
                                                                $qualification = '';
                                                                foreach ($qualification_arr as $intr) {
                                                                    if ($qualification == '') {
                                                                        $qualification = $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                                                    } else {
                                                                        $qualification = $qualification . " , " . $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                                                    }
                                                                }

                                                                echo $qualification;
                                                                //echo $row->qualification 
                                                                ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Experience : </th>
                                                            <td><?php echo $row->work_experience ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Skill : </th>
                                                            <td><?php
                                                                $skill_set_arr = explode(",", $row->skill_set);
                                                                $skill_set = '';
                                                                foreach ($skill_set_arr as $intr) {
                                                                    if ($skill_set == '') {
                                                                        $skill_set = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                                                    } else {
                                                                        $skill_set = $skill_set . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                                                    }
                                                                }
                                                                echo $skill_set
                                                                ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Education : </th>
                                                            <td><?php echo $row->education_summary ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>State : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->state, 'main_state', 'state_name') ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Resume : </th>
                                                            <td><?php echo "<a href=" . base_url() . "Con_CVManagement/download_resume/" . $row->upload_resume_path . " > " . $row->upload_resume_path . " </a>" ?></td>    
                                                        </tr>                                                    
                                                        <tr>
                                                            <th>Status : </th>
                                                            <td><?php echo $candidate_status[$row->status] ?></td>
                                                        </tr>                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>

                                        <?php } ?>

                                    </form>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_CVManagement" ?>">Close</a>
                            </div>
                        </div>        
                    </div>
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

            var options = $('#interviewer > option:selected');
            if (options.length == 0) {
                alert('No Interviewer selected');
                return false;
            }

            //$("#requisition_id").attr('disabled',false);
            //$("#candidate_name").attr('disabled',false);
            $("#interview_status").attr('disabled', false);

            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_CVManagement';
                view_message(data, url, '', 'sky-form11');
                $("#interview_status").attr('disabled', true);

            });
            event.preventDefault();
        });
    });


    $("#interview_status").select2({
        placeholder: "Select Interview Status",
        allowClear: true,
    });

    $("#interviewer").select2({
        placeholder: " Interviewer (multiple select) ",
        allowClear: true,
    });

    $("#interview_type").select2({
        placeholder: "Select Interview Type",
        allowClear: true,
    });

    $(document).ready(function () {
        $("#interview_status").attr('disabled', true);
    });


</script>
<!--=== End Script ===-->

