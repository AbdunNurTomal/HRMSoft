<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 15px;">
            <?php
            if ($type == 1) {//entry
                //echo $type;exit();
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_LeavePolicy/save_leave_policy" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                        <input type="hidden" value="" name="id" id="id"/>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Leave Type<span class="req"></span></label>
                            <div class="col-sm-4">
                                <select name="leave_type" id="leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($leave_type->result() as $row) {
                                        $leave_code=$this->Common_model->get_name($this, $row->leave_code, 'main_leave_types', 'leave_code');
                                        print"<option value='" . $row->leave_code . "'>" . $leave_code . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Employee Type<span class="req"></span></label>
                            <div class="col-sm-4">
                                <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $e_type = $this->Common_model->get_array('employee_type');
                                    foreach ($e_type as $row => $val) {
                                        print"<option value='" . $row . "'>" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Applicable<span class="req"></span></label>
                            <div class="col-sm-4">
                                <select name="applicable" id="applicable" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $applicable = $this->Common_model->get_array('applicable');
                                    foreach ($applicable as $row => $val) {
                                        print"<option value='" . $row . "'>" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Year<span class="req"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="leave_year" id="leave_year" class="form-control input-sm" placeholder="Year" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Is Fractional</label>
                            <div class="col-sm-4">
                                <select name="fractional_leave" id="fractional_leave" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $yes_no_array = $this->Common_model->get_array('yes_no');
                                    foreach ($yes_no_array as $row => $val) {
                                        print"<option value='" . $row . "'>" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Is Day-off</label>
                            <div class="col-sm-4">
                                <select name="off_day_leave_count" id="off_day_leave_count" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $yes_no_array = $this->Common_model->get_array('yes_no');
                                    foreach ($yes_no_array as $row => $val) {
                                        print"<option value='" . $row . "'>" . $val . "</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Max Limit <span class="req"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="max_limit" id="leave_start_date" class="form-control input-sm" placeholder="Max Limit (hour)" autocomplete="off" />
                            </div>
                            <label class="col-sm-2 control-label"> Status </label>
                            <div class="col-sm-4">
                                <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php
                                        $status_array = $this->Common_model->get_array('status');
                                        foreach ($status_array as $key => $val) {
                                    ?>
                                        <option value="<?php echo $key ?>" <?php if($key==1) echo "selected" ?> ><?php echo $val ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_LeavePolicy" ?>">Close</a>
                        </div>
                    
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_LeavePolicy/update_leave_policy" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                    <?php foreach ($leave_management_query->result() as $row): ?> 
                        
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Leave Type<span class="req"></span></label>
                            <div class="col-sm-4">
                                <select name="leave_type" id="leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm">                                
                                    <?php foreach ($leave_type->result() as $row1): 
                                        $leave_code=$this->Common_model->get_name($this, $row1->leave_code, 'main_leave_types', 'leave_code');
                                        ?>
                                        <option value="<?php echo $row1->leave_code ?>"<?php if ($row->leave_type == $row1->leave_code) echo "selected"; ?>><?php echo $leave_code ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                            <label class="col-sm-2 control-label">Employee Type<span class="req"></span></label>
                            <div class="col-sm-4">
                                <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php foreach ($emp_type as $row1 => $val): ?>
                                        <option value="<?php echo $row1 ?>"<?php if ($row->employee_type == $row1) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Applicable<span class="req"></span></label>
                            <div class="col-sm-4">
                                <select name="applicable" id="applicable" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php foreach ($applicable as $row1 => $val): ?>
                                        <option value="<?php echo $row1 ?>"<?php if ($row->applicable == $row1) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                            <label class="col-sm-2 control-label">Year<span class="req"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="leave_year" id="leave_year" class="form-control input-sm" value="<?php echo $row->leave_year ?>" placeholder="Year" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Is Fractional</label>
                            <div class="col-sm-4">
                                <select name="fractional_leave" id="fractional_leave" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php foreach ($yes_no_array as $row1 => $val): ?>
                                        <option value="<?php echo $row1 ?>"<?php if ($row->fractional_leave == $row1) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                            <label class="col-sm-2 control-label"> Is Day-off</label>
                            <div class="col-sm-4">
                                <select name="off_day_leave_count" id="off_day_leave_count" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php foreach ($yes_no_array as $row1 => $val): ?>
                                        <option value="<?php echo $row1 ?>"<?php if ($row->off_day_leave_count == $row1) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Max Limit <span class="req"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="max_limit" id="max_limit" class="form-control input-sm" value="<?php echo $row->max_limit ?>" placeholder="Max Limit (hour)" autocomplete="off" />
                            </div>
                             <label class="col-sm-2 control-label"> Status </label>
                            <div class="col-sm-4">
                                <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php
                                        $status_array = $this->Common_model->get_array('status');
                                        foreach ($status_array as $key => $val) {
                                    ?>
                                        <option value="<?php echo $key ?>" <?php if($key==$row->isactive) echo "selected" ?> ><?php echo $val ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_LeavePolicy" ?>">Close</a>
                        </div>
                        
                    <?php endforeach; ?>
                    </div>
                </form>

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
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $('#sky-form11')[0].reset();
                var url = '<?php echo base_url() ?>Con_LeavePolicy';
                view_message(data, url,'','sky-form11');
            });
            event.preventDefault();
        });
    });

    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    $("#employee_type").select2({
        placeholder: "Employee Type",
        allowClear: true,
    });

    $("#employee_id").select2({
        placeholder: "Employee Id",
        allowClear: true,
    });
    $("#applicable").select2({
        placeholder: "Applicable",
        allowClear: true,
    });
    $("#off_day_leave_count").select2({
        placeholder: "Off-day Leave Count",
        allowClear: true,
    });
    $("#fractional_leave").select2({
        placeholder: "Fractional Leave",
        allowClear: true,
    });
    $("#status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

