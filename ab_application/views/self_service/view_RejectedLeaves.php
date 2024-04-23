
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3 content-div" style="padding-bottom: 15px; padding-top: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered no-border">
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap">
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="13%">
                        <col width="12%">
                        <col width="20%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <!-- <th>Number Of Days</th> -->
                            <th>Applied Hour(s)</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $leave_status = $this->Common_model->get_array('approver_status');
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name . "</td>"; //$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')
                                // print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_employeeleavetypes', 'leavetype') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_selected_value($this, "leave_code", $row->leave_type, 'main_employeeleavetypes', 'leave_short_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                                /* print"<td id='catB" . $pdt . "'>" . $row->number_of_days . "</td>"; */
                                print"<td id='catB" . $pdt . "'>" . $row->applied_hour . "</td>";
                                print"<td id='catB" . $pdt . "'>" . ucwords($row->reason) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $leave_status[$row->leave_status] . "</td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>
</div><!--/row-->
</div><!--/container-->
<!--=== End Content ===-->

