<?php 
  $this->company_id = $this->user_data['company_id'];
  if ( $this->user_group == 1 || $this->user_group == 12) {
    $location_query = $this->db->get_where('main_location', array('company_id' => $this->company_id, 'isactive' => 1));
  }else{
      $location_query = $this->db->get_where('main_location', array('isactive' => 1));
  }
?> 
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
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Planning/save_Training_Planning" enctype="multipart/form-data" role="form" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Name <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <select name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($training_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->training_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <label class="col-sm-2 control-label"> Location <span class="req"/> </label>
                        <div class="col-sm-4">                            
                           <!--  <input type="text" name="training_location" id="training_location" class="form-control input-sm" placeholder="Location" /> -->
                          <select name="training_location" id="training_location" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($location_query->result() as $key): ?>
                                    <option value="<?php echo $key->location_name ?>"><?php echo $key->location_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Date <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_date" id="training_date" class="form-control dt_pick input-sm" placeholder="Date" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label"> Time <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_time" id="training_time" class="form-control time_pick input-sm" placeholder="Time" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Instructor </label>
                        <div class="col-sm-4">
                            <input type="text" name="instructor" id="instructor" class="form-control input-sm" placeholder="Instructor" />
                        </div>
                        <label class="col-sm-2 control-label"> Training Cost </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_cost" id="training_cost" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Training Cost"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Facilitator </label>
                        <div class="col-sm-4">
                            <input type="text" name="facilitator" id="facilitator" class="form-control input-sm" placeholder="Facilitator" />
                        </div>
                        <label class="col-sm-2 control-label"> Capacity </label>
                        <div class="col-sm-4">
                            <input type="text" name="capacity" id="capacity" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Capacity"/>
                        </div>
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Planning" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Planning/update_Training_Planning" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                    <input type="hidden" value="<?php echo $row->id ?>" name="id" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Name <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <select name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($training_query->result() as $trow) {
                                    ?>
                                    <option value="<?php echo $trow->id ?>" <?php if ($trow->id == $row->training_id) echo "selected" ?> ><?php echo $trow->training_name ?></option>
                                    <?php
                                }
                                ?>
                            </select>  
                        </div>
                        <label class="col-sm-2 control-label"> Location <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <!-- <input type="text" name="training_location" id="training_location" value="<?php //echo $row->training_location ?>" class="form-control input-sm" placeholder="Location" /> -->
                            <select name="training_location" id="training_location" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php foreach ($location_query->result() as $key): ?>
                                <option value="<?php echo $key->location_name ?>" <?php if ($key->location_name == $row->training_location) echo "selected"; ?> ><?php echo $key->location_name ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Date <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_date" id="training_date" class="form-control dt_pick input-sm" value="<?php echo $this->Common_model->show_date_formate($row->training_date) ?>" placeholder="Date" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label"> Time <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_time" id="training_time" class="form-control time_pick input-sm" value="<?php echo $row->training_time ?>" placeholder="Time" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Instructor </label>
                        <div class="col-sm-4">
                            <input type="text" name="instructor" id="instructor" class="form-control input-sm" value="<?php echo $row->instructor ?>" placeholder="Instructor" />
                        </div>
                        <label class="col-sm-2 control-label"> Training Cost </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_cost" id="training_cost" class="form-control input-sm" value="<?php echo $row->training_cost ?>" onkeypress="return numbersonly(this, event)" placeholder="Training Cost"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Facilitator </label>
                        <div class="col-sm-4">
                            <input type="text" name="facilitator" id="facilitator" class="form-control input-sm" value="<?php echo $row->facilitator ?>" placeholder="Facilitator" />
                        </div>
                        <label class="col-sm-2 control-label"> Capacity </label>
                        <div class="col-sm-4">
                            <input type="text" name="capacity" id="capacity" class="form-control input-sm" value="<?php echo $row->capacity ?>" onkeypress="return numbersonly(this, event)" placeholder="Capacity"/>
                        </div>
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Planning" ?>">Close</a>
                    </div>
                    
                    <?php endforeach; ?>
                </form>
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
            
            loading_box(base_url);
            
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                var url='<?php echo base_url() ?>Con_Training_Planning';
                view_message(data,url,'','sky-form11');
               
            });
            event.preventDefault();
        });
    });

    $("#training_id").select2({
        placeholder: "Select Training",
        allowClear: true,
    });
    
    $("#training_location").select2({
        placeholder: "Select Location",
        allowClear: true,
    });
</script>
<!--=== End Script ===-->

