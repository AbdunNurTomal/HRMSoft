<style>
    /* Style For alert box */
    #modalContainer {
        background-color:rgba(0, 0, 0, 0.3);
        position:absolute;
        width:100%;
        height:100%;
        top:0px;
        left:0px;
        z-index:10000;
        background-image:url(tp.png); /* required by MSIE to prevent actions on lower z-index elements */
    }

    #alertBox {
        position:relative;
        width:300px;
        min-height:100px;
        margin-top:50px;
        border:1px solid #666;
        background-color: #F5FCC8;
        background-repeat:no-repeat;
        background-position:20px 30px;
    }

    #modalContainer > #alertBox {
        position:fixed;
    }

    #alertBox h1 {
        margin:0;
        font:bold 0.9em verdana,arial;
        background-color: #008200;
        color:#FFF;
        border-bottom:1px solid #000;
        padding:4px 0 4px 5px;
    }

    #alertBox p {
        font:1.0em verdana,arial;
        height:60px;
        padding-left:5px;
        margin-left:55px;
    }

    #alertBox #closeBtn {
        display:block;
        position:relative;
        margin:5px auto;
        padding:7px;
        border:0 none;
        width:70px;
        font:0.9em verdana,arial;
        text-transform:uppercase;
        text-align:center;
        color:#FFF;
        background-color:#357EBD;
        border-radius: 3px;
        text-decoration:none;
    }

    /* unrelated styles */

    code {
        font-size:1.2em;
        color:#069;
    }

    #credits {
        position:relative;
        margin:25px auto 0px auto;
        width:350px; 
        font:0.7em verdana;
        border-top:1px solid #000;
        border-bottom:1px solid #000;
        height:90px;
        padding-top:4px;
    }

    #credits img {
        float:left;
        margin:5px 10px 5px 0px;
        border:1px solid #000000;
        width:80px;
        height:79px;
    }

    .important {
        background-color:#F5FCC8;
        padding:2px;
    }

    code span {
        color:green;
    }
</style>

<script>
    /* JS For alert box */
    var ALERT_TITLE = "--------------------- Alert !!! -------------------";
    var ALERT_BUTTON_TEXT = "Ok";

    if (document.getElementById) {
        window.alert = function (txt) {
            createCustomAlert(txt);
        }
    }

    function createCustomAlert(txt) {
        d = document;

        if (d.getElementById("modalContainer"))
            return;

        mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
        mObj.id = "modalContainer";
        mObj.style.height = d.documentElement.scrollHeight + "px";

        alertObj = mObj.appendChild(d.createElement("div"));
        alertObj.id = "alertBox";
        if (d.all && !window.opera)
            alertObj.style.top = document.documentElement.scrollTop + "px";
        alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth) / 2 + "px";
        alertObj.style.visiblity = "visible";

        h1 = alertObj.appendChild(d.createElement("h1"));
        h1.appendChild(d.createTextNode(ALERT_TITLE));

        msg = alertObj.appendChild(d.createElement("p"));
        //msg.appendChild(d.createTextNode(txt));
        msg.innerHTML = txt;

        btn = alertObj.appendChild(d.createElement("a"));
        btn.id = "closeBtn";
        btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
        btn.href = "#";
        btn.focus();
        btn.onclick = function () {
            removeCustomAlert();
            return false;
        }

        alertObj.style.display = "block";

    }

    function removeCustomAlert() {
        document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
    }
</script>


