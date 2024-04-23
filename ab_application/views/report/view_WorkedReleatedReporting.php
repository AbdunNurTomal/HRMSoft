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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_WorkedReleatedReporting/search_WorkedReleatedReporting/'; ?>" method="post">
                    <div class="row">
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Location  </label>
                                <div class="col-sm-8">
                                    <select name="location_id" id="location_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($location_query->result() as $key) {
                                            $slct = ($search_criteria['location_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->location_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Exempt</label>
                                <div class="col-sm-8">
                                    <select name="exempt" id="exempt" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $employee_type_array = $this->Common_model->get_array('employee_type');
                                        foreach ($employee_type_array as $keyyy => $valll):
                                            $slct = ($search_criteria['exempt'] == $keyyy) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $keyyy ?>"<?php echo $slct; ?>><?php echo $valll ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employee Type  </label>
                                <div class="col-sm-8">
                                    <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($employmentstatus_query->result() as $key):
                                         $slct = ($search_criteria['employee_type'] == $key->id) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $key->id ?>"<?php echo $slct; ?>><?php echo $key->employemnt_status ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Salary Type</label>
                                <div class="col-sm-8">
                                    <select name="salary_type" id="salary_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $wage_type_array = $this->Common_model->get_array('wage_type');
                                        foreach ($wage_type_array as $keyw => $valw):
                                            $slct = ($search_criteria['salary_type'] == $keyw) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $keyw ?>"<?php echo $slct; ?>><?php echo $valw ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Department  </label>
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Position  </label>
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
                </form>
                
                <div class="overflow-x" style="overflow-y: scroll; margin-bottom: 12px; max-height: 500px;">
                    <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Worked Releated Reporting </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                        <table id="" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Employee No.</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Hire Date</th>
                                    <th>Birth Date</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Reporting Manager</th>
                                    <th>Wages Type</th>
                                    <th>Salary Type</th>
                                    <th>Hourly Rate</th>
                                    <th>Hourly Per Pay Period</th>
                                    <th>Per Pay Period Salary</th>
                                    <th>Yearly Salary </th>
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
                                        <td><?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></td>
                                        <td><?php echo $this->Common_model->show_date_formate($row->hire_date); ?></td>
                                        <td><?php echo $this->Common_model->show_date_formate($row->birthdate); ?></td>
                                        <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></td>
                                        <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                        <td><?php echo $this->Common_model->get_name($this, $row->reporting_manager, 'main_employees', 'first_name') ?></td>
                                        <td><?php echo $this->Common_model->get_name($this, $row->wages, 'main_payfrequency', 'freqtype') ?></td>
                                        <td><?php echo $wage_type_array[$row->salary_type] ?></td>
                                        <td><?php echo $row->per_hour_rate ?></td>
                                        <td><?php  echo $row->hours_per_pay_period ?></td>
                                        <td><?php  echo round($row->per_pay_period_salary,2) ?></td>
                                        <td><?php  echo round($row->yearly_salary,2) ?></td>
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
    
    $("#exempt").select2({
        placeholder: "Select Exempt",
        allowClear: true
    });
    
    $("#employee_type").select2({
        placeholder: "Select employee type",
        allowClear: true
    });
    
    $("#salary_type").select2({
        placeholder: "Select salary type",
        allowClear: true
    });
    
    $("#location_id").select2({
        placeholder: "Select location",
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
    $("#requisition_status").select2({
        placeholder: "Select requisition status",
        allowClear: true
    });

    function printDiv() {
        $.print("#print_to_Div");
    }
   
</script>
<!--=== End Content ===-->

