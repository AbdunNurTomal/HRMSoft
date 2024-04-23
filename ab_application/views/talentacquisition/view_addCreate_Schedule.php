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
            if ($type == 1) {//entry
                ?>
                <div class="col-md-12" style="margin-top: 10px">
                    <form id="sky-form12" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Create_Schedule/save_Create_Schedule" enctype="multipart/form-data" role="form" >
                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Schedule Interview </h3>
                            </div>
                            <div class="panel-body">
                                <input type="hidden" value="" name="id"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Schedule Group <span class="req"/> </label>
                                    <div class="col-sm-10">  
                                        <input type="text" name="schedule_group" id="schedule_group" class="form-control input-sm" placeholder="Schedule Group" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Requisition ID <span class="req"/> </label>
                                    <div class="col-sm-10">                            
                                        <select name="requisition_id" id="requisition_id" onchange="load_candidate_name(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($opening_position_query->result() as $key):
                                                $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                                $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->requisition_code . "  ( " . $position_name . " ) "; ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Interviewer<span class="req"/></label>
                                    <div class="col-sm-10">                            
                                        <select name="interviewer[]" id="interviewer" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Interviewer (multiple select)" multiple>
                                            <option></option>
                                            <?php
                                            foreach ($employees_query->result() as $key):
                                                ?>
                                                <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name ." ".$key->last_name ?> (<?php echo sprintf("%07d", $key->employee_id) ?>)</option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="candidate_email" class="col-sm-2 control-label"> Location <span class="req"/> </label>
                                    <div class="col-sm-10">                            
                                        <input type="text" name="location" id="location" class="form-control input-sm" placeholder="Location" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Interview Type <span class="req"/> </label>
                                    <div class="col-sm-10"> 
                                        <select name="interview_type" id="interview_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            $interview_type = $this->Common_model->get_array('interview_type');
                                            foreach ($interview_type as $key => $val):
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Interview Date <span class="req"/> </label>
                                    <div class="col-sm-10">                            
                                        <input type="text" name="interview_date" id="interview_date" class="form-control dt_pick input-sm" placeholder="Interview Date" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Interview Time </label>
                                    <div class="col-sm-10">  
                                        <input type="text" name="interview_time" id="interview_time" class="form-control time_pick input-sm" placeholder="Interview Time" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">                        
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Create_Schedule/add_Create_Schedule_index" ?>">Close</a>
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                        </div>

                    </form>
                </div>

                <script>

                    $("#requisition_id").select2({
                        placeholder: "Select Requisition ID",
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

                </script>

                <?php
            } else if ($type == 2) {//update
                ?>
                <div class="col-md-12" style="margin-top: 10px">
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Create_Schedule/update_Create_Schedule" enctype="multipart/form-data" role="form" >
                        <?php
                        foreach ($query->result() as $i_row) {
                            ?>
                            <div class="panel panel-u margin-bottom-40">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Schedule Interview </h3>
                                </div>
                                <div class="panel-body">
                                    <input type="hidden" value="<?php echo $i_row->id; ?>" name="int_id"/>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"> Schedule Group <span class="req"/> </label>
                                        <div class="col-sm-10">  
                                            <input type="text" name="schedule_group" id="schedule_group" value="<?php echo $i_row->schedule_group; ?>" class="form-control input-sm" placeholder="Schedule Group" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"> Requisition ID <span class="req"/> </label>
                                        <div class="col-sm-10">                            
                                            <select disabled name="requisition_id" id="requisition_id" onchange="load_candidate_name(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                <option></option>
                                                <?php
                                                foreach ($opening_position_query->result() as $key):
                                                    ?>
                                                    <option value="<?php echo $key->id ?>"<?php if ($i_row->requisition_id == $key->id) echo "selected"; ?>><?php echo $key->requisition_code ?></option>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Interviewer<span class="req"/></label>
                                        <div class="col-sm-10"> 
                                            <?php
                                            $series_item_id = explode(",", $i_row->interviewer);
                                            ?>
                                            <select name="interviewer[]" id="interviewer" class="col-sm-12 col-xs-12 myselect2 input-sm" multiple  title="Interviewer (multiple select)" >
                                                <option></option>
                                                <?php
                                                foreach ($employees_query->result() as $key):
                                                    ?>
                                                    <option value="<?php echo $key->employee_id ?>"<?php if (in_array($key->employee_id, $series_item_id)) echo "selected"; ?>><?php echo $key->first_name ." ".$key->last_name ?> (<?php echo sprintf("%07d", $key->employee_id) ?>)</option>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="candidate_email" class="col-sm-2 control-label">Location<span class="req"/> </label>
                                        <div class="col-sm-10">                            
                                            <input type="text" name="location" id="location" value="<?php echo $i_row->location; ?>" class="form-control input-sm" placeholder="Location" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Interview Type<span class="req"/> </label>
                                        <div class="col-sm-10"> 
                                            <select name="interview_type" id="interview_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                <option></option>
                                                <?php
                                                $interview_type = $this->Common_model->get_array('interview_type');
                                                foreach ($interview_type as $key => $val):
                                                    ?>
                                                    <option value="<?php echo $key ?>"<?php if ($i_row->interview_type == $key) echo "selected"; ?>><?php echo $val ?></option>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Interview Date<span class="req"/> </label>
                                        <div class="col-sm-10">                            
                                            <input type="text" name="interview_date" id="interview_date" value="<?php echo $this->Common_model->show_date_formate($i_row->interview_date); ?>" class="form-control dt_pick input-sm" placeholder="Interview Date" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Interview Time </label>
                                        <div class="col-sm-10">  
                                            <input type="text" name="interview_time" id="interview_time" value="<?php echo $i_row->interview_time ?>" class="form-control time_pick input-sm" placeholder="Interview Time" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="modal-footer">                        
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Create_Schedule" ?>">Close</a>
                            <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        </div>
                    </form>
                </div>

                <script>
                    $("#requisition_id").select2({
                        placeholder: "Select Requisition ID",
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

                </script>

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
        $("#sky-form12").submit(function (event) {
            $("#requisition_id").attr('disabled', false);
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form12").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Create_Schedule/add_Create_Schedule';
                view_message(data, url, '', 'sky-form12');

            });
            event.preventDefault();
        });
    });
    $(function () {
        $("#sky-form11").submit(function (event) {
            $("#requisition_id").attr('disabled', false);
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Create_Schedule';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $('#interview_time, .time_pick').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: false,
        showSeconds: false,
        defaultTime: ''
    });

</script>
<!--=== End Script ===-->

