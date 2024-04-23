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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Interview_Schedule_Reporting/search_Interview_Schedule_Reporting/'; ?>" method="post">
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
                                <label class="col-sm-4 control-label">Requisition  </label>
                                <div class="col-sm-8">
                                    <select name="requisition_id" id="requisition_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($opening_position_query->result() as $key) {
                                            $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                            $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                            $slct = ($search_criteria['requisition_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Interview Type </label>
                                <div class="col-sm-8">
                                    <select name="interview_type" id="interview_type" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($interview_type as $key=>$val) {
                                            $slct = ($search_criteria['interview_type'] == $key) ? 'selected' : '';
                                            echo '<option value="' . $key . '" ' . $slct . '>' . $val . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Interview Status  </label>
                                <div class="col-sm-8">
                                    <select name="interview_status" id="interview_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($interview_status as $key=>$val):
                                            $slct = ($search_criteria['interview_status'] == $key) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key ?>" <?php echo $slct ?>><?php echo $val ?></option>
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
                <div class="overflow-x" style=" margin-bottom: 12px; max-height: 500px;">
                <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Interview Schedule Reporting </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Requisition ID</th>
                            <th>Posting</th>
                            <th>No of Posiiton</th>
                            <th>Hire Reason</th>
                            <th>Interviewer Name</th>
                            <th>Location</th>
                            <th>Time</th>
                            <th>Interview Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $wages_array = array(0 => '', 1 => 'Salary', 2 => 'Hourly');
                        $posting_array = array(0 => '', 1 => 'Internal', 2 => 'Internal & External');
                        $hire_reason_array = array(0 => '', 1 => 'New', 2 => 'Replacing');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                
                                $posting=$this->Common_model->get_name($this,$row->requisition_id, 'main_opening_position', 'posting');
                                $NoofPosiiton=$this->Common_model->get_name($this,$row->requisition_id, 'main_opening_position', 'no_of_positions');
                                $HireReason=$this->Common_model->get_name($this,$row->requisition_id, 'main_opening_position', 'hire_reason');
                                     
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id, 'main_opening_position', 'requisition_code') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $posting_array[$posting] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $NoofPosiiton ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $hire_reason_array[$HireReason] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->interviewer, 'main_employees', 'first_name') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->location ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->interview_time ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->interview_status] ."</td>";
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
    
    $("#requisition_id").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    
    $("#interview_type").select2({
        placeholder: "Select interview type",
        allowClear: true
    });
    $("#interview_status").select2({
        placeholder: "Select interview status",
        allowClear: true
    });
    
    function printDiv() {
        $.print("#print_to_Div");
    }
   
</script>
<!--=== End Content ===-->

