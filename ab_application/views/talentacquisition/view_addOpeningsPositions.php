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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_OpeningsPositions/save_openings_positions" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Requisition Code<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="requisition_code" id="requisition_code" class="form-control input-sm" placeholder="Requisition Code" />
                        </div>
                        <label class="col-sm-2 control-label">Requisitions Date<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="requisitions_date" id="requisitions_date" class="form-control dt_pick input-sm" placeholder="Requisitions Date " autocomplete="off" />
                        </div>
                    </div>
                        
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Due Date<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="due_date" id="due_date" class="form-control dt_pick input-sm" placeholder="Due Date" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-4">                            
                            <select name="location_id" id="location_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($location_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->location_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                              
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Department<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($department_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->department_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Position<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($positions_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->positionname ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                         <label class="col-sm-2 control-label">Reporting Manager</label>
                        <div class="col-sm-4">                           
                            <select name="reporting_manager_id" id="reporting_manager_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($employees_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                          <label class="col-sm-2 control-label">No. of Positions<span class="req"/></label>
                        <div class="col-sm-4">                           
                            <input type="text" name="no_of_positions" id="no_of_positions" class="form-control input-sm" placeholder="Required no. of Positions" />
                        </div>   
                    </div> 
                    
                    <div class="form-group ">                         
                         <label class="col-sm-2 control-label">Qualification</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="required_qualification" id="required_qualification" class="form-control input-sm" placeholder="Required Qualification" />
                        </div> 
                         <label class="col-sm-2 control-label">Experience Range</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="experience_range" id="experience_range" class="form-control input-sm" placeholder="Required Experience Range" />
                        </div>
                    </div>
                    <div class="form-group no-margin">                        
                         <label class="col-sm-2 control-label">Employment Status</label>
                        <div class="col-sm-4">                           
                            <select name="employment_status_id" id="employment_status_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($employmentstatus_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->description ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                         <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-4">                            
                            <select name="priority" id="priority" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($priority_array as $key => $val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Job Description</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="1" id="job_description" name="job_description"></textarea>
                        </div> 
                        <label class="col-sm-2 control-label">Required Skills<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="1" id="required_skills" name="required_skills"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Additional Information</label>
                        <div class="col-sm-4">                           
                            <textarea class="form-control" rows="1" id="additional_information" name="additional_information"></textarea>
                        </div>                        
                        <label class="col-sm-2 control-label">Approver</label>
                        <div class="col-sm-4">                            
                            <select name="approver_id" id="approver_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($employees_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>   
                    </div>  
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_OpeningsPositions" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_OpeningsPositions/update_openings_positions" enctype="multipart/form-data" role="form" >
                    <?php foreach ($OpeningsPositions_query->result() as $row): ?> 
                    <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Requisition Code<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="requisition_code" id="requisition_code" value="<?php echo $row->requisition_code ?>" class="form-control input-sm" placeholder="Requisition Code" />
                        </div>
                        <label class="col-sm-2 control-label">Requisitions Date<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="requisitions_date" id="requisitions_date" value="<?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?>" class="form-control dt_pick input-sm" placeholder="Requisitions Date " autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Due Date<span class="req"/> </label>
                        <div class="col-sm-4">                           
                            <input type="text" name="due_date" id="due_date" value="<?php echo $this->Common_model->show_date_formate($row->due_date) ?>" class="form-control dt_pick input-sm" placeholder="Due Date" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-4">                            
                            <select name="location_id" id="location_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($location_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->location_id == $key->id) echo "selected"; ?>><?php echo $key->location_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Department<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($department_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->department_id == $key->id) echo "selected"; ?>><?php echo $key->department_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Position<span class="req"/></label>
                        <div class="col-sm-4">                           
                            <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($positions_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->position_id == $key->id) echo "selected"; ?>><?php echo $key->positionname ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                         <label class="col-sm-2 control-label">Reporting Manager</label>
                        <div class="col-sm-4">                           
                            <select name="reporting_manager_id" id="reporting_manager_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($employees_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->employee_id ?>"<?php if ($row->reporting_manager_id == $key->id) echo "selected"; ?>><?php echo $key->first_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                         <label class="col-sm-2 control-label">No. of Positions<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <input type="text" name="no_of_positions" id="no_of_positions" value="<?php echo $row->no_of_positions ?>" class="form-control input-sm" placeholder="Required no. of Positions" />
                        </div>   
                    </div> 
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Qualification</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="required_qualification" id="required_qualification" value="<?php echo ucwords($row->required_qualification) ?>" class="form-control input-sm" placeholder="Required Qualification" />
                        </div>
                        <label class="col-sm-2 control-label">Experience Range</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="experience_range" id="experience_range" value="<?php echo $row->experience_range ?>" class="form-control input-sm" placeholder="Required Experience Range" />
                        </div> 
                    </div>
                   <div class="form-group no-margin">                        
                       <label class="col-sm-2 control-label">Employment Status</label>
                        <div class="col-sm-4">                            
                            <select name="employment_status_id" id="employment_status_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($employmentstatus_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->employment_status_id == $key->id) echo "selected"; ?>><?php echo $key->description ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                       <label class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-4">                            
                            <select name="priority" id="priority" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($priority_array as $key => $val):
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->priority == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                   </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Job Description</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="1" id="job_description" name="job_description"><?php echo ucwords($row->job_description) ?></textarea>
                        </div> 
                        <label class="col-sm-2 control-label">Required Skills<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="1" id="required_skills" name="required_skills"><?php echo ucwords($row->required_skills) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Additional Information</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="1" id="additional_information" name="additional_information"><?php echo ucwords($row->additional_information) ?></textarea>
                        </div>
                         <label class="col-sm-2 control-label">Approver</label>
                        <div class="col-sm-4">                           
                            <select name="approver_id" id="approver_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($employees_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->employee_id ?>"<?php if ($row->approver_id == $key->employee_id) echo "selected"; ?>><?php echo $key->first_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>   
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_OpeningsPositions" ?>">Close</a>
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
                
                var url='<?php echo base_url() ?>con_OpeningsPositions';
                view_message(data,url,'','sky-form11');
               
            });
            event.preventDefault();
        });
    });

    $("#location_id").select2({
        placeholder: "Select Location",
        allowClear: true,
    });

    $("#department_id").select2({
        placeholder: "Select Department",
        allowClear: true,
    });
    
    $("#position_id").select2({
        placeholder: "Select Position",
        allowClear: true,
    });
    $("#reporting_manager_id").select2({
        placeholder: "Select Reporting Manager",
        allowClear: true,
    });
    $("#employment_status_id").select2({
        placeholder: "Select Employment Status",
        allowClear: true,
    });
    $("#priority").select2({
        placeholder: "Select Priority",
        allowClear: true,
    });
    $("#approver_id").select2({
        placeholder: "Select Approver",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

