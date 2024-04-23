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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_IncidentReporting/search_IncidentReporting/'; ?>" method="post">
                    <div class="row">
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Incident Type</label>
                                <div class="col-sm-8">
                                    <select name="incident_type" id="incident_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $tncident_type_array = $this->db->get_where('main_incidenttype', array('company_id' => $this->company_id));
                                        foreach ($tncident_type_array->result() as $key):
                                            $slct = ($search_criteria['incident_type'] == $key->id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key->id ?>" <?php echo $slct; ?>><?php echo $key->incident_type ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">From date </label>
                                <div class="col-sm-8">
                                    <input type="text" autocomplete="off" name="from_date" value="<?php echo $search_criteria['from_date'] ?>"  class="form-control dt_pick ">
                                </div>
                            </div>
                        </div>                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">To date </label>
                                <div class="col-sm-8">
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
                                            <option value="<?php echo $key->id ?>" <?php echo $slct; ?>><?php echo $key->first_name.' '.$key->last_name ?></option>
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
                </form>
                
                <div class="overflow-x" style="overflow-y: scroll; margin-bottom: 12px; max-height: 500px;">
                    <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Employee Incident Reporting </h4> </div>
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
                            <th>Incident Type</th>
                            <th>Incident Title</th>
                            <th>Incident Category</th>
                            <th>Action Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $incident_category_array = $this->Common_model->get_array('incident_category');
                        $status_array = $this->Common_model->get_array('status');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                    
                                $sl++; $pdt = $row->employee_id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                ?>
                                <td><?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style='color:" . (($row->isactive == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->isactive] . "</span>" ?></td>
                                <td><?php echo $row->salutation . " " . $row->first_name . ", " . $row->last_name; ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->tncident_type, 'main_incidenttype', 'incident_type') ?></td>
                                <td><?php echo $row->report_description;?></td>
                                <td><?php echo $row->incident_category ? $incident_category_array[$row->incident_category] : ""; ?></td>
                                <td><?php echo $this->Common_model->show_date_formate($row->action_date);?></td>
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
    
    $("#incident_type").select2({
        placeholder: "Incident Type",
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

