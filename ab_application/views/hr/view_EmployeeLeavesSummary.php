
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <div class="table-responsive col-md-12 col-centered">
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="1%">
                        <col width="25%">
                        <col width="20%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Apply Date</th>
                            <th>Leave Type</th>
                            <th>Applied Hour</th>                                
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');
                                $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','position');
                                $emp_position=$this->Common_model->get_name($this, $employee_position, 'main_jobtitles', 'job_title');
                                
                                print"<tr>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $emp_position . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->createddate . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->applied_hour . "</td>";
                                print"<td><div>"
                                        . "<a title='Preview' href='" . base_url() . "Con_EmployeeLeavesSummary/view_leave_request/" . $row->id . "/' ><i class='fa fa-eye'></i></a>&nbsp; &nbsp;"
                                        . "<a title='Download Form' href='" . base_url() . "Con_EmployeeLeavesSummary/download_leave_request/" . $row->id . "/'><i class='fa fa-download'></i></a>&nbsp; &nbsp;"
                                        . "<a title='Reject' href='javascript:;' onclick='reject_leave(" . $row->id . ")'><i class='fa fa-close'></i></a> </div> </td>";
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

    $("#leave_status").select2({
        placeholder: "Status",
        allowClear: true,
    });

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $('#sky-form11')[0].reset();

                var url = '<?php echo base_url() ?>con_EmployeeLeavesSummary';
                view_message(data, url);

            });
            event.preventDefault();
        });
    });

    var url = "<?php echo base_url(); ?>";
    function reject_leave(id) {
        var r = confirm("Do you want to Reject this?");
        if (r == true)
            window.location = url + "Con_EmployeeLeavesSummary/reject_leave/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->

