<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Pto_Request/save_ptoLeaveRequest" enctype="multipart/form-data" role="form" >
        <div class="container tag-box tag-box-v3 content-div">
            <!--<form id="fghfghfgh" name="sky-form11"  class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form" >-->

                <div class="container tag-box" style="margin-bottom: 20px;"><h2>Employee Information:</h2></div>
                <div class="col-md-12">
                    <?php // if ($this->user_group != 10) { ?>
                        <!-- <div class="form-group">
                            <label class="col-sm-4 control-label">Select Employee Name<span class="req"/> :</label>
                            <div class="col-sm-3">
                                <select name="employee_id" id="employee_id" onchange="emp_info(this.value)" class="col-sm-12 myselect2">
                                    <option></option> -->
                                    <?php
                                    // foreach ($employe->result() as $key):
                                        ?>
                                        <!-- <option value="<?php // echo $key->employee_id ?>"><?php // echo $key->first_name . ' ' . $key->last_name ?></option> -->
                                    <?php // endforeach; ?>
                                <!-- </select>
                            </div>
                        </div> -->
                    <?php // } ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Employee Name :</label>
                        <div class="col-sm-3">
                            <?php
                            $EMP_ID = $EMP_NAME = '';
                            // if ($this->user_group == 10) {
                                //$key = $employe->row();
                                if ($employee) {
                                    $EMP_ID = $employee->id;
                                    $EMP_NAME = $employee->first_name . ' ' . $employee->last_name;
                                }
                            // }
                            echo '<input type="hidden" id="single_employee_id" name="single_employee_id" value="' . $EMP_ID . '" />';
                            echo '<input type="text" id="emp_name" class="form-control" readonly disabled value="' . $EMP_NAME . '" />';
                            ?>
                            <input type="hidden" name="employee_id" value="<?php echo $EMP_ID; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Position :</label>
                        <div class="col-sm-3">
                            <?php
                            $EMP_POSITION = '';
                            // if ($this->user_group == 10) {
                                $EMP_POSITION = "";
                                if ($employee) {
                                    $EMP_POSITION =  $EMP_POSITION =  $this->Common_model->get_name($this, $employee->position, 'main_jobtitles', 'job_title'); //$employee->first_address . ' ' . $this->user_id;
                                }
                            // }
                            echo '<input type="text" id="emp_position" class="form-control" readonly disabled value="' . $EMP_POSITION . '" />';
                            ?>

                            <input type="hidden" name="available_leaves" id="empp_id"value="<?php
                            if ($this->user_group == 10) {
                                echo $this->Common_model->get_selected_value($this, 'createdby', $this->user_id, 'main_employees', 'employee_id');
                            }
                            ?>" class="form-control" placeholder="Available Leaves" readonly />
                        </div>   
                    </div>
                </div>
            <!--</form>-->
        </div>

        <!-- end container well div -->
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->

            <div class="container tag-box" style="margin-bottom: 20px"><h2>Employee PTO Information:</h2></div>
            <div class="table-responsive col-md-12 col-centered no-border">
                <table id="mytable" class="table table-striped table-bordered table-hover table-wrap responsive-table">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Leave Type</th>
                            <th>Allocated Hour Limit</th>
                            <th>Openning Earned PTO</th>
                            <th>Current Year PTO</th>
                            <th>Earned PTO Hour</th>
                            <th>Maximum Available Hour</th>
                            <th> Used Hour </th>
                            <th> Balance </th>
                        </tr>
                    </thead>
                    <tbody id="pto_req_rep">
                        <!-- AJAX Table goes Here ... -->
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            
                <div class="container tag-box" style="margin-bottom: 20px"><h2>Employee PTO Request:</h2></div>
                <!--<input type="hidden" name="employee_id" value="<?php // echo $employe->row('employee_id'); ?>" />-->
                <!--<input type="hidden" name="company_id" value="<?php // echo $employe->row('company_id'); ?>" />-->
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">Leave Type<span class="req"></label>
                        <div class="col-sm-8">
                            <select name="leave_type" id="leave_type" class="col-sm-12 myselect2 input-sm" style="width: 100%">
                                <option></option>
                                <?php
                                /* foreach ($leave_type_query->result() as $key):
                                    $leave_code=$this->Common_model->get_name($this, $key->paid_leave_type, 'main_leave_types', 'leave_code');
                                    ?>
                                    <option value="<?php echo $key->paid_leave_type ?>"><?php echo $leave_code ?></option>
                                <?php endforeach; */ ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">Available Balance<span class="req"></label>
                        <div class="col-sm-8">
                            <input type="text" name="available_balance" id="available_balance" class="form-control" placeholder="Available Balance" readonly />
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">From Date<span class="req"></label>
                        <div class="col-sm-8">
                            <input type="text" name="from_date" id="from_date" class="form-control dt_pick input-sm" placeholder="From Date " autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">To Date<span class="req"></span></label>
                        <div class="col-sm-8">
                            <input type="text" name="to_date" id="to_date" class="form-control dt_pick input-sm" placeholder="To Date " autocomplete="off" />
                        </div>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">Applied Hour<span class="req"></label>
                        <div class="col-sm-8">
                            <input type="text" name="applied_hours" id="applied_hours" class="form-control" placeholder="Applied Hour" onkeypress="return numbersonly(this, event)" onkeyup="allow_maximum(this.value)" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">Description<span class="req"></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Apply</button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Pto_Request" ?>">Close</a>
                </div>
        </div>
        
        </form>


    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript">

    $(document).ready(function () {

        var User_Group = <?php echo $this->user_group; ?>;

        if (User_Group == 10) {
            var EMP_ID = $('#single_employee_id').val();
            get_pto_leave_info(EMP_ID);
        }

        $(document).on('change', '#leave_type', function () {
            var Leave_ID = $(this).val();

            if ((Leave_ID != '') && (Leave_ID != 0)) {
                var LeaveBalance = parseFloat($('span.paid_leave_type_' + Leave_ID).text());
                $("#available_balance").val(LeaveBalance);
            } else {
                $("#available_balance").val('');
            }
        });
    });

    function get_pto_leave_info(EMP_ID) {
        $.ajax({
            url: "<?php echo site_url('Con_Pto_Request/get_pto_leave_info/') ?>/" + EMP_ID,
            type: "POST"
        }).done(function (data) {
            //alert (data);
            $('#pto_req_rep').html(data);
        });
        
        $.ajax({
            url: "<?php echo site_url('Con_Pto_Request/load_Leave_Type/') ?>/" + EMP_ID,
            async: false,
            type: "POST",
            success: function (data) {
                $('#leave_type').html('');
                $('#leave_type').empty();

                $('#leave_type').html(data);
            }
        });
    }

    function allow_maximum(VALUE) {
        var Allowed_Hour = parseFloat(VALUE);
        var MAX_LIMIT = parseFloat($("#available_balance").val());

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
            var datas = data.split('_');

            $('#emp_name').val('');
            $('#emp_position').val('');
            $('#single_employee_id').val('');

            if (datas[0])
            {
                $('#emp_name').val(datas[0]);
            }

            if (datas[1])
            {
                $('#emp_position').val(datas[1]);
            }

            if (datas[2])
            {
                $('#single_employee_id').val(datas[2]);
                get_pto_leave_info(datas[2]);
            }

        });

        $('#employee').val(id);

        $.ajax({
           url: "<?php // echo site_url('Con_Pto_Request/get_employee_leave_info/') ?>/" + id,
           type: "POST"
       }).done(function (data) {
           $('#pto_req_rep').html(data);
       });
    }

    $(function () {
        $("#sky-form11").submit(function (event) {
            $('select').removeAttr('disabled');
            var url = $(this).attr('action');
            loading_box(base_url);
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Pto_Request';
                view_message(data, url, '', '#sky-form11');

            });
            event.preventDefault();
        });
    });

    function calculate_date()
    {
        var from_datea = $('#from_date').val();
        var dates = from_datea.split('-');
        var date1 = new Date(dates[2] + '-' + dates[0] + '-' + dates[1]);
        //var date1 = new Date(from_datea);

        var to_datea = $('#to_date').val();
        var datess = to_datea.split('-');
        var date2 = new Date(datess[2] + '-' + datess[0] + '-' + datess[1]);
        //var date2 = new Date(to_datea);

        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay));
        //alert(diffDays);
        if (diffDays)
        {
            $('#number_of_days').val(diffDays);
        }
    }

    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    $("#employee_id").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Pto_Request/delete_entry/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->