<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3 content-div" style="padding-left:15px; padding-top: 15px;">
            <form id="fghfghfgh" name="sky-form11"  class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form" >

                <div class="col-md-10 col-md-offset-1">
                    <div class="container tag-box" style="margin-bottom: 20px"><h2>Employee Information:</h2></div>
                        <?php // if ($this->user_group != 10) : ?>
                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">Select Employee Name<span class="req"/>:</label>
                                <div class="col-sm-4">
                                    <select name="s_employee" id="s_employee" onchange="emp_info(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm"> -->
                                        <!-- <option></option> -->
                                        <?php // foreach ($employe->result() as $key): ?>
                                            <!-- <option value="<?php // echo $key->employee_id ?>"><?php // echo $key->first_name . ' ' . $key->last_name ?></option> -->
                                        <?php // endforeach; ?>
                                    <!-- </select>
                                </div>
                            </div> -->
                        <?php // endif; ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Employee Name :</label>
                        <div class="col-sm-3">
                            <p id="emp_name" class="control-label pull-left">
                                <?php // if ($this->user_group == 10) :
                                   /* foreach ($employe->result() as $key) {
                                        echo $employe->first_name . ' ' . $employe->last_name;
                                   } */
                                ?>
                                    <?php // echo "<pre>". print_r($employee->id, 1) ."</pre>";exit; ?>
                                    <?php echo ($employee ? $employee->first_name . " " . $employee->middle_name . " " . $employee->last_name : "-"); ?>
                                    <input type="hidden" name="slu_emp_id" id="slu_emp_id" value="<?php echo $employee ? $employee->id : ""; ?>">
                                <?php // endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Position :</label>
                        <div class="col-sm-3">
                            <p id="emp_position" class="control-label pull-left" >
                                <?php // if ($this->user_group == 10) {
                                    /* foreach ($employe->result() as $key) {
                                        // echo $this->Common_model->get_name($this, $employe->position, 'main_positions', 'positionname');
                                        echo $this->Common_model->get_name($this, $employe->position, 'main_jobtitles', 'job_title');
                                    } */
                                    $employePosition = "-";
                                    if ($employee) {
                                        $employePosition = $this->Common_model->get_name($this, $employee->position, 'main_jobtitles', 'job_title');
                                    }
                                    echo $employePosition;
                                // } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- end container well div -->
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; "> <!-- container well div -->

            <div class="container tag-box" style="margin-bottom: 20px; padding-left:10px; padding-right:10px;"><h2>Employee Leave Information:</h2></div>
            <div class="table-responsive col-md-12 col-centered no-border">
                <table id="mytable" class="table table-striped table-bordered table-hover responsive-table table-wrap" width="100%">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Leave Type</th>
                            <th>Max Limit</th>
                            <th>Used (hour) </th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="leave_req_rep">

                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; padding-left:10px; padding-right:10px;"> <!-- container well div -->
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_LeaveRequest/save_LeaveRequest" enctype="multipart/form-data" role="form" >
                <div class="container tag-box" style="margin-bottom: 20px"><h2>Employee Leave Request:</h2></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Leave Type<span class="req"></span></label>
                    <div class="col-sm-4">
                        <select name="leave_type" id="leave_type" onchange="value_receive(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                                foreach ($leave_type_query->result() as $key):
                                    $leave_code=$this->Common_model->get_name($this, $key->leave_type, 'main_leave_types', 'leave_code');
                            ?>
                                <option value="<?php echo $key->leave_type ?>"><?php echo $leave_code." - " . $this->Common_model->get_name($this, $key->state, 'main_state', 'state_abbr') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> 
                    <label class="col-sm-2 control-label">Available Leaves </label>
                    <div class="col-sm-4">
                        <input type="text" name="available_leaves" id="available_leaves"  class="form-control input-sm" placeholder="Available Leaves" readonly />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">From Date<span class="req"></span></label>
                    <div class="col-sm-4">
                        <input type="text" name="from_date" id="from_date" class="form-control dt_pick input-sm" placeholder="From Date " autocomplete="off" />
                    </div>
                    <label class="col-sm-2 control-label">To Date<span class="req"></span></label>
                    <div class="col-sm-4">
                        <input type="text" name="to_date" id="to_date" class="form-control dt_pick input-sm" placeholder="To Date " autocomplete="off" />
                    </div>
                </div>

                <div class="form-group">
                   <label class="col-sm-2 control-label">Applied Hour <span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="text" name="applied_hour" id="applied_hour" class="form-control input-sm" placeholder="Applied Hour" autocomplete="off" />
                    </div>
                    <label class="col-sm-2 control-label">Reason <span class="req"/> </label>
                    <div class="col-sm-4">
                        <textarea class="form-control" rows="2" id="reason" name="reason"></textarea>
                    </div>
                   
                    <!--<label class="col-sm-2 control-label">From Date<span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="text" name="from_date" id="from_date" class="form-control dt_pick" onchange="calculate_date()" placeholder="From Date" autocomplete="off" />
                    </div>
                    <label class="col-sm-2 control-label">To Date<span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="text" name="to_date" id="to_date" class="form-control dt_pick" onchange="calculate_date()" placeholder="To Date" autocomplete="off" />
                    </div>-->
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-2 control-label">Number of Days</label>
                    <div class="col-sm-4">
                        <input type="text" name="number_of_days" id="number_of_days" class="form-control" placeholder="Number of Days" readonly />
                    </div>
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="hidden" name="employee" id="employee" value="<?php if ($this->user_group == 10) { echo $employee ? $employee->employee_id : ""; } ?>"  />
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u"> Apply </button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_LeaveRequest" ?>">Close</a>
                </div>
            </form>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $(document).ready(function () {
        var slu_emp_id = $('#slu_emp_id').val();
        // alert(slu_emp_id);
        $.ajax({
            url: "<?php echo site_url('Con_LeaveRequest/get_employee_leave_info/') ?>/" + slu_emp_id,
            type: "POST"
        }).done(function (data) {
            // alert(data);
            $('#leave_req_rep').html(data);
        });
    });

    function emp_info(id)
    {
        // alert(id); 
        $.ajax({
            url: "<?php echo site_url('Con_LeaveRequest/get_employee_name/') ?>/" + id,
            type: "POST"
        }).done(function (data) {
            var datas = data.split('_');
            //alert(data);

            $('#emp_name').html('');
            $('#emp_position').html('');

            if (datas[0])
            {
                $('#emp_name').html(datas[0]);
            }

            if (datas[1])
            {
                $('#emp_position').html(datas[1]);
            }
        });

        $('#employee').val(id);
        $.ajax({
            url: "<?php echo site_url('Con_LeaveRequest/get_employee_leave_info/') ?>/" + id,
            type: "POST"
        }).done(function (data) {
            // alert(data);
            $('#leave_req_rep').html(data);
        });

        $.ajax({
            url: "<?php echo site_url('Con_LeaveRequest/load_Leave_Type/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#leave_type').html('');
                $('#leave_type').empty();

                $('#leave_type').html(data);
            }
        });
        
        $('#sky-form11')[0].reset();

        $("#leave_type").select2({
            placeholder: "Leave Type",
            allowClear: true,
        });
    }

    $(function () {
        $("#sky-form11").submit(function (event) {
            $('select').removeAttr('disabled');
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_LeaveRequest';
                view_message(data, url, '', '#sky-form11');

            });
            event.preventDefault();
        });
    });

   /* function calculate_date()
   {
       var from_datea = show_date_formate_js($('#from_date').val());
       var date1 = new Date(from_datea);

       var to_datea = show_date_formate_js($('#to_date').val());
       var date2 = new Date(to_datea);

       var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
       var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay));
       //alert(diffDays);
       if (diffDays)
       {
           $('#number_of_days').val(diffDays);
       }
   } */

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
        var DAYS = parseInt(diffDays + 1);
        if (DAYS) {
            $('#number_of_days').val(DAYS);
            $('#submit').removeAttr('disabled');

            var balance = $('#available_leaves').val();
            var leave_amount = $('#number_of_days').val();

            if (balance == '') {
                alert('Please Set Up This Leave Type');
                $('#submit').attr('disabled', 'disabled');
            } else if ((balance * 1) < (leave_amount * 1)) {
                alert('You Have Not Sufficient Leave Balance');
                $('#submit').attr('disabled', 'disabled');
            }
        }
    }

    function value_receive(id)
    {
        // alert(id);
        var emp_id = $('#employee').val();
        // alert(emp_id);
        var data = id + '_' + emp_id;
        $.ajax({
            url: "<?php echo site_url('con_LeaveRequest/get_leave_information/') ?>/" + data,
            type: "POST"
        }).done(function (data) {
            // alert(data);
            $('#available_leaves').val(data);
        });
    }

    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    $("#s_employee").select2({
        placeholder: "Employee",
        allowClear: true,
    });

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "con_LeaveRequest/delete_entry/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->

