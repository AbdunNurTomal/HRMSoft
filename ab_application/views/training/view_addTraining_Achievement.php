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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Achievement/save_Training_Achievement" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <select  name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($training_status->result() as $erow) {
                                    $training_name=$this->Common_model->get_name($this, $erow->training_id, 'main_new_training', 'training_name')
                                    ?>
                                    <option value="<?php echo $erow->training_id ?>" ><?php echo $training_name ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Date OF Training </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_date" id="training_date" class="form-control dt_pick input-sm" placeholder="Date OF Training " autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Total Training Period </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="total_training_period" id="total_training_period" class="form-control input-sm" placeholder="Total Training Period " />
                        </div>
                        <label class="col-sm-2 control-label"> Training Objective </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_objective" name="training_objective"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Output </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_output" name="training_output"></textarea>
                        </div>
                        <label class="col-sm-2 control-label"> Training Outcome </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_outcome" name="training_outcome"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Comments </label>
                        <div class="col-sm-4">
                            <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="Comments"  title="Comments"></textarea>
                        </div>
                       
                    </div>
                     
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Achievement" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } 
            else if ($type == 2) {
                 ?>
                <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Achievement/update_Training_Achievement" enctype="multipart/form-data" role="form" >
                        <?php foreach ($query->result() as $row): ?>
                        
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <select  name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="get_participant(this.value);" >
                                    <option></option>
                                    <?php
                                    foreach ($training_status->result() as $erow) {
                                        $training_name=$this->Common_model->get_name($this, $erow->training_id, 'main_new_training', 'training_name')
                                        ?>
                                        <option value="<?php echo $erow->training_id ?>" <?php if ($erow->training_id == $row->training_id) echo "selected" ?> ><?php echo $training_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                            <label class="col-sm-2 control-label">Date OF Training </label>
                            <div class="col-sm-4">
                                <input type="text" name="training_date" id="training_date" value="<?php echo $this->Common_model->show_date_formate($row->training_date) ?>" class="form-control dt_pick input-sm" placeholder="Date OF Training " autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Total Training Period </label> 
                            <div class="col-sm-4">                            
                                <input type="text" name="total_training_period" id="total_training_period" value="<?php echo $row->total_training_period ?>" class="form-control input-sm" placeholder="Total Training Period " />
                            </div>
                            <label class="col-sm-2 control-label"> Training Objective </label>
                            <div class="col-sm-4">
                                <textarea class="form-control input-sm" rows="2" id="training_objective" name="training_objective"> <?php echo $row->training_objective ?> </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Training Output </label>
                            <div class="col-sm-4">
                                <textarea class="form-control input-sm" rows="2" id="training_output" name="training_output"> <?php echo $row->training_output ?> </textarea>
                            </div>
                            <label class="col-sm-2 control-label"> Training Outcome </label>
                            <div class="col-sm-4">
                                <textarea class="form-control input-sm" rows="2" id="training_outcome" name="training_outcome"> <?php echo $row->training_outcome ?> </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Comments </label>
                            <div class="col-sm-4">
                                <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="Comments"  title="Comments"> <?php echo $row->comments ?>  </textarea>
                            </div>

                        </div>

                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u"> Save </button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Achievement" ?>">Close</a>
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
                
                var url='<?php echo base_url() ?>Con_Training_Achievement';
                view_message(data,url,'','sky-form11');
               
            });
            event.preventDefault();
        });
        
    });

    $("#training_id").select2({
        placeholder: "Select Training Name",
        allowClear: true,
    });
  

</script>
<!--=== End Script ===-->

