
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
                        <select name="department_id" id="department_id" onchange="load_emp_attendance(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="emp_att">
<!--                            <tr id="tr_1">
                                <td class="mycol">1<input type='hidden' value='' name='dtls_id[]' id='dtls_id_1'/> </td>
                                <td class="mycol">
                                    <select name="employee_id" id="employee_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                            <?php
//                                        foreach ($department->result() as $roww) {
//                                            print"<option value=" . $roww->id . ">" . $roww->department_name . "</option>";
//                                        }
                            ?>
                                    </select>
                                </td>
                                <td class="mycol"><input class="form-control input-sm" readonly type="text" name="asset_name[]" id="asset_name_1" value="" placeholder="Position" /></td>
                                <td class="mycol"><input class="form-control input-sm" type="text" name="asset_name[]" id="asset_name_1" value="" placeholder="In Time" /></td>
                                <td class="mycol"><input class="form-control input-sm" type="text" name="model_name[]" id="model_name_1"  placeholder="Out Time" /></td>
                                <td class="mycol"><input class="form-control input-sm" type="text" name="serial_no[]" id="serial_no_1"  placeholder="Duration" /></td>
                                <td class="mycol" id="action_td" style="width: 12%; "><a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>&nbsp;<a class="btn btn-sm btn-danger" id="remove_1" title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i></a></td>
                            </tr>-->
                        </tbody>
                    </table>

                </div>    
            </div>
            <!--                <div class="modal-footer">
                                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>-->

            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>
</div><!--/row-->
</div><!--/container-->

<div class="modal fade bd-example-modal-lg" id="Attendance_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
            </div>
            <form id="sky-form11" name="sky-form11" class="form-horizontal" action="<?php echo base_url(); ?>Con_AttendanceEntry/save_empAttendance" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_attendance"/>
                <div class="modal-body"> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-4">
                            <select name="department_id" id="department_id" onchange="load_emp(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($department->result() as $row) {
                                    print"<option value=" . $row->id . ">" . $row->department_name . "</option>";
                                }
                                ?>
                            </select>    
                        </div>
                        <label class="col-sm-2 control-label">Employee:</label>
                        <div class="col-sm-4">
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
//                                foreach ($department->result() as $row) {
//                                    print"<option value=" . $row->id . ">" . $row->department_name . "</option>";
//                                }
                                ?>
                            </select>    
                        </div>                    
                    </div>
                    <div class="form-group">                    
                        <label class="col-sm-2 control-label">Date:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="attendance_date" value="" id="attendance_date" class="form-control dt_pick" placeholder="Date" />                    
                        </div>
                        <label class="col-sm-2 control-label">In Time:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="in_time" id="in_time" value="" class="form-control timepicker" placeholder="In Time" />                    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Out Time:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="out_time" id="out_time" value="" class="form-control timepicker" placeholder="Out Time" />                    
                        </div>
                        <label class="col-sm-2 control-label">Duration:</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="duration" id="duration" value="" readonly class="form-control dt_pick" placeholder="Duration" />                    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <!--                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    function load_emp_attendance(id) {
        $.ajax({
            url: "<?php echo site_url('Con_AttendanceList/employee_attendance/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#emp_att').html('');
                $('#emp_att').empty();

                $('#emp_att').html(data);
//                reload_table('mytable');
            }
        });
    }
    $(function () {
        $("#att_search").submit(function (event) {
            var url;
            url = "<?php echo site_url('Con_AttendanceList/emp_attendance_by_date') ?>";

            $.ajax({
                url: url,
                data: $("#att_search").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $('#emp_att').html('');
                $('#emp_att').empty();
                $('#emp_att').html(data);
//                reload_table('mytable');
            });
            event.preventDefault();
        });
    });

    function edit_emp_attendance(id) {
        var emp_dep_id = '';
        $.ajax({
            url: "<?php echo site_url('Con_AttendanceList/ajax_get_department/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                emp_dep_id = data;
            }
        });

        $.ajax({
            url: "<?php echo site_url('Con_AttendanceList/ajax_edit_attendance/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_attendance"]').val(data.id);
                $('[name="department_id"]').select2().select2('val', emp_dep_id);
                load_emp(emp_dep_id);
                $('[name="employee_id"]').select2().select2('val', data.employee_id);
                $('[name="attendance_date"]').val(data.attendance_date);
                $('[name="in_time"]').val(data.in_time);
                $('[name="out_time"]').val(data.out_time);
                $('[name="duration"]').val(data.duration);

                $('#Attendance_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Attendance'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

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

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url;
            url = "<?php echo site_url('Con_AttendanceList/update_emp_attendance') ?>";
            var emp_dep_id = $('#department_id').val();

            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                load_emp_attendance(emp_dep_id);
                reload_table('mytable');
                var url = '';
                view_message(data, url, 'Attendance_Modal', 'sky-form11');
            });
            event.preventDefault();
        });
    });

    $("#department_id").select2({
        placeholder: "Department Name",
        allowClear: true
    });
    $("#employee_id").select2({
        placeholder: "Employee Name",
        allowClear: true
    });
    
    $('#in_time').timepicker({
        showMeridian: false
    });

    $(document).ready(function () {
        $('#in_time').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true,
//            showMeridian:false
        });
    });

    $('#out_time').timepicker({
        showMeridian: false
    });
    $(document).ready(function () {
        $('#out_time').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true
        });
    });

</script>
<!--=== End Content ===-->

