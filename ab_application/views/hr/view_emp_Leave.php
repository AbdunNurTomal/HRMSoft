
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 0px;"> 
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
                                                foreach ($query->result() as $key) {
                                                    echo $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'last_name');
                                                }
                                                ?> 
                                            </td>
                                             <th>Position : </th>
                                            <td>
                                                <?php
                                                foreach ($query->result() as $key) {
                                                    $position_id = $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'position');
                                                    echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>State : </th>
                                            <td>
                                                <?php
                                                foreach ($query->result() as $key) {
                                                    $state_id = $this->Common_model->get_name($this, $key->employee_id, 'main_employees', 'state');
                                                    echo $this->Common_model->get_name($this, $state_id, 'main_state', 'state_abbr');
                                                }
                                                ?>
                                            </td>
                                            <th>County : </th>
                                            <td>
                                                <?php
                                                foreach ($query->result() as $key) {
                                                    $county_id = $this->Common_model->get_name($this,$key->employee_id,'main_employees','county');
                                                    echo $this->Common_model->get_name($this, $county_id,'main_county','county_name');
                                                }
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
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <div class="container tag-box"><h2>Employee Leave Information:</h2></div>
            <div class="table-responsive col-md-12 col-centered">
                <table id="mytable" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Leave Type</th>
                            <th>Max Limit</th>
                            <th>Used(hour) </th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="leave_req_rep">
                        <?php
                        $lbalence = "";
                        $sr = 0;
                        foreach ($policy->result() as $row) {
                            foreach ($query->result() as $row1) {
                                $sr++;
                                $sql = "SELECT `leave_type`,sum(`number_of_days`) as ldays,sum(applied_hour) as app_hour  FROM `main_leave_transaction` WHERE `employee_id` = " . $row1->employee_id . " and leave_type= " . $row->leave_type . "   group by `leave_type`";
                                $tquery = $this->db->query($sql);
                            }
                            $EnjoyLeave = 0;
                            if ($tquery) {
                                if ($tquery->num_rows() > 0) {
                                    foreach ($tquery->result() as $trow) {
                                        $EnjoyLeave = $trow->app_hour;
                                    }
                                }
                            }
                            $lbalence = ($row->max_limit - $EnjoyLeave);
                            ?>
                            <tr>
                                <td><?php echo $sr ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code')." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') ?></td>
                                <td><?php echo $row->max_limit ?></td>
                                <td><?php echo $EnjoyLeave ?></td>
                                <td><?php echo $lbalence ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->

            <div class="container tag-box"><h2>Employee Leave Request Information:</h2></div>
            <div id="leave_div" class="table-responsive col-md-12 col-centered">
                <table id="mytable" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Leave Type</th>
                            <th>Available Leaves</th>
                            <th>Applied Hour</th>
<!--                            <th>Start Date</th>
                            <th>End date</th>
                            <th>Duration</th>-->
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="leave_req_rep">
                        <?php
                        $sr = 0;
                        foreach ($query->result() as $row) {
                            $sr++;
                            ?>
                            <tr>
                                <td><?php echo $sr ?></td>
                                <td><?php echo $this->Common_model->get_name($this, $row->leave_type, 'main_leave_types', 'leave_code') ?></td>
                                <td><?php echo $row->available_leaves ?></td>
                                <td><?php echo $row->applied_hour ?></td>
<!--                                <td><?php // echo $this->Common_model->show_date_formate($row->from_date) ?></td>
                                <td><?php // echo $this->Common_model->show_date_formate($row->to_date) ?></td>
                                <td><?php // echo $row->number_of_days ?></td>-->
                                <td><?php echo $row->reason ?></td>
                                <td><div> &nbsp; <a href="javascript:;" onclick="edit_leave_req(<?php echo $row->id; ?>)" ><i class='fa fa-pencil-square-o'>&nbsp;</i></a></div></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">                        
                        <button href="#" onclick="approve_leave(<?php echo $row->id; ?>)" class="btn btn-u">Approve</button>
                        <a class="btn btn-danger" href="#" onclick="reject_leave(<?php echo $row->id; ?>)">Reject</a>
                    </div>
                <?php } ?>
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
            <form id="leave_req_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="employee" id="employee"/>
                <input type="hidden" value="" name="leave_req_id" id="leave_req_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Type</label>
                        <div class="col-sm-4">
                            <select name="leave_type" id="leave_type" onchange="value_receive(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                if ($this->user_type == 2) {
                                    $leave_type_query = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 1));
                                } else {
                                    $leave_type_query = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 1));
                                }
                                foreach ($policy->result() as $key):
                                    $leave_code=$this->Common_model->get_name($this, $key->leave_code, 'main_leave_types', 'leave_code');
                                    ?>
                                    <option value="<?php echo $key->leave_code ?>"><?php echo $leave_code ." - " . $this->Common_model->get_name($this, $key->state, 'main_state', 'state_abbr') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <label class="col-sm-2 control-label">Available Leaves </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="available_leaves" id="available_leaves"  class="form-control" placeholder="Available Leaves" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Applied Hour <span class="req"/></label>
                        <div class="col-sm-4">                            
                            <input type="text" name="applied_hour" id="applied_hour" class="form-control input-sm "  placeholder="Applied Hour"  />
                        </div>
                        <label class="col-sm-2 control-label">Reason<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="reason" name="reason"></textarea>
                        </div>
                    </div> 
                    
                    <div class="form-group">

