<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;">

            <div class="col-md-10 col-md-offset-1">

                <?php
                if ($type == 1) {//entry
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Announcements/save_announcements" enctype="multipart/form-data" role="form" >
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group" style="margin-top: 15px;">

                            <label class="col-sm-2 control-label">Title<span class="req"/></label>
                            <div class="col-sm-4">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" />
                            </div> 

                            <label class="col-sm-2 control-label">Location<span class="req"/> </label>
                            <div class="col-sm-4">
                                <select name="location_id" id="location_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($location_query->result() as $row) {
                                        print"<option value='" . $row->id . "'>" . $row->location_name . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 15px;">

                            <label class="col-sm-2 control-label">Department<span class="req"/></label>
                            <div class="col-sm-4">
                                <!-- <select multiple name="department_id[]" id="department_id" onchange="emp_load(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm"> -->
                                <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php foreach ($department->result() as $row) {
                                        print"<option value='" . $row->id . "'>" . $row->department_name . "</option>";
                                    } ?>
                                </select>
                            </div> 
                            <!-- <label class="col-sm-2 control-label">Employee </label>
                            <div class="col-sm-4">
                                <select multiple name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php /* foreach ($department->result() as $row) {
                                       print"<option value='" . $row->id . "'>" . $row->department_name . "</option>";
                                    } */ ?>
                                </select>
                            </div> -->
                        </div>
                        <div class="form-group" style="margin-top: 15px;">

                            <label class="col-sm-2 control-label">Validation Data  </label>
                            <div class="col-sm-4">
                                <input type="text" name="val_date" id="val_date" class="form-control dt_pick" placeholder="Validation Data" />
                            </div> 

                            
                        </div>
                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-2 control-label pull-left">Announcements</label>
                            <div class="col-sm-10">
                                <textarea class="ckeditor" rows="2" id="description" name="description"></textarea>
                                <textarea name="hidden_description" id="hidden_description" style="display:none;"></textarea>
                            </div>                        
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_BusinessUnit" ?>">Close</a>
                        </div>
                    </form>
                    <?php
                } else if ($type == 2) {//edit
                    //print_r($query);
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_Announcements/update_announcements" enctype="multipart/form-data" role="form" >
                        <?php foreach ($query->result() as $row): ?> 
                            <input type="hidden" value="<?php echo $row->id ?>" name="id"/>


                            <div class="form-group" style="margin-top: 15px;">

                                <label class="col-sm-2 control-label">Title<span class="req"/></label>
                                <div class="col-sm-4">
                                    <input type="text" name="title" id="title" class="form-control" value="<?php echo ucwords($row->title); ?>" placeholder="Title" />
                                </div> 

                                <label class="col-sm-2 control-label">Location<span class="req"/> </label>
                                <div class="col-sm-4">
                                    <select name="location_id" id="location_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <?php foreach ($location_query->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->location_id == $row1->id) echo "selected"; ?>><?php echo $row1->location_name ?></option>
                                        <?php endforeach; ?>
                                    </select>   
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">

                                <label class="col-sm-2 control-label">Department<span class="req"/> </label>
                                <div class="col-sm-4">
                                    <!-- <select multiple name="department_id[]" id="department_id" onchange="emp_load(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm"> -->
                                    <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <?php foreach ($department->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->department_id == $row1->id) echo "selected"; ?>><?php echo $row1->department_name ?></option>
                                        <?php endforeach; ?>
                                    </select>  
                                </div> 
                                <!-- <label class="col-sm-2 control-label">Employee </label>
                                <div class="col-sm-4">
                                    <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <?php // foreach ($department->result() as $row1): ?>
                                            <option value="<?php // echo $row1->id ?>"<?php // if ($row->department_id == $row1->id) echo "selected"; ?>><?php // echo $row1->department_name ?></option>
                                        <?php // endforeach; ?>
                                    <!-- </select>
                                </div> -->
                            </div> 
                            <div class="form-group" style="margin-top: 15px;">
                                <label class="col-sm-2 control-label">Validation Data</label>
                                <div class="col-sm-4">
                                    <input type="text" name="val_date" id="val_date" class="form-control dt_pick" value="<?php echo $this->Common_model->show_date_formate($row->val_date); ?>" placeholder="Title" />
                                </div>                                  
                            </div> 
                            <div class="form-group" style="margin-top: 15px;">
                                <label class="col-sm-2 control-label">Announcements</label>
                                <div class="col-sm-10 find_mar">
                                    <textarea class="ckeditor" rows="2" id="description" name="description"><?php echo ucwords($row->description); ?></textarea>
                                    <textarea name="hidden_description" id="hidden_description" style="display:none;"></textarea>
                                </div>                        
                            </div>                            
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Announcements" ?>">Close</a>
                            </div>
                        <?php endforeach; ?>
                    </form>
                    <?php
                }
                ?>

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

            var ckdata = CKEDITOR.instances.description.getData();
            $('#hidden_description').val(ckdata);

            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //alert (data);return;

//                $('#sky-form11')[0].reset();

                var url = '<?php echo base_url() ?>con_Announcements';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    function emp_load(id) {

        //var department_id="";
        //$("#department_id").change(function () {
            var department_id = $('#department_id').val();
            // alert (department_id);
            // ghg = '1,2,2';
            $.ajax({
                url: "<?php echo site_url('Con_Announcements/dep_emp/') ?>/" + department_id,
                async: false,
                type: "POST",
                success: function (data) {
                    //alert (data);
                    //$('#employee_id').html(data);
                }
            });
        
        //});
        //alert (department_id);
        
    }


    $("#location_id").select2({
        placeholder: "Location Unit",
        allowClear: true,
    });
    $("#department_id").select2({
        placeholder: "Department",
        allowClear: true,
    });
    $("#employee_id").select2({
        placeholder: "Employee",
        allowClear: true,
    });
</script>
<!--=== End Script ===-->

