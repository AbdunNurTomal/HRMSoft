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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_training_hr_feedback/save_Training_hr_Feedback" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <select  name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm"  >
                                <option></option>
                                <?php
                                foreach ($training_status->result() as $erow) {
                                    $training_name=$this->Common_model->get_name($this, $erow->training_id, 'main_new_training', 'training_name')
                                    ?>
                                    <option value="<?php echo $erow->training_id ?>"<?php if ($erow->training_id == $training_id) echo "selected" ?> ><?php echo $training_name ?></option>
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
                        <label class="col-sm-2 control-label">Comments </label>
                        <div class="col-sm-4">
                            <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="Comments"  title="Comments"></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="com-md-10 col-md-offset-1 padding-top-5">
                        
                        <div class="form-group">
                            <label> This training program level was useful for you: <span class="req"/> </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="usefulforyou" id="usefulforyou" value="1" checked> Agree
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="usefulforyou" id="usefulforyou" value="2"> Indifferent
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="usefulforyou" id="usefulforyou" value="3"> Disagree
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Do you agree that it was easy to follow the training instructions?  <span class="req"/> </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="easytofollow" id="easytofollow" value="1" checked> Strongly Agree
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="easytofollow" id="easytofollow" value="2"> Somewhat agree
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="easytofollow" id="easytofollow" value="3"> Neutral Agree
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="easytofollow" id="easytofollow" value="4"> Disagree
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Was the content and language in which the instructors communicated to you, understandable? <span class="req"/> </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="understandable" id="understandable" value="1" checked> Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="understandable" id="understandable" value="2"> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Was the training programme organised in an effective manner?  <span class="req"/> </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="effectivemanner" id="effectivemanner" value="1" checked> Yes, it was
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="effectivemanner" id="effectivemanner" value="2"> No
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="effectivemanner" id="effectivemanner" value="3"> Could have been better
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Would you like to attend another program from our organisation in future? <span class="req"/> </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="organisationinfuture" id="organisationinfuture" value="1" checked> Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="organisationinfuture" id="organisationinfuture" value="2"> May be
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="organisationinfuture" id="organisationinfuture" value="3"> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> How do you rate the training overall? <span class="req"/> </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="trainingoverall" id="trainingoverall" value="1" checked> Excellent
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="trainingoverall" id="trainingoverall" value="2"> Good
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="trainingoverall" id="trainingoverall" value="3"> Average
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="trainingoverall" id="trainingoverall" value="4"> Poor
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="trainingoverall" id="trainingoverall" value="5"> Very poor
                                </label>
                            </div>
                        </div>
                        
                    </div>
                     
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_training_hr_feedback" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } 
            else if ($type == 2) {
                 ?>
                <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_training_hr_feedback/update_Training_hr_Feedback" enctype="multipart/form-data" role="form" >
                        <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <select  name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm"  >
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
                            <label class="col-sm-2 control-label">Comments </label>
                            <div class="col-sm-4">
                                <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="Comments"  title="Comments"> <?php echo $row->comments ?> </textarea>
                            </div>
                        </div>
                       
                        <div class="com-md-10 col-md-offset-1 padding-top-5">

                            <div class="form-group">
                                <label> This training program level was useful for you: <span class="req"/> </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="usefulforyou" id="usefulforyou" value="1" <?php echo ($row->usefulforyou==1) ? "checked" : "" ?> > Agree
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="usefulforyou" id="usefulforyou" value="2" <?php echo ($row->usefulforyou==2) ? "checked" : "" ?> > Indifferent
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="usefulforyou" id="usefulforyou" value="3" <?php echo ($row->usefulforyou==3) ? "checked" : "" ?> > Disagree
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Do you agree that it was easy to follow the training instructions?  <span class="req"/> </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="easytofollow" id="easytofollow" value="1" <?php echo ($row->easytofollow==1) ? "checked" : "" ?> > Strongly Agree
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="easytofollow" id="easytofollow" value="2" <?php echo ($row->easytofollow==2) ? "checked" : "" ?> > Somewhat agree
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="easytofollow" id="easytofollow" value="3" <?php echo ($row->easytofollow==3) ? "checked" : "" ?> > Neutral Agree
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="easytofollow" id="easytofollow" value="4" <?php echo ($row->easytofollow==4) ? "checked" : "" ?> > Disagree
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Was the content and language in which the instructors communicated to you, understandable? <span class="req"/> </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="understandable" id="understandable" value="1" <?php echo ($row->understandable==1) ? "checked" : "" ?> > Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="understandable" id="understandable" value="2" <?php echo ($row->understandable==2) ? "checked" : "" ?> > No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Was the training programme organised in an effective manner?  <span class="req"/> </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="effectivemanner" id="effectivemanner" value="1" <?php echo ($row->effectivemanner==1) ? "checked" : "" ?> > Yes, it was
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="effectivemanner" id="effectivemanner" value="2" <?php echo ($row->effectivemanner==2) ? "checked" : "" ?> > No
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="effectivemanner" id="effectivemanner" value="3" <?php echo ($row->effectivemanner==3) ? "checked" : "" ?> > Could have been better
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Would you like to attend another program from our organisation in future? <span class="req"/> </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="organisationinfuture" id="organisationinfuture" value="1" <?php echo ($row->organisationinfuture==1) ? "checked" : "" ?> > Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="organisationinfuture" id="organisationinfuture" value="2" <?php echo ($row->organisationinfuture==2) ? "checked" : "" ?> > May be
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="organisationinfuture" id="organisationinfuture" value="3" <?php echo ($row->organisationinfuture==3) ? "checked" : "" ?> > No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> How do you rate the training overall? <span class="req"/> </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trainingoverall" id="trainingoverall" value="1"  <?php echo ($row->trainingoverall==1) ? "checked" : "" ?> > Excellent
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trainingoverall" id="trainingoverall" value="2" <?php echo ($row->trainingoverall==2) ? "checked" : "" ?> > Good
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trainingoverall" id="trainingoverall" value="3" <?php echo ($row->trainingoverall==3) ? "checked" : "" ?> > Average
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trainingoverall" id="trainingoverall" value="4" <?php echo ($row->trainingoverall==4) ? "checked" : "" ?> > Poor
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trainingoverall" id="trainingoverall" value="5" <?php echo ($row->trainingoverall==5) ? "checked" : "" ?> > Very poor
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u"> Save </button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_training_hr_feedback" ?>">Close</a>
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
                
                var url='<?php echo base_url() ?>Con_training_hr_feedback';
                view_message(data,url,'','sky-form11');
               
            });
            event.preventDefault();
        });
        
        //get_participant($('#training_id').val());
        
    });
    
//    function get_participant(id)
//    {
//        $.ajax({
//          url: "<?php // echo site_url('Con_training_hr_feedback/load_participant_name/') ?>/" + id,
//          async: false,
//          type: "POST",
//          success: function (data) {
//              $('#employee_id').html('');
//              $('#employee_id').empty();
//
//              $('#employee_id').html(data);
//            }
//        });
//    }

    $("#training_id").select2({
        placeholder: "Select Training Name",
        allowClear: true,
    });
    
//    $("#employee_id").select2({
//        placeholder: "Select Participant Name",
//        allowClear: true,
//    });
//    
   

</script>
<!--=== End Script ===-->

