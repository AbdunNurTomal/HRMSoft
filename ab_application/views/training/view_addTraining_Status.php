<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <?php
                if ($type == 1) {
                    ?>
                    <form id="training_status_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Status/save_Training_Status" enctype="multipart/form-data" role="form" >
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Training Details </h4></u></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Training Status <span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <select name="training_status" id="training_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    $training_status = $this->Common_model->get_array('training_status');
                                    foreach ($training_status as $keyy => $vall):
                                        // if($keyy==0 || $keyy==3 || $keyy==4)
                                        //{
                                        ?>
                                        <option value="<?php echo $keyy ?>"><?php echo $vall ?></option>
                                        <?php
                                        //}
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                            <label class="col-sm-2 control-label">Certification</label>
                            <div class="col-sm-4">                            
                                <input type="text" name="certification" id="certification" class="form-control input-sm" placeholder="Certification " />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Issued Date </label>
                            <div class="col-sm-4">
                                <input type="text" name="issued_date" id="issued_date" class="form-control dt_pick input-sm" placeholder="Issued Date" autocomplete="off" />
                            </div>
                            <label class="col-sm-2 control-label">Comments</label>
                            <div class="col-sm-4">                            
                                <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="Comments"  title="Comments"></textarea>
                            </div>
                        </div>

                        <div class="table-responsive col-md-12 col-centered">
                            <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                <tbody>
                                    <?php
                                    if ($query) {
                                        foreach ($query->result() as $roww) {
                                            $employee = explode(",", $roww->employee);
                                            $employees = array_map('intval', $employee);
                                            $employees = '';
                                            foreach ($employee as $emp) {
                                                if ($employees == '') {
                                                    $employees = $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'first_name');
                                                } else {
                                                    $employees = $employees . "," . $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'first_name');
                                                }
                                            }
                                            ?>
                                        <input type="hidden" value="<?php echo $roww->id; ?>" name="training_requisition_id" id="training_requisition_id">
                                        <input type="hidden" value="<?php echo $roww->training_id; ?>" name="training_id" id="training_id">
                                        <tr>
                                            <th>Training Name : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $roww->training_id, 'main_new_training', 'training_name'); ?></td>
                                            <th>Proposed Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($roww->proposed_date); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Employee : </th>
                                            <td><?php echo $employees; ?></td>
                                            <th>Training Objective : </th>
                                            <td><?php echo $roww->training_objective; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>     
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Trainee Details </h4></u></label>
                        </div>

                        <div class="table-responsive col-md-12 col-centered">
                            <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th> &nbsp; </th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Position</th>
                                        <th>Training Name</th>
                                        <th>Proposed Date</th>
                                        <th>Training Objective</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query) {
                                        foreach ($query->result() as $row) {
                                            $employee = explode(",", $row->employee);
                                            foreach ($employee as $emp) {
                                                $position_id = $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'position');
                                                $position = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                $pdt = $row->id;
                                                print"<tr>";
                                                print"<td id='catA" . $pdt . "'>" . "<input name='emp_id[]' id='emp_id' type='checkbox' value='$emp'>" . "</td>";
                                                print"<td id='catA" . $pdt . "'>" .  sprintf("%07d", $emp) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'first_name') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $position . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->proposed_date) . "</td>";
                                                print"<td id='catA" . $pdt . "'>" . $row->training_objective . "</td>";
                                                print"</tr>";
                                            }
                                        }
                                    }
                                    ?> 
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 ">
                            <div class="modal-footer">                        
                                <button type="submit" id="submit" class="btn btn-u"> Update </button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Status" ?>">Close</a>
                            </div>
                        </div>

                    </form>
                    <?php
                } else if ($type == 2) {//edit
                ?>
                <form id="training_status_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Status/update_Training_Status" enctype="multipart/form-data" role="form" >
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Training Details </h4></u></label>
                        </div>
                        <?php foreach ($query->result() as $row): ?> 
                            <input type="hidden" name="id" id="id" value="<?php echo $row->id ?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Training Status <span class="req"/> </label>
                                <div class="col-sm-4">                            
                                    <select name="training_status" id="training_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $training_status = $this->Common_model->get_array('training_status');
                                        foreach ($training_status as $keyy => $vall):
                                            // if($keyy==0 || $keyy==3 || $keyy==4)
                                            //{
                                            ?>
                                            <option value="<?php echo $keyy ?>" <?php if ($keyy == $row->training_status) echo "selected" ?> ><?php echo $vall ?></option>
                                            <?php
                                            //}
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                                <label class="col-sm-2 control-label">Certification</label>
                                <div class="col-sm-4">                            
                                    <input type="text" name="certification" id="certification" value="<?php echo $row->certification ?>" class="form-control input-sm" placeholder="Certification " />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Issued Date </label>
                                <div class="col-sm-4">
                                    <input type="text" name="issued_date" id="issued_date" value="<?php echo $this->Common_model->show_date_formate($row->issued_date) ?>" class="form-control dt_pick input-sm" placeholder="Issued Date" autocomplete="off" />
                                </div>
                                <label class="col-sm-2 control-label">Comments</label>
                                <div class="col-sm-4">                            
                                    <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="Comments"  title="Comments"> <?php echo $row->comments ?> </textarea>
                                </div>
                            </div>


                            <div class="table-responsive col-md-12 col-centered">
                                <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>
                                        <?php
                                        $pquery = $this->db->get_where('main_training_requisition', array('id' => $row->training_requisition_id));
                                        if ($pquery) {
                                            foreach ($pquery->result() as $roww) {
                                                $employee = explode(",", $roww->employee);
                                                $employees = array_map('intval', $employee);
                                                $employees = '';
                                                foreach ($employee as $emp) {
                                                    if ($employees == '') {
                                                        $employees = $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'first_name');
                                                    } else {
                                                        $employees = $employees . "," . $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'first_name');
                                                    }
                                                }
                                                ?>
                                            <input type="hidden" value="<?php echo $roww->id; ?>" name="training_requisition_id" id="training_requisition_id">
                                            <input type="hidden" value="<?php echo $roww->training_id; ?>" name="training_id" id="training_id">
                                            <tr>
                                                <th>Training Name : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $roww->training_id, 'main_new_training', 'training_name'); ?></td>
                                                <th>Proposed Date : </th>
                                                <td><?php echo $this->Common_model->show_date_formate($roww->proposed_date); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Employee : </th>
                                                <td><?php echo $employees; ?></td>
                                                <th>Training Objective : </th>
                                                <td><?php echo $roww->training_objective; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>     
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right"><u><h4>Trainee Details </h4></u></label>
                            </div>

                            <div class="table-responsive col-md-12 col-centered">
                                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th> &nbsp; </th>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Position</th>
                                            <th>Training Name</th>
                                            <th>Proposed Date</th>
                                            <th>Training Objective</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $emp_query = $this->db->get_where('main_training_status_details', array('master_id' => $row->id));
                                        $emplo = array();
                                        if ($emp_query->num_rows() > 0) {
                                            foreach ($emp_query->result() as $emprow) {
                                                $emplo[] = $emprow->employee_id;
                                            }
                                        }

                                        if ($pquery) {
                                            foreach ($pquery->result() as $prow) {
                                                $employee = explode(",", $prow->employee);

                                                foreach ($employee as $emp) {

                                                    if (!in_array($emp, $emplo)) {
                                                        $chk = "";
                                                    } else {
                                                        $chk = "checked";
                                                    }

                                                    $position_id = $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'position');
                                                    $position = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                    $pdt = $row->id;
                                                    print"<tr>";
                                                    print"<td id='catA" . $pdt . "'>" . "<input name='emp_id[]' id='emp_id' type='checkbox' value='$emp' $chk >" . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . sprintf("%07d", $emp) . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_selected_value($this, 'employee_id', $emp, 'main_employees', 'first_name') . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $position . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $prow->training_id, 'main_new_training', 'training_name') . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($prow->proposed_date) . "</td>";
                                                    print"<td id='catA" . $pdt . "'>" . $prow->training_objective . "</td>";
                                                    print"</tr>";
                                                }
                                            }
                                        }
                                        ?> 
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 ">
                                <div class="modal-footer">                        
                                    <button type="submit" id="submit" class="btn btn-u"> Update </button>
                                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Status" ?>">Close</a>
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
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#training_status_form").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#training_status_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Training_Status';
                view_message(data, url, '', 'training_status_form');

            });
            event.preventDefault();
        });
    });


    $("#training_status").select2({
        placeholder: "Select Training Status",
        allowClear: true,
    });




</script>
<!--=== End Script ===-->

