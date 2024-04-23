<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <?php
            if ($type == 3) {//edit
                ?>
                <div class="col-md-12" style="margin-top: 10px">
                    <form id="interview_status" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Interview_Candidate/update_interview_status" enctype="multipart/form-data" role="form" >
                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Interview Details </h3>
                            </div>
                            <div class="panel-body">

                                <label class=""><u><h4>Candidate Details </h4></u></label>

                                <div class="" style="margin-bottom: 20px;">
                                    <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <?php
                                            foreach ($query->result() as $roww) {
                                                $position_id = $this->Common_model->get_name($this, $roww->requisition_id, 'main_opening_position', 'position_id');
                                                ?>
                                            <input type="hidden" value="<?php echo $roww->requisition_id; ?>" name="requisition_id" id="requisition_id">
                                            <input type="hidden" value="<?php echo $roww->id; ?>" name="interview_schedule_id" id="interview_schedule_id">
                                            <input type="hidden" value="<?php echo $roww->candidate_name; ?>" name="candidate_id" id="candidate_id">
                                            <input type="hidden" value="<?php echo $roww->schedule_id; ?>" name="schedule_id" id="schedule_id">
                                            <tr>
                                                <th>Requisition ID : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $roww->requisition_id, 'main_opening_position', 'requisition_code'); ?></td>
                                                <th>Position : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Candidate Name : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $roww->candidate_name, 'main_cv_management', 'candidate_first_name'); ?></td>
                                                <th>Skill : </th>
                                                <td><?php
                                                    $skill = $this->Common_model->get_selected_value($this, "id", $roww->candidate_name, 'main_cv_management', 'skill_set');
                                                    $skill_set_arr = explode(",", $skill);
                                                    $skill_set = '';
                                                    foreach ($skill_set_arr as $intr) {
                                                        if ($skill_set == '') {
                                                            $skill_set = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                                        } else {
                                                            $skill_set = $skill_set . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                                        }
                                                    }
                                                    echo $skill_set;
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Qualification : </th>
                                                <td>
                                                    <?php
                                                    $qualification = $this->Common_model->get_selected_value($this, "id", $roww->candidate_name, 'main_cv_management', 'qualification');
                                                    $required_qualification_arr = explode(",", $qualification);
                                                    $required_qualification = '';
                                                    foreach ($required_qualification_arr as $intr) {
                                                        if ($required_qualification == '') {
                                                            $required_qualification = $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                                        } else {
                                                            $required_qualification = $required_qualification . " , " . $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
                                                        }
                                                    }

                                                    echo $required_qualification;
                                                    ?>
                                                </td>
                                                <th>Candidate Resume : </th>
                                                <td><a href="<?php echo base_url() . "Con_ScheduledInterviews/view_resume/" . $this->Common_model->get_name($this, $roww->candidate_name, 'main_cv_management', 'upload_resume_path') ?>" >Download Resume </a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>     
                                        </tbody>
                                    </table>
                                </div>



                                <label class="padding-top-5"><u><h4>Interview Details </h4></u></label>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Interview Status</label>
                                    <div class="col-sm-10">                            
                                        <select name="up_interview_status" id="up_interview_status" onchange="load_candidate_status(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            $interview_status = $this->Common_model->get_array('interview_status');
                                            foreach ($interview_status as $keyy => $vall):
                                                if ($keyy == 0 || $keyy == 3 || $keyy == 4) {
                                                    ?>
                                                    <option value="<?php echo $keyy ?>"><?php echo $vall ?></option>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Candidate Status </label>
                                    <div class="col-sm-10">                            
                                        <select name="up_candidate_status" id="up_candidate_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >

                                        </select> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Performance </label>
                                    <div class="col-sm-10">                            
                                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                            <?php
                                            $star_array = $this->Common_model->get_array('star_array');
                                            $rating_array = $this->Common_model->get_array('rating_array');
                                            $serial = 1;
                                            foreach ($rating_array as $key => $val):
                                                ?>
                                                <tr>
                                                    <td><input type="radio" name="rating_id" value="<?php echo $key ?>" <?php if ($key == 1) echo "checked"; ?> class="with-gap radio-col-light-blue" id="radio_<?php echo $serial; ?>"/><label for="radio_<?php echo $serial; ?>"></label></td>
                                                    <th><?php echo $val; ?> </th>
        <!--                                                    <th><?php // echo $star_array[$key];   ?> </th>-->
                                                </tr>
                                                <?php
                                                $serial++;
                                            endforeach;
                                            ?>
                                        </table>                                    
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Comments</label>
                                    <div class="col-sm-10">                            
                                        <textarea name="description" id="description" class="form-control" rows="2" placeholder="Description"  title="Description"></textarea>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">                        
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Interview_Candidate" ?>">Close</a>
                            <button type="submit" id="submit" class="btn btn-u">Update</button>
                        </div>

                    </form>
                </div>

                <script>

                    $("#up_interview_status").select2({
                        placeholder: "Select Interview Status",
                        allowClear: true,
                    });

                    $("#up_candidate_status").select2({
                        placeholder: "Select Candidate Status",
                        allowClear: true,
                    });

                </script>
                <?php
            }
            else if ($type == 4) {
                ?>
                <div class="col-md-12" style="margin-top: 10px">
                    <div id="employee_review_div">   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Scheduled Interview Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">

                                            <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <?php
                                                    foreach ($query->result() as $row) {
                                                        ?>
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
                                                            <th>Candidate Name : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_first_name') ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact Number : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'contact_number') ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Email : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_email') ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Interviewer : </th>
                                                            <td>
                                                                <?php
                                                                $interview_array = explode(",", $row->interviewer);
                                                                //pr($interview_array,1);
                                                                $int_name = '';
                                                                foreach ($interview_array as $key) {
                                                                    if ($int_name == '') {
                                                                        $int_name = $this->Common_model->get_selected_value($this, 'employee_id', $key, 'main_employees', 'first_name');
                                                                    } else {
                                                                        $int_name = $int_name . " , " . $this->Common_model->get_selected_value($this, 'employee_id', $key, 'main_employees', 'first_name');
                                                                    }
                                                                }
                                                                echo $int_name;
                                                                ?>
                                                            </td>
                                                        </tr>             
                                                        <tr>    
                                                            <th>Interview Location : </th>
                                                            <td><?php echo $row->location ?></td>
                                                        </tr>
                                                        <tr>                                                        
                                                            <th>Interview Date : </th>
                                                            <td><?php echo $this->Common_model->show_date_formate($row->interview_date) ?> </td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Interview Time : </th>
                                                            <td><?php echo $row->interview_time ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Description : </th>
                                                            <td><?php echo $row->description ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status : </th>
                                                            <td>
                                                                <?php
                                                                $interview_status = $this->Common_model->get_array('interview_status');
                                                                echo $interview_status[$row->interview_status];
                                                                ?>
                                                            </td>
                                                        </tr>                                                    
                                                        <?php
                                                    }
                                                    ?>     
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div> 
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Interview_Candidate" ?>">Close</a>
                    </div>
                </div>
                <?php
            }
            ?>
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

            $("#requisition_id").attr('disabled', false);
            $("#candidate_name").attr('disabled', false);
            $("#interview_status").attr('disabled', false);

            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Interview_Candidate';
                view_message(data, url, '', 'sky-form11');
                $("#interview_status").attr('disabled', true);

            });
            event.preventDefault();
        });
    });

    $(function () {
        $("#interview_status").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#interview_status").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Interview_Candidate';
                view_message(data, url, '', 'interview_status');

            });
            event.preventDefault();
        });
    });

    function load_candidate_name(id) {
        $.ajax({
            url: "<?php echo site_url('Con_ScheduledInterviews/load_candidate_dropdown/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {

                $('#candidate_name').html('');
                $('#candidate_name').empty();

                $('#candidate_name').html(data);
            }
        })
    }


    function load_candidate_status(id) {
        $.ajax({
            url: "<?php echo site_url('Con_ScheduledInterviews/load_candidate_status/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {

                $('#up_candidate_status').html('');
                $('#up_candidate_status').empty();

                $('#up_candidate_status').html(data);
            }
        })
    }

    $('#interview_time, .time_pick').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: false,
        showSeconds: false,
        defaultTime: ''
    });



</script>
<!--=== End Script ===-->

