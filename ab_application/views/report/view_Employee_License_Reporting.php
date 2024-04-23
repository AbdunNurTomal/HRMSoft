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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Employee_License_Reporting/search_Employee_License_Reporting/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Issued From: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_from']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Issued To: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_to']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Expiration From: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="expiration_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['expiration_from']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Expiration To: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="expiration_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['expiration_to']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                <label class="col-sm-4 control-label">Employee </label>
                                <div class="col-sm-8">
                                    <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($employees_query->result() as $key):
                                            $slct = ($search_criteria['employee_id'] == $key->employee_id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key->employee_id ?>" <?php echo $slct; ?>><?php echo $key->first_name.' '.$key->last_name ?></option>
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
                                <div style="text-align: center; "> <h4> Employee License Informaiton Reporting </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Number</th>
                            <th>Full Name</th>
                            <th>Posiiton</th>
                            <th>Location</th>
                            <th>Department</th>
                            <th>License Type</th>
                            <th>State Issued</th>
                            <th>State Name</th>
                            <th>Issue Date</th>
                            <th>Expiration Date</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $yes_no_array = $this->Common_model->get_array('yes_no');
                        if ($search_data) {
                            $sl=0;
                            $img_license="";
                            foreach ($search_data as $row) {
                                if ($row->license_image == "") {
                                    $img_license = base_url() . "uploads/blank_license.jpg";
                                } else {
                                    $img_license = base_url() . "uploads/emp_license/" . $row->license_image;
                                }
                               
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                ?>
                                <td><?php echo sprintf("%07d", $row->employee_id) ?></td>
                                <td><?php echo $row->salutation . " " . $row->first_name . ", " . $row->last_name; ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></td>
                                <td><?php echo $row->license_type ?></td>
                                <td><?php echo $yes_no_array[$row->state_issued] ?></td>
                                <td><?php echo $row->state_name ?></td>
                                <td><?php if($row->issued_date) echo date("m-d-Y", strtotime($row->issued_date)) ?></td>
                                <td><?php if($row->expiration_date) echo date("m-d-Y", strtotime($row->expiration_date)) ?></td>
                                <td> <img class="" src="<?php echo $img_license; ?>" alt="No Image" height="50" width="70"></td>
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
    
    
    $("#department_id").select2({
        placeholder: "Select department",
        allowClear: true
    });
    $("#employee_id").select2({
        placeholder: "Select employee",
        allowClear: true
    });
    
    function printDiv() {
        $.print("#print_to_Div");
    }
    
</script>
<!--=== End Content ===-->

