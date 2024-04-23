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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ManageHolidays/save_holiday" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label">Holiday<span class="req"/> </label>
                            <input type="text" name="holiday" id="holiday" class="form-control" placeholder="Holiday" />
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label">Group Name<span class="req"/></label>
                            <select name="group_id" id="group_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($holiday_group_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->group_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label">Date</label>
                            <input type="text" name="holiday_date" id="holiday_date" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div>                        
                    </div>                     
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_ManageHolidays" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ManageHolidays/update_holidays" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="row">                             
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="control-label">Holiday<span class="req"/></label>
                                <input type="text" name="holiday" id="holiday" value="<?php echo ucwords($row->holiday) ?>" class="form-control" placeholder="Job Title" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="control-label">Group Name<span class="req"/></label>
                                <select name="group_id" id="group_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php foreach ($holiday_group_query->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($group_id == $row1->id) echo "selected"; ?>><?php echo $row1->group_name ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="control-label">Date</label>
                                <input type="text" name="holiday_date" id="holiday_date" value="<?php echo $this->Common_model->show_date_formate($row->holiday_date) ?>" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" rows="2" id="description" name="description"><?php echo ucwords($row->description) ?></textarea>
                            </div>                            
                        </div>                        
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_ManageHolidays" ?>">Close</a>
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

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                
                $('#sky-form11')[0].reset();
                
                var url='<?php echo base_url() ?>Con_ManageHolidays';
                view_message(data,url,'','sky-form11');
                   
            });
            event.preventDefault();
        });
    });

    $("#group_id").select2({
        placeholder: "Group Id",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

