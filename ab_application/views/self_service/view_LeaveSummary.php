
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_LeaveSummary/status_filter" enctype="multipart/form-data" role="form" >
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Status</h4></label>
                            <select name="leave_status" id="leave_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>                           
                                <?php
                                $app_status = $this->Common_model->get_array('approver_status');
                                foreach ($app_status as $key => $val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Employee</h4></label>
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>                           
                                <?php
                                
                                foreach ($amployee->result() as $row):
                                    ?>
                                    <option value="<?php echo $row->employee_id ?>"><?php echo $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'last_name'); ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>From Date</h4></label>
                            <input type="text" name="from_date" id="from_date" class="form-control dt_pick input-sm" placeholder="Started On" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>To Date</h4></label>
                            <input type="text" name="to_date" id="to_date" class="form-control dt_pick input-sm" placeholder="Started On" data-toggle="tooltip" data-placement="bottom" title="To Date" autocomplete="off">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Search</button>
                    </div>
                </form>
                <table id="dataTables-example-leaveSummary" class="table table-striped table-bordered dt-responsive table-hover nowrap" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>Leave Type</th>
                            <th>Applied Date</th>
                            <th>Available Leaves ( hour)</th>
                            <th>Applied Hour</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="sum_table" >

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

<script type="text/javascript">

    var table;

    $(document).ready(function () {
        var leaveId = "";
        $.ajax({
            url: "<?php echo site_url('con_LeaveSummary/total_status/') ?>/" + leaveId,
            async: false,
            type: "POST",
            success: function (data) {
                // $('#sum_table').find('tr').remove();
                $('#sum_table').html(data);
            }
        })
    });

    $(function () {
        $("#sky-form11").submit(function (event) {

            var leave_status = $("#leave_status").val();
            var employee_id = $("#employee_id").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            if (leave_status || employee_id || from_date || to_date) {
                var url = $(this).attr('action');
                //loading_box(base_url);
                $.ajax({
                    url: url,
                    data: $("#sky-form11").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {
//                alert(data);return;
                    $('#sum_table').html(data);

                });
            } else {
                alert('Please Select At Least One Field');
            }
            event.preventDefault();
        });
    });

    $("#leave_status").select2({
        placeholder: "Status",
        allowClear: true,
    });
    $("#employee_id").select2({
        placeholder: "Employee",
        allowClear: true,
    });
</script>