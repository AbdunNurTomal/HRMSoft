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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_ComprehensiveReport/search_ComprehensiveReport/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> From: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_from']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">To: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_to']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employee </label>
                                <div class="col-sm-8">
                                    <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($employees_query->result() as $key):
                                            $slct = ($search_criteria['employee_id'] == $key->employee_id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key->employee_id ?>" <?php echo $slct; ?>><?php echo $key->first_name.' '.$key->last_name  ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Status </label>
                                <div class="col-sm-8">
                                    <select name="isactive" id="isactive" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($status_array as $key=>$val):
                                            $slct = ($search_criteria['isactive'] == $key) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key ?>" <?php echo $slct; ?> ><?php echo $val; ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
<!--                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button>
                                    <button class="btn-u center-align" type='button' id='btn' onclick='printDiv();'> <i class="fa fa-print" aria-hidden="true"></i> PDF </button>
                                    <a href="#" class="btn btn-u" onClick ="$('#print_to_Div').tableExport({type: 'excel', escape: 'false'});"><i class="fa fa-file-excel-o" aria-hidden="true"></i> XLS </a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
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
                
                <!-- <div class="overflow-x" style="overflow-y: scroll; margin-bottom: 12px; max-height: 500px;"> -->
                    <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Comprehensive Report </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                        <table id="" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="12%">
                                <col width="12%">
                                <col width="12%">
                                <col width="12%">
                                <col width="11%">
                                <col width="11%">
                                <col width="10%">
                               <!--  <col width="10%"> -->
                            </colgroup>
                            <thead>
                                <tr>
                                   <!--  <th>SL</th> -->
                                    <th>Employee No.</th>
                                   <!--  <th>Social Security Number</th> -->
                                    <th>Name</th>
                                   <!--  <th>Phone/Mobile</th> 
                                     <th>Gender</th> -->
                                    <th>Location</th>
                                    <!-- <th>Hire Date</th> -->
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Employee Type</th>
                                    <!-- <th>Birth Date</th> -->
                                    <th>Separation Date</th>
                                    <th>Hourly Rate</th>
                                    <th>Salary</th>
                                    <!-- <th>Action</th> -->
                                   <!--  <th>W-4 (date)?</th>
                                    <th>I-9 (date)?</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $status_array = $this->Common_model->get_array('status');
                                $gender_array = $this->Common_model->get_array('gender');
                                if ($search_data) {
                                    $sl = 0;
                                    foreach ($search_data as $row) {

                                        $w4date = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_emp_w4', 'createddate');
                                        $i9date = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employee_i9', 'createddate');

                                        $sl++;
                                        $pdt = $row->id;
                                        print"<tr>";
                                       // print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                        ?>
                                    <td><?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style='color:" . (($row->isactive == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->isactive] . "</span>" ?></td>
                                   <!--  <td><?php //echo $number = "XXX-XX-" . substr($this->Common_model->decrypt($row->ssn_code), -4); ?></td> -->
                                    <td> <a title="" style="color: #23527c;text-decoration: underline;" href="<?php echo base_url() . "Con_ComprehensiveReport/employeeDetails/" . $row->employee_id; ?>" target="_blank"><?php echo $row->salutation . " " . $row->first_name . ", " . $row->last_name; ?></a></td>
                                    <!-- <td><?php //echo $row->mobile_phone ?></td> 
                                   <td><?php //if ($row->gender) echo $gender_array[$row->gender] ?></td> -->
                                    <td><?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></td>
                                  <!--   <td><?php //echo $this->Common_model->show_date_formate($row->hire_date); ?></td> -->
                                    <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->employee_type, 'tbl_employmentstatus', 'employemnt_status') ?></td>
                                    <!-- <td><?php //echo $this->Common_model->show_date_formate($row->birthdate); ?></td> -->
                                    <td><?php echo $this->Common_model->show_date_formate($row->termination_date); ?></td>
                                    <td><?php echo $row->per_hour_rate; ?></td>
                                    <td><?php echo round($row->per_pay_period_salary, 2); ?></td>
                                <!-- <td><a class="btn btn-info btn-xs" title="Download PDF Form" href="<?php //echo base_url() . "Con_ComprehensiveReport/comprehensivePdf/" . $row->employee_id; ?>" target="_blank" ><i class="fa fa-lg fa-download"></i></a> </td>  -->
                                    <!-- <td> &nbsp;&nbsp; &nbsp;<a title="Download Report" href="<?php //echo base_url() . "Con_ComprehensiveReport/employeeDetails/" . $row->employee_id; ?>" target="_blank">Download</a> </td> -->
                                  <!--  <td> <a class="btn btn-info btn-xs" title="" href="<?php //echo base_url() . "Con_ComprehensiveReport/employeeDetails/" . $row->employee_id; ?>" target="_blank"></i> Employee Info.</a></td> -->
                                    <!--  <td><?php //if ($w4date) echo date("m-d-Y", strtotime($w4date)) ?></td>
                                    <td><?php //if ($i9date) echo date("m-d-Y", strtotime($i9date)) ?></td> -->
                                    <?php
                                    print"</tr>";
                                }
                            }
                            ?> 
                            </tbody>
                        </table>
                    </div>
                <!-- </div> -->
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<style type="text/css">
    .btn-info{background:#72c02c !important}
    .scroll-wrap{overflow-x:scroll !important}
    .no-wrap{
        min-width:300px;
        white-space:normal !important;
    }
    /*#dataTables-example td{white-space:normal !important}*/
</style>


<script type="text/javascript">
    
    $("#location_id").select2({
        placeholder: "Select location",
        allowClear: true
    });
    $("#employee_id").select2({
        placeholder: "Select employee",
        allowClear: true
    });
    $("#isactive").select2({
        placeholder: "Select Status",
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

