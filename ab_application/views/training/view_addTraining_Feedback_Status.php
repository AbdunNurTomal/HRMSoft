<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
         
            <div class="row" >
                <div class="col-lg-12">
                    <div class="panel panel-u" id="print_review">
                        <div class="panel-heading">
                            Training Feedback Status
                        </div>
                        <div class="panel-body">
                <?php foreach ($query->result() as $row): ?>
                    <div class="table-responsive">
                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Training Name : </th>
                                    <td><?php echo $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name'); ?> </td>
                                    <th>Employees : </th>
                                    <td><?php echo $this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name'); ?></td>
                                </tr>
                                <tr>
                                    <th>Training Date : </th>
                                    <td><?php echo $this->Common_model->show_date_formate($row->training_date) ?></td>
                                    <th>Total Training Period : </th>
                                    <td><?php echo $row->total_training_period ?></td>
                                </tr>
                                <tr>
                                    <th>Comments : </th>
                                    <td><?php echo $row->comments ?></td>

                                </tr>
                            </tbody>
                        </table>
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
                <?php endforeach; ?>  
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <div class="col-md-6 col-sm-6 find_mar" style="text-align: left;">
                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Feedback_Status" ?>">Close</a>
                </div>
                <div class="col-md-6 col-sm-6 find_mar" style="text-align: right;">                    
                    <input class="btn btn-default" type='button' id='btn' value='Print' onclick='printDiv();'>
                </div>
            </div>
            
        </div>
    </div>
</div>


</div><!--/row-->
</div><!--/container-->

<script>

function printDiv()  {
    $.print("#print_review");
};

</script>