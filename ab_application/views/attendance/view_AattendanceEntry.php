
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <form id="att_search" name="att_search" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group" style="margin-top: 15px;">
                    <label class="col-sm-2 control-label">Select Department:</label>
                    <div class="col-sm-2">
                        <!--<select name="department_id" id="department_id" onchange="load_emp_attendance(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">-->
                        <select name="department_id" id="department_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            foreach ($department->result() as $row) {
                                print"<option value=" . $row->id . ">" . $row->department_name . "</option>";
                            }
                            ?>
                        </select>    
                    </div>
                    <label class="col-sm-1 control-label">Date:</label>
                    <div class="col-sm-3">                            
                        <input type="text" name="attendance_date" id="attendance_date" class="form-control dt_pick" placeholder="Date" />                    
                    </div>

                    <div class="col-sm-3">
                        <button type="submit" id="submit" class="btn btn-u">Search</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive col-md-12 col-centered" id="attendance_div">
                <div class="table-responsive col-md-12 col-centered">
                    <form id="sky-form11" name="sky-form11" class="form-horizontal" action="<?php echo base_url(); ?>Con_AttendanceEntry/save_empAttendance" method="post" enctype="multipart/form-data" role="form">
                        <table id="mytable" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Employee Name</th>
                                    <th>Position</th>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody id="emp_att">

                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <!--                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                        </div>
                    </form>
                </div>    
            </div>            
        </div><!-- end container well div -->
    </div>
</div>
</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
//    $(function() {
//      $( "#attendance_date" ).datepicker({  maxDate: new Date() });
//    });

    function time_calculation(i) {

        var start_time = $('#in_time_' + i).val();
        var end_time = $('#out_time_' + i).val();
        //alert(start_time + "=====" + end_time);

        var timeStart = new Date("01/01/2007 " + start_time);
        var timeEnd = new Date("01/01/2007 " + end_time);

        var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds

        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;

        var TIME_DIFF = hours + ":" + minutes;
        $('#duration_' + i).val(TIME_DIFF);
    }


    $(function () {
        $("#att_search").submit(function (event) {
            var url;
            url = "<?php echo site_url('Con_AttendanceEntry/emp_attendance_by_date') ?>";

            $.ajax({
                url: url,
                data: $("#att_search").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $('#emp_att').html('');
                $('#emp_att').empty();
                $('#emp_att').html(data);
//                reload_table('mytable');
                var rowCount = $('#emp_att tr').length;
//                var = i;            
                for (i = 1; i <= rowCount; i++) {
                    $('#in_time_' + i).timepicker({
                        minuteStep: 5,
                        showInputs: true,
                        disableFocus: true,
                        defaultTime: ''
                    });
                    $('#out_time_' + i).timepicker({
                        minuteStep: 5,
                        showInputs: true,
                        disableFocus: true,
                        defaultTime: ''
                    });
                }
            });
            event.preventDefault();
        });
    });

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                var url = '<?php echo base_url() ?>Con_AttendanceEntry';
                view_message(data, url, '', '#sky-form11');
            });
            event.preventDefault();
        });
    });

    function load_emp(id) {
        $.ajax({
            url: "<?php echo site_url('Con_AttendanceEntry/dep_emp/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#employee_id').html(data);
            }
        });
    }



    $("#department_id").select2({
        placeholder: "Department Name",
        allowClear: true
    });
    $("#employee_id").select2({
        placeholder: "Employee Name",
        allowClear: true
    });


//    $('#in_time').timepicker({
//        showMeridian: false
//    });
//
//    $(document).ready(function () {
//        $('#in_time').timepicker({
//            minuteStep: 5,
//            showInputs: false,
//            disableFocus: true,
////            showMeridian:false
//        });
//    });
//
//    $('#out_time').timepicker({
//        showMeridian: false
//    });
//    $(document).ready(function () {
//        $('#out_time').timepicker({
//            minuteStep: 5,
//            showInputs: false,
//            disableFocus: true
//        });
//    });




</script>
<!--=== End Content ===-->

