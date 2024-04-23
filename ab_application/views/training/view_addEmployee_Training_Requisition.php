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
            <div class="col-md-12 " style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employee_Training_Requsition/save_Training_Requisition" enctype="multipart/form-data" role="form" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Name <span class="req"/> </label>
                        <div class="col-sm-4"> 
                            <div id="training_id_div">
                                <select name="training_id" id="training_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($training_query->result() as $trow) {
                                    ?>
                                        <option value="<?php echo $trow->id ?>" <?php if ($trow->id == $training_id) echo "selected" ?> ><?php echo $trow->training_name ?></option>
                                    <?php                                    
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
<!--                        <label class="col-sm-1 control-label"> 
                            <a onClick="add_training()" href="#" title="Add Training"><span class="badge badge-u"> New </span> </a>
                        </label>-->
                        <label class="col-sm-2 control-label">Proposed Date<span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="proposed_date" id="proposed_date" class="form-control dt_pick input-sm" placeholder="Proposed Date" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Training Objective  </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="training_objective" name="training_objective"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Select Employee For Training </h4></u></label>
                    </div>
                    
                    <div class="table-responsive col-md-12 col-centered">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th> &nbsp; </th>
                                    <th>Employee ID </th>
                                    <th>Employee Name </th>
                                    <th>Position </th>
                                    <th>Hire Date </th>
                                    <th>Location </th>
                                    <th>Department </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($employees_query) {
                                    $sl = 0;
                                    foreach ($employees_query->result() as $row) {
                                        $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_idd,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_idd,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_idd,'main_employees','last_name');
                                        $sl++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . "<input name='employee_id[]' id='employee_id' type='checkbox' value='$row->employee_idd'>" . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . sprintf("%07d", $row->employee_idd) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $employee_name . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->hire_date) . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') . "</td>";
                                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') . "</td>";
                                        print"</tr>";
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Requisition" ?>">Close</a>
                    </div>
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
                //alert (data);
                var url='<?php echo base_url() ?>Con_Employee_Training_Requsition';
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

