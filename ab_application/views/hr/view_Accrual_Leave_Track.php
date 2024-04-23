
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <?php if($leave_track_by==0){ ?>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Accrual_Leave_Track/add_Leave_Track" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Pay Schedule</th>
                            <th>Leave Type</th>
                            <th>From </th>
                            <th>TO </th>
                            <th>Working Hours</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $i=0;
                            foreach ($query->result() as $row) {
                                
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');

                                $i++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->pay_schedule, 'main_payfrequency_type', 'freqcode') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->pay_period_from) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->pay_period_to) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->working_hours . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_Accrual_Leave_Track/edit_entry/" . $row->id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
        <?php } else { ?>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Accrual_Leave_Track/add_Leave_Track" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Pay Schedule</th>
                            <th>From </th>
                            <th>TO </th>
                            <th>Allocated Hour Limit</th>
                            <th>Working Hours</th>
                            <th>Hourly Allowance</th>
                            <th>Available Hour</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $i=0;
                            foreach ($query->result() as $row) {
                                
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');

                                $i++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->pay_schedule, 'main_payfrequency_type', 'freqcode') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->pay_period_from) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->pay_period_to) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->hour_limit . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->working_hours . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->hourly_allowance . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->available_hour . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_Accrual_Leave_Track/edit_entry/" . $row->id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
        <?php } ?>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    //var url="<?php // echo base_url();?>";
    function delete_data(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = base_url+"Con_Accrual_Leave_Track/delete_entry/"+id;
        else
          return false;
        } 

</script>
<!--=== End Content ===-->

