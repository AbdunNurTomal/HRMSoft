
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11" class="form-horizontal" action="<?php echo base_url(); ?>Con_PtoPolicy/save_pto_policy" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" value="" name="id_emp_pto"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-4">
                                <input name="track_time_off" id="track_time_off" type="checkbox" value="1" > Track Time Off for this Employee 
                            </label>
                        </div>
                        <div class="form-group" class="col-sm-12">
                            <label class="col-sm-2">Rollover On</label>
                            <div  class="col-sm-2">
                                <label><input type="radio" id="rollover_on" name="rollover_on" value="1" checked> Calender Year</label>
                            </div>
                            <div class="col-sm-3">
                                <label><input type="radio" id="rollover_on" name="rollover_on" value="2"> Hire date Anniversary </label>
                            </div>
                            <div class="col-sm-5">
                                <label><input type="radio" id="rollover_on" name="rollover_on" value="3"> Fiscal Year(Enter Fiscal Year date in ER>PTO Policy)</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Leave Type</label>
                            <div class="col-sm-4">
                                <select name="leave_type" id="leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm ">
                                    <option></option>
                                    <?php
                                    foreach ($leave_type_query->result() as $key) {
                                        ?>                                              
                                        <option value="<?php echo $key->id; ?>" > <?php echo $key->leave_code; ?> </option>
                                    <?php }
                                    ?>
                                </select>  
                            </div>
                            <label class="col-sm-2 control-label">Accrual Amount in Hours</label>
                            <div class="col-sm-4">
                                <input type="text" name="accrual_amt" id="accrual_amt" class="form-control input-sm" placeholder="Accrual Amount" data-toggle="tooltip" data-placement="bottom" title="Accrual Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Accrual period</label>
                            <div class="col-sm-4">
                                <select name="accrual_period" id="accrual_period" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($accrual_period_array as $kayy => $roww) {
                                        ?>                                              
                                        <option value="<?php echo $kayy; ?>" > <?php echo $roww; ?> </option>
                                    <?php }
                                    ?>
                                </select> 
                            </div>
                            <label class="col-sm-2 control-label">Start Days After Hire</label>
                            <div class="col-sm-4">
                                <input type="text" name="start_days_after_hire" id="start_days_after_hire" class="form-control input-sm" placeholder="Start Date After Hire" data-toggle="tooltip" data-placement="bottom" title="Start Date After Hire">
                            </div>                  
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Max Accrual</label>
                            <div class="col-sm-4">
                                <input type="text" name="max_accrual" id="max_accrual" class="form-control input-sm" placeholder="Max Accrual" data-toggle="tooltip" data-placement="bottom" title="Max Accrual" autocomplete="off">
                            </div>
                            <label class="col-sm-2 control-label">Max Available</label>
                            <div class="col-sm-4">
                                <input type="text" name="max_available" id="max_available" class="form-control input-sm" placeholder="Max Available" data-toggle="tooltip" data-placement="bottom" title="Max Available">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Max Carryover</label>
                            <div class="col-sm-4">
                                <input type="text" name="max_carryover" id="max_carryover" class="form-control input-sm" placeholder="Max Carryover" data-toggle="tooltip" data-placement="bottom" title="Max Carryover" autocomplete="off">
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_PtoPolicy" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11" class="form-horizontal" action="<?php echo base_url(); ?>Con_PtoPolicy/update_pto_policy" method="post" enctype="multipart/form-data" role="form">
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-4">
                                    <input name="track_time_off" id="track_time_off" type="checkbox" value="1" <?php echo ($row->track_time_off == 1 ? 'checked' : ''); ?> > Track Time Off for this Employee 
                                </label>
                            </div>
                            <div class="form-group" class="col-sm-12">
                                <label class="col-sm-2">Rollover On</label>
                                <div  class="col-sm-2">
                                    <label><input type="radio" id="rollover_on" name="rollover_on" value="1" <?php echo ($row->rollover_on == 1 ? 'checked' : ''); ?>> Calender Year</label>
                                </div>
                                <div class="col-sm-3">
                                    <label><input type="radio" id="rollover_on" name="rollover_on" value="2" <?php echo ($row->rollover_on == 2 ? 'checked' : ''); ?>> Hire date Anniversary </label>
                                </div>
                                <div class="col-sm-5">
                                    <label><input type="radio" id="rollover_on" name="rollover_on" value="3" <?php echo ($row->rollover_on == 3 ? 'checked' : ''); ?> > Fiscal Year(Enter Fiscal Year date in ER>PTO Policy)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Leave Type</label>
                                <div class="col-sm-4">
                                    <select name="leave_type" id="leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($leave_type_query->result() as $key) {
                                            ?>                                              
                                            <option value="<?php echo $key->id; ?>"<?php if ($row->leave_type == $key->id) echo "selected"; ?> > <?php echo $key->leave_code; ?> </option>
                                        <?php }
                                        ?>
                                    </select>  
                                </div>
                                <label class="col-sm-2 control-label">Accrual Amount in Hours</label>
                                <div class="col-sm-4">
                                    <input type="text" name="accrual_amt" id="accrual_amt" value="<?php echo $row->accrual_amt; ?>" class="form-control input-sm" placeholder="Accrual Amount" data-toggle="tooltip" data-placement="bottom" title="Accrual Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Accrual period</label>
                                <div class="col-sm-4">
                                    <select name="accrual_period" id="accrual_period" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($accrual_period_array as $kayy => $roww) {
                                            ?>                                              
                                            <option value="<?php echo $kayy; ?>"<?php if ($row->accrual_period == $kayy) echo "selected"; ?>  > <?php echo $roww; ?> </option>
                                        <?php }
                                        ?>
                                    </select> 
                                </div>
                                <label class="col-sm-2 control-label">Start Days After Hire</label>
                                <div class="col-sm-4">
                                    <input type="text" name="start_days_after_hire" id="start_days_after_hire" value="<?php echo $row->start_days_after_hire; ?>" class="form-control input-sm" placeholder="Start Date After Hire" data-toggle="tooltip" data-placement="bottom" title="Start Date After Hire">
                                </div>                  
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Max Accrual</label>
                                <div class="col-sm-4">
                                    <input type="text" name="max_accrual" id="max_accrual" value="<?php echo $row->max_accrual; ?>" class="form-control input-sm" placeholder="Max Accrual" data-toggle="tooltip" data-placement="bottom" title="Max Accrual" autocomplete="off">
                                </div>

                                <label class="col-sm-2 control-label">Max Available</label>
                                <div class="col-sm-4">
                                    <input type="text" name="max_available" id="max_available" value="<?php echo $row->max_available; ?>" class="form-control input-sm" placeholder="Max Available" data-toggle="tooltip" data-placement="bottom" title="Max Available">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Max Carryover</label>
                                <div class="col-sm-4">
                                    <input type="text" name="max_carryover" id="max_carryover" class="form-control input-sm" value="<?php echo $row->max_carryover; ?>" placeholder="Max Carryover" data-toggle="tooltip" data-placement="bottom" title="Max Carryover" autocomplete="off">
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_PtoPolicy" ?>">Close</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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

    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    
    $("#accrual_period").select2({
        placeholder: "Accrual Period",
        allowClear: true,
    });
    
    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_PtoPolicy';
                view_message(data, url,'','sky-form11');
            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

