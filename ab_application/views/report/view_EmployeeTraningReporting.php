<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Employee_Training_Reporting/search_EmployeeTrainingReporting/'; ?>" method="post">
                    <div class="row">
                         <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Training Date</label>
                                <div class="col-sm-5">
                                    <input type="text" autocomplete="off" name="from_date" value="<?php echo $search_criteria['from_date'] ?>"  class="form-control dt_pick ">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" autocomplete="off" name="to_date"  value="<?php echo $search_criteria['to_date'] ?>" class="form-control  dt_pick">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employee Name</label>
                                <div class="col-sm-8">
                                    <select name="employee_name" id="employee_name" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
   
                                        foreach ($employee_query->result() as $key):
                                            $slct = ($search_criteria['employee_name'] == $key->id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key->id ?>"<?php echo $slct; ?>><?php echo $key->first_name.' '.$key->last_name ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Department</label>
                                <div class="col-sm-8">
                                    <select name="department_id" id="department_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($department_query->result() as $key) {
                                            $slct = ($search_criteria['department_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->department_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                         </div>
                        <div class="col-sm-12">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Position</label>
                                <div class="col-sm-8">
                                    <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($positions_query->result() as $key):
                                            $slct = ($search_criteria['position_id'] == $key->positionname) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key->positionname ?>"<?php echo $slct; ?>><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                    <button class="btn-u center-align" type='button' id='btn' onclick='printDiv();'> <i class="fa fa-print" aria-hidden="true"></i> PDF </button>
                                    <a href="#" class="btn-u center-align" onClick ="$('#print_to_Div').tableExport({type: 'excel', escape: 'false'});"><i class="fa fa-file-excel-o" aria-hidden="true"></i> XLS </a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
                
                <div class="overflow-x" style="overflow-y: scroll; margin-bottom: 12px; max-height: 500px;">
                    <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Employee Training & Certification Reporting </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Number</th>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Course Name</th>
                            <th>Course Level</th>
                            <th>Certification</th>
                            <th>Issued Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $status_array = $this->Common_model->get_array('status');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                    
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                ?>
                                <td><?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style='color:" . (($row->isactive == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->isactive] . "</span>" ?></td>
                                <td><?php echo $row->salutation . " " . $row->first_name . ", " . $row->last_name; ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></td>
                                <td><?php echo $row->course_name;?></td>
                                <td><?php echo $row->course_level;?></td>
                                <td><?php echo $row->certification_name;?></td>
                                <td><?php echo $row->issued_date;?></td>
                                <?php
                               
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    $("#educationlevel").select2({
        placeholder: "Education Level",
        allowClear: true
    });
    
    $("#employee_name").select2({
        placeholder: "Select employee Name",
        allowClear: true
    });

    
    $("#department_id").select2({
        placeholder: "Select department",
        allowClear: true
    });
    $("#position_id").select2({
        placeholder: "Select position",
        allowClear: true
    });

    function printDiv() {
        $.print("#print_to_Div");
    }

   
</script>
<!--=== End Content ===-->