<!--                        <label class="col-sm-2 control-label">From Date<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <input type="text" name="from_date" id="from_date" class="form-control dt_pick" onchange="calculate_date()" placeholder="From Date" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label">To Date<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <input type="text" name="to_date" id="to_date" class="form-control dt_pick" onchange="calculate_date()" placeholder="To Date" autocomplete="off" />
                        </div>-->
                    </div>
                    <div class="form-group">
<!--                        <label class="col-sm-2 control-label">Number of Days</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="number_of_days" id="number_of_days" class="form-control" placeholder="Number of Days" readonly />
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div> -->
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
        
        /* var zzz = $('#empp_id').val();
        $.ajax({
            url: "<?php /*echo site_url('Con_LeaveRequest/get_employee_info/')*/ ?>/" + zzz,
            type: "POST"
        }).done(function (data) {
            alert("====>> "+data);
            $('#leave_req_rep').html(data);
        }); */
    });

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
                view_message(data, url,'','sky-form11');

            });
            event.preventDefault();
        });
    });

    function calculate_date()
    {
       // alert ('dddd');
        var from_datea = $('#from_date').val();
        var dates = from_datea.split('-');
        var date1 = new Date(dates[2] + '-' + dates[0] + '-' + dates[1]);
        //var date1 = new Date(from_datea);

        var to_datea = $('#to_date').val();
        var datess = to_datea.split('-');
        var date2 = new Date(datess[2] + '-' + datess[0] + '-' + datess[1]);
        //var date2 = new Date(to_datea);
        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay))+1;
        //alert(diffDays);
        if (diffDays)
        {
            $('#number_of_days').val(diffDays);
        }
    }

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

    function edit_leave_req(id) {
        $('#leave_req_form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_EmployeeLeavesSummary/ajax_edit_leave/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="leave_req_id"]').val(data.id);
                $('[name="employee"]').val(data.employee_id);
                $('[name="leave_type"]').select2().select2('val', data.leave_type);
                $('[name="available_leaves"]').val(data.available_leaves);
                $('[name="applied_hour"]').val(data.applied_hour);
                //$('[name="from_date"]').val(show_date_formate_js(data.from_date));
                //$('[name="to_date"]').val(show_date_formate_js(data.to_date));
                //$('[name="number_of_days"]').val(data.number_of_days);
                //$('[name="description"]').val(data.description);
                $('[name="reason"]').val(data.reason);

                $('#edit_leave_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Leave Request'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    $(function () {
        $("#leave_req_form").submit(function (event) {

            url = "<?php echo site_url('Con_EmployeeLeavesSummary/update_emp_leave') ?>";

            $.ajax({
                url: url,
                data: $("#leave_req_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                $('#leave_req_form')[0].reset();
                $("#leave_div").load(location.href + " #leave_div");
                reload_table('mytable');
                var url = '';
                view_message(data, url, 'edit_leave_Modal','leave_req_form');
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
    function reject_leave(id) {
        var r = confirm("Do you want to Reject this?");
        if (r == true)
            window.location = url + "Con_EmployeeLeavesSummary/reject_leave/" + id;
        else
            return false;
    }
    var url = "<?php echo base_url(); ?>";
    function approve_leave(id) {

        var r = confirm("Do you want to Approve this?");
        if (r == true)
            $.ajax({
                url: "<?php echo site_url('Con_EmployeeLeavesSummary/approve_leave/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    var url = '<?php echo base_url() ?>Con_EmployeeLeavesSummary';
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

