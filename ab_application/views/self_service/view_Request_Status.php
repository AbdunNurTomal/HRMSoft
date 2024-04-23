
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3 content-div">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered no-border">
                <div class="col-centered" style="text-align: center;"><h3><i>Leave Status</i></h3></div>
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Training_Feedback/add_Training_Feedback" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Training Feedback </a></br></br>-->
                <table id="dataTables-example-leave" class="table table-striped table-bordered table-hover responsive-table table-wrap">
                    <colgroup>
                        <col width="1%">
                        <col width="25%">
                        <col width="13%">
                        <col width="20%">
                        <col width="20%">
                        <col width="12%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>Apply Date</th>
                            <th>Leave Type</th>
                            <th>Number Of Days</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $leave_status = $this->Common_model->get_array('approver_status');
                        if ($query) {
                            $sl=0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                $pdt = $row->id;
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').",".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');

                                print"<tr>";
                                print"<td id='catB" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->createddate . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->number_of_days . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $leave_status[$row->leave_status] . "</td>";
                                print"<td><div><a title='Download Form' href='" . base_url() . "Con_EmployeeLeavesSummary/download_leave_request/" . $row->id . "/'><i class='fa fa-lg fa-download'></i></a>&nbsp;";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            
            <div class="table-responsive col-md-12 col-centered no-border">
                <div class="col-centered" style="text-align: center;"><h3><i>PTO Status</i></h3></div>
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Training_Feedback/add_Training_Feedback" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Training Feedback </a></br></br>-->
                <table id="dataTables-example-pto" class="table table-striped table-bordered table-hover responsive-table table-wrap" width="100%">
                <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>Apply Date</th>
                            <th>Leave Type</th>
                            <th>Applied Hours</th>
                            <th>Status</th>
                            <!--<th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $leave_status = $this->Common_model->get_array('approver_status');
                        if ($ptoquery) {
                            $sl=0;
                            foreach ($ptoquery->result() as $row) {
                                $sl++;
                                $pdt = $row->id;
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').",".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');

                                print"<tr>";
                                print"<td id='catB" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->createddate . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->applied_hours . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $leave_status[$row->status] . "</td>";
                                //print"<td><div><a title='Download Form' href='" . base_url() . "Con_EmployeeLeavesSummary/download_leave_request/" . $row->id . "/'><i class='fa fa-lg fa-download'></i></a>&nbsp;";
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


<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Training_Feedback/delete_Training_Feedback/" + id;
        else
            return false;
    }

    $(document).ready(function () {
        $('#dataTables-example-pto').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "bLengthChange": false,
            "bInfo" : false,
            "paginationType": "input"
        });
    });

     $(document).ready(function () {
        $('#dataTables-example-leave').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "bLengthChange": false,
            "bInfo" : false,
            "paginationType": "input"
        });
    });

</script>
<!--=== End Content ===-->
