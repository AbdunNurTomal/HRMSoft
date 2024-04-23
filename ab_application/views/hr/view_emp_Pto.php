
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; "> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-u">
                        <div class="panel-heading">
                            Employee Information
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th> Employee Name: </th>
                                            <td>
                                                <?php
                                                $key = $query->row();
                                                $emp_id = $key->employee_id;
                                                echo $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'last_name');
                                                ?> 
                                            </td>
                                             <th>Position : </th>
                                            <td>
                                                <?php
                                                $position_id = $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'position');
                                                echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>State : </th>
                                            <td>
                                                <?php
                                                    $state_id = $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'state');
                                                    echo $this->Common_model->get_name($this, $state_id, 'main_state', 'state_abbr');
                                                ?>
                                            </td>
                                            <th>County : </th>
                                            <td>
                                                <?php
                                                    $county_id = $this->Common_model->get_name($this,$key->employee_id,'main_employees','county');
                                                    echo $this->Common_model->get_name($this, $county_id,'main_county','county_name');
                                                ?>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
        <!-- end container well div -->
        <div class="container tag-box tag-box-v3" style="margin-top: 0px;"> <!-- container well div -->
            <div class="container tag-box"><h2>Employee PTO Information:</h2></div>
            <div class="table-responsive col-md-12 col-centered">
                <table id="mytable" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Leave Type</th>
                            <th>Allocated Hour Limit</th>
                            <th>Earned Hour</th>
                            <th>Maximum Available Hour</th>
                            <th>Used Hour</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="leave_req_rep">
                        <?php echo $this->Common_model->employee_pto_info($emp_id); ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; "> <!-- container well div -->

            <div class="container tag-box"><h2>Employee PTO Request Information:</h2></div>
            <div id="leave_div" class="table-responsive col-md-12 col-centered">
                <table id="mytable" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL. No.</th>
                            <th>Leave Type</th>
                            <th>Applied Hour(s)</th>
                            <th>Approve Hour(s)</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="leave_req_rep">
                        <?php
                        if ($query) {
                            $sr = 0;
                            foreach ($query->result() as $row) {
                                $sr++;
                                ?>
                                <tr>
                                    <td><?php echo $sr ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') ?></td>
                                    <td><?php echo $row->applied_hours; ?></td>
                                    <td><?php echo $row->approved_hours; ?></td>
                                    <td><?php echo $row->description ?></td>
                                    <td>
                                        <a href="javascript:;" onclick="edit_pto_req(<?php echo $row->id; ?>)" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                        <a href="javascript:;" onclick="approve_pto(<?php echo $row->id; ?>)" title="Approve" ><i class="fa fa-check"></i></a>&nbsp;
                                        <a href="javascript:;" onclick="reject_pto(<?php echo $row->id; ?>)" title="Decline"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!--<div class="modal-footer">                        
                    <button href="#" onclick="approve_pto(<?php echo $row->id; ?>)" class="btn btn-u">Approve</button>
                    <a class="btn btn-danger" href="#" onclick="reject_pto(<?php echo $row->id; ?>)">Reject</a>
                </div>-->
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>
<div class="modal fade" id="edit_leave_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Location</h4>
            </div>
            <form id="pto_req_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="EMP_ID" id="EMP_ID"/>
                <input type="hidden" value="" name="pto_req_id" id="pto_req_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Type</label>
                        <div class="col-sm-4">
                            <select name="leave_type" id="leave_type" onchange="value_receive(this.value)" class="col-sm-12 myselect2 input-sm" disabled="" >
                                <option></option>
                                <?php

                                foreach ($leave_type_query->result() as $key):
                                    $leave_code=$this->Common_model->get_name($this, $key->paid_leave_type, 'main_leave_types', 'leave_code');
                                    ?>
                                    <option value="<?php echo $key->paid_leave_type ?>"><?php echo $leave_code ." - " . $this->Common_model->get_name($this, $key->state,'main_state','state_abbr') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <label class="col-sm-2 control-label">Available Hour(s)</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="available_hours" id="available_hours" class="form-control" placeholder="Available Hour(s)" readonly />
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Applied Hour(s)<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <input type="text" name="applied_hours" id="applied_hours" class="form-control" placeholder="Applied Hour(s)" onkeypress="return numbersonly(this, event)" onkeyup="allow_maximum(this.value)" />
                        </div>
                    </div>
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $(document).ready(function () {

    });

    function allow_maximum(VALUE) {
        var Allowed_Hour = parseFloat(VALUE);
        var MAX_LIMIT = parseFloat($("#available_hours").val());

        if (Allowed_Hour > MAX_LIMIT) {
            $("#applied_hours").val(MAX_LIMIT);
        }
    }

    function emp_info(id)
    {
        $.ajax({
            url: "<?php echo site_url('Con_LeaveRequest/get_employee_name/') ?>/" + id,
            type: "POST"
        }).done(function (data) {
            $('#xyz').html(data);
        });


        $('#employee').val(id);
        $.ajax({
            url: "<?php echo site_url('Con_LeaveRequest/get_employee_info/') ?>/" + id,
            type: "POST"
        }).done(function (data) {
            $('#leave_req_rep').html(data);
        });
    }

    $(function () {
        $("#sky-form11").submit(function (event) {
            $('select').removeAttr('disabled');
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

//                $('#sky-form11')[0].reset();

                var url = '<?php echo base_url() ?>con_LeaveRequest';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    function value_receive(id)
    {
        var emp_id = $('#employee').val();
        var data = id + '_' + emp_id;
        $.ajax({
            url: "<?php echo site_url('con_LeaveRequest/get_leave_information/') ?>/" + data,
            type: "POST"

        }).done(function (data) {
//            alert(data);
            $('#available_leaves').val(data);
        });
    }

    function edit_pto_req(id) {
        $('#pto_req_form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Manage_Pto/ajax_edit_pto/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="EMP_ID"]').val(data.employee_id);
                $('[name="pto_req_id"]').val(data.id);
                $('[name="available_hours"]').val(data.available_balance);
                $('[name="applied_hours"]').val(data.applied_hours);
                $('[name="leave_type"]').select2().select2('val', data.leave_type);
                $('[name="description"]').val(data.description);

                $('#edit_leave_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit PTO Request'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    $(function () {
        $("#pto_req_form").submit(function (event) {

            var url = "<?php echo site_url('Con_Manage_Pto/update_emp_pto') ?>";

            $.ajax({
                url: url,
                data: $("#pto_req_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#leave_div").load(location.href + " #leave_div");
                
                reload_table('mytable');
                
                var url = '';
                view_message(data, url, 'edit_leave_Modal', 'pto_req_form');
            });
            event.preventDefault();
        });
    });


    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    $("#s_employee").select2({
        placeholder: "Employee",
        allowClear: true,
    });

    var url = "<?php echo base_url(); ?>";

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "con_LeaveRequest/delete_entry/" + id;
        else
            return false;
    }

    var url = "<?php echo base_url(); ?>";

    function reject_pto(id) {
        var r = confirm("Do you want to Reject this?");
        if (r == true)
            window.location = url + "Con_EmployeeLeavesSummary/reject_leave/" + id;
        else
            return false;
    }
    var url = "<?php echo base_url(); ?>";

    function approve_pto(id) {

        var r = confirm("Do you want to Approve this?");
        if (r == true)
            $.ajax({
                url: "<?php echo site_url('Con_Manage_Pto/approve_pto/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    var url = '<?php echo base_url() ?>Con_Manage_Pto';
                    view_message(data, url);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        else
            return false;
    }

</script>
<!--=== End Content ===-->

